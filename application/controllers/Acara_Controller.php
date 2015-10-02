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
			
			# clear acaraHolder
			$this->session->unset_userdata("acaraHolder");
			
			$data['list'] = $this->Event_model->all_list();
			$this->load->view('acara/v_acara', $data);
		}
		
		public function loadMdByDivision() {
			$inputs = $this->input->post();
			$mds = $this->Acara->loadMdByDivision($inputs["divisionCode"]);
			
			$opts = '<option value="">Pilih MD..</option>';
			foreach($mds as $md) {
				$opts .= '<option value="' . $md->name . '">' . $md->name . '</option>';
			}
			echo $opts;
		}
		
		public function add($step = null) {
			$data['trans_active'] = 'dcjq-parent active';
			$data['menu_input_active'] = 'color:#FFF';
			
			if ($step == null) {
				$acaraHolder = $this->session->userdata("acaraHolder");
				
				$divisionCode = isset($acaraHolder["divisionCode"]) ? $acaraHolder["divisionCode"] : "";
				$firstSignature = isset($acaraHolder["firstSignature"]) ? $acaraHolder["firstSignature"] : "";
				$mds = $this->Acara->loadMdByDivision($divisionCode);
			    $opts = '<option value="">Pilih MD..</option>';
			    foreach($mds as $md) {
				    if ($firstSignature == $md->name) $sel = 'selected="selected"'; else $sel = '';
					$opts .= '<option ' . $sel . ' value="' . $md->name . '">' . $md->name . '</option>';
			    }
				
				$data['isSameDate'] = isset($acaraHolder["isSameDate"]) ? 1 : 0;
				$data['isSameLocation'] = isset($acaraHolder["isSameLocation"]) ? 1 : 0;
				$data["opts"] = $opts;
				$data['acaraHolder'] = $acaraHolder;
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
			else if ($step == 'new') {	
				# clear acaraHolder
				$this->session->unset_userdata("acaraHolder");
				
				$data['isSameDate'] = 0;
				$data['isSameLocation'] = 0;
				$data['acaraHolder'] = $this->session->userdata("acaraHolder");
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
				$data['isSameDate'] = isset($inputs["isSameDate"]) ? 1 : 0;
				$data['isSameLocation'] = isset($inputs["isSameLocation"]) ? 1 : 0;
				$data['categories'] = $this->Acara->loadCategoryByDivision($inputs["divisionCode"]);
				$data['stores'] = $this->Acara->loadAllStore();
				$data['locations'] = $this->Acara->loadAllLocation();
				$data['division'] = $inputs["divisionCode"];
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
		
		public function edit($id, $step = null) {
			$data['trans_active'] = 'dcjq-parent active';
			$data['menu_input_active'] = 'color:#FFF';
			
			if ($step == null) {
				$acaraHolder = $this->session->userdata("acaraHolder");
				$aResult = $this->Acara->load($id);
				
				$data["id"] = $id;
				$event = $aResult["event"];
				$data["event"] = $event;
				$divisionCode = isset($event[0]->division_code) ? $event[0]->division_code : "";
				$firstSignature = isset($event[0]->first_signature) ? $event[0]->first_signature : "";
				$mds = $this->Acara->loadMdByDivision($divisionCode);
			    $opts = '<option value="">Pilih MD..</option>';
			    foreach($mds as $md) {
				    if ($firstSignature == $md->name) $sel = 'selected="selected"'; else $sel = '';
					$opts .= '<option ' . $sel . ' value="' . $md->name . '">' . $md->name . '</option>';
			    }
				
				if (isset($acaraHolder["eventNo"])) {
					$data['isSameDate'] = isset($acaraHolder["isSameDate"]) ? 1 : 0;
					$data['isSameLocation'] = isset($acaraHolder["isSameLocation"]) ? 1 : 0;
				}
				else {
					$data['isSameDate'] = isset($event[0]->is_same_date) ? $event[0]->is_same_date : 0;
					$data['isSameLocation'] = isset($event[0]->is_same_location) ? $event[0]->is_same_location : 0;	
				}
				
				$data["opts"] = $opts;
				$data["divisionDesc"] = $this->Acara->getDivisionName($divisionCode);
				$data['acaraHolder'] = $acaraHolder;
				$data['templates'] = $this->Acara->loadAllTemplate();
				//$data['divisions'] = $this->Division->loadAll();
				$data['today'] = date('d-m-Y');
				$data['head'] = 'acara/v_head';
				$data['top_menu'] = 'template/v_top_menu';
				$data['left_menu'] = 'template/v_left_menu';
				$data['content'] = 'acara/v_edit';
				$data['right_menu'] = 'acara/v_right_menu';
				$data['footer'] = 'template/v_footer';
				
				$this->load->view('acara/v_acara', $data);	
			}
			else if ($step == 'next') {
				$inputs = $this->input->post();
				if (!isset($inputs["divisionCode"])) {
					header("Location: " . base_url() . "acara/list");
					exit;
				}
				
				$this->session->set_userdata("acaraHolder", $inputs);
				$aResult = $this->Acara->load($id);	
				$eventItem = $aResult["event_item"];
				
				$tillcodeRows = "";
				foreach($eventItem as $eItem) {
					$tillcodeRows .= 	"<tr>" . 
											"<td class='eventTillcode'>" . $eItem->tillcode . "</td>" .
											"<td class='eventSupplierCode'>" . $eItem->supp_code . "</td>" .
											"<td class='eventCategoryCode'>" . $eItem->category_desc . "</td>" .
											"<td class='eventSupplierResponsibility'>" . $eItem->supp_responsibility . "</td>" .
											"<td class='eventYdsResponsibility'>" . $eItem->yds_responsibility . "</td>" .
											"<td class='eventIsPkp'>" . ($eItem->is_pkp == 1 ? "PKP" : "NPKP") . "</td>" .
											"<td class='eventMargin'>" . $eItem->tax . "</td>" . 
											"<td class='eventSp'>" . ($eItem->special_price == 0 ? "&nbsp;" : $eItem->special_price) . "</td>" . 
											"<td class='eventNotes'>" . $eItem->notes . "</td>" . 
											"<td>" . 
												"<a data-id='' data-toggle='modal' data-target='#myModal' class='btn_update btn btn-xs btnRowDelete'>" . 
													"<i class='fa fa-trash-o'></i> delete" . 
												"</a>" . 
											"</td>" . 
										"</tr>";	
				}
				
				$event = $aResult["event"];
				
				# values from db
				$isSameDate = isset($event[0]->is_same_date) ? $event[0]->is_same_date : 0;
				$isSameLocation = isset($event[0]->is_same_location) ? $event[0]->is_same_location : 0;
				
				# load data
				if ($isSameDate)
					$eventDate = $aResult["event_same_date"];
				else
					$eventDate = $aResult["event_date"];
				
				if ($isSameLocation)
					$eventLocation = $aResult["event_same_location"];
				else
					$eventLocation = $aResult["event_location"];
				
				# change these values	
				$isSameDate = isset($inputs["isSameDate"]) ? 1 : 0;
				$isSameLocation = isset($inputs["isSameLocation"]) ? 1 : 0;
				
				$dateRows = "";
				foreach($eventDate as $eDate) {
					if ($isSameDate) {
						$dateRows .= 	"<tr>" . 
											"<td class='dateEventStartDate'>" . $eDate->date_start . "</td>" . 
											"<td class='dateEventEndDate'>" . $eDate->date_end . "</td>" . 
											"<td>" . 
												"<a data-id='' data-toggle='modal' data-target='#myModal' class='btn_update btn btn-xs btnRowDelete'>" . 
													"<i class='fa fa-trash-o'></i> delete" . 
												"</a>" . 
											"</td>" . 
										"</tr>";	
					}
					else {
						$tillcode = ($isSameDate ? "&nbsp;" : (isset($eDate->tillcode) ? $eDate->tillcode : "&nbsp;"));
						$dateRows .= 	"<tr>" . 
											"<td class='dateTillcode'>" . $tillcode . "</td>" . 
											"<td class='dateEventStartDate'>" . $eDate->date_start . "</td>" . 
											"<td class='dateEventEndDate'>" . $eDate->date_end . "</td>" . 
											"<td>" . 
												"<a data-id='' data-toggle='modal' data-target='#myModal' class='btn_update btn btn-xs btnRowDelete'>" . 
													"<i class='fa fa-trash-o'></i> delete" . 
												"</a>" . 
											"</td>" . 
										"</tr>";
					}	
				}
				
				
				
				$locationRows = "";
				foreach($eventLocation as $eLocation) {
					if ($isSameLocation) {
						$locationRows .=   "<tr>" . 
												"<td class='locationLocationCode'>" . $eLocation->loc_desc . "</td>" . 
												"<td class='locationStoreCode'>" . $eLocation->store_desc . "</td>" . 
												"<td>" . 
													"<a data-id='' data-toggle='modal' data-target='#myModal' class='btn_update btn btn-xs btnRowDelete'>" . 
														"<i class='fa fa-trash-o'></i> delete" . 
													"</a>" . 
												"</td>" . 
											"</tr>";		
					}
					else {
						$tillcode = ($isSameLocation ? "&nbsp;" : (isset($eLocation->tillcode) ? $eLocation->tillcode : "&nbsp;"));
						$locationRows .=   "<tr>" . 
												"<td class='locationTillcode'>" . $tillcode . "</td>" . 
												"<td class='locationLocationCode'>" . $eLocation->loc_desc . "</td>" . 
												"<td class='locationStoreCode'>" . $eLocation->store_desc . "</td>" . 
												"<td>" . 
													"<a data-id='' data-toggle='modal' data-target='#myModal' class='btn_update btn btn-xs btnRowDelete'>" . 
														"<i class='fa fa-trash-o'></i> delete" . 
													"</a>" . 
												"</td>" . 
											"</tr>";	
					}
				}
				
				$data["id"] = $id;
				$data["isSameDate"] = $isSameDate;
				$data["isSameLocation"] = $isSameLocation;
				$data["dateRows"] = $dateRows;
				$data["locationRows"] = $locationRows;
				$data["tillcodeRows"] = $tillcodeRows;
				$data['categories'] = $this->Acara->loadCategoryByDivision($inputs["divisionCode"]);
				$data['stores'] = $this->Acara->loadAllStore();
				$data['locations'] = $this->Acara->loadAllLocation();
				$data['division'] = $inputs["divisionCode"];
				$data['today'] = date('d-m-Y');
				$data['head'] = 'acara/v_head';
				$data['top_menu'] = 'template/v_top_menu';
				$data['left_menu'] = 'template/v_left_menu';
				$data['content'] = 'acara/v_edit_next';
				$data['right_menu'] = 'acara/v_right_menu';
				$data['footer'] = 'template/v_footer';
				
				$this->load->view('acara/v_acara', $data);	
			}
			
		}
		
		function get_template($id){
			$list = $this->Event_model->get_template($id);
			$nama_supp = $this->get_supplier_header($id);

			foreach($list as $r){
				//cek header
				$rheader =  str_replace(
					array("#TGL_SURAT","#NOMOR_SURAT_ACARA","#LAMPIRAN",
						  "#ABOUT", "#TOWARD", "#NAMA_SUPPLIER", "#PURPOSE",
						  "#DPURPOSE", "#KOTA", "#FAX"
					),
					array($this->to_dMY($r->letter_date), $r->event_no, $r->attach,
						  $r->about, $r->toward, $nama_supp, ($r->purpose==""?"":" &rarr; ".$r->purpose),
						  $r->purpose, $r->city, $r->fax
					),
					$r->header
				);
				
				//cek footer
				$rfooter =  str_replace(
					array("#PARENTNOTES", "#FIRST_SIGNATURE", "#SECOND_SIGNATURE", "#APPROVED_BY", "#CC", "#MD"),
					array(($r->notes!=""?"Notes : ".$r->notes."<br><br>":""), $r->first_signature,$r->second_signature,$r->approved_by, $r->cc, $r->md_name ),
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
			$x=0;

			foreach ($date as $res) :
				if (($x%2 != 0) && ($x != 1)){
					$rdate .= "<br>";
				}

				if (($res->date_end==null) || ($res->date_end=="")){
					$rdate .= $this->to_dMY($res->date_start).', '; 
				} 
				else {
					// cek if same month
					$last_date = date("Y-m-t", strtotime($res->date_start));
					$date_start = date("Y-m-d", strtotime($res->date_start));
					$date_end = date("Y-m-d", strtotime($res->date_end));

					//jika dalam bln yg sama
					if ($date_end<=$last_date){
						$rdate .= $this->to_date($res->date_start).' - '.$this->to_dMY($res->date_end).', '; 
					} else {
						$rdate .= $this->to_dMY($res->date_start).' - '.$this->to_dMY($res->date_end).', '; 
					}

				}
			endforeach;
			
			$vlocation .= "<tr><td>Tanggal</td>
								<td>:</td>
								<td><b>".rtrim($rdate, ", ")."</b></td>
							</tr>";
			
			
			$same_location = $this->Event_model->is_same_location($id);
			if ($same_location=='1'){
				$vlocation .=  "<tr><td colspan='3'><br></td></tr>";
			} 

			return $vlocation;
		}

		function get_event_same_date($id){
			//get tanggal by event id
			$date = $this->Event_model->get_event_same_date($id);
			
			$rdate = "";				
			$date_tmp = "";			
			$x=0;

			foreach ($date as $res) :
				$x++;
				if (($x%2 != 0) && ($x != 1)){
					$rdate .= "<br>";
				}

				if (($res->date_end==null) || ($res->date_end=="")){
					$rdate .= $this->to_dMY($res->date_start).', '; 
				} else {
					// cek if same month
					$last_date = date("Y-m-t", strtotime($res->date_start));
					$date_start = date("Y-m-d", strtotime($res->date_start));
					$date_end = date("Y-m-d", strtotime($res->date_end));

					//jika dalam bln yg sama
					if ($date_end<=$last_date){
						$rdate .= $this->to_date($res->date_start).' - '.$this->to_dMY($res->date_end).', '; 
					} else {
						$rdate .= $this->to_dMY($res->date_start).' - '.$this->to_dMY($res->date_end).', '; 
					}	
				}

			endforeach;
			
			$date_tmp .= "<tr><td>Tanggal</td>
							<td>:</td>
							<td><b>".rtrim($rdate, ", ")."</b></td>
						</tr>";
			
			$same_location = $this->Event_model->is_same_location($id);
			if ($same_location=='1'){
				$date_tmp .=  "<tr><td colspan='3'><br></td></tr>";	
			} 

			return $date_tmp;
		}

		function get_event_location($id, $tillcode){
			$rlocation = $this->Event_model->get_event_location($id, $tillcode);

			$i=0;
			$tmp_loc = "<table border=0>";
			$vlocation = "";
			foreach ($rlocation as $res) :
				$i++;
				if (($i%2 != 0)){
					$tmp_loc .= "<tr>";
				}
				
				$tmp_loc .= "<td>".$res->loc_desc." <b>".$res->store_desc.",</b></td>";	

			endforeach;

			$tmp_loc .= "</table>";

			$vlocation .= "<tr>
								<td>Tempat Acara</td>
								<td>:</td>
								<td>".str_replace(",</b></td></table>", "</b></td></table>", $tmp_loc)."</td>
							</tr>
							";
			return $vlocation;				
		}

		function get_supplier($id, $tillcode){
			$vlocation ="";
			$supp = $this->Event_model->get_supplier($id, $tillcode);
			
			foreach ($supp as $res) :
				$supp_code = $res->supp_code;
			endforeach;
			
			$vlocation .= "<tr><td>Kode Supplier</td>
								<td>:</td>
								<td>".$supp_code."</td>
							</tr>";	
			
			
			$same_date = $this->Event_model->is_same_date($id);
			if ($same_date == '1'){
				$vlocation .=  "<tr><td colspan='3'><br></td></tr>";				
			} 

			return $vlocation;

		}

		function get_supplier_header($id){
			$supp_view ="";
			$supp = $this->Event_model->get_supplier_header($id);
			
			foreach ($supp as $res) :
				$supp_view .= $res->supp_desc."<br>";
			endforeach;
			
			
			return $supp_view;

		}

		function get_tillcode($id){
			$tillcode = $this->Event_model->get_tillcode($id);
			
			$rtillcode = "<table border=0>";
			$vlocation = "";
			$x = 0;

			foreach ($tillcode as $res) :
				$x++;

				if (($x%2 != 0)){
					$rtillcode .= "<tr>";
				}
				
				$rtillcode .= "<td>".$res->tillcode." (".$res->disc_label."), </td>";

			endforeach;
			
			$rtillcode .= "</table>";

			$vlocation .= "<tr><td>Tillcode</td>
								<td>:</td>
								<td>".str_replace(", </td></table>", "</td></table>", $rtillcode)."</td>
							</tr>";	
			$vlocation .=  "<tr><td colspan='3'><br></td></tr>";

			return $vlocation;

		}

		function get_event_same_location($id){
			$rlocation = $this->Event_model->get_event_same_location($id);

			$i=0;
			$tmp_loc = "<table border=0>";
			$vlocation = "";

			foreach ($rlocation as $res) :
				$i++;
				if (($i%2 != 0)){
					$tmp_loc .= "<tr>";
				} 

				//$tmp_loc .= $res->loc_desc." <b>".$res->store_desc."</b>, ";
				$tmp_loc .= "<td>".$res->loc_desc." <b>".$res->store_desc.",</b></td>";				

			endforeach;
			
			$tmp_loc .= "</table>";

			$vlocation .= "<tr>
								<td>Tempat Acara</td>
								<td>:</td>
								<td>".str_replace(",</b></td></table>", "</b></td></table>", $tmp_loc)."</td>
							</tr>
							";
			return $vlocation;

		}

		function get_perhitungan($id){
			$vcalculate = "";
			$vcalculate_gold = "";

			//calculate disc
			$list = $this->Event_model->get_calculate($id);

			$x = 0;
			$y = 0;
			foreach ($list as $r) {
				//default sbg contoh harga
				
				
				$hrg = 100000;
				
				
				
				if($r->is_pkp=='1'){
					$pmargin = $r->tax.'% PKP';
				} else {
					$pmargin = $r->tax.'% NPKP';
				}

				//cek jika tanpa pert
				$margin = $hrg*$r->tax/100;
				
				

				$after_disc1 = $hrg-($hrg*$r->disc1/100);//harga setelah disc1
				$after_disc2 = $after_disc1-($after_disc1*$r->disc2/100);//harga setelah disc2 // 72000
				$cek = 100-($after_disc2/$hrg*100);

				//cek hanya yg kurang dr 30%
				if ( ($cek<=30)){
					if ($y==0){
						$vcalculate = "<table class='vcalculate' border=0>
											<tr><td colspan='2'>Adapun contoh perhitungannya adalah</td>
												<td>:</td>
											</tr>";	

						$vcalculate_gold = "<table class='vcalculate_gold' border=0><tr><td colspan='3'>&nbsp;</td></tr>";	
					}
					
					$y++;

					$jml_diskon = (1-($after_disc1/$hrg));//1-0.8=0.2
					$yds = $r->yds_responsibility/100*$jml_diskon;

					$tmp2 = $hrg*$jml_diskon;20.000-

					$sel = $hrg - $tmp2;

					

					// cek disc 2
					if ($r->disc2=="0"){
						if ($r->yds_responsibility!=0){
							$sel_margin = $sel - $margin;
						} else {
							$sel_margin = $sel - ($sel*$r->tax/100);
						}
						
						$yds2 = 0;
						$sel2=0;
					} else {
						$tambahan = $r->disc2/100*$sel;
						$sel2 = $sel-$tambahan;
						$sel_margin = $sel2 - $margin; //jika ada disc +an di kurangin dulu

						$yds2 = $r->yds_responsibility/100*$tambahan;

					}

					//cek jika tanpa pert
					if ($r->yds_responsibility!=0){
						$margin = $margin;
					} else {
						if ($r->disc2=="0"){
							$margin = $sel*$r->tax/100;
						} else {
							$margin = $sel2*$r->tax/100;
						}
						
					}


					$yds_res = $yds*$hrg;

					//sel 2 = 72000 , $margin=10800
					if ($r->yds_responsibility!=0){
						$bayar = $sel_margin + $yds_res + $yds2;
					} else {
						if ($r->disc2!=0){
							$bayar = $sel2 - $margin;
						} else {
							$bayar = $sel_margin + $yds_res + $yds2;
						}
						
					}


					if ($r->disc2=="0"){
						$nett_margin = round((($margin-($yds_res+$yds2)) / ($sel))*100, 2, PHP_ROUND_HALF_UP);
					} else {
						$nett_margin = round((($margin-($yds_res+$yds2)) / ($sel2))*100, 2, PHP_ROUND_HALF_UP);
					}
					
							
					//echo $sel_margin;	
					//pertanggungan
					if ($r->yds_responsibility!="0"){
						$pert_label = "(Pert ".$r->yds_responsibility."% : ".$r->supp_responsibility."%)";
					} else $pert_label = "";
					

					if ($r->sp_event=='0'){
						$label1 = $r->disc1;
						($r->disc2=="0" ? $label2="":$label2="+ ".$r->disc2."%");

						$label = "Disc. ".$label1."% ".$label2;

					//	if ($r->yds_responsibility!="0"){


							$vcalculate .= "<tr><td colspan='3'><b><u>".$label." ".$pert_label." </u></b></td></tr>";	
							$vcalculate .= "<tr><td>Harga Jual</td>
												<td>Rp. </td>
												<td align='right'>".number_format($hrg, 0, ",", ".")."</td>
											</tr>";	

							if ($r->disc1!=0){
								$vcalculate .= "<tr><td>Disc. ".$r->disc1."%</td>
													<td>Rp. </td>
													<td align='right'><u>".number_format($tmp2, 0, ",", ".")."</u></td>
													<td><u> - </u></td>
												</tr>";		
								$vcalculate .= "<tr><td>&nbsp;</td>
													<td>Rp. </td>
													<td align='right'>".number_format($sel, 0, ",", ".")."</td>
												</tr>";						
							}				
							
							
							////////////////// gold //////////////////////////
							if ($r->yds_responsibility!="0"){
								$vcalculate_gold .= "<tr><td colspan='3'><b><u>".$label." (GOLD)</u></b></td></tr>";	
								$vcalculate_gold .= "<tr><td>Harga Jual</td>
														<td>Rp. </td>
														<td align='right'>".number_format($hrg, 0, ",", ".")."</td>
													</tr>";	
								if ($r->disc1!=0){
									$vcalculate_gold .= "<tr><td>Disc. ".$r->disc1."%</td>
															<td>Rp. </td>
															<td align='right'><u>".number_format($tmp2, 0, ",", ".")."</u></td>
															<td><u> - </u></td>
														</tr>";	
									$vcalculate_gold .= "<tr><td>&nbsp;</td>
															<td>Rp. </td>
															<td align='right'>".number_format($sel, 0, ",", ".")."</td>
														</tr>";			
								}					
											
							} else {
								//$vcalculate_gold .= $vcalculate;
							}

							if ($r->disc2!="0"){
								$vcalculate .= "<tr><td>Disc. tambahan ".$r->disc2."%</td>
												<td>Rp. </td>
												<td align='right'><u>".number_format($tambahan, 0, ",", ".")."</u></td>
												<td><u> - </u></td>
											</tr>";	
								$vcalculate .= "<tr><td>&nbsp;</td>
													<td>Rp. </td>
													<td align='right'>".number_format($sel2, 0, ",", ".")."</td>
												</tr>";

								if ($r->yds_responsibility!="0"){
									$vcalculate_gold .= "<tr><td>Disc. tambahan ".$r->disc2."%</td>
															<td>Rp. </td>
															<td align='right'><u>".number_format($tambahan, 0, ",", ".")."</u></td>
															<td><u> - </u></td>
														</tr>";	
									$vcalculate_gold .= "<tr><td>&nbsp;</td>
															<td>Rp. </td>
															<td align='right'>".number_format($sel2, 0, ",", ".")."</td>
														</tr>";

									////////////////////// gold //////////////////
									$margin_gold = round($nett_margin/100*$sel2, -2);	
									$bayar_gold = $sel2 - $margin_gold;

									$vcalculate_gold .= "<tr><td>Margin Yogya $nett_margin% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
															<td>Rp. </td>
															<td align='right'><u>".number_format($margin_gold, 0, ",", ".")."</u></td>
															<td><u> - </u></td>
														</tr>";		

									$vcalculate_gold .= "<tr><td>Yang dibayar Yogya</td>
															<td>Rp. </td>
															<td align='right'>".number_format($bayar_gold, 0, ",", ".")."</td>
														</tr>";			
								}	

								

								
								if ($r->yds_responsibility!="0"){
									if ($r->disc2 != "0"){	
										$limit = 5;				
									} else $limit = 4;
								} else {
									if ($r->disc2 != "0"){	
										$limit = 3;				
									} else $limit = 2;
								}
							

								for ($i=1;$i<=$limit;$i++){
									$vcalculate_gold .= "<tr><td colspan=3>&nbsp;</td></tr>";	
								}	
																					

							}	else {

								//gold
								if ($r->yds_responsibility!="0"){
									$margin_gold = round($nett_margin/100*$sel, -2);	
									$bayar_gold = $sel - $margin_gold;
									
									$vcalculate_gold .= "<tr><td>Margin Yogya $nett_margin% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
																<td>Rp. </td>
																<td align='right'><u>".number_format($margin_gold, 0, ",", ".")."</u></td>
																<td><u> - </u></td>
															</tr>";		

									$vcalculate_gold .= "<tr><td>Yang dibayar Yogya</td>
															<td>Rp. </td>
															<td align='right'>".number_format($bayar_gold, 0, ",", ".")."</td>
														</tr>";	

								}		

									if ($r->yds_responsibility!="0"){
										if ($r->disc2 != "0"){	
											$limit = 5;				
										} else $limit = 4;
									} else {
										if ($r->disc2 != "0"){	
											$limit = 3;				
										} else $limit = 2;
									}
								

									for ($i=1;$i<=$limit;$i++){
										$vcalculate_gold .= "<tr><td colspan=3>&nbsp;</td></tr>";	
									}

													

							}
				//		}// endif yds exist

						$vcalculate .= "<tr><td>Margin Yogya ".$pmargin."</td>
											<td>Rp. </td>
											<td align='right'><u>".number_format($margin, 0, ",", ".")."</u></td>
											<td><u> - </u></td>
										</tr>";	
						//jgn muncul nol di perhitungan						
						if ($r->yds_responsibility!=0){
							$vcalculate .= "<tr><td></td>
												<td>Rp. </td>
												<td align='right'>".number_format($sel_margin, 0, ",", ".")."</td>
											</tr>";	
							$vcalculate .= "<tr><td>Partisipasi Yogya ".$label."&nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td>Rp. </td>
												<td align='right'>".number_format($yds_res, 0, ",", ".")."</td>
											</tr>";		
						}										
						
						

						if ($r->disc2!="0"){
							if ($r->yds_responsibility!=0){
								$vcalculate .= "<tr><td>Partisipasi Yogya Disc Tamb.</td>
													<td>Rp. </td>
													<td align='right'><u>".number_format($yds2, 0, ",", ".")."</u></td>
													<td><u> + </u></td>
												</tr>";	
							}		
						}

						$vcalculate .= "<tr><td>Yang dibayar Yogya</td>
											<td>Rp. </td>
											<td align='right'>".number_format($bayar, 0, ",", ".")."</td>
										</tr>";

						//hanya utk yg ada pert				
						if ($r->yds_responsibility!=0){
							$vcalculate .= "<tr><td><b>Nett margin = $nett_margin %</b></td></tr>";			
						} else $vcalculate .= "<tr><td colspan=3>&nbsp;</td></tr>";	

						$vcalculate .=  "<tr><td colspan='3'><br></td></tr>";	

						
					} 
					else {
						$label = "SPECIAL PRICE";

						$vcalculate .= "<tr><td colspan='3'><b><u>".$label."</u></b></td></tr>";	
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
						$vcalculate .= "<tr><td colspan='3'>&nbsp;</td></tr>";		
						
						for ($i=1;$i<=5;$i++){
							$vcalculate_gold .= "<tr><td colspan=3>&nbsp;</td></tr>";	
						}		

					}
						
				} else {
					$vcalculate .="<table class='vcalculate'><tr><td colspan='3'></td></tr>";
					$vcalculate_gold .="<table class='vcalculate_gold'><tr><td colspan='3'></td></tr>";
				}
				

				/*if ($r->yds_responsibility==0){
					$vcalculate_gold = "";
				}else $vcalculate_gold .= "";*/
																
			}
			

			$vcalculate .= "</table>";

			$vcalculate_gold .= "</table>";

			return array(
					    'vcalculate' => $vcalculate,
					    'vcalculate_gold' => $vcalculate_gold
					);


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

			//cek supp
			$cek_supp = $this->Event_model->get_jml_supplier($id);
			

			

			foreach ($list as $r) {
				//hitung net margin
				$hrg = 100000;

				$bruto_price = $r->tax/100 * $hrg;
					
				$after_disc1 = $hrg-($hrg*$r->disc1/100);//100.000-20.000 = 80.000
				$after_disc2 = $after_disc1-($after_disc1*$r->disc2/100);//80.000-10.000

				$jml_diskon = (1-($after_disc2/$hrg));
				$yds = $r->yds_responsibility/100*$jml_diskon;
				$sup = $r->supp_responsibility/100*$jml_diskon;


				$pert="";
				if ($r->yds_responsibility!="0"){
					$pert = "<tr><td>Pertanggungan</td>
										<td>:</td>
										<td> YDS ".$r->yds_responsibility."% SUPPLIER ".$r->supp_responsibility."%</td>
									</tr>
									";	

				} // else $res_label = "YDS ".$r->yds_responsibility."% SUPPLIER ".$r->supp_responsibility."%";

				$yds_price = $yds*$hrg;//0.08*100.000

				$yds_res = $yds*100;
				$supplier_res = $sup*100;

				$net_margin = round(($bruto_price - $yds_price) / $after_disc2*100, 2, PHP_ROUND_HALF_UP);
				
				
				
				if ($r->is_sp=="0"){
					//$acara_final = "DISCOUNT " . $r->disc1."%" . ($r->disc2=="0"?"":" + ".$r->disc2."%") . ($r->notes==""?"":" &rarr; ".$r->notes);
					$acara_final = $r->notes;
				} else {
					//$acara_final = "SPECIAL PRICE Rp. ".number_format($r->special_price, 0, ",", ".") . ($r->notes==""?"":" &rarr; ".$r->notes);
					$acara_final = $r->notes;
				}
				
				if ($r->is_sp=='1'){
					if($r->is_pkp=='1'){
						$margin = $r->tax.'% PKP (netto)';
					} else {
						$margin = $r->tax.'% NPKP (netto)';
					}
					
					$vlocation .= "<tr><td>Acara</td>
										<td>:</td>
										<td>".$acara_final."</td>
									</tr>
									<tr><td>Margin Yogya</td>
										<td>:</td>
										<td>$margin</td>
									</tr>
									
									";	
								
				} 
				else {

					if($r->is_pkp=='1'){
						$margin = $r->tax.'% PKP (bruto)'.($r->yds_responsibility!='0'?' &rarr; <b> Nett margin = '.$net_margin.'% </b>':'');
					} else {
						$margin = $r->tax.'% NPKP (bruto)'.($r->yds_responsibility!='0'?' &rarr; <b> Nett margin = '.$net_margin.'% </b>':'');
					}	

					$vlocation .= "<tr><td>Acara</td>
										<td>:</td>
										<td>".$acara_final."</td>
									</tr>";
					$vlocation .= $pert;				
					$vlocation .= "<tr><td>Margin Yogya</td>
										<td>:</td>
										<td>$margin</td>
									</tr>
									
									";		
				}

				//get supplier
				//$vlocation .= $this->get_supplier($id, $r->tillcode);
				
				if ($cek_supp!=1){
					$vlocation .= "<tr><td>Supplier</td>
									<td>:</td>
									<td>".$r->supp_code."</td>
								</tr>
								<tr><td colspan='3'>&nbsp;</td></tr>
									";	
				} else {
					$vlocation .= "<tr><td colspan='3'>&nbsp;</td></tr>";	
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
				
			$data['last'] = $this->db->last_query();

			//cek is same supp
			$cek_supp = $this->Event_model->get_jml_supplier($id);
			

			if ($cek_supp==1){
				$get_supplier_data = $this->Event_model->get_supplier_data($id);
				foreach ($get_supplier_data as $r) {
					$supp_name = $r->supp_desc;
				}
				$vlocation .=  "<tr>
									<td>Supplier</td>
									<td>:</td>
									<td>".$supp_name."</td>
								</tr>";
				$vlocation .=  "<tr><td colspan='3'><br></td></tr>";
			} 

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

			$data['vcalculate'] = $vcalculate['vcalculate'];
			$data['vcalculate_gold'] = $vcalculate['vcalculate_gold'];

			//set file
			$event_no = $this->Event_model->get_event_no($id);
		    $data['file'] = str_replace("/", "_", $event_no);

			$this->load->view('acara/v_acara', $data);
			
			//////////////////////////////////////////////////// create pdf //////////////////////////////////////////
			
        	$this->load->helper('mpdf_helper');

		    // page info here, db calls, etc.   
		    $logo = "<img src='".base_url()."assets/img/yg_red.png' /><br />";
		    
		  	$html = $logo.
		    		$data['rheader'] . 
	    			"<table class='view_acara'>" .
						$data['vlocation'] .
					 "</table>" .
					
					"<div class='newspaper' style='width:1000px;'>".
						"<div class='vcalculate' style='float: left;width: 55%;'>".$data['vcalculate']."</div>" .
						"<div class='vcalculate_gold' style='float: left;width: 40%;'>".$data['vcalculate_gold']."</div>" .
					"</div>" .
					
					"<div class='pdf_footer'>".$data['rfooter'] ."</div>" .
					"<div class='pdf_notes'>".$data['rnotes'] ."</div>" 
		    		
		    		;


		    pdf_create($html, $event_no);
		   
		    
		}

		public function save($id = 0) {

			$usr = $this->session->userdata['event_logged_in']['username'];
			$upd = date("Y-m-d H:i:s");
			
			$inputs = $this->session->userdata("acaraHolder");
			$inputDetails = $this->input->post();
			
			$source = strtoupper(substr($inputs["templateCode"], 0, 1)) == "Y" ? 1 : 0;
			$isManualSetting = isset($inputs["manualSetting"]) ? 1 : 0;
			
			$isSameDate = $inputDetails["isSameDate"];
			$isSameLocation = $inputDetails["isSameLocation"];
			#$isSameDate = isset($inputs["isSameDate"]) ? 1 : 0;
			#$isSameLocation = isset($inputs["isSameLocation"]) ? 1 : 0;
			
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
			$eventCategoryCode = $inputDetails["eventCategoryCode"];
			$eventSupplierResponsibility = $inputDetails["eventSupplierResponsibility"];
			$eventYdsResponsibility = $inputDetails["eventYdsResponsibility"];
			$eventIsPkp = $inputDetails["eventIsPkp"];
			$eventMargin = $inputDetails["eventMargin"];
			$eventSp = $inputDetails["eventSp"];
			$eventNotes = $inputDetails["eventNotes"];
			
			$eventTillcodeArr = explode("#", $eventTillcode);
			$eventSupplierCodeArr = explode("#", $eventSupplierCode);
			$eventCategoryCodeArr = explode("#", $eventCategoryCode);
			$eventSupplierResponsibilityArr = explode("#", $eventSupplierResponsibility);
			$eventYdsResponsibilityArr = explode("#", $eventYdsResponsibility);
			$eventIsPkpArr = explode("#", $eventIsPkp);
			$eventMarginArr = explode("#", $eventMargin);
			$eventSpArr = explode("#", $eventSp);
			$eventNotesArr = explode("#", $eventNotes);
			
			$detailEvent = array();
			for ($i = 0; $i < sizeof($eventTillcodeArr); $i++) {
				$detailEvent[$i]["tillcode"] = $eventTillcodeArr[$i];
				$detailEvent[$i]["suppCode"] = $eventSupplierCodeArr[$i];
				$detailEvent[$i]["categoryCode"] = $eventCategoryCodeArr[$i];
				$detailEvent[$i]["ydsResponsibility"] = $eventYdsResponsibilityArr[$i];
				$detailEvent[$i]["suppResponsibility"] = $eventSupplierResponsibilityArr[$i];
				$detailEvent[$i]["isPkp"] = $eventIsPkpArr[$i];
				$detailEvent[$i]["margin"] = $eventMarginArr[$i];
				$detailEvent[$i]["sp"] = $eventSpArr[$i];
				$detailEvent[$i]["notes"] = $eventNotesArr[$i];
			}
			
			# remove these variables from inuput
			#$inputs["firstSignature"]
			#$inputs["secondSignature"]
			#$inputs["cc"]
			
			if ($id) {
				$seq = $this->Acara->update($id, $inputs["eventNo"],
						$inputs["about"], $inputs["purpose"], $inputs["attach"], $inputs["toward"], $inputs["department"], $inputs["divisionCode"], $source,
						$inputs["templateCode"], $inputs["firstSignature"], "", $inputs["notes"], "", $isManualSetting,
						$inputs["letterDate"], $isSameDate, $isSameLocation, $detailEvent, $detailDate, $detailLocation, $usr, $upd
				);
				if ($seq) $seq = $id;
			}
			else {
				$seq = $this->Acara->addNew(
						$inputs["about"], $inputs["purpose"], $inputs["attach"], $inputs["toward"], $inputs["department"], $inputs["divisionCode"], $source,
						$inputs["templateCode"], $inputs["firstSignature"], "", $inputs["notes"], "", $isManualSetting,
						$inputs["letterDate"], $isSameDate, $isSameLocation, $detailEvent, $detailDate, $detailLocation, $usr, $upd
				);	
			}
			
			# remove acaraHolder from session
			if ($seq) $this->session->unset_userdata("acaraHolder");
			
			echo $seq;
		}
		
		public function delete() {
			$input = $this->input->post();
			$ret = $this->Acara->remove($input["id"]);
			if ($ret) echo "success"; else echo "Gagal menghapus data.";
		}
		
		public function loadStores() {
			$stores = $this->Acara->loadAllStore();
			$sto = "";
			foreach($stores as $store) {
				//$sto .= $store->store_desc . " (" . $store->store_init . ")|";
				$sto .= $store->store_desc . "|";
			}
			$sto = substr($sto, 0, strlen($sto)-1);
			echo $sto;
		}
		
		public function loadSuppliers() {
			$suppliers = $this->Acara->loadAllSupplier();
			$supp = "";
			foreach($suppliers as $supplier) {
				$supp .= $supplier->supp_desc . " (" . $supplier->supp_code . ")|";
			}
			$supp = substr($supp, 0, strlen($supp)-1);
			echo $supp;
		}
		
		public function loadTillcodes($division) {
			$tillcodes = $this->Acara->loadTillcodeByDivision($division);
			$till = "";
			foreach($tillcodes as $tillcode) {
				$till .= $tillcode->tillcode . " (" . $tillcode->disc_label . ")|";
			}
			$till = substr($till, 0, strlen($till)-1);
			echo $till;
		}
		
	}	
	

?>