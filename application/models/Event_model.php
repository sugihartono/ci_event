<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Event_model extends CI_Model {
		
		function __construct(){
			
		}
		
		function all_list(){	
			$sql = "SELECT a.id, a.event_no, a.about, a.toward FROM event a";
			
			$ambil = $this->db->query($sql);
			if ($ambil->num_rows() > 0){
				foreach ($ambil->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
			
		}
		
		function get_template($id){	
			$sql = "SELECT a.tmpl_code, a.tmpl_name, a.header, a.footer, a.notes AS template_notes,
					b.*,
					e.brand_desc,
					f.supp_desc, f.city, f.fax
					
					FROM mst_template a JOIN event b ON(a.tmpl_code=b.template_code) 
					JOIN event_item c ON(b.id=c.event_id)
					JOIN mst_tillcode d ON(c.tillcode=d.tillcode)
					JOIN mst_brand e ON(d.brand_code=e.brand_code)
					JOIN mst_supplier f ON(c.supp_code=f.supp_code)
					
					WHERE b.id='$id' AND a.is_active='1' ";
			
			$ambil = $this->db->query($sql);
			if ($ambil->num_rows() > 0){
				return $ambil;
			}
			
		}
		
		function is_same_location($id){
			$this->db->select('same_location');
			$this->db->from('event_item');
			$this->db->where('event_id', $id);
			
			$q = $this->db->get()->row();
			$r = $q->same_location;
			return $r;		
		}
		
		function is_same_date($id){
			$this->db->select('same_date');
			$this->db->from('event_item');
			$this->db->where('event_id', $id);
			
			$q = $this->db->get()->row();
			$r = $q->same_date;
			return $r;
			
			/* if ($r=='1'){
				$sql = "SELECT * FROM event_same_date WHERE event_id='$id' ";
			} else {
				$sql = "SELECT * FROM event_date WHERE event_id='$id' ";
			}
			
			$ambil = $this->db->query($sql);
			if ($ambil->num_rows() > 0){
				return $ambil;
			} */
		}
		
		function get_same_location_content($id){	
			$sql = "SELECT c.yds_responsibility, c.supp_responsibility, c.is_pkp, 
					c.event_id, c.tillcode, c.notes, c.tax, c.brutto_margin, c.net_margin,
					e.disc_label, e.disc1, e.disc2, e.special_price
					
					FROM event_item c JOIN event_same_location d ON(d.event_id=c.event_id)
					JOIN mst_tillcode e ON(c.tillcode=e.tillcode)
					WHERE c.event_id='$id' 
					
					GROUP BY c.yds_responsibility, c.supp_responsibility, c.is_pkp, 
					c.event_id, c.tillcode, c.notes, c.tax, c.brutto_margin, c.net_margin,
					e.disc_label, e.disc1, e.disc2, e.special_price";
					
			//FROM event b JOIN event_item c ON(b.id=c.event_id)
			$ambil = $this->db->query($sql);
			if ($ambil->num_rows() > 0){
				return $ambil;
			}
			
		}
		
		function get_event_same_location($id){	
			$sql = "SELECT loc_desc, b.store_desc 
					FROM event_same_location a JOIN mst_store b ON(a.store_code=b.store_code) 
					JOIN mst_location c ON(c.loc_code=a.location_code)
					WHERE a.event_id='$id' 
					";
					
			$ambil = $this->db->query($sql);
			if ($ambil->num_rows() > 0){
				return $ambil;
			}
			
		}
		
		function get_supplier($id){	
			$sql = "SELECT DISTINCT b.supp_code, b.supp_desc
					FROM event_item a JOIN mst_supplier b ON(a.supp_code=b.supp_code)
					WHERE a.event_id='$id' 
					";
					
			$ambil = $this->db->query($sql);
			if ($ambil->num_rows() > 0){
				return $ambil;
			}
			
		}
		
		function get_event_date($id, $tillcode){	
			$sql = "SELECT * 
					FROM event_date
					WHERE event_id='$id' AND tillcode='$tillcode'
					";
					
			$ambil = $this->db->query($sql);
			if ($ambil->num_rows() > 0){
				return $ambil;
			}
			
		}
		
		function get_event_same_date($id){	
			$sql = "SELECT * 
					FROM event_same_date
					WHERE event_id='$id' 
					";
					
			$ambil = $this->db->query($sql);
			if ($ambil->num_rows() > 0){
				return $ambil;
			}
			
		}
		
		function get_tillcode($id){	
			$sql = "SELECT a.* 
					FROM mst_tillcode a JOIN event_item b ON(a.tillcode=b.tillcode)
					WHERE b.event_id='$id' 
					ORDER BY a.disc_label ASC
					";
					
			$ambil = $this->db->query($sql);
			if ($ambil->num_rows() > 0){
				return $ambil;
			}
			
		}
		
		function get_diff_location_content($id){	
			$sql = "SELECT c.yds_responsibility, c.supp_responsibility, c.is_pkp, 
					c.event_id, c.tillcode, c.notes, c.tax, c.brutto_margin, c.net_margin,
					e.disc_label, e.disc1, e.disc2, e.special_price
					
					FROM event_item c JOIN event_location d ON(d.event_id=c.event_id)
					JOIN mst_tillcode e ON(c.tillcode=e.tillcode)
					WHERE c.event_id='$id' 
					
					GROUP BY c.yds_responsibility, c.supp_responsibility, c.is_pkp, 
					c.event_id, c.tillcode, c.notes, c.tax, c.brutto_margin, c.net_margin,
					e.disc_label, e.disc1, e.disc2, e.special_price";
					
			//FROM event b JOIN event_item c ON(b.id=c.event_id)
			$ambil = $this->db->query($sql);
			if ($ambil->num_rows() > 0){
				return $ambil;
			}
			
		}
		
		
	}
?>