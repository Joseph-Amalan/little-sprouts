<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporting_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();		
	
        // Connect to database
		$this->load->database();
    }
	
	// No of days between two dates
	function days_between($renter_register_date){	    
	 
		$diff = (strtotime(date("Y-m-d H:i:s")) - strtotime($renter_register_date)) / (60 * 60 * 24);
		return round($diff);
	}
	
	function get_renter_pending_request_details ($start, $limit) {
		
		$query = $this->db->query("SELECT u.*, i.* FROM cr_landlord_renter_association AS i INNER JOIN cr_users AS u ON i.renter_user_id = u.user_id 
									WHERE u.user_account_status != -1 AND i.association_status='1' AND i.invitations_status != 2");
		
		if($query->num_rows() > 0) {

			$row = $query->row();
			$sent_request_date = $row->created;
			$days_sent_request = $this->days_between($sent_request_date); 
		
			$sql  = "SELECT i.*, r.*,u.user_email as renter_user_email,u.user_id as renter_user_id FROM `cr_landlord_renter_association` AS i INNER JOIN 
				 cr_users AS u ON i.renter_user_id = u.user_id INNER JOIN cr_renters AS r ON r.renter_user_id = u.user_id WHERE u.user_account_status != -1 AND
				 i.association_status='1' AND i.invitations_status != 2 AND $days_sent_request >= 1 ORDER BY i.created DESC LIMIT $start, $limit";
							
			$query_r = $this->db->query($sql);  
	
			if($query_r->num_rows() > 0) {						
				return $query_r->result();
							
			} else {
				return false;
			}
		
		} else {
			return FALSE;
		}
	}
	
	function search_renters($keyword = NULL) {	
		
	 	$query = $this->db->query("SELECT u.*, i.* FROM cr_landlord_renter_association AS i INNER JOIN cr_users AS u ON i.renter_user_id = u.user_id 
									WHERE u.user_account_status != -1 AND i.association_status='1' AND i.invitations_status != 2");
		
		if($query->num_rows() > 0) {

			$row = $query->row();
			$sent_request_date = $row->created;
			$days_sent_request = $this->days_between($sent_request_date); 
			
			$sql  = "SELECT i.*, r.*, u.* FROM cr_landlord_renter_association AS i INNER JOIN cr_users AS u ON i.renter_user_id = u.user_id 
				     INNER JOIN cr_renters AS r ON r.renter_user_id = u.user_id WHERE u.user_account_status != -1 AND i.association_status='1' AND 
					 i.invitations_status != 2 AND $days_sent_request >= 1 AND (r.renter_first_name LIKE '%$keyword%' OR r.renter_last_name LIKE 
					 '%$keyword%' OR u.user_email LIKE '%$keyword%') ORDER BY register_date DESC"; 
		
			$query_r = $this->db->query($sql);  
	
			if($query_r->num_rows() > 0) {						
				return $query_r->result();
							
			} else {
				return false;
			}
		
		} else {
			return FALSE;
		}
	}
	
	
	function get_list_ip_blocked_accounts ($start, $limit) {
		
		$query = $this->db->query("SELECT u.*, rl.role_name FROM cr_users AS u INNER JOIN cr_roles AS rl ON u.user_role_id = rl.role_id WHERE 
				                   u.user_registration_status != 0 AND u.user_account_status != -1 AND u.user_ip_address_status = 0 ORDER BY u.register_date DESC LIMIT $start, $limit");
			
		if($query->num_rows() > 0) {						
			return $query->result();
						
		} else {
			return false;
		}
	}
	
	function get_list_ip_blocked_accounts_details($admin_id = NULL, $admin_email = NULL, $admin_role_id = NULL, $user_id = NULL, $user_email = NULL) 
	 {		
		$query = $this->db->query("SELECT admin_id,admin_role_id, admin_email FROM ls_admin WHERE admin_id = $admin_id AND admin_email = '".$admin_email."' AND admin_role_id = $admin_role_id");
		
		if ($query->num_rows() == 1){
							
			$query  = $this->db->query("SELECT * FROM cr_users WHERE user_registration_status != 0 AND user_account_status != -1 AND user_ip_address_status = 0 
										AND user_id = '". $user_id  . "' AND user_email = '". $user_email . "' ");
			        					
			if($query->num_rows() == 1) {	
				return $query->result();
							
			} else {
				return FALSE;
			}			
		} 
		return FALSE;
	}
	
	function get_list_inactive_accounts ($start, $limit) {
		
		$query = $this->db->query("SELECT u.*, rl.role_name FROM cr_users AS u INNER JOIN cr_roles AS rl ON u.user_role_id = rl.role_id WHERE 
				                   u.user_registration_status != 0 AND u.user_account_status = 2 ORDER BY u.register_date DESC LIMIT $start, $limit");
			
		if($query->num_rows() > 0) {						
			return $query->result();
						
		} else {
			return false;
		}
	}
	
	function get_list_inactive_accounts_details($admin_id = NULL, $admin_email = NULL, $admin_role_id = NULL, $user_id = NULL, $user_email = NULL) 
	 {		
		$query = $this->db->query("SELECT admin_id,admin_role_id, admin_email FROM ls_admin WHERE admin_id = $admin_id AND admin_email = '".$admin_email."' AND admin_role_id = $admin_role_id");
		
		if ($query->num_rows() == 1){
							
			$query  = $this->db->query("SELECT * FROM cr_users WHERE user_registration_status != 0 AND user_account_status = 2 AND
										user_id = '". $user_id  . "' AND user_email = '". $user_email . "' ");
			        					
			if($query->num_rows() == 1) {	
				return $query->result();
							
			} else {
				return FALSE;
			}			
		} 
		return FALSE;
	}

	function get_list_deleted_accounts ($start, $limit) {
		
		$query  = $this->db->query("SELECT u.*, rl.role_name FROM cr_users AS u INNER JOIN cr_roles AS rl ON u.user_role_id = rl.role_id WHERE 
				                   u.user_registration_status != 0 AND u.user_account_status = -1 AND u.user_email = 'NULL' OR u.user_email IS NULL 
								   ORDER BY u.update_date DESC LIMIT $start, $limit");
			
		if($query->num_rows() > 0) {						
			return $query->result();
						
		} else {
			return false;
		}
	}
	
	function get_list_deleted_renter_details($admin_id = NULL, $admin_email = NULL, $admin_role_id = NULL, $user_id = NULL, $user_email = NULL) 
	 {		
		
		$query_user = $this->db->query("SELECT user_id, user_email_back_up FROM cr_users WHERE user_id = $user_id AND user_email_back_up = '". $user_email . "'");
		  
		if ($query_user->num_rows() == 1){	
		
			$row 		= $query_user->row();                        
			$userId 	= $row->user_id;	
			$userEmail  = $row->user_email_back_up;	
			
			$query  = $this->db->query("select u.*, r.*, ra.*, rl.role_name, s.state_name, ls.state_name AS landlord_off_state_name FROM cr_users u 
					  INNER JOIN cr_renters AS r ON u.user_id = r.renter_user_id INNER JOIN cr_landlord_renter_association AS ra ON 
					  ra.renter_user_id = u.user_id INNER JOIN cr_roles AS rl ON u.user_role_id = rl.role_id INNER JOIN cr_states AS s ON 
					  s.state_id  = ra.renter_state_id INNER JOIN cr_states AS ls ON ls.state_id  = ra.landlord_off_state_id WHERE u.user_id = $user_id 
					  AND u.user_email = 'NULL' AND ra.association_status = -1 AND u.user_account_status = -1 AND u.user_email_back_up = '" . $userEmail ."'");
			        					
			if($query->num_rows() == 1) {	
				return $query->result();
							
			} else {
				return FALSE;
			}			
		} 
		return FALSE;
	}
	
	function get_list_deleted_landlord_details($admin_id = NULL, $admin_email = NULL, $admin_role_id = NULL, $user_id = NULL, $user_email = NULL) 
	 {		
		
		$query_user = $this->db->query("SELECT user_id, user_email_back_up FROM cr_users WHERE user_id = $user_id AND user_email_back_up = '". $user_email . "'");
		  
		if ($query_user->num_rows() == 1){	
		
			$row 		= $query_user->row();                        
			$userId 	= $row->user_id;	
			$userEmail  = $row->user_email_back_up;	
			
			$query  = $this->db->query("select u.*, l.*, rl.role_name, s.state_name FROM cr_users u INNER JOIN cr_landlords AS l ON 
					  u.user_id = l.landlord_user_id INNER JOIN cr_roles AS rl ON u.user_role_id = rl.role_id INNER JOIN cr_states AS s 
					  ON s.state_id  = l.landlord_off_state_id WHERE u.user_id = $user_id AND u.user_email = 'NULL' AND u.user_account_status = -1 AND 
					  u.user_email_back_up = '" . $userEmail ."'");
			        					
			if($query->num_rows() == 1) {	
				return $query->result();
							
			} else {
				return FALSE;
			}			
		} 
		return FALSE;
	}
	
	function get_list_deleted_csr_details($admin_id = NULL, $admin_email = NULL, $admin_role_id = NULL, $user_id = NULL, $user_email = NULL) 
	 {		
		
		$query_user = $this->db->query("SELECT user_id, user_email_back_up FROM cr_users WHERE user_id = $user_id AND user_email_back_up = '". $user_email . "'");
		  
		if ($query_user->num_rows() == 1){	
		
			$row 		= $query_user->row();                        
			$userId 	= $row->user_id;	
			$userEmail  = $row->user_email_back_up;	
			
			$query  = $this->db->query("select u.*, c.*, rl.role_name, s.state_name FROM cr_users u INNER JOIN cr_csr AS c ON 
					  u.user_id = c.csr_user_id INNER JOIN cr_roles AS rl ON u.user_role_id = rl.role_id INNER JOIN cr_states AS s 
					  ON s.state_id  = c.csr_state_id WHERE u.user_id = $user_id AND u.user_email = 'NULL' AND u.user_account_status = -1 AND 
					  u.user_email_back_up = '" . $userEmail ."'");
			        					
			if($query->num_rows() == 1) {	
				return $query->result();
							
			} else {
				return FALSE;
			}			
		} 
		return FALSE;
	}
	
	/*function get_list_deleted_accounts () {
		
		$query  = $this->db->query("select ur.*, ul.*, uc.*, ra.*, r.*, l.*, c.*, ur.user_email AS renter_user_email, ul.user_email AS landlord_user_email,uc.user_email AS csr_user_email, 
				  rr.role_name AS renter_role_name,rl.role_name AS landlord_role_name,rc.role_name AS csr_role_name, 
				  rs.state_name AS renter_state_name, ls.state_name AS landlord_off_state_name, cs.state_name AS csr_off_state_name 
				  FROM cr_users ur INNER JOIN cr_renters AS r ON u.user_id = r.renter_user_id INNER JOIN cr_landlord_renter_association AS ra ON 
					  ra.renter_user_id = u.user_id INNER JOIN cr_roles AS rl ON u.user_role_id = rl.role_id INNER JOIN cr_states AS s ON 
					  s.state_id  = ra.renter_state_id INNER JOIN cr_states AS ls ON ls.state_id  = ra.landlord_off_state_id WHERE u.user_id = $user_id 
					  AND u.user_email = '". $user_email . "' AND ra.association_status = 1 AND u.user_account_status != -1 ");
			
		if($query->num_rows() > 0) {						
			return $query->result();
						
		} else {
			return false;
		}
	}*/
	
	public function record_count_pending_renter_request() 
    {
      	  
	  $query = $this->db->query("SELECT COUNT(*) AS total_rows FROM cr_users WHERE user_registration_status = 0 AND user_account_status != -1 AND user_role_id = 1");
		
		$row = $query->row();                        
	    $total_rows = $row->total_rows; 
		
		return $total_rows;
    }
	
	public function record_count_inactive_accounts() 
    {
        $query = $this->db->query("SELECT COUNT(*) AS total_rows FROM cr_users WHERE user_registration_status != 0 AND user_account_status = 2");
		
		$row = $query->row();                        
	    $total_rows = $row->total_rows; 
		
		return $total_rows;
    }
	
	public function record_count_ip_blocked_accounts() 
    {
        $query = $this->db->query("SELECT COUNT(*) AS total_rows FROM cr_users WHERE user_registration_status != 0 AND user_account_status != -1 AND user_ip_address_status = 0");
		
		$row = $query->row();                        
	    $total_rows = $row->total_rows; 
		
		return $total_rows;
    }
	
	public function record_count_deleted_accounts() 
    {
        $query = $this->db->query("SELECT COUNT(*) AS total_rows FROM cr_users WHERE user_registration_status != 0 AND user_account_status = -1 ");
		
		$row = $query->row();                        
	    $total_rows = $row->total_rows; 
		
		return $total_rows;
    }
	
	
	
}

/* End of file reporting_model.php */
/* Location: ./application/models/reporting_model.php */