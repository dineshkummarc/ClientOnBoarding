<?php
	class User_model extends CI_Model{
		/*user_master (user_id, user_email, user_name, user_password, user_type, status)
		$data = array(
			'user_email' 	=> '',
			'user_name' 	=> '', 
			'user_password' => '', 
			'user_type' 	=> ''
		);*/
		//CRUD
		public function addUser($data){
			return $this->db->insert('user_master', $data);
		}
		public function getAllUser(){
			$this->db->where('status', '1');
			$query = $this->db->get('user_master');
			return $query->result_array();
		}
		//$TYP 1=>user_id, 2=>user_email
		public function getUser($key,$typ){
			$tmp = array('user_id' => $key);
			if($typ==2)
				$tmp = array('user_email' => $key);
			$query = $this->db->get_where('user_master', $tmp);
			return $query->row();
		}
		public function editUser($data,$id){
			$this->db->where('user_id', $id);
			return $this->db->update('user_master', $data);
		}
		public function delUser($id){
			$data = array(
				'status' => '2',
			);
			$this->db->where('user_id', $id);
			return $this->db->update('user_master', $data);
			/*$this->db->where('user_id', $id);
			$this->db->delete('user_master');
			return true;*/
		}
		// Extra
		public function doLogin($username, $password){
			$this->db->where('user_email', $username);
			$this->db->where('user_password', $password);
			$this->db->where('status', '1');
			$result = $this->db->get('user_master');
			if($result->num_rows() == 1){
				return $result->row(0);
			} else {
				return false;
			}
		}
		public function cntUsers($key='',$fil=''){
			if($key!=''){
				$this->db->or_like('user_email', $key);
				$this->db->or_like('user_name', $key);
			}
			if($fil!='')
				$this->db->where('user_type', $fil);
			if($fil!='' || $key!=''){
				$this->db->from('user_master');
				return $this->db->count_all_results();
			}else
				return $this->db->count_all('user_master');
		}
		public function getPgUsers($limit, $start, $key='', $typ='', $fil=''){
			if($key!=''){
				$this->db->or_like('user_email', $key);
				$this->db->or_like('user_name', $key);
			}
			if($fil!=''){
				$this->db->where('user_type', $fil);	
			}
			if($typ!=''){
				$this->db->order_by($typ);
			}
			$this->db->limit($limit, $start);
			$query = $this->db->get("user_master");
			return $query->result_array();
		}
	}