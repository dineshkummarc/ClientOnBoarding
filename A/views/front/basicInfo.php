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
        <div class="container">
            <div class="row valign-wrapper">
                <div class="col s12 m6">
                    <h2>Account Opening - Business Profile</h2>
                </div><div class="col s12 m6 right-align">
                    <span class="red-text darken-4">Fields marked with an * are required</span>
                </div>
            </div>
            <form action="<?php echo base_url();?>Form/validateInf" id="new_form" method="post" autocomplete="off">
                <?php # Company Information ?>
                <div class="row white">
                    <div class="col s12"><h4><?php echo $CROW->company_name;?></h4><hr /></div>
                    <div class="col s12">
                        <div class="input-field col s4"><h6>Company Type <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s7">
							<select id="CD1" name="CD1" class="error" data-error=".errorCD1" aria-required="true" aria-invalid="true">
								<option value disabled selected>-- Please Select --</option>
								<option value="1" <?php if ($CROW->company_type==1) echo 'selected="selected"'?>>Private Ltd. Liability</option>
								<option value="2" <?php if ($CROW->company_type==2) echo 'selected="selected"'?>>Public Ltd. Liability</option>
								<option value="3" <?php if ($CROW->company_type==3) echo 'selected="selected"'?>>Limited Liability Company</option>
								<option value="3" <?php if ($CROW->company_type==4) echo 'selected="selected"'?>>Other</option>
							</select>
							<div class="errorCD1 red-text"></div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field col s4"><h6>Website <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s7">
                            <input type="text" id="CD2" name="CD2" data-error=".errorCD2" aria-required="true" class="error" aria-invalid="true" value="<?php echo $CROW->company_www;?>" />
                            <div class="errorCD2 red-text"></div>
                        </div>
                    </div>
					<div class="col s12">
                        <div class="input-field col s4"><h6>Currency <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s7">
                            <select id="CD3" name="CD3" class="error" data-error=".errorCD3" aria-required="true" aria-invalid="true">
								<option value="1" <?php if ($CROW->company_curr==1) echo 'selected="selected"'?>>EURO</option>
								<option value="2" <?php if ($CROW->company_curr==2) echo 'selected="selected"'?>>USD</option>
								<option value="3" <?php if ($CROW->company_curr==3) echo 'selected="selected"'?>>GBP</option>
								<option value="3" <?php if ($CROW->company_curr==4) echo 'selected="selected"'?>>Other</option>
							</select>
                            <div class="errorCD3 red-text"></div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field col s4"><h6>Registration # <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s7">
                            <input type="text" id="CD4" name="CD4" data-error=".errorCD4" aria-required="true" class="error" aria-invalid="true" value="<?php echo $CROW->reg_number;?>" />
                            <div class="errorCD4 red-text"></div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field col s4"><h6>Date of Registration <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s7">
                            <input type="text" id="CD5" name="CD5" data-error=".errorCD5" aria-required="true" class="error" aria-invalid="true" value="<?php echo date("d-m-Y", strtotime($CROW->reg_dt));?>" />
                            <div class="errorCD5 red-text"></div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field col s4"><h6>Registered Address <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s7">
                            <textarea id="CD6" name="CD6" data-error=".errorCD6" aria-required="true" class="error materialize-textarea" aria-invalid="true"><?php echo $CROW->reg_addr;?></textarea>
                            <div class="errorCD6 red-text"></div>
                        </div>
                    </div><div class="col s12">
                        <div class="input-field col s4"><h6>Registered Country <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s7">
                             <select id="CD7" name="CD7" class="error" data-error=".errorCD7" aria-required="true" aria-invalid="true">
                                <option value disabled selected>Choose the country</option>
                            <?php foreach ($CRES as $CR){ ?>
                                <option value="<?php echo $CR['iso3'];?>" <?php if($CROW->reg_country==$CR['iso3']) echo 'selected="selected"'?>><?php echo ucwords(strtolower($CR['name']));?></option>
                            <?php }?>
                            </select>
                            <div class="errorCD7 red-text"></div>
                        </div>
                    </div><div class="col s12">
                        <div class="input-field col s4"><h6>Operation Address <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s7">
                            <textarea id="CD8" name="CD8" data-error=".errorCD8" aria-required="true" class="error materialize-textarea" aria-invalid="true"><?php echo $CROW->oper_addr;?></textarea>
                            <div class="errorCD8 red-text"></div>
                        </div>
                    </div><div class="col s12">
                        <div class="input-field col s4"><h6>Operation Country <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s7">
                             <select id="CD9" name="CD9" class="error" data-error=".errorCD9" aria-required="true" aria-invalid="true">
                                <option value disabled selected>Choose the country</option>
                            <?php foreach ($CRES as $CR){ ?>
                                <option value="<?php echo $CR['iso3'];?>" <?php if($CROW->oper_country==$CR['iso3']) echo 'selected="selected"'?>><?php echo ucwords(strtolower($CR['name']));?></option>
                            <?php }?>
                            </select>
                            <div class="errorCD9 red-text"></div>
                        </div>
                    </div><div class="col s12">
                        <div class="input-field col s4"><h6>Operation Region <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s7">
                            <select id="CD10" name="CD10" class="error" data-error=".errorCD10" aria-required="true" aria-invalid="true">
                                <option value disabled selected>Choose the country</option>
                            <?php foreach ($RRES as $RR){ ?>
                                <option value="<?php echo $RR['region_id'];?>" <?php if($CROW->oper_region==$RR['region_id']) echo 'selected="selected"'?>><?php echo ucwords(strtolower($RR['region_name']));?></option>
                            <?php }?>
                            </select>
                            <div class="errorCD10 red-text"></div>
                        </div>
                    </div><div class="col s12">
                        <div class="input-field col s4"><h6>Tax Number <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s7">
                            <input type="text" id="CD11" name="CD11" data-error=".errorCD11" aria-required="true" class="error" aria-invalid="true" value="<?php echo $CROW->tax_number;?>" /></th>
                            <div class="errorCD11 red-text"></div>
                        </div>
                    </div><div class="col s12">
                        <div class="input-field col s4"><h6>Tax Country <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s7">
                             <select id="CD12" name="CD12" class="error" data-error=".errorCD12" aria-required="true" aria-invalid="true">
                                <option value disabled selected>Choose the country</option>
                            <?php foreach ($CRES as $CR){ ?>
                                <option value="<?php echo $CR['iso3'];?>" <?php if($CROW->tax_country==$CR['iso3']) echo 'selected="selected"'?>><?php echo ucwords(strtolower($CR['name']));?></option>
                            <?php }?>
                            </select>
                            <div class="errorCD12 red-text"></div>
                        </div>
                    </div>
                    <div class="col s12">
                        <input type="hidden" name="cid" value="<?php echo $CID;?>" />
                        <div class="input-field col s12 center-align">
                            <button class="btn black strong waves-effect btn-large waves-light strong" type="submit" name="action">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script src="<?php echo base_url().'assets/vendor/jquery-3.2.1.min.js';?>"></script>
        <script src="<?php echo base_url().'assets/vendor/materialize/materialize.min.js';?>"></script>
        <script src="<?php echo base_url().'assets/vendor/jquery.validate.min.1.19.1.js';?>"></script>
        <script>
            $(window).on("load", function () {
                $(".loader").fadeOut();
                $("#preloader").delay(350).fadeOut("slow");
            });
            $(document).ready(function() {
                $(".hasDec").on("keyup", function () {
                    var valid = /^\d{0,9}(\.\d{0,2})?$/.test(this.value);
                    val = this.value;
                    if (!valid) {
                        var dotCheck = val.indexOf("..");
                        if (dotCheck >= 0) {
                            val = val.replace("..", ".");
                        }
                        val = val.replace(/(\.)(.)(\.)/g, ".$2");
                        val = val.replace(/,/g, "");
                        val = val.replace(/[^0-9.]/g, "");
                        var totalLength = val.length;
                        var only2DecimalsCount = val.indexOf(".");
                        if (only2DecimalsCount >= 0 && totalLength > (only2DecimalsCount + 2)) {
                            val = val.substring(0, (only2DecimalsCount + 3));
                        }
                        this.value = val;
                    }
                });
                $('.isNum').bind('keyup paste', function(){
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
                $('.datepicker').datepicker({format:"dd-mm-yyyy"});
                $('select').formSelect();
                $("#new_form").validate({
                    ignore: [],
                    rules: {
                        CD1 : "required",
                        CD2 : "required",
                        CD3 : "required",
                        CD4 : "required",
                        CD5 : "required",
                        CD6 : "required",
                        CD7 : "required",
                        CD8 : "required",
                        CD9 : "required",
                        CD10 : "required",
                        CD11 : "required",
                        CD12 : "required"
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