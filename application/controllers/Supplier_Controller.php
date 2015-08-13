<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Supplier_Controller extends MY_Controller {
		
		function __construct(){
			parent::__construct();
			$this->load->model("Supplier_Model");
		}
		
		
		function index() {
				
			$data['head'] = 'template/v_head';
			$data['top_menu'] = 'template/v_top_menu';
			$data['left_menu'] = 'template/v_left_menu';
			$data['content'] = 'supplier/v_content';
			$data['right_menu'] = 'supplier/v_right_menu';
			$data['footer'] = 'supplier/v_footer';
			
			$this->load->view('supplier/v_supplier', $data);
		}
		
		function all_list() {
			$data['menu_active'] = 'dcjq-parent active';
			$data['menu_supplier_active'] = 'color:#FFF';

			$data['head'] = 'supplier/v_head';
			$data['top_menu'] = 'template/v_top_menu';
			$data['left_menu'] = 'template/v_left_menu';
			$data['content'] = 'supplier/v_all_list';
			$data['right_menu'] = 'supplier/v_right_menu';
			$data['footer'] = 'template/v_footer';
			
			//$data['list'] = $this->Supplier_Model->all_list();
			$this->load->view('supplier/v_supplier', $data);
		}
		
		function add_new() {
			$data['menu_active'] = 'dcjq-parent active';
			$data['menu_supplier_active'] = 'color:#FFF';

			$data['head'] = 'supplier/v_head';
			$data['top_menu'] = 'template/v_top_menu';
			$data['left_menu'] = 'template/v_left_menu';
			$data['content'] = 'supplier/v_add_new';
			$data['right_menu'] = 'supplier/v_right_menu';
			$data['footer'] = 'template/v_footer';
			
			$this->load->view('supplier/v_supplier', $data);
		}
		
		
		
		
	}

?>