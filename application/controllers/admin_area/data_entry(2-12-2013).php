<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_entry extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->library('admin_template');
        // $this->load->library('excel');
        $this->admin_check_isvalidated();
        $this->load->model('admin_area/dataentry/dataentry_model');
        $this->load->library('admin_popup_template');

        //get admin data from session  		
        $this->admin_id = $this->session->userdata('admin_id');
        $this->admin_email = $this->session->userdata('admin_email');
        $this->admin_role_id = $this->session->userdata('admin_role_id');
		$this->admin_username = $this->session->userdata('admin_username');

        $this->load->model('admin_area/admin/admin_model');
        $this->load->model('admin_area/renter/renter_model');

        //basic info for the header		 
        $this->admin_template->write('title', 'Admin Little Sprouts - Data Entry');

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
        redirect('admin_area/data_entry/getschool_list');
    }

    function getschool_list() {
        $data = array();
        $data['schools'] = $this->dataentry_model->get_schools();
        $data['status1'] = $this->dataentry_model->get_school_status();
		          $data['instances'] = $this->dataentry_model->get_instance_data();

        if (!$_POST) {

            $body_data['get_all_student_data'] = $this->dataentry_model->get_all_student_list();
            $this->admin_template->write_view('content', 'admin_area/dataentry/dataentry_view', $body_data, TRUE);
        }


        $this->admin_template->write_view('content', 'admin_area/dataentry/dataentry_view', $data, TRUE);
        $this->admin_template->render();
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
        $this->admin_template->write_view('content', 'admin_area/dataentry/dataentry_view', $body_data, TRUE);
        $this->admin_template->render();
    }

    function data_entry_get_all_student() {

        /* $this->form_validation->set_rules('schools', 'UserRole', 'trim|required');
          $this->form_validation->set_rules('preclasses', 'UserRole', 'trim|required');
          $this->form_validation->set_rules('status1', 'UserRole', 'trim|required');
          exit(); */

        $get_school_id = $this->input->post('get_school_id');
        $get_class_id = $this->input->post('get_class_id');
        $get_status_id = $this->input->post('get_status_id');
		 $get_instance_id = $this->input->post('get_instance_id');


        $body_data = array();
        echo(json_encode($this->dataentry_model->get_search_all_student_list($get_school_id, $get_class_id, $get_status_id,
$get_instance_id)));
    }

    function data_entry_form_submit() {
        $get_student_data = array();
        $body_data = array();
$UserName= $this->admin_username;
        $get_student_data = ($_POST);

//print_r($_POST);

        $recordcount = $get_student_data['recordcount'];
		  $teachername1 = $get_student_data['teachernamefirst'];
        $teachername2 = $get_student_data['teachernamesecond'];
        $teachername3 = $get_student_data['teachernamethird'];
        $coachername = $get_student_data['coacher_name'];
       $directorname = $get_student_data['director_name'];
	   
	   $TeacherInsertId = $this->dataentry_model->insert_teacher_data($teachername1,$teachername2,$teachername3,$coachername,$directorname);
        

        for ($i = 0; $i <= $recordcount; $i++) {


            $updateArray[] = array(
                'child_id' => $get_student_data["input_child_id_{$i}"],
                'date_of_birth' => $get_student_data["input_student_dob_{$i}"],
                'test_date_first' => $get_student_data["input_test_date_first_{$i}"],
                'topel_pkss' => $get_student_data["input_topel_pkss_{$i}"],
                'topel_dvss' => $get_student_data["input_topel_dvss_{$i}"],
                'topel_pass' => $get_student_data["input_topel_pass_{$i}"],
                'topel_elindex' => $get_student_data["input_topel_elindex_{$i}"],
                'not_tested_reason_first' => $get_student_data["input_not_tested_reason_first_{$i}"],
                'administrator' => $get_student_data["input_administrator_{$i}"],
                'notes_first' => $get_student_data["input_notes_first_{$i}"],
                'status_date' => $get_student_data["input_status_date_{$i}"],
                'test_date_second' => $get_student_data["input_test_date_second_{$i}"],
                'pals_upper' => $get_student_data["input_pals_upper_{$i}"],
                'pals_lower' => $get_student_data["input_pals_lower_{$i}"],
                'pals_letter_sounds' => $get_student_data["input_pals_letter_sounds_{$i}"],
                'not_tested_reason_second' => $get_student_data["input_not_tested_reason_second_{$i}"],
                'administrator_second' => $get_student_data["input_administrator_second_{$i}"],
                'notes_second' => $get_student_data["input_notes_second_{$i}"],
				 'teacher_id'=>      $TeacherInsertId,
				   'modified_by' => $UserName
				 /*'teacher1_name' => $get_student_data['teachername1'],
                        'teacher2_name' => $get_student_data['teachername2'],
                        'teacher3_name' => $get_student_data['teachername3'],
                        'coachername' => $get_student_data['coachername'],
                        'directorname' => $get_student_data['directorname']*/
            );


      $val =    $this->db->update_batch('student_details',$updateArray, 'child_id'); 


            /*$student_get_id = $get_student_data["input_child_id_{$i}"];
            $student_name = $get_student_data["input_student_name_{$i}"];
            $student_dob = $get_student_data["input_student_dob_{$i}"];
            $test_date_first = $get_student_data["input_test_date_first_{$i}"];
            $topel_pkss = $get_student_data["input_topel_pkss_{$i}"];
            $topel_dvss = $get_student_data["input_topel_dvss_{$i}"];
            $topel_pass = $get_student_data["input_topel_pass_{$i}"];
            $topel_elindex = $get_student_data["input_topel_elindex_{$i}"];
            $not_tested_reason_first = $get_student_data["input_not_tested_reason_first_{$i}"];
            $administrator = $get_student_data["input_administrator_{$i}"];
            $notes_first = $get_student_data["input_notes_first_{$i}"];
            $status_date = $get_student_data["input_status_date_{$i}"];
            $test_date_second = $get_student_data["input_test_date_second_{$i}"];
            $pals_upper = $get_student_data["input_pals_upper_{$i}"];
            $pals_lower = $get_student_data["input_pals_lower_{$i}"];
            $pals_letter_sounds = $get_student_data["input_pals_letter_sounds_{$i}"];
            $not_tested_reason_second = $get_student_data["input_not_tested_reason_second_{$i}"];
            $administrator_second = $get_student_data["input_administrator_second_{$i}"];
            $notes_second = $get_student_data["input_notes_second_{$i}"];*/





           // $this->db->where('child_id', $student_get_id);
           // $val = $this->db->update('student_details', $student_get_id, $student_name, $student_dob, $test_date_first, $topel_pkss, $topel_dvss, $topel_pass, $topel_elindex, $not_tested_reason_first, $administrator, $notes_first, $status_date, $test_date_second, $pals_upper, $pals_lower, $pals_letter_sounds, $not_tested_reason_second, $administrator_second, $notes_second);


            // $this->db->trans_start(); 
            //$val = $this->dataentry_model->update_student_data($student_get_id, $student_name, $student_dob, $test_date_first, $topel_pkss, $topel_dvss, $topel_pass, $topel_elindex, $not_tested_reason_first, $administrator, $notes_first, $status_date, $test_date_second, $pals_upper, $pals_lower, $pals_letter_sounds, $not_tested_reason_second, $administrator_second, $notes_second);
            // echo(json_encode($this->dataentry_model->update_student_data($student_get_id, $student_name, $student_dob, $test_date_first, $topel_pkss, $topel_dvss, $topel_pass, $topel_elindex, $not_tested_reason_first, $administrator, $notes_first, $status_date, $test_date_second, $pals_upper, $pals_lower, $pals_letter_sounds, $not_tested_reason_second, $administrator_second, $notes_second)));
        }
        // $this->db->trans_complete();
        echo(json_encode($val));
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

