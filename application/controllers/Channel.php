<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Channel extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('setting_model');
    }
	public function index(){
		$data['CRES'] = $this->setting_model->getAllChannel();
		$data['ERR'] = '';
		if($this->session->ERR!=''){
			$data['ERR'] = $this->session->ERR;
			$session_data = array('ERR' => '');
			$this->session->set_userdata($session_data);
		}
		$this->load->view('back/setting/channel', $data);
	}
	public function validChannel(){
		$name = $this->input->post('name',TRUE);
    	$pmxscore = $this->input->post('pmxscore',TRUE);
		$data = array(
			'name' 		=> $name,
			'pmxscore' 	=> $pmxscore
		);
		$res = $this->setting_model->addChannel($data);
		$session_data = array('ERR' => 'Channel added');
		$this->session->set_userdata($session_data);
		redirect('channel');
	}
}