<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();	
    }
    
    function get_user_id($user_email = NULL, $user_role_id = NULL) 
    {                        
		$query = $this->db->query("SELECT user_id FROM cr_users WHERE user_email = '".$user_email."' AND user_role_id = $user_role_id");   
                
		if ($query->num_rows() == 1){
                    
			$row = $query->row();
			$user_id = $row->user_id;			
			return $user_id;		
		}		
	}
	
	function get_user_id_username($user_name = NULL, $user_role_id = NULL) 
    {                        
		$query = $this->db->query("SELECT user_id FROM cr_users WHERE user_name = '".$user_name."' AND user_role_id = $user_role_id");   
                
		if ($query->num_rows() == 1){
                    
			$row = $query->row();
			$user_id = $row->user_id;			
			return $user_id;		
		}		
	}
	
	function insert_new_user_data ($user_email = NULL, $user_name = NULL, $user_password = NULL,$user_role_id = NULL,$user_key_val = NULL)
	{
		//enctyped in controller, so commented
		$user_encrpt_password = md5($user_password);
        $user_ip = $_SERVER["REMOTE_ADDR"];
                
		$result = $this->db->query("INSERT INTO cr_users (user_email,user_name,user_password,user_role_id,user_val_key,register_date,update_date,user_ip_address,user_registration_status,user_account_status) 
									VALUES ('".$user_email."', '".$user_name."', '".$user_encrpt_password."', $user_role_id,'".$user_key_val."',now(),now(),'".$user_ip."',0,1)");
                
		return $result;
	}
    	
	function generate_activation_link($user_email = NULL,$user_role_id = NULL, $user_key = NULL, $user_key_val = NULL) {
            
		$activation_data = array();
		
		$sql = "SELECT u.user_email,u.user_role_id FROM cr_users u 
                        INNER JOIN cr_roles rl ON u.user_role_id = rl.role_id 
                        WHERE u.user_email = '".$user_email."' 
                        AND u.user_role_id = $user_role_id 
                        AND u.user_val_key = '".$user_key_val."'";
		            
		$query = $this->db->query($sql);   
                
		if ($query->num_rows() == 1){
                    
			$row = $query->row(); 
                        
			$role_id = $row->user_role_id;			
			$email = $row->user_email;
			
                        if($role_id == 1)
                         {
                            $activation_data = base_url().'renter/sign_up/activate/'.$user_key.'/'.$role_id.'/'.$email;
                            
                        }elseif($role_id == 2)
                        {
                            $activation_data = base_url().'landlord/sign_up/activate/'.$user_key.'/'.$role_id.'/'.$email;
                        }
                        elseif($role_id == 3)
                        {
                            $activation_data = base_url().'csr/sign_up/activate/'.$user_key.'/'.$role_id.'/'.$email;
                        }
									
			return $activation_data;		
		}
	}	
	
	function activate_new_user($userKey = NULL, $userRoleId = NULL, $userEmail = NULL) {
            
		$user_key = md5($userKey);   
                
		$query = $this->db->query("SELECT u.user_email, u.user_registration_status, u.user_val_key, u.user_role_id 
                    FROM cr_users u 
                    INNER JOIN cr_roles r ON u.user_role_id = r.role_id 
                    WHERE u.user_role_id = '".$userRoleId."' 
                    AND u.user_val_key ='".$user_key."' 
                    AND u.user_email = '".$userEmail."'");
                
		if ($query->num_rows() == 1){
		
			$row = $query->row();
                        
			$user_email = $row->user_email;
			$user_role_id = $row->user_role_id;
			$user_status = $row->user_registration_status;
			$user_key = $row->user_val_key;
			
			if($user_status == 0) {
				$this->db->query("UPDATE cr_users SET user_registration_status = 1 WHERE user_val_key ='".$user_key."' AND user_email = '".$user_email."' AND user_role_id = $user_role_id");
				return 1;	
			}elseif($user_status == 1){
				return 2;
			}		
		}
		else {
			return FALSE;
		}
	}
	
	function get_Roles() {
            
            $query = $this->db->query("SELECT role_id, role_name FROM cr_roles ORDER BY role_id LIMIT 2");
            return $query->result();
        
        }

	function login_validate($username = NULL, $password = NULL) {
	
		$query = $this->db->query("SELECT u.user_id,u.user_role_id, u.user_name, u.user_email, u.user_password, u.user_registration_status,u.user_account_status,
		u.user_ip_address_status, u.user_ip_address FROM cr_users u INNER JOIN cr_roles r ON u.user_role_id = r.role_id 
        WHERE u.user_name = '".$username."' and u.user_password = '".$password."'");
                
		if(($query->num_rows() == 1))
		{
			//entering last login time
			$this->db->query("UPDATE cr_users SET last_login = now() WHERE user_name = '".$username."' AND user_password = '".$password."'");
                    
			$db_row = $query->row();   
			
			$this->user_id							= $db_row->user_id;			
            $this->user_role_id         			= $db_row->user_role_id;
			$this->user_email           			= $db_row->user_email;			
			$this->user_name           				= $db_row->user_name;
			$this->user_pw              			= $db_row->user_password;
			$this->user_ip_address_status  			= $db_row->user_ip_address_status;
			$this->user_status          			= $db_row->user_registration_status;
            $this->user_account_status  			= $db_row->user_account_status;
			$this->user_ip_address  				= $db_row->user_ip_address;

			return $this; 
		}
		else
		{
			return false;
		}                               
	}
    	
	function forgot_password_email_validate($email = NULL) {
				
		$query = $this->db->query("select user_id,user_role_id,user_email,user_account_status FROM cr_users WHERE user_email = '".$email."'");
		 
		if ($query->num_rows() == 1){
                    
			$db_row = $query->row();   
			
			$this->user_id              = $db_row->user_id;			
                        $this->user_role_id         = $db_row->user_role_id;
			$this->user_email           = $db_row->user_email;
                        $this->user_account_status  = $db_row->user_account_status;

			return $this;  
		}
		else
		{
			return FALSE;
		}					
	}
	
	function forgot_password_url_validate($user_key = NULL, $userRoleId = NULL, $email = NULL) {
						 
		$user_key = md5($user_key);    
		$query = $this->db->query("SELECT user_id,user_role_id,user_email,user_registration_status,user_account_status FROM cr_users WHERE user_role_id = '".$userRoleId."' AND user_val_key ='".$user_key."' and user_email = '".$email."'");
			
		if ($query->num_rows() == 1){
			
                        $db_row = $query->row();   
			
			$this->user_id              = $db_row->user_id;			
                        $this->user_role_id         = $db_row->user_role_id;
			$this->user_email           = $db_row->user_email;
                        $this->user_status          = $db_row->user_registration_status;
                        $this->user_account_status  = $db_row->user_account_status;

			return $this;  
		}
		else
		{
			return FALSE;
		}		
	}
	
	function generate_forgot_Password_link($user_id = NULL,$user_role_id = NULL, $user_email = NULL, $user_key = NULL, $user_key_val = NULL) {
            
		$sql = "SELECT u.user_id,u.user_email,u.user_role_id FROM cr_users u 
                    INNER JOIN cr_roles rl ON u.user_role_id = rl.role_id 
                    WHERE u.user_id = $user_id AND u.user_role_id = $user_role_id AND u.user_email = '".$user_email."'";
		//echo "sql ---> ".$sql;
                
		$query = $this->db->query($sql);  
                
		if ($query->num_rows() == 1)
                 {
			$row = $query->row();
                        
			$userId = $row->user_id;
			$userEmail = $row->user_email;
			$userRoleId = $row->user_role_id;
			
			if($this->db->query("UPDATE cr_users SET user_val_key ='".$user_key_val."' WHERE user_id = $userId AND user_email = '".$userEmail."' AND user_role_id = $userRoleId")) {			
                            
				$forgot_Password_link = base_url().'forgot_password/activate/'.$user_key.'/'.$userRoleId.'/'.$userEmail; 
                                
                 return $forgot_Password_link;	
			}				
					
		}
                else
		{
			return FALSE;
		}
	}
	
	function reset_password_update($user_id = NULL, $user_email = NULL, $user_role_id = NULL, $new_password = NULL) {
		
		$query = $this->db->query("SELECT u.user_id, u.user_role_id, u.user_email, u.user_account_status FROM 
                    cr_users u INNER JOIN cr_roles rl ON u.user_role_id = rl.role_id 
                    WHERE u.user_id ='".$user_id."' AND u.user_email = '".$user_email."' AND u.user_role_id = '".$user_role_id."'");
			
		if ($query->num_rows() == 1){
		
			$db_row = $query->row();
                        
			$userId = $db_row->user_id;
			$userEmail = $db_row->user_email;
                        $userRoleId = $db_row->user_role_id;
			
			if($this->db->query("UPDATE cr_users SET user_password = '".$new_password."', user_registration_status = 1 WHERE user_id ='".$userId."' AND user_email = '".$userEmail."' AND user_role_id = $userRoleId")) {
				
				return true;			
			}
		}
		return false;			
	}	
	
	function change_password($user_id = NULL, $user_email = NULL, $user_role_id = NULL, $old_password = NULL, $new_password = NULL) {
	
		$query = $this->db->query("SELECT user_id,user_role_id, user_email FROM cr_users WHERE user_id = $user_id AND user_email = '".$user_email."' AND  user_password = '".$old_password."' AND user_role_id = $user_role_id");
		
		if ($query->num_rows() == 1){
			
			$db_row = $query->row();
                        
			$userId = $db_row->user_id;
			$userEmail = $db_row->user_email;
			$userRoleId = $db_row->user_role_id;
			
			if($this->db->query("UPDATE cr_users SET user_password = '".$new_password."' WHERE user_id ='".$userId."' AND user_email = '".$userEmail."' AND user_role_id = $userRoleId")) {
                            return $this; 
			}
		}
		return false;
	}
	
	function change_email($user_id = NULL, $user_name = NULL, $user_role_id = NULL, $old_email = NULL, $new_email = NULL) {
	
		$query = $this->db->query("SELECT user_id,user_role_id, user_name FROM cr_users WHERE user_id = $user_id AND user_name = '".$user_name."' AND  user_email = '".$old_email."' AND user_role_id = $user_role_id");
		
		if ($query->num_rows() == 1){
			
			$db_row = $query->row();
                        
			$userId = $db_row->user_id;
			$userName = $db_row->user_name;
			$userRoleId = $db_row->user_role_id;
			
			if($this->db->query("UPDATE cr_users SET user_email = '".$new_email."' WHERE user_id ='".$userId."' AND user_name = '".$userName."' AND 
								 user_role_id = $userRoleId")) {
                return $this; 
			}
		}
		return false;
	}
	
	function email_validate($landlord_email) {
			
		$query = $this->db->query("select l.landlord_user_id, rl.role_name, u.user_email FROM cr_users u INNER JOIN cr_roles rl INNER JOIN cr_landlords l WHERE u.user_email = '".$landlord_email."' AND u.user_role_id = rl.role_id AND u.user_id = l.landlord_user_id AND u.user_registration_status = 2");
		
		if ($query->num_rows() == 1){
			
			$row = $query->row();
			$landlord_id = $row->landlord_user_id;
                        
			return $landlord_id;
		}
		return false;			
	}
	
	function assosiate_renter_landlord ($landlord_id = NULL, $renter_email = NULL) {
	
		if (!empty($landlord_id)) {

			$query = $this->db->query("select u.user_id, rl.role, u.email FROM cr_users u INNER JOIN cr_roles rl WHERE u.email = '$renter_email' and u.role= rl.role_id");
				
			if ($query->num_rows() == 1){

				$row = $query->row();
				$user_id = $row->user_id;
				$role = $row->role;
				$email = $row->email;
				
				if($this->db->query("UPDATE cr_renters r INNER JOIN cr_users u INNER JOIN cr_roles rl SET r.landlord_id = $landlord_id WHERE u.email = '$email' AND rl.role = 'renter' and u.user_id = '$user_id'")) {
					return true;
				}
			}
		}
		return false;			
	}
	
	function get_states() 
	{
		$query = $this->db->query("select * from cr_states");
		return $query->result();
	}			
	
	function get_user_status($user_role_id = NULL,$user_email = NULL,$user_id = NULL, $user_status = NULL) {
	
		$query = $this->db->query("SELECT u.user_id,u.user_registration_status,u.user_account_status,u.user_role_id, u.user_email,u.user_ip_address_status,
		u.user_ip_address FROM cr_users u INNER JOIN cr_roles r ON u.user_role_id = r.role_id WHERE u.user_role_id = '". $user_role_id ."' AND 
		u.user_email = '". $user_email ."' AND u.user_id = '". $user_id . "'");
		
		if(($query->num_rows() == 1))
		{  		
			$db_row = $query->row(); 

			$this->user_id					= $db_row->user_id;			
            $this->user_role_id         	= $db_row->user_role_id;
			$this->user_email           	= $db_row->user_email;
			$this->user_status          	= $db_row->user_registration_status;
            $this->user_account_status  	= $db_row->user_account_status;
			$this->user_ip_address_status   = $db_row->user_ip_address_status;			
			$this->user_ip_address   		= $db_row->user_ip_address;

			return $this; 
		}
		else
		{
			return false;
		}                               
	}
	
	function count_inbox_invitation($user_email = NULL)	{
		 
		$sql = "SELECT count(*) AS counttitle FROM cr_landlord_renter_association where landlord_email ='".$user_email."' AND to_invitations_deleted=0 AND 
				invitations_status = 1 AND association_status = 1 ORDER BY created DESC";
        
		$query = $this->db->query($sql);
		$db_row = $query->row(); 
		
        if($db_row->counttitle > 0) {
			// return $total_num_row = $query->num_rows();	
			return $db_row->counttitle;			
		}			
	}
	
	function count_inbox_messages($user_id = NULL)	{
		 
		$sql = "SELECT count(*) AS counttitle FROM cr_private_messaging_system where to_user='".$user_id."' AND to_deleted= 0 AND 
				to_viewed = 0 GROUP BY conv_id ORDER BY created DESC";
        
		$query = $this->db->query($sql);
		$db_row = $query->row(); 
		        
		return $total_num_row = $query->num_rows();		
	}
	
	function registered_email($user_email = NULL) {
	
        $sql = "SELECT user_id FROM cr_users WHERE user_email = '".$user_email."' LIMIT 1";
        $query = $this->db->query($sql);  
				
         if($query->num_rows() == 1) {
			return TRUE;
		}	
        else {
            return false;
        }
    }	
	
	function cancel_account_validate($cancel_acc_username = NULL,$cancel_acc_password = NULL)
	{	
		$user_id 		= $this->session->userdata('user_id'); 
		$user_email 	= $this->session->userdata('user_email');		
		$user_name 		= $this->session->userdata('user_name');
		$user_role_id   = $this->session->userdata('user_role_id');
		
		$query = $this->db->query("SELECT user_email,user_name, user_password FROM cr_users WHERE user_id = $user_id AND user_name = '".$user_name."' 
		AND user_role_id = $user_role_id");
		
		if ($query->num_rows() == 1){
			
			$row = $query->row();                        
			$userName = $row->user_name;
			$userPassword = $row->user_password;	
								
			if(($userName == $cancel_acc_username) && ($userPassword == $cancel_acc_password)){ 
						
				$this->user_email = $row->user_email;		
				return $this;
			}
			return false;
		}
		return false;
	}
	
	
	function delete_bank_account($user_id = NULL, $user_name = NULL, $user_email = NULL, $user_role_id, $bank_id = NULL) {
		
		$query = $this->db->query("SELECT u.user_email,u.user_role_id, u.user_name, u.user_id FROM cr_users u INNER JOIN cr_roles rl ON 
								    u.user_role_id = rl.role_id WHERE  u.user_name = '".$user_name."' AND u.user_email = '".$user_email."' AND 
									u.user_id = '".$user_id."' AND u.user_role_id = '". $user_role_id ."'");
									
		if($query->num_rows() == 1){
		
			$row 			= $query->row();
			$userId 		= $row->user_id;
			$query_b = $this->db->query("SELECT user_id FROM cr_bank_details where user_id = '".$userId."' AND bank_account_status = '1' 
										 AND bank_id = '". $bank_id ."'");
			
			if($query_b->num_rows() == 1) {
				return FALSE;
			} else {
				$this->db->query("DELETE FROM cr_bank_details WHERE user_id = '".$userId."' AND bank_id = '". $bank_id ."'");
				return TRUE;
			}
		}
		return FALSE;				
	}
	
	
	   
	
}



/* End of file user_model.php */
/* Location: ./application/models/user_model.php */