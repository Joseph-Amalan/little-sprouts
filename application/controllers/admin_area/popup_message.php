<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Popup_message extends CI_Controller {
		
    function __construct()
    {
        // Call the Controller constructor
        parent::__construct();	
        $this->load->library('admin_popup_template'); 
			 			
    }
	
	function index()
	 {
		$this->admin_popup_template->write_view('content','admin_area/popup/messages');
		$this->admin_popup_template->render();	
			 	
	 } 
}


/* End of file popup_message.php */
/* Location: ./application/controllers/popup/popup_message.php */
