<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot_password extends CI_Controller {
		
   function __construct()
    {
		// Call the Controller constructor
		parent::__construct();
        $this->load->library('template');
                
        $this->user_check_isvalidated();                
		$this->load->model('user/user_model');
				
		//basic info for the header		 
		$this->template->write('title', "Forgot password | Inspire Credit - 'It's What Moves You!");	
		$this->template->write('heading', 'Inspire Credit');		 
		$this->template->write('meta_description', 'Inspire Credit');
		 
		//include regions for template
		$this->template->write_view('topheader', 'blocks/topheader');
		$this->template->write_view('megadropdown', 'blocks/megadropdown');	
		$this->template->write_view('footer', 'blocks/footer');		 		 			
    }
		
	function index()
	 {	
		//This method will have validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[150]|xss_clean');
		 
		if($this->form_validation->run() == FALSE) {	
			
			$this->template->write_view('content', 'user/forgot_password_view');
			$this->template->render();				
		}
		else {	
			$email 	  = $this->input->post('email');
			// Validate the user can login
			$result = $this->user_model->forgot_password_email_validate($email);
			 
			 if(!$result){						 
				$this->session->set_flashdata('error_message', 'Oops! This email is not registered with us, please enter registered email address.');				
				redirect('forgot_password');
				
			 } elseif($result->user_account_status == 0){
                             
                                $this->session->set_flashdata('error_message', 'You Account is Deactivated, if you againt want to activate it, please contact us.');				
                                redirect('contact_us');
                         }
                         else{		
                                
                                $mail_data = array();
                             
				$user_key = md5(rand(0, 10000));
				$user_key_val = md5($user_key);	
				
				$mail_data["forgot_Password_link"] = $this->user_model->generate_forgot_Password_link($result->user_id,$result->user_role_id,$result->user_email, $user_key, $user_key_val);
				
				// send an email  
				$this->load->library('email');	

				$this->email->from('selvem.jose@gmail.com', 'Inspire Credit');
				$this->email->to($email); 
				$this->email->subject("Inspire Credit - Forgot Password");			
				$this->email->message($this->load->view('emails/forgot_password_mail_html',$mail_data, true));

				if($this->email->send()) {
					
					$this->session->set_flashdata('success_message', 'To get your new password please check your email.');
					redirect('login');
				}
				else {
					//echo $this->email->print_debugger();
					$this->session->set_flashdata('error_message', 'Oops!!! Some error occured while sending email');
					redirect('forgot_password');
				}				
			}				 
		}				
	}

	function activate ($user_key = NULL, $user_role_id = NULL, $user_email = NULL)
	 {		
		if (isset($user_key) && isset($user_role_id) && isset($user_email)) {	
		
			 $result = $this->user_model->forgot_password_url_validate($user_key, $user_role_id, $user_email);
			 
			if ($result) {
                                
				$session_data = array(
					'user_id' => $result->user_id,
					'user_email' => $result->user_email,
					'user_role_id' => $result->user_role_id,
					'user_status' => $result->user_status,                                    
					//'user_account_status' => $result->user_account_status,
					'logged_in' => FALSE
				);

				$this->session->set_userdata($session_data);
                                
				redirect('reset_password');
			}
			else {
				$this->session->set_flashdata('error_message', 'Oops! Incorrect URL, please click on link provided in your mail accoout or copy paste the url in browser.');				
			        redirect('login');
			}
		}else{
			$this->session->set_flashdata('error_message', 'Oops! Incorrect URL, please click on link provided in your mail accoout or copy paste the url in browser.');				
                        redirect('index');
		}     
	 } //end of activation function 
         
    private function user_check_isvalidated()
	{
            $logged_in = $this->session->userdata('logged_in'); 
            $role = $this->session->userdata('user_role_id');
                
            //if renter is logged in 
            if(($logged_in == TRUE ) && ($role == 1)){                     
				$this->session->set_flashdata('success_message', 'You are already logged in.');		
				redirect('renter/dashboard');
							
			}
			//if landlord is logged in 
			elseif(($logged_in == TRUE ) && ($role == 2)){                     
				$this->session->set_flashdata('success_message', 'You are already logged in.');				
                redirect('landlord/dashboard');
                        
			}                
			//if csr is logged in 
			elseif(($logged_in == TRUE ) && ($role == 3)){                     
				$this->session->set_flashdata('success_message', 'You are already logged in.');		
                redirect('csr/dashboard');                        
			}  
      }
		
}

/* End of file forgot_password.php */
/* Location: ./application/controllers/forgot_password.php */
