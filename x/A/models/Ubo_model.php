<?php 
	class Ubo_model extends CI_Model{
	    /*ubo_master (ubo_id, company_id, ubo_name, ubo_dob, ubo_nationality1, ubo_nationality2, id_type, id_number, id_expiry, id_country, addr, addr_country, tax_number, tax_country, ubo_share)
	    $data = array(
	    	'company_id' 		=> '',
	    	'ubo_name' 			=> '',
	    	'ubo_dob' 			=> '',
	    	'ubo_nationality1' 	=> '',
	    	'ubo_nationality2' 	=> '',
	    	'id_type'			=> '',
	    	'id_number' 		=> '',
	    	'id_expiry' 		=> '',
	    	'id_country' 		=> '',
	    	'addr' 				=> '',
	    	'addr_country' 		=> '',
	    	'tax_number' 		=> '',
	    	'tax_country' 		=> '',
	    	'ubo_share' 		=> ''
		);*/
		//CRUD
		public function addUbo($data){
			$this->db->insert('ubo_master', $data);
			return $this->db->insert_id();
		}
	    public function getAllUbo($key){
	        $tmp = array('company_id' => $key);
	        $query = $this->db->get_where('ubo_master', $tmp);
			return $query->result_array();
	    }
	    public function getUbo($key){
	        $tmp = array('ubo_id' => $key);
	        $query = $this->db->get_where('ubo_master', $tmp);
	        return $query->row();
	    }
	    public function editUbo($data,$id){
			$this->db->where('ubo_id', $id);
			return $this->db->update('ubo_master', $data);
		}
	}

