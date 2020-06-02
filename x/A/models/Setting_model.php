<?php
	class Setting_model extends CI_Model{
		/*region_master(region_id, region_name, pmxscore)
		$data = array(
			'region_name' 	=> '',
			'pmxscore' 	=> ''
		);*/
		//CRUD REGION
		public function addRegion($data){
			return $this->db->insert('region_master', $data);
		}
		public function getAllRegion(){
			$query = $this->db->get('region_master');
			return $query->result_array();
		}
		public function getRegion($key){
			$tmp = array('region_id' => $key);
			$query = $this->db->get_where('region_master', $tmp);
			return $query->row();
		}
		public function editRegion($data,$id){
			$this->db->where('region_id', $id);
			return $this->db->update('region_master', $data);
		}
		public function delRegion($id){
			$this->db->where('region_id', $id);
			$this->db->delete('region_master');
			return true;
		}
		/*industry_master(industry_id, industry_name, pmxscore)
		$data = array(
			'industry_name' 	=> '',
			'pmxscore' 	=> ''
		);*/
		//CRUD INDUSTRY
		public function addIndustry($data){
			return $this->db->insert('industry_master', $data);
		}
		public function getAllIndustry(){
			$query = $this->db->get('industry_master');
			return $query->result_array();
		}
		public function getIndustry($key){
			$tmp = array('industry_id' => $key);
			$query = $this->db->get_where('industry_master', $tmp);
			return $query->row();
		}
		public function editIndustry($data,$id){
			$this->db->where('industry_id', $id);
			return $this->db->update('industry_master', $data);
		}
		public function delIndustry($id){
			$this->db->where('industry_id', $id);
			$this->db->delete('industry_master');
			return true;
		}
		/* Extras */
		public function cntIndustry($key=''){
			if($key!=''){
				$this->db->or_like('industry_name', $key);
				$this->db->or_like('pmxscore', $key);
				$this->db->from('industry_master');
				return $this->db->count_all_results();
			}else
				return $this->db->count_all('industry_master');
		}
		public function getPgIndustry($limit, $start, $key='', $typ=''){
			if($key!=''){
				$this->db->or_like('industry_name', $key);
				$this->db->or_like('pmxscore', $key);
			}
			if($typ!=''){
				$this->db->order_by($typ);
			}
			$this->db->limit($limit, $start);
			$query = $this->db->get("industry_master");
			return $query->result_array();
		}
		/*channel_master(id, name, pmxscore)
		$data = array(
			'name' 	=> '',
			'pmxscore' 	=> ''
		);*/
		//CRUD CHANNEL
		public function addChannel($data){
			return $this->db->insert('channel_master', $data);
		}
		public function getAllChannel(){
			$query = $this->db->get('channel_master');
			return $query->result_array();
		}
		public function getChannel($key){
			$tmp = array('id' => $key);
			$query = $this->db->get_where('channel_master', $tmp);
			return $query->row();
		}
		public function editChannel($data,$id){
			$this->db->where('id', $id);
			return $this->db->update('channel_master', $data);
		}
		public function delChannel($id){
			$this->db->where('id', $id);
			$this->db->delete('channel_master');
			return true;
		}
		/*country_master(id, region_id, iso, iso3, name, phonecode, income, comments, pmxscore)
		$data = array(
			'region_id' => '',
			'iso' 		=> '',
			'iso3'		=> '',
			'name'		=> '',
			'income'	=> '',
			'phonecode' => '',
			'comments'	=> '',
			'pmxscore'	=> ''
		);*/
		//CRUD COUNTRY
		public function addCountry($data){
			return $this->db->insert('country_master', $data);
		}
		public function getAllCountry(){
			$this->db->order_by('name', 'ASC');
			$query = $this->db->get('country_master');
			return $query->result_array();
		}
		public function getCountry($key){
			$tmp = array('id' => $key);
			$query = $this->db->get_where('country_master', $tmp);
			return $query->row();
		}
		public function getCountryByIso3($key){
        	if(strlen($key)==3)
        		$tmp = array('iso3' => $key);
        	else
        		$tmp = array('iso' => $key);
        	$query = $this->db->get_where('country_master', $tmp);
        	return $query->row();
    	}
		public function editCountry($data,$id){
			$this->db->where('id', $id);
			return $this->db->update('country_master', $data);
		}
		public function delCountry($id){
			$this->db->where('id', $id);
			$this->db->delete('country_master');
			return true;
		}
		/* Extras */
		public function cntCountry($key='',$fil=''){
			if($key!=''){
				$this->db->like('iso', $key);
				$this->db->or_like('iso3', $key);
				$this->db->or_like('name', $key);
				$this->db->or_like('phonecode', $key);
				$this->db->or_like('income', $key);
				$this->db->or_like('comments', $key);
				$this->db->or_like('pmxscore', $key);
			}
			if($fil!='')
				$this->db->where('region_id', $fil);
			if($fil!='' || $key!=''){
				$this->db->from('country_master');
				return $this->db->count_all_results();
			}else
				return $this->db->count_all('country_master');
		}
		public function getPgCountry($limit, $start, $key='', $typ='', $fil=''){
			if($key!=''){
				$this->db->like('iso', $key);
				$this->db->or_like('iso3', $key);
				$this->db->or_like('name', $key);
				$this->db->or_like('phonecode', $key);
				$this->db->or_like('income', $key);
				$this->db->or_like('comments', $key);
				$this->db->or_like('pmxscore', $key);
			}
			if($fil!=''){
				$this->db->where('region_id', $fil);	
			}
			if($typ!=''){
				$this->db->order_by($typ);
			}
			$this->db->limit($limit, $start);
			$query = $this->db->get("country_master");
			return $query->result_array();
		}
	}