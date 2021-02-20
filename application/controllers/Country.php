<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('setting_model');
    }
    public function index(){
    	$this->session->unset_userdata('SORT_DATA');
    	redirect('Country/list');
    }
	public function list(){
		/* Search */
		$KEY = $this->input->post('serKey',TRUE);
		$FIL = $this->input->post('filKey',TRUE);
		/* pageing */
		$config['base_url'] 		= base_url().'Country/list';
		$config['total_rows'] 		= $this->setting_model->cntCountry($KEY,$FIL);
		$config['per_page'] 		= 25;
		$config['uri_segment'] 		= 3;
		$config['num_links'] 		= 5;
		$config['full_tag_open'] 	= '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
		$config['full_tag_close'] 	= '</ul></nav>';
		$config['num_tag_open'] 	= '<li class="page-item">';
		$config['num_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] 	= '</span></li>';
		$config['prev_tag_open'] 	= '<li class="page-item">';
		$config['prev_tag_close'] 	= '</li>';
		$config['first_link'] 		= '<i class="fas fa-angle-double-left"></i>';
		$config['first_tag_open'] 	= '<li class="page-item">';
		$config['first_tag_close'] 	= '</li>';
		$config['last_link'] 		= '<i class="fas fa-angle-double-right"></i>';
		$config['last_tag_open'] 	= '<li class="page-item">';
		$config['last_tag_close'] 	= '</li>';
		$config['prev_link'] 		= '<i class="fas fa-angle-left"></i>';
		$config['prev_tag_open'] 	= '<li class="page-item">';
		$config['prev_tag_close'] 	= '</li>';
		$config['next_link'] 		= '<i class="fas fa-angle-right"></i>';
		$config['next_tag_open'] 	= '<li class="page-item">';
		$config['next_tag_close'] 	= '</li>';
		$config['attributes']  		= array('class' => 'page-link');
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->pagination->initialize($config);
		$TMPDATA = $this->session->SORT_DATA;
		$SDATA = '';
		if($TMPDATA!='')
			foreach($TMPDATA as $key => $value){
				if($SDATA=='') $SDATA = $key.' '.$value;
				else $SDATA .=', '.$key.' '.$value;
			}
		$data['PLNK'] = $this->pagination->create_links();
		$data['CRES'] = $this->setting_model->getPgCountry($config['per_page'], $page, $KEY, $SDATA, $FIL);
		$data['RRES'] = $this->setting_model->getAllRegion();
		$data['SDATA'] =$SDATA;
		$data['ERR'] = '';
		if($this->session->ERR!=''){
			$data['ERR'] = $this->session->ERR;
			$session_data = array('ERR' => '');
			$this->session->set_userdata($session_data);
		}
		$this->load->view('back/setting/country', $data);
	}
	public function validCountry(){
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
			'phonecode'	=> $pno,
			'income'	=> $inc,
			'comments'	=> $com,
			'pmxscore'	=> $pmxscore
		);
		$res = $this->setting_model->addCountry($data);
		$session_data = array('ERR' => 'Country added');
		$this->session->set_userdata($session_data);
		redirect('country');
	}
}