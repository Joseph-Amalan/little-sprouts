<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class List_instance extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->library('admin_template');
       
        $this->admin_check_isvalidated();
       
        $this->load->library('admin_popup_template');
        //get admin data from session  		
        $this->admin_id = $this->session->userdata('admin_id');
        $this->admin_username = $this->session->userdata('admin_username');
        $this->admin_role_id = $this->session->userdata('admin_role_id');

        $this->load->model('admin_area/admin/admin_model');
        $this->load->model('admin_area/instance/instance_model');
        //$this->load->model('admin_area/renter/renter_model');
        //$this->load->model('admin_area/dataentry/dataentry_model');

        //basic info for the header		 
        $this->admin_template->write('title', 'Admin Little Sprouts - List of Instances');

        //include regions for template
        $this->admin_template->write_view('header', 'admin_area/blocks/header');
        $this->admin_template->write_view('right_side_bar', 'admin_area/blocks/rightside');
        $this->admin_template->write_view('footer', 'admin_area/blocks/footer');

        //This method will have the credentials validation
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

    /** 28-11-2012:start:Poli: All registered & active renters * */
    function index() {

        redirect('admin_area/list_instance/active_instance');
    }

    function active_instance()
	{
		$this->load->library("pagination");
        $instance_data = array();
        $config = array();
			
		//count the total rows
        $total_rows =  $this->instance_model->record_count_instance_data();
        //echo "------>>".$total_rows;
		
		$page = (($this->uri->segment(6) == NULL) || ($this->uri->segment(6) > $total_rows) || ($this->uri->segment(6) < 0)) ? 0 : $this->uri->segment(6);
        //echo "------>>".$page; 
		
		//by default sort by rgd (registration date, column name - register_date)
        $column = $this->uri->segment(4)  ? $this->uri->segment(4) : 'rgd';
		
		switch ($column) {           
            case 'ue':
                $sort_column = 'instance_name';
                break;  
            case 'rgd':
                $sort_column = 'term';
                break;
            default:
                $sort_column = 'instance_name';               
        }
		
		/* switch ($this->uri->segment(5)) {
            case 'asc':
                $sort_order = 'asc';
                break;
            case 'desc':
                $sort_order = 'desc';
                break;            
            default:
                $sort_order = 'desc';               
        } */
	
		$config["base_url"] = base_url()."admin_area/list_instance/active_instance/".$column;
		$config["total_rows"] = $total_rows;
        $config["per_page"] = 5;        
        $config['num_links'] = 5;  
        $config['uri_segment'] = 6;
        //$config['use_page_numbers'] = TRUE;
        //$config['page_query_string'] = TRUE;  
        $this->pagination->initialize($config);
		
		$instance_data["sort_column"] = $sort_column;
        //$instance_data["sort_order"] = $sort_order;        
        $instance_data["page"] = $page;
        $instance_data["limit"] = $config["per_page"];
		
		//model
		$instance_data['list_instance'] = $this->instance_model->get_list_instance($this->admin_id,$this->admin_username,$this->admin_role_id, $sort_column,$page,$config["per_page"]);  
	 	$instance_data["links"] = $this->pagination->create_links();
		
		//view
		$this->admin_template->write_view('content', 'admin_area/create_instance/list_instance_view', $instance_data, TRUE);
		$this->admin_template->render();
        
	}	
	
	
function view_instance($instance_id, $instance_name)
	{	
		$body_data = array(); 
		$body_data['instance_data'] = $this->instance_model->get_list_instance_details($this->admin_id, $this->admin_username, $this->admin_role_id, $instance_id, $instance_name) ;   
		
		$this->admin_popup_template->write_view('content', 'admin_area/create_instance/instance_view', $body_data, TRUE);
		$this->admin_popup_template->render();
	}
	
	function edit_instance($instance_id, $instance_name)
	{	
		$body_data = array();	
					
		$body_data['instance_data'] = $this->instance_model->get_list_instance_details($this->admin_id, $this->admin_username, $this->admin_role_id, $instance_id, $instance_name) ;   
		
		$body_data['instance_id']    = $instance_id;
		$body_data['instance_name'] = $instance_name;	
		
		$this->form_validation->set_rules('instancename', 'Instance Name', 'trim|required|valid_instancename|alpha_dash_space|min_length[4]|max_length[150]');		   
		$this->form_validation->set_rules('yeardropdown', 'Instance Year', 'trim|required|xss_clean');				
		$this->form_validation->set_rules('academicyear', 'Academic Year', 'trim|required|valid_academicyear|numeric_dash|min_length[4]|max_length[10]|xss_clean');		   
		$this->form_validation->set_rules('instanceterm', 'Instance Term', 'trim|required|valid_instanceterm|min_length[4]|alpha_dash_space|max_length[150]|xss_clean');		   
	
                
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin_area/create_instance/instance_edit_view',$body_data);
		}
		else {
		                        
            $instancename    			= $this->input->post('instancename');
			$yeardropdown 			= $this->input->post('yeardropdown');
			$academicyear 				= $this->input->post('academicyear');
			$instanceterm 					= $this->input->post('instanceterm');			
			
					
			///database transaction start
			$this->db->trans_start();
									
			$this->instance_model->update_instance_data($instance_id, $instance_name, $this->admin_id, $this->admin_username, $this->admin_role_id,
			$instancename,$yeardropdown,$academicyear,$instanceterm);			
			
                            
            $this->db->trans_complete();
			//database transaction end
											
            if($this->db->trans_status() == TRUE)
            {
				$this->session->set_flashdata('success_message', 'Instance details has been successfully updated.');				
				redirect('popup/popup_message');				
				
			} else {
			
				$this->session->set_flashdata('error_message', 'Instance details has been successfully updated.');
				$this->load->view('admin_area/create_instance/instance_edit_view',$body_data);
			}		
		}				
	}
   
    function delete_instance($instance_id, $instance_name)
	{		
		
		$body_data = array(); 
		$body_data['instance_id'] = $instance_id; 
		$body_data['instance_name'] = $instance_name; 
		
		$this->form_validation->set_rules('instanceAccountDeleteReason', 'reason for delete instance account', 'trim|required|max_length[1000]|xss_clean');
		
		if($this->form_validation->run() == FALSE) {			
		
			$this->admin_popup_template->write_view('content', 'admin_area/create_instance/instance_delete_view', $body_data, TRUE);
			$this->admin_popup_template->render();	
			
		}
		else 
		{		                        	
			$instanceAccountDeleteReason    = $this->input->post('instanceAccountDeleteReason');	
			
			//database transaction start
			$this->db->trans_start();
			
			//$this->renter_model->cancel_landlord_renter_association_data($this->admin_id, $this->admin_email, $this->admin_role_id, $user_id, $user_email);
			$this->instance_model->delete_instance_data($this->admin_id, $this->admin_username, $this->admin_role_id, $instance_id, $instance_name, $instanceAccountDeleteReason);
					
			$this->db->trans_complete();	
			//database transaction end
			
			 if($this->db->trans_status() == TRUE) {			
		
				
				
					$this->session->set_flashdata('success_message', 'Instance has been successfully Deleted.');				
					redirect('popup/popup_message');	
				}
				
			 else {
			
				$this->session->set_flashdata('error_message', 'Opps!! some error occur while Delete the Instance.');
				redirect('popup/popup_message');
			}			
		}
	}
	
    private function admin_check_isvalidated() {
        $admin_logged_in = $this->session->userdata('admin_logged_in');
        $admin_role = $this->session->userdata('admin_role_id');

        if (($admin_logged_in == FALSE) || ($admin_role == NULL)) {

            $this->session->set_flashdata('error_message', 'Please login to access this page.');
            redirect('admin_area/index');
        }
    }

}

/* End of file List_renters.php */
/* Location: ./application/controllers/admin_area/List_renters.php */
?>

