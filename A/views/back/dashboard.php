<?php defined('BASEPATH') OR exit('No direct script access allowed');$PG['PG']='H';?>
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
                                    	<h2 class="title-1">Overview</h2>
                                    	<?php echo $UBONAT;?>
                                    	<hr />
                                    	<?php echo $UBORES;?>
                                	</div>
                                	<div>
                                		<?php echo $CSVDATA;?>
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
	</body>
</html>