<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deleted_accounts extends CI_Controller {
		
    function __construct()
    {
	
		parent::__construct();		
		$this->load->library('admin_template'); 			
		$this->admin_check_isvalidated();
				
		$this->load->library('admin_popup_template'); 
		
		//get admin data from session  		
        $this->admin_id = $this->session->userdata('admin_id');      
        $this->admin_email = $this->session->userdata('admin_email');		
        $this->admin_role_id = $this->session->userdata('admin_role_id');	
		
		$this->load->model('admin_area/admin/admin_model');	
		$this->load->model('admin_area/reporting/reporting_model');			

		//basic info for the header		 
		$this->admin_template->write('title', 'Delete Account | Admin Little Sprouts');			 

		//include regions for template
		$this->admin_template->write_view('header', 'admin_area/blocks/header');                
		$this->admin_template->write_view('right_side_bar', 'admin_area/blocks/rightside');
		$this->admin_template->write_view('footer', 'admin_area/blocks/footer');
    }
	
	function index()
	 {		 
		$body_data['deleted_accounts_data'] = $this->reporting_model->get_list_deleted_accounts(); 
	 
		$this->admin_template->write_view('content', 'admin_area/reporting/deleted_accounts_view', $body_data, TRUE);
		$this->admin_template->render();		
	 }
	 
	function renter_view_profile($user_id, $user_email)
	{	
		$body_data = array(); 
		$body_data['deleted_renters_data'] = $this->reporting_model->get_list_deleted_renter_details($this->admin_id, $this->admin_email, $this->admin_role_id, $user_id, $user_email) ;   
		
		$this->admin_popup_template->write_view('content', 'admin_area/reporting/deleted_renter_profile_view', $body_data, TRUE);
		$this->admin_popup_template->render();
	}
	
	function landlord_view_profile($user_id, $user_email)
	{	
		$body_data = array(); 
		$body_data['deleted_landlord_data'] = $this->reporting_model->get_list_deleted_landlord_details($this->admin_id, $this->admin_email, $this->admin_role_id, $user_id, $user_email) ;   
		
		$this->admin_popup_template->write_view('content', 'admin_area/reporting/deleted_landlord_profile_view', $body_data, TRUE);
		$this->admin_popup_template->render();
	}
	
	function csr_view_profile($user_id, $user_email)
	{	
		$body_data = array(); 
		$body_data['deleted_csr_data'] = $this->reporting_model->get_list_deleted_csr_details($this->admin_id, $this->admin_email, $this->admin_role_id, $user_id, $user_email) ;   
		
		$this->admin_popup_template->write_view('content', 'admin_area/reporting/deleted_csr_profile_view', $body_data, TRUE);
		$this->admin_popup_template->render();
	}
	 
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


/* End of file dashboard.php */
/* Location: ./application/controllers/landlord/dashboard.php */
