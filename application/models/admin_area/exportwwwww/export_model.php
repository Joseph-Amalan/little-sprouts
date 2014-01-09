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
$this->db->select('*');
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