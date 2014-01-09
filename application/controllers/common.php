<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends CI_Controller {

    function __construct() {
	 
            parent::__construct();  
            $this->load->library('template');
            
            $this->user_check_isvalidated();         
   }
   
   function index()
   {		
	    redirect("index");	
   }
   
   function msg_invt_count()
   {		
        $this->load->model('messages/messages_model');
        $this->load->model('user/user_model');

        $user_id = $this->session->userdata('user_id');	
        $user_email = $this->session->userdata('user_email');
        
        $msg_cnt 	= $this->user_model->count_inbox_messages($user_id); 
        $invt_cnt 	= $this->user_model->count_inbox_invitation($user_email); 
        
        $tot_cnt = $msg_cnt + $invt_cnt;
        
        header('Content-Type: application/x-json; charset=utf-8');	  
        echo(json_encode($tot_cnt));	
   }
   
   
   
   private function user_check_isvalidated()
	{
		$logged_in = $this->session->userdata('logged_in'); 
		//$status = $this->session->userdata('user_status'); 
		$role = $this->session->userdata('user_role_id');
		
		if(($logged_in == FALSE) || ($role == NULL) ){

			$this->session->set_flashdata('error_message', 'Please login to access this page.');				
			redirect('login');

		}   
     }
   
}


/* End of file common.php */
/* Location: ./application/controllers/common.php */
?>

