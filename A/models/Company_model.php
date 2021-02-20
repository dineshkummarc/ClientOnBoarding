<?php 
	class Company_model extends CI_Model{
	    /*
	    company_master(company_id, company_name, company_type, company_www, company_currency, reg_number, reg_dt, reg_addr, reg_country, oper_addr, oper_country, tax_number, tax_country, noc)
	    $data = array(
	    	'company_name' 		=> '', 
	    	'company_type' 		=> '', 
	    	'company_www'		=> '', 
	    	'company_currency' 	=> '', 
	    	'reg_number' 		=> '',  
	    	'reg_dt' 			=> '',  
	    	'reg_addr' 			=> '', 
	    	'reg_country' 		=> '', 
	    	'oper_addr' 		=> '', 
	    	'oper_country' 		=> '',
	    	'oper_region'		=> '',
	    	'tax_number' 		=> '', 
	    	'tax_country' 		=> '', 
	    	'noc' 				=> ''
		);
		company_structure(id, company_id, info)
		$data = array(
			'company_id' => '',
			'info' => ''
		);
		*/
		//CRUD

		public function addCompanyStructure($data){
			$this->db->insert('company_structure', $data);
			return $this->db->insert_id();
		}
		public function getCompanyStructure($key){
			$tmp = array('company_id' => $key);
	        $query = $this->db->get_where('company_structure', $tmp);
	        return $query->row();
		}
		public function editCompanyStructure($data,$id){
			$this->db->where('company_id', $id);
			return $this->db->update('company_structure', $data);
		}
		public function addCompany($data){
			$this->db->insert('company_master', $data);
			return $this->db->insert_id();
		}
	    public function getAllCompany(){
	        $query = $this->db->get('company_master');
			return $query->result_array();
	    }
	    public function getCompany($key){
	        $tmp = array('company_id' => $key);
	        $query = $this->db->get_where('company_master', $tmp);
	        return $query->row();
	    }
	    public function getFrontCompany($key){
	    	$query = $this->db->query("SELECT * FROM company_master WHERE md5(company_id) = '$key'");
	    	return $query->row();
	    }
	    public function editCompany($data,$id){
			$this->db->where('company_id', $id);
			return $this->db->update('company_master', $data);
		}

		public function cntCos($key='',$ct){
			$this->db->where('status', $ct);
			if($key!=''){
				$this->db->like('company_name', $key);
			}
			$this->db->from('company_master');
			return $this->db->count_all_results();
		}
		public function getPgCos($ct, $limit, $start, $key='', $typ=''){
			$this->db->where('status', $ct);
			if($key!=''){
				$this->db->like('company_name', $key);
			}
			if($typ!=''){
				$this->db->order_by($typ);
			}else{
				$this->db->order_by('company_id','DESC');
			}
			$this->db->limit($limit, $start);
			$query = $this->db->get("company_master");
			return $query->result_array();
		}

		public function genScoreCos(){
			$this->db->where('score', '0.00');
			$query = $this->db->get("company_master");
			return $query->result_array();
		}
	}

