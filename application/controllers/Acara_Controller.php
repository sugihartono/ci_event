<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Acara_Controller extends MY_Controller {
		
		function __construct(){
			parent::__construct();
			$this->is_logged_in();
			
			$this->load->model("Event_model");
			$this->load->model("Acara");
			$this->load->model("Division");

		}
		
		function index() {
			
		}
		
		function all_list() {
			$data['trans_active'] = 'dcjq-parent active';
			$data['menu_daftar_active'] = 'color:#FFF';
			
			$data['head'] = 'acara/v_head';
			$data['top_menu'] = 'template/v_top_menu';
			$data['left_menu'] = 'template/v_left_menu';
			$data['content'] = 'acara/v_all_list';
			$data['right_menu'] = 'acara/v_right_menu';
			$data['footer'] = 'template/v_footer';
			
			$data['list'] = $this->Event_model->all_list();
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
		

		function preview($id) {
			$data['trans_active'] = 'dcjq-parent active';
			$data['menu_daftar_active'] = 'color:#FFF';
			
			$data['head'] = 'acara/v_head';
			$data['top_menu'] = 'template/v_top_menu';
			$data['left_menu'] = 'template/v_left_menu';
			$data['content'] = 'acara/v_preview';
			$data['right_menu'] = 'acara/v_right_menu';
			$data['footer'] = 'template/v_footer';
			
			$list = $this->Event_model->get_template($id);
			
			foreach($list->result() as $r){
				//cek header
				$rheader =  str_replace(
					array("#TGL_SURAT","#NOMOR_SURAT_ACARA","#LAMPIRAN","#ACARA_DISKON",
						  "#NAMA_BRAND", "#ABOUT", "#TOWARD", "#NAMA_SUPPLIER",
						  "#KOTA", "#FAX", "#JML_DISKON", "#NAMA_BRAND"
					),
					array($this->to_dMY($r->letter_date), $r->event_no,$r->attach,$r->about,
						  $r->brand_desc, $r->purpose, $r->toward, $r->supp_desc,
						  $r->city, $r->fax, $r->about, $r->brand_desc
					),
					$r->header
				);
				
				//cek footer
				$rfooter =  str_replace(
					array("#NOTES", "#FIRST_SIGNATURE", "#SECOND_SIGNATURE", "#APPROVED_BY", "#CC"),
					array($r->notes, $r->first_signature,$r->second_signature,$r->approved_by, $r->cc),
					$r->footer
				);
				
				$rnotes =  $r->notes;
				
			} //endforeach
			
			$data['rheader'] = $rheader;
			$data['rfooter'] = $rfooter;
			$data['rnotes'] = $rnotes;
			
			// cek location
			$same_location = $this->Event_model->is_same_location($id);
			
			if ($same_location=='1'){
				$vlocation = "";
				
				$list = $this->Event_model->get_same_location_content($id);
				
				foreach ($list->result() as $r) :
				
					$yds_res = $r->yds_responsibility.'%';
					$supplier_res = $r->supp_responsibility.'%';
					
					//hitung net margin
					
					$yds_price = $r->yds_responsibility/100*$r->price;
					
					$bruto_price = $r->tax/100 * $r->price;
					
					$after_disc1 = $r->price-($r->price*$r->disc1/100);
					$after_disc2 = $after_disc1-($r->price*$r->disc2/100);
					
					$net_margin = round(($bruto_price - $yds_price) / $after_disc2*100, 2, PHP_ROUND_HALF_UP);
					
					if ($r->is_sp=='1'){
						if($r->is_pkp=='1'){
							$margin = $r->tax.'% PKP (netto)';
						} else {
							$margin = $r->tax.'% NPKP (netto)';
						}
					} 
					else{
						if($r->is_pkp=='1'){
							$margin = $r->tax.'% PKP (bruto) -> Nett margin = '.$net_margin.'%';
						} else {
							$margin = $r->tax.'% NPKP (bruto) -> Nett margin = '.$net_margin.'%';
						}	
					}
					
					
					
					$vlocation .= "<tr><td>Acara</td>
										<td>:</td>
										<td>".$r->disc_label."</td>
									<tr>
									<tr><td>Pertanggungan</td>
										<td>:</td>
										<td>YDS $yds_res SUPPLIER $supplier_res</td>
									<tr>
									<tr><td>Margin Yogya</td>
										<td>:</td>
										<td>$margin</td>
									<tr>
									";		
									
					//cek same date
					$same_date = $this->Event_model->is_same_date($id);
					if ($same_date!='1'){
						
						//get tanggal by event id n tillcode
						$date = $this->Event_model->get_event_date($id, $r->tillcode);
						
						$rdate = "";				
						foreach ($date->result() as $res) :
							if (($res->date_end==null) || ($res->date_end=="")){
								$rdate .= $this->to_dMY($res->date_start).', '; 
							} else {
								$rdate .= $this->to_dMY($res->date_start).' - '.$this->to_dMY($res->date_end).', '; 	
							}
						endforeach;
						
						$vlocation .= "<tr><td>Tanggal</td>
											<td>:</td>
											<td>$rdate</td>
										<tr>";
						$vlocation .=  "<tr><td colspan='3'><br></td></tr>";
						
					} else {
						
						//get tanggal by event id
						$date = $this->Event_model->get_event_same_date($id);
						
						$rdate = "";				
						foreach ($date->result() as $res) :
							$rdate .= $this->to_dMY($res->date_start).' - '.to_dMY($res->date_end).', '; 	
						endforeach;
						
						$date_tmp .= "<tr><td>Tanggal</td>
										<td>:</td>
										<td>$rdate</td>
									<tr>";
							
						
					}
					
				endforeach;
				
				
				
				
				
				
			} 
			
			//same location = 0 //////////////////////////////////////////////////////////////////////////////////////////
			else {
				/* $vlocation = "";
				
				$list = $this->Event_model->get_diff_location_content($id);
				
				foreach ($list->result() as $r) :
				
					$yds_res = $r->yds_responsibility.'%';
					$supplier_res = $r->supp_responsibility.'%';
					
					if($r->is_pkp=='1'){
						$margin = $r->brutto_margin.' PKP (bruto) -> Nett margin = '.$r->net_margin.'%';
					} else {
						$margin = $r->brutto_margin.' NPKP (bruto) -> Nett margin = '.$r->net_margin.'%';
					}
					
					$vlocation .= "<tr><td>Acara</td>
										<td>:</td>
										<td>".$r->disc_label."</td>
									<tr>
									<tr><td>Pertanggungan</td>
										<td>:</td>
										<td>YDS $yds_res SUPPLIER $supplier_res</td>
									<tr>
									<tr><td>Margin Yogya</td>
										<td>:</td>
										<td>$margin</td>
									<tr>
									";		
									
					//cek same date
					$same_date = $this->Event_model->is_same_date($id);
					if ($same_date!='1'){
						
						//get tanggal by event id n tillcode
						$date = $this->Event_model->get_event_date($id, $r->tillcode);
						
						$rdate = "";				
						foreach ($date->result() as $res) :
							if (($res->date_end==null) || ($res->date_end=="")){
								$rdate .= $this->to_dMY($res->date_start).', '; 
							} else {
								$rdate .= $this->to_dMY($res->date_start).' - '.$this->to_dMY($res->date_end).', '; 	
							}
						endforeach;
						
						$vlocation .= "<tr><td>Tanggal</td>
											<td>:</td>
											<td>$rdate</td>
										<tr>";
						$vlocation .=  "<tr><td colspan='3'><br></td></tr>";
						
					} else {
						
						//get tanggal by event id
						$date = $this->Event_model->get_event_same_date($id);
						
						$rdate = "";				
						foreach ($date->result() as $res) :
							$rdate .= $this->to_dMY($res->date_start).' - '.to_dMY($res->date_end).', '; 	
						endforeach;
						
						$date_tmp .= "<tr><td>Tanggal</td>
										<td>:</td>
										<td>$rdate</td>
									<tr>";
							
						
					}
					
				endforeach; */
			}
			
			
			
			
			$supp = $this->Event_model->get_supplier($id);
			
			foreach ($supp->result() as $res) :
				$supp_code = $res->supp_code;
			endforeach;
			
			$vlocation .= "<tr><td>Kode Supplier</td>
								<td>:</td>
								<td>".$supp_code."</td>
							</tr>";	
			$vlocation .=  "<tr><td colspan='3'><br></td></tr>";
			
			
			//get tillcode
			$tillcode = $this->Event_model->get_tillcode($id);
			
			$rtillcode = "";
			foreach ($tillcode->result() as $res) :
				$rtillcode .= $res->tillcode.' ('.$res->disc_label.'), ';
			endforeach;
			
			$vlocation .= "<tr><td>Tillcode</td>
								<td>:</td>
								<td>".$rtillcode."</td>
							</tr>";	
			$vlocation .=  "<tr><td colspan='3'><br></td></tr>";
			
			
			
			//cek date tmp 
			(isset($date_tmp)? $vlocation .= $date_tmp : "");
			
			//tempat acara
			$rlocation = $this->Event_model->get_event_same_location($id);
			$vlocation .= "<tr><td colspan='2'>Tempat Acara :</td></tr>";	
			
			
			foreach ($rlocation->result() as $res) :
				$vlocation .= "<tr><td colspan='2'></td><td>".$res->loc_desc." ".$res->store_desc."</td></tr>";	
			endforeach;
			
			$vlocation .=  "<tr><td colspan='3'><br></td></tr>";
			
			
			
			$data['vlocation'] = $vlocation;
			
			$this->load->view('acara/v_acara', $data);
			
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