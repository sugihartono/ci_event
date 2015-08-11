<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		

	// get subclass for public controller
	// require(APPPATH.'libraries/Public_Controller.php');	
	
	class MY_Controller extends CI_Controller {
		

		function __construct(){
			parent::__construct();
			//$this->is_logged_in();
		}
		
		function is_logged_in(){
			if(!isset($this->session->userdata['event_logged_in']['id']) || $this->session->userdata['event_logged_in']['id'] != true) {
				show_404();
				//echo 'silakan login dahulu .	';
			}
		}
		
		
		
	}
?>