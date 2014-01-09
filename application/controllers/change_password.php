<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_password extends CI_Controller {
		
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
		$this->template->write('title', "Change Password | Inspire Credit - 'It's What Moves You!");	
		$this->template->write('heading', 'Inspire Credit');		 
		$this->template->write('meta_description', 'Inspire Credit');
		 
		 //include regions for template 
		 $this->template->write_view('topheader', 'blocks/topheader');
		 $this->template->write_view('megadropdown', 'blocks/megadropdown');		
		 $this->template->write_view('footer', 'blocks/footer');		 		 			
    }
		
	function index()
	 {		 		
			   
		//This method will have validation
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('oldPassword', 'Old Password', 'trim|required|min_length[6]|max_length[15]|xss_clean');
		$this->form_validation->set_rules('newPassword', 'Password', 'trim|required|min_length[6]|max_length[15]|matches[newPasswordConf]|xss_clean');
		$this->form_validation->set_rules('newPasswordConf', 'Confrim Password', 'trim|required|min_length[6]|max_length[15]|xss_clean');	
		 
		if($this->form_validation->run() == FALSE) {
		
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->template->write_view('content', 'user/change_password_view');
			$this->template->render();				
		}
		else {		
		
			$old_password = md5($this->input->post('oldPassword'));
			$new_password = md5($this->input->post('newPassword'));
		
			// change password
			$result = $this->user_model->change_password($this->user_id, $this->user_email, $this->user_role_id, $old_password, $new_password);
			 
			 if(!$result){
			 
				$this->session->set_flashdata('error_message', 'Incorrect old password.');				
				redirect('change_password');
				
			 } else {
				
				$this->session->set_flashdata('success_message', 'Your Password has been changed successfully.');

				//if renter
				if($this->user_role_id == 1 ) {
					  redirect('renter/dashboard');						  
				}
				//if landlord
				else if($this->user_role_id == 2 ) {	
					  redirect('landlord/dashboard');						
				}
				//if CSR
				else if($this->user_role_id == 3 ) {
					  redirect('csr/dashboard');
				}							 
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
		
		if(($logged_in == FALSE) || ($role == NULL) ){
			$this->session->set_flashdata('error_message', 'Please login to access this page.');				
			redirect('login');

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


/* End of file change_password.php */
/* Location: ./application/controllers/change_password.php */
