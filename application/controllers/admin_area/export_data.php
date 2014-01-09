<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Export_data extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->library('admin_template');
        $this->load->library('excel');



        $this->admin_check_isvalidated();
        $this->load->model('admin_area/export/export_model');
        $this->load->library('admin_popup_template');

        //get admin data from session  		
        $this->admin_id = $this->session->userdata('admin_id');
        $this->admin_email = $this->session->userdata('admin_email');
        $this->admin_role_id = $this->session->userdata('admin_role_id');

        $this->load->model('admin_area/admin/admin_model');
        $this->load->model('admin_area/renter/renter_model');

        //basic info for the header		 
        $this->admin_template->write('title', 'Admin Little Sprouts - Export Data');

        //include regions for template
        $this->admin_template->write_view('header', 'admin_area/blocks/header');
        $this->admin_template->write_view('right_side_bar', 'admin_area/blocks/rightside');
        $this->admin_template->write_view('footer', 'admin_area/blocks/footer');

        //This method will have the credentials validation
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

    /** 28-11-2012:start:Poli: All registered & active renters * */
    

function index() {
        redirect('admin_area/export_data/getinstance_list');
    }

    function getinstance_list() {
        $data = array();
        $data['schools'] = $this->export_model->get_schools();
        $data['instances'] = $this->export_model->get_instance_data();
       $data['status1'] = $this->export_model->get_school_status();

         $this->admin_template->write_view('content', 'admin_area/export_data/export_data_view', $data, TRUE);
        $this->admin_template->render();
    }
     function getclass_list($school) {
        $schoolname = utf8_decode(urldecode($school));
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->export_model->get_classes($schoolname)));
    }

    
    function export_data_form_submit() {
        $data = array();
        if (isset($_POST["saveForm"])) { 
 /*$get_school_id = mysql_escape_string($this->input->post('school_id'));
 $get_class_id = mysql_escape_string($this->input->post('preclass_id'));*/
 $get_instance_id = mysql_escape_string($this->input->post('selectinstance_name'));
  // $get_status_id = mysql_escape_string($this->input->post('status_id'));

            $name = 'student_details';
            $today = date("d-m-Y");  
            //$name='student_details' . '_'.date("Y-m-d H:i:s");
            $Filename=$name.$today;
             $data = $data['detail'] = $this->export_model->get_data($get_instance_id);
            //$data = $data['detail'] = $this->export_model->get_data($get_school_id,$get_class_id,$get_instance_id,$get_status_id);
            $cell = $hdrLine = '';
            $header = true;

            if (is_array($data)) {
                foreach ($data as $arr) {
                    $line = '';

                    foreach ($arr as $key => $value) {
                        if ($header) {
                            $hdrHTML = '"' . $key . '"' . "\t";
                            $hdrLine .= $hdrHTML;
                        }
                        if ((!isset($value)) || ($value == "")) {
                            $value = "\t";
                        }//end if 
                        else {
                            $value = str_replace('"', '""', $value);
                            $value = '"' . $value . '"' . "\t";
                        }

                        $line .= $value;
                    }
                    if ($header) {
                        $cell = trim($hdrLine) . "\n";
                        $header = false;
                    }
                    $cell .= trim($line) . "\n";
                }

                $cell = str_replace("\r", "", $cell);

                
                
                header("Content-type: application/octet-stream"); //$fileName = 
                header("Content-Disposition:attachment;filename=$Filename.xls");
                header("Pragma: no-cache");
                header("Expires: 0");
                print "$cell";
                exit;
            }
        }
         $data['instances'] = $this->export_model->get_instance_data();
        $this->admin_template->write_view('content', 'admin_area/export_data/export_data_view', $data, TRUE);
        $this->admin_template->render();



        //$table_name = $this->input->post('export_data');
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

/* End of file List_renters.php */
/* Location: ./application/controllers/admin_area/List_renters.php */
?>

