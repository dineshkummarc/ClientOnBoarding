<?php defined('BASEPATH') OR exit('No direct script access allowed');$PG['PG']='U';?>
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
                                    	<h2 class="title-1"><i class="fas fa-user-cog"></i>&nbsp;&nbsp;User Management</h2>
                                    	<button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#modal-add-user"><i class="fas fa-plus"></i>Add User</button>
                                	</div>
								</div>
							</div><br /><div class="row">
								<div class="col-md-12">
									<form method="post" id="serFrm" name="serFrm" class="needs-validation" novalidate action="<?php echo base_url();?>User/list">
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
													<th>Name&nbsp;&nbsp;&nbsp;&nbsp;<i id="srtName" class="fas fa-sort-alpha-down isLink"></i></th>
													<th>Email&nbsp;&nbsp;&nbsp;&nbsp;<i id="srtEmail" class="fas fa-sort-alpha-down isLink"></i></th>
													<th>Type&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-filter isLink" data-toggle="modal" data-target="#modal-filter"></i></th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
											<?php 
												if(count($URES)!=0){
													$i=1;foreach($URES as $UR){
														if($UR['user_type']==1) 
															$USER_TYPE="Admin";
														elseif($UR['user_type']==2) 
															$USER_TYPE="Staff"; 
														elseif($UR['user_type']==4) 
															$USER_TYPE="CSP";
														else $USER_TYPE="Company";
											?>
												<tr id="list<?php echo $i;?>">
													<th align="center"><?php echo $i;?></th>
													<th id="UNM<?php echo $i;?>"><?php echo $UR['user_name'];?></th>
													<th id="EML<?php echo $i;?>"><?php echo $UR['user_email'];?></th>
													<th id="TYP<?php echo $i;?>"><?php echo $USER_TYPE;?></th>
													<th>
														<i id="editUser<?php echo $i;?>" class="fas fa-edit fa-2x isLink" title="Edit"></i>&nbsp;&nbsp;&nbsp;&nbsp;
														<?php if($UR['user_type']!=1){?><i id="deleteUser<?php echo $i;?>" class="fas fa-trash fa-2x isLink" title="Delete"></i><?php }?>
													</th>
												</tr>
												<tr id="edit<?php echo $i;?>" style="display:none">
													<form class="form-horizontal" id="userFrm<?php echo $i;?>">
														<th><?php echo $i;?><input type="hidden" name="uid" value="<?php echo $UR['user_id'];?>" /></th>
														<th><input class="form-control" id="user_name<?php echo $i;?>" type="text" name="user_name" value="<?php echo $UR['user_name'];?>" /></th>
														<th><input class="form-control" id="user_email<?php echo $i;?>" type="email" name="user_email" value="<?php echo $UR['user_email'];?>" /></th>
														<th>
															<select name="user_type" class="custom-select form-control">
																<option value="1" <?php if($UR['user_type']==1) echo 'selected="selected"';?>>Admin</option>
																<option value="2" <?php if($UR['user_type']==2) echo 'selected="selected"';?>>Staff</option>
																<option value="3" <?php if($UR['user_type']==3) echo 'selected="selected"';?>>Company</option>
																<option value="4" <?php if($UR['user_type']==4) echo 'selected="selected"';?>>CSP</option>
															</select>
														</th>
														<th>
															<i class="fas fa-save fa-2x isLink" id="save<?php echo $i;?>" title="Save"></i>&nbsp;&nbsp;&nbsp;&nbsp;
															<i class="far fa-window-close fa-2x isLink" id="cancel<?php echo $i;?>" title="Cancel"></i>
														</th>
													</form>
										        </tr>
											<?php $i++;}}else{?>
												<tr><th colspan="6"><center>No Users Added</center></th></tr>
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
				<div id="modal-add-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Add User</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form  method="post" id="addUserFrm" name="addUserFrm" class="needs-validation" novalidate action="<?php echo base_url();?>user/validUser">
									<div id="addErr"></div>
									<div class="form-group">
										<input type="email" data-error=".errorEml" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="Email" required="required" name="user_email" id="user_email" autofocus autocomplete="off" />
										<div class="errorEml red-text"></div>
									</div>
									<div class="form-group">
										<input type="text" data-error=".errorUnm" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="Name" required="required" name="user_name" id="user_name" autocomplete="off" />
										<div class="errorUnm red-text"></div>
									</div>
									<div class="form-group">
										<input type="password" data-error=".errorPwd" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="Password" required="required" name="user_pwd" id="user_pwd" autocomplete="off" />
										<div class="errorPwd red-text"></div>
									</div>
									<div class="form-group">
										<div class="select">
											<select id="user_type" name="user_type" class="custom-select form-control" required="">
												<option value="2">Staff</option>
												<option value="3">Company</option>
												<option value="4">CSP</option>
												<option value="1">Admin</option>
											</select>
										</div>
									</div>
									<div class="button text-center">
										<button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Add User</button>
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
								<h4 class="modal-title">Filter by Type</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form  method="post" id="Frm" name="Frm" class="needs-validation" novalidate action="<?php echo base_url();?>User/list">
									<div class="form-group">
										<div class="select">
											<select name='filKey' class="custom-select form-control" required="">
												<option value="1" <?php if($UR['user_type']==1) echo 'selected="selected"';?>>Admin</option>
												<option value="2" <?php if($UR['user_type']==2) echo 'selected="selected"';?>>Staff</option>
												<option value="3" <?php if($UR['user_type']==3) echo 'selected="selected"';?>>Company</option>
												<option value="4" <?php if($UR['user_type']==4) echo 'selected="selected"';?>>CSP</option>
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
				$('#srtName').click(function() {
					$.ajax("<?php echo base_url();?>Ajax/setSort", {
						type: 'POST', 
						data: { sort: "user_name"},
						success: function (data, status, xhr) {location.reload(true);}
					});
				});
				$('#srtEmail').click(function() {
					$.ajax("<?php echo base_url();?>Ajax/setSort", {
						type: 'POST', 
						data: { sort: "user_email"},
						success: function (data, status, xhr) {location.reload(true);}
					});
				});
				$('#resetPg').click(function() {
					window.location.replace("<?php echo base_url();?>/User");
				});
			<?php for($i=1;$i<=count($URES);$i++){?>
				$('#editUser<?php echo $i;?>').click(function() {$('#list<?php echo $i;?>').hide();$('#edit<?php echo $i;?>').show();});
				$('#cancel<?php echo $i;?>').click(function() {$('#list<?php echo $i;?>').show();$('#edit<?php echo $i;?>').hide();});
				$('#save<?php echo $i;?>').click(function() {
					let form = $('#userFrm<?php echo $i?>');
					$.ajax({
						type: "POST",
						url: '<?php echo base_url();?>ajax/userEdit',
						data: form.serialize(),
						success: function(data){$('#TYP<?php echo $i;?>').html(data)}
					});
					$('#UNM<?php echo $i;?>').html($("#user_name<?php echo $i?>").val());
					$('#EML<?php echo $i;?>').html($("#user_email<?php echo $i?>").val());
					$('#list<?php echo $i;?>').show();
					$('#edit<?php echo $i;?>').hide();
				});
				$('#deleteUser<?php echo $i;?>').click(function() {
					let ans = confirm("Please confirm user deletion?");
					if(ans){
						let form = $('#userFrm<?php echo $i?>');
						$.ajax({
							type: "POST",
							url: '<?php echo base_url();?>ajax/userDel',
							data: form.serialize(),
							success: function(data){$('#list<?php echo $i;?>').hide();}
						});
					}
				});
			<?php }?>
				$("#addUserFrm").validate({
                    rules: {
                        user_email  : {required: true, email:true},
                        user_name 	: "required",
                        user_pwd 	: "required",
                    },
                    messages: {
                        user_email  : {required: "Please Enter An Email.", email: "Please Enter A Valid Email."},
                        user_name 	: "Please Enter The Name.",
                        user_pwd 	: "Please Enter A Password.",
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