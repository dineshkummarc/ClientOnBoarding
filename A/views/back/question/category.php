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
                                    	<h2 class="title-1"><i class="fas fa-question"></i>&nbsp;&nbsp;Question Category Management</h2>
                                    	<button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#modal-add-user"><i class="fas fa-plus"></i>Add Category</button>
                                	</div>
								</div>
							</div><br /><div class="row">
								<div class="col-md-12">
									<div class="table-responsive table--no-card m-b-30">
										<table class="table table-borderless table-striped table-earning">
											<thead><tr><th>#</th><th>Name</th><th>Position</th><th>Actions</th></tr></thead>
											<tbody>
											<?php 
												if(count($CRES)!=0){
													$i=1;foreach($CRES as $CR){
											?>
												<tr id="list<?php echo $i;?>">
													<th align="center"><?php echo $i;?></th>
													<th id="CNM<?php echo $i;?>"><?php echo $CR['name'];?></th>
													<th id="POS<?php echo $i;?>"><?php echo $CR['position'];?></th>
													<th>
														<i id="editCat<?php echo $i;?>" class="fas fa-edit fa-2x isLink" title="Edit"></i>&nbsp;&nbsp;&nbsp;&nbsp;
														<i id="deleteCat<?php echo $i;?>" class="fas fa-trash fa-2x isLink" title="Delete"></i>
													</th>
												</tr>
												<tr id="edit<?php echo $i;?>" style="display:none">
													<form class="form-horizontal" id="catFrm<?php echo $i;?>">
														<th><?php echo $i;?><input type="hidden" name="id" value="<?php echo $CR['category_id'];?>" /></th>
														<th><input class="form-control" id="cat_name<?php echo $i;?>" type="text" name="cat_name" value="<?php echo $CR['name'];?>" /></th>
														<th><input class="form-control" id="cat_pos<?php echo $i;?>" type="text" name="cat_pos" value="<?php echo $CR['position'];?>" /></th>
														<th>
															<i class="fas fa-save fa-2x isLink" id="save<?php echo $i;?>" title="Save"></i>&nbsp;&nbsp;&nbsp;&nbsp;
															<i class="far fa-window-close fa-2x isLink" id="cancel<?php echo $i;?>" title="Cancel"></i>
														</th>
													</form>
										        </tr>
											<?php $i++;}}else{?>
												<tr><th colspan="6"><center>No Category Added</center></th></tr>
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
								<h4 class="modal-title">Add Category</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form  method="post" id="addCategoryFrm" name="addCategoryFrm" class="needs-validation" novalidate action="<?php echo base_url();?>question/validCat">
									<div id="addErr"></div>
									<div class="form-group">
										<input type="text" data-error=".errorName" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="Name" required="required" name="cat_name" id="cat_name" autofocus autocomplete="off" />
										<div class="errorName red-text"></div>
									</div>
									<div class="form-group">
										<input type="text" data-error=".errorPos" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="Position" required="required" name="cat_pos" id="cat_pos" autocomplete="off" />
										<div class="errorPos red-text"></div>
									</div>
									<div class="button text-center">
										<button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Add Category</button>
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
			<?php for($i=1;$i<=count($CRES);$i++){?>
				$('#editCat<?php echo $i;?>').click(function() {$('#list<?php echo $i;?>').hide();$('#edit<?php echo $i;?>').show();});
				$('#cancel<?php echo $i;?>').click(function() {$('#list<?php echo $i;?>').show();$('#edit<?php echo $i;?>').hide();});
				$('#save<?php echo $i;?>').click(function() {
					let form = $('#catFrm<?php echo $i?>');
					$.ajax({
						type: "POST",
						url: '<?php echo base_url();?>ajax/catEdit',
						data: form.serialize(),
						success: function(data){$('#TYP<?php echo $i;?>').html(data)}
					});
					$('#CNM<?php echo $i;?>').html($("#cat_name<?php echo $i?>").val());
					$('#POS<?php echo $i;?>').html($("#cat_pos<?php echo $i?>").val());
					$('#list<?php echo $i;?>').show();
					$('#edit<?php echo $i;?>').hide();
				});
				$('#deleteCat<?php echo $i;?>').click(function() {
					let ans = confirm("Please confirm category deletion?");
					if(ans){
						let form = $('#catFrm<?php echo $i?>');
						$.ajax({
							type: "POST",
							url: '<?php echo base_url();?>ajax/catDel',
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