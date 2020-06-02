<?php 
	foreach($QCRES as $QC){
		echo '<h4>'.$QC['name'].'</h4><hr />';
		$QRES = $this->question_model->getQuestCats($QC['category_id']);
		echo '<table class="table table-borderless table-data3"><tbody>';
		foreach ($QRES as $QR) {
			echo '<tr><th>'.$QR['title'].'</th></tr>';
			$TEMP = $this->question_model->getCompanyAns($CROW->company_id,$QR['question_id']);
			foreach($TEMP as $T)
				if($QR['quest_type']==8){
                    $TT = $this->setting_model->getCountryByIso3($T['meta_value']);
                    $data1 =ucwords(strtolower($TT->name));
                }else if($QR['quest_type']==10){
                    $TT = $this->setting_model->getIndustry($T['meta_value']);
                    $data1 =$TT->industry_name;
                }else{
                    $data1 =$T['meta_value'];
                }
				echo '<tr><td>'.$data1.'</td></tr>';
		}
		echo '</tbody></table>';
	}
?>