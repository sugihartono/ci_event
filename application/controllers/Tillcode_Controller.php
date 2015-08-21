<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Tillcode_Controller extends MY_Controller {
		
		function __construct(){
			parent::__construct();
			$this->is_logged_in();
			$this->load->model("Tillcode_Model");
		}
		
		
		function index() {
				
			$data['head'] = 'template/v_head';
			$data['top_menu'] = 'template/v_top_menu';
			$data['left_menu'] = 'template/v_left_menu';
			$data['content'] = 'tillcode/v_content';
			$data['right_menu'] = 'tillcode/v_right_menu';
			$data['footer'] = 'tillcode/v_footer';
			
			$this->load->view('tillcode/v_tillcode', $data);
		}
		
		function all_list() {
			$data['menu_active'] = 'dcjq-parent active';
			$data['menu_tillcode_active'] = 'color:#FFF';

			$data['head'] = 'tillcode/v_head';
			$data['top_menu'] = 'template/v_top_menu';
			$data['left_menu'] = 'template/v_left_menu';
			$data['content'] = 'tillcode/v_all_list';
			$data['right_menu'] = 'tillcode/v_right_menu';
			$data['footer'] = 'template/v_footer';
			
			$data['list'] = $this->Tillcode_Model->all_list();
			$this->load->view('tillcode/v_tillcode', $data);
		}
		
		function add() {
			$data['menu_active'] = 'dcjq-parent active';
			$data['menu_tillcode_active'] = 'color:#FFF';

			$data['head'] = 'tillcode/v_head';
			$data['top_menu'] = 'template/v_top_menu';
			$data['left_menu'] = 'template/v_left_menu';
			$data['content'] = 'tillcode/v_add_new';
			$data['right_menu'] = 'tillcode/v_right_menu';
			$data['footer'] = 'template/v_footer';
			
			$this->load->view('tillcode/v_tillcode', $data);
		}
		
		
		
		
	}

?>