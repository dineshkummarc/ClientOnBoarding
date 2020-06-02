<?php
	class Question_model extends CI_Model{
		# category_master(category_id, name, position)
		/*$data = array(
			'name' => '',
			'position' => ''
		);*/
		//CRUD
		public function addCat($data){
			return $this->db->insert('category_master', $data);
		}
		public function getAllCats(){
			$this->db->order_by('position asc');
			$query = $this->db->get('category_master');
			return $query->result_array();
		}
		public function getCat($key){
			$tmp = array('category_id' => $key);
			$query = $this->db->get_where('category_master', $tmp);
			return $query->row();
		}
		public function editCat($data,$id){
			$this->db->where('category_id', $id);
			return $this->db->update('category_master', $data);
		}
		public function delCat($id){
			$this->db->where('category_id', $id);
			$this->db->delete('category_master');
			return true;
		}
		# question_master(question_id, category_id, title, question_desc, question_type, question_opt, position, isrequired, israting, has_multiple)
		/*$data = array(
			'category_id' 	=> '', 
			'title' 		=> '',
			'quest_desc' => '',
			'quest_type' => '',
			'question_opt' 	=> '',
			'position' 		=> '',
			'isrequired' 	=> '',
			'israting'  	=> '', 
			'has_multiple' 	=> ''
		);*/
		//CRUD
		public function addQuest($data){
			return $this->db->insert('question_master', $data);
		}
		public function editQuest($data,$id){
			$this->db->where('question_id', $id);
			$this->db->update('question_master', $data);
			return $data;
		}
		public function delQuest($id){
			$this->db->where('question_id', $id);
			$this->db->delete('question_master');
			return true;
		}
		public function getQuest($key){
			$tmp = array('question_id' => $key);
			$query = $this->db->get_where('question_master', $tmp);
			return $query->row();
		}
		public function getQuestCats($key){
			$tmp = array('category_id' => $key);
			$this->db->order_by('position asc');
			$query = $this->db->get_where('question_master', $tmp);
			return $query->result_array();
		}
		public function getQuestCount(){
			return $this->db->count_all('question_master');
		}
		public function getAllQuest($limit='', $start='', $key='', $typ=''){
			//$this->db->limit($limit, $start);
			$query = $this->db->get("question_master");
			return $query->result_array();
		}
		# company_question (id, company_id, category_id, category_name, meta_key, meta_value)
		/*$data = array(
			'company_id' => '',
			'category_id' => '',
			'category_name' => '',
			'meta_key' => '',
			'meta_value' => ''
		);*/
		public function addAns($data){
			return $this->db->insert('company_question', $data);
		}
		public function getAllCompanyAns($key){
	        $tmp = array('company_id' => $key);
	        $query = $this->db->get_where('company_question', $tmp);
			return $query->result_array();
	    }
	    public function getCompanyAns($cid, $key){
	        $tmp = array('company_id' => $cid,'question_id' => $key);
	        $query = $this->db->get_where('company_question', $tmp);
			return $query->result_array();
	    }
	}