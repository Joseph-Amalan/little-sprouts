<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {
		
	function __construct()
    {
		// Call the Controller constructor
		parent::__construct();
        $this->load->library('admin_template'); 
				
		//basic info for the header		 
		$this->admin_template->write('title', 'Admin Little Sprouts');			 

		//include regions for template
		$this->admin_template->write_view('header', 'admin_area/blocks/header');
		$this->admin_template->write_view('footer', 'admin_area/blocks/footer');	 		 			
    }
		
    function index()
     {
			
		$session_admin_data = array('admin_id' => '', 'admin_email' => '', 'admin_logged_in' => '');
		$this->session->unset_userdata($session_admin_data);

		$this->session->sess_destroy();	
		$this->session->set_flashdata('success_message', 'You are successfully logout.');		
		redirect('admin_area/index');
    }
	
}


/* End of file logout.php */
/* Location: ./application/controllers/logout.php */
