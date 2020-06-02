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
			<div class="page-content--bge5">
				<div class="container">
					<div class="login-wrap">
						<div class="login-content">
							<div class="login-logo">
								<img src="<?php echo base_url().'assets/images/logo.png';?>" alt="">
							</div>
							<div class="login-form">
								<form method="post" id="loginFrm" name="loginFrm" class="needs-validation" novalidate action="<?php echo base_url();?>admin/validlogin">
									<?php if($ERR!=''){?>
										<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show" role="alert">
											<?php echo $ERR;?>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button>
										</div>
									<?php }?>
									<div class="form-group">
										<input type="email" data-error=".errorEml" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="Username/Email" required="required" name="user_email" id="user_email" autofocus autocomplete="off" />
										<div class="errorEml red-text"></div>
									</div>
									<div class="form-group">
										<input type="password" data-error=".errorPwd" aria-required="true" aria-invalid="true" class="error au-input au-input--full" placeholder="Password" required="required" name="user_password" id="user_password" autocomplete="off" />
										<div class="errorPwd red-text"></div>
									</div>
									<div class="login-checkbox" style="display:none">
										<label><a href="#">Forgotten Password?</a></label>
									</div>
									<button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Sign In</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('back/common/js.php'); ?>
		<script>
			$(document).ready(function() {
				$("#loginFrm").validate({
                    rules: {
                        user_email      : {required: true, email:true},
                        user_password 	: "required",
                    },
                    messages: {
                        user_email      : {required: "Please Enter Your Username/Email.", email: "Please Enter A Valid Email."},
                        user_password 	: "Please Enter Your Password.",
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