<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

//http://codeigniter.com/forums/viewthread/171279/

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		$this->load->library('session');
		//$this->_ci->load->helper('url');
	}

	public function user_check_isvalidated()
	{
            $logged_in = $this->session->userdata('logged_in'); 
            $status = $this->session->userdata('user_status'); 
            $role = $this->session->userdata('user_role_id');            
            
            
			if(($logged_in == FALSE ) || ($logged_in == "") || ($logged_in == NULL)){
				$this->session->set_flashdata('error_message', 'You should be loged-in to view this page.');				
				redirect('login');
			}
			
			/*
		   //if renter is loggin and completed registration
			elseif(($logged_in == TRUE ) && ($status == 2) && ($role == 1)){
				redirect('renter/dashboard');
			}
			//if landlord is loggin and completed registration
			elseif(($logged_in == TRUE ) && ($status == 2) && ($role == 2)){
				redirect('landlord/dashboard');
			}
			*/				
			
			//if logged in but email is not activated
			elseif(($logged_in == TRUE ) && ($status == 0)){
					 
				$this->session->set_flashdata('error_message', 'Yor are already loged-in, but your email is not activated yet. Please check your mail to activate.');				
				redirect('index');
							
			}
		
			//if renter is logged in but second registration is not completed
			elseif(($logged_in == TRUE ) && ($status == 1) && ($role == 1)){
                     
				$this->session->set_flashdata('error_message', 'In order to use your Credit Rocket account, you have to fill some more fields.');				
                redirect('renter/get_started');
                        
			}
			//if landlord is logged in but second registration is not completed
			elseif(($logged_in == TRUE ) && ($status == 1) && ($role == 2)){
				 
				$this->session->set_flashdata('error_message', 'In order to use your Credit Rocket account, you have to fill some more fields.');				
                redirect('landlord/get_started');
                        
			}		
    }
	
	// for validating date in yyyy-dd-mm format
	public function valid_date($date)
	{
		$date_format = 'm-d-Y'; /* use dashes - dd/mm/yyyy */

		$date = trim($date);
		/* UK dates and strtotime() don't work with slashes, 
		so just do a quick replace */
		//$date = str_replace('/', '-', $date); 

		$time = strtotime($date);

		$is_valid = date($date_format, $time) == $date;

		if($is_valid)
		{
			return true;
		}

		/* not a valid date..return false */
		return false;
	}
	
   
}
// END Template Class

/* End of file user_authentication.php */
/* Location: ./system/application/libraries/user_authentication.php */