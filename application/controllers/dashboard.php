<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
		
    function __construct()
    {
        // Call the Controller constructor
        parent::__construct();	
        $this->load->library('template');
		
		//$this->load->model('user/user_model');
		
		$this->user_id 			= $this->session->userdata('user_id');
		$this->user_email 		= $this->session->userdata('user_email');
		$this->user_role_id		= $this->session->userdata('user_role_id');		
		$this->user_status		= $this->session->userdata('user_status');		
				
        
		$this->user_check_isvalidated();	
		
		
		//basic info for the header		 
		 $this->template->write('title', "Dashboard | Little Sprouts");	
		 $this->template->write('heading', 'Little Sprouts');		 
		 $this->template->write('meta_description', 'Little Sprouts');
		 
		 //include regions for template
		 $this->template->write_view('topheader', 'blocks/topheader');
		 $this->template->write_view('megadropdown', 'blocks/megadropdown');	
		 $this->template->write_view('footer', 'blocks/footer');		 		 			
    }
	
	function index()
	 {		
		$this->template->write_view('content', 'staff/dashboard_view');
		$this->template->render();		
	 }
	 
	/*private function user_check_isvalidated()
	{
		$logged_in 			= $this->session->userdata('logged_in'); 
		$role 				= $this->session->userdata('user_role_id');
		$user_ip_address 	= $this->session->userdata('user_ip_address');
		
		if($logged_in == TRUE ) {
			$account_status = $this->user_model->get_user_status($this->user_role_id, $this->user_email, $this->user_id,  $this->user_status);   
		}
		
		if($logged_in == FALSE ){

			$this->session->set_flashdata('error_message', 'Please login to access this page.');				
			redirect('login');
		}  
		//if logged in and inactive
		elseif(($logged_in == TRUE) && ($account_status->user_account_status == 2)){
							
			$session_data = array('user_id' => '', 'user_email' => '','user_status' => '', 'user_role_id' => '', 'logged_in' => '');
			$this->session->unset_userdata($session_data);
            $this->session->sess_destroy();	
			
			$this->session->set_flashdata('error_message', 'Your account is In-active by admin. For activate your account please contact with admin.');	
			redirect('login');
		} 	
		//if logged in and ip blocked
		elseif(($logged_in == TRUE) && ($account_status->user_ip_address_status == 0) && ($_SERVER["REMOTE_ADDR"] == $user_ip_address)){
							
			$session_data = array('user_id' => '', 'user_email' => '','user_status' => '', 'user_role_id' => '', 'logged_in' => '');
			$this->session->unset_userdata($session_data);
            $this->session->sess_destroy();	
			
			$this->session->set_flashdata('error_message', 'Your IP address is blocked by inspire credit admin. For activate please contact with admin.');	
			redirect('login');

		}
		//if logged in and ip blocked
		elseif(($logged_in == TRUE) && ($account_status->user_account_status == -1)){
							
			$session_data = array('user_id' => '', 'user_email' => '','user_status' => '', 'user_role_id' => '', 'logged_in' => '');
			$this->session->unset_userdata($session_data);
            $this->session->sess_destroy();	
			
			$this->session->set_flashdata('error_message', 'Your account has been deleted by inspire credit admin. For activate please contact with admin.');	
			redirect('login');
			
		}		
		//if landlord is logged in 
		elseif(($logged_in == TRUE ) && ($role == 2)){

			$this->session->set_flashdata('error_message', 'Oops! Access Denied.');				
			redirect('landlord/dashboard');

		}                
		//if csr is logged in 
		elseif(($logged_in == TRUE ) && ($role == 3)){

			$this->session->set_flashdata('error_message', 'Oops! Access Denied.');	
			redirect('csr/dashboard');
		} 
	}*/	 
}


/* End of file dashboard.php */
/* Location: ./application/controllers/renters/dashboard.php */
