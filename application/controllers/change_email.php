<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_email extends CI_Controller {
		
	function __construct()
    {
		// Call the Controller constructor
        parent::__construct();	
        $this->load->library('template');        
		$this->load->model('user/user_model');
		
		$this->user_id 			= $this->session->userdata('user_id');
		$this->user_name 		= $this->session->userdata('user_name');
		$this->user_email 		= $this->session->userdata('user_email');
		$this->user_role_id		= $this->session->userdata('user_role_id');		
		$this->user_status		= $this->session->userdata('user_status');	
        
		$this->user_check_isvalidated();
				
		//basic info for the header		 
		$this->template->write('title', "Change Email Address | Inspire Credit - 'It's What Moves You!");	
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
		
		$this->form_validation->set_rules('userOldEmail', 'Email Address', 'trim|required|valid_email|max_length[150]|xss_clean');
		$this->form_validation->set_rules('userNewEmail', 'New Email Address', 'trim|required|valid_email|max_length[150]|is_unique[cr_users.user_email]|xss_clean');
		$this->form_validation->set_rules('userNewConfEmail', 'New Confirm Email Address', 'trim|required|valid_email|max_length[150]|matches[userNewEmail]|xss_clean');
		 
		if($this->form_validation->run() == FALSE) {
		
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->template->write_view('content', 'user/change_email_view');
			$this->template->render();				
		}
		else {		
		
			$old_email = $this->input->post('userOldEmail');
			$new_email = $this->input->post('userNewEmail');
		
			// change password
			$result = $this->user_model->change_email($this->user_id, $this->user_name, $this->user_role_id, $old_email, $new_email);
			 
			 if(!$result){
			 
				$this->session->set_flashdata('error_message', 'Incorrect old email address.');				
				redirect('change_email');
				
			 } else {
				
				$this->session->set_flashdata('success_message', 'Your Email address has been changed successfully.');
				
				$session_data = array('user_email' => '');
				$this->session->unset_userdata($session_data);
				$this->session->unset_userdata($this->session->userdata('user_email'));
				
				$newemail = array(
                   'user_email'  => $new_email
                );
				$this->session->set_userdata($newemail);

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
