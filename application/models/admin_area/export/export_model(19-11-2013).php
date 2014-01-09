<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();		
	
        // Connect to database
		$this->load->database();
    }
   
        
        function get_data() {
$this->db->select('id as SNo,first_name as First,last_name as Last,date_of_birth as DateofBirth,    
primary_classroom as ClassName,school_name as SchoolName,status_date as EnrollmentStatusDate,enrollment_status as EnrollmentStatus,
administrator as Teacher1_Name,administrator as Teacher2_Name,administrator as Teacher3_Name,test_date_first as TOPEL_TestDate,
topel_pkss as TOPEL_PKSS,topel_dvss as TOPEL_DVSS,topel_pass as TOPEL_PASS,topel_elindex as TOPEL_ELIndex,
not_tested_reason_first as TOPEL_NotTestedReason,administrator as TOPEL_Administrator,notes_first as TOPEL_Notes,
test_date_second as PALSTestDate,pals_upper as PALS_Upper,pals_lower as PALS_Lower,pals_letter_sounds as PALS_LetterSounds,
not_tested_reason_second as PALS_NotTestedReason, administrator_second as PALS_Administrator,notes_second as PALS_Notes');
$this->db->from('student_details');
$this->db->order_by('id','ASC');
$getData = $this->db->get();
if($getData->num_rows() > 0)
return $getData->result_array();
else
return null;
}
//query for get all data
function ToExcelAll() {
$this->db->select('*');
$this->db->from('student_details');
$this->db->order_by('id','ASC');
$getData = $this->db->get();
if($getData->num_rows() > 0)
return $getData->result_array();
else
return null;
}
		
	
	
}



/* End of file renter_model.php */
/* Location: ./application/models/admin_area/renter/renter_model.php */