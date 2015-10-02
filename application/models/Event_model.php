<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Event_model extends CI_Model {
		
		function __construct(){
			
		}
		
		function all_list(){	
			$sql = "SELECT a.id, a.event_no, a.about, a.toward , 
					TO_CHAR(a.created_date, 'dd Mon yyyy') as created_date
					FROM event a 
					LEFT JOIN event_item b ON(a.id=b.event_id) 
					JOIN mst_template c ON(a.template_code=c.tmpl_code)
					WHERE c.is_active='1'
					GROUP BY a.id, a.event_no, a.about, a.toward 

				";//WHERE b.same_location='1' AND b.same_date='0' 
			
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
					f.supp_desc, f.city, f.fax, md.name AS md_name
					
					FROM mst_template a JOIN event b ON(a.tmpl_code=b.template_code) 
					JOIN event_item c ON(b.id=c.event_id)
					JOIN mst_tillcode d ON(c.tillcode=d.tillcode)
					JOIN mst_brand e ON(d.brand_code=e.brand_code)
					JOIN mst_supplier f ON(c.supp_code=f.supp_code)
					JOIN mst_md md ON(md.cat_code=c.category_code)
					
					WHERE b.id='$id' AND a.is_active='1' ";
			
			$ambil = $this->db->query($sql);
			return $ambil->result();
			
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
		
		function get_event_same_location($id){	
			$sql = "SELECT loc_desc, b.store_desc 
					FROM event_same_location a JOIN mst_store b ON(a.store_code=b.store_code) 
					JOIN mst_location c ON(c.loc_code=a.location_code)
					WHERE a.event_id='$id' 
					";
					
			$ambil = $this->db->query($sql);
			return $ambil->result();
			
		}
		
		function get_event_location($id, $tillcode){	
			$sql = "SELECT loc_desc, b.store_desc 
					FROM event_location a JOIN mst_store b ON(a.store_code=b.store_code) 
					JOIN mst_location c ON(c.loc_code=a.location_code)
					JOIN mst_tillcode d ON(d.tillcode=a.tillcode)
					WHERE a.event_id='$id' AND a.tillcode='$tillcode' 
					";
					
			$ambil = $this->db->query($sql);
			return $ambil->result();
			
		}
		
		function get_supplier($id, $tillcode){	
			$sql = "SELECT DISTINCT b.supp_code, b.supp_desc
					FROM event_item a JOIN mst_supplier b ON(a.supp_code=b.supp_code)
					WHERE a.event_id='$id' AND a.tillcode='$tillcode'
					";
					
			$ambil = $this->db->query($sql);
			return $ambil->result();
			
		}
		
		function get_supplier_header($id){	
			$sql = "SELECT DISTINCT b.supp_code, b.supp_desc
					FROM event_item a JOIN mst_supplier b ON(a.supp_code=b.supp_code)
					WHERE a.event_id='$id' 
					";
					
			$ambil = $this->db->query($sql);
			return $ambil->result();
			
		}

		function get_jml_supplier($id){	
			$sql = "SELECT DISTINCT b.supp_code, b.supp_desc
					FROM event_item a JOIN mst_supplier b ON(a.supp_code=b.supp_code)
					WHERE a.event_id='$id' 
					";
					
			$ambil = $this->db->query($sql);
			
			return $ambil->num_rows();
			
		}

		function get_supplier_data($id){	
			$sql = "SELECT DISTINCT b.supp_code, b.supp_desc
					FROM event_item a JOIN mst_supplier b ON(a.supp_code=b.supp_code)
					WHERE a.event_id='$id' 
					";
					
			$ambil = $this->db->query($sql);
			return $ambil->result();
			
		}

		function get_event_date($id, $tillcode){	
			$sql = "SELECT * 
					FROM event_date
					WHERE event_id='$id' AND tillcode='$tillcode' ORDER BY date_start ASC
					";
					
			$ambil = $this->db->query($sql);
			
			return $ambil->result();
			
		}
		
		function get_event_same_date($id){	
			$sql = "SELECT * 
					FROM event_same_date
					WHERE event_id='$id' ORDER BY date_start ASC
					";
					
			$ambil = $this->db->query($sql);
			return $ambil->result();
			
		}
		
		function get_tillcode($id){	
			$sql = "SELECT a.* 
					FROM mst_tillcode a JOIN event_item b ON(a.tillcode=b.tillcode)
					WHERE b.event_id='$id' 
					ORDER BY a.disc_label ASC
					";
					
			$ambil = $this->db->query($sql);
			return $ambil->result();
			
		}
		
		function get_same_location_content($id){	
			
			$same_date = $this->is_same_date($id);
			if ($same_date=="0"){
				$join = " JOIN event_date x ON(x.event_id=c.event_id) ";

			} else {
				$join = " JOIN event_same_date x ON(x.event_id=c.event_id) ";
			}

			$sql = "SELECT * FROM 
					(
						SELECT DISTINCT ON(c.notes) c.yds_responsibility, c.supp_responsibility, c.is_pkp, c.tax,
						c.event_id, c.tillcode, c.notes, c.brutto_margin, c.net_margin,
						e.disc_label, e.disc1, e.disc2, c.special_price, e.price, c.is_sp,
						x.date_start, s.supp_code,
						(e.disc1+e.disc2) as jdisc
						
						FROM event_item c JOIN event_same_location d ON(d.event_id=c.event_id)
						JOIN mst_tillcode e ON(c.tillcode=e.tillcode)" . 
						
						$join . 
						
						"
						JOIN mst_supplier s ON(s.supp_code=c.supp_code)

						WHERE c.event_id='$id' 
						
						GROUP BY c.yds_responsibility, c.supp_responsibility, c.is_pkp, c.tax,
						c.event_id, c.tillcode, c.notes, c.brutto_margin, c.net_margin,
						e.disc_label, e.disc1, e.disc2, c.special_price, e.price, c.is_sp,
						x.date_start, s.supp_code

						ORDER BY c.notes

					) AS y
					
					ORDER BY CASE WHEN y.is_sp=1 THEN 1
						ELSE 0
					END, y.supp_code ASC, jdisc ASC, y.date_start ASC


					";
					
			//FROM event b JOIN event_item c ON(b.id=c.event_id)
			$ambil = $this->db->query($sql);
			return $ambil->result();
			
		}
		
		function get_diff_location_content($id){	

			$same_date = $this->is_same_date($id);
			if ($same_date=="0"){
				$join = " JOIN event_date x ON(x.event_id=c.event_id) ";

			} else {
				$join = " JOIN event_same_date x ON(x.event_id=c.event_id) ";
			}
			
			
			$sql = "SELECT * FROM 
					(
						SELECT DISTINCT ON(c.notes) c.yds_responsibility, c.supp_responsibility, c.is_pkp, 
						c.event_id, c.tillcode, c.notes, c.tax, c.brutto_margin, c.net_margin,
						e.disc_label, e.disc1, e.disc2, c.special_price, e.price, c.is_sp,
						x.date_start, s.supp_code,
						(e.disc1+e.disc2) as jdisc
						
						FROM event_item c JOIN event_location d ON(d.event_id=c.event_id)
						JOIN mst_tillcode e ON(c.tillcode=e.tillcode) " .

						$join .

						"
						JOIN mst_supplier s ON(s.supp_code=c.supp_code)

						WHERE c.event_id='$id' 

						GROUP BY c.yds_responsibility, c.supp_responsibility, c.is_pkp,
						c.event_id, c.tillcode, c.notes, c.tax, c.brutto_margin, c.net_margin,
						e.disc_label, e.disc1, e.disc2, c.special_price, e.price, c.is_sp,
						x.date_start, s.supp_code

						ORDER BY c.notes

					) AS y

					ORDER BY CASE WHEN y.is_sp=1 THEN 1
						ELSE 0
					END, y.supp_code ASC, jdisc ASC, y.date_start ASC
					";	
			//FROM event b JOIN event_item c ON(b.id=c.event_id)
			$ambil = $this->db->query($sql);
			return $ambil->result();
			
		}
		
		//calculate contoh perhitungan
		function get_calculate($id){	

			$sql = "SELECT * FROM
					(
						SELECT DISTINCT ON(a.notes) b.*,
							a.is_pkp, a.tax, a.yds_responsibility, 
							a.special_price, a.supp_responsibility, 
							a.is_sp AS sp_event,
							(b.disc1+b.disc2) as jdisc

						FROM event_item a JOIN mst_tillcode b ON(a.tillcode=b.tillcode)
						WHERE a.event_id='$id'
					) AS x
					ORDER BY CASE WHEN x.sp_event=1 THEN 1
						ELSE 0
					END, jdisc, x.disc1 ASC, x.disc2 ASC
					";

					
			$ambil = $this->db->query($sql);
			return $ambil->result();
			
		}
		
		function get_event_no($id){
			$this->db->select('event_no');
			$this->db->from('event');
			$this->db->where('id', $id);
			
			$q = $this->db->get()->row();
			$r = $q->event_no;
			return $r;		
		}


	}
?>