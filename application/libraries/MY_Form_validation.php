<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    /**
     * Constructor
     *
     * @access    public
     */
    function __construct()
    {
        parent::__construct();
    }
    
    // --------------------------------------------------------------------

    /**
     * Validate date in yyyy-mm-dd format
     *
     * @access    public
     * @return    bool
     */
    public function date_custom($str)
    {
        return ( ! preg_match("/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/", $str)) ? FALSE : TRUE;
        
    }
    
    public function ssn_custom($str)
    {
        return ( ! preg_match("/^\d{3}-\d{2}-\d{4}$/", $str)) ? FALSE : TRUE;	
    }
    
    public function phone_custom($str)
    {
        return ( ! preg_match("/^\d{3}-\d{3}-\d{4}$/", $str)) ? FALSE : TRUE;	
    }
	
	function alpha_space_custom($str)
	{
		return (! preg_match("/^([A-Za-z ])+$/i", $str)) ? FALSE : TRUE;
	} 
	
	function username_custom($str)
	{
		return (! preg_match("/^([A-Za-z0-9_])+$/i", $str)) ? FALSE : TRUE;
	} 	
	
	
} 
// END Template Class

/* End of file MY_Form_validation.php */
/* Location: ./system/application/libraries/MY_Form_validation.php */