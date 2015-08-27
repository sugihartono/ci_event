<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Acara_Controller extends MY_Controller {
		
		function __construct(){
			parent::__construct();
			$this->is_logged_in();
			$this->load->model("Acara");
			$this->load->model("Division");
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
			$data['trans_active'] = 'dcjq-parent active';
			$data['menu_input_active'] = 'color:#FFF';
			
			$data['head'] = 'acara/v_head';
			$data['top_menu'] = 'template/v_top_menu';
			$data['left_menu'] = 'template/v_left_menu';
			$data['content'] = 'acara/v_all_list';
			$data['right_menu'] = 'acara/v_right_menu';
			$data['footer'] = 'template/v_footer';
			
			//$data['list'] = $this->acara_model->all_list();
			$this->load->view('acara/v_acara', $data);
		}
		
		public function add($step = null) {
			$data['trans_active'] = 'dcjq-parent active';
			$data['menu_input_active'] = 'color:#FFF';
			
			if ($step == null) {
				$data['divisions'] = $this->Division->loadAll();
				$data['templates'] = $this->Acara->loadAllTemplate();
				$data['today'] = date('d-m-Y');
				$data['head'] = 'acara/v_head';
				$data['top_menu'] = 'template/v_top_menu';
				$data['left_menu'] = 'template/v_left_menu';
				$data['content'] = 'acara/v_add_new';
				$data['right_menu'] = 'acara/v_right_menu';
				$data['footer'] = 'template/v_footer';
				
				$this->load->view('acara/v_acara', $data);	
			}
			else if ($step == 'next') {
				$inputs = $this->input->post();
				if (!isset($inputs["divisionCode"])) {
					header("Location: " . base_url() . "acara/add");
					exit;
				}
				
				$this->session->set_userdata("acaraHolder", $inputs);
				
				#$acaraHolder = $this->session->userdata("acaraHolder");
				#print_r($acaraHolder);
				
				$data['categories'] = $this->Acara->loadCategoryByDivision($inputs["divisionCode"]);
				$data['tillcodes'] = $this->Acara->loadTillcodeByDivision($inputs["divisionCode"]);
				$data['suppliers'] = $this->Acara->loadAllSupplier();
				$data['stores'] = $this->Acara->loadAllStore();
				$data['locations'] = $this->Acara->loadAllLocation();
				$data['today'] = date('d-m-Y');
				$data['head'] = 'acara/v_head';
				$data['top_menu'] = 'template/v_top_menu';
				$data['left_menu'] = 'template/v_left_menu';
				$data['content'] = 'acara/v_add_next';
				$data['right_menu'] = 'acara/v_right_menu';
				$data['footer'] = 'template/v_footer';
				
				$this->load->view('acara/v_acara', $data);	
			}
			
		}
		
		public function save() {
			# fix this later
			$usr = "admin";
			$upd = date("Y-m-d H:i:s");
			
			$inputs = $this->session->userdata("acaraHolder");
			$inputDetails = $this->input->post();
			
			$source = strtoupper(substr($inputs["templateCode"], 0, 1)) == "Y" ? 1 : 0;
			$isManualSetting = isset($inputs["manualSetting"]) ? 1 : 0;
			
			$isSameDate = $inputDetails["sameDate"];
			$isSameLocation = $inputDetails["sameLocation"];
			
			# date
			$dateTillcode = $inputDetails["dateTillcode"];
			$dateEventStartDate = $inputDetails["dateEventStartDate"];
			$dateEventEndDate = $inputDetails["dateEventEndDate"];
			
			$dateTillcodeArr = explode("#", $dateTillcode);
			$dateEventStartDateArr = explode("#", $dateEventStartDate);
			$dateEventEndDateArr = explode("#", $dateEventEndDate);
			
			$detailDate = array();
			for ($i = 0; $i < sizeof($dateTillcodeArr); $i++) {
				$detailDate[$i]["tillcode"] = $dateTillcodeArr[$i];
				$detailDate[$i]["dateStart"] = $dateEventStartDateArr[$i];
				$detailDate[$i]["dateEnd"] = $dateEventEndDateArr[$i];
			}
			
			# location
			$locationTillcode = $inputDetails["locationTillcode"];
			$locationLocationCode = $inputDetails["locationLocationCode"];
			$locationStoreCode = $inputDetails["locationStoreCode"];
			
			$locationTillcodeArr = explode("#", $locationTillcode);
			$locationLocationCodeArr = explode("#", $locationLocationCode);
			$locationStoreCodeArr = explode("#", $locationStoreCode);
			
			$detailLocation = array();
			for ($i = 0; $i < sizeof($locationTillcodeArr); $i++) {
				$detailLocation[$i]["tillcode"] = $locationTillcodeArr[$i];
				$detailLocation[$i]["locationCode"] = $locationLocationCodeArr[$i];
				$detailLocation[$i]["storeCode"] = $locationStoreCodeArr[$i];
			}
			
			# event
			$eventTillcode = $inputDetails["eventTillcode"];
			$eventSupplierCode = $inputDetails["eventSupplierCode"];
			$eventSupplierResponsibility = $inputDetails["eventSupplierResponsibility"];
			$eventYdsResponsibility = $inputDetails["eventYdsResponsibility"];
			$eventIsPkp = $inputDetails["eventIsPkp"];
			$eventMargin = $inputDetails["eventMargin"];
			$eventNotes = $inputDetails["eventNotes"];
			
			$eventTillcodeArr = explode("#", $eventTillcode);
			$eventSupplierCodeArr = explode("#", $eventSupplierCode);
			$eventSupplierResponsibilityArr = explode("#", $eventSupplierResponsibility);
			$eventYdsResponsibilityArr = explode("#", $eventYdsResponsibility);
			$eventIsPkpArr = explode("#", $eventIsPkp);
			$eventMarginArr = explode("#", $eventMargin);
			$eventNotesArr = explode("#", $eventNotes);
			
			$detailEvent = array();
			for ($i = 0; $i < sizeof($eventTillcodeArr); $i++) {
				$detailEvent[$i]["tillcode"] = $eventTillcodeArr[$i];
				$detailEvent[$i]["suppCode"] = $eventSupplierCodeArr[$i];
				$detailEvent[$i]["ydsResponsibility"] = $eventYdsResponsibilityArr[$i];
				$detailEvent[$i]["suppResponsibility"] = $eventSupplierResponsibilityArr[$i];
				$detailEvent[$i]["isPkp"] = $eventIsPkpArr[$i];
				$detailEvent[$i]["margin"] = $eventMarginArr[$i];
				$detailEvent[$i]["notes"] = $eventNotesArr[$i];
			}
			
			$this->Acara->addNew(
				$inputs["about"], $inputs["purpose"], $inputs["attach"], $inputs["toward"], $inputs["department"], $inputs["divisionCode"], $source,
				$inputs["templateCode"], $inputs["firstSignature"], $inputs["secondSignature"], $inputs["notes"], $inputs["cc"], $isManualSetting,
				$inputs["letterDate"], $isSameDate, $isSameLocation, $detailEvent, $detailDate, $detailLocation, $usr, $upd
			);
		}
		
		
	}

?>