<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('setting_model');
        $this->load->model('question_model');
        $this->load->model('company_model');
        $this->load->model('form_model');
        $this->load->model('ubo_model');
    }
	public function index(){
		$data['ERR']  	= '';
		$data['IRES'] 	= $this->setting_model->getAllIndustry();
		$data['CRES'] 	= $this->setting_model->getAllCountry();
		$data['RRES'] 	= $this->setting_model->getAllRegion();
		$data['RES'] 	= $this->setting_model->getAllChannel();
		$data['QCRES'] 	= $this->question_model->getAllCats();
		if($this->session->ERR!=''){
			$data['ERR'] = $this->session->ERR;
			$session_data = array('ERR' => '');
			$this->session->set_userdata($session_data);
		}
		$this->load->view('front/form', $data);
	}
	public function form2(){
		$data['ERR']  	= '';
		$data['IRES'] 	= $this->setting_model->getAllIndustry();
		$data['CRES'] 	= $this->setting_model->getAllCountry();
		$data['RRES'] 	= $this->setting_model->getAllRegion();
		$data['RES'] 	= $this->setting_model->getAllChannel();
		$data['QCRES'] 	= $this->question_model->getAllCats();
		if($this->session->ERR!=''){
			$data['ERR'] = $this->session->ERR;
			$session_data = array('ERR' => '');
			$this->session->set_userdata($session_data);
		}
		$this->load->view('front/form1', $data);
	}
	public function thankyou(){
		$CID = $this->session->CID;
		$session_data = array('CID' => '');
		$this->session->set_userdata($session_data);
		$data['CID'] = md5($CID);
		$data['ERR']  	= '';
		if($this->session->ERR!=''){
			$data['ERR'] = $this->session->ERR;
			$session_data = array('ERR' => '');
			$this->session->set_userdata($session_data);
		}
		$this->load->view('front/thankyou',$data);
	}
	public function validateForm(){
		$secret = '6Lc6OfcUAAAAAEgP3sGMxdXaRmvocUWSPXVEpslr';
		$response = $this->input->post('g-recaptcha-response');
		$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$response);
		$responseData = json_decode($verifyResponse);
		if(!$responseData->success){
			$session_data = array('ERR' => 'Please verify that you are not a robot');
            $this->session->set_userdata($session_data);
            redirect('/form', 'refresh');
		}
		$config = array(
			'protocol' => 'mail',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);
		$this->email->initialize($config);
		$this->email->from('support@suport.com', 'Support Team');
		$this->email->to('support@mailinator.com');
		/* General Items */
		$ANS_DATA = $UBO_DATA = '';
		$score=0;
		$RDT = date("Y-m-d");
		$DT  = date("d/m/Y");
		$TM  = date("g:i:s A");
		$IP  = $_SERVER['REMOTE_ADDR'];
		$PG  = $_SERVER['PHP_SELF'];
		/* Company Details */
		$CD1 = ucwords(strtolower($this->input->post('CD1',TRUE)));
		$CD2 = strtolower($this->input->post('CD2',TRUE));
		$CD3 = date("Y-m-d", strtotime($this->input->post('CD3',TRUE)));
		$CD4 = $this->input->post('CD4',TRUE);
		$CD5 = (int)$this->input->post('CD5',TRUE);
		$TMP = $this->setting_model->getRegion($CD5);
		$ORNM = $TMP->region_name;
		$CUD = (int)$this->input->post('CUD',TRUE);
		$data = array(
			'company_name' 		=> $CD1, 
			'company_www'		=> $CD2, 
			'reg_dt' 			=> $CD3,  
			'reg_country' 		=> $CD4, 
			'oper_region' 		=> $CD5, 
			'noc' 				=> $CUD
		);
		$CID = $this->company_model->addCompany($data);
		/* Form Details */
		$FD1_1 = ucwords(strtolower($this->input->post('FD1_1',TRUE)));
		$FD1_2 = ucwords(strtolower($this->input->post('FD1_2',TRUE)));
		$FD2 = strtolower($this->input->post('FD2',TRUE));
		$FD3 = (int)$this->input->post('FD3_1',TRUE).(int)$this->input->post('FD3',TRUE);
		$FD4 = ucwords(strtolower($this->input->post('FD4',TRUE)));
		$FD5 = (int)$this->input->post('FD5',TRUE);
		$TMP = $this->setting_model->getChannel($FD5);
		$CHNM = $TMP->name;
		$data = array(
			'company_id' 	=> $CID, 
			'channel_id' 	=> $FD5, 
			'form_name'		=> $FD1_1,
			'form_surname'	=> $FD1_2,
			'form_phone' 	=> $FD3, 
			'form_email' 	=> $FD2,  
			'form_desig' 	=> $FD4,  
			'rdt' 			=> $RDT
		);
		$FID = $this->form_model->addForm($data);
		/* UBO Details */
		$UBO1 = $this->input->post('ubo1',TRUE);
		$UBO2 = $this->input->post('ubo2',TRUE);
		$UBO3 = $this->input->post('ubo3',TRUE);
		$temp="";
		$UBONAT = $UBORES = 0;
		$UBOARR = array();
		for($i=0;$i<count($UBO1);$i++) {
			$U1 = $UBO1[$i];
			$U2 = $UBO2[$i];
			$U3 = $UBO3[$i];
			$RSCO = $this->setting_model->getCountryByIso3($U2);
			$UBONAT += $RSCO->pmxscore;
			$RSCO = $this->setting_model->getCountryByIso3($U3);
			$UBORES += $RSCO->pmxscore;
			$data = array(
				'company_id' 		=> $CID,
				'ubo_nationality1' 	=> $U2,
				'addr_country' 		=> $U3,
				'ubo_share' 		=> $U1
			);
			array_push($UBOARR,$data);
			$UBOID = $this->ubo_model->addUbo($data);
			$UBO_DATA .='
				<strong>UBO '.($i+1).' Details</strong><br />
				<strong>Share: </strong>'.$U1.'<br />
				<strong>Nationality (ISO3): </strong>'.$U2.'<br />
				<strong>Residence (ISO3): </strong>'.$U3.'<br />
			';
		}
		$UBORES = $UBORES/count($UBO1);
		$UBONAT = $UBONAT/count($UBO1);
		$QCRES = $this->question_model->getAllCats();
		$QUESTARR = array();
		foreach($QCRES as $QC){
			$CATID = $QC['category_id'];
			$CATNM = $QC['name'];
			$ANS_DATA .= '<strong>'.$CATNM.'</strong><br />';
			$QRES = $this->question_model->getQuestCats($CATID);
			foreach ($QRES as $QR) {
				$MK = $QR['title'];
				$QID = $QR['question_id'];
				$ANS_DATA .= '<strong>'.$MK.'</strong><br />';
				for($Z=0;$Z<$QR['has_multiple'];$Z++){
					switch($QR['quest_type']){
						case 3:
						case 6:
							$MV = $this->input->post($QC['id'].$QR['question_id'].$Z,TRUE);
							if($MV=='') $MV='N';
							break;
						case 5:
							$MV = '';
							$ANS = $this->input->post($QC['id'].$QR['question_id'].$Z,TRUE);
							for($i=0;$i<count($ANS);$i++) {
								$MV .=$ANS[$i].' ';
							}
							break;
						default:
							$MV = $this->input->post($QC['id'].$QR['question_id'].$Z,TRUE);
							break;
					}
					if($MV!=''){
						if($QR['has_multiple'] > 1){
							$data = array(
								'company_id' 	=> $CID,
								'category_id' 	=> $CATID,
								'question_id' 	=> $QID,
								'category_name' => $CATNM,
								'meta_key' 		=> '',
								'meta_value' 	=> $MV
							);
						}else{
							$data = array(
								'company_id' 	=> $CID,
								'category_id' 	=> $CATID,
								'question_id' 	=> $QID,
								'category_name' => $CATNM,
								'meta_key' 		=> $MK,
								'meta_value' 	=> $MV
							);
						}
					}
					$T = $this->question_model->addAns($data);
					array_push($QUESTARR,$data);
					$ANS_DATA .= '<strong>'.$MV.'</strong><br />';
				}
			}
		}
		/* Calculate Score */
		#1
		$RSCO = $this->setting_model->getCountryByIso3($CD4);
		$score += 0.05*$RSCO->pmxscore;
		#2
		$MV = '';
		$ANS  = $this->question_model->getCompanyAns($CID,3);
		foreach ($ANS as $A) {$MV = $A['meta_value'];}
		$RSCO = $this->setting_model->getCountryByIso3($MV);
		$score += 0.07*$RSCO->pmxscore;
		#3
		$RSCO = $this->setting_model->getRegion($CD5);
		$score += 0.08*$RSCO->pmxscore;
		#4
		$i=$PMX = 0;
		$MV = '';
		$ANS  = $this->question_model->getCompanyAns($CID,15);
		foreach ($ANS as $A) {
			$MV = $A['meta_value'];
			if($MV != 'N/A'){
				$RSCO = $this->setting_model->getCountryByIso3($MV);
				if($PMX<$RSCO->pmxscore)
					$PMX = $RSCO->pmxscore;
			}
			$i++;
		}
		$score += 0.05*$PMX;
		#5
		$i=$PMX = 0;
		$MV = '';
		$ANS  = $this->question_model->getCompanyAns($CID,18);
		foreach ($ANS as $A) {
			$MV = $A['meta_value'];
			if($MV != 'N/A'){
				$RSCO = $this->setting_model->getCountryByIso3($MV);
				if($PMX<$RSCO->pmxscore)
					$PMX = $RSCO->pmxscore;
			}
			$i++;
		}
		$score += 0.05*$PMX;
		#6
		$MV = '';
		$ANS  = $this->question_model->getCompanyAns($CID,1);
		foreach ($ANS as $A) {$MV = $A['meta_value'];}
		$RSCO = $this->setting_model->getIndustry($MV);
		$score += 0.25*$RSCO->pmxscore;
		#7
		$MV = '';
		$ANS  = $this->question_model->getCompanyAns($CID,4);
		foreach ($ANS as $A) {$MV = $A['meta_value'];}
		if($MV=='Y') $score -= 0.25*2;
		#8
		$date1 = $CD3;
		$diff = abs(strtotime($RDT) - strtotime($date1));
		$MV = floor($diff / (365*60*60*24));
		if($MV<1){
			$PMXSCORE = 8;
		}else if($MV <5){
			$PMXSCORE = 6;
		}else if($MV <10){
			$PMXSCORE = 6;
		}else if($MV <15){
			$PMXSCORE = 4;
		}else{
			$PMXSCORE = 2;
		}
		$score += 0.04*$PMXSCORE;
		#9
		$MV = '';
		$ANS  = $this->question_model->getCompanyAns($CID,10);
		foreach ($ANS as $A) {$MV = $A['meta_value'];}
		if($MV<1000000){
			$PMXSCORE = 8;
		}else if($MV<5000000){
			$PMXSCORE = 6;
		}else if($MV<50000000){
			$PMXSCORE = 4;
		}else{
			$PMXSCORE = 4;
		}
		$score += 0.03*$PMXSCORE;
		#10
		$MV = '';
		$ANS  = $this->question_model->getCompanyAns($CID,8);
		foreach ($ANS as $A) {$MV = $A['meta_value'];}
		if($MV<1000000){
			$PMXSCORE = 4;
		}else if($MV<5000000){
			$PMXSCORE = 4;
		}else if($MV<50000000){
			$PMXSCORE = 6;
		}else{
			$PMXSCORE = 8;
		}
		$score += 0.03*$PMXSCORE;
		#11
		$PMXSCORE = ($CUD == 1 ? 6 : 8);
		$score += 0.08*$PMXSCORE;
		#12
		$score += 0.05*$UBONAT;
		#13
		$score += 0.07*$UBORES;
		#14
		$RSCO = $this->setting_model->getChannel($FD5);
		$score += 0.15*$RSCO->pmxscore;
		$data = array('score' => $score);
		$this->company_model->editCompany($data,$CID);
		/* End */
		if($score > 8)
			$SCR = '<span style="color:#b71c1c;font-weight:bold">'.$score.'</span>';
		elseif($score > 7)
			$SCR = '<span style="color:#f44336;font-weight:bold">'.$score.'</span>';
		elseif($score > 5)
			$SCR = '<span style="color:#ffd740;font-weight:bold">'.$score.'</span>';
		else
			$SCR = '<span style="color:#1b5e20;font-weight:bold">'.$score.'</span>';
		$EML_ADMIN_DATA = "The following data was submitted on ".$DT." at ".$TM." from the ip: ".$IP.'<br />';
		$EML_ADMIN_DATA .= 'Risk Score is '.$SCR.'<br />';
		$EML_DATA  = '
			<strong>Company Details</strong><br />
			<strong>Name: </strong>'.$CD1.'<br />
			<strong>Website: </strong>'.$CD2.'<br />
			<strong>Registered on: </strong>'.$this->input->post('CD3',TRUE).'<br />
			<strong>Registered In(ISO3): </strong>'.$CD4.'<br />
			<strong>Operation Region: </strong>'.$ORNM.'<br /><hr />
			<strong>Shareholder(s) & Ultimate Beneficial Owners(UBO)</strong><br />
			<strong>Number of companies nested as shareholder: </strong>'.$CUD.'<br />
			'.$UBO_DATA.'<hr />
			'.$ANS_DATA.'<hr />
			<strong>Form Details</strong><br />
			<strong>Name: </strong>'.$FD1_1.' '.$FD1_2.'<br />
			<strong>Email: </strong>'.$FD2.'<br />
			<strong>Phone: </strong>+'.$FD3.'<br />
			<strong>Job Title: </strong>'.$FD4.'<br />
			<strong>How heard about us?: </strong>'.$CHNM.'<br />
		';
		$this->email->subject($CD1.' - Profile Form');
		$this->email->message($EML_ADMIN_DATA.$EML_DATA);
		$this->email->send();
		$EML_USER_DATA = 'Dear '.$FD1_1.',<br /> we have received the below information and are reviewing it.<br /><br />';
		$EML_USER_DATA .= $EML_DATA;
		$EML_USER_DATA .= '<br />Regards,<br />Support Team';
		$this->email->from('no-reply@support.com', 'Support Team');
		$this->email->to($FD2);
		$this->email->subject('Account Opening');
		$this->email->message($EML_USER_DATA);
		$this->email->send();
		$session_data = array('CID' => $CID);
		$this->session->set_userdata($session_data);
		if ($FD4 == 'Director')	$DESIG=55;
		if ($FD4 == 'Shareholder')	$DESIG=45;
		if ($FD4 == 'Employee')	$DESIG=44;
		if ($FD4 == 'Consultant')	$DESIG=56;
		$JSONDATA=array(
			'company_name' 		=> $CD1, 
			'company_www'		=> $CD2, 
			'reg_dt' 			=> $CD3,  
			'reg_country' 		=> $CD4, 
			'oper_region' 		=> $CD5, 
			'noc' 				=> $CUD,
			'FORMINF' 			=> array(
				'company_id' 	=> $CID, 
				'channel_id' 		=> $FD5, 
				'form_name'			=> $FD1_1,
				'form_surname'		=> $FD1_2,
				'form_phone' 		=> $FD3, 
				'form_email' 		=> $FD2,  
				'form_desig' 		=> $DESIG,  
				'rdt' 				=> $RDT
			),
			'UBOINF'			=> $UBOARR,
			'QUESTIONS'			=> $QUESTARR,
			'risk_score'		=> $score
		);
		$json = json_encode($JSONDATA);
		/*$url = '';
        $ch = curl_init($url);   
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = str_replace('"','',$result);
        if($result=='Success'){
        	$data = array(
				'isSent' 		=> 1
			);
			$this->company_model->editCompany($data,$CID);
        }else{
        	$session_data = array('ERR' => $result);
            $this->session->set_userdata($session_data);
        }*/
		redirect('/form/thankyou', 'refresh');
	}
}