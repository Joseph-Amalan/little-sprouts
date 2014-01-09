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

    function get_instance_data() {
        $query = $this->db->query("SELECT  distinct(instance_name),instance_id  FROM instance_details");
        return $query->result();
    }
function get_school_instance($instance_id_value) {
        // echo $schoolname;

        $query = $this->db->query("SELECT distinct(school_name)  FROM student_details WHERE school_name !='' and  instance_id = '{$instance_id_value}'");
        //print_r($query->result());
        $preschools = array();

        if ($query->result()) {
            foreach ($query->result() as $schools) {
                $preschools[$schools->school_name] = $schools->school_name;
            }
            return $preschools;
        } else {
            return FALSE;
        }
    }
    function get_classes($instance_id_value,$schoolname) {
        // echo $schoolname;

        $query = $this->db->query("SELECT distinct(primary_classroom)  FROM student_details WHERE primary_classroom !='' and instance_id = '{$instance_id_value}' and school_name = '{$schoolname}'");
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
 function get_status_instance_list($instance_id_value,$school, $preclasses) {

        $query = $this->db->query("SELECT distinct(enrollment_status) FROM student_details 
						WHERE enrollment_status !='' and instance_id = '{$instance_id_value}' and school_name='$school' AND primary_classroom='$preclasses'");
        //print_r($query->result());
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
    function get_student_list($instance_id_value,$school, $preclasses,$status_id_value) {

        $query = $this->db->query("SELECT * FROM student_details 
						WHERE instance_id = '{$instance_id_value}' and school_name='$school' AND primary_classroom='$preclasses' AND enrollment_status='$status_id_value'");
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

    function get_search_all_student_list($get_school_id, $get_class_id, $get_status_id, $get_instance_id) {

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

    

    function update_student_data($student_get_id, $student_name, $student_dob, $test_date_first, $topel_pkss, $topel_dvss, $topel_pass, $topel_elindex, $not_tested_reason_first, $administrator, $notes_first, $status_date, $test_date_second, $pals_upper, $pals_lower, $pals_letter_sounds, $not_tested_reason_second, $administrator_second, $notes_second) {
        $result = $this->db->query("UPDATE student_details SET test_date_first = '" . $test_date_first . "',topel_pkss = '" . $topel_pkss . "',topel_dvss = '" . $topel_dvss . "', topel_pass = '" . $topel_pass . "',topel_elindex = '" . $topel_elindex . "',not_tested_reason_first = '" . $not_tested_reason_first . "',  administrator = '" . $administrator . "',notes_first = '" . $notes_first . "',status_date = '" . $status_date . "',test_date_second = '" . $test_date_second . "', pals_upper = '" . $pals_upper . "',pals_lower = '" . $pals_lower . "', pals_letter_sounds = '" . $pals_letter_sounds . "', not_tested_reason_second = '" . $not_tested_reason_second . "',administrator_second = '" . $administrator_second . "', notes_second = '" . $notes_second . "' WHERE child_id = '" . $student_get_id . "'");
        echo $result;
        echo "<br>";
        return $result;
    }

   
}

/* End of file renter_model.php */
/* Location: ./application/models/admin_area/renter/renter_model.php */