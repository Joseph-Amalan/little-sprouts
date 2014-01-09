<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Renter_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();		
	
        // Connect to database
		$this->load->database();
    }
   
	function get_list_renters ($admin_id = NULL, $admin_email = NULL, $admin_role_id = NULL, $sort_column = 'register_date',$sort_order = 'desc',$start = 0,$limit) 				 
	 {		
	 
		$query = $this->db->query("SELECT admin_id,admin_role_id, admin_email FROM ls_admin WHERE admin_id = $admin_id AND admin_email = '".$admin_email."' AND admin_role_id = $admin_role_id");
		
		if ($query->num_rows() == 1){		
						
			$sql  = "SELECT i.*, r.*,u.* FROM `cr_landlord_renter_association` AS i INNER JOIN cr_users u ON i.renter_user_id = u.user_id INNER JOIN 
			cr_renters r ON r.renter_user_id = u.user_id WHERE u.user_registration_status = 1 AND u.user_account_status != -1 AND 
			i.association_status='1' ORDER BY $sort_column $sort_order LIMIT $start, $limit";
			    				
			$query = $this->db->query($sql);  
        
			if($query->num_rows() > 0) {						
				return $query->result();
							
			} else {
				return false;
			}			
		} 
		return FALSE;		
	}
		
	function get_list_renter_details($admin_id = NULL, $admin_email = NULL, $admin_role_id = NULL, $user_id = NULL, $user_email = NULL) 
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
    }
	
}



/* End of file renter_model.php */
/* Location: ./application/models/admin_area/renter/renter_model.php */