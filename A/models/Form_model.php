<?php 
	class Form_model extends CI_Model{
	    /*form_master(id, company_id, channel_id, form_name, form_phone, form_email, form_desig, rdt, status)
	    $data = array(
	    	'company_id' 	=> '', 
	    	'channel_id' 	=> '', 
	    	'form_name'		=> '', 
	    	'form_phone' 	=> '', 
	    	'form_email' 	=> '',  
	    	'form_desig' 	=> '',  
	    	'rdt' 			=> '', 
	    	'status' 		=> ''
		);
		form_comments(id, form_id, form_inf, dt)
		$data = array(
	    	'form_id' 	=> '', 
	    	'form_inf' 	=> '',  
	    	'dt' 			=> ''
		);*/
		//CRUD
		public function addForm($data){
			$this->db->insert('form_master', $data);
			return $this->db->insert_id();
		}
		public function addComment($data){
			return $this->db->insert('form_comments', $data);
		}
	    public function getAllForms(){
	        $query = $this->db->get('form_master');
			return $query->result_array();
	    }
	    public function getAllFormComment($key){
	        $tmp = array('id' => $key);
	        $query = $this->db->get_where('form_comments', $tmp);
			return $query->result_array();
	    }
	    public function getForm($key){
	        $tmp = array('id' => $key);
	        $query = $this->db->get_where('form_master', $tmp);
	        return $query->row();
	    }
	    public function getCompanyForm($key){
	        $tmp = array('company_id' => $key);
	        $query = $this->db->get_where('form_master', $tmp);
	        return $query->row();
	    }
	    public function editForm($data,$id){
			$this->db->where('id', $id);
			return $this->db->update('form_master', $data);
		}
	}

