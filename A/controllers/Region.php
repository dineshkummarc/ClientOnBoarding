<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Region extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('setting_model');
    }
	public function index(){
		$data['RRES'] = $this->setting_model->getAllRegion();
		$data['ERR'] = '';
		if($this->session->ERR!=''){
			$data['ERR'] = $this->session->ERR;
			$session_data = array('ERR' => '');
			$this->session->set_userdata($session_data);
		}
		$this->load->view('back/setting/region', $data);
	}
	public function validRegion(){
		$region_name = $this->input->post('region_name',TRUE);
    	$pmxscore = $this->input->post('pmxscore',TRUE);
		$data = array(
			'region_name' 	=> $region_name,
			'pmxscore' 		=> $pmxscore
		);
		$res = $this->setting_model->addRegion($data);
		$session_data = array('ERR' => 'Region added');
		$this->session->set_userdata($session_data);
		redirect('region');
	}
}