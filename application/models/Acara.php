<?php
/**
 * Class   :  Acara
 * Author  :  
 * Created :  2015-08-26
 * Desc    :  Data handler for Acara
 */

class Acara extends CI_Model {
        
        public function __construct() {
        
        }
        
        public function isValidSpArticle($tillcode) {
                $params = array($tillcode);
                $sql = "select count(tillcode) cnt from mst_tillcode where tillcode = ? and is_sp = 1";
                $query = $this->db->query($sql, $params);
                
                if ($query->num_rows() > 0) {
                        $row = $query->row();
                        return ($row->cnt > 0 ? true : false);
                }
                return false;
        }
        
        public function getDivisionName($divisionCode) {	
                $params = array($divisionCode);
                $sql = "select division_desc from mst_division where division_code = ?";
                $query = $this->db->query($sql, $params);
                
                if ($query->num_rows() > 0) {
                        $row = $query->row();
                        return $row->division_desc;
                }
                return "";
        }
        
        public function loadMdByDivision($divisionCode, $arrayMode = false) {
                $params = array($divisionCode);
                $sql = "select distinct name from mst_md where is_active = 1 and div_code = ? order by name";
                $query = $this->db->query($sql, $params);
                
                if ($arrayMode) 
                        return $query->result_array();
                else
                        return $query->result();
        }
        
        public function loadAllMd($arrayMode = false) {	
                $sql = "select distinct name from mst_md where is_active = 1 order by name";
                $query = $this->db->query($sql);
                
                if ($arrayMode) 
                        return $query->result_array();
                else
                        return $query->result();
        }
        
        public function loadAllLocation($arrayMode = false) {	
                $sql = "select loc_code, loc_desc from mst_location where is_active = 1 order by loc_desc";
                $query = $this->db->query($sql);
                
                if ($arrayMode) 
                        return $query->result_array();
                else
                        return $query->result();
        }
        
        public function loadAllStore($arrayMode = false) {	
                $sql = "select store_code, store_init, store_desc from mst_store where is_active = 1 order by store_desc";
                $query = $this->db->query($sql);
                
                if ($arrayMode) 
                        return $query->result_array();
                else
                        return $query->result();
        }
        
        public function loadAllSupplier($arrayMode = false) {	
                $sql = "select supp_code, supp_desc from mst_supplier where is_active = 1 order by supp_desc";
                $query = $this->db->query($sql);
                
                if ($arrayMode) 
                        return $query->result_array();
                else
                        return $query->result();
        }
        
        public function loadAllBrand($arrayMode = false) {	
                $sql = "select brand_code, brand_desc from mst_brand where is_active = 1 order by brand_desc";
                $query = $this->db->query($sql);
                
                if ($arrayMode) 
                        return $query->result_array();
                else
                        return $query->result();
        }
        
        public function loadTillcodeByDivision($divisionCode, $supplierCode = "", $brandCode = "", $arrayMode = false) {	
                if ($supplierCode == "" && $brandCode == "") {
                        $params = array($divisionCode);
                        $sql = "select tillcode, disc_label, brand_code from mst_tillcode where division_code = ? and is_active = 1 and disc1 is not null order by disc_label";
                        $query = $this->db->query($sql, $params);        
                }
                else if ($supplierCode != "" && $brandCode == "") {
                        $params = array($divisionCode, $supplierCode);
                        $sql = "select tillcode, disc_label, brand_code from mst_tillcode where division_code = ? and supp_code = ? and is_active = 1 and disc1 is not null order by disc_label";
                        $query = $this->db->query($sql, $params);        
                }
                else if ($supplierCode == "" && $brandCode != "") {
                        $params = array($divisionCode, $brandCode);
                        $sql = "select tillcode, disc_label, brand_code from mst_tillcode where division_code = ? and brand_code = ? and is_active = 1 and disc1 is not null order by disc_label";
                        $query = $this->db->query($sql, $params);        
                }
                else {
                        $params = array($divisionCode, $supplierCode, $brandCode);
                        $sql = "select tillcode, disc_label, brand_code from mst_tillcode where division_code = ? and supp_code = ? and brand_code = ? and is_active = 1 and disc1 is not null order by disc_label";
                        $query = $this->db->query($sql, $params);  
                }
                
                if ($arrayMode) 
                        return $query->result_array();
                else
                        return $query->result();
        }
        
        public function loadCategoryByDivision($divisionCode, $arrayMode = false) {	
                $params = array($divisionCode);
                $sql = "select category_code, category_desc from mst_category where division_code = ? and is_active = 1 order by category_desc";
                $query = $this->db->query($sql, $params);
                
                if ($arrayMode) 
                        return $query->result_array();
                else
                        return $query->result();
        }
        
        public function loadAllCategory($arrayMode = false) {	
                $sql = "select category_code, category_desc from mst_category where is_active = 1 order by category_desc";
                $query = $this->db->query($sql);
                
                if ($arrayMode) 
                        return $query->result_array();
                else
                        return $query->result();
        }
        
        public function loadAllTemplate($arrayMode = false) {	
                $sql = "select tmpl_code, tmpl_name from mst_template where is_active = 1 order by tmpl_name";
                $query = $this->db->query($sql);
                
                if ($arrayMode) 
                        return $query->result_array();
                else
                        return $query->result();
        }
        
        public function load($id, $arrayMode = false) {
                $aResult = array();
                $params = array($id);
                
                $sql = "select tillcode, to_char(date_start, 'dd-mm-yyyy') date_start, to_char(date_end, 'dd-mm-yyyy') date_end from event_date where event_id = ? order by date_start";
                $query = $this->db->query($sql, $params);
                if ($arrayMode) 
                        $aResult["event_date"] = $query->result_array();
                else
                        $aResult["event_date"] = $query->result();
                
                $sql = "select x.tillcode, x.store_code, y.store_desc, x.location_code, z.loc_desc from event_location x inner join mst_store y on y.store_code = x.store_code " .
                        "inner join mst_location z on z.loc_code = x.location_code " .
                        "where x.event_id = ? order by x.store_code";
                $query = $this->db->query($sql, $params);
                if ($arrayMode) 
                        $aResult["event_location"] = $query->result_array();
                else
                        $aResult["event_location"] = $query->result();
                
                $sql = "select to_char(date_start, 'dd-mm-yyyy') date_start, to_char(date_end, 'dd-mm-yyyy') date_end from event_same_date where event_id = ? order by date_start";
                $query = $this->db->query($sql, $params);
                if ($arrayMode) 
                        $aResult["event_same_date"] = $query->result_array();
                else
                        $aResult["event_same_date"] = $query->result();
                
                $sql = "select x.store_code, y.store_desc, x.location_code, z.loc_desc from event_same_location x inner join mst_store y on y.store_code = x.store_code " .
                        "inner join mst_location z on z.loc_code = x.location_code " .
                        "where x.event_id = ? order by x.store_code";
                $query = $this->db->query($sql, $params);
                if ($arrayMode) 
                        $aResult["event_same_location"] = $query->result_array();
                else
                        $aResult["event_same_location"] = $query->result();
                
                $sql = "select x.tillcode, x.category_code, y.category_desc, x.notes, x.supp_code, x.yds_responsibility, x.supp_responsibility, x.is_pkp, x.tax, " .
                        "x.same_location, x.same_date, x.is_sp, x.special_price " .
                        "from event_item x inner join mst_category y on y.category_code = x.category_code where x.event_id = ?";
                $query = $this->db->query($sql, $params);
                if ($arrayMode) 
                        $aResult["event_item"] = $query->result_array();
                else
                        $aResult["event_item"] = $query->result();
                
                $sql = "select event_no, about, purpose, attach, toward, department, division_code, source, template_code, first_signature, second_signature, 
                        approved_by, approved_date, notes, cc, is_manual_setting, to_char(letter_date, 'dd-mm-yyyy') letter_date, is_same_date, is_same_location from event where id = ?";
                $query = $this->db->query($sql, $params);
                if ($arrayMode) 
                        $aResult["event"] = $query->result_array();
                else
                        $aResult["event"] = $query->result();
                
                return $aResult;
        }
        
        public function remove($id) {
                # start transaction
                $this->db->trans_start();
                
                $params = array($id);
                $sql = "delete from event_date where event_id = ?";
                $this->db->query($sql, $params);
                $sql = "delete from event_location where event_id = ?";
                $this->db->query($sql, $params); 
                $sql = "delete from event_same_date where event_id = ?";
                $this->db->query($sql, $params); 
                $sql = "delete from event_same_location where event_id = ?";
                $this->db->query($sql, $params);
                $sql = "delete from event_item where event_id = ?";
                $this->db->query($sql, $params);
                $sql = "delete from event where id = ?";
                $this->db->query($sql, $params);
                
                # end transaction
                $this->db->trans_complete();
                
                return $this->db->trans_status();
        }
        
        public function update($id, $eventNo, $about, $purpose, $attach, $toward, $department, $divisionCode, $source, $templateCode, $firstSignature, $secondSignature,
                               $notes, $cc, $isManualSetting, $letterDate, $isSameDate, $isSameLocation, $detailEvent, $detailDate, $detailLocation, $usr, $upd) {
                
                # start transaction
                $this->db->trans_start();
                
                # delete detail first
                $params = array($id);
                $sql = "delete from event_date where event_id = ?";
                $this->db->query($sql, $params);
                $sql = "delete from event_location where event_id = ?";
                $this->db->query($sql, $params); 
                $sql = "delete from event_same_date where event_id = ?";
                $this->db->query($sql, $params); 
                $sql = "delete from event_same_location where event_id = ?";
                $this->db->query($sql, $params);
                $sql = "delete from event_item where event_id = ?";
                $this->db->query($sql, $params); 
                
                # event
                $params = array($eventNo, $about, $purpose, $attach, $toward, $department, $divisionCode, $source, $templateCode, $firstSignature, $secondSignature,
                                $notes, $cc, $isManualSetting, $letterDate, $usr, $upd, $isSameDate, $isSameLocation, $id);
                
                $sql = "update event set event_no = ?, about = ?, purpose = ?, attach = ?, toward = ?, department = ?, division_code = ?, source = ?, template_code = ?, " .
                                "first_signature = ?, second_signature = ?, notes = ?, cc = ?, is_manual_setting = ?, letter_date = to_date(?, 'dd-mm-yyyy'), updated_by = ?, updated_date = ?, " .
                                "is_same_date = ?, is_same_location = ? where id = ?";
                $this->db->query($sql, $params);
                
                # items
                for ($i = 0; $i < sizeof($detailEvent); $i++) {
                        $withoutResponsibility = ($detailEvent[$i]["ydsResponsibility"] == 0 && $detailEvent[$i]["suppResponsibility"] == 0 ? 1 : 0);
                        $isSp = ($detailEvent[$i]["sp"] == "" ? 0 : 1);
                         
                        $params = array(
                                        $id,
                                        $detailEvent[$i]["tillcode"],
                                        $detailEvent[$i]["notes"],
                                        $detailEvent[$i]["suppCode"],
                                        $detailEvent[$i]["categoryCode"],
                                        $detailEvent[$i]["ydsResponsibility"],
                                        $detailEvent[$i]["suppResponsibility"],
                                        $detailEvent[$i]["isPkp"],
                                        $detailEvent[$i]["margin"],
                                        #$detailEvent[$i]["bruttoMargin"],
                                        #$detailEvent[$i]["netMargin"],
                                        $isSameDate,
                                        $isSameLocation,
                                        $withoutResponsibility,
                                        $isSp,
                                        (is_numeric($detailEvent[$i]["sp"]) ? $detailEvent[$i]["sp"] : 0),
                                );
                        $sql = "insert into event_item (event_id, tillcode, notes, supp_code, category_code, yds_responsibility, supp_responsibility, is_pkp, tax, " .
                                                        "same_location, same_date, without_responsibility, is_sp, special_price) ". 
                                "values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $this->db->query($sql, $params);        
                }
                
                # date
                if ($isSameDate)
                        for ($i = 0; $i < sizeof($detailDate); $i++) {
                                $params = array($id, $detailDate[$i]["dateStart"], $detailDate[$i]["dateEnd"]);
                                $sql = "insert into event_same_date (event_id, date_start, date_end) values (?, to_date(?, 'dd-mm-yyyy'), to_date(?, 'dd-mm-yyyy'))";
                                $this->db->query($sql, $params);        
                        }
                else {
                        for ($i = 0; $i < sizeof($detailDate); $i++) {
                                $params = array($id, $detailDate[$i]["tillcode"], $detailDate[$i]["dateStart"], $detailDate[$i]["dateEnd"]);
                                $sql = "insert into event_date (event_id, tillcode, date_start, date_end) values (?, ?, to_date(?, 'dd-mm-yyyy'), to_date(?, 'dd-mm-yyyy'))";
                                $this->db->query($sql, $params);        
                        }      
                }
                
                # location
                if ($isSameLocation) {
                        for ($i = 0; $i < sizeof($detailLocation); $i++) {
                                $params = array($id, $detailLocation[$i]["storeCode"], $detailLocation[$i]["locationCode"]);
                                $sql = "insert into event_same_location (event_id, store_code, location_code) values (?, ?, ?)";
                                $this->db->query($sql, $params);        
                        }
                }
                else {
                        for ($i = 0; $i < sizeof($detailLocation); $i++) {
                                $params = array($id, $detailLocation[$i]["tillcode"], $detailLocation[$i]["storeCode"], $detailLocation[$i]["locationCode"]);
                                $sql = "insert into event_location (event_id, tillcode, store_code, location_code) values (?, ?, ?, ?)";
                                $this->db->query($sql, $params);        
                        }        
                }
                
                # update to null date field
                $params = array($id);
                
                $sql = "update event_date set date_start = null where event_id = ? and date_start = '0001-01-01 BC'";
                $this->db->query($sql, $params);  
                $sql = "update event_date set date_end = null where event_id = ? and date_end = '0001-01-01 BC'";
                $this->db->query($sql, $params);  
                $sql = "update event_same_date set date_start = null where event_id = ? and date_start = '0001-01-01 BC'";
                $this->db->query($sql, $params);  
                $sql = "update event_same_date set date_end = null where event_id = ? and date_end = '0001-01-01 BC'";
                $this->db->query($sql, $params);
                
                # end transaction
                $this->db->trans_complete();
                
                return $this->db->trans_status();
        }
        
        public function addNew($about, $purpose, $attach, $toward, $department, $divisionCode, $source, $templateCode, $firstSignature, $secondSignature,
                               $notes, $cc, $isManualSetting, $letterDate, $isSameDate, $isSameLocation, $detailEvent, $detailDate, $detailLocation, $usr, $upd) {
                
                # get sequence number
                $seq = 0;
                $sql = "select nextval('event_seq') seq";        
                $query = $this->db->query($sql);
                if ($row = $query->row()) {
                        $seq = $row->seq;        
                }
                
                # create letter number
                $seqLetterNumber = 0;
                switch(strtoupper($divisionCode)) {
                        case "A":
                                $sql = "select nextval('letter_no_a_seq') seq";
                                $query = $this->db->query($sql);
                                if ($row = $query->row()) {
                                        $seqLetterNumber = $this->makeLetterNumber($row->seq, $divisionCode); 
                                }
                                break;
                        case "B":
                                $sql = "select nextval('letter_no_b_seq') seq";
                                $query = $this->db->query($sql);
                                if ($row = $query->row()) {
                                        $seqLetterNumber = $this->makeLetterNumber($row->seq, $divisionCode);    
                                }
                                break;
                        case "C":
                                $sql = "select nextval('letter_no_c_seq') seq";
                                $query = $this->db->query($sql);
                                if ($row = $query->row()) {
                                        $seqLetterNumber = $this->makeLetterNumber($row->seq, $divisionCode);      
                                }
                                break;
                        case "D":
                                $sql = "select nextval('letter_no_d_seq') seq";
                                $query = $this->db->query($sql);
                                if ($row = $query->row()) {
                                        $seqLetterNumber = $this->makeLetterNumber($row->seq, $divisionCode);     
                                }
                                break;
                        case "E":
                                $sql = "select nextval('letter_no_e_seq') seq";
                                $query = $this->db->query($sql);
                                if ($row = $query->row()) {
                                        $seqLetterNumber = $this->makeLetterNumber($row->seq, $divisionCode);     
                                }
                                break;        
                }
                $eventNo = $seqLetterNumber; 
                
                # start transaction
                $this->db->trans_start();
                
                # event
                $params = array($seq, $eventNo, $about, $purpose, $attach, $toward, $department, $divisionCode, $source, $templateCode, $firstSignature, $secondSignature,
                                $notes, $cc, $isManualSetting, $letterDate, $usr, $upd, $isSameDate, $isSameLocation);
                
                $sql = "insert into event (id, event_no, about, purpose, attach, toward, department, division_code, source, template_code, first_signature, " .
                                          "second_signature, notes, cc, is_manual_setting, letter_date, created_by, created_date, is_same_date, is_same_location) " .
                        "values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, to_date(?, 'dd-mm-yyyy'), ?, ?, ?, ?)";
                $this->db->query($sql, $params);
                
                # items
                for ($i = 0; $i < sizeof($detailEvent); $i++) {
                        
                        $ydsResponsibility = (is_numeric($detailEvent[$i]["ydsResponsibility"]) ? $detailEvent[$i]["ydsResponsibility"] : 0);
                        $suppResponsibility = (is_numeric($detailEvent[$i]["suppResponsibility"]) ? $detailEvent[$i]["suppResponsibility"] : 0);
                        $withoutResponsibility = ($ydsResponsibility == 0 && $suppResponsibility == 0 ? 1 : 0);
                        $isSp = ($detailEvent[$i]["sp"] == "" ? 0 : 1);
                        
                        $params = array(
                                        $seq,
                                        $detailEvent[$i]["tillcode"],
                                        $detailEvent[$i]["notes"],
                                        $detailEvent[$i]["suppCode"],
                                        $detailEvent[$i]["categoryCode"],
                                        $ydsResponsibility,
                                        $suppResponsibility,
                                        (is_numeric($detailEvent[$i]["isPkp"]) ? $detailEvent[$i]["isPkp"] : 0),
                                        (is_numeric($detailEvent[$i]["margin"]) ? $detailEvent[$i]["margin"] : 0),
                                        #$detailEvent[$i]["bruttoMargin"],
                                        #$detailEvent[$i]["netMargin"],
                                        $isSameLocation,
                                        $isSameDate,
                                        $withoutResponsibility,
                                        $isSp,
                                        (is_numeric($detailEvent[$i]["sp"]) ? $detailEvent[$i]["sp"] : 0),
                                );
                        
                        
                        $sql = "insert into event_item (event_id, tillcode, notes, supp_code, category_code, yds_responsibility, supp_responsibility, is_pkp, tax, " .
                                                        "same_location, same_date, without_responsibility, is_sp, special_price) ". 
                                "values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $this->db->query($sql, $params); 
                        
                }
                
                # date
                if ($isSameDate)
                        for ($i = 0; $i < sizeof($detailDate); $i++) {
                                $params = array($seq, $detailDate[$i]["dateStart"], $detailDate[$i]["dateEnd"]);
                                $sql = "insert into event_same_date (event_id, date_start, date_end) values (?, to_date(?, 'dd-mm-yyyy'), to_date(?, 'dd-mm-yyyy'))";
                                $this->db->query($sql, $params);        
                        }
                else {
                        for ($i = 0; $i < sizeof($detailDate); $i++) {
                                $params = array($seq, $detailDate[$i]["tillcode"], $detailDate[$i]["dateStart"], $detailDate[$i]["dateEnd"]);
                                $sql = "insert into event_date (event_id, tillcode, date_start, date_end) values (?, ?, to_date(?, 'dd-mm-yyyy'), to_date(?, 'dd-mm-yyyy'))";
                                $this->db->query($sql, $params);        
                        }      
                }
                
                # location
                if ($isSameLocation) {
                        for ($i = 0; $i < sizeof($detailLocation); $i++) {
                                $params = array($seq, $detailLocation[$i]["storeCode"], $detailLocation[$i]["locationCode"]);
                                $sql = "insert into event_same_location (event_id, store_code, location_code) values (?, ?, ?)";
                                $this->db->query($sql, $params);        
                        }
                }
                else {
                        for ($i = 0; $i < sizeof($detailLocation); $i++) {
                                $params = array($seq, $detailLocation[$i]["tillcode"], $detailLocation[$i]["storeCode"], $detailLocation[$i]["locationCode"]);
                                $sql = "insert into event_location (event_id, tillcode, store_code, location_code) values (?, ?, ?, ?)";
                                $this->db->query($sql, $params);        
                        }        
                }
                
                # update to null date field
                $params = array($seq);
                
                $sql = "update event_date set date_start = null where event_id = ? and date_start = '0001-01-01 BC'";
                $this->db->query($sql, $params);  
                $sql = "update event_date set date_end = null where event_id = ? and date_end = '0001-01-01 BC'";
                $this->db->query($sql, $params);  
                $sql = "update event_same_date set date_start = null where event_id = ? and date_start = '0001-01-01 BC'";
                $this->db->query($sql, $params);  
                $sql = "update event_same_date set date_end = null where event_id = ? and date_end = '0001-01-01 BC'";
                $this->db->query($sql, $params);  
                
                # end transaction
                $this->db->trans_complete();
                
                #return $this->db->trans_status();
                return $seq;
        }
        
        private function makeLetterNumber($num, $div) {
                #9999/SA.YDS/YG.SB/07/2015
                
                $code = "";
                switch(strtoupper($div)) {
                        case "A":
                                $code = "A";
                                break;
                        case "B":
                                $code = "B";
                                break;
                        case "C":
                                $code = "C";
                                break;
                        case "D":
                                $code = "SB";
                                break;
                        case "E":
                                $code = "E";
                                break;
                }
                
                return str_pad($num, 4, "0", STR_PAD_LEFT) . "/SA.YDS/YG." . $code . "/" . date("m") . "/" . date("Y");
        }
        
}