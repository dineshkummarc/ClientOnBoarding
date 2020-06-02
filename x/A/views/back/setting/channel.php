<?php defined('BASEPATH') OR exit('No direct script access allowed');$PG['PG']='S';?>
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
                                    	<h2 class="title-1"><i class="fas fa-tools"></i>&nbsp;&nbsp;Channel Management</h2>
                                    	<button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#modal-add-channel"><i class="fas fa-plus"></i>Add Channel</button>
                                	</div>
								</div>
							</div><br /><div class="row">
								<div class="col-md-12">
									<div class="table-responsive table--no-card m-b-30">
										<table class="table table-borderless table-striped table-earning">
											<thead><tr><th>#</th><th>Name</th><th>Score</th><th>Actions</th></tr></thead>
											<tbody>
											<?php 
												if(count($CRES)!=0){
													$i=1;foreach($CRES as $RR){
											?>
												<tr id="list<?php echo $i;?>">
													<th align="center"><?php echo $i;?></th>
													<th id="NM<?php echo $i;?>"><?php echo $RR['name'];?></th>
													<th id="PMX<?php echo $i;?>"><?php echo $RR['pmxscore'];?></th>
													<th>
														<i id="editChannel<?php echo $i;?>" class="fas fa-edit fa-2x isLink" title="Edit"></i>&nbsp;&nbsp;&nbsp;&nbsp;
														<i id="deleteChannel<?php echo $i;?>" class="fas fa-trash fa-2x isLink" title="Delete"></i>
													</th>
												</tr>
												<tr id="edit<?php echo $i;?>" style="display:none">
													<form class="form-horizontal" id="channelFrm<?php echo $i;?>">
														<th><?php echo $i;?><input type="hidden" name="id" value="<?php echo $RR['id'];?>" /></th>
														<th><input class="form-control" id="name<?php echo $i;?>" type="text" name="name" value="<?php echo $RR['name'];?>" /></th>
														<th><input class="form-control" id="pmxscore<?php echo $i;?>" type="text" name="pmxscore" value="<?php echo $RR['pmxscore'];?>" /></th>
														<th>
															<i class="fas fa-save fa-2x isLink" id="save<?php echo $i;?>" title="Save"></i>&nbsp;&nbsp;&nbsp;&nbsp;
															<i class="far fa-window-close fa-2x isLink" id="cancel<?php echo $i;?>" title="Cancel"></i>
														</th>
													</form>
										        </tr>
											<?php $i++;}}else{?>
												<tr><th colspan="6"><center>No Channel Added</center></th></tr>
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
				<div id="modal-add-channel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Add Channel</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form  method="post" id="addChannelFrm" name="addChannelFrm" class="needs-validation" novalidate action="<?php echo base_url();?>channel/validChannel">
									<div id="addErr"></div>
									<div class="form-group">
										<input type="text" data-error=".errorNm" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="Channel name" required="required" name="name" id="name" autofocus autocomplete="off" />
										<div class="errorNm red-text"></div>
									</div>
									<div class="form-group">
										<input type="text" data-error=".errorPmx" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="Channel Score" required="required" name="pmxscore" id="pmxscore" autocomplete="off" />
										<div class="errorPmx red-text"></div>
									</div>
									<div class="button text-center">
										<button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Add Channel</button>
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
				$('#editChannel<?php echo $i;?>').click(function() {$('#list<?php echo $i;?>').hide();$('#edit<?php echo $i;?>').show();});
				$('#cancel<?php echo $i;?>').click(function() {$('#list<?php echo $i;?>').show();$('#edit<?php echo $i;?>').hide();});
				$('#save<?php echo $i;?>').click(function() {
					let form = $('#channelFrm<?php echo $i?>');
					$.ajax({
						type: "POST",
						url: '<?php echo base_url();?>ajax/channelEdit',
						data: form.serialize(),
						success: function(data){$('#TYP<?php echo $i;?>').html(data)}
					});
					$('#NM<?php echo $i;?>').html($("#name<?php echo $i?>").val());
					$('#PMX<?php echo $i;?>').html($("#pmxscore<?php echo $i?>").val());
					$('#list<?php echo $i;?>').show();
					$('#edit<?php echo $i;?>').hide();
				});
				$('#deleteChannel<?php echo $i;?>').click(function() {
					let ans = confirm("Please confirm channel deletion?");
					if(ans){
						let form = $('#channelFrm<?php echo $i?>');
						$.ajax({
							type: "POST",
							url: '<?php echo base_url();?>ajax/channelDel',
							data: form.serialize(),
							success: function(data){$('#list<?php echo $i;?>').hide();}
						});
					}
				});
			<?php }?>
				$("#addChannelFrm").validate({
                    rules: {
                        name 		: "required",
                        pmxscore 	: "required",
                    },
                    messages: {
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