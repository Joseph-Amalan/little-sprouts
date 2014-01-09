<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller {
    
    private $user_id;    
		
    function __construct()
    {
        // Call the Controller constructor
        parent::__construct();	
        $this->load->library('template');
        
		$this->load->model('user/user_model');
		
		$this->user_id 			= $this->session->userdata('user_id');
		$this->user_email 		= $this->session->userdata('user_email');
		$this->user_role_id		= $this->session->userdata('user_role_id');		
		$this->user_status		= $this->session->userdata('user_status');	
        
		$this->user_check_isvalidated();	
						
		$this->load->model('messages/messages_model');
			
		//basic info for the header		 
		$this->template->write('title', "Inbox | Inspire Credit - 'It's What Moves You!");	
		$this->template->write('heading', 'Inspire Credit');		 
		$this->template->write('meta_description', 'Inspire Credit');
		 
		//include regions for template
		$this->template->write_view('topheader', 'blocks/topheader');
		$this->template->write_view('megadropdown', 'blocks/megadropdown');	
		$this->template->write_view('footer', 'blocks/footer');					 		 			
    }
	
	 
	 // Inbox messaes
	 function inbox()
	 {	
		$type = '';	
		
		$body_data = array();		
		$body_data['message_list'] = $this->messages_model->get_messages($type,$this->user_id);
		
		$this->template->write_view('content', 'messages/message_inbox_view', $body_data, TRUE);
		$this->template->render();		
	 }
	 
	 //Sent messages
	 function sent()
	 {				
		
		$type = 'sent';
		
		$body_data = array();
		$body_data['message_list'] = $this->messages_model->get_messages($type, $this->user_id);			
		
		$this->template->write_view('content', 'messages/message_sent_view', $body_data, TRUE);
		$this->template->render();				
	 }
	 
	 //Get trash messages 
	 function trash()
	 {		
		$type = 'trash';		
		
		$body_data = array();
		$body_data['trash_message'] = $this->messages_model->get_messages($type, $this->user_id);		
		
		$this->template->write_view('content', 'messages/message_trash_view', $body_data, TRUE);
		$this->template->render();			
	 }
			
	//Compose messages
	 function compose()
	 {			
		//This method will have the validation
		$this->load->library('form_validation');
			
		$this->form_validation->set_rules('toUserEmail', 'Email Address', 'trim|required|valid_email|max_length[150]|callback_registered_email|xss_clean');	
		$this->form_validation->set_rules('subject', 'subject', 'trim|required|min_length[2]|max_length[150]xss_clean');
		$this->form_validation->set_rules('bodyMessages', 'message', 'trim|required|min_length[5]|max_length[600]|xss_clean');
	 
		if($this->form_validation->run() == FALSE)
		{
			$this->form_validation->set_error_delimiters('<span class="msg_error">', '</span>');
			$this->template->write_view('content', 'messages/message_compose_view');
			$this->template->render();	
		}
		else {
               		
			$to_user_email = $this->input->post('toUserEmail');
			$subject = $this->input->post('subject');
			$body_messages = $this->input->post('bodyMessages');
			$conv_id = $this->input->post('conv_id');
						
			$subject = mysql_real_escape_string($subject);
			$body_messages = mysql_real_escape_string($body_messages);
			$body_messages = strip_tags($body_messages);

			$from_user_id = $this->user_id;	                                       
			$result = $this->messages_model->send_message($to_user_email, $subject, $body_messages, $from_user_id, $conv_id);
			
			if($result == TRUE)
			{					
				$this->session->set_flashdata('success_message', 'Message has been sent successfully.');				
				redirect('messages/inbox');				
				
			} else {
				$this->session->set_flashdata('error_message', 'Opps !!! Some error while sending message.');				
				redirect('messages/compose');
			}
		}		
	 }

	 //GET messages details	 
	 function view($message_id)
	 {		
		$body_data = array();
		$body_data['view_message'] = $this->messages_model->view_message($message_id, $this->user_id);	
		
		$this->template->write_view('content', 'messages/message_details_view', $body_data, TRUE);
		$this->template->render();		 
	 }
		  
	 //Move delete massesages to trash
	 function move_trash($message_id)
	 {			
			
		$result = $this->messages_model->move_trash($message_id, $this->user_id);
		
		if($result) {		
			return true;				
		}		
	 }	
	 
	 //Move delete massesage to trash
	 function move_trash_mail($message_id)
	 {
		
		$result = $this->messages_model->move_trash($message_id, $this->user_id);
		
		if($result == TRUE) {		
			$this->session->set_flashdata('success_message', 'Message has been moved to Trash successfully.');				
			redirect('messages/inbox');					
		}		
	 }

	 //Move delete massesages to restore
	 function restore($message_id)
	 {
		$result = $this->messages_model->restore($message_id, $this->user_id);
		
		if($result) {		
			return true;				
		}		
	 }
	 
	 //Delete permanently 
	 function delete_permanently($message_id)
	 {					
		
		$result = $this->messages_model->delete_permanently($message_id, $this->user_id);
		
		if($result) {		
			return true;				
		}		
	 }

	//Mark unread
	 function mark_unread($message_id)
	 {					
		
		$result = $this->messages_model->mark_unread($message_id, $this->user_id);	
		exit;
		if($result) {	
			return true;		
		}		
	 }		 
	 	 
	 //Archived messages
	 function archive()
	 {		 
			
		$type = 'archived';
				
		$archived_messages = $this->messages_model->get_messages($type, $this->user_id);
		$body_data['archived_messages'] = $archived_messages;
		
		$this->template->write_view('content', 'messages/message_archived_view', $body_data, TRUE);
		$this->template->render();	
		
	 }	
	
	function registered_email($to_user_email)
	{			
		$result= $this->user_model->registered_email($to_user_email);
		
		if($result == TRUE) { 			
			return TRUE;
			
		} else {
			$this->form_validation->set_message('registered_email', 'This email is not registered with us.');
			return FALSE;
		}
	}
	
	private function user_check_isvalidated()
	{
		$logged_in 			= $this->session->userdata('logged_in'); 
		$role 				= $this->session->userdata('user_role_id');
		$user_ip_address 	= $this->session->userdata('user_ip_address');
			
		if($logged_in == TRUE) {
			$account_status = $this->user_model->get_user_status($this->user_role_id, $this->user_email, $this->user_id,  $this->user_status);   
		}
		
		if($logged_in == FALSE  && $role = NULL){
			$this->session->set_flashdata('error_message', 'Please login to access this page.');				
			redirect('login');

		} 
		//if logged in and inactive
		elseif(($logged_in == TRUE) && ($account_status->user_account_status == 2)){
							
			$session_data = array('user_id' => '', 'user_email' => '','user_status' => '', 'user_role_id' => '', 'logged_in' => '');
			$this->session->unset_userdata($session_data);
			$this->session->sess_destroy();	
			
			$this->session->set_flashdata('error_message', 'Your account is In-active by admin. For activate your account please contact with admin.');	
			redirect('index');

		} 	
		//if logged in and ip blocked
		elseif(($logged_in == TRUE) && ($account_status->user_ip_address_status == 0) && ($_SERVER["REMOTE_ADDR"] == $user_ip_address)){
							
			$session_data = array('user_id' => '', 'user_email' => '','user_status' => '', 'user_role_id' => '', 'logged_in' => '');
			$this->session->unset_userdata($session_data);
			$this->session->sess_destroy();	
			
			$this->session->set_flashdata('error_message', 'Your IP address is blocked by inspire credit admin. For activate please contact with admin.');	
			redirect('index');

		}
		//if logged in and deleted
		elseif(($logged_in == TRUE) && ($account_status->user_account_status == -1)){
							
			$session_data = array('user_id' => '', 'user_email' => '','user_status' => '', 'user_role_id' => '', 'logged_in' => '');
			$this->session->unset_userdata($session_data);
			$this->session->sess_destroy();	
			
			$this->session->set_flashdata('error_message', 'Your account has been deleted by inspire credit admin. For activate please contact with admin.');	
			redirect('index');

		}     
    }
	
}


/* End of file messages.php */
/* Location: ./application/controllers/messages.php */
