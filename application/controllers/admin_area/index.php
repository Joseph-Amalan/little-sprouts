<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
		
	function __construct() {
	 
		parent::__construct();		
		$this->admin_check_isvalidated();
		$this->load->library('admin_template'); 
		
		$this->load->model('admin_area/admin/admin_model');
				
		//basic info for the header		 
		$this->admin_template->write('title', 'Admin Little Sprouts');			 

		//include regions for template
		$this->admin_template->write_view('header', 'admin_area/blocks/header');                
                $this->admin_template->write_view('right_side_bar', 'admin_area/blocks/rightside');
		$this->admin_template->write_view('footer', 'admin_area/blocks/footer');
   }

   /*function index()
   {	
		 //This method will have validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
		$this->form_validation->set_rules('admin_email', 'Email', 'trim|required|valid_email|max_length[150]|xss_clean');
		$this->form_validation->set_rules('admin_password', 'Password', 'trim|required|min_length[5]|max_length[200]|xss_clean');
		 
		if($this->form_validation->run() == FALSE) {		
			
			 $this->admin_template->write_view('content', 'admin_area/index-view');
			 $this->admin_template->render();	
						
		} else {			
			
			$adminEmail 	  = $this->input->post('admin_email');
			//encrypt the password before passing it to function
			$adminPassword    = md5($this->input->post('admin_password'));

			// Validate the user 
			$result = $this->admin_model->login_validate($adminEmail,$adminPassword);
			
			if($result == FALSE){
			 
				$this->session->set_flashdata('error_message', 'Invalid Email and Password, Please try again.');				
				redirect('admin_area/index');
								
			 } else if(($result -> admin_email === $adminEmail) && ($result -> admin_pwd === $adminPassword)) {
				
				$session_admin_data = array(
					'admin_id' => $result->admin_id,
					'admin_email' => $result->admin_email,					
					'admin_role_id' => $result->admin_role_id,
					'admin_logged_in' => true
				);
				
				$this->session->set_userdata($session_admin_data);				
				
				$this->session->set_flashdata('success_message', 'Welcome to Little Sprouts');				
				redirect('admin_area/dashboard');	
			}				 
		}	  
	}*/
  function index()
   {	
		 //This method will have validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
		$this->form_validation->set_rules('admin_username', 'USer Name', 'trim|required|max_length[150]|xss_clean');
		$this->form_validation->set_rules('admin_password', 'Password', 'trim|required|min_length[5]|max_length[200]|xss_clean');
		 
		if($this->form_validation->run() == FALSE) {		
			
			 $this->admin_template->write_view('content', 'admin_area/index-view');
			 $this->admin_template->render();	
						
		} else {			
			
			$adminUserName 	  = $this->input->post('admin_username');
			//encrypt the password before passing it to function
			$adminPassword    = md5($this->input->post('admin_password'));

			// Validate the user 
			$result = $this->admin_model->login_validate($adminUserName,$adminPassword);
			
			if($result == FALSE){
			 
				$this->session->set_flashdata('error_message', 'Invalid UserName and Password, Please try again.');				
				redirect('admin_area/index');
								
			 } else if(($result -> admin_username === $adminUserName) && ($result -> admin_pwd === $adminPassword)) {
				
				$session_admin_data = array(
					'admin_id' => $result->admin_id,
					'admin_username' => $result->admin_username,					
					'admin_role_id' => $result->admin_role_id,
					'admin_logged_in' => true
				);
				
				$this->session->set_userdata($session_admin_data);				
				
				$this->session->set_flashdata('success_message', 'Welcome to Little Sprouts');				
				redirect('admin_area/dashboard');	
			}				 
		}	  
	}

	private function admin_check_isvalidated()
	{
		$admin_logged_in = $this->session->userdata('admin_logged_in'); 
		$admin_role = $this->session->userdata('admin_role_id');
			
		//if renter is logged in 
		if(($admin_logged_in == TRUE ) && ($admin_role == 4)){                     
			$this->session->set_flashdata('success_message', 'You are already logged in.');		
            redirect('admin_area/dashboard');
                        
		}
    }
  
}


/* End of file index.php */
/* Location: ./application/controllers/admin_area/index.php */
?>

