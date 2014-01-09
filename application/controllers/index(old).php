<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
		
	 function __construct() {
	 
		 parent::__construct();                 
         $this->load->library('template'); 
	  
		//basic info for the header		 
		$this->template->write('title', "Inspire Credit - 'It's What Moves You!'");	
		$this->template->write('heading', 'Inspire Credit');		 
		$this->template->write('meta_description', 'Inspire Credit');
		
		//include regions for template
		$this->template->write_view('topheader', 'blocks/topheader');
		$this->template->write_view('megadropdown', 'blocks/megadropdown');	
		$this->template->write_view('footer', 'blocks/footer');	 
   }
   
   function index()
   {		
	    $this->template->write_view('content', 'index-view');
	    $this->template->render();		
   }
   
}


/* End of file index.php */
/* Location: ./application/controllers/index.php */
?>

