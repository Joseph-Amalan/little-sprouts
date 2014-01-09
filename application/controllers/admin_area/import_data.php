<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Import_data extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->library('admin_template');
        $this->load->library('excel');
        $this->admin_check_isvalidated();
        $this->load->model('admin_area/import/import_model');
        $this->load->library('admin_popup_template');

        //get admin data from session  		
        $this->admin_id = $this->session->userdata('admin_id');
        $this->admin_email = $this->session->userdata('admin_email');
        $this->admin_role_id = $this->session->userdata('admin_role_id');

        $this->load->model('admin_area/admin/admin_model');
        $this->load->model('admin_area/renter/renter_model');
        $this->load->model('admin_area/dataentry/dataentry_model');

        //basic info for the header		 
        $this->admin_template->write('title', 'Admin Little Sprouts - Import Data');

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

        redirect('admin_area/import_data/import_data_db');
    }
function import_data_db() {
        $body_data = array();
        $instance_id = $this->input->post('selectinstance_name');
        
        
       // if(($_POST) && (($instance_id)>='0')){
           if($_POST){ 
               if(($instance_id)<=0){
              $this->session->set_flashdata('error_message', 'Please select Instance file.');
                redirect('admin_area/import_data/import_data_db'); 
             
               }               
            $exc = date('dMY');
            $inputFileName = $_FILES['import_data_file']['tmp_name'];
            $config['upload_path'] = '/home/knsclients/littlesprouts/uploads/';
//                        $config['upload_path'] = $this->config->config['approot'].'/uploads/';

            $inputFileName = $exc . '_' . $_FILES['import_data_file']['name'];
            $_FILES['import_data_file']['name'] = $inputFileName;
            $pathInfo = pathinfo($inputFileName);
            //$tablename = $pathInfo['filename'];



            $sourceFile = $config['upload_path'] . $inputFileName;
            $config['allowed_types'] = 'xlsx|xls';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('import_data_file')) {

                $this->session->set_flashdata('error_message', 'Please Browse .xlsx / .xls file.');
                redirect('admin_area/import_data/import_data_db');
            } else {

                try {

                    $inputFileType = PHPExcel_IOFactory::identify($sourceFile);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($sourceFile);

                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $highestColumn = $sheet->getHighestColumn();

                    //$vals = $this->import_model->create_table($tablename);
                    $insertValue = 'VALUES ';
                    /*for ($row = 2; $row <= $highestRow; $row++) {
                        //  Read a row of data into an array
                        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                        $countColumn = count($rowData[0]);
                        $insertValue .= ' ( ';
                        $value_list = "'".$instance_id."', ";
                        for ($i = 0; $i < $countColumn; $i++) {
                            // $rowData[0][$i]=$sheet->getFormattedValue($rowData[0][$i]);
                            $cell = $sheet->getCellByColumnAndRow($i, $row);
                            $testInsertValues = $cell->getFormattedValue($rowData[0][$i]);
                            $testInsertValue = mysql_escape_string($testInsertValues);

                            $value_list .= "'" . $testInsertValue . "', ";
                        }
                        
                        $insertValue .= rtrim($value_list, ', ').' ), ';
                        // print_r($rowData);exit();
                        $this->db->trans_start();
                       // $val = $this->import_model->add_data($insertValue, $tablename);
                    }*/
					for ($row = 2; $row <= $highestRow; $row++) {
                        //  Read a row of data into an array
                        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                         $countColumn = count($rowData[0]);
                        $insertValue .= ' ( ';
                        $value_list = "'" . $instance_id . "', ";
                        for ($i = 0; $i < $countColumn; $i++) {
                            $cell = $sheet->getCellByColumnAndRow($i, $row);
                            if (PHPExcel_Shared_Date::isDateTime($sheet->getCellByColumnAndRow($i, $row))) {

                                $testInsertValues = PHPExcel_Shared_Date::ExcelToPHPObject($sheet->getCellByColumnAndRow($i, $row)->getValue())->format('Y-m-d');
                            } else {
                                $testInsertValues = $cell->getFormattedValue($rowData[0][$i]);
                            }

                            // $rowData[0][$i]=$sheet->getFormattedValue($rowData[0][$i]);


                            $testInsertValue = mysql_escape_string($testInsertValues);

                            $value_list .= "'" . $testInsertValue . "', ";
                        }
                        //exit();

                        $insertValue .= rtrim($value_list, ', ') . ' ), ';
                        //print_r($rowData);exit();
                        $this->db->trans_start();
                        // $val = $this->import_model->add_data($insertValue, $tablename);
                    }
                    $insertValue = rtrim($insertValue, ', ').';';
                    
                    $val = $this->import_model->add_data($insertValue,$instance_id);
                    $this->db->trans_complete();
                    //database transaction end
                    $body_data = array();
                    if ($this->db->trans_status() == TRUE) {
                        $this->session->set_flashdata('success_message', 'Your file has been successfully updated into Database.');
                        redirect('admin_area/import_data/import_data_db');
                    } else {

                        $this->session->set_flashdata('error_message', 'Your file has not updated successfully .');
                        redirect('admin_area/import_data/import_data_db');
                    }
                } catch (Exception $e) {
                    $this->session->set_flashdata('error_message', 'Error loading file "' . pathinfo($sourceFile, PATHINFO_BASENAME));
                    
                    //$this->session->set_flashdata('error_message', 'Error loading file "' . pathinfo($sourceFile, PATHINFO_BASENAME) . '": ' . $e->getMessage());
                        redirect('admin_area/import_data/import_data_db');
                    //echo
                   // die('Error loading file "' . pathinfo($sourceFile, PATHINFO_BASENAME) . '": ' . $e->getMessage());
                }
            }
              }          
        
       
        
        $body_data['instances'] = $this->import_model->get_instance_data();

        $this->admin_template->write_view('content', 'admin_area/import_data/import_data_view', $body_data, TRUE);
        $this->admin_template->render();
    }
    

    function create_profile() {
        $body_data = array();

        //SELECTING States
        $body_data['schools'] = $this->dataentry_model->get_schools();
        $body_data['status1'] = $this->dataentry_model->get_school_status();
        
        $instance_id = $this->input->post('instancehiddenid');
             $body_data['instance_id'] = $instance_id;
        

       $this->form_validation->set_rules('studentId', 'Child ID', 'trim|required|numeric|max_length[90]|xss_clean');
        $this->form_validation->set_rules('studentFirstName', 'First Name', 'trim|required|alpha|max_length[90]|xss_clean');
        $this->form_validation->set_rules('studentLastName', 'Last Name', 'trim|required|alpha|max_length[90]|xss_clean');
        $this->form_validation->set_rules('childGender', 'Gender', 'trim|required|max_length[10]|xss_clean');
        $this->form_validation->set_rules('voucherNumber', 'voucherNumber', 'trim|required|max_length[40]|xss_clean');
        $this->form_validation->set_rules('childdob', 'Date Of Birth', 'trim|required|xss_clean');
        $this->form_validation->set_rules('childschoolname', 'School Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('childschoolcode', 'School Code', 'trim|required|max_length[50]|xss_clean');
        $this->form_validation->set_rules('statusdate', 'Status Date', 'trim|required|xss_clean');

        $this->form_validation->set_rules('enrollmentstatus', 'Enrollment Status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('childclassname', 'Class Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('childclassid', 'Class Room Id', 'trim|required|xss_clean');
       

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin_area/import_data/create_student_view', $body_data);
        } else {

             $instance_id = $this->input->post('instancehiddenid');
            $studentId = $this->input->post('studentId');
            $studentFirstName = $this->input->post('studentFirstName');
            $studentLastName = $this->input->post('studentLastName');
            $childGender = $this->input->post('childGender');
            $voucherNumber = $this->input->post('voucherNumber');
            $childdob = $this->input->post('childdob');
            $childschoolname = $this->input->post('childschoolname');
            $childschoolcode = $this->input->post('childschoolcode');
            $statusdate = $this->input->post('statusdate');  
            $enrollmentstatus = $this->input->post('enrollmentstatus');  
            $childclassname = $this->input->post('childclassname'); 
			 $childclassid = $this->input->post('childclassid'); 
            

            ///database transaction start
            $this->db->trans_start();
            
            $val = $this->import_model->add_student_data($instance_id,$studentId,$studentFirstName,$studentLastName,$childGender,$voucherNumber,
                    $childdob,$childschoolname,$childschoolcode,$statusdate,$enrollmentstatus,$childclassname,$childclassid);

            
            $this->db->trans_complete();
            //database transaction end

            if ($this->db->trans_status() == TRUE) {
                $this->session->set_flashdata('success_message', 'Student Data has been successfully Inserted.');
                redirect('popup/popup_message');
            } else {

                $this->session->set_flashdata('error_message', 'Student Data has not been successfully Inserted.');
                $this->load->view('admin_area/import_data/create_student_view', $body_data);
            }
        }
    }

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
      }
     */

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

