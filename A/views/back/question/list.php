<?php defined('BASEPATH') OR exit('No direct script access allowed');$PG['PG']='Q';?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url().'assets/images/favicon-32x32.png';?>" />
        <title>Console</title>
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
                                    	<h2 class="title-1"><i class="fas fa-question"></i>&nbsp;&nbsp;Question Management</h2>
                                    	<button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#modal-add-user"><i class="fas fa-plus"></i>Add Question</button>
                                	</div>
								</div>
							</div><br /><div class="row">
								<div class="col-md-12">
									<div class="table-responsive table--no-card m-b-30">
										<table class="table table-borderless table-striped table-earning">
											<thead><tr><th>#</th><th>Category</th><th>Question</th><th>Position</th><th>Actions</th></tr></thead>
											<tbody>
											<?php 
												if(count($QRES)!=0){
													$i=1;foreach($QRES as $QR){
														$CNM = $this->question_model->getCat($QR['category_id']);
											?>
												<tr id="list<?php echo $i;?>">
													<th align="center"><?php echo $i;?></th>
													<th><?php echo $CNM->name;?></th>
													<th><?php echo $QR['title'];?></th>
													<th><?php echo $QR['position'];?></th>
													<th>
														<i data-toggle="modal" data-target="#edtQuest<?php echo $i;?>" class="fas fa-edit fa-2x isLink" title="Edit"></i>&nbsp;&nbsp;&nbsp;&nbsp;
														<i id="deleteQuest<?php echo $i;?>" class="fas fa-trash fa-2x isLink" title="Delete"></i>
													</th>
												</tr>
											<?php $i++;}}else{?>
												<tr><th colspan="6"><center>No Questions Added</center></th></tr>
											<?php }?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<?php $this->load->view('back/common/footer.php'); ?>
						</div>
					</div>
				</div>
				<?php $i=1;foreach($QRES as $QR){?>
					<div id="edtQuest<?php echo $i;?>" class="modal fade" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Edit Question</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form method="post" id="add_quest_form" name="add_quest_form" action="<?php echo base_url();?>question/validEdtQuest" class="needs-validation" novalidate>
										<div class="form-group">
											<div class="select">
												<select id="category_id" name="category_id" class="custom-select form-control" required="">
												<?php if(count($CRES)==0){?>
													<option>ENTER A CATEGORY FIRST</option>
												<?php }else{?>
													<option disabled="disabled" selected="">Select a Category</option>
												<?php foreach($CRES as $CR){?>
													<option value="<?php echo $CR['category_id'];?>" <?php if($CR['category_id']==$QR['category_id']) echo 'selected="selected"'?>><?php echo $CR['name'];?></option>
												<?php }}?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<input type="text" data-error=".errorTit" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="Question" required="required" name="title" id="title" autocomplete="off" value="<?php echo $QR['title']?>" />
											<div class="errorTit red-text"></div>
										</div>
										<div class="form-group">
											<input type="text" class="au-input au-input--full" placeholder="Question Description" name="info" id="info" autocomplete="off" value="<?php echo $QR['quest_desc']?>" />
										</div>
										<div class="form-group">
											<div class="select">
												<select id="quest_type" name="quest_type" class="custom-select form-control" required="">
													<option disabled="disabled" selected="">Select the Type</option>
													<option value="1" <?php if($QR['quest_type']=='1') echo 'selected="selected"'?>>Text</option>
													<option value="2" <?php if($QR['quest_type']=='2') echo 'selected="selected"'?>>Email</option>
													<option value="3" <?php if($QR['quest_type']=='3') echo 'selected="selected"'?>>Number</option>
													<option value="4" <?php if($QR['quest_type']=='4') echo 'selected="selected"'?>>Text Area</option>
													<option value="5" <?php if($QR['quest_type']=='5') echo 'selected="selected"'?>>Checkbox</option>
													<option value="6" <?php if($QR['quest_type']=='6') echo 'selected="selected"'?>>Switch</option>
													<option value="7" <?php if($QR['quest_type']=='7') echo 'selected="selected"'?>>Dropdown</option>
													<option value="8" <?php if($QR['quest_type']=='8') echo 'selected="selected"'?>>Country</option>
													<option value="9" <?php if($QR['quest_type']=='9') echo 'selected="selected"'?>>Region</option>
													<option value="10" <?php if($QR['quest_type']=='10') echo 'selected="selected"'?>>Industry</option>
													<option value="11" <?php if($QR['quest_type']=='11') echo 'selected="selected"'?>>Currency Text Line</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<input type="text" class="au-input au-input--full" placeholder="Question Option(Check boxes)" name="opt" id="opt" value="<?php echo $QR['quest_opt']?>" autocomplete="off" />
										</div>
										<div class="form-group">
											<input type="text" data-error=".errorPos" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="Position" required="required" name="pos" id="pos" autocomplete="off" value="<?php echo $QR['position']?>" />
											<div class="errorPos red-text"></div>
										</div>
										<div class="form-group">
											<div class="form-check">
			                                    <div class="checkbox">
			                                        <label for="checkbox1" class="form-check-label ">
			                                            <input type="checkbox" id="isrequired" name="isrequired" value="1" class="form-check-input" <?php if($QR['isrequired']==1) echo 'checked="checked"';?>>Is Required
			                                        </label>
			                                    </div>
											</div>
										</div>
										<div class="form-group">
											<div class="form-check">
	                                        	<div class="checkbox">
	                                            	<label for="checkbox1" class="form-check-label ">
	                                                	<input type="checkbox" id="isscore" name="isscore" value="1" class="form-check-input" <?php if($QR['israting']==1) echo 'checked="checked"';?>>Is Needed for Risk Scoring
	                                            	</label>
	                                        	</div>
	                                        </div>
										</div>
										<div class="form-group">
											<input type="number" data-error=".errorQty" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="Have Multiple" required="required" name="qty" id="qty" autocomplete="off" value="<?php echo $QR['has_multiple']?>" />
											<div class="errorQty red-text"></div>
										</div>
										<div class="button text-center">
											<input type="hidden" name="question_id" value="<?php echo $QR['question_id'];?>" />
											<button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Edit Question</button>
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				<?php $i++;}?>
				<div id="modal-add-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Add Question</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" id="add_quest_form" name="add_quest_form" action="<?php echo base_url();?>question/validQuest" class="needs-validation" novalidate>
									<div class="form-group">
										<div class="select">
											<select id="category_id" name="category_id" class="custom-select form-control" required="">
											<?php if(count($CRES)==0){?>
												<option>ENTER A CATEGORY FIRST</option>
											<?php }else{?>
												<option disabled="disabled" selected="">Select a Category</option>
											<?php foreach($CRES as $CR){?>
												<option value="<?php echo $CR['category_id'];?>"><?php echo $CR['name'];?></option>
											<?php }}?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<input type="text" data-error=".errorTit" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="Question" required="required" name="title" id="title" autocomplete="off" />
										<div class="errorTit red-text"></div>
									</div>
									<div class="form-group">
										<input type="text" class="au-input au-input--full" placeholder="Question Description" name="info" id="info" autocomplete="off" />
									</div>
									<div class="form-group">
										<div class="select">
											<select id="quest_type" name="quest_type" class="custom-select form-control" required="">
												<option disabled="disabled" selected="">Select the Type</option>
												<option value="1">Text</option>
												<option value="2">Email</option>
												<option value="3">Number</option>
												<option value="4">Text Area</option>
												<option value="5">Checkbox</option>
												<option value="6">Switch</option>
												<option value="7">Dropdown</option>
												<option value="8">Country</option>
												<option value="9">Region</option>
												<option value="10">Industry</option>
												<option value="11">Currency Text Line</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<input type="text" class="au-input au-input--full" placeholder="Question Option(Check boxes)" name="opt" id="opt" autocomplete="off" />
									</div>
									<div class="form-group">
										<input type="text" data-error=".errorPos" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="Position" required="required" name="pos" id="pos" autocomplete="off" />
										<div class="errorPos red-text"></div>
									</div>
									<div class="form-group">
										<div class="form-check">
		                                    <div class="checkbox">
		                                        <label for="checkbox1" class="form-check-label ">
		                                            <input type="checkbox" id="isrequired" name="isrequired" value="1" class="form-check-input">Is Required
		                                        </label>
		                                    </div>
										</div>
									</div>
									<div class="form-group">
										<div class="form-check">
                                        	<div class="checkbox">
                                            	<label for="checkbox1" class="form-check-label ">
                                                	<input type="checkbox" id="isscore" name="isscore" value="1" class="form-check-input">Is Needed for Risk Scoring
                                            	</label>
                                        	</div>
                                        </div>
									</div>
									<div class="form-group">
										<input type="number" data-error=".errorQty" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="Have Multiple" required="required" name="qty" id="qty" autocomplete="off" />
										<div class="errorQty red-text"></div>
									</div>
									<div class="button text-center">
										<button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Add Question</button>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('back/common/js.php'); ?>
		<script>
			$(document).ready(function(){
			<?php for($i=1;$i<=count($QRES);$i++){?>
				$('#deleteQuest<?php echo $i;?>').click(function() {
					let ans = confirm("Please confirm question deletion?");
					if(ans){
						let deleteid = $('#qid<?php echo $i?>').val();
						$.ajax({
							type: "POST",
							url: '<?php echo base_url();?>ajax/questDel',
							data: { qid: deleteid },
							success: function(data){console.log(data);$('#list<?php echo $i;?>').hide();}
						});
					}
				});
			<?php }?>
			});
		</script>
	</body>
</html>