<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_entry extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->library('template');
        // $this->load->library('excel');
        //$this->admin_check_isvalidated();
        $this->load->model('staff/dataentry/dataentry_model');
        //$this->load->library('admin_popup_template');

       $this->load->model('user/user_model');
		
		$this->user_id 			= $this->session->userdata('user_id');
		$this->user_email 		= $this->session->userdata('user_email');
		$this->user_role_id		= $this->session->userdata('user_role_id');		
		$this->user_status		= $this->session->userdata('user_status');	

      

        //basic info for the header		 
        $this->template->write('title', 'Admin Little Sprouts - Data Entry');

        //include regions for template
      $this->template->write_view('topheader', 'blocks/topheader');
		 $this->template->write_view('megadropdown', 'blocks/megadropdown');	
		 $this->template->write_view('footer', 'blocks/footer');	

        //This method will have the credentials validation
       // $this->load->library('form_validation');
        //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

    /** 28-11-2012:start:Poli: All registered & active renters * */
    function index() {
        redirect('staff/data_entry/getschool_list');
    }

    function getschool_list() {
        $data = array();
        $data['schools'] = $this->dataentry_model->get_schools();
        $data['status1'] = $this->dataentry_model->get_school_status();

        if (!$_POST) {

            $body_data['get_all_student_data'] = $this->dataentry_model->get_all_student_list();
            $this->template->write_view('content', 'staff/dataentry/dataentry_view', $body_data, TRUE);
        }


        $this->template->write_view('content', 'staff/dataentry/dataentry_view', $data, TRUE);
        $this->template->render();
    }

    function getclass_list($school) {
        $schoolname = utf8_decode(urldecode($school));
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->dataentry_model->get_classes($schoolname)));
    }

    function getstudent_list($school, $preclasses) {

        $school = utf8_decode(urldecode($school));
        $preclasses = utf8_decode(urldecode($preclasses));
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->dataentry_model->get_student_list($school, $preclasses)));
    }

    function get_student_id_list($get_student_id) {
        $body_data = array();
        $returnArray = array();

        if ($get_student_id) {


            $body_data['get_student_data'] = $this->dataentry_model->get_student($get_student_id);
        }
        /* $body_data = array(); */
        $body_data['schools'] = $this->dataentry_model->get_schools();
        $body_data['status1'] = $this->dataentry_model->get_school_status();
        $body_data['get_all_student_data'] = $this->dataentry_model->get_all_student_list();
        $returnArray = $body_data['get_student_data'][0];
        $returnValue = '';
        foreach ($returnArray as $key => $val) {
            $returnValue .= $val . ';';
        }

        echo $returnValue;

       // print_r($returnArray);
        $this->template->write_view('content', 'staff/dataentry/dataentry_view', $body_data, TRUE);
        $this->template->render();
    }

    function data_entry_form_submit() {

        if (isset($_POST["editstudentForm"])) {

            $student_get_id = $this->input->post('student_get_id');
            $student_name = $this->input->post('student_name');
            $test_date_first = $this->input->post('test_date_first');
            $topel_pkss = $this->input->post('topel_pkss');
            $topel_dvss = $this->input->post('topel_dvss');
            $topel_pass = $this->input->post('topel_pass');
            $topel_elindex = $this->input->post('topel_elindex');
            $not_tested_reason_first = $this->input->post('not_tested_reason_first');
            $administrator = $this->input->post('administrator');
            $notes_first = $this->input->post('notes_first');

            $test_date_second = $this->input->post('test_date_second');
            $pals_upper = $this->input->post('pals_upper');
            $pals_lower = $this->input->post('pals_lower');
            $pals_letter_sounds = $this->input->post('pals_letter_sounds');
            $topel_elindex_second = $this->input->post('topel_elindex_second');
            $not_tested_reason_second = $this->input->post('not_tested_reason_second');
            $administrator_second = $this->input->post('administrator_second');
            $notes_second = $this->input->post('notes_second');


            ///database transaction start
            $this->db->trans_start();
            //get registered renters and landlords details
            $body_data['student_update_data'] = $this->dataentry_model->update_student_data($student_get_id, $student_name, $test_date_first, $topel_pkss, $topel_dvss, $topel_pass, $topel_elindex, $not_tested_reason_first, $administrator, $notes_first,
                  $test_date_second,$pals_upper,$pals_lower,$pals_letter_sounds,$topel_elindex_second,$not_tested_reason_second,$administrator_second,$notes_second);

            $this->db->trans_complete();
            //database transaction end

            if ($this->db->trans_status() == TRUE) {
                $this->session->set_flashdata('success_message', 'Student Data  has been successfully updated.');
                //redirect('popup/popup_message');
                // $this->load->view('staff/dataentry/dataentry_view', $body_data);
            } else {

                $this->session->set_flashdata('error_message', 'Student Data has been not updated.');
                // $this->load->view('staff/dataentry/dataentry_view', $body_data);
            }
        } else if (!isset($_POST["editstudentForm"])) {
            $school = $this->input->post('school_id');
            $enrollstatus = $this->input->post('status_id');
            $preclass = $this->input->post('preclass_id');


            //get registered renters and landlords details
            $body_data['search_student_data'] = $this->dataentry_model->search_student_list($school, $enrollstatus, $preclass);
        }



        $data = array();
        $data['schools'] = $this->dataentry_model->get_schools();
        $data['status1'] = $this->dataentry_model->get_school_status();
        $body_data['get_all_student_data'] = $this->dataentry_model->get_all_student_list();

        $this->template->write_view('content', 'staff/dataentry/dataentry_view', $body_data, TRUE);
        $this->template->write_view('content', 'staff/dataentry/dataentry_view', $data, TRUE);
        $this->template->render();
    }

   

   /*private function admin_check_isvalidated() {
        $admin_logged_in = $this->session->userdata('admin_logged_in');
        $admin_role = $this->session->userdata('admin_role_id');

        if (($admin_logged_in == FALSE) || ($admin_role == NULL)) {

            $this->session->set_flashdata('error_message', 'Please login to access this page.');
            redirect('admin_area/index');
        }
    }*/

}

/* End of file List_renters.php */
/* Location: ./application/controllers/admin_area/List_renters.php */
?>

