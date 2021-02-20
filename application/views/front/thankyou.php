<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Account Opening - Business Profile</title>
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url();?>assets/images/favicon-32x32.png" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700&display=swap" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <link rel="stylesheet" href="<?php echo base_url().'assets/vendor/materialize/materialize.min.css';?>" />
        <link rel="stylesheet" href="<?php echo base_url().'assets/theme.css';?>" />
    </head>
    <body>
        <?php $this->load->view('front/loader.php'); ?>
        <nav class="white" role="navigation">
            <div class="nav-wrapper container" style="text-align: center">
                <a id="logo-container" href="#" class="brand-logo"><img src="<?php echo base_url().'assets/images/logo-big.png';?>" alt="logo" height="50" /></a>
            </div>
        </nav>
        <div class="container" align="center">
            <div class="row valign-wrapper">
                <div class="col s12">
                    <h1>Thank You</h1>
                </div>
            </div>
            <div class="row valign-wrapper">
                <div class="col s12">
                    <?php if($ERR!=''){?>
                        <h3>We encountered an error. Please send the below messge to support</h3>
                        <p><?php echo $ERR;?></p>
                    <?php }else{?>
                        <h3>We will review your application and get back you shortly.</h3>
                    <?php }?>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url().'assets/vendor/jquery-3.2.1.min.js';?>"></script>
        <script src="<?php echo base_url().'assets/vendor/materialize/materialize.min.js';?>"></script>
        <script src="<?php echo base_url().'assets/vendor/jquery.validate.min.1.19.1.js';?>"></script>
        <script>
            $(window).on("load", function () {
                $(".loader").fadeOut();
                $("#preloader").delay(350).fadeOut("slow");
            });
        </script>
    </body>
</html>