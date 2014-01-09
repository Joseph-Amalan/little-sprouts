<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reset_password extends CI_Controller {
		
    function __construct()
    {
		// Call the Controller constructor
		parent::__construct();
        $this->load->library('template');                
		$this->load->model('user/user_model');
		
		$this->user_id 			= $this->session->userdata('user_id');
		$this->user_email 		= $this->session->userdata('user_email');
		$this->user_role_id		= $this->session->userdata('user_role_id');		
		$this->user_status		= $this->session->userdata('user_status');	
        
		$this->user_check_isvalidated();
				
		//basic info for the header		 
		$this->template->write('title', "Reset Password | Inspire Credit - 'It's What Moves You!'");	
		$this->template->write('heading', 'Inspire Credit');		 
		$this->template->write('meta_description', 'Inspire Credit');
		 
		 //include regions for template 
		 $this->template->write_view('topheader', 'blocks/topheader');
		 $this->template->write_view('megadropdown', 'blocks/megadropdown');		
		 $this->template->write_view('footer', 'blocks/footer');	 		 			
    }
		
	function index()
	 {		 	   
		//This method will have the credentials validation
		$this->load->library('form_validation');
			
		$this->form_validation->set_rules('newPassword', 'Password', 'trim|required|xss_clean|min_length[6]|max_length[10]|matches[newPasswordConf]');
		$this->form_validation->set_rules('newPasswordConf', 'Confrim Password', 'trim|required|xss_clean');	
		 
		if($this->form_validation->run() == FALSE) {
		
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->template->write_view('content', 'user/reset_password_view');
			$this->template->render();				
		}
		else {			
		
            $user_id = $this->session->userdata('user_id');
			$user_email = $this->session->userdata('user_email');			
			$user_role_id = $this->session->userdata('user_role_id');
                        
			$new_password = md5($this->input->post('newPassword'));
		
			// update password
			$result = $this->user_model->reset_password_update($user_id, $user_email, $user_role_id, $new_password);
                        			 
			 if(!$result){
			 
				$this->session->set_flashdata('error_message', 'Oops! Some error occured, please try again.');				
				redirect('index');
				
			 } else {
                             
                /*
				// send an email  
				$this->load->library('email');

				$this->email->from('selvem.jose@gmail.com', 'Credit Rocket');
				$this->email->to($user_email); 
				$this->email->subject("Activation email from Credit Rocket");			
				$this->email->message($this->load->view('emails/reset-password-html'));	
                                
				*/
				 $this->session->sess_destroy();
			 
				$this->session->set_flashdata('success_message', 'Password has been changed successfully, Please login with new password.');                               
				redirect('login');
			}				 
		}				
	}	
	
	private function user_check_isvalidated()
	{
		$logged_in 			= $this->session->userdata('logged_in');
		$role 				= $this->session->userdata('user_role_id');
		$user_ip_address 	= $this->session->userdata('user_ip_address');
			
		if($logged_in == TRUE ) {
			$account_status = $this->user_model->get_user_status($this->user_role_id, $this->user_email, $this->user_id,  $this->user_status);   
		}
			
		if(($this->user_id == NULL) && ($this->user_email == NULL)){			
			$this->session->set_flashdata('error_message', 'Access denied.');				
			redirect('index');                    
		} 
		elseif($logged_in == TRUE){			 
			$this->session->set_flashdata('error_message', 'Oops! Incorrect URL.');				
			redirect('index');
				
		}		
		//if logged in and inactive
		elseif(($logged_in == TRUE) && ($account_status->user_account_status == 2)){
							
			$session_data = array('user_id' => '', 'user_email' => '','user_status' => '', 'user_role_id' => '', 'logged_in' => '');
			$this->session->unset_userdata($session_data);
			$this->session->sess_destroy();	
			
			$this->session->set_flashdata('error_message', 'Your account is In-active by admin. For activate your account please contact with admin.');	
			redirect('index');

		} 	
		//if logged in and ip blocked
		elseif(($logged_in == TRUE) && ($account_status->user_ip_address_status == 0) && ($_SERVER["REMOTE_ADDR"] == $user_ip_address)){
							
			$session_data = array('user_id' => '', 'user_email' => '','user_status' => '', 'user_role_id' => '', 'logged_in' => '');
			$this->session->unset_userdata($session_data);
			$this->session->sess_destroy();	
			
			$this->session->set_flashdata('error_message', 'Your IP address is blocked by inspire credit admin. For activate please contact with admin.');	
			redirect('index');

		}
		//if logged in and deleted
		elseif(($logged_in == TRUE) && ($account_status->user_account_status == -1)){
							
			$session_data = array('user_id' => '', 'user_email' => '','user_status' => '', 'user_role_id' => '', 'logged_in' => '');
			$this->session->unset_userdata($session_data);
			$this->session->sess_destroy();	
			
			$this->session->set_flashdata('error_message', 'Your account has been deleted by inspire credit admin.');	
			redirect('index');
		}   
	  }
	

}


/* End of file login.php */
/* Location: ./application/controllers/login.php */
