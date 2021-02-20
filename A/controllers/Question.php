<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('question_model');
    }
	public function index(){
		$this->session->unset_userdata('SORT_DATA');
		redirect('question/lists');
	}
	public function lists(){

		$data['QRES'] = $this->question_model->getAllQuest();
		$data['CRES'] = $this->question_model->getAllCats();
		$data['ERR'] = '';
		if($this->session->ERR!=''){
			$data['ERR'] = $this->session->ERR;
			$session_data = array('ERR' => '');
			$this->session->set_userdata($session_data);
		}
		$this->load->view('back/question/list', $data);
	}
	public function category(){
		$data['CRES'] = $this->question_model->getAllCats();
		$data['ERR'] = '';
		if($this->session->ERR!=''){
			$data['ERR'] = $this->session->ERR;
			$session_data = array('ERR' => '');
			$this->session->set_userdata($session_data);
		}
		$this->load->view('back/question/category', $data);
	}
	public function validCat(){
		$cnm = $this->input->post('cat_name',TRUE);
    	$pos = (int)$this->input->post('cat_pos',TRUE);
		$data = array(
			'name' => $cnm,
			'position' => $pos
		);
		$res = $this->question_model->addCat($data);
		$session_data = array('ERR' => 'Category added');
		$this->session->set_userdata($session_data);
		redirect('question/category');
	}
	public function validQuest(){
		$cid  = (int)$this->input->post('category_id',TRUE);
    	$tit  = $this->input->post('title',TRUE);
    	$inf  = $this->input->post('info',TRUE);
    	$typ  = (int)$this->input->post('quest_type',TRUE);
    	$opt  = $this->input->post('opt',TRUE);
    	$pos  = (int)$this->input->post('pos',TRUE);
    	$isr  = (int)$this->input->post('isrequired',TRUE);
    	$iss  = (int)$this->input->post('isscore',TRUE);
		$ism  = (int)$this->input->post('qty',TRUE);
		$data = array(
			'category_id' 	=> $cid, 
			'title' 		=> $tit,
			'quest_desc' 	=> $inf,
			'quest_type' 	=> $typ,
			'quest_opt' 	=> $opt,
			'position' 		=> $pos,
			'isrequired' 	=> $isr,
			'israting'  	=> $iss, 
			'has_multiple' 	=> $ism
		);
		$res = $this->question_model->addQuest($data);
		$session_data = array('ERR' => 'Question added');
		$this->session->set_userdata($session_data);
		redirect('question/lists');
	}
	public function validEdtQuest(){
		$QID  = (int)$this->input->post('question_id',TRUE);
		$cid  = (int)$this->input->post('category_id',TRUE);
    	$tit  = $this->input->post('title',TRUE);
    	$inf  = $this->input->post('info',TRUE);
    	$typ  = (int)$this->input->post('quest_type',TRUE);
    	$opt  = $this->input->post('opt',TRUE);
    	$pos  = (int)$this->input->post('pos',TRUE);
    	$isr  = (int)$this->input->post('isrequired',TRUE);
    	$iss  = (int)$this->input->post('isscore',TRUE);
		$ism  = (int)$this->input->post('qty',TRUE);
		$data = array(
			'category_id' 	=> $cid, 
			'title' 		=> $tit,
			'quest_desc' 	=> $inf,
			'quest_type' 	=> $typ,
			'quest_opt' 	=> $opt,
			'position' 		=> $pos,
			'isrequired' 	=> $isr,
			'israting'  	=> $iss, 
			'has_multiple' 	=> $ism
		);
		$res = $this->question_model->editQuest($data,$QID);
		$session_data = array('ERR' => 'Question updated');
		$this->session->set_userdata($session_data);
		redirect('question/lists');
	}
}