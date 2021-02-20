<?php defined('BASEPATH') OR exit('No direct script access allowed');$PG['PG']='S';?>
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
                                    	<h2 class="title-1"><i class="fas fa-tools"></i>&nbsp;&nbsp;Country Management</h2>
                                    	<button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#modal-add-channel"><i class="fas fa-plus"></i>Add Country</button>
                                	</div>
								</div>
							</div><br /><div class="row">
								<div class="col-md-12">
									<form method="post" id="serFrm" name="serFrm" class="needs-validation" novalidate action="<?php echo base_url();?>Country/list">
										<div class="form-row">
    										<div class="form-group col-md-6">
												<input type="text" class="form-control isRounded" placeholder="Search..." name="serKey" />
											</div>
											<div class="form-group col-md-1" align="left">
												<button type="submit" class="btn btn-outline-secondary white"><i class="fas fa-search"></i>&nbsp;Search</button>
											</div>
											<div class="form-group col-md-5" align="right">
												<span class="btn btn-outline-secondary white" id="resetPg"><i class="fab fa-creative-commons-sa"></i>&nbsp;Reset</span>
											</div>
										</div>
									</form>
									<hr />
									<div class="table-responsive table--no-card m-b-30">
										<table class="table table-borderless table-striped table-earning">
											<thead>
												<tr>
													<th>#</th>
													<th>Region&nbsp;&nbsp;&nbsp;&nbsp;<i id="srtRegion" class="fas fa-sort-alpha-down isLink"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-filter isLink" data-toggle="modal" data-target="#modal-filter"></i></th>
													<th>ISO</th>
													<th>ISO3&nbsp;&nbsp;&nbsp;&nbsp;<i id="srtIso" class="fas fa-sort-alpha-down isLink"></i></th>
													<th>Name&nbsp;&nbsp;&nbsp;&nbsp;<i id="srtName" class="fas fa-sort-alpha-down isLink"></i></th>
													<th>Phone</th>
													<th>Income</th>
													<th>Comments</th>
													<th>Score&nbsp;&nbsp;&nbsp;&nbsp;<i id="srtScore" class="fas fa-sort-alpha-down isLink"></i></th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
											<?php 
												if(count($CRES)!=0){
													$i=1;foreach($CRES as $RR){
														$RNM = $this->setting_model->getRegion($RR['region_id']);
											?>
												<tr id="list<?php echo $i;?>">
													<th align="center"><?php echo $i;?></th>
													<th id="RID<?php echo $i;?>"><?php echo $RNM->region_name;?></th>
													<th id="ISO<?php echo $i;?>"><?php echo $RR['iso'];?></th>
													<th id="ISO3<?php echo $i;?>"><?php echo $RR['iso3'];?></th>
													<th id="NM<?php echo $i;?>"><?php echo $RR['name'];?></th>
													<th id="PNO<?php echo $i;?>"><?php echo $RR['phonecode'];?></th>
													<th id="INC<?php echo $i;?>"><?php echo $RR['income'];?></th>
													<th id="COM<?php echo $i;?>"><?php echo $RR['comments'];?></th>
													<th id="PMX<?php echo $i;?>"><?php echo $RR['pmxscore'];?></th>
													<th>
														<i id="editCountry<?php echo $i;?>" class="fas fa-edit fa-2x isLink" title="Edit"></i>&nbsp;&nbsp;&nbsp;&nbsp;
														<i id="deleteCountry<?php echo $i;?>" class="fas fa-trash fa-2x isLink" title="Delete"></i>
													</th>
												</tr>
												<tr id="edit<?php echo $i;?>" style="display:none">
													<form class="form-horizontal" id="countryFrm<?php echo $i;?>">
														<th><?php echo $i;?><input type="hidden" name="id" value="<?php echo $RR['id'];?>" /></th>
														<th>
															<select name='rid' class="custom-select form-control">
															<?php foreach($RRES as $R){?>
																<option value="<?php echo $R['region_id']?>" <?php if($R['region_id'] == $RR['region_id']) echo 'selected="selected"'?>><?php echo $R['region_name']?></option>
															<?php }?>
															</select>
														</th>
														<th>
															<input class="form-control" id="iso<?php echo $i;?>" type="text" name="iso" maxlength="2" value="<?php echo $RR['iso'];?>" />
														</th>
														<th>
															<input class="form-control" id="iso3<?php echo $i;?>" type="text" name="iso3" maxlength="3" value="<?php echo $RR['iso3'];?>" />
														</th>
														<th>
															<input class="form-control" id="name<?php echo $i;?>" type="text" name="name" value="<?php echo $RR['name'];?>" />
														</th>
														<th>
															<input class="form-control" id="pno<?php echo $i;?>" type="text" name="pno" value="<?php echo $RR['phonecode'];?>" />
														</th>
														<th>
															<input class="form-control" id="inc<?php echo $i;?>" type="text" name="inc" value="<?php echo $RR['income'];?>" />
														</th>
														<th>
															<input class="form-control" id="com<?php echo $i;?>" type="text" name="com" value="<?php echo $RR['comments'];?>" />
														</th>
														<th>
															<input class="form-control" id="pmxscore<?php echo $i;?>" type="text" name="pmxscore" value="<?php echo $RR['pmxscore'];?>" />
														</th>
														<th>
															<i class="fas fa-save fa-2x isLink" id="save<?php echo $i;?>" title="Save"></i>&nbsp;&nbsp;&nbsp;&nbsp;
															<i class="far fa-window-close fa-2x isLink" id="cancel<?php echo $i;?>" title="Cancel"></i>
														</th>
													</form>
										        </tr>
											<?php $i++;}}else{?>
												<tr><th colspan="6"><center>No Country Added</center></th></tr>
											<?php }?>
											</tbody>
										</table>
									</div>
									<?php echo $PLNK;?>
								</div>
							</div>
							<?php $this->load->view('back/common/footer.php'); ?>
						</div>
					</div>
				</div>
				<div id="modal-add-channel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Add Country</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form  method="post" id="addCountryFrm" name="addCountryFrm" class="needs-validation" novalidate action="<?php echo base_url();?>country/validCountry">
									<div class="form-group">
										<div class="select">
											<select name='rid' class="custom-select form-control" required="">
											<?php foreach($RRES as $R){?>
												<option value="<?php echo $R['region_id']?>"><?php echo $R['region_name']?></option>
											<?php }?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<input type="text" data-error=".errorIso" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="ISO Code" required="required" name="iso" id="iso" maxlength="2" autocomplete="off" />
										<div class="errorIso red-text"></div>
									</div>
									<div class="form-group">
										<input type="text" data-error=".errorIso3" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="ISO3 Code" required="required" name="iso3" id="iso3" maxlength="3" autocomplete="off" />
										<div class="errorIso3 red-text"></div>
									</div>
									<div class="form-group">
										<input type="text" data-error=".errorNm" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="Country Name" required="required" name="name" id="name" autocomplete="off" />
										<div class="errorNm red-text"></div>
									</div>
									<div class="form-group">
										<input type="text" data-error=".errorPno" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="Country Phone Code" required="required" name="pno" id="pno" autocomplete="off" />
										<div class="errorPno red-text"></div>
									</div>
									<div class="form-group">
										<input type="text" class="au-input au-input--full" placeholder="Income Bracket(Optional)" name="inc" id="inc" autocomplete="off" />
									</div>
									<div class="form-group">
										<input type="text" class="au-input au-input--full" placeholder="Comments (Optional)" name="com" id="com" autocomplete="off" />
									</div>
									<div class="form-group">
										<input type="text" data-error=".errorPmx" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="Country Score" required="required" name="pmxscore" id="pmxscore" autocomplete="off" />
										<div class="errorPmx red-text"></div>
									</div>
									<div class="button text-center">
										<button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Add Country</button>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
				<div id="modal-filter" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-sm" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Filter by region</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form  method="post" id="Frm" name="Frm" class="needs-validation" novalidate action="<?php echo base_url();?>country/list">
									<div class="form-group">
										<div class="select">
											<select name='filKey' class="custom-select form-control" required="">
											<?php foreach($RRES as $R){?>
												<option value="<?php echo $R['region_id']?>"><?php echo $R['region_name']?></option>
											<?php }?>
											</select>
										</div>
									</div>
									<div class="button text-center">
										<button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Filter</button>
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
				let srtRegion = srtIso = srtName = srtScore = 0;
				$('#srtRegion').click(function() {
					$.ajax("<?php echo base_url();?>Ajax/setSort", {
						type: 'POST', 
						data: { sort: "region_id"},
						success: function (data, status, xhr) {console.log(data);location.reload(true);},
						error: function (jqXhr, textStatus, errorMessage) {console.log(errorMessage);console.log(textStatus);console.log(jqXhr);}
					});
				});
				$('#srtIso').click(function() {
					$.ajax("<?php echo base_url();?>Ajax/setSort", {
						type: 'POST', 
						data: { sort: "iso3"},
						success: function (data, status, xhr) {location.reload(true);}
					});
				});
				$('#srtName').click(function() {
					$.ajax("<?php echo base_url();?>Ajax/setSort", {
						type: 'POST', 
						data: { sort: "name"},
						success: function (data, status, xhr) {location.reload(true);}
					});
				});
				$('#srtScore').click(function() {
					$.ajax("<?php echo base_url();?>Ajax/setSort", {
						type: 'POST', 
						data: { sort: "pmxscore"},
						success: function (data, status, xhr) {location.reload(true);}
					});
				});
				$('#resetPg').click(function() {
					window.location.replace("<?php echo base_url();?>/Country");
				});
			<?php for($i=1;$i<=count($CRES);$i++){?>
				$('#editCountry<?php echo $i;?>').click(function() {$('#list<?php echo $i;?>').hide();$('#edit<?php echo $i;?>').show();});
				$('#cancel<?php echo $i;?>').click(function() {$('#list<?php echo $i;?>').show();$('#edit<?php echo $i;?>').hide();});
				$('#save<?php echo $i;?>').click(function() {
					let form = $('#countryFrm<?php echo $i?>');
					$.ajax({
						type: "POST",
						url: '<?php echo base_url();?>ajax/countryEdit',
						data: form.serialize(),
						success: function(data){$('#RID<?php echo $i;?>').html(data)}
					});
					$('#ISO<?php echo $i;?>').html($("#iso<?php echo $i?>").val());
					$('#ISO3<?php echo $i;?>').html($("#iso3<?php echo $i?>").val());
					$('#NM<?php echo $i;?>').html($("#name<?php echo $i?>").val());
					$('#PNO<?php echo $i;?>').html($("#pno<?php echo $i?>").val());
					$('#INC<?php echo $i;?>').html($("#inc<?php echo $i?>").val());
					$('#COM<?php echo $i;?>').html($("#com<?php echo $i?>").val());
					$('#PMX<?php echo $i;?>').html($("#pmxscore<?php echo $i?>").val());

					$('#list<?php echo $i;?>').show();
					$('#edit<?php echo $i;?>').hide();
				});
				$('#deleteCountry<?php echo $i;?>').click(function() {
					let ans = confirm("Please confirm country deletion?");
					if(ans){
						let form = $('#countryFrm<?php echo $i?>');
						$.ajax({
							type: "POST",
							url: '<?php echo base_url();?>ajax/countryDel',
							data: form.serialize(),
							success: function(data){$('#list<?php echo $i;?>').hide();}
						});
					}
				});
			<?php }?>
				$("#addCountryFrm").validate({
                    rules: {
                        iso 		: "required",
                        iso3 		: "required",
                        pno 		: "required",
                        name 		: "required",
                        pmxscore 	: "required",
                    },
                    messages: {
                    	iso 		: "Please Enter The ISO Code For The Country.",
                        iso3 		: "Please Enter The ISO3 Code For The Country.",
                        pno 		: "Please Enter The Phone Code For The Country.",
                        name 		: "Please Enter The Name.",
                        pmxscore 	: "Please Enter The Score [0-10].",
                    },
                    errorElement : 'div', 
                    errorPlacement: function(error, element) {
                        var placement = $(element).data('error');
                        if (placement) {$(placement).append(error)} else {error.insertAfter(element);}
                    }
                });
			});
		</script>
	</body>
</html>