<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Create_instance extends CI_Controller {

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

    function index() {
        //This method will have validation

        $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->form_validation->set_rules('instancename', 'Instance Name', 'trim|required|valid_instancename|username_custom|min_length[5]|max_length[150]|');
        $this->form_validation->set_rules('yeardropdown', 'Year', 'trim|required');
        $this->form_validation->set_rules('academic_year', 'Academic Year', 'trim|required|valid_academic_year|numeric_dash|min_length[4]|max_length[10]|');
        $this->form_validation->set_rules('term', 'Term', 'trim|required|valid_term|min_length[5]|username_custom|min_length[5]|max_length[150]|');



        if ($this->form_validation->run() == FALSE) {

            $this->admin_template->write_view('content', 'admin_area/create_instance/create_instance_view', $data, TRUE);
            $this->admin_template->render();
        } else {


            $instancename = $this->input->post('instancename');
            $instanceyear = $this->input->post('yeardropdown');
            $instance_academic_year = $this->input->post('academic_year');
            $instanceterm = $this->input->post('term');


            // Validate the user 
            $result = $this->admin_model->create_instance_account($instancename,$instanceyear,$instance_academic_year,$instanceterm);

            if ($result == TRUE) {

                $this->session->set_flashdata('success_message', 'Instance Name has been created Successfully.');
                //$this->admin_template->write_view('content', 'admin_area/dashboard', $data, TRUE);
                redirect('admin_area/dashboard');
            } else {
                //echo $this->email->print_debugger();
                $this->session->set_flashdata('error_message', 'Oops!!! This Instance Name  already Exists , Please try again.');
                redirect('admin_area/create_instance');
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

/* End of file Create_user_account.php */
/* Location: ./application/controllers/admin_area/Create_user_account.php */
?>


