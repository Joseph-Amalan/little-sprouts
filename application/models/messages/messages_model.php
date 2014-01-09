 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages_model extends CI_Model {

	// Fetch the user details from a userid
    function get_user_data($user_id = NULL) {
	
        $sql = "SELECT * FROM cr_users WHERE `user_id` = '".$user_id."' LIMIT 1";
        $query = $this->db->query($sql);  
		
         if($query->num_rows() == 1) {
             return $query->result(); 				
        } else {
            return false;
        }
    }
	
	 // get userid by email, 
    function get_user_id($email = NULL) {
		
        $sql = "SELECT user_id FROM cr_users WHERE `user_email` = '".$email."' LIMIT 1";
        $query = $this->db->query($sql);  
		
         if($query->num_rows() == 1) {            
            $db_row = $query->row();
			$user_id = $db_row->user_id ;		
			return $user_id;
		}	
        else {
            return false;
        }
    }

	// Fetch all messages from this user
    function get_messages($type = NULL, $user_id = NULL) {
			
        // Specify what type of messages you want to fetch
        switch($type) {	
                    case "sent": 
                        $sql = "SELECT m.*,ut.user_email as to_user_email, uf.user_email as from_user_email, COUNT(*) as counttitle from cr_private_messaging_system m INNER JOIN cr_users uf ON m.from_user = uf.user_id INNER JOIN cr_users ut ON m.to_user = ut.user_id where m.from_user='".$user_id."' and m.from_deleted='0' GROUP BY m.conv_id order by m.created desc"; 
                        break; // Send messages
                    case "trash":
                        $sql = "SELECT m.*,ut.user_email as to_user_email, uf.user_email as from_user_email, COUNT(*) as counttitle from cr_private_messaging_system m INNER JOIN cr_users uf ON m.from_user = uf.user_id INNER JOIN cr_users ut ON m.to_user = ut.user_id WHERE (m.to_user = '".$user_id."' OR m.from_user='".$user_id."') AND (m.from_deleted = 1 OR m.to_deleted = 1) GROUP BY m.conv_id order by m.created desc"; 
                        break; // Deleted messages
                    default: 
                        $sql = "SELECT m.*,u.user_email  as user_email, COUNT(*) as counttitle from cr_private_messaging_system m INNER JOIN cr_users u ON m.from_user = u.user_id where m.to_user='".$user_id."' and m.to_deleted='0' GROUP BY m.conv_id order by m.created desc"; 	
                        break; // All messages
                        //
                    //default: $sql = "select *, count(*) counttitle from ( where	to_user='".$user_id."' and to_deleted='0' order by created desc) as x GROUP BY conv_id order by created desc"; 	break; // All messages
                    //default: $sql = "select *, count(*) counttitle from (select * from  cr_private_messaging_system where to_user='".$user_id."' and to_deleted='0'  order by created desc) as x GROUP BY conv_id order by created desc";
		}		
		$query = $this->db->query($sql);  
        
        if($query->num_rows() > 0) {						
			return $query->result();						
        } else {
            return false;
        }
    }	
	
	// Fetch a specific message
    function view_message($message_id = NULL, $user_id = NULL) {
	
		$sql = "UPDATE cr_private_messaging_system SET from_viewed=IF(from_user='".$user_id."',1,from_viewed),to_viewed=IF(to_user='".$user_id."',1,to_viewed),
				from_vdate=IF(from_user='".$user_id."' and from_vdate='0000-00-00 00:00:00',now(),from_vdate),
				to_vdate=IF(to_user='".$user_id."' and to_vdate='0000-00-00 00:00:00',now(),to_vdate) WHERE `message_id` = '".$message_id."'";
        
		if($this->db->query($sql)) {	
		
			//$sql = "SELECT m.*, ut.email as to_user_email, uf.email as from_user_email from cr_private_messaging_system m INNER JOIN cr_users uf ON m.from_user = uf.user_id INNER JOIN cr_users ut ON m.to_user = ut.user_id WHERE (`to_user` = '".$user_id."' OR from_user='".$user_id."') AND `message_id` = '".$message_id."' order by created desc";
			$sql = "SELECT m.*, ut.user_email as to_user_email, uf.user_email as from_user_email from cr_private_messaging_system m INNER JOIN cr_users uf ON m.from_user = uf.user_id INNER JOIN cr_users ut ON m.to_user = ut.user_id where (`to_user` = '".$user_id."' OR from_user='".$user_id."') AND conv_id=(select conv_id from cr_private_messaging_system where `message_id` = '".$message_id."')";
							
			if($query = $this->db->query($sql)) {
			
			  return $query->result();
			  
			} else {
				return false;
			}
		}
		return false;
    }
	
	// message as viewed
    function viewed_message($message_id = NULL) {
       $sql = "UPDATE cr_private_messaging_system SET `to_viewed` = '1', `to_vdate` = NOW() WHERE `message_id` = '".$message_id."' LIMIT 1";       
	   if($this->db->query($sql)) {		
          return true;
		  
        } else {
            return false;
        }	   
    }
	
	// send messages
    function send_message($to_user_email = NULL, $subject = NULL, $body_messages = NULL, $from_user_id = NULL, $conv_id = NULL) {
				
        $to_user_id = $this->get_user_id($to_user_email); 
		$sql = "INSERT INTO cr_private_messaging_system (subject, message, from_user, to_user, conv_id, created) values ('".$subject."','".$body_messages."','".$from_user_id."','".$to_user_id."','".$conv_id."',NOW())";
		
		if($this->db->query($sql)) {		
			if($conv_id==""){
				$conv_id = $from_user_id ."_". (time());
				$message_id = $this->db->insert_id();
				$sql = "update cr_private_messaging_system set conv_id='".$conv_id."' where message_id = '".$message_id."'";                                
				 if($this->db->query($sql)) {		
					return true;
				}
			}				
			return true;		
        } else {
            return false;
        }
    }

	// Send reject invitation message
    function send_reject_invitation_message($to_user_email = NULL, $subject = NULL, $body_messages = NULL, $from_email = NULL, $conv_id = NULL) {
				
        $to_user_id = $this->get_user_id($to_user_email); 
		$sql = "INSERT INTO cr_private_messaging_system (subject, message, from_email, to_user, conv_id, created) values ('".$subject."','".$body_messages."','".$from_email."','".$to_user_id."','".$conv_id."',NOW())";
		
		if($this->db->query($sql)) {		
			if($conv_id==""){
			
				$conv_id = time();
				$message_id = $this->db->insert_id();				
				$sql = "update cr_private_messaging_system set conv_id='".$conv_id."' where message_id = '".$message_id."'";    
				
				 if($this->db->query($sql)) {		
					return true;
				}
			}				
			return true;		
        } else {
            return false;
        }
    }
	
	// move to trash messaes
    function move_trash($message_id = NULL, $user_id = NULL) {
        
		$sql = "UPDATE cr_private_messaging_system SET from_deleted=IF(from_user='".$user_id."',1,from_deleted),to_deleted=IF(to_user='".$user_id."',1,to_deleted),from_ddate=IF(from_user='".$user_id."',now(),from_ddate),
				to_ddate=IF(to_user='".$user_id."',now(),to_ddate) WHERE message_id IN ($message_id)";
        		
		if($this->db->query($sql)) {		
          return true;
		  
        } else {
            return false;
        }	
    }
	
	// restore messaes
    function restore($message_id = NULL, $user_id = NULL) {
        
		$sql = "UPDATE cr_private_messaging_system SET from_deleted=IF(from_user='".$user_id."',0,from_deleted),
		to_deleted=IF(to_user='".$user_id."',0,to_deleted),from_ddate=IF(from_user='.$curuserid.','0000-00-00 00:00:00',from_ddate),
		to_ddate=IF(to_user='.$curuserid.','0000-00-00 00:00:00',to_ddate) WHERE message_id IN ($message_id)";
        
		if($this->db->query($sql)) {		
          return true;
		  
        } else {
            return false;
        }	
    }
	
	//Delete permanently messaes
    function delete_permanently($message_id = NULL, $user_id = NULL) {
        
		//$sql = "DELETE FROM cr_private_messaging_system WHERE `message_id` = '".$message_id."' GROUP BY conv_id order by created desc";
        $sql = "DELETE FROM cr_private_messaging_system WHERE message_id IN ($message_id)";
		
		if($this->db->query($sql)) {		
          return true;
		  
        } else {
            return false;
        }	
    }
	
	//Mark unread
    function mark_unread($message_id = NULL, $user_id = NULL) {
        		
		$sql = "UPDATE cr_private_messaging_system SET from_viewed=IF(from_user='".$user_id."',0,from_viewed),to_viewed=IF(to_user='".$user_id."',0,to_viewed),
				from_vdate=IF(from_user='".$user_id."' and from_vdate='0000-00-00 00:00:00',now(),from_vdate),
				to_vdate=IF(to_user='".$user_id."' and to_vdate='0000-00-00 00:00:00',now(),to_vdate) WHERE message_id IN ($message_id)";
        
		if($this->db->query($sql)) {		
			return true;
		  
        } else {
			return false;
        }	
    }
		
	// Render the text (in here we can easily add bbcode for example)
    function render_message($message) {
        $message = strip_tags($message, '');
        $message = stripslashes($message); 
        $message = nl2br($message);
        return $message;
    }
	
}