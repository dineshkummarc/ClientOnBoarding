<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('setting_model');
        $this->load->model('question_model');
        $this->load->model('company_model');
    }
    public function index(){
		redirect('admin');
	}
    // User
    public function userEdit(){
    	$uid = (int)$this->input->post('uid',TRUE);
    	$unm = $this->input->post('user_name',TRUE);
    	$eml = $this->input->post('user_email',TRUE);
    	$typ = (int)$this->input->post('user_type',TRUE);
		$data = array(
			'user_email' 	=> $eml,
			'user_name' 	=> $unm, 
			'user_type' 	=> $typ
		);
		$res = $this->user_model->editUser($data,$uid);
		if($typ==1) $USER_TYPE="Admin";elseif($typ==2) $USER_TYPE="Staff"; elseif($typ==4) $USER_TYPE="CSP";else $USER_TYPE="Company";
		echo $USER_TYPE;
	}
	public function userDel(){
    	$uid = (int)$this->input->post('uid',TRUE);
    	$res = $this->user_model->delUser($uid);
	}
	public function savStru(){
    	$cid = (int)$this->input->post('cid',TRUE);
    	$inf = $this->input->post('inf',TRUE);
    	$typ = (int)$this->input->post('typ',TRUE);
    	$data = array(
			'company_id' => $cid,
			'info' => $inf
		);
		if($typ==1)
			$res = $this->company_model->addCompanyStructure($data);
		else
			$res = $this->company_model->editCompanyStructure($data,$cid);
	}
	// Region
    public function regionEdit(){
    	$id = (int)$this->input->post('rid',TRUE);
    	$region_name = $this->input->post('region_name',TRUE);
    	$pmx_score = $this->input->post('pmxscore',TRUE);
		$data = array(
			'region_name' 	=> $region_name,
			'pmxscore' 		=> $pmx_score
		);
		$res = $this->setting_model->editRegion($data,$id);
	}
	public function regionDel(){
    	$id = (int)$this->input->post('rid',TRUE);
    	$res = $this->setting_model->delRegion($id);
	}
	// Channel
    public function channelEdit(){
    	$id = (int)$this->input->post('id',TRUE);
    	$name = $this->input->post('name',TRUE);
    	$pmx_score = $this->input->post('pmxscore',TRUE);
		$data = array(
			'name' 		=> $name,
			'pmxscore' 	=> $pmx_score
		);
		$res = $this->setting_model->editChannel($data,$id);
	}
	public function channelDel(){
    	$id = (int)$this->input->post('id',TRUE);
    	$res = $this->setting_model->delChannel($id);
	}
	// Industry
    public function industryEdit(){
    	$id = (int)$this->input->post('id',TRUE);
    	$name = $this->input->post('name',TRUE);
    	$pmx_score = $this->input->post('pmxscore',TRUE);
		$data = array(
			'industry_name' 		=> $name,
			'pmxscore' 	=> $pmx_score
		);
		$res = $this->setting_model->editIndustry($data,$id);
	}
	public function industryDel(){
    	$id = (int)$this->input->post('id',TRUE);
    	$res = $this->setting_model->delIndustry($id);
	}
	// Country
    public function countryEdit(){
    	$id     = (int)$this->input->post('id',TRUE);
    	$rid 	= (int)$this->input->post('rid',TRUE);
		$iso 	= strtoupper($this->input->post('iso',TRUE));
		$iso3 	= strtoupper($this->input->post('iso3',TRUE));
		$name 	= $this->input->post('name',TRUE);
		$inc 	= $this->input->post('inc',TRUE);
		$com 	= $this->input->post('com',TRUE);
		$pno 	= (int)$this->input->post('pno',TRUE);
    	$pmxscore = $this->input->post('pmxscore',TRUE);
		$data = array(
			'region_id' => $rid,
			'iso' 		=> $iso,
			'iso3'		=> $iso3,
			'name'		=> $name,
			'income'	=> $inc,
			'phonecode'	=> $pno,
			'comments'	=> $com,
			'pmxscore'	=> $pmxscore
		);
		$res = $this->setting_model->editCountry($data,$id);
		$RNM = $this->setting_model->getRegion($rid);
		echo $RNM->region_name;
	}
	public function countryDel(){
    	$id = (int)$this->input->post('id',TRUE);
    	$res = $this->setting_model->delCountry($id);
	}
	// Channel
    public function catEdit(){
    	$id = (int)$this->input->post('id',TRUE);
    	$nm = $this->input->post('cat_name',TRUE);
    	$pos = $this->input->post('cat_pos',TRUE);
		$data = array(
			'name' 		=> $nm,
			'position' 	=> $pos
		);
		$res = $this->question_model->editCat($data,$id);
	}
	public function catDel(){
    	$id = (int)$this->input->post('id',TRUE);
    	$res = $this->question_model->delCat($id);
	}
	public function setSort(){
		$KEY = $this->input->post('sort',TRUE);
		$TMP = $this->session->SORT_DATA;
		if($TMP == ''){
			$TMP = array($KEY => 'ASC');
		}else{
			if (array_key_exists($KEY,$TMP)){
				if($TMP[$KEY]=='ASC')
					$TMP1 = array($KEY => 'DESC');
				else
					$TMP1 = array($KEY => 'ASC');
				$TMP = array_replace($TMP,$TMP1);
			}else{
				$TMP[$KEY] = 'ASC';
			}
		}
		$session_data = array('SORT_DATA' => $TMP);
		$this->session->set_userdata($session_data);
		print_r($TMP);
	}
	public function updateCoStatus(){
		$cid = (int)$this->input->post('cid',TRUE);
    	$typ = (int)$this->input->post('typ',TRUE);
		$data = array(
			'status' 		=> $typ
		);
		$this->company_model->editCompany($data,$cid);
	}
}