<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();		
	
        // Connect to database
		$this->load->database();
    }
    /*function create_table($tablename)
    { 
        $query = $this->db->query("
            
            CREATE TABLE `$tablename` (
  `id` bigint(150) NOT NULL AUTO_INCREMENT,
  `child_id` bigint(150) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `voucher_number` text NOT NULL,
  `date_of_birth` varchar(80) NOT NULL,
  `school_name` text NOT NULL,
  `school_code` varchar(50) NOT NULL,
  `status_date` varchar(80) NOT NULL,
  `enrollment_status` varchar(50) NOT NULL,
  `primary_classroom` text NOT NULL,
  `test_date_first` varchar(150) NOT NULL,
  `topel_pkss` varchar(150) NOT NULL,
  `topel_dvss` varchar(150) NOT NULL,
  `topel_pass` varchar(150) NOT NULL,
  `topel_elindex` varchar(150) NOT NULL,
  `not_tested_reason_first` text NOT NULL,
  `administrator` varchar(100) NOT NULL,
  `notes_first` text NOT NULL,
  `test_date_second` varchar(150) NOT NULL,
  `pals_upper` varchar(150) NOT NULL,
  `pals_lower` varchar(150) NOT NULL,
  `pals_letter_sounds` varchar(150) NOT NULL,
  `topel_elindex_second` varchar(150) NOT NULL,
  `not_tested_reason_second` text NOT NULL,
  `administrator_second` varchar(100) NOT NULL,
  `notes_second` text NOT NULL,
  PRIMARY KEY (`id`)
)");}*/
   function add_data($insertValues, $instance_id) {

        $insertQuery = $this->db->query("insert into temp_student_details (instance_id,child_id,first_name,last_name,gender,voucher_number,date_of_birth,
             school_name,school_code,status_date,enrollment_status,primary_classroom,class_room_id) " . $insertValues);


        $delete_student = $this->db->query("DELETE FROM student_details WHERE instance_id = '" . $instance_id . "' AND child_id 
               
in (SELECT child_id
FROM temp_student_details
WHERE instance_id = '" . $instance_id . "' )");



        $insertQuery = $this->db->query("insert into student_details (instance_id,child_id,first_name,last_name,gender,voucher_number,date_of_birth,
             school_name,school_code,status_date,enrollment_status,primary_classroom,class_room_id)
              (SELECT instance_id,child_id,first_name,last_name,gender,voucher_number,date_of_birth,
             school_name,school_code,status_date,enrollment_status,primary_classroom,class_room_id FROM temp_student_details)");


        $delete_student = $this->db->query("DELETE FROM temp_student_details");



        return $insertQuery;
    }
	
        
      
       function add_student_data($instance_id, $studentId, $studentFirstName, $studentLastName, $childGender, $voucherNumber, $childdob, $childschoolname, $childschoolcode, $statusdate, $enrollmentstatus, $childclassname,$childclassid) {

        $insertQuery = $this->db->query("insert into temp_student_details (instance_id,child_id,first_name,last_name,gender,voucher_number,date_of_birth,
             school_name,school_code,status_date,enrollment_status,primary_classroom,class_room_id) values ('$instance_id','$studentId','$studentFirstName','$studentLastName','$childGender','$voucherNumber',
                    '$childdob','$childschoolname','$childschoolcode','$statusdate','$enrollmentstatus','$childclassname','$childclassid')");



        $delete_student = $this->db->query("DELETE FROM student_details WHERE instance_id = '" . $instance_id . "' AND child_id = '" . $studentId . "'");

        /* $delete_student = $this->db->query("DELETE FROM student_details WHERE instance_id = '".$instance_id."' AND child_id = '". $studentId ."'

          in (SELECT instance_id,child_id
          FROM temp_student_details
          WHERE instance_id = '".$instance_id."' AND child_id = '". $studentId ."')"); */


        $insertQuery = $this->db->query("insert into student_details (instance_id,child_id,first_name,last_name,gender,voucher_number,date_of_birth,
             school_name,school_code,status_date,enrollment_status,primary_classroom,class_room_id)
              (SELECT instance_id,child_id,first_name,last_name,gender,voucher_number,date_of_birth,
             school_name,school_code,status_date,enrollment_status,primary_classroom,class_room_id FROM temp_student_details)");



        $delete_student = $this->db->query("DELETE FROM temp_student_details");




        return $insertQuery;
    }
	 function get_instance_data() {
        $query = $this->db->query("SELECT  distinct(instance_name),instance_id  FROM instance_details where flag='1'");
        return $query->result();
    }
        
       
	/*function get_list_renter_details($admin_id = NULL, $admin_email = NULL, $admin_role_id = NULL, $user_id = NULL, $user_email = NULL) 
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
    }*/
	
}



/* End of file renter_model.php */
/* Location: ./application/models/admin_area/renter/renter_model.php */