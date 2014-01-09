<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About_us extends CI_Controller {
		
	function __construct()
    {
        // Call the Controller constructor
        parent::__construct();	
        $this->load->library('template');		
        
		//basic info for the header		 
		$this->template->write('title', "About us | Little Sprouts");	
		$this->template->write('heading', 'Little Sprouts');		 
		$this->template->write('meta_description', 'Little Sprouts');
		 
		 //include regions for template
		 $this->template->write_view('topheader', 'blocks/topheader');
		 $this->template->write_view('megadropdown', 'blocks/megadropdown');		
		 $this->template->write_view('footer', 'blocks/footer');		 		 			
    }
	
	function index()
	 {		  
		  $this->template->write_view('content', 'about_us/about_us_view');
		  $this->template->render();		
	 }	
}


/* End of file about_us.php */
/* Location: ./application/controllers/about_us.php */
