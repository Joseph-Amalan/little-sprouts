<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Create_user_account extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->admin_check_isvalidated();
        $this->load->library('admin_template');

        $this->load->model('admin_area/admin/admin_model');

        //basic info for the header		 
        $this->admin_template->write('title', 'Admin Little Sprouts');

        //include regions for template
        $this->admin_template->write_view('header', 'admin_area/blocks/header');
        $this->admin_template->write_view('right_side_bar', 'admin_area/blocks/rightside');
        $this->admin_template->write_view('footer', 'admin_area/blocks/footer');
    }

    function index() {
        //This method will have validation
        
       $data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->form_validation->set_rules('username', 'Name', 'trim|required|valid_username|max_length[150]|');

        $this->form_validation->set_rules('password', 'Password', 'trim|required|valid_password|max_length[150]|xss_clean');
        //$this->form_validation->set_rules('userEmail', 'Email', 'trim|required|valid_email|max_length[150]|xss_clean');
        
         $this->form_validation->set_rules('userrole', 'UserRole', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
             
          
            $data['schools'] = $this->admin_model->get_schools();

            $this->admin_template->write_view('content', 'admin_area/create_user_account/create_user_account_view',$data,TRUE);
            $this->admin_template->render();
        } else {

            /* $user_key 		= md5(rand(0, 10000));
              $user_key_val   = md5($user_key); */

            $user_emails = $this->input->post('userEmail');
            if(($user_emails) != "")
            {$user_email= $user_emails;}
            else
            {
               $user_email=""; 
                
            }
            $password = $this->input->post('password');
            $user_password = md5($password);
            $username = $this->input->post('username');
            $userrole = $this->input->post('userrole');
            
            $target['tar'] = $this->input->post('tar');
            $assignschools=$target['tar'];
            
            //print_r($target['tar']);
//print_r($assignschools);die;
            // $userrole = $this->input->post('userrole');
            
            
            //$user_name  = $this->admin_model->generatePassword (7);
            //$user_password  = $this->admin_model->generatePassword (9);

            $admin_id = $this->session->userdata('admin_id');
            $admin_email = $this->session->userdata('admin_email');
            $admin_role_id = $this->session->userdata('admin_role_id');

            // Validate the user 
            $result = $this->admin_model->create_user_account($user_email, $username, $user_password, $userrole,$assignschools,$admin_id, $admin_email, $admin_role_id);

            if ($result == TRUE) {

               /* $mail_data = array();
                $mail_data['user_email'] = $user_email;
                $mail_data['user_name'] = $user_name;
                $mail_data['user_password'] = $user_password;

                // send an email  
                $this->load->library('email');

                $this->email->from('vembu.sri@gmail.com', 'Little Sprouts');
                $this->email->to($user_email);
                $this->email->subject("Login information from Credit Inspire");
                $this->email->message($this->load->view('admin_area/emails/create_user-mail-html', $mail_data, true));

                if ($this->email->send()) {*/

                    $this->session->set_flashdata('success_message', 'User account has been created successfully.');
                    //$this->admin_template->write_view('content', 'admin_area/dashboard', $data, TRUE);
                    redirect('admin_area/dashboard');
                } else {
                    //echo $this->email->print_debugger();
                    $this->session->set_flashdata('error_message', 'Oops!!! This User name / Email already registered , Please try again.');
                    redirect('admin_area/create_user_account');
                }
            } 
        }
   

    private function admin_check_isvalidated() {
        $admin_logged_in = $this->session->userdata('admin_logged_in');
        $admin_role = $this->session->userdata('admin_role_id');

        if (($admin_logged_in == FALSE) || ($admin_role == NULL)) {

            $this->session->set_flashdata('error_message', 'Please login to access this page.');
            redirect('admin_area/index');
        }
    }

}

/* End of file Create_user_account.php */
/* Location: ./application/controllers/admin_area/Create_user_account.php */
?>


