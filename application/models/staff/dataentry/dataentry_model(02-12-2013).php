<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dataentry_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();

        // Connect to database
        $this->load->database();
    }

    /**
     * This funtion will return me the result of all the states.
     * This has to be unique because the states will be repeating.
     */
    
     function get_schools($user_id) {
     
        $schools = array();
        $query_user = $this->db->query("SELECT  assign_school  FROM user_detail WHERE id = $user_id ");
		
		if ($query_user->num_rows() == 1){
			
				$row = $query_user->row();    
				$assignSchools = $row->assign_school;
                }
                $assignSchoolslist = substr($assignSchools, 1);
       
                

  $schoolslist = explode(",", $assignSchoolslist);


           foreach ($schoolslist as $school) {
                $schools[$school] = $school;
            }
            return $schools;

         
       
    }
function insert_teacher_data($teachername1, $teachername2, $teachername3, $coachername, $directorname) {

    
        
        if ($teachername1 !='') {
            $teacher1name = explode(" ", $teachername1);
            $teacher1_firstname = $teacher1name[0];
            $teacher1_lastname = $teacher1name[1];
        } else {
           
            $teacher1_firstname = '';
            $teacher1_lastname = '';
        }

       
        if ($teachername2 !='') {
            $teacher2name = explode(" ", $teachername2);
            $teacher2_firstname = $teacher2name[0];
            $teacher2_lastname = $teacher2name[1];
        } else {
            
            $teacher2_firstname = '';
            $teacher2_lastname = '';
        }

       
        if ($teachername3 !='') {
            $teacher3name = explode(" ", $teachername3);
            $teacher3_firstname = $teacher3name[0];
            $teacher3_lastname = $teacher3name[1];
        } else {
           
            $teacher3_firstname = '';
            $teacher3_lastname = '';
        }
        
        if ($coachername !='') {
            $coacher1name = explode(" ", $coachername);
            $coacher_firstname = $coacher1name[0];
            $coacher_lastname = $coacher1name[1];
        } else {
            $coacher_firstname = '';
            $coacher_lastname = '';
        }

       
        if ($directorname !='') {
            $director1name = explode(" ", $directorname);
            $director_firstname = $director1name[0];
            $director_lastname = $director1name[1];
        } else {
            $director_firstname = '';
            $director_lastname = '';
        }
           
                         
        $result = $this->db->query("INSERT INTO teacher_details(teacher1_firstname,teacher1_lastname,teacher2_firstname,teacher2_lastname,teacher3_firstname,teacher3_lastname,coacher_firstname,coacher_lastname,director_firstname,director_lastname) VALUES 
('" . $teacher1_firstname . "','" . $teacher1_lastname . "','" . $teacher2_firstname . "','" . $teacher2_lastname . "','" . $teacher3_firstname . "','" . $teacher3_lastname . "',
      '" . $coacher_firstname . "','" . $coacher_lastname . "',   '" . $director_firstname . "','" . $director_lastname . "'  )");

        $lastInsertID = mysql_insert_id();
     
        if ($result) {
            return $lastInsertID;
        } else {
            return false;
        }
    }
     function get_instance_data() {
        $query = $this->db->query("SELECT  distinct(instance_name),instance_id  FROM instance_details");
        return $query->result();
    }
    function get_classes($schoolname) {
        // echo $schoolname;

        $query = $this->db->query("SELECT distinct(primary_classroom)  FROM student_details WHERE school_name = '{$schoolname}'");
        //print_r($query->result());
        $preclasses = array();

        if ($query->result()) {
            foreach ($query->result() as $preclass) {
                $preclasses[$preclass->primary_classroom] = $preclass->primary_classroom;
            }
            return $preclasses;
        } else {
            return FALSE;
        }
    }

    function get_school_status() {

        $query = $this->db->query("SELECT  distinct(enrollment_status)  FROM student_details where enrollment_status !=''");
        $status1 = array();

        if ($query->result()) {
            foreach ($query->result() as $status) {
                $status1[$status->enrollment_status] = $status->enrollment_status;
            }
            return $status1;
        } else {
            return FALSE;
        }
    }

    function get_student_list($school, $preclasses) {

        $query = $this->db->query("SELECT child_id,first_name,last_name FROM student_details 
						WHERE school_name='$school' AND primary_classroom='$preclasses'");
        //print_r($query->result());
        $students1 = array();

        if ($query->result()) {
            foreach ($query->result() as $student) {
                //$students1[$student->first_name] = $student->first_name;

                $studname = ($student->first_name) . ($student->last_name);
                $students1[$studname] = $studname;
            }
            return $students1;
        } else {
            return FALSE;
        }
    }

    function get_search_all_student_list($get_school_id, $get_class_id, $get_status_id,$get_instance_id) {

        /* $query = $this->db->query("SELECT child_id,first_name,last_name,date_of_birth,enrollment_status,primary_classroom,school_name FROM student_details 
          WHERE school_name='$school' AND primary_classroom='$preclass' AND enrollment_status='$enrollstatus'"); */

        $query = $this->db->query("SELECT * FROM student_details 
						WHERE school_name='$get_school_id' AND primary_classroom='$get_class_id' AND enrollment_status='$get_status_id' AND instance_id='$get_instance_id'");

        // print_r($query->result());
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function search_student_list($school, $enrollstatus, $preclass) {

        /* $query = $this->db->query("SELECT child_id,first_name,last_name,date_of_birth,enrollment_status,primary_classroom,school_name FROM student_details 
          WHERE school_name='$school' AND primary_classroom='$preclass' AND enrollment_status='$enrollstatus'"); */

        $query = $this->db->query("SELECT * FROM student_details 
						WHERE school_name='$school' AND primary_classroom='$preclass' AND enrollment_status='$enrollstatus'");

        // print_r($query->result());
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_all_student_list() {

        $query = $this->db->query("SELECT * FROM student_details 
						WHERE `school_name` !='' AND `primary_classroom` !='' AND `enrollment_status`!='' limit 0,10");

        /* $query = $this->db->query("SELECT child_id,first_name,last_name,date_of_birth,enrollment_status,test_date_first,topel_pkss,
          topel_dvss,topel_pass,topel_elindex,not_tested_reason_first,administrator,notes_first,school_name,primary_classroom FROM student_details
          WHERE `school_name` !='' AND `primary_classroom` !='' AND `enrollment_status`!='' limit 0,10"); */

        // print_r($query->result());
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_student($get_student_id) {

        $query = $this->db->query("SELECT * FROM student_details WHERE  child_id='$get_student_id'");

        // print_r($query->result());
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

  /* function update_student_data($get_student_data, $recordcount){
       
       for ($i = 0; $i < $recordcount; $i++) {
            $student_get_id = mysql_escape_string($get_student_data["input_child_id_{$i}"]);
            $student_name = mysql_escape_string($get_student_data["input_student_name_{$i}"]);
            $student_dob = mysql_escape_string($get_student_data["input_student_dob_{$i}"]);
            $test_date_first = mysql_escape_string($get_student_data["input_test_date_first_{$i}"]);
            $topel_pkss = mysql_escape_string($get_student_data["input_topel_pkss_{$i}"]);
            $topel_dvss = mysql_escape_string($get_student_data["input_topel_dvss_{$i}"]);
            $topel_pass = mysql_escape_string($get_student_data["input_topel_pass_{$i}"]);
            $topel_elindex = mysql_escape_string($get_student_data["input_topel_elindex_{$i}"]);
            $not_tested_reason_first = mysql_escape_string($get_student_data["input_not_tested_reason_first_{$i}"]);
            $administrator = mysql_escape_string($get_student_data["input_administrator_{$i}"]);
            $notes_first = mysql_escape_string($get_student_data["input_notes_first_{$i}"]);
            $status_date = mysql_escape_string($get_student_data["input_status_date_{$i}"]);
            $test_date_second = mysql_escape_string($get_student_data["input_test_date_second_{$i}"]);
            $pals_upper = mysql_escape_string($get_student_data["input_pals_upper_{$i}"]);
            $pals_lower = mysql_escape_string($get_student_data["input_pals_lower_{$i}"]);
            $pals_letter_sounds = mysql_escape_string($get_student_data["input_pals_letter_sounds_{$i}"]);
            $not_tested_reason_second = mysql_escape_string($get_student_data["input_not_tested_reason_second_{$i}"]);
            $administrator_second = mysql_escape_string($get_student_data["input_administrator_second_{$i}"]);
            $notes_second = mysql_escape_string($get_student_data["input_notes_second_{$i}"]);

           $this->db->trans_start(); 
             
             
             $result = $this->db->query("UPDATE student_details SET `test_date_first` = '" .$test_date_first. "', `topel_dvss` = '" .$topel_dvss. "',  `topel_pass` = '" .$topel_pass. "', `topel_elindex` = '" .$topel_elindex. "',`not_tested_reason_first` = '" .$not_tested_reason_first. "',
                `administrator` = '" .$administrator. "', `notes_first` = '" .$notes_first. "',`status_date` = '" .$status_date. "',`test_date_second` = '" .$test_date_second. "', 
                                `pals_upper` = '" .$pals_upper. "',`pals_lower` = '" .$pals_lower. "', `pals_letter_sounds` = '" .$pals_letter_sounds. "',
                                            `not_tested_reason_second` = '" .$not_tested_reason_second. "',
                                                `administrator_second` = '" .$administrator_second. "', 
                                                    `notes_second` = '" .$notes_second. "'
                                                        WHERE `child_id` = '" .$student_get_id. "'");
             
           
        
            
             $result = $this->db->query($sql);
                          
           echo $result;
        echo "<br>";
        return $result;
   }*/
    
 function update_student_data($student_get_id, $student_name, $student_dob, $test_date_first, $topel_pkss, $topel_dvss, $topel_pass, $topel_elindex, $not_tested_reason_first, $administrator, $notes_first, $status_date, $test_date_second, $pals_upper, $pals_lower, $pals_letter_sounds, $not_tested_reason_second, $administrator_second, $notes_second) {
        $result = $this->db->query("UPDATE student_details SET test_date_first = '" . $test_date_first . "',topel_pkss = '" . $topel_pkss . "',topel_dvss = '" . $topel_dvss . "', topel_pass = '" . $topel_pass . "',topel_elindex = '" . $topel_elindex . "',not_tested_reason_first = '" . $not_tested_reason_first . "',  administrator = '" . $administrator . "',notes_first = '" . $notes_first . "',status_date = '" . $status_date . "',test_date_second = '" . $test_date_second . "', pals_upper = '" . $pals_upper . "',pals_lower = '" . $pals_lower . "', pals_letter_sounds = '" . $pals_letter_sounds . "', not_tested_reason_second = '" . $not_tested_reason_second . "',administrator_second = '" . $administrator_second . "', notes_second = '" . $notes_second . "' WHERE child_id = '" . $student_get_id . "'");
        echo $result;
        echo "<br>";
        return $result;
    }
    
    

    /* function get_countries()
      {

      $query = $this->db->query("SELECT  distinct(country_name)  FROM state_city");
      $countries = array();

      if ($query->result()) {
      foreach ($query->result() as $country) {
      $countries[$country->country_name] = $country->country_name;
      }
      return $countries;
      } else {
      return FALSE;
      }
      } */
    /* function get_cities($country) {

      $query = $this->db->query("SELECT city_name, id FROM state_city WHERE country_name = '{$country}'");

      $cities = array();

      if ($query->result()) {
      foreach ($query->result() as $city) {
      $cities[$city->id] = $city->city_name;
      }
      return $cities;
      } else {
      return FALSE;
      }
      } */
    /* function get_unique_states() {
      $query = $this->db->query("SELECT DISTINCT state FROM state_city");

      if ($query->num_rows > 0) {
      return $query->result();
      }
      } */

    /**
     * This function will take the state as argument 
     * and then return the cities which fall under that particular state.
     */
    /* function get_list_renter_details($admin_id = NULL, $admin_email = NULL, $admin_role_id = NULL, $user_id = NULL, $user_email = NULL) 
      {
      $query = $this->db->query("SELECT admin_id,admin_role_id, admin_email FROM ls_admin WHERE admin_id = $admin_id AND admin_email = '".$admin_email."' AND admin_role_id = $admin_role_id");

      if ($query->num_rows() == 1){


      $query  = $this->db->query("select u.*, r.*, ra.*, rl.role_name, s.state_name, ls.state_name AS landlord_off_state_name FROM cr_users u
      INNER JOIN cr_renters AS r ON u.user_id = r.renter_user_id INNER JOIN cr_landlord_renter_association AS ra ON
      ra.renter_user_id = u.user_id INNER JOIN cr_roles AS rl ON u.user_role_id = rl.role_id INNER JOIN cr_states AS s ON
      s.state_id  = ra.renter_state_id INNER JOIN cr_states AS ls ON ls.state_id  = ra.landlord_off_state_id WHERE u.user_id = $user_id
      AND u.user_email = '". $user_email . "' AND ra.association_status = 1 AND u.user_account_status != -1 ");

      if($query->num_rows() == 1) {
      return $query->result();

      } else {
      return FALSE;
      }
      }
      return FALSE;
      }

      function update_renter_data ($user_id = NULL, $user_email = NULL, $admin_id = NULL, $admin_email = NULL, $admin_role_id = NULL,$renter_first_name = NULL,
      $renter_middle_name = NULL,$renter_last_name = NULL,$renter_suffix = NULL,$renter_mobile_phone = NULL,$renter_home_phone = NULL,$renter_work_phone = NULL,
      $renter_ssn = NULL,$renter_dob = NULL){

      $query = $this->db->query("SELECT admin_id, admin_role_id, admin_email FROM ls_admin WHERE admin_id = $admin_id AND admin_email = '".$admin_email."' AND admin_role_id = $admin_role_id");

      if ($query->num_rows() == 1){

      $query_user = $this->db->query("SELECT user_id, user_email FROM cr_users WHERE user_id = $user_id AND user_email = '". $user_email . "'");

      if ($query_user->num_rows() == 1){
      $row = $query_user->row();
      $userId = $row->user_id;

      $result = $this->db->query("UPDATE cr_renters SET renter_first_name = '".$renter_first_name."', renter_middle_name = '".$renter_middle_name."',
      renter_last_name = '".$renter_last_name."', renter_suffix = '".$renter_suffix."',renter_mobile_no = '".$renter_mobile_phone."',
      renter_home_ph_no = '".$renter_home_phone."',renter_work_ph_no = '".$renter_work_phone."',renter_ssn = '".$renter_ssn."',
      renter_dob = '".$renter_dob."' WHERE renter_user_id = '". $userId ."'");

      return $result;
      } else {
      return FALSE;
      }
      }
      return FALSE;
      }

      function update_landlord_renter_association ($user_id = NULL, $user_email = NULL, $admin_id = NULL, $admin_email = NULL, $admin_role_id = NULL,
      $renter_lease_start_date = NULL,$renter_lease_end_date = NULL,$renter_monthly_lease_amount = NULL,$renter_rent_due_date = NULL,$renter_ad_l1 = NULL,
      $renter_ad_l2 = NULL,$renter_city = NULL,$renter_state_id = NULL,$renter_zip = NULL,$landlord_first_name = NULL,$landlord_last_name = NULL,
      $landlord_email = NULL,$landlord_phone = NULL,$landlord_property_name = NULL,$landlord_off_ad_11 = NULL,$landlord_off_ad_12 = NULL,
      $landlord_0ff_city = NULL,$landlord_off_zip = NULL,$landlord_off_state_id = NULL)
      {

      $query = $this->db->query("SELECT admin_id, admin_role_id, admin_email FROM ls_admin WHERE admin_id = $admin_id AND admin_email = '".$admin_email."' AND admin_role_id = $admin_role_id");

      if ($query->num_rows() == 1){

      $query_user = $this->db->query("SELECT user_id, user_email FROM cr_users WHERE user_id = $user_id AND user_email = '". $user_email . "'");

      if ($query_user->num_rows() == 1){
      $row = $query_user->row();
      $userId = $row->user_id;

      $result = $this->db->query("UPDATE cr_landlord_renter_association SET lease_start_date = '".$renter_lease_start_date."',
      lease_end_date = '".$renter_lease_end_date."',monthly_lease_amount = '".$renter_monthly_lease_amount."',rent_due_date = '".$renter_rent_due_date."',
      renter_address_line_one = '".$renter_ad_l1."',renter_address_line_two = '".$renter_ad_l2."',renter_city = '".$renter_city."',
      renter_state_id = '".$renter_state_id."',renter_zip_code = '".$renter_zip."', landlord_first_name = '".$landlord_first_name."',
      landlord_last_name = '".$landlord_last_name."',landlord_email = '".$landlord_email."',landlord_phone_no = '".$landlord_phone."',
      landlord_organization = '".$landlord_property_name."',landlord_off_address_line_one = '".$landlord_off_ad_11."',
      landlord_off_address_line_two = '".$landlord_off_ad_12."',landlord_off_city = '".$landlord_0ff_city."',landlord_off_zipcode = '".$landlord_off_zip."',
      landlord_off_state_id = '".$landlord_off_state_id."' WHERE renter_user_id = '". $userId . "' AND association_status = 1");

      return $result;

      } else {
      return FALSE;
      }
      }
      return FALSE;
      }


      function cancel_user_data($admin_id = NULL, $admin_email = NULL, $admin_role_id = NULL, $user_id = NULL, $user_email = NULL, $user_account_delete_reason = NULL)
      {
      $query = $this->db->query("SELECT admin_id, admin_role_id, admin_email FROM ls_admin WHERE admin_id = $admin_id AND admin_email = '".$admin_email."' AND admin_role_id = $admin_role_id");

      if ($query->num_rows() == 1){

      $query_user = $this->db->query("SELECT user_id, user_name, user_email FROM cr_users WHERE user_id = $user_id AND user_email = '". $user_email . "'");

      if ($query_user->num_rows() == 1){

      $row = $query_user->row();
      $userId = $row->user_id;
      $userEmail = $row->user_email;
      $userName = $row->user_name;

      $this->db->query("update cr_users SET reason_cancel_account = '". $user_account_delete_reason ."',user_account_status = -1,  user_name = 'NULL',
      user_email = 'NULL', user_email_back_up = '". $userEmail ."', update_date = now() WHERE user_id = $userId AND user_email = '".$userEmail."'
      AND user_name = '".$userName."' AND user_registration_status = 1");

      return true;

      } else {
      return FALSE;
      }
      }
      return false;
      }

      function cancel_landlord_renter_association_data($admin_id = NULL, $admin_email = NULL, $admin_role_id = NULL, $user_id = NULL, $user_email = NULL)
      {

      $query = $this->db->query("SELECT admin_id, admin_role_id, admin_email FROM ls_admin WHERE admin_id = $admin_id AND admin_email = '".$admin_email."' AND admin_role_id = $admin_role_id");

      if ($query->num_rows() == 1)
      {

      $query_user = $this->db->query("SELECT user_id, user_email FROM cr_users WHERE user_id = $user_id AND user_email = '". $user_email . "'");


      if ($query_user->num_rows() == 1){

      $row = $query_user->row();
      $userId = $row->user_id;
      $userEmail = $row->user_email;

      $this->db->query("update cr_landlord_renter_association SET association_status = -1 WHERE renter_user_id = $userId AND association_status = 1");
      return true;

      } else {
      return false;
      }
      }
      return false;
      }

      public function record_count_renter_data()
      {
      $query = $this->db->query("SELECT COUNT(*) AS total_rows FROM cr_users WHERE user_registration_status != 0 AND user_account_status != -1 AND user_role_id = 1");

      $row = $query->row();
      return $row->total_rows;
      } */
}

/* End of file renter_model.php */
/* Location: ./application/models/admin_area/renter/renter_model.php */