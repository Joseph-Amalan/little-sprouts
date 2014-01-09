<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_missing extends CI_Controller {
		
    function __construct()
    {
        // Call the Controller constructor
        parent::__construct();	
        $this->load->library('template');
        
		//basic info for the header		 
		 $this->template->write('title', 'Error 404 | Credit Rocket');	
		 $this->template->write('heading', 'Error 404 | Credit Rocket');		 
		 $this->template->write('meta_description', 'Credit Rocket');
		 		 
		 //include regions for template
		 $this->template->write_view('topheader', 'blocks/topheader');		 
		 $this->template->write_view('megadropdown', 'blocks/megadropdown');
		 $this->template->write_view('footer', 'blocks/footer');
		 			
    }
	
	function index()
	 {			 
		  $this->template->write_view('content', 'errors/page-missing-view');
		  $this->template->render();		
	 }
}


/* End of file page_missing.php */
/* Location: ./application/controllers/page_missing.php */
