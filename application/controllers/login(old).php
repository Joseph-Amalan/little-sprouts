<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
		
    function __construct() 
    {
		// Call the Controller constructor
		parent::__construct(); 
        $this->load->library('template');                                
		$this->user_check_isvalidated();
				
		$this->load->model('user/user_model');
		
		//basic info for the header		 
		$this->template->write('title', "Login | Inspire Credit - 'It's What Moves You!");	
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
			
		//$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[150]|xss_clean');
		$this->form_validation->set_rules('username', 'username', 'trim|required|min_length[6]|max_length[20]|username_custom|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[200]|xss_clean');
		 
		if($this->form_validation->run() == FALSE) {		
			
			$this->template->write_view('content', 'user/login_view');
			$this->template->render();
                        
		}else {			
			
			//$email 	  = $this->input->post('email');
			$username 	  = $this->input->post('username');
            //encrypt the password before passing it to function
			$password = md5($this->input->post('password'));

			// Validate the user 
			$result = $this->user_model->login_validate($username,$password);
                       
			/*   if($result){                                
					echo "<pre>";
					print_r($result);
					echo "</pre>";                        
				} exit; 
			 */ 
                         
			if($result == FALSE){			 
				$this->session->set_flashdata('error_message', 'Invalid Username and Password, Please try again.');				
				redirect('login');
                                
			 } else if(($result -> user_name === $username) && ($result -> user_pw === $password)) {
			 
				if($result->user_account_status == 0){                                    
					$this->session->set_flashdata('error_message', 'You Account is Deactivated, if you againt want to activate it, please contact us.');				
					redirect('login');

				}elseif(($result->user_status == 0) && ($result->user_account_status == 1)){                                    
					$this->session->set_flashdata('error_message', 'Your registration is not confirm by your landlord yet.');				
					redirect('login');

				}elseif(($result->user_status == 1) && ($result->user_account_status == 2)){                                    
					$this->session->set_flashdata('error_message', 'Your account is In-active by admin. For activate your account please contact with admin.');				
					redirect('login');

				}elseif(($result->user_status == 2) && ($result->user_account_status == 2)){                                    
					$this->session->set_flashdata('error_message', 'Your email is In-active. For activate your account please contact with admin.');				
					redirect('login');

				}elseif($result->user_ip_address_status == 0 && ($_SERVER["REMOTE_ADDR"] == $result->user_ip_address)){                                    
					$this->session->set_flashdata('error_message', 'Your IP address is block by inspire credit admin. For activate please contact with admin.');				
					redirect('login');

				}elseif(($result->user_status == 1) && ($result->user_account_status == 1)){				
					
					$session_data = array(
						'user_id' => $result->user_id,
						'user_email' => $result->user_email,						
						'user_name'  => $result->user_name,
						'user_status' => $result->user_status,
						'user_role_id' => $result->user_role_id,
						'user_ip_address' => $result->user_ip_address,
						'logged_in' => true
					);					
					$this->session->set_userdata($session_data);									
					$this->session->set_flashdata('success_message', 'Welcome to Little Sprouts');				
					
					//if renter
					if($result->user_role_id == 1 ) {  
						redirect('renter/dashboard');	
					   
					} 
					//if landloard
					else if($result->user_role_id == 2 ) {
						redirect('landlord/dashboard');                                         

					} 
					//if CSR
					else if($result->user_role_id == 3 ) {
						redirect('csr/fill_information');						
					}
				}elseif(($result->user_status == 2) && ($result->user_account_status == 1)){				
					
					$session_data = array(
						'user_id' => $result->user_id,
						'user_email' => $result->user_email,						
						'user_name'  => $result->user_name,
						'user_status' => $result->user_status,
						'user_role_id' => $result->user_role_id,
						'user_ip_address' => $result->user_ip_address,
						'logged_in' => true
					);					
					$this->session->set_userdata($session_data);
					
					$this->session->set_flashdata('success_message', 'Welcome to Credit Rocket');				
					
					//if CSR
					if($result->user_role_id == 3 ) {
						redirect('csr/dashboard');						
					}
				}
		    }				 
		}				
	}

	private function user_check_isvalidated()
	{
		$logged_in = $this->session->userdata('logged_in'); 
		$status = $this->session->userdata('user_status'); 
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
                    
			if($status == 1) {
				$this->session->set_flashdata('success_message', 'In order to use your Credit Inspire account, you have to fill some more fields.');		
				redirect('csr/fill_information');
				
			} elseif ($status == 2) {				
				$this->session->set_flashdata('success_message', 'You are already logged in.');		
				redirect('csr/dashboard');
				
			}                        
		}  
    }
        
} // end of class


/* End of file login.php */
/* Location: ./application/controllers/login.php */
