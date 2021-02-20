<?php defined('BASEPATH') OR exit('No direct script access allowed');$PG['PG']='C';?>
<?php 
	$CSTATUS = "NEW";
	if($CROW->status==1){
		$CSTATUS = "In Review";
	}elseif($CROW->status==2){
		$CSTATUS = "Accepted";
	}elseif($CROW->status==3){
		$CSTATUS = "Approved";
	}elseif($CROW->status==4){
		$CSTATUS = "Rejected/Canceled";
	}
	$UBONAT = $UBORES= 0.00;
	$i=1;
	foreach($URES as $UR){
		$TEMP = $this->setting_model->getCountryByIso3($UR['ubo_nationality1']);
		$UBONAT += $TEMP->pmxscore;
		$TEMP = $this->setting_model->getCountryByIso3($UR['addr_country']);
		$UBORES += $TEMP->pmxscore;
		$i++;
	}
	if($i>1){
		$UBORES = $UBORES/($i-1);
		$UBONAT = $UBONAT/($i-1);
	}else{
		$UBORES = 10;
		$UBONAT = 10;
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url().'assets/images/favicon-32x32.png';?>" />
        <title> Console</title>
        <?php $this->load->view('back/common/css.php'); ?>
	</head>
	<body class="animsition">
		<div class="page-wrapper">
			<?php $this->load->view('back/common/sideNav.php',$PG); ?>
			<div class="page-container">
				<?php $this->load->view('back/common/header.php'); ?>
				<div class="main-content">
					<div class="section__content section__content--p30">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">
									<div class="overview-wrap">
                                    	<h2 class="title-1"><i class="fas fa-user-cog"></i>&nbsp;&nbsp;Company Management</h2>
                                    	<select class="custom-select form-control" style="width:200px" id="coStatus">
                                    		<option value="0" <?php if($CROW->status==0) echo 'selected="selected"';?>>NEW</option>
                                    		<option value="1" <?php if($CROW->status==1) echo 'selected="selected"';?>>In Review</option>
                                    		<option value="2" <?php if($CROW->status==2) echo 'selected="selected"';?>>Accepted</option>
                                    		<option value="4" <?php if($CROW->status==4) echo 'selected="selected"';?>>Rejected</option>
                                    	</select>
                                	</div>
								</div>
							</div><br /><div class="row">
								<div class="col-md-12">
									<div class="card">
										<div class="card-header">
											<h4><?php echo $CROW->company_name;?> - <span class="red-text"><?php echo $CSTATUS;?></span></h4>
										</div>
										<div class="card-body">
											<div class="custom-tab">
												<?php $this->load->view('back/company/tabNav'); ?>
												<div class="tab-content pl-3 pt-2" id="nav-tabContent" style="border:1px solid #dee2e6;border-top:0px">
													<?php if ($ERR!=''){?><div class="alert alert-success" role="alert"><?php echo $ERR;?></div><?php }?>
													<div class="tab-pane fade active show" id="co_inf" role="tabpanel" aria-labelledby="nav-inf-tab">
														<?php $this->load->view('back/company/coInf');?>
														<form  method="post" id="senCoInf" name="addChannelFrm" class="needs-validation" novalidate action="<?php echo base_url();?>company/sendEmail">
															<input type="hidden" name="cid" value="<?php echo $CROW->company_id;?>" />
															<input type="hidden" name="typ" value="1" />
															<button class="au-btn au-btn--block au-btn--green" type="submit">Request Information</button>
														</form>
													</div>
													<div class="tab-pane fade" id="co_ubo" role="tabpanel" aria-labelledby="nav-ubo-tab">
														<?php $this->load->view('back/company/uboInf');?>
														<form  method="post" id="senCoInf" name="addChannelFrm" class="needs-validation" novalidate action="<?php echo base_url();?>company/sendEmail">
															<input type="hidden" name="cid" value="<?php echo $CROW->company_id;?>" />
															<input type="hidden" name="typ" value="1" />
															<button class="au-btn au-btn--block au-btn--green" type="submit">Request Information</button>
														</form>
													</div>
													<div class="tab-pane fade" id="co_ans" role="tabpanel" aria-labelledby="nav-ans-tab">
														<?php $this->load->view('back/company/questInf');?>
													</div>
													<div class="tab-pane fade" id="co_frm" role="tabpanel" aria-labelledby="nav-frm-tab">
														<?php $this->load->view('back/company/formInf');?>
													</div>
													<div class="tab-pane fade" id="co_rep" role="tabpanel" aria-labelledby="nav-rep-tab">
														<?php $score=0;?>
														<table class="table">
															<thead><tr><th>Risk Factor</th><th>Value</th><th>Score</th><th>Weight</th></tr></thead>
															<tbody>
																<?php 
																	$TEMP = $this->setting_model->getCountryByIso3($CROW->reg_country);
																	$score += 0.05*$TEMP->pmxscore;
																?>
																<tr>
																	<td>Resistered</td>
																	<td><?php echo $CROW->reg_country;?></td>
																	<td><?php echo $TEMP->pmxscore;?></td>
																	<td>5%</td>
																</tr>
																<?php 
																	$MV = '';
																	$ANS  = $this->question_model->getCompanyAns($CROW->company_id,3);
																	foreach ($ANS as $A) {
																		$MV = $A['meta_value'];
																	}
																	$TEMP = $this->setting_model->getCountryByIso3($MV);
																	$score += 0.07*$TEMP->pmxscore;
																?>
																<tr>
																	<td>Managed</td>
																	<td><?php echo $MV;?></td>
																	<td><?php echo $TEMP->pmxscore;?></td>
																	<td>7%</td>
																</tr>
																<?php 
																	$TEMP = $this->setting_model->getRegion($CROW->oper_region);
																	$score += 0.08*$TEMP->pmxscore;
																?>
																<tr>
																	<td>Operating(Region)</td>
																	<td><?php echo $TEMP->region_name;?></td>
																	<td><?php echo $TEMP->pmxscore;?></td>
																	<td>8%</td>
																</tr>
																<tr>
																	<td>Top 3 Countries To receive</td>
																<?php 
																	$i=0;
																	$PMX = 0;
																	$ANS  = $this->question_model->getCompanyAns($CROW->company_id,15);
																	foreach ($ANS as $A) {
																		$MV = $A['meta_value'];
																		$VAL[$i] = $A['meta_value'];
																		if($MV != 'N/A'){
																			$TEMP = $this->setting_model->getCountryByIso3($MV);
																			if($PMX<$TEMP->pmxscore)
																				$PMX = $TEMP->pmxscore;
																			$S[$i] = $TEMP->pmxscore;
																		}else{
																			$S[$i] = 0;
																		}
																		$i++;
																	}
																	if($PMX==0) $PMX=10;
																	$score += 0.05*$PMX;
																?>
																	<td><?php for($z=0;$z<$i;$z++) echo $VAL[$z].'<br />'?></td>
																	<td><?php for($z=0;$z<$i;$z++) echo $S[$z].'<br />'?></td>
																	<td>5%</td>
																</tr><tr>
																	<td>Top 3 Countries To pay</td>
																<?php 
																	$i=0;
																	$PMX = 0;
																	$ANS  = $this->question_model->getCompanyAns($CROW->company_id,18);
																	foreach ($ANS as $A) {
																		$MV = $A['meta_value'];
																		$VAL[$i] = $A['meta_value'];
																		if($MV != 'N/A'){
																			$TEMP = $this->setting_model->getCountryByIso3($MV);
																			if($PMX<$TEMP->pmxscore)
																				$PMX = $TEMP->pmxscore;
																			$P[$i] = $TEMP->pmxscore;
																		}else{
																			$P[$i] = 0;
																		}
																		$i++;
																	}
																	if($PMX==0) $PMX=10;
																	$score += 0.05*$PMX;
																?>
																	<td><?php for($z=0;$z<$i;$z++) echo $VAL[$z].'<br />'?></td>
																	<td><?php for($z=0;$z<$i;$z++) echo $P[$z].'<br />'?></td>
																	<td>5%</td>
																</tr>
																<?php 
																	$MV = '';
																	$ANS  = $this->question_model->getCompanyAns($CROW->company_id,1);
																	foreach ($ANS as $A) {
																		$MV = $A['meta_value'];
																	}
																	$TEMP = $this->setting_model->getIndustry($MV);
																	$score += 0.25*$TEMP->pmxscore;
																?>
																<tr>
																	<td>Business Sector</td>
																	<td><?php echo $TEMP->industry_name;?></td>
																	<td><?php echo $TEMP->pmxscore;?></td>
																	<td>25%</td>
																</tr>
																<?php 
																	$MV = '';
																	$ANS  = $this->question_model->getCompanyAns($CROW->company_id,4);
																	foreach ($ANS as $A) {
																		$MV = $A['meta_value'];
																	}
																	if($MV=='Y')
																		$score -= 0.25*2;
																?>
																<tr>
																	<td>Licensable?</td>
																	<td><?php echo ($MV == 'Y' ? "Yes" : "No");?></td>
																	<td><?php echo ($MV == 'Y' ? "-2" : "0");?></td>
																	<td></td>
																</tr>
																<?php 
																	$date1 = $CROW->reg_dt;
																	$date2 = date("Y-m-d");
																	$diff = abs(strtotime($date2) - strtotime($date1));
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
																?>
																<tr>
																	<td>Corporate Age (Years)</td>
																	<td><?php echo $MV;?></td>
																	<td><?php echo $PMXSCORE?></td>
																	<td>4%</td>
																</tr>
																<?php 
																	$MV = '';
																	$ANS  = $this->question_model->getCompanyAns($CROW->company_id,10);
																	foreach ($ANS as $A) {
																		$MV = $A['meta_value'];
																	}
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
																?>
																<tr>
																	<td>Asset Size</td>
																	<td><?php echo $MV;?></td>
																	<td><?php echo $PMXSCORE?></td>
																	<td>4%</td>
																</tr>
																<?php 
																	$MV = '';
																	$ANS  = $this->question_model->getCompanyAns($CROW->company_id,8);
																	foreach ($ANS as $A) {
																		$MV = $A['meta_value'];
																	}
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
																?>
																<tr>
																	<td>Turnover</td>
																	<td><?php echo $MV;?></td>
																	<td><?php echo $PMXSCORE?></td>
																	<td>4%</td>
																</tr>
																<tr>
																	<th colspan="25"><hr /></th>
																</tr>
																<?php 
																	$PMXSCORE = ($CROW->noc == 1 ? 6 : 8);
																	$score += 0.08*$PMXSCORE;
																?>
																<tr>
																	<td>Corporate Structure</td>
																	<td><?php echo ($CROW->noc == 1 ? "Simple" : "Complex").' ('.$CROW->noc.')';?></td>
																	<td><?php echo $PMXSCORE;?></td>
																	<td>8%</td>
																</tr>
																<?php 
																	$score += 0.05*$UBONAT;
																?>
																<tr>
																	<td>Nationality Weighted Average Score</td>
																	<td></td>
																	<td><?php echo $UBONAT;?></td>
																	<td>5%</td>
																</tr>
																<?php 
																	$score += 0.07*$UBORES;
																?>
																<tr>
																	<td>Residencey Weighted Average Score</td>
																	<td></td>
																	<td><?php echo $UBORES;?></td>
																	<td>7%</td>
																</tr>
																<tr>
																	<th colspan="25"><hr /></th>
																</tr>
																<?php 
																	$TEMP = $this->setting_model->getChannel($FROW->channel_id);
																	$score += 0.15*$TEMP->pmxscore;
																?>
																<tr>
																	<td>Introduced By</td>
																	<td><?php echo $TEMP->name;?></td>
																	<td><?php echo $TEMP->pmxscore;?></td>
																	<td>15%</td>
																</tr><tr>
																	<th>Risk Score</th>
																	<th colspan="3"><?php echo number_format($score, 2, '.', '');?></th>
																</tr>
																<?php 
																	$data = array(
																		'score' => $score
																	);
																	$this->company_model->editCompany($data,$CROW->company_id);
																?>
															</tbody>
														</table>
													</div>
													<div class="tab-pane fade" id="co_chart" role="tabpanel" aria-labelledby="nav-chart-tab" align="center">
														<div id="myDiagramDiv" style="width:auto; height:800px; background-color: #ffffff;"></div>
														<?php if($SROW->info==''){?>
															<span class="red-text">Chart not provided</span>
														<?php }?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php $this->load->view('back/common/footer.php'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('back/common/js.php'); ?>
		<script src="<?php echo base_url().'assets/vendor/go-debug.js';?>"></script>
		<script>
			var GO = go.GraphObject.make;
            var myDiagram =
                GO(go.Diagram, "myDiagramDiv",{"undoManager.isEnabled": true,layout: GO(go.TreeLayout, {angle: 90, layerSpacing: 35})});    
            myDiagram.nodeTemplate =
                GO(go.Node, "Auto",
                    GO(go.Shape, "RoundedRectangle", {fill:"white", portId:"", fromLinkable: true, toLinkable: true}, new go.Binding("fill", "typ")),
                    GO(go.TextBlock, "Default Text", {margin:15, stroke: "white", font: "bold 16px sans-serif" }, new go.Binding("text", "name"))
                );
            
            myDiagram.linkTemplate = GO(go.Link,{ routing: go.Link.Orthogonal, corner: 5 },GO(go.Shape, { strokeWidth: 3, stroke: "#555" }));
            var model = GO(go.TreeModel);
            let modelAsText ='';
            <?php if($SROW->info!=''){?>
                modelAsText = <?php echo $SROW->info;?>;
                myDiagram.model = go.Model.fromJson(modelAsText);
            <?php $TYP=0;}?>
			$(document).ready(function(){
				$('#coStatus').change(function () { 
					let ans = confirm("Please confirm you want to change the status?");
					if(ans){
						$.ajax("<?php echo base_url();?>Ajax/updateCoStatus", {
		                    type: 'POST', 
		                    data: { typ: $("#coStatus option:selected").val(), cid: <?php echo $CROW->company_id?>},
		                    success: function (data, status, xhr) {location.reload(true);}
		                });
					}
				});
			});
		</script>
	</body>
</html>