<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Instance_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();

        // Connect to database
        $this->load->database();
    }

   public function record_count_instance_data() 
    {
        $query = $this->db->query("SELECT COUNT(*) AS total_rows FROM instance_details WHERE instance_name!='' and flag='1'");
		   
		$row = $query->row();                        
	    return $row->total_rows; 
    }
function get_list_instance ($admin_id = NULL, $admin_username = NULL, $admin_role_id = NULL, $sort_column = 'instance_name',$start = 0,$limit) 				 
	 {		
	 
		$query = $this->db->query("SELECT admin_id,admin_role_id, admin_username FROM ls_admin WHERE admin_id = $admin_id AND admin_username = '".$admin_username."' AND admin_role_id = $admin_role_id");
		
		if ($query->num_rows() == 1){		
						
			$sql  = "SELECT distinct(instance_name),instance_id,year,term,academic_year FROM  instance_details WHERE  instance_name !='' and  flag='1' ORDER BY $sort_column  LIMIT $start, $limit";
			    				
			$query = $this->db->query($sql);  
        
			if($query->num_rows() > 0) {						
				return $query->result();
							
			} else {
				return false;
			}			
		} 
		return FALSE;		
	}	
        function get_list_instance_details($admin_id = NULL, $admin_username = NULL, $admin_role_id = NULL, $instance_id = NULL, $instance_name = NULL) 
	 {		
		$query = $this->db->query("SELECT admin_id,admin_role_id, admin_username FROM ls_admin WHERE admin_id = $admin_id AND admin_username = '".$admin_username."' AND admin_role_id = $admin_role_id");
		
		if ($query->num_rows() == 1){
		
					
			$query  = $this->db->query("SELECT distinct(instance_name),instance_id,year,term,academic_year FROM  instance_details WHERE  instance_name = '".$instance_name."' 
					  AND instance_id = '". $instance_id . "' ");
			        					
			if($query->num_rows() == 1) {	
				return $query->result();
							
			} else {
				return FALSE;
			}			
		} 
		return FALSE;
	}        
      
                
                
   function update_instance_data ($instance_id = NULL, $instance_name = NULL, $admin_id = NULL, $admin_username = NULL, $admin_role_id = NULL,
	$instancename = NULL,$yeardropdown = NULL,$academicyear = NULL,$instanceterm = NULL){
       
	   $query = $this->db->query("SELECT admin_id, admin_role_id, admin_username FROM ls_admin WHERE admin_id = $admin_id AND admin_username = '".$admin_username."' AND admin_role_id = $admin_role_id");
		
	
            if ($query->num_rows() == 1){	

            $result = $this->db->query("UPDATE instance_details SET instance_name = '".$instance_name."', year = '".$yeardropdown."', 
            academic_year = '".$academicyear."', term = '".$instanceterm."' WHERE instance_id = '". $instance_id ."'");

            return $result;
    } else {
            return FALSE;
    }
	
	}
        function delete_instance_data($admin_id = NULL, $admin_username = NULL, $admin_role_id = NULL, $instance_id = NULL, $instance_name = NULL, $instanceAccountDeleteReason = NULL)
	{     
	   $query = $this->db->query("SELECT admin_id, admin_role_id, admin_username FROM ls_admin WHERE admin_id = $admin_id AND admin_username = '".$admin_username."' AND admin_role_id = $admin_role_id");
		//echo "delete  from instance_details WHERE instance_id = '".$instance_id."' AND  instance_name = '".$instance_name."'";
		
                if ($query->num_rows() == 1){		
				
				
				//$this->db->query("delete  from instance_details WHERE instance_id = '".$instance_id."' AND  instance_name = '".$instance_name."'");
				$this->db->query("update instance_details set flag='0' WHERE instance_id = '".$instance_id."' AND  instance_name = '".$instance_name."'");								
				return true;
				
			} else {
				return FALSE;
			}			
		
	}

    function get_instance_data() {
        $query = $this->db->query("SELECT  distinct(instance_name),instance_id  FROM instance_details");
        return $query->result();
    }

   
}

/* End of file renter_model.php */
/* Location: ./application/models/admin_area/renter/renter_model.php */