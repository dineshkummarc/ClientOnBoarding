<?php defined('BASEPATH') OR exit('No direct script access allowed');$PG['PG']='C';?>
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
                                    	<h2 class="title-1"><i class="fas fa-user-cog"></i>&nbsp;&nbsp;Company Management - <?php echo $TITLE;?></h2>
                                    	<button class="au-btn au-btn-icon au-btn--blue" id="addCompany"><i class="fas fa-plus"></i>Add Company</button>
                                	</div>
								</div>
							</div><br /><div class="row">
								<div class="col-md-12">
									<form method="post" id="serFrm" name="serFrm" class="needs-validation" novalidate action="<?php echo base_url();?>Company/new">
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
													<th>Score</th>
													<th>Form Date</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
											<?php 
												if(count($CRES)!=0){
													$i=1;foreach($CRES as $CR){
														$FID = $this->form_model->getCompanyForm($CR['company_id']);
														if($CR['score'] > 8)
															$SCRSTY = 'color:#b71c1c;font-weight:bold';
														elseif($CR['score'] > 7)
															$SCRSTY = 'color:#f44336;font-weight:bold';
														elseif($CR['score'] > 5)
															$SCRSTY = 'color:#ffd740;font-weight:bold';
														else
															$SCRSTY = 'color:#1b5e20;font-weight:bold';
											?>
												<tr id="list<?php echo $i;?>">
													<th align="center"><?php echo $i;?></th>
													<th><?php echo $CR['company_name'];?></th>
													<th><span style="<?php echo $SCRSTY;?>"><?php echo $CR['score'];?></span></th>
													<th><?php echo date("d-m-Y", strtotime($FID->rdt));?></th>
													<th>
														<a href="<?php echo base_url().'Company/viewCo/'.$CR['company_id'];?>"><i class="fas fa-eye fa-2x isLink" title="View"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
														<a href="<?php echo base_url().'Company/printCo/'.$CR['company_id'];?>" target="_blank"><i class="fas fa-print fa-2x isLink" title="Print"></i></a>
													</th>
												</tr>
											<?php $i++;}}else{?>
												<tr><th colspan="6"><center>No Company Found</center></th></tr>
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
			</div>
		</div>
		<?php $this->load->view('back/common/js.php'); ?>
		<script>
			$(document).ready(function(){
				$('#srtName').click(function() {
					$.ajax("<?php echo base_url();?>Ajax/setSort", {
						type: 'POST', 
						data: { sort: "company_name"},
						success: function (data, status, xhr) {location.reload(true);}
					});
				});
				$('#resetPg').click(function() {
					window.location.replace("<?php echo base_url();?>Company/New");
				});
				$("#addCompany").click(function() {
					window.location.replace("<?php echo base_url();?>/Form");
				});
			});
		</script>
	</body>
</html>