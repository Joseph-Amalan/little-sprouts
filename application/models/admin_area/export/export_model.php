<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Export_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();

        // Connect to database
        $this->load->database();
    }

    function get_instance_data() {
        $query = $this->db->query("SELECT  distinct(instance_name),instance_id  FROM instance_details where flag='1'");
        return $query->result();
    }


    function get_schools() {

        $query = $this->db->query("SELECT  distinct(school_name)  FROM student_details");
        $schools = array();

        if ($query->result()) {
            foreach ($query->result() as $school) {
                $schools[$school->school_name] = $school->school_name;
            }
            return $schools;
        } else {
            return FALSE;
        }
    }

    /* function get_schools1($instance_name) {

      $query = $this->db->query("SELECT  distinct(school_name)  FROM student_details where instance_id='{$instance_name}'");
      $schools = array();

      if ($query->result()) {
      foreach ($query->result() as $school) {
      $schools[$school->school_name] = $school->school_name;
      }
      return $schools;
      } else {
      return FALSE;
      }
      } */

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

    function get_search_all_student_list($get_school_id, $get_class_id, $get_instance_id, $get_status_id) {

        /* $query = $this->db->query("SELECT child_id,first_name,last_name,date_of_birth,enrollment_status,primary_classroom,school_name FROM student_details 
          WHERE school_name='$school' AND primary_classroom='$preclass' AND enrollment_status='$enrollstatus'"); */

        $query = $this->db->query("SELECT * FROM student_details 
						WHERE school_name='$get_school_id' AND primary_classroom='$get_class_id' AND instance_id='$get_instance_id' AND enrollment_status='$get_status_id'");

        // print_r($query->result());
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
function get_data($get_instance_id) {


        $this->db->select('id as RecordID,created_time as Timestamp,modified_by as User,first_name as StudentFirstName,last_name as StudentLastName,child_id as StudentID,date_of_birth as DateofBirth,gender as Gender,voucher_number  as Voucher,primary_classroom as ClassName, school_code as SchoolID,school_name as SchoolName,status_date as EnrollmentStatusDate,enrollment_status as EnrollmentStatus,enrollment_days as EnrollmentDays,enrollment_type as EnrollmentType,instance_details.year as Year,instance_details.academic_year as AcademicYear,instance_details.term as Term,teacher1_id as Teacher1_ID,teacher1_lastname as Teacher1_LastName,teacher1_firstname as Teacher1_FirstName,teacher2_id as Teacher2_ID,teacher2_lastname as Teacher2_LastName,teacher2_firstname as Teacher2_FirstName,teacher3_id as Teacher3_ID,teacher3_lastname as Teacher3_LastName,teacher3_firstname as Teacher3_FirstName,test_date_first as TOPEL_TestDate,chronological_age as Chronological_Age,topel_pkss as TOPEL_PKSS,topel_dvss as TOPEL_DVSS,topel_pass as TOPEL_PASS,topel_elindex as TOPEL_ELIndex,topel_elindex_percentile as TOPEL_ELIndex_Percentile,not_tested_reason_first as TOPEL_NotTestedReason,administrator as TOPEL_Administrator,
 notes_first as TOPEL_Notes,test_date_second as PALSTestDate,pals_upper as PALS_Upper,pals_lower as PALS_Lower,
 pals_letter_sounds as PALS_LetterSounds,not_tested_reason_second as PALS_NotTestedReason,administrator_second as PALS_Administrator,
 notes_second as PALS_Notes'  );


        $this->db->from('student_details');
        $this->db->join('instance_details', 'student_details.instance_id = instance_details.instance_id');     
$this->db->where("(instance_details.instance_id = '$get_instance_id')", NULL);


        $this->db->order_by('id', 'ASC');
        $getData = $this->db->get();
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
    }
     /*function get_data($get_instance_id) {


        $this->db->select('id as RecordID,created_time as Timestamp,modified_by as User,first_name as StudentFirstName,last_name as StudentLastName,child_id as StudentID,
            date_of_birth as DateofBirth,gender as Gender,voucher_number  as Voucher,primary_classroom as ClassName,
 school_code as SchoolID,school_name as SchoolName,status_date as EnrollmentStatusDate,enrollment_status as EnrollmentStatus,
 enrollment_days as EnrollmentDays,enrollment_type as EnrollmentType,year as Year,academic_year as AcademicYear,term as Term,
teacher_details.teacher_id as Teacher1_ID,teacher_details.teacher1_lastname as Teacher1_LastName,teacher_details.teacher1_firstname as Teacher1_FirstName,
teacher_details.teacher_id as Teacher2_ID,teacher_details.teacher2_lastname as Teacher2_LastName,teacher_details.teacher2_firstname as Teacher2_FirstName, 
teacher_details.teacher_id as Teacher3_ID,teacher_details.teacher3_lastname as Teacher3_LastName,teacher_details.teacher3_firstname as Teacher3_FirstName,
 test_date_first as TOPEL_TestDate,topel_pkss as TOPEL_PKSS,topel_dvss as TOPEL_DVSS,topel_pass as TOPEL_PASS,
 topel_elindex as TOPEL_ELIndex,topel_elindex as TOPEL_ELIndex_Percentile,not_tested_reason_first as TOPEL_NotTestedReason,administrator as TOPEL_Administrator,
 notes_first as TOPEL_Notes,test_date_second as PALSTestDate,pals_upper as PALS_Upper,pals_lower as PALS_Lower,
 pals_letter_sounds as PALS_LetterSounds,not_tested_reason_second as PALS_NotTestedReason,administrator_second as PALS_Administrator,
 notes_second as PALS_Notes'  );


        $this->db->from('student_details');
        $this->db->join('teacher_details', 'student_details.teacher_id = teacher_details.teacher_id');
       // $this->db->where("(school_name  = '$get_school_id'  AND primary_classroom = '$get_class_id' AND enrollment_status = '$get_status_id' AND instance_id = '$get_instance_id')", NULL);
$this->db->where("(instance_id = '$get_instance_id')", NULL);


        $this->db->order_by('id', 'ASC');
        $getData = $this->db->get();
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
    }*/

//query for get all data
    function ToExcelAll() {
        $this->db->select('*');
        $this->db->from('student_details');
        $this->db->order_by('id', 'ASC');
        $getData = $this->db->get();
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
    }

}

/* End of file renter_model.php */
/* Location: ./application/models/admin_area/renter/renter_model.php */