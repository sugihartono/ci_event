<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Template_Controller extends MY_Controller {
		
		function __construct(){
			parent::__construct();
			$this->is_logged_in();
			$this->load->model("Template_Model");
		}
		
		function add() {
			$data['menu_active'] = 'dcjq-parent active';
			$data['menu_template_active'] = 'color:#FFF';
			
			$data['head'] = 'template_master/v_head';
			$data['top_menu'] = 'template/v_top_menu';
			$data['left_menu'] = 'template/v_left_menu';
			$data['content'] = 'template_master/v_add_new';
			$data['right_menu'] = 'template_master/v_right_menu';
			$data['footer'] = 'template/v_footer';
			
			// attach xinha editor
			$this->load->file(APPPATH.'third_party/xinha_pi.php');
			$data['xinha_java']= javascript_xinha(array('txt_header', 'txt_footer', 'txt_notes')); // this line for the xinha
			
			
			$this->load->view('template_master/v_template', $data);
		}
		
		function do_add_new(){
			$this->Template_Model->do_add_new($this->session->userdata['event_logged_in']['username']);
			
			//$this->session->set_flashdata('msg', ' Data berhasil di simpan.');
			
			header("template");
			
		}
		
		
		
	}

?>