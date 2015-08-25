<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Template_Model extends CI_Model {
		
		function __construct(){
			date_default_timezone_set("Asia/Jakarta");
		}
		
		function all_list(){	
			$this->db->select('*'); 
			$this->db->from('mst_supplier'); 
			
			$ambil = $this->db->get();
			if ($ambil->num_rows() > 0){
				foreach ($ambil->result() as $data){
					$hasil[] = $data;
				}
				return $hasil;
			}
			
		}
		
		//utk generate sequential code Y01
		function new_code($prefix, $awal, $jml_substr, $jml_str_pad, $str){
			$tmp = $this->get_max_code($prefix);
			$urut = substr($tmp, $awal, $jml_substr) + 1;
			$new_code = $prefix.str_pad($urut, $jml_str_pad, $str, STR_PAD_LEFT);
			
			return $new_code;
			
		}
		
		function do_add_new($username){
            $rb_source = $this->input->post('rb_source');
			
			//generate new code
			$tmpl_code = $this->new_code($rb_source, '1', '2', '2', '0');
			
            $txt_name = $this->input->post('txt_name');
			$txt_header = $this->input->post('txt_header');
			$txt_footer = $this->input->post('txt_footer');
			$txt_notes = $this->input->post('txt_notes');
			
			$active = '1';
			$date = date("Y-m-d H:i:s");
			
			$data = array(
					   'tmpl_code' => $tmpl_code,
					   'tmpl_name' => $txt_name,
					   'header' => $txt_header,
					   'footer' => $txt_footer,
					   'notes' => $txt_notes,
					   'is_active' => $active,
					   'created_by' => $username,
					   'created_date' => $date,
					   'updated_by' => null,
					   'updated_date' => null
					);
			
			$this->db->insert('mst_template', $data);
			
		}

		function cek_kode($kode){
            $q = $this->db->query("select kode from mst_supplier where LOWER(kode)='".strtolower($kode)."' ");
			if ($q->num_rows() >= 1){
				$ada = 1;
			}else $ada = 0;

			return $ada;
		}


		function show_modal($kode){
			$sql = "SELECT kode, init, nama, alamat, kontak, active from mst_supplier WHERE kode='$kode' ";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				return $query;
			}
		}

		function edit($username){
			$kode = $this->input->post('txt_kode_show');
			$nama = $this->input->post('txt_nama_show');
			$alamat = $this->input->post('txt_alamat_show');
			$kontak = $this->input->post('txt_kontak_show');
			$active = $this->input->post('rb_active_show');

			$update_at = date("Y-m-d H:i:s");

			$data = array(
						'nama' => $nama,
						'alamat' => $alamat,
						'kontak' => $kontak,
						'active' => $active,
						'update_by' => $username,
						'update_at' => $update_at
					);
			$this->db->where('kode', $kode);
			$this->db->update('mst_supplier',$data);
		}

		function get_max_code($prefix){
			$sql = "SELECT MAX(tmpl_code) AS max_code FROM mst_template WHERE tmpl_code ILIKE '$prefix%' ";
			$query = $this->db->query($sql);
			
			if ($query->num_rows() > 0){
				$r = $query->row();
				return $r->max_code;
			}
			
		}
		
		
		

	}
?>