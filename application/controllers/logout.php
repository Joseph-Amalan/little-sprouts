<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {
		
	function __construct()
    {
		// Call the Controller constructor
		parent::__construct();
                $this->load->library('template');
				
		//basic info for the header		 
		$this->template->write('title', "Logout | Little Sprouts");	
		$this->template->write('heading', 'Little Sprouts');		 
		$this->template->write('meta_description', 'Little Sprouts');
				 
		//include regions for template
		$this->template->write_view('topheader', 'blocks/topheader');			
		$this->template->write_view('megadropdown', 'blocks/megadropdown');	
		$this->template->write_view('footer', 'blocks/footer');		 		 			
    }
		
    function index()
     {
        
		/*
		echo "session values --><pre> ";
				print_r($this->session->all_userdata());
		echo "</pre>"; exit;
		* 
		*/
		
		$session_data = array('user_id' => '', 'user_email' => '','user_status' => '', 'user_role_id' => '', 'logged_in' => '');
		$this->session->unset_userdata($session_data);

		$this->session->sess_destroy();	
		//$this->session->set_flashdata('success_message', 'You are successfully logout.');		
		redirect('index');
    }
	
}


/* End of file logout.php */
/* Location: ./application/controllers/logout.php */
