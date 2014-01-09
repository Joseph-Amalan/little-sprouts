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
                // $this->load->view('admin_area/dataentry/dataentry_view', $body_data);
            } else {

                $this->session->set_flashdata('error_message', 'Student Data has been not updated.');
                // $this->load->view('admin_area/dataentry/dataentry_view', $body_data);
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

        $this->admin_template->write_view('content', 'admin_area/dataentry/dataentry_view', $body_data, TRUE);
        $this->admin_template->write_view('content', 'admin_area/dataentry/dataentry_view', $data, TRUE);
        $this->admin_template->render();
    }

    /* function data_entry_edit_form_submit() {

      if ($_POST) {

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

      ///database transaction start
      $this->db->trans_start();
      //get registered renters and landlords details
      $body_data['student_update_data'] = $this->dataentry_model->update_student_data($student_get_id, $student_name, $test_date_first, $topel_pkss, $topel_dvss, $topel_pass, $topel_elindex, $not_tested_reason_first, $administrator, $notes_first);

      $this->db->trans_complete();
      //database transaction end

      if ($this->db->trans_status() == TRUE) {
      $this->session->set_flashdata('success_message', 'Student Data  has been successfully updated.');
      //redirect('popup/popup_message');
      // $this->load->view('admin_area/dataentry/dataentry_view', $body_data);
      } else {

      $this->session->set_flashdata('error_message', 'Student Data has been not updated.');
      // $this->load->view('admin_area/dataentry/dataentry_view', $body_data);
      }


      $data = array();
      $data['schools'] = $this->dataentry_model->get_schools();
      $data['status1'] = $this->dataentry_model->get_school_status();
      $body_data['get_all_student_data'] = $this->dataentry_model->get_all_student_list();

      $this->admin_template->write_view('content', 'admin_area/dataentry/dataentry_view', $body_data, TRUE);
      $this->admin_template->write_view('content', 'admin_area/dataentry/dataentry_view', $data, TRUE);
      $this->admin_template->render();
      }
      } */

    /* function view_profile($user_id, $user_email) {
      $body_data = array();
      $body_data['renters_data'] = $this->renter_model->get_list_renter_details($this->admin_id, $this->admin_email, $this->admin_role_id, $user_id, $user_email);

      $this->admin_popup_template->write_view('content', 'admin_area/renter/profile_view', $body_data, TRUE);
      $this->admin_popup_template->render();
      }

      function edit_profile($user_id, $user_email) {
      $body_data = array();

      //SELECTING States
      $body_data['states'] = $this->admin_model->get_states();
      $body_data['renters_data'] = $this->renter_model->get_list_renter_details($this->admin_id, $this->admin_email, $this->admin_role_id, $user_id, $user_email);

      $body_data['user_id'] = $user_id;
      $body_data['user_email'] = $user_email;

      $this->form_validation->set_rules('renterFirstName', 'First Name', 'trim|required|alpha|max_length[90]|xss_clean');
      $this->form_validation->set_rules('rentetMiddleName', 'Middle Name', 'trim|alpha|max_length[90]|xss_clean');
      $this->form_validation->set_rules('renterLastName', 'Last Name', 'trim|required|alpha|max_length[90]|xss_clean');
      $this->form_validation->set_rules('renterSuffix', 'Suffix', 'trim|required|max_length[10]|xss_clean');
      $this->form_validation->set_rules('renterMobilePhone', 'Mobile Phone', 'trim|required|max_length[40]|phone_custom|xss_clean');
      $this->form_validation->set_rules('renterHomePhone', 'Home Phone', 'trim|required|max_length[40]|phone_custom|xss_clean');
      $this->form_validation->set_rules('renterWorkPhone', 'Work Phone', 'trim|required|max_length[40]|phone_custom|xss_clean');
      $this->form_validation->set_rules('renterSsn', 'SSN', 'trim|required|max_length[50]|ssn_custom|xss_clean');
      $this->form_validation->set_rules('renterDob', 'date of birth', 'trim|required|max_length[50]|date_custom|xss_clean');

      $this->form_validation->set_rules('renterLeaseStartDate', 'Lease Start Date', 'trim|required|max_length[50]|date_custom|callback_grater_then_date_check|xss_clean');
      $this->form_validation->set_rules('renterLeaseEndDate', 'Lease End Date', 'trim|required|max_length[50]|date_custom|xss_clean');
      $this->form_validation->set_rules('renterMonthlyLeaseAmount', 'monthly lease amount', 'trim|required|callback_numaric_decimal_value_custom|xss_clean');
      $this->form_validation->set_rules('renterRentDueDate', 'Rent Due Date', 'trim|required|max_length[10]|xss_clean');
      $this->form_validation->set_rules('renterAddressL1', 'Address Line#1', 'trim|required|max_length[200]|xss_clean');
      $this->form_validation->set_rules('renterAddressL2', 'Address Line#2', 'trim|required|max_length[200]|xss_clean');
      $this->form_validation->set_rules('renterCity', 'City', 'trim|required|max_length[100]|alpha_space_custom|xss_clean');
      $this->form_validation->set_rules('renterZipCode', 'Zip Code', 'trim|required|max_length[50]|xss_clean');
      $this->form_validation->set_rules('renterState', 'State', 'trim|required|max_length[5]|xss_clean');

      $this->form_validation->set_rules('landlordFirstName', 'Landlord First Name', 'trim|required|alpha|max_length[90]|xss_clean');
      $this->form_validation->set_rules('landlordLasttName', 'Landlord Middle Name', 'trim|alpha|max_length[90]|xss_clean');
      $this->form_validation->set_rules('landlordEmail', 'Landlord Email Address', 'trim|required|valid_email|max_length[150]|xss_clean');
      $this->form_validation->set_rules('landlordPropertyName', 'Landlord Property Name', 'trim|required|max_length[250]|xss_clean');
      $this->form_validation->set_rules('landlordOffPhone', 'Landlord Phone', 'trim|required|max_length[40]|phone_custom|xss_clean');

      $this->form_validation->set_rules('landlordOffAddressL1', 'Address Line#1', 'trim|required|max_length[200]|xss_clean');
      $this->form_validation->set_rules('landlordOffAddressL2', 'Address Line#2', 'trim|max_length[200]|xss_clean');
      $this->form_validation->set_rules('landlordOffCity', 'City', 'trim|required|max_length[100]|alpha_space_custom|xss_clean');
      $this->form_validation->set_rules('landlordOffZipCode', 'Zip Code', 'trim|required|max_length[50]|xss_clean');
      $this->form_validation->set_rules('landlordOffState', 'State', 'trim|required|max_length[5]|xss_clean');

      if ($this->form_validation->run() == FALSE) {
      $this->load->view('admin_area/renter/profile_edit_view', $body_data);
      } else {

      $renter_first_name = $this->input->post('renterFirstName');
      $renter_middle_name = $this->input->post('rentetMiddleName');
      $renter_last_name = $this->input->post('renterLastName');
      $renter_suffix = $this->input->post('renterSuffix');
      $renter_mobile_phone = $this->input->post('renterMobilePhone');
      $renter_home_phone = $this->input->post('renterHomePhone');
      $renter_work_phone = $this->input->post('renterWorkPhone');
      $renter_ssn = $this->input->post('renterSsn');

      $old_dob = $this->input->post('renterDob'); //mm-dd-yyyy
      $old_dob_arr = explode('/', $old_dob);
      $renter_dob = $old_dob_arr[2] . '-' . $old_dob_arr[0] . '-' . $old_dob_arr[1]; // yyyy-mm-dd

      $old_lease_start_date = $this->input->post('renterLeaseStartDate'); //mm-dd-yyyy
      $lease_start_arr = explode('/', $old_lease_start_date);
      $renter_lease_start_date = $lease_start_arr[2] . '-' . $lease_start_arr[0] . '-' . $lease_start_arr[1]; // yyyy-mm-dd

      $old_lease_end_date = $this->input->post('renterLeaseEndDate'); //mm-dd-yyyy
      $lease_end_arr = explode('/', $old_lease_end_date);
      $renter_lease_end_date = $lease_end_arr[2] . '-' . $lease_end_arr[0] . '-' . $lease_end_arr[1]; // yyyy-mm-dd

      $renter_monthly_lease_amount = $this->input->post('renterMonthlyLeaseAmount');
      $renter_rent_due_date = $this->input->post('renterRentDueDate');

      $renter_ad_l1 = $this->input->post('renterAddressL1');
      $renter_ad_l2 = $this->input->post('renterAddressL2');
      $renter_city = $this->input->post('renterCity');
      $renter_state_id = $this->input->post('renterState');
      $renter_zip = $this->input->post('renterZipCode');

      $landlord_first_name = $this->input->post('landlordFirstName');
      $landlord_last_name = $this->input->post('landlordLastName');
      $landlord_email = $this->input->post('landlordEmail');
      $landlord_phone = $this->input->post('landlordOffPhone');
      $landlord_property_name = $this->input->post('landlordPropertyName');

      $landlord_off_ad_11 = $this->input->post('landlordOffAddressL1');
      $landlord_off_ad_12 = $this->input->post('landlordOffAddressL2');
      $landlord_0ff_city = $this->input->post('landlordOffCity');
      $landlord_off_zip = $this->input->post('landlordOffZipCode');
      $landlord_off_state_id = $this->input->post('landlordOffState');

      ///database transaction start
      $this->db->trans_start();

      $this->renter_model->update_renter_data($user_id, $user_email, $this->admin_id, $this->admin_email, $this->admin_role_id, $renter_first_name, $renter_middle_name, $renter_last_name, $renter_suffix, $renter_mobile_phone, $renter_home_phone, $renter_work_phone, $renter_ssn, $renter_dob);

      $this->renter_model->update_landlord_renter_association($user_id, $user_email, $this->admin_id, $this->admin_email, $this->admin_role_id, $renter_lease_start_date, $renter_lease_end_date, $renter_monthly_lease_amount, $renter_rent_due_date, $renter_ad_l1, $renter_ad_l2, $renter_city, $renter_state_id, $renter_zip, $landlord_first_name, $landlord_last_name, $landlord_email, $landlord_phone, $landlord_property_name, $landlord_off_ad_11, $landlord_off_ad_12, $landlord_0ff_city, $landlord_off_zip, $landlord_off_state_id);

      $this->db->trans_complete();
      //database transaction end

      if ($this->db->trans_status() == TRUE) {
      $this->session->set_flashdata('success_message', 'Your profile has been successfully updated.');
      redirect('popup/popup_message');
      } else {

      $this->session->set_flashdata('error_message', 'Your profile has been successfully updated.');
      $this->load->view('admin_area/renter/profile_edit_view', $body_data);
      }
      }
      }

      function delete_profile($user_id, $user_email) {

      $body_data = array();
      $body_data['user_id'] = $user_id;
      $body_data['user_email'] = $user_email;

      $this->form_validation->set_rules('userAccountDeleteReason', 'reason for delete account', 'trim|required|max_length[1000]|xss_clean');

      if ($this->form_validation->run() == FALSE) {

      $this->admin_popup_template->write_view('content', 'admin_area/renter/account_delete_view', $body_data, TRUE);
      $this->admin_popup_template->render();
      } else {
      $user_account_delete_reason = $this->input->post('userAccountDeleteReason');

      //database transaction start
      $this->db->trans_start();

      $this->renter_model->cancel_landlord_renter_association_data($this->admin_id, $this->admin_email, $this->admin_role_id, $user_id, $user_email);
      $this->renter_model->cancel_user_data($this->admin_id, $this->admin_email, $this->admin_role_id, $user_id, $user_email, $user_account_delete_reason);

      $this->db->trans_complete();
      //database transaction end

      if ($this->db->trans_status() == TRUE) {

      // send an email
      $this->load->library('email');

      $this->email->from('selvem.jose@gmail.com', 'Inspire Credit');
      $this->email->to($user_email);
      $this->email->subject("Your Inspire Credit Account Cancelled - By credit Inspire Admin");

      $this->email->message($this->load->view('admin_area/emails/cancel-account-html'));

      if ($this->email->send()) {
      $this->session->set_flashdata('success_message', 'User profile has been successfully Deleted.');
      redirect('popup/popup_message');
      }
      } else {

      $this->session->set_flashdata('error_message', 'Opps!! some error occur while updating your profile.');
      redirect('popup/popup_message');
      }
      }
      }

      function ip_edit($user_id, $user_email) {
      $body_data = array();
      $body_data['user_id'] = $user_id;
      $body_data['user_email'] = $user_email;
      $body_data['renters_data'] = $this->renter_model->get_list_renter_details($this->admin_id, $this->admin_email, $this->admin_role_id, $user_id, $user_email);

      $this->form_validation->set_rules('userIpStatus', 'IP adress', 'trim|required|xss_clean');
      $this->form_validation->set_rules('userIpblockReason', 'IP address block reason', 'trim|required|max_length[1000]|xss_clean');

      if ($this->form_validation->run() == FALSE) {

      $this->admin_popup_template->write_view('content', 'admin_area/renter/ip_edit_view', $body_data, TRUE);
      $this->admin_popup_template->render();
      } else {
      $user_ip_status = $this->input->post('userIpStatus');
      $user_ipblock_reason = $this->input->post('userIpblockReason');
      $update_ip_status = $this->admin_model->update_ip_status($this->admin_id, $this->admin_email, $this->admin_role_id, $user_id, $user_email, $user_ip_status, $user_ipblock_reason);

      if ($update_ip_status == TRUE) {
      $this->session->set_flashdata('success_message', 'User profile has been successfully updated.');
      redirect('popup/popup_message');
      } else {

      $this->session->set_flashdata('error_message', 'Opps!! some error occur while updating your profile.');
      redirect('popup/popup_message');
      }
      }
      }

      function user_edit_account_status($user_id, $user_email) {
      $body_data = array();
      $body_data['user_id'] = $user_id;
      $body_data['user_email'] = $user_email;
      $body_data['renters_data'] = $this->renter_model->get_list_renter_details($this->admin_id, $this->admin_email, $this->admin_role_id, $user_id, $user_email);

      $this->form_validation->set_rules('userAccountStatus', 'account status', 'trim|required|xss_clean');
      $this->form_validation->set_rules('inactiveAccountReaons', 'Reason', 'trim|required|max_length[1000]|xss_clean');

      if ($this->form_validation->run() == FALSE) {
      $this->admin_popup_template->write_view('content', 'admin_area/renter/user_edit_account_status_view', $body_data, TRUE);
      $this->admin_popup_template->render();
      } else {
      $user_account_status = $this->input->post('userAccountStatus');

      // ----- remove control characters -----
      $reaons = strip_tags($this->input->post('inactiveAccountReaons'));
      $reaons = str_replace("\r", ' ', $reaons);     // --- replace with empty space
      $reaons = str_replace("\n", ' ', $reaons);    // --- replace with space
      $inactive_account_reaons = str_replace("\t", ' ', $reaons);   // --- replace with space


      $update_user_account_status = $this->admin_model->update_user_account_status($this->admin_id, $this->admin_email, $this->admin_role_id, $user_id, $user_email, $user_account_status, $inactive_account_reaons);

      if ($update_user_account_status == TRUE) {
      $this->session->set_flashdata('success_message', 'User profile has been successfully updated.');
      redirect('popup/popup_message');
      } else {

      $this->session->set_flashdata('error_message', 'Opps!! some error occur while updating your profile.');
      redirect('popup/popup_message');
      }
      }
      }

      public function grater_then_date_check() {

      $date1 = DateTime::createFromFormat('m/d/Y', $this->input->post('renterLeaseStartDate'));
      $date2 = DateTime::createFromFormat('m/d/Y', $this->input->post('renterLeaseEndDate'));
      date_format($date1, 'Y/m/d');
      date_format($date2, 'Y/m/d');

      if ($date1 >= $date2) {
      $error_message = 'The lease start Date must be less than the end lease end Date.';
      $this->form_validation->set_message('grater_then_date_check', $error_message);

      return FALSE;
      } else {
      return TRUE;
      }
      }

      function numaric_decimal_value_custom($str) {
      if (ctype_alpha($str)) {

      $this->form_validation->set_message('numaric_decimal_value_custom', 'The %s field should be number');
      return FALSE;
      } elseif (!(is_numeric($str) || preg_match('/^\d+(\.\d+)?$/', $str))) {

      $this->form_validation->set_message('numaric_decimal_value_custom', 'The %s field should be number');
      return FALSE;
      } else if ($str <= 0) {
      $this->form_validation->set_message('numaric_decimal_value_custom', 'The %s field should be positive value');
      return FALSE;
      } else {
      return TRUE;
      }
      } */

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

