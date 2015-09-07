<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	date_default_timezone_set('Asia/Jakarta');		

	// get subclass for public controller
	// require(APPPATH.'libraries/Public_Controller.php');	
	
	class MY_Controller extends CI_Controller {
		

		function __construct(){
			parent::__construct();
			
		}
		
		function is_logged_in(){
			if(!isset($this->session->userdata['event_logged_in']['username']) || $this->session->userdata['event_logged_in']['username'] != true) {
				show_404();
				//echo 'silakan login dahulu .	';
			}
		}
		
		public function to_dMY($date){
			$fmt = date('d M Y', strtotime($date));
			return $fmt;
		}
		
	}
?>