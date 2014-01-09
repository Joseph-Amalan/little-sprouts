<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();		
	
        // Connect to database
		$this->load->database();
    }
	
	/*function get_states() 
	{
		$query = $this->db->query("select * from cr_states");
		return $query->result();
	}*/
   
	function login_validate($adminEmail = NULL, $adminPassword = NULL) {
	
		$query = $this->db->query("SELECT a.admin_id, a.admin_email, a.admin_role_id, a.admin_password FROM ls_admin AS a INNER JOIN ls_roles AS r ON a.admin_role_id = r.role_id WHERE admin_email = '".$adminEmail."' and admin_password = '".$adminPassword."'");
				
		if(($query->num_rows() == 1))
		{
			//entering last login time
			$this->db->query("UPDATE ls_admin SET last_login = now() WHERE admin_email = '".$adminEmail."' AND admin_password = '".$adminPassword."'");
					
			$db_row = $query->row();   
			
			$this->admin_id			= $db_row->admin_id;			
			$this->admin_email      = $db_row->admin_email;
			$this->admin_pwd        = $db_row->admin_password;			
			$this->admin_role_id    = $db_row->admin_role_id;

			return $this; 
		}
		else
		{
			return false;
		}                               
	}
	
	function generatePassword ($length) {
		$chars = "234567890abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$i = 0;
		$password = "";
		while ($i <= $length) {
			$password .= $chars{mt_rand(0,strlen($chars))};
			$i++;
		}
		return $password;
	}
	
	function create_user_account ($user_email, $username, $user_password, $userrole,$admin_id, $admin_email, $admin_role_id)
	{	
            
            
            
		$query = $this->db->query("SELECT user_email,user_name FROM user_detail WHERE user_email = '".$user_email."' AND user_name = '".$username."' ");
		
		if ($query->num_rows() < 1){
		
			//enctyped 
			//$user_enctyped_password = md5($user_password);
			//$user_ip 				= $_SERVER["REMOTE_ADDR"];
			
			$result = $this->db->query("INSERT INTO user_detail(user_email,user_name,user_password,user_role) VALUES ('".$user_email."','".$username."',
                            '".$user_password."','".$userrole."')");
        
			if($result) {		
				return true;
			} else {
				return false;
			}		
		} 
                else{
                    
		return false;
                }
	}
	
	function get_user_email($admin_id = NULL, $admin_email = NULL, $admin_role_id = NULL, $user_id = NULL) {
		
		$query = $this->db->query("SELECT admin_id, admin_role_id, admin_email FROM ls_admin WHERE admin_id = $admin_id AND admin_email = '".$admin_email."' AND admin_role_id = $admin_role_id");
		
		if ($query->num_rows() == 1)
		{	
			$query_user = $this->db->query("SELECT user_id, user_email FROM ls_users WHERE user_id = $user_id");
		      
			if ($query_user->num_rows() == 1){
			
				$row = $query_user->row();    
				$this->userEmail = $row->user_email;
				
				return $this;
			}			
		}
		return false;	
	}
	
	function update_ip_status($admin_id = NULL, $admin_email = NULL, $admin_role_id = NULL, $user_id = NULL, $user_email = NULL, $user_ip_status = NULL, $user_ipblock_reason = NULL) {
	
		$query = $this->db->query("SELECT admin_id, admin_role_id,admin_email FROM ls_admin WHERE admin_id = $admin_id AND admin_email = '".$admin_email."' AND admin_role_id = $admin_role_id");
		
		if ($query->num_rows() == 1){	

			$query_user = $this->db->query("SELECT user_id, user_email, user_name FROM ls_users WHERE user_id = $user_id AND user_email = '". $user_email . "'");
		      
			if ($query_user->num_rows() == 1){
			
				$row = $query_user->row();                        
				$userId = $row->user_id;
				$userName = $row->user_name;
				$userEmail = $row->user_email;
				
				if($user_ip_status == 'Unblock') {
					$user_ip_status = 1;
				} elseif($user_ip_status == 'Block') {
					$user_ip_status = 0;
				}
				
				$this->db->query("update ls_users SET user_ip_address_status = $user_ip_status, update_date = now(), 
				reason_ipblock_account = '" .$user_ipblock_reason."' WHERE user_id = $userId AND user_name = '".$userName."' AND user_email = '".$userEmail."'");
				return TRUE;
				
			} else {
				return FALSE;
			}			
		}     
		return false;		
	}
	
	function update_user_account_status($admin_id = NULL, $admin_email = NULL, $admin_role_id = NULL, $user_id = NULL, $user_email = NULL, $user_account_status = NULL, $inactive_account_reaons = NULL) {
	
		$query = $this->db->query("SELECT admin_id, admin_role_id, admin_email FROM ls_admin WHERE admin_id = $admin_id AND admin_email = '".$admin_email."' AND admin_role_id = $admin_role_id");
		
		if ($query->num_rows() == 1){	

			$query_user = $this->db->query("SELECT user_id, user_email, user_name FROM ls_users WHERE user_id = $user_id AND user_email = '". $user_email . "'");
		      
			if ($query_user->num_rows() == 1){
			
				$row = $query_user->row();                        
				$userId = $row->user_id;
				$userEmail = $row->user_email; 
				$userName = $row->user_name;
				
				if($user_account_status == 'Active') {
					$user_account_status = 1;
				} elseif($user_account_status == 'Inactive') {
					$user_account_status = 2;
				}
				
				$this->db->query("update ls_users SET user_account_status = $user_account_status, update_date = now(), 
				reason_deactive_account = '" .$inactive_account_reaons."' WHERE user_id = $userId AND user_name = '".$userName."' AND user_email = '".$userEmail."'");
				return TRUE;
				
			} else {
				return FALSE;
			}			
		}     
		return false;		
	}
	
	// No of days between two dates
	function days_between($renter_register_date){	    
	 
		$days = (strtotime(date("Y-m-d H:i:s")) - strtotime($renter_register_date)) / (60 * 60 * 24); 
		$day  = explode(".", $days);
		return $day[0];
	}
	
	function get_renter_pending_request_details($admin_id = NULL, $admin_email = NULL, $admin_role_id = NULL) {
		
		$query = $this->db->query("SELECT i.*, u.user_email as renter_user_email,u.user_id as renter_user_id FROM `cr_landlord_renter_association` AS i 
				 INNER JOIN ls_users AS u ON i.renter_user_id = u.user_id WHERE u.user_registration_status = 0 AND i.association_status='1' AND 
				 i.invitations_status = 1 AND i.landload_user_id = ' ' OR i.landload_user_id IS NULL");
		
		if($query->num_rows() > 0) {

			$row = $query->row();
			$sent_request_date = $row->created;
			$days_sent_request = $this->days_between($sent_request_date); 
		
			$sql  = "SELECT i.*, r.*,u.user_email as renter_user_email,u.user_id as renter_user_id FROM `cr_landlord_renter_association` AS i INNER JOIN 
				 cr_users AS u ON i.renter_user_id = u.user_id INNER JOIN cr_renters AS r ON r.renter_user_id = u.user_id WHERE u.user_account_status != -1 
				 AND i.association_status='1' AND i.invitations_status = 1 AND i.landload_user_id = ' ' OR i.landload_user_id IS NULL AND $days_sent_request > 1
				 ORDER BY i.created DESC";
							
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
	
}



/* End of file user_model.php */
/* Location: ./application/models/user_model.php */