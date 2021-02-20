<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('setting_model');
        $this->load->model('question_model');
        $this->load->model('company_model');
        $this->load->model('form_model');
        $this->load->model('ubo_model');
    }
	public function index(){
        $this->session->unset_userdata('SORT_DATA');
        redirect('Company/new');
	}
    public function printCo(){
        if($this->uri->segment(3)==''){
            redirect('Company');       
        }else{
            $KEY = $this->uri->segment(3);
            $CROW = $this->company_model->getCompany($KEY);
            $FROW = $this->form_model->getCompanyForm($KEY);
            $URES = $this->ubo_model->getAllUbo($KEY);
            $QCRES = $this->question_model->getAllCats();
            $UBONAT = $UBORES = 0;
            foreach($URES as $UR){
                $TEMP = $this->setting_model->getCountryByIso3($UR['ubo_nationality1']);
                $UBONAT += $TEMP->pmxscore;
                $TEMP = $this->setting_model->getCountryByIso3($UR['addr_country']);
                $UBORES += $TEMP->pmxscore;
            }
            if($CROW->score > 7)
                $SCRSTY = '#ef5350';
            elseif($CROW->score > 5)
                $SCRSTY = '#fff176';
            else
                $SCRSTY = '#8bc34a';
            $DATA = '
                <table cellspacing="1" cellpadding="5" border="0" style="border:2px solid #bdbdbd;">
                    <tr>
                        <td style="vertical-align: bottom;" width="140">
                            <strong>&nbsp;</strong>
                            <h2>Corporate Name: </h2>
                        </td>
                        <td style="vertical-align: bottom;" width="360">
                            <strong>&nbsp;</strong>
                            <h2>'.$CROW->company_name.'</h2>
                        </td>
                        <td style="background-color:'.$SCRSTY.';" align="center" width="100">
                            <strong>Risk Score</strong>
                            <h2 align="right" style="margin-right:30px;">'.$CROW->score.'</h2>
                        </td>
                    </tr>
                </table><br /><br />
                <table cellspacing="1" cellpadding="5" border="0" style="font-size:12px;">
                    <tr>
                        <td width="200" style="background-color:#bdbdbd;color:#fff;">Risk Factor</td>
                        <td width="250" style="background-color:#bdbdbd;color:#fff;">Value</td>
                        <td width="75" style="background-color:#bdbdbd;color:#fff;" align="center">Score</td>
                        <td width="75" style="background-color:#bdbdbd;color:#fff;" align="center">Weight</td>
                    </tr>
                </table><h3>Company</h3><br />
                <table cellspacing="1" cellpadding="5" border="0" style="font-size:11px;border:2px solid #bdbdbd;">
            ';
            $TEMP = $this->setting_model->getCountryByIso3($CROW->reg_country);
            $DATA .= '
                <tr>
                    <td width="200"><strong>Registered</strong></td>
                    <td width="250">'.ucwords(strtolower($TEMP->name)).'</td>
                    <td width="75" align="right">'.$TEMP->pmxscore.'</td>
                    <td width="75" style="border-left:2px solid #bdbdbd;" align="center">5%</td>
                </tr>
            ';
            $MV = '';
            $ANS  = $this->question_model->getCompanyAns($CROW->company_id,3);
            foreach ($ANS as $A) {$MV = $A['meta_value'];}
            $TEMP = $this->setting_model->getCountryByIso3($MV);
            $DATA .= '
                <tr>
                    <td><strong>Managed</strong></td>
                    <td>'.ucwords(strtolower($TEMP->name)).'</td>
                    <td align="right">'.$TEMP->pmxscore.'</td>
                    <td style="border-left:2px solid #bdbdbd;" align="center">7%</td>
                </tr>
            ';
            $TEMP = $this->setting_model->getRegion($CROW->oper_region);
            $DATA .= '
                <tr>
                    <td><strong>Operating(Region)</strong></td>
                    <td>'.ucwords(strtolower($TEMP->region_name)).'</td>
                    <td align="right">'.$TEMP->pmxscore.'</td>
                    <td style="border-left:2px solid #bdbdbd;" align="center">8%</td>
                </tr>
            ';
            $i=0;
            $MV='';
            $ANS  = $this->question_model->getCompanyAns($CROW->company_id,15);
            foreach ($ANS as $A) {
                $VAL[$i] = $MV = $A['meta_value'];
                if($MV != 'N/A'){
                    $TEMP = $this->setting_model->getCountryByIso3($MV);
                    $S[$i] = $TEMP->pmxscore;
                    $VAL[$i] = ucwords(strtolower($TEMP->name));
                }else{
                    $S[$i] = number_format(0,2);
                }
                $i++;
            }
            $DATA .= '
                <tr>
                    <td rowspan="3"><strong>Top 3 Countries To receive</strong></td>
                    <td>'.$VAL[0].'</td>
                    <td align="right">'.$S[0].'</td>
                    <td style="border-left:2px solid #bdbdbd;" align="center" rowspan="3">5%</td>
                </tr><tr>
                    <td>'.$VAL[1].'</td>
                    <td align="right">'.$S[1].'</td>
                </tr><tr>
                    <td>'.$VAL[2].'</td>
                    <td align="right">'.$S[2].'</td>
                </tr>
            ';
            $i=0;
            $ANS  = $this->question_model->getCompanyAns($CROW->company_id,18);
            foreach ($ANS as $A) {
                $VAL[$i] = $MV = $A['meta_value'];
                if($MV != 'N/A'){
                    $TEMP = $this->setting_model->getCountryByIso3($MV);
                    $S[$i] = $TEMP->pmxscore;
                    $VAL[$i] = ucwords(strtolower($TEMP->name));
                }else{
                    $S[$i] = number_format(0,2);
                }
                $i++;
            }
            $DATA .= '
                <tr>
                    <td rowspan="3"><strong>Top 3 Countries To pay</strong></td>
                    <td>'.$VAL[0].'</td>
                    <td align="right">'.$S[0].'</td>
                    <td style="border-left:2px solid #bdbdbd;" align="center" rowspan="3">5%</td>
                </tr><tr>
                    <td>'.$VAL[1].'</td>
                    <td align="right">'.$S[1].'</td>
                </tr><tr>
                    <td>'.$VAL[2].'</td>
                    <td align="right">'.$S[2].'</td>
                </tr>
            ';
            $MV = '';
            $ANS  = $this->question_model->getCompanyAns($CROW->company_id,1);
            foreach ($ANS as $A) {$MV = $A['meta_value'];}
            $TEMP = $this->setting_model->getIndustry($MV);
            $DATA .= '
                <tr>
                    <td><strong>Business Sector</strong></td>
                    <td>'.ucwords(strtolower($TEMP->industry_name)).'</td>
                    <td align="right">'.$TEMP->pmxscore.'</td>
                    <td style="border-left:2px solid #bdbdbd;" align="center">25%</td>
                </tr>
            ';
            $MV = '';
            $ANS  = $this->question_model->getCompanyAns($CROW->company_id,4);
            foreach ($ANS as $A) {$MV = $A['meta_value'];}
            $DATA .= '
                <tr>
                    <td><strong>Licensable?</strong></td>
                    <td>'.($MV == 'Y' ? "Yes" : "No").'</td>
                    <td align="right">'.($MV == 'Y' ? "-2" : "").'</td>
                    <td style="border-left:2px solid #bdbdbd;" align="center"></td>
                </tr>
            ';
            $date1 = $CROW->reg_dt;
            $date2 = date("Y-m-d");
            $diff = abs(strtotime($date2) - strtotime($date1));
            $MV = floor($diff / (365*60*60*24));
            if($MV<1){$PMXSCORE = 8;}else if($MV <5){$PMXSCORE = 6;}else if($MV <10){$PMXSCORE = 6;}else if($MV <15){$PMXSCORE = 4;}else{$PMXSCORE = 2;}
            $DATA .= '
                <tr>
                    <td><strong>Corporate Age (years)</strong></td>
                    <td>'.$MV.'</td>
                    <td align="right">'.number_format($PMXSCORE,2).'</td>
                    <td style="border-left:2px solid #bdbdbd;" align="center">4%</td>
                </tr>
            ';
            $MV = '';
            $ANS  = $this->question_model->getCompanyAns($CROW->company_id,10);
            foreach ($ANS as $A) {$MV = $A['meta_value'];}
            if($MV<1000000){$PMXSCORE = 8;}else if($MV<5000000){$PMXSCORE = 6;}else if($MV<50000000){$PMXSCORE = 4;}else{$PMXSCORE = 4;}
            $DATA .= '
                <tr>
                    <td><strong>Asset Size</strong></td>
                    <td>&euro;'.number_format($MV,2).'</td>
                    <td align="right">'.number_format($PMXSCORE,2).'</td>
                    <td style="border-left:2px solid #bdbdbd;" align="center">3%</td>
                </tr>
            ';
            $MV = '';
            $ANS  = $this->question_model->getCompanyAns($CROW->company_id,8);
            foreach ($ANS as $A) {$MV = $A['meta_value'];}
            if($MV<1000000){$PMXSCORE = 4;}else if($MV<5000000){$PMXSCORE = 4;}else if($MV<50000000){$PMXSCORE = 6;}else{$PMXSCORE = 8;}
            $DATA .= '
                <tr>
                    <td><strong>Turnover</strong></td>
                    <td>&euro;'.number_format($MV,2).'</td>
                    <td align="right">'.number_format($PMXSCORE,2).'</td>
                    <td style="border-left:2px solid #bdbdbd;" align="center">3%</td>
                </tr>
            ';
            $DATA .= '</table><h3>UBO</h3><br /><table cellspacing="1" cellpadding="5" border="0" style="font-size:11px;border:2px solid #bdbdbd;">';
            $PMXSCORE = ($CROW->noc == 1 ? 6 : 8);
            $DATA .= '
                <tr>
                    <td width="450"><strong>Corporate Structure</strong></td>
                    <td width="75" align="right">'.number_format($PMXSCORE,2).'</td>
                    <td width="75" style="border-left:2px solid #bdbdbd;" align="center">8%</td>
                </tr><tr>
                    <td width="450"><strong>Nationality Weighted Average Score</strong></td>
                    <td width="75" align="right">'.number_format($UBONAT,2).'</td>
                    <td width="75" style="border-left:2px solid #bdbdbd;" align="center">5%</td>
                </tr><tr>
                    <td width="450"><strong>Residencey Weighted Average Score</strong></td>
                    <td width="75" align="right">'.number_format($UBORES,2).'</td>
                    <td width="75" style="border-left:2px solid #bdbdbd;" align="center">7%</td>
                </tr>
            ';
            $DATA .= '</table><h3>Channel</h3><br /><table cellspacing="1" cellpadding="5" border="0" style="font-size:11px;border:2px solid #bdbdbd;">';
            $TEMP = $this->setting_model->getChannel($FROW->channel_id);
            $DATA .= '
                <tr>
                    <td width="200"><strong>Introduced By</strong></td>
                    <td width="250">'.$TEMP->name.'</td>
                    <td width="75" align="right">'.$TEMP->pmxscore.'</td>
                    <td width="75" style="border-left:2px solid #bdbdbd;" align="center">8%</td>
                </tr>
            ';
            $DATA .= '</table>';
            $data1 = '
                <h3>Company Details</h3><br />
                <table cellspacing="1" cellpadding="5" border="" style="font-size:11px;border:2px solid #bdbdbd;">
                    <tr><th width="150"><strong>Name: </strong></th><td width="450">'.$CROW->company_name.'</td></tr>
                    <tr><th><strong>Website: </strong></th><td>'.$CROW->company_www.'</td></tr>
                    <tr><th><strong>Date of Registration: </strong></th><td>'.date("d-m-Y", strtotime($CROW->reg_dt)).'</td></tr>
            ';
            $TEMP = $this->setting_model->getCountryByIso3($CROW->reg_country);
            $data1 .= '<tr><th><strong>Registered In: </strong></th><td>'.ucwords(strtolower($TEMP->name)).'</td></tr>';
            $TEMP = $this->setting_model->getRegion($CROW->oper_region);
            $data1 .= '
                    <tr><th><strong>Operation Region: </strong></th><td>'.ucwords(strtolower($TEMP->region_name)).'</td></tr>
                </table>
                <h3>UBO Details</h3><br />
                <table cellspacing="1" cellpadding="5" border="" style="font-size:11px;border:2px solid #bdbdbd;">
                    <tr><th colspan="2"><strong>Number of companies nested as shareholder:</strong>'.$CROW->noc.'</th></tr> 
            ';
            $i=1;foreach($URES as $UR){
                $TEMP1 = $this->setting_model->getCountryByIso3($UR['ubo_nationality1']);
                $TEMP2 = $this->setting_model->getCountryByIso3($UR['addr_country']);
                if(count($URES)>1){
                    $data1 .= '<tr><th colspan="2"><strong>UBO - '.$i.'</strong></th></tr>';
                }
                $data1 .= '
                    <tr><th width="150"><strong>Share: </strong></th><td width="450">'.$UR['ubo_share'].'</td></tr>
                    <tr><th><strong>Nationaity: </strong></th><td>'.ucwords(strtolower($TEMP1->name)).'</td></tr>
                    <tr><th><strong>Residence: </strong></th><td>'.ucwords(strtolower($TEMP2->name)).'</td></tr>
                ';
            }
            $data1 .= '
                </table>
                <h3>Form Details</h3><br />
                <table cellspacing="1" cellpadding="5" border="" style="font-size:11px;border:2px solid #bdbdbd;">
            ';
            $TEMP = $this->setting_model->getChannel($FROW->channel_id);
            $data1 .= '
                    <tr><th width="150"><strong>Source: </strong></th><td width="450">'.$TEMP->name.'</td></tr>
                    <tr><th><strong>Name: </strong></th><td>'.$FROW->form_name.' '.$FROW->form_surname.'</td></tr>
                    <tr><th><strong>Phone:</strong></th><td>'.$FROW->form_phone.'</td></tr>
                    <tr><th><strong>Email:</strong></th><td>'.$FROW->form_email.'</td></tr>
                    <tr><th><strong>Designation/Job Role: </strong></th><td>'.$FROW->form_desig.'</td></tr>
                    <tr><th><strong>Submitted on:</strong></th><td>'.date("d-m-Y", strtotime($FROW->rdt)).'</td></tr>
                </table>
            ';
            foreach($QCRES as $QC){
                $data1 .= '<h3>'.$QC['name'].'</h3><br />';
                $QRES = $this->question_model->getQuestCats($QC['category_id']);
                $data1 .='<table cellspacing="1" cellpadding="5" border="" style="font-size:11px;border:2px solid #bdbdbd;">';
                foreach ($QRES as $QR) {
                    if ($QR['quest_type']==4 || $QR['has_multiple']>1){
                        $data1 .='<tr><th width="600"><strong>'.$QR['title'].'</strong></th></tr><tr><td>';
                    }else{
                        $data1 .='<tr><th width="300"><strong>'.$QR['title'].'</strong></th><td width="300">';
                    }
                    $TEMP = $this->question_model->getCompanyAns($CROW->company_id,$QR['question_id']);
                    $i=1;
                    foreach($TEMP as $T){
                        if($QR['quest_type']==8){
                            $TT = $this->setting_model->getCountryByIso3($T['meta_value']);
                            $data1 .=ucwords(strtolower($TT->name));
                        }else if($QR['quest_type']==10){
                            $TT = $this->setting_model->getIndustry($T['meta_value']);
                            $data1 .=$TT->industry_name;
                        }else{
                            $data1 .=$T['meta_value'];
                        }
                        if(count($TEMP)!=$i)
                            $data1 .=', ';
                        $i++;
                    }
                    $data1 .='</td></tr>';
                }
                $data1 .='</table>';
            }
            $PDFFile = str_replace(' ', '-', strtolower(trim($CROW->company_name))).'.pdf';
            $this->createPDF(ROOT_FILE_PATH.$PDFFile, $DATA, $data1);
            redirect(base_url().'assets/upload/'. $PDFFile);
        }
    }
    public function createPDF($fileName,$html,$html1) {
        ob_start(); 
        $this->load->library('Pdf');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Michael Alvares');
        $pdf->SetTitle('Company Profile & Risk Score');
        $pdf->SetSubject('Company Profile & Risk Score');
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('helvetica', '', 8);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, false, false, '');
        $pdf->AddPage();
        $pdf->writeHTML($html1, true, false, false, false, '');
        ob_end_clean();
        $pdf->Output($fileName, 'F');        
    }
    public function viewCo(){
        if($this->uri->segment(3)==''){
            redirect('Company');       
        }else{
            $KEY = $this->uri->segment(3);
            $data['CROW'] = $this->company_model->getCompany($KEY);
            $data['FROW'] = $this->form_model->getCompanyForm($KEY);
            $data['URES'] = $this->ubo_model->getAllUbo($KEY);
            $data['CRES'] = $this->setting_model->getAllCountry();
            $data['RRES'] = $this->setting_model->getAllRegion();
            $data['SROW'] = $this->company_model->getCompanyStructure($KEY);
            $data['QCRES']  = $this->question_model->getAllCats();
            $data['ERR'] = '';
            if($this->session->ERR!=''){
                $data['ERR'] = $this->session->ERR;
                $session_data = array('ERR' => '');
                $this->session->set_userdata($session_data);
            }
            $this->load->view('back/company/viewCo', $data);
        }
    }
    public function sendEmail(){
        $config = array(
            'protocol' => 'mail',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $session_data = array('ERR' => 'Email Sent.');
        $this->session->set_userdata($session_data);
        $CID = (int)$this->input->post('cid',TRUE);
        $TYP = (int)$this->input->post('typ',TRUE);
        $FROW = $this->form_model->getCompanyForm($CID);
        $EML_DATA ='Hello '.$FROW->form_name.', <br />';
        $EML_DATA .='We require some more information from you. Could you please fill out the form by following this link: <br />';
        if($TYP==1)
            $EML_DATA .='<a href="'.base_url().'Form/updateInfo/'.md5($CID).'">'.base_url().'Form/updateInfo/'.md5($CID).'</a>';
        $EML_DATA .= '<br />Regards,<br />Support Team';
        $this->email->initialize($config);
        $this->email->from('support@support.com', 'Support');
        $this->email->to($FROW->form_email);
        $this->email->subject("Account Update");
        $this->email->message($EML_DATA);
        $this->email->send();
        redirect('/Company/viewCo/'.$CID, 'refresh');
    }
    public function new(){
        $KEY = $this->input->post('serKey',TRUE);
        $config['base_url']         = base_url().'Company/new/list';
        $config['total_rows']       = $this->company_model->cntCos($KEY,'0');
        $config['per_page']         = 20;
        $config['uri_segment']      = 4;
        $config['num_links']        = 5;
        $config['full_tag_open']    = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '</span></li>';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        $config['first_link']       = '<i class="fas fa-angle-double-left"></i>';
        $config['first_tag_open']   = '<li class="page-item">';
        $config['first_tag_close']  = '</li>';
        $config['last_link']        = '<i class="fas fa-angle-double-right"></i>';
        $config['last_tag_open']    = '<li class="page-item">';
        $config['last_tag_close']   = '</li>';
        $config['prev_link']        = '<i class="fas fa-angle-left"></i>';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '<i class="fas fa-angle-right"></i>';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tag_close']   = '</li>';
        $config['attributes']       = array('class' => 'page-link');
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->pagination->initialize($config);
        $TMPDATA = $this->session->SORT_DATA;
        $SDATA = '';
        if($TMPDATA!='')
            foreach($TMPDATA as $key => $value){
                if($SDATA=='') $SDATA = $key.' '.$value;
                else $SDATA .=', '.$key.' '.$value;
            }
        $data['PLNK'] = $this->pagination->create_links();
        $data['CRES'] = $this->company_model->getPgCos(0,$config['per_page'], $page, $KEY, $SDATA);
        $data['TITLE'] = 'New Requests';
        $data['ERR'] = '';
        if($this->session->ERR!=''){
            $data['ERR'] = $this->session->ERR;
            $session_data = array('ERR' => '');
            $this->session->set_userdata($session_data);
        }
        $this->load->view('back/company/list', $data);
    }
    public function rejected(){
        $KEY = $this->input->post('serKey',TRUE);
        $config['base_url']         = base_url().'Company/new/list';
        $config['total_rows']       = $this->company_model->cntCos($KEY,'4');
        $config['per_page']         = 20;
        $config['uri_segment']      = 4;
        $config['num_links']        = 5;
        $config['full_tag_open']    = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '</span></li>';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        $config['first_link']       = '<i class="fas fa-angle-double-left"></i>';
        $config['first_tag_open']   = '<li class="page-item">';
        $config['first_tag_close']  = '</li>';
        $config['last_link']        = '<i class="fas fa-angle-double-right"></i>';
        $config['last_tag_open']    = '<li class="page-item">';
        $config['last_tag_close']   = '</li>';
        $config['prev_link']        = '<i class="fas fa-angle-left"></i>';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '<i class="fas fa-angle-right"></i>';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tag_close']   = '</li>';
        $config['attributes']       = array('class' => 'page-link');
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->pagination->initialize($config);
        $TMPDATA = $this->session->SORT_DATA;
        $SDATA = '';
        if($TMPDATA!='')
            foreach($TMPDATA as $key => $value){
                if($SDATA=='') $SDATA = $key.' '.$value;
                else $SDATA .=', '.$key.' '.$value;
            }
        $data['PLNK'] = $this->pagination->create_links();
        $data['CRES'] = $this->company_model->getPgCos(4,$config['per_page'], $page, $KEY, $SDATA);
        $data['TITLE'] = 'Rejected';
        $data['ERR'] = '';
        if($this->session->ERR!=''){
            $data['ERR'] = $this->session->ERR;
            $session_data = array('ERR' => '');
            $this->session->set_userdata($session_data);
        }
        $this->load->view('back/company/list', $data);
    }
    public function review(){
        $KEY = $this->input->post('serKey',TRUE);
        $config['base_url']         = base_url().'Company/new/list';
        $config['total_rows']       = $this->company_model->cntCos($KEY,'1');
        $config['per_page']         = 20;
        $config['uri_segment']      = 4;
        $config['num_links']        = 5;
        $config['full_tag_open']    = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '</span></li>';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        $config['first_link']       = '<i class="fas fa-angle-double-left"></i>';
        $config['first_tag_open']   = '<li class="page-item">';
        $config['first_tag_close']  = '</li>';
        $config['last_link']        = '<i class="fas fa-angle-double-right"></i>';
        $config['last_tag_open']    = '<li class="page-item">';
        $config['last_tag_close']   = '</li>';
        $config['prev_link']        = '<i class="fas fa-angle-left"></i>';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '<i class="fas fa-angle-right"></i>';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tag_close']   = '</li>';
        $config['attributes']       = array('class' => 'page-link');
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->pagination->initialize($config);
        $TMPDATA = $this->session->SORT_DATA;
        $SDATA = '';
        if($TMPDATA!='')
            foreach($TMPDATA as $key => $value){
                if($SDATA=='') $SDATA = $key.' '.$value;
                else $SDATA .=', '.$key.' '.$value;
            }
        $data['PLNK'] = $this->pagination->create_links();
        $data['CRES'] = $this->company_model->getPgCos(1,$config['per_page'], $page, $KEY, $SDATA);
        $data['TITLE'] = 'In Review';
        $data['ERR'] = '';
        if($this->session->ERR!=''){
            $data['ERR'] = $this->session->ERR;
            $session_data = array('ERR' => '');
            $this->session->set_userdata($session_data);
        }
        $this->load->view('back/company/list', $data);
    }
    public function accepted(){
        $KEY = $this->input->post('serKey',TRUE);
        $config['base_url']         = base_url().'Company/new/list';
        $config['total_rows']       = $this->company_model->cntCos($KEY,'2');
        $config['per_page']         = 20;
        $config['uri_segment']      = 4;
        $config['num_links']        = 5;
        $config['full_tag_open']    = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '</span></li>';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        $config['first_link']       = '<i class="fas fa-angle-double-left"></i>';
        $config['first_tag_open']   = '<li class="page-item">';
        $config['first_tag_close']  = '</li>';
        $config['last_link']        = '<i class="fas fa-angle-double-right"></i>';
        $config['last_tag_open']    = '<li class="page-item">';
        $config['last_tag_close']   = '</li>';
        $config['prev_link']        = '<i class="fas fa-angle-left"></i>';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '<i class="fas fa-angle-right"></i>';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tag_close']   = '</li>';
        $config['attributes']       = array('class' => 'page-link');
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->pagination->initialize($config);
        $TMPDATA = $this->session->SORT_DATA;
        $SDATA = '';
        if($TMPDATA!='')
            foreach($TMPDATA as $key => $value){
                if($SDATA=='') $SDATA = $key.' '.$value;
                else $SDATA .=', '.$key.' '.$value;
            }
        $data['PLNK'] = $this->pagination->create_links();
        $data['CRES'] = $this->company_model->getPgCos(2,$config['per_page'], $page, $KEY, $SDATA);
        $data['TITLE'] = 'Accepted';
        $data['ERR'] = '';
        if($this->session->ERR!=''){
            $data['ERR'] = $this->session->ERR;
            $session_data = array('ERR' => '');
            $this->session->set_userdata($session_data);
        }
        $this->load->view('back/company/list', $data);
    }
}