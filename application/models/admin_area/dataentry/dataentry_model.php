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

        $query = $this->db->query("SELECT  distinct(school_name)  FROM student_details WHERE school_name !='' order by school_name asc");
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
        $query = $this->db->query("SELECT  distinct(instance_name),instance_id  FROM instance_details where flag='1' order by instance_name asc");
        return $query->result();
    }

    function get_school_instance($instance_id_value) {
        // echo $schoolname;

        $query = $this->db->query("SELECT distinct(school_name)  FROM student_details WHERE school_name !='' and  instance_id = '{$instance_id_value}' order by school_name asc");
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

    function get_classes($instance_id_value, $schoolname) {
        // echo $schoolname;

        $query = $this->db->query("SELECT distinct(primary_classroom)  FROM student_details WHERE primary_classroom !='' and instance_id = '{$instance_id_value}' and school_name = '{$schoolname}' order by primary_classroom asc");
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

        $query = $this->db->query("SELECT  distinct(enrollment_status)  FROM student_details where enrollment_status !='' order by enrollment_status asc");
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

    function get_status_instance_list($instance_id_value, $school, $preclasses) {

        $query = $this->db->query("SELECT distinct(enrollment_status) FROM student_details 
						WHERE enrollment_status !='' and instance_id = '{$instance_id_value}' and school_name='$school' AND primary_classroom='$preclasses' order by enrollment_status asc");
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

    function get_student_list($instance_id_value, $school, $preclasses, $status_id_value) {

        $query = $this->db->query("SELECT * FROM student_details 
						WHERE instance_id = '{$instance_id_value}' and school_name='$school' AND primary_classroom='$preclasses' AND enrollment_status='$status_id_value' order by child_id asc");
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
						WHERE school_name='$get_school_id' AND primary_classroom='$get_class_id' AND enrollment_status='$get_status_id' AND instance_id='$get_instance_id' order by child_id asc");

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

   /*function insert_teacher_data($teachername1, $teachername2, $teachername3,$coachername, $directorname) {


        if ($teachername1 != '') {
            $teacher1name = explode(" ", $teachername1);
            $teacher1_firstname = $teacher1name[0];
            $teacher1_lastname = $teacher1name[1];
            
             $query1 = $this->db->query("SELECT teacher1_id FROM teacher1_details WHERE teacher1_firstname = '" . $teacher1_firstname . "' and teacher1_lastname= '" . $teacher1_lastname . "'");
          
        if ($query1->num_rows() < 1) {           

            $result = $this->db->query("INSERT INTO teacher1_details(teacher1_firstname,teacher1_lastname) VALUES 
('" . $teacher1_firstname . "','" . $teacher1_lastname . "' )");

            $teacher1nameInsertID = mysql_insert_id();
            $chk = "one";
            $teacherLastId = $chk . '-' . $teacher1nameInsertID;
        }  else {
             $db_row = $query1->row();
              $teacher1_ids = $db_row->teacher1_id;
             //echo "UPDATE teacher1_details SET teacher1_firstname = '$teacher1_firstname',teacher1_lastname = '$teacher1_lastname' WHERE teacher1_id = '" . $teacher1_ids . "' ";
            $result = $this->db->query("UPDATE teacher1_details SET teacher1_firstname = '$teacher1_firstname',teacher1_lastname = '$teacher1_lastname' WHERE teacher1_id = '" . $teacher1_ids . "' ");
             $teacher1nameInsertID=$teacher1_ids;
            $chk = "one";
            $teacherLastId = $chk . '-' . $teacher1nameInsertID;
        }

        }

        if ($teachername2 != '') {
            $teacher2name = explode(" ", $teachername2);
            $teacher2_firstname = $teacher2name[0];
            $teacher2_lastname = $teacher2name[1];
            $query1 = $this->db->query("SELECT teacher2_id FROM teacher2_details WHERE teacher2_firstname = '" . $teacher2_firstname . "' and teacher2_lastname= '" . $teacher2_lastname . "'");
          
        if ($query1->num_rows() < 1) {    
            
            
            $result = $this->db->query("INSERT INTO teacher2_details(teacher2_firstname,teacher2_lastname) VALUES 
('" . $teacher2_firstname . "','" . $teacher2_lastname . "' )");

            $teacher2nameInsertID = mysql_insert_id();
            $chk = "two";
            $teacherLastId = $chk . '-' . $teacher2nameInsertID;
        }  else {
             $db_row = $query1->row();
             $teacher2_ids = $db_row->teacher2_id;
            $result = $this->db->query("UPDATE teacher2_details SET teacher2_firstname = '$teacher2_firstname',teacher2_lastname = '$teacher2_lastname' WHERE teacher2_id = '" . $teacher2_ids . "' ");
$teacher2nameInsertID = $teacher2_ids;
            $chk = "two";
            $teacherLastId = $chk . '-' . $teacher2nameInsertID;
        } 
        }

        if ($teachername3 != '') {
            $teacher3name = explode(" ", $teachername3);
            $teacher3_firstname = $teacher3name[0];
            $teacher3_lastname = $teacher3name[1];
             $query1 = $this->db->query("SELECT teacher3_id FROM teacher3_details WHERE teacher3_firstname = '" . $teacher3_firstname . "' and teacher3_lastname= '" . $teacher3_lastname . "'");
          
        if ($query1->num_rows() < 1) { 
            $result = $this->db->query("INSERT INTO teacher3_details(teacher3_firstname,teacher3_lastname) VALUES 
('" . $teacher3_firstname . "','" . $teacher3_lastname . "' )");

            $teacher3nameInsertID = mysql_insert_id();
            $chk = "three";
            $teacherLastId = $chk . '-' . $teacher3nameInsertID;
        } else {
             $db_row = $query1->row();
             $teacher3_ids = $db_row->teacher3_id;
            $result = $this->db->query("UPDATE teacher3_details SET teacher3_firstname = '$teacher3_firstname',teacher3_lastname = '$teacher3_lastname' WHERE teacher3_id = '" . $teacher3_ids . "' ");
$teacher3nameInsertID = $teacher3_ids;
            $chk = "three";
            $teacherLastId = $chk . '-' . $teacher3nameInsertID;
        } 
        }

        
        
         if ($coachername != '') {
            $coacher1name = explode(" ", $coachername);
            $coacher1_firstname = $coacher1name[0];
            $coacher1_lastname = $coacher1name[1];
             $query1 = $this->db->query("SELECT coacher_id FROM coacher_details WHERE coacher_firstname = '" . $coacher1_firstname . "' and coacher_lastname= '" . $coacher1_lastname . "'");
          
        if ($query1->num_rows() < 1) { 
            $result = $this->db->query("INSERT INTO coacher_details(coacher_firstname,coacher_lastname) VALUES 
('" . $coacher1_firstname . "','" . $coacher1_lastname . "' )");

            $coachernameInsertID = mysql_insert_id();
            $chk = "four";
            $teacherLastId = $chk . '-' . $coachernameInsertID;
        } else {
             $db_row = $query1->row();
             $coacher_ids = $db_row->coacher_id;
            $result = $this->db->query("UPDATE coacher_details SET coacher_firstname = '$coacher1_firstname',coacher_lastname = '$coacher1_lastname' WHERE coacher_id = '" . $coacher_ids . "' ");
$coachernameInsertID = $coacher_ids;
            $chk = "four";
            $teacherLastId = $chk . '-' . $coachernameInsertID;
        } 
        }
        
        
          if ($directorname != '') {
            $director1name = explode(" ", $directorname);
            $director1_firstname = $director1name[0];
            $director1_lastname = $director1name[1];
             $query1 = $this->db->query("SELECT director_id FROM director_details WHERE director_firstname = '" . $director1_firstname . "' and director_lastname= '" . $director1_lastname . "'");
          
        if ($query1->num_rows() < 1) { 
            $result = $this->db->query("INSERT INTO director_details(director_firstname,director_lastname) VALUES 
('" . $director1_firstname . "','" . $director1_lastname . "' )");

            $directornameInsertID = mysql_insert_id();
            $chk = "five";
            $teacherLastId = $chk . '-' . $directornameInsertID;
        } else {
             $db_row = $query1->row();
             $director_ids = $db_row->director_id;
            $result = $this->db->query("UPDATE director_details SET director_firstname = '$director1_firstname',director_lastname = '$director1_lastname' WHERE director_id = '" . $director_ids . "' ");
$directornameInsertID = $director_ids;
            $chk = "five";
            $teacherLastId = $chk . '-' . $directornameInsertID;
        } 
        }      

       

        if ($result) {
            return $teacherLastId;
        } else {
            return false;
        }
    }
*/

    function insert_teacher_data($teacher1_firstname,$teacher1_lastname, $teacher2_firstname,$teacher2_lastname,
        $teacher3_firstname,$teacher3_lastname,$coacher1_firstname,$coacher1_lastname,$director1_firstname,$director1_lastname) {


        if (($teacher1_firstname != '') || ($teacher1_lastname!= '')) {
           // $teacher1name = explode(" ", $teachername1);
          //  $teacher1_firstname_new = $teacher1_firstname;
           // $teacher1_lastname_new = $teacher1_lastname;
            
             $query1 = $this->db->query("SELECT teacher1_id FROM teacher1_details WHERE teacher1_firstname = '" . $teacher1_firstname . "' and teacher1_lastname= '" . $teacher1_lastname . "'");
          
        if ($query1->num_rows() < 1) {           

            $result = $this->db->query("INSERT INTO teacher1_details(teacher1_firstname,teacher1_lastname) VALUES 
('" . $teacher1_firstname . "','" . $teacher1_lastname . "' )");

            $teacher1nameInsertID = mysql_insert_id();
            $chk = "one";
            $teacherLastId = $chk . '-' . $teacher1nameInsertID;
        }  else {
             $db_row = $query1->row();
              $teacher1_ids = $db_row->teacher1_id;
             //echo "UPDATE teacher1_details SET teacher1_firstname = '$teacher1_firstname',teacher1_lastname = '$teacher1_lastname' WHERE teacher1_id = '" . $teacher1_ids . "' ";
            $result = $this->db->query("UPDATE teacher1_details SET teacher1_firstname = '$teacher1_firstname',teacher1_lastname = '$teacher1_lastname' WHERE teacher1_id = '" . $teacher1_ids . "' ");
             $teacher1nameInsertID=$teacher1_ids;
            $chk = "one";
            $teacherLastId = $chk . '-' . $teacher1nameInsertID;
        }

        }

       if (($teacher2_firstname != '') || ($teacher2_lastname!= '')) {
            //$teacher2name = explode(" ", $teachername2);
            //$teacher2_firstname_new = $teacher2_firstname;
           // $teacher2_lastname_new = $teacher2_lastname;
            $query1 = $this->db->query("SELECT teacher2_id FROM teacher2_details WHERE teacher2_firstname = '" . $teacher2_firstname . "' and teacher2_lastname= '" . $teacher2_lastname . "'");
          
        if ($query1->num_rows() < 1) {    
            
            
            $result = $this->db->query("INSERT INTO teacher2_details(teacher2_firstname,teacher2_lastname) VALUES 
('" . $teacher2_firstname . "','" . $teacher2_lastname . "' )");

            $teacher2nameInsertID = mysql_insert_id();
            $chk = "two";
            $teacherLastId = $chk . '-' . $teacher2nameInsertID;
        }  else {
             $db_row = $query1->row();
             $teacher2_ids = $db_row->teacher2_id;
            $result = $this->db->query("UPDATE teacher2_details SET teacher2_firstname = '$teacher2_firstname',teacher2_lastname = '$teacher2_lastname' WHERE teacher2_id = '" . $teacher2_ids . "' ");
$teacher2nameInsertID = $teacher2_ids;
            $chk = "two";
            $teacherLastId = $chk . '-' . $teacher2nameInsertID;
        } 
        }

        if (($teacher3_firstname != '') || ($teacher3_lastname!= '')) {
           /* $teacher3name = explode(" ", $teachername3);
            $teacher3_firstname = $teacher3name[0];
            $teacher3_lastname = $teacher3name[1];*/
             $query1 = $this->db->query("SELECT teacher3_id FROM teacher3_details WHERE teacher3_firstname = '" . $teacher3_firstname . "' and teacher3_lastname= '" . $teacher3_lastname . "'");
          
        if ($query1->num_rows() < 1) { 
            $result = $this->db->query("INSERT INTO teacher3_details(teacher3_firstname,teacher3_lastname) VALUES 
('" . $teacher3_firstname . "','" . $teacher3_lastname . "' )");

            $teacher3nameInsertID = mysql_insert_id();
            $chk = "three";
            $teacherLastId = $chk . '-' . $teacher3nameInsertID;
        } else {
             $db_row = $query1->row();
             $teacher3_ids = $db_row->teacher3_id;
            $result = $this->db->query("UPDATE teacher3_details SET teacher3_firstname = '$teacher3_firstname',teacher3_lastname = '$teacher3_lastname' WHERE teacher3_id = '" . $teacher3_ids . "' ");
$teacher3nameInsertID = $teacher3_ids;
            $chk = "three";
            $teacherLastId = $chk . '-' . $teacher3nameInsertID;
        } 
        }

        
        
        if (($coacher1_firstname != '') || ($coacher1_lastname!= '')) {
           /* $coacher1name = explode(" ", $coachername);
            $coacher1_firstname = $coacher1name[0];
            $coacher1_lastname = $coacher1name[1];*/
             $query1 = $this->db->query("SELECT coacher_id FROM coacher_details WHERE coacher_firstname = '" . $coacher1_firstname . "' and coacher_lastname= '" . $coacher1_lastname . "'");
          
        if ($query1->num_rows() < 1) { 
            $result = $this->db->query("INSERT INTO coacher_details(coacher_firstname,coacher_lastname) VALUES 
('" . $coacher1_firstname . "','" . $coacher1_lastname . "' )");

            $coachernameInsertID = mysql_insert_id();
            $chk = "four";
            $teacherLastId = $chk . '-' . $coachernameInsertID;
        } else {
             $db_row = $query1->row();
             $coacher_ids = $db_row->coacher_id;
            $result = $this->db->query("UPDATE coacher_details SET coacher_firstname = '$coacher1_firstname',coacher_lastname = '$coacher1_lastname' WHERE coacher_id = '" . $coacher_ids . "' ");
$coachernameInsertID = $coacher_ids;
            $chk = "four";
            $teacherLastId = $chk . '-' . $coachernameInsertID;
        } 
        }
        
        
           if (($director1_firstname != '') || ($director1_lastname!= '')) {
           /* $director1name = explode(" ", $directorname);
            $director1_firstname = $director1name[0];
            $director1_lastname = $director1name[1];*/
             $query1 = $this->db->query("SELECT director_id FROM director_details WHERE director_firstname = '" . $director1_firstname . "' and director_lastname= '" . $director1_lastname . "'");
          
        if ($query1->num_rows() < 1) { 
            $result = $this->db->query("INSERT INTO director_details(director_firstname,director_lastname) VALUES 
('" . $director1_firstname . "','" . $director1_lastname . "' )");

            $directornameInsertID = mysql_insert_id();
            $chk = "five";
            $teacherLastId = $chk . '-' . $directornameInsertID;
        } else {
             $db_row = $query1->row();
             $director_ids = $db_row->director_id;
            $result = $this->db->query("UPDATE director_details SET director_firstname = '$director1_firstname',director_lastname = '$director1_lastname' WHERE director_id = '" . $director_ids . "' ");
$directornameInsertID = $director_ids;
            $chk = "five";
            $teacherLastId = $chk . '-' . $directornameInsertID;
        } 
        }
        


      
        if ($result) {
            return $teacherLastId;
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
    
    function get_Early_Literacy_Index($get_sumvalues)
    {
        
       /* echo "SELECT TOPEL_Index_Score, TOPEL_PR
FROM topel_elindex_percentile_details WHERE $get_sumvalues BETWEEN `Sum_MIN` AND `Sum_MAX`";*/
       $query = $this->db->query("SELECT TOPEL_Index_Score, TOPEL_PR
FROM topel_elindex_percentile_details WHERE $get_sumvalues BETWEEN `Sum_MIN` AND `Sum_MAX`");

      // print_r($query->result());exit();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        } 
        
        
      
    }

}

/* End of file renter_model.php */
/* Location: ./application/models/admin_area/renter/renter_model.php */