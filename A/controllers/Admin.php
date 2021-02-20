<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('setting_model');
        $this->load->model('question_model');
        $this->load->model('company_model');
        $this->load->model('form_model');
        $this->load->model('ubo_model');
        $this->load->helper('file');
    }
	public function index(){
		if($this->session->session_user_id != '') redirect('admin/dashboard');
		$data['ERR'] = '';
		if($this->session->ERR!=''){
			$data['ERR'] = $this->session->ERR;
			$session_data = array('ERR' => '');
			$this->session->set_userdata($session_data);
		}
		$this->load->view('back/login', $data);
	}
	public function dashboard(){
		if($this->session->session_user_id=='') redirect('admin');
		$CRES = $this->company_model->getAllCompany();
		$CSVDATA = "#,Company, Score".chr(10);
		if (count($CRES)!=0){
			$COUNTER=1;
			foreach($CRES as $CR){
				$CSVDATA .=$COUNTER.','.$CR['company_name'].','.$CR['score'].chr(10);
				$COUNTER++;
			}
		}
		if (!write_file('./assets/upload/scores.csv', $CSVDATA)){
			$data['ERR'] = 'Unable to write the file';
		}else{
			$data['ERR'] = 'File written!';
		}
		//$data['CRES'] = $this->company_model->genScoreCos();
		$data['CRES'] = $CRES;
		//$data['ERR'] = '';
		$this->load->view('back/dashboard', $data);
	}
	public function logoff(){
		$this->session->unset_userdata('SORT_DATA');
		$this->session->unset_userdata('session_user_id');
		$this->session->unset_userdata('session_user_type');
		$this->session->unset_userdata('session_name');
		$this->session->unset_userdata('ERR');
		redirect('admin');
	}
	public function validlogin(){
		$username = $this->input->post('user_email',TRUE);
		$password = $this->input->post('user_password',TRUE);
		if($username == '' || $password == ''){
			$session_data = array('ERR' => 'Invalid Login');
			$this->session->set_userdata($session_data);
			redirect('admin');
		}else{
			$userRes = $this->user_model->doLogin($username, md5($password));
			if($userRes->user_email!=''){
				$session_data = array('session_user_id' => $userRes->user_id,'session_user_type' => $userRes->user_type,'session_name' => $userRes->user_name);
				$this->session->set_userdata($session_data);
				redirect('admin/dashboard');	
			}else{
				$session_data = array('ERR' => 'Invalid Login');
				$this->session->set_userdata($session_data);
				redirect('admin');
			}
		}
	}
}