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
        
        public function loadTillcodeByDivision($divisionCode, $arrayMode = false) {	
                $params = array($divisionCode);
                $sql = "select tillcode, disc_label, brand_code from mst_tillcode where division_code = ? and is_active = 1 order by disc_label";
                $query = $this->db->query($sql, $params);
                
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
                $params = array($id, $eventNo, $about, $purpose, $attach, $toward, $department, $divisionCode, $source, $templateCode, $firstSignature, $secondSignature,
                                $notes, $cc, $isManualSetting, $letterDate, $usr, $upd);
                
                $sql = "update event set event_no = ?, about = ?, purpose = ?, attach = ?, toward = ?, department = ?, division_code = ?, source = ?, template_code = ?, " .
                                "first_signature = ?, second_signature = ?, notes = ?, cc = ?, is_manual_setting = ?, letter_date = to_date(?, 'dd-mm-yyyy'), updated_by = ?, updated_date = ? " .
                                "where id = ?";
                $this->db->query($sql, $params);
                
                # items
                for ($i = 0; $i < sizeof($detailEvent); $i++) {
                        $params = array(
                                        $id,
                                        $detailEvent[$i]["tillcode"],
                                        #$detailEvent[$i]["categoryCode"],
                                        $detailEvent[$i]["notes"],
                                        $detailEvent[$i]["suppCode"],
                                        $detailEvent[$i]["ydsResponsibility"],
                                        $detailEvent[$i]["suppResponsibility"],
                                        $detailEvent[$i]["isPkp"],
                                        $detailEvent[$i]["margin"],
                                        #$detailEvent[$i]["bruttoMargin"],
                                        #$detailEvent[$i]["netMargin"],
                                        $isSameDate,
                                        $isSameLocation 
                                );
                        $sql = "insert into event_item (event_id, tillcode, notes, supp_code, yds_responsibility, supp_responsibility, is_pkp, tax, " .
                                                        "same_location, same_date) ". 
                                "values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
                                        $seqLetterNumber = $row->seq;        
                                }
                                break;
                        case "B":
                                $sql = "select nextval('letter_no_b_seq') seq";
                                $query = $this->db->query($sql);
                                if ($row = $query->row()) {
                                        $seqLetterNumber = $row->seq;        
                                }
                                break;
                        case "C":
                                $sql = "select nextval('letter_no_c_seq') seq";
                                $query = $this->db->query($sql);
                                if ($row = $query->row()) {
                                        $seqLetterNumber = $row->seq;        
                                }
                                break;
                        case "D":
                                $sql = "select nextval('letter_no_d_seq') seq";
                                $query = $this->db->query($sql);
                                if ($row = $query->row()) {
                                        $seqLetterNumber = $row->seq;        
                                }
                                break;
                        case "E":
                                $sql = "select nextval('letter_no_e_seq') seq";
                                $query = $this->db->query($sql);
                                if ($row = $query->row()) {
                                        $seqLetterNumber = $row->seq;        
                                }
                                break;
                        default: // shoes n bags
                                $sql = "select nextval('letter_no_d_seq') seq";
                                $query = $this->db->query($sql);
                                if ($row = $query->row()) {
                                        $seqLetterNumber = $row->seq;        
                                }
                                
                }
                $eventNo = $seqLetterNumber; # fix this later
                
                # start transaction
                $this->db->trans_start();
                
                # event
                $params = array($seq, $eventNo, $about, $purpose, $attach, $toward, $department, $divisionCode, $source, $templateCode, $firstSignature, $secondSignature,
                                $notes, $cc, $isManualSetting, $letterDate, $usr, $upd);
                
                $sql = "insert into event (id, event_no, about, purpose, attach, toward, department, division_code, source, template_code, first_signature, " .
                                          "second_signature, notes, cc, is_manual_setting, letter_date, created_by, created_date) " .
                        "values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, to_date(?, 'dd-mm-yyyy'), ?, ?)";
                $this->db->query($sql, $params);
                
                # items
                for ($i = 0; $i < sizeof($detailEvent); $i++) {
                        $params = array(
                                        $seq,
                                        $detailEvent[$i]["tillcode"],
                                        #$detailEvent[$i]["categoryCode"],
                                        $detailEvent[$i]["notes"],
                                        $detailEvent[$i]["suppCode"],
                                        (is_numeric($detailEvent[$i]["ydsResponsibility"]) ? $detailEvent[$i]["ydsResponsibility"] : 0),
                                        (is_numeric($detailEvent[$i]["suppResponsibility"]) ? $detailEvent[$i]["suppResponsibility"] : 0),
                                        (is_numeric($detailEvent[$i]["isPkp"]) ? $detailEvent[$i]["isPkp"] : 0),
                                        (is_numeric($detailEvent[$i]["margin"]) ? $detailEvent[$i]["margin"] : 0),
                                        #$detailEvent[$i]["bruttoMargin"],
                                        #$detailEvent[$i]["netMargin"],
                                        $isSameLocation,
                                        $isSameDate
                                );
                        $sql = "insert into event_item (event_id, tillcode, notes, supp_code, yds_responsibility, supp_responsibility, is_pkp, tax, " .
                                                        "same_location, same_date) ". 
                                "values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
        
        private function makeDate($v) {
                
        }
        
}