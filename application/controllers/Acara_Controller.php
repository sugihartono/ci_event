<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Acara_Controller extends MY_Controller {
		
		function __construct(){
			parent::__construct();
			//$this->load->model("acara_Model");
		}
		
		
		function index() {
			$data['head'] = 'template/v_head';
			$data['top_menu'] = 'template/v_top_menu';
			$data['left_menu'] = 'template/v_left_menu';
			$data['content'] = 'acara/v_content';
			$data['right_menu'] = 'acara/v_right_menu';
			$data['footer'] = 'acara/v_footer';
			
			$this->load->view('acara/v_acara', $data);
		}
		
		function all_list() {
			$data['menu_active'] = 'dcjq-parent active';
			$data['menu_acara_active'] = 'color:#FFF';
			
			$data['head'] = 'acara/v_head';
			$data['top_menu'] = 'template/v_top_menu';
			$data['left_menu'] = 'template/v_left_menu';
			$data['content'] = 'acara/v_all_list';
			$data['right_menu'] = 'acara/v_right_menu';
			$data['footer'] = 'template/v_footer';
			
			//$data['list'] = $this->acara_model->all_list();
			$this->load->view('acara/v_acara', $data);
		}
		
		function add_new() {
			$data['menu_active'] = 'dcjq-parent active';
			$data['menu_acara_active'] = 'color:#FFF';
			
			$data['head'] = 'acara/v_head';
			$data['top_menu'] = 'template/v_top_menu';
			$data['left_menu'] = 'template/v_left_menu';
			$data['content'] = 'acara/v_add_new';
			$data['right_menu'] = 'acara/v_right_menu';
			$data['footer'] = 'template/v_footer';
			
			$this->load->view('acara/v_acara', $data);
		}
		
		
		
		
	}

?>