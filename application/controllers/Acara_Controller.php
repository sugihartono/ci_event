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
		
		function get_template($id){
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
				
				$rnotes =  $r->template_notes;
				
			} 

			return array(
					    'rheader' => $rheader,
					    'rfooter' => $rfooter,
					    'rnotes' => $rnotes
					);
		}

		function get_event_date($id, $tillcode){
			//get tanggal by event id n tillcode
			$date = $this->Event_model->get_event_date($id, $tillcode);
			
			$rdate = "";				
			$vlocation = "";				
			foreach ($date->result() as $res) :
				if (($res->date_end==null) || ($res->date_end=="")){
					$rdate .= $this->to_dMY($res->date_start).', '; 
				} else {
					$rdate .= $this->to_dMY($res->date_start).' - '.$this->to_dMY($res->date_end).', '; 	
				}
			endforeach;
			
			$vlocation .= "<tr><td>Tanggal</td>
								<td>:</td>
								<td><b>".rtrim($rdate, ", ")."</b></td>
							</tr>";
			$vlocation .=  "<tr><td colspan='3'><br></td></tr>";

			return $vlocation;
		}

		function get_event_same_date($id){
			//get tanggal by event id
			$date = $this->Event_model->get_event_same_date($id);
			
			$rdate = "";				
			$date_tmp = "";				
			foreach ($date->result() as $res) :
				$rdate .= $this->to_dMY($res->date_start).' - '.$this->to_dMY($res->date_end).', '; 	
			endforeach;
			
			$date_tmp .= "<tr><td>Tanggal</td>
							<td>:</td>
							<td><b>".rtrim($rdate, ", ")."</b></td>
						</tr>";

			return $date_tmp;
		}

		function get_event_location($id, $tillcode){
			$rlocation = $this->Event_model->get_event_location($id, $tillcode);

			$i=0;
			$tmp_loc = "";
			$vlocation = "";
			foreach ($rlocation->result() as $res) :
				$i++;
				if ($i%3==0){
					$tmp_loc .= "<br>";
				}
				$tmp_loc .= $res->loc_desc." <b>".$res->store_desc."</b>, ";	
			endforeach;

			$vlocation .= "<tr>
								<td>Tempat Acara</td>
								<td>:</td>
								<td>".rtrim($tmp_loc, ", ")."</td>
							</tr>
							<tr><td colspan='3'><br></td></tr>";
			return $vlocation;				
		}

		function get_supplier($id){
			$vlocation ="";
			$supp = $this->Event_model->get_supplier($id);
			
			foreach ($supp->result() as $res) :
				$supp_code = $res->supp_code;
			endforeach;
			
			$vlocation .= "<tr><td>Kode Supplier</td>
								<td>:</td>
								<td>".$supp_code."</td>
							</tr>";	
			$vlocation .=  "<tr><td colspan='3'><br></td></tr>";
			return $vlocation;

		}

		function get_tillcode($id){
			$tillcode = $this->Event_model->get_tillcode($id);
			
			$rtillcode = "";
			$vlocation = "";
			$x = 0;
			foreach ($tillcode->result() as $res) :
				$x++;

				if ($x%3==0){
					$rtillcode .= "<br>";
				}
				$rtillcode .= $res->tillcode.' ('.$res->disc_label.'), ';
			endforeach;
			
			$vlocation .= "<tr><td>Tillcode</td>
								<td>:</td>
								<td>".rtrim($rtillcode, ", ")."</td>
							</tr>";	
			$vlocation .=  "<tr><td colspan='3'><br></td></tr>";

			return $vlocation;

		}

		function get_event_same_location($id){
			$rlocation = $this->Event_model->get_event_same_location($id);

			$i=0;
			$tmp_loc = "";
			$vlocation = ""; 
			foreach ($rlocation->result() as $res) :
				$i++;
				if ($i%3==0){
					$tmp_loc .= "<br>";
				}
				$tmp_loc .= $res->loc_desc." <b>".$res->store_desc."</b>, ";	
			endforeach;
			
			$vlocation .= "<tr>
								<td>Tempat Acara</td>
								<td>:</td>
								<td>".rtrim($tmp_loc, ", ")."</td>
							</tr>
							<tr><td colspan='3'><br></td></tr>";
			return $vlocation;

		}

		function get_perhitungan($id){
			$vcalculate = "<table>
							<tr><td colspan='2'>Adapun contoh perhitungannya adalah</td>
								<td>:</td>
							</tr>";	
			//calculate disc
			$list = $this->Event_model->get_calculate($id);

			foreach ($list->result() as $r) {
				$hrg = 100000;
				

				if($r->is_pkp=='1'){
					$pmargin = $r->tax.'% PKP';
				} else {
					$pmargin = $r->tax.'% NPKP';
				}

				$margin = $hrg*$r->tax/100;

				//$tmp = $hrg*$r->disc1/100;//100.000*0.2
				

				$after_disc1 = $hrg-($hrg*$r->disc1/100);
				$after_disc2 = $after_disc1-($after_disc1*$r->disc2/100);

				$jml_diskon = (1-($after_disc2/$hrg));
				$yds = $r->yds_responsibility/100*$jml_diskon;

				$tmp2 = $hrg*$jml_diskon;20.000-

				$sel = $hrg - $tmp2;

				$sel_margin = $sel - $margin;

				$yds_res = $yds*$hrg;

				$bayar = $sel_margin + $yds_res;

				$nett_magin = round((($margin-$yds_res) / $sel)*100, 2, PHP_ROUND_HALF_UP);
				
				if ($r->is_sp=='0'){
					$label1 = $r->disc1;
					($r->disc2=="0" ? $label2="":$label2="+ ".$r->disc2."%");

					$label = "Disc. ".$label1."% ".$label2;

					$vcalculate .= "<tr><td colspan='3'><b><u>".$label."</u></b></td>
									</tr>";	
					$vcalculate .= "<tr><td>Harga Jual</td>
										<td>Rp. </td>
										<td align='right'>".number_format($hrg, 0, ",", ".")."</td>
									</tr>";	
					$vcalculate .= "<tr><td>".$label."</td>
										<td>Rp. </td>
										<td align='right'><u>".number_format($tmp2, 0, ",", ".")."</u></td>
										<td><u> - </u></td>
									</tr>";	
					$vcalculate .= "<tr><td>&nbsp;</td>
										<td>Rp. </td>
										<td align='right'>".number_format($sel, 0, ",", ".")."</td>
									</tr>";	
					$vcalculate .= "<tr><td>Margin Yogya ".$pmargin."</td>
										<td>Rp. </td>
										<td align='right'><u>".number_format($margin, 0, ",", ".")."</u></td>
										<td><u> - </u></td>
									</tr>";									
					$vcalculate .= "<tr><td></td>
										<td>Rp. </td>
										<td align='right'>".number_format($sel_margin, 0, ",", ".")."</td>
									</tr>";	
					$vcalculate .= "<tr><td>Partisipasi Yogya ".$label."&nbsp;&nbsp;&nbsp;&nbsp;</td>
										<td>Rp. </td>
										<td align='right'><u>".number_format($yds_res, 0, ",", ".")."</u></td>
										<td><u> + </u></td>
									</tr>";	
					$vcalculate .= "<tr><td>Yang dibayar Yogya</td>
										<td>Rp. </td>
										<td align='right'>".number_format($bayar, 0, ",", ".")."</td>
									</tr>";		
					$vcalculate .= "<tr><td><b>Nett margin = $nett_magin %</b></td>
									</tr>";			
					$vcalculate .=  "<tr><td colspan='3'><br></td></tr>";
				} 
				else {
					$label = "SPECIAL PRICE";

					$vcalculate .= "<tr><td colspan='3'><b><u>".$label."</u></b></td>
									</tr>";	
					$vcalculate .= "<tr><td>Harga special</td>
										<td>Rp. </td>
										<td align='right'>".number_format($hrg, 0, ",", ".")."</td>
									</tr>";	
					$vcalculate .= "<tr><td>Margin Yogya ".$pmargin."</td>
										<td>Rp. </td>
										<td align='right'><u>".number_format($margin, 0, ",", ".")."</u></td>
										<td><u> - </u></td>
									</tr>";	
					$vcalculate .= "<tr><td>Yang dibayar Yogya</td>
										<td>Rp. </td>
										<td align='right'>".number_format($hrg-$margin, 0, ",", ".")."</td>
									</tr>";									

				}
				

																
			}
			
			$vcalculate .=  "<tr><td colspan='3'><br><br></td></tr>";
			$vcalculate .= "</table>";

			return $vcalculate;

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
			
			//get template
			$template = $this->get_template($id);
			$data['rheader'] = $template['rheader'];
			$data['rfooter'] = $template['rfooter'];
			$data['rnotes'] = $template['rnotes'];
			
			$vlocation = "";

			//cek location
			$same_location = $this->Event_model->is_same_location($id);
			if ($same_location=='1'){
				$list = $this->Event_model->get_same_location_content($id);
			} else {
				$list = $this->Event_model->get_diff_location_content($id);
			}

			foreach ($list->result() as $r) {
				//hitung net margin
				$hrg = 100000;

				$bruto_price = $r->tax/100 * $hrg;
				
				$after_disc1 = $hrg-($hrg*$r->disc1/100);//100.000-20.000 = 80.000
				$after_disc2 = $after_disc1-($after_disc1*$r->disc2/100);//80.000-10.000

				$jml_diskon = (1-($after_disc2/$hrg));
				$yds = $r->yds_responsibility/100*$jml_diskon;
				$sup = $r->supp_responsibility/100*$jml_diskon;

				$yds_price = $yds*$hrg;//0.08*100.000

				$yds_res = $yds*100;
				$supplier_res = $sup*100;

				$net_margin = round(($bruto_price - $yds_price) / $after_disc2*100, 2, PHP_ROUND_HALF_UP);
				
				if ($r->is_sp=='1'){
					if($r->is_pkp=='1'){
						$margin = $r->tax.'% PKP (netto)';
					} else {
						$margin = $r->tax.'% NPKP (netto)';
					}

					$vlocation .= "<tr><td>Acara</td>
									<td>:</td>
									<td>".$r->disc_label."</td>
								</tr>
								<tr><td>Margin Yogya</td>
									<td>:</td>
									<td>$margin</td>
								</tr>
								";	
				} 
				else {

					if($r->is_pkp=='1'){
						$margin = $r->tax.'% PKP (bruto) &rarr; <b> Nett margin = '.$net_margin.'% </b>';
					} else {
						$margin = $r->tax.'% NPKP (bruto) &rarr; <b> Nett margin = '.$net_margin.'% </b>';
					}	

					$vlocation .= "<tr><td>Acara</td>
										<td>:</td>
										<td>".$r->disc_label."</td>
									</tr>
									<tr><td>Pertanggungan</td>
										<td>:</td>
										<td>YDS $yds_res% SUPPLIER $supplier_res%</td>
									</tr>
									<tr><td>Margin Yogya</td>
										<td>:</td>
										<td>$margin</td>
									</tr>
									";		
				}

					
								
				// cek date
				$same_date = $this->Event_model->is_same_date($id);
				if ($same_date!='1'){
					$vlocation .= $this->get_event_date($id, $r->tillcode);					
				} else {
					$date_tmp = $this->get_event_same_date($id);
				}

				//tempat acara
				if ($same_location=='0'){
					$vlocation .= $this->get_event_location($id, $r->tillcode);
				}

			} //end foreach
				
			//get supplier
			$vlocation .= $this->get_supplier($id);
			
			//get tillcode
			$vlocation .= $this->get_tillcode($id);
			
			//cek date tmp 
			(isset($date_tmp)? $vlocation .= $date_tmp : "");
			
			//tempat acara
			if ($same_location=='1'){
				$vlocation .= $this->get_event_same_location($id);
			}
			
			$vlocation .=  "<tr><td colspan='3'><br></td></tr>";
			$data['vlocation'] = $vlocation;

			// tampilkan contoh perhitungan 
			$vcalculate = $this->get_perhitungan($id);
			
			$data['vcalculate'] = $vcalculate;
			$this->load->view('acara/v_acara', $data);
			
		}
		
		
		public function save() {
			# fix this later
			$usr = $this->session->userdata['event_logged_in']['username'];
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
			
			# remove these variables from inuput
			#$inputs["firstSignature"]
			#$inputs["secondSignature"]
			#$inputs["cc"]
			
			$this->Acara->addNew(
				$inputs["about"], $inputs["purpose"], $inputs["attach"], $inputs["toward"], $inputs["department"], $inputs["divisionCode"], $source,
				$inputs["templateCode"], "", "", $inputs["notes"], "", $isManualSetting,
				$inputs["letterDate"], $isSameDate, $isSameLocation, $detailEvent, $detailDate, $detailLocation, $usr, $upd
			);

		}
		
	}	
	

?>