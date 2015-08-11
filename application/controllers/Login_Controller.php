<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Login_Controller extends MY_Controller {
		
		function __construct(){
			parent::__construct();
		}
		
		
		function index() {
			
			$this->load->view('login/v_login');
		}
		
		function do_login(){
			/* $this->load->model('User_model');
			$username = $this->input->post('txt_username');
			$pass = $this->input->post('txt_pass');
			$res = $this->User_model->login($username, $pass);
			
			if ($res){
				$sess_array = array();
				foreach($res as $row){
					$sess_array = array(
						'id' => $row->id,
						'username' => $row->username,
						'role' => $row->role,
						'init_cabang' => $row->init_cabang
					);
					$this->session->set_userdata('event_logged_in', $sess_array);
				}
				$this->User_model->add_log($this->session->userdata['event_logged_in']['id'], $this->session->userdata['event_logged_in']['username']);
				redirect('home');
				
			} else {
				redirect('login');
			} */
			
			redirect('home/');
		}
		
		function logout() {
			session_start(); 
			//$this->session->unset_userdata('event_logged_in');
			session_destroy();
			redirect('login', 'refresh');
		}
		
		
		
	}

?>