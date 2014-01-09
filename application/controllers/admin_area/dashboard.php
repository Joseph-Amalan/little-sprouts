<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
		
	 function __construct() {
	 
		parent::__construct();
		$this->admin_check_isvalidated();		
		$this->load->library('admin_template'); 	

		//basic info for the header		 
		$this->admin_template->write('title', 'Admin Little Sprouts');			 

		//include regions for template
		$this->admin_template->write_view('header', 'admin_area/blocks/header');                
		$this->admin_template->write_view('right_side_bar', 'admin_area/blocks/rightside');
		$this->admin_template->write_view('footer', 'admin_area/blocks/footer');
   }
   
   function index()
   {		
	    $this->admin_template->write_view('content', 'admin_area/dashboard/dashboard_view');
	    $this->admin_template->render();		
   }
   
   /** 28-11-2012:Poli: Check admin is logged in **/
   private function admin_check_isvalidated()
	{
		$admin_logged_in = $this->session->userdata('admin_logged_in'); 
		$admin_role = $this->session->userdata('admin_role_id');
		
		if(($admin_logged_in == FALSE) || ($admin_role == NULL) ){

			$this->session->set_flashdata('error_message', 'Please login to access this page.');				
			redirect('admin_area/index');

		}   
    }
   
}


/* End of file index.php */
/* Location: ./application/controllers/admin_area/index.php */
?>

