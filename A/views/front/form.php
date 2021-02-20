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
            <div class="nav-wrapper container">
                <a id="logo-container" href="#" class="brand-logo"><img src="<?php echo base_url().'assets/images/logo-big.png';?>" alt="logo" height="50" /></a>
                <ul class="right hide-on-med-and-down">
                    <li><a class="navMenu modal-trigger" href="#modal1">Our Pricing</a></li>
                    <li><a class="navMenu modal-trigger" href="#modal2">Privacy Policy</a></li>
                    <li><a class="navMenu modal-trigger" href="#modal3">Terms & Conditions</a></li>
                </ul>
                <ul id="nav-mobile" class="sidenav">
                    <li><a href="#">Navbar Link</a></li>
                </ul>
                <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
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
            <form action="<?php echo base_url();?>Form/validateForm" id="new_form" method="post" autocomplete="off">
                <?php # Company Information ?>
                <div class="row white">
                    <div class="col s12"><h4>Company Details</h4><hr /></div>
                    <div class="col s12">
                        <div class="input-field col s4"><h6>Name <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s7">
                            <input type="text" id="CD1" name="CD1" data-error=".errorCD1" aria-required="true" class="error" aria-invalid="true" />
                            <div class="errorCD1 red-text"></div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field col s4"><h6>Website <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s7">
                            <input type="text" id="CD2" name="CD2" data-error=".errorCD2" aria-required="true" class="error" aria-invalid="true" />
                            <div class="errorCD2 red-text"></div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field col s4"><h6>Registered On <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s7">
                            <input type="text" placeholder="dd-mm-yyyy" id="CD3" name="CD3" data-error=".errorCD3" aria-required="true" class="datepicker error" aria-invalid="true" />
                            <div class="errorCD3 red-text"></div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field col s4"><h6>Registered in <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s7">
                            <select id="CD4" name="CD4" class="error" data-error=".errorCD4" aria-required="true" aria-invalid="true">
                                <option value disabled selected>Choose the country</option>
                            <?php foreach ($CRES as $CR){ ?>
                                <option value="<?php echo $CR['iso'];?>"><?php echo ucwords(strtolower($CR['name']));?></option>
                            <?php }?>
                            </select>
                            <div class="errorCD4 red-text"></div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field col s4"><h6>Region that you operate in the most <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s7">
                            <select id="CD5" name="CD5" class="error" data-error=".errorCD5" aria-required="true" aria-invalid="true">
                                <option value disabled selected>Choose the region</option>
                            <?php foreach ($RRES as $RR){ ?>
                                <option value="<?php echo $RR['region_id'];?>"><?php echo ucwords(strtolower($RR['region_name']));?></option>
                            <?php }?>
                            </select>
                            <div class="errorCD5 red-text"></div>
                        </div>
                    </div>
                </div>
                <?php # Company ubo Information ?>
                <div class="row white">
                    <div class="col s12"><h4>Shareholder(s) & Ultimate Beneficial Owners(UBO)<div id="uboInf" class="right isStrong red-text" style="display:none;"></div></h4><hr /></div>
                    <div class="col s12">
                        <div class="input-field col s8"><h6>Indicate the number of companies nested as shareholder? (total number of institutions till the UBO) <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s3">
                            <input type="text" id="CUD" name="CUD" data-error=".errorCUD" aria-required="true" class="error isNum" aria-invalid="true" />
                            <div class="errorCUD red-text"></div>
                        </div>
                    </div>
                    <div class="fieldGroup">
                        <div class="col s12">
                            <div class="input-field col s12">
                                <span style="display: none"><input type="text" id="UBO" name="UBO" data-error=".errorUBO" aria-required="true" class="error hasDec" value="0" aria-invalid="true" /></span>
                                <div class="errorUBO red-text"></div>
                            </div>
                        </div>
                        <div class="col s12">
                            <div class="input-field col s3"><h6>UBO  Share %</h6></div>
                            <div class="input-field col s8">
                                <input type="text" id="UBO1" name="UBO1" data-error=".errorUBO1" aria-required="true" class="error hasDec ubo1" aria-invalid="true" />
                                <div class="errorUBO1 red-text"></div>
                            </div>
                        </div>
                        <div class="col s12">
                            <div class="input-field col s3"><h6>UBO Nationality</h6></div>
                            <div class="input-field col s8">
                                <select id="UBO2" name="UBO2" class="error" data-error=".errorUBO2" aria-required="true" aria-invalid="true">
                                    <option value disabled selected>Choose the nationality</option>
                                <?php foreach ($CRES as $CR){ ?>
                                    <option value="<?php echo $CR['iso'];?>"><?php echo ucwords(strtolower($CR['name']));?></option>
                                <?php }?>
                                </select>
                                <div class="errorUBO2 red-text"></div>
                            </div>
                        </div>
                        <div class="col s12">
                            <div class="input-field col s3"><h6>UBO Residence</h6></div>
                            <div class="input-field col s8">
                                <select id="UBO3" name="UBO3" class="error" data-error=".errorUBO3" aria-required="true" aria-invalid="true">
                                    <option value disabled selected>Choose the country</option>
                                <?php foreach ($CRES as $CR){ ?>
                                    <option value="<?php echo $CR['iso'];?>"><?php echo ucwords(strtolower($CR['name']));?></option>
                                <?php }?>
                                </select>
                                <div class="errorUBO3 red-text"></div>
                            </div>
                        </div>
                        <div class="col s12">
                            <table id="uboTbl" style="display:none">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>UBO SHARE</th>
                                        <th>UBO Nationality</th>
                                        <th>UBO Residence</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            <?php $runJS='';foreach($QCRES as $QC){?>
                <div class="row white">
                    <div class="col s12"><h4><?php echo $QC['name'];?></h4><hr /></div>
                <?php
                    $QRES = $this->question_model->getQuestCats($QC['category_id']);
                    $isHide = false;
                    foreach ($QRES as $QR) {
                        if($isHide){
                            echo '<div class="col s12" id="'.$HID.'" style="display:none">';
                            $isHide = false;
                            $HID='';
                        }else{
                            echo '<div class="col s12">';
                        }
                ?>
                        <?php if ($QR['quest_type']==4 || $QR['has_multiple']>1){?>
                        	<div class="input-field col s11">
                        <?php }else if ($QR['quest_type']==6){?>
                        	<div class="input-field col s8">
                        <?php }else{?>
                        	<div class="input-field col s4">
                        <?php }?>
                        <h6><?php echo $QR['title'];?><?php if($QR['isrequired']==1) echo '<span class="red-text strong">*</span>';?></h6></div>
                    <?php for($Z=0;$Z<$QR['has_multiple'];$Z++){?>
                        <?php if ($QR['quest_type']==4 || $QR['has_multiple']>1){?>
                        	<div class="input-field col s11">
                        <?php }else if ($QR['quest_type']==6){?>
                        	<div class="input-field col s4">
                        <?php }else{?><div class="input-field col s7"><?php }?>
                            <?php
                                switch($QR['quest_type']){
                                    case 1:
                                        echo '
                                            <input type="text" id="'.$QC['id'].$QR['question_id'].$Z.'" name="'.$QC['id'].$QR['question_id'].$Z.'" data-error=".error'.$QC['id'].$QR['question_id'].$Z.'" aria-required="true" class="error" aria-invalid="true" />
                                            <div class="error'.$QC['id'].$QR['question_id'].$Z.' red-text"></div>
                                        ';
                                        break;
                                    case 2:
                                        echo '
                                            <input type="email" id="'.$QC['id'].$QR['question_id'].$Z.'" name="'.$QC['id'].$QR['question_id'].$Z.'" data-error=".error'.$QC['id'].$QR['question_id'].$Z.'" aria-required="true" class="error" aria-invalid="true" />
                                            <div class="error'.$QC['id'].$QR['question_id'].$Z.' red-text"></div>
                                        ';
                                        break;
                                    case 3:
                                        echo '
                                            <input type="text" id="'.$QC['id'].$QR['question_id'].$Z.'" name="'.$QC['id'].$QR['question_id'].$Z.'" data-error=".error'.$QC['id'].$QR['question_id'].$Z.'" aria-required="true" class="error isNum" aria-invalid="true" />
                                            <div class="error'.$QC['id'].$QR['question_id'].$Z.' red-text"></div>
                                        ';
                                        break;
                                     case 11:
                                        echo '
                                            <i class="material-icons prefix">euro_symbol</i>
                                            <input type="text" id="'.$QC['id'].$QR['question_id'].$Z.'" name="'.$QC['id'].$QR['question_id'].$Z.'" data-error=".error'.$QC['id'].$QR['question_id'].$Z.'" aria-required="true" class="error money" aria-invalid="true" />
                                            <div class="error'.$QC['id'].$QR['question_id'].$Z.' red-text"></div>
                                        ';
                                        break;
                                    case 4:
                                        echo '
                                            <textarea id="'.$QC['id'].$QR['question_id'].$Z.'" name="'.$QC['id'].$QR['question_id'].$Z.'" data-error=".error'.$QC['id'].$QR['question_id'].$Z.'" aria-required="true" class="error materialize-textarea" aria-invalid="true"></textarea>
                                            <div class="error'.$QC['id'].$QR['question_id'].$Z.' red-text"></div>
                                        ';
                                        break;
                                    case 6:
                                        if($QR['quest_opt']=='HIDENEXT'){
                                            $isHide =true;
                                            $HID ='tog'.$QC['id'].$QR['question_id'].$Z;
                                            $runJS .='
                                                $("body").on("click","#'.$QC['id'].$QR['question_id'].$Z.'",function(){ 
                                                    $("#'.$HID.'").toggle();
                                                }); 
                                            ';
                                        }
                                        echo '
                                            <div class="switch">
                                                <label>No<input type="checkbox" id="'.$QC['id'].$QR['question_id'].$Z.'" name="'.$QC['id'].$QR['question_id'].$Z.'" value="Y"><span class="lever"></span>Yes</label>
                                            </div>';
                                        break;
                                    case 5:
                                        echo '<div class="row valign-wrapper">';
                                        $ARR = explode('|',$QR['quest_opt']);
                                        for($cb=0; $cb<sizeof($ARR);$cb++){
                                            echo '
                                                <div class="input-field col s3">
                                                    <label>
                                                        <input type="checkbox" name="'.$QC['id'].$QR['question_id'].$Z.'[]" aria-required="true" aria-invalid="true" data-error=".error'.$QC['id'].$QR['question_id'].$Z.'" value="'.$ARR[$cb].'"><span>'.$ARR[$cb].'</span>
                                                    </label>
                                                </div>
                                            ';
                                        }
                                        echo '</div><div class=".error'.$QC['id'].$QR['question_id'].$Z.' red-text"></div>';
                                        break;
                                    case 8:
                                        if($Z > 0)
                                            echo '<select id="'.$QC['id'].$QR['question_id'].$Z.'" name="'.$QC['id'].$QR['question_id'].$Z.'"><option value disabled selected>Choose the country</option>';
                                        else
                                            echo '<select id="'.$QC['id'].$QR['question_id'].$Z.'" name="'.$QC['id'].$QR['question_id'].$Z.'" data-error=".error'.$QC['id'].$QR['question_id'].$Z.'" aria-required="true" aria-invalid="true"><option value disabled selected>Choose the country</option>';
                                        foreach ($CRES as $CR){ 
                                            echo '<option value="'.$CR['iso'].'">'.ucwords(strtolower($CR['name'])).'</option>';
                                        }
                                        echo '</select><div class="error'.$QC['id'].$QR['question_id'].$Z.' red-text"></div>';
                                        break;
                                    case 9:
                                        if($Z > 0)
                                            echo '<select id="'.$QC['id'].$QR['question_id'].$Z.'" name="'.$QC['id'].$QR['question_id'].$Z.'"><option value disabled selected>Choose the region</option>';
                                        else
                                            echo '<select id="'.$QC['id'].$QR['question_id'].$Z.'" name="'.$QC['id'].$QR['question_id'].$Z.'" data-error=".error'.$QC['id'].$QR['question_id'].$Z.'" aria-required="true" aria-invalid="true"><option value disabled selected>Choose the region</option>';
                                        foreach ($RRES as $RR){ 
                                            echo '<option value="'.$RR['region_id'].'">'.ucwords(strtolower($RR['region_name'])).'</option>';
                                        }
                                        echo '</select><div class="error'.$QC['id'].$QR['question_id'].$Z.' red-text"></div>';
                                        break;
                                    case 10:
                                        if($Z > 0)
                                            echo '<select id="'.$QC['id'].$QR['question_id'].$Z.'" name="'.$QC['id'].$QR['question_id'].$Z.'"><option value disabled selected>Choose the industry</option>';
                                        else
                                            echo '<select id="'.$QC['id'].$QR['question_id'].$Z.'" name="'.$QC['id'].$QR['question_id'].$Z.'" data-error=".error'.$QC['id'].$QR['question_id'].$Z.'" aria-required="true" aria-invalid="true"><option value disabled selected>Choose the industry</option>';
                                        foreach ($IRES as $IR){ 
                                            echo '<option value="'.$IR['industry_id'].'">'.ucwords(strtolower($IR['industry_name'])).'</option>';
                                        }
                                        echo '</select><div class="error'.$QC['id'].$QR['question_id'].$Z.' red-text"></div>';
                                        break;
                                }
                            ?>
                            <?php if($QR['quest_desc']!='') echo '<span class="helper-text" data-error="wrong" data-success="right" style="color:green;font-size:10px">'.$QR['quest_desc'].'</span>';?>
                        </div>
                    <?php }?>
                    </div>
                <?php }?>
                </div>
            <?php }?>
                <?php # Form Information ?>
                <div class="row white">
                    <div class="col s12"><h4>Form Details</h4><hr /></div>
                    <div class="col s12">
                        <div class="input-field col s3"><h6>Your First Name <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s8">
                            <input type="text" id="FD1_1" name="FD1_1" data-error=".errorFD1_1" aria-required="true" class="error" aria-invalid="true" />
                            <div class="errorFD1_1 red-text"></div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field col s3"><h6>Your Surname <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s8">
                            <input type="text" id="FD1_2" name="FD1_2" data-error=".errorFD1_2" aria-required="true" class="error" aria-invalid="true" />
                            <div class="errorFD1_2 red-text"></div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field col s3"><h6>Your Email <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s8">
                            <input type="email" id="FD2" name="FD2" data-error=".errorFD2" aria-required="true" class="error" aria-invalid="true" />
                            <div class="errorFD2 red-text"></div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field col s3"><h6>Your Phone <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s3">
                            <select id="FD3_1" name="FD3_1" class="error" data-error=".errorFD3_1" aria-required="true" aria-invalid="true">
                                <option value disabled selected>Choose the Dialing Code</option>
                            <?php foreach ($CRES as $CR){ ?>
                                <option value="<?php echo $CR['phonecode'];?>"><?php echo ucwords(strtolower($CR['name'])).' (+'.ucwords(strtolower($CR['phonecode'])).')';?></option>
                            <?php }?>
                            </select>
                            <div class="errorFD3_1 red-text"></div>
                        </div>
                        <div class="input-field col s5">
                            <input type="text" id="FD3" name="FD3" data-error=".errorFD3" aria-required="true" class="error isNum" aria-invalid="true" />
                            <div class="errorFD3 red-text"></div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field col s3"><h6>Your Role <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s8">
                            <select id="FD4" name="FD4" class="error" data-error=".errorFD4" aria-required="true" aria-invalid="true">
                                <option value disabled selected>Choose the Role</option>
                                <option value="Director">Director</option>
                                <option value="Shareholder">Shareholder</option>
                                <option value="Employee">Employee</option>
                                <option value="Consultant">Consultant</option>
                            </select>
                            <div class="errorFD4 red-text"></div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field col s3"><h6>How do you hear about Us <span class="red-text strong">*</span></h6></div>
                        <div class="input-field col s8">
                            <select id="FD5" name="FD5" class="error" data-error=".errorFD5" aria-required="true" aria-invalid="true">
                                <option value disabled selected>Choose the source</option>
                            <?php foreach ($RES as $R){ ?>
                                <option value="<?php echo $R['id'];?>"><?php echo ucwords($R['name']);?></option>
                            <?php }?>
                            </select>
                            <div class="errorFD5 red-text"></div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field col s12">
                            <p>By submitting this form, I understand the information provided by me is a pre-requisite for account application process and will be used in order to assess the eligibility of the company. Furthermore, I declare that the information contained in this application is true and accurate to the best of my knowledge, information and belief and that, if any of the information contained in or appended to this application is discovered to be false, I may be reportable to the necessary authorities and may be liable to prosecution.</p>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field col s12">
                            <center>
                                <div class="g-recaptcha" data-sitekey="6Lc6OfcUAAAAAKAeZoEA1OI6DA5KL4nneo8ElznU" data-callback="correctCaptcha"></div>
                                <input type="hidden" id="GR" name="GR" data-error=".errorGR" aria-required="true" class="error" aria-invalid="true" />
                                <div class="errorGR red-text"></div>
                            </center>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field col s12 center-align">
                            <button class="btn black strong waves-effect btn-large waves-light strong" type="submit" name="action">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php $this->load->view('front/modals.php'); ?>
        <script src="<?php echo base_url().'assets/vendor/jquery-3.2.1.min.js';?>"></script>
        <script src="<?php echo base_url().'assets/vendor/materialize/materialize.min.js';?>"></script>
        <script src="<?php echo base_url().'assets/vendor/jquery.validate.min.1.19.1.js';?>"></script>
        <script src="<?php echo base_url().'assets/vendor/autoNumeric.js';?>"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script>
            function getUboCount(){
                let ubo_total = 0;
                $('input[name^="ubo1"]').each(function() {
                    ubo_total +=parseFloat($(this).val());
                });
                $('#uboInf').html("Total Share: "+ubo_total+"%");
                return ubo_total;
            }
            $(window).on("load", function () {
                $(".loader").fadeOut();
                $("#preloader").delay(350).fadeOut("slow");
            });
            $("body").on("click","#profile_question_4",function(){ 
                $("#la-opt").toggle();
            }); 
            var correctCaptcha = function(response) {
                $("#GR").val("aaaa");
            };
            $(document).ready(function() {
            	$('.money').autoNumeric('init');
                
                $('.modal').modal();
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
                let counterVar=1;
                let ubost=0;
                $('#UBO3').on('change', function(){
                    if($('#UBO1').val()!='' || $('#UBO2').val()!='' && ubost < 100){
                        $('#uboTbl').append('<tr class="UBOROW"><td>'+counterVar+'</td><td><input type="hidden" name="ubo1[]" id="ubo1" class="ubo1 error" data-error=".errorUBO1" aria-required="true" aria-invalid="true" value="'+$('#UBO1').val()+'"/>'+$('#UBO1').val()+'</td><td><input type="hidden" id="ubo2" name="ubo2[]" class="error" data-error=".errorUBO2" aria-required="true" aria-invalid="true" value="'+$('#UBO2').val()+'"/>'+$('#UBO2').val()+'</td><td><input id="ubo3" type="hidden" name="ubo3[]" class="error" data-error=".errorUBO3" aria-required="true" aria-invalid="true" value="'+$('#UBO3').val()+'"/>'+$('#UBO3').val()+'</td><td><i class="material-icons isLnk delUbo">delete_forever</i></td></tr>');
                        counterVar += 1;
                        ubost += parseFloat($('#UBO1').val());
                        $('#uboInf').show();
                        $('#uboTbl').show();
                        $('#uboInf').html("Total Share: "+ubost+"%");
                        $('#UBO').val(ubost);
                        if(ubost < 100){
                            alert("Please add another UBO/Shareholder");
                            $('#UBO1').val('');
                            $('#UBON').val("");
                            $('#UBO3').prop('selectedIndex',0);
                        }else if(ubost > 100){
                            alert("It looks like we have gone over 100%");
                        }else{
                            alert("We are at 100%");
                        }
                    }else{
                        if(ubost > 100){
                            alert("It looks like we have gone over 100%");
                        }
                        $('#UBO3').val("");
                        $('#UBON').val("");
                    }
                });
                $("body").on("click",".delUbo",function(){ 
                    let ans = confirm("Please confirm UBO deletion?");
                    if(ans){
                        $(this).parents(".UBOROW").remove();
                        ubost = getUboCount();
                        if(ubost < 100){
                            alert("Please add another UBO/Shareholder");
                            $('#UBO1').val('');
                            $('#UBON').val("");
                            $('#UBO3').prop('selectedIndex',0);
                        }else if(ubost > 100){
                            alert("It looks like we have gone over 100%");
                        }else{
                            alert("We are at 100%");
                        }
                    }
                });
                <?php echo $runJS;?>
                $('.datepicker').datepicker({format:"dd-mm-yyyy",changeMonth: true,changeYear: true,});
                $('.modal').modal();
                $('select').formSelect();
                $("#new_form").validate({
                    ignore: [],
                    rules: {
                        CD1     : "required",
                        CD2     : "required",
                        CD3     : "required",
                        CD4     : "required",
                        CD5     : "required",
                        CUD     : "required",
                        UBO     : {required: true, min:100},
                        <?php 
                            foreach($QCRES as $QC){
                                $QRES = $this->question_model->getQuestCats($QC['category_id']);
                                $TEMPID = '';
                                foreach ($QRES as $QR) {
                                    for($Z=0;$Z<$QR['has_multiple'];$Z++){
                                        if($QR['quest_opt']=='HIDENEXT'){
                                            $TEMPID = $QC['id'].$QR['question_id'].$Z;
                                        }
                                        if($QR['isrequired']==1 && $Z < 1){
                                            switch($QR['quest_type']){
                                                case 2:
                                                    echo $QC['id'].$QR['question_id'].$Z.':{required: true, email:true},';
                                                    break;
                                                case 5:
                                                    echo "'".$QC['id'].$QR['question_id'].$Z."[]'".': "required",';
                                                    break;
                                                default:
                                                    if($TEMPID!=''){
                                                        echo $QC['id'].$QR['question_id'].$Z.': {required: function(element){return $("#'.$TEMPID.'").is(":checked");}},';
                                                        $TEMPID='';
                                                    }else{
                                                        echo $QC['id'].$QR['question_id'].$Z.': "required",';    
                                                    }
                                                    
                                                    break;
                                            }
                                        }
                                    }
                                }
                            }
                        ?>
                        FD1_1     : "required",
                        FD1_2     : "required",
                        FD2     : {required: true, email:true},
                        FD3_1   : "required",
                        FD3     : "required",
                        FD4     : "required",
                        FD5     : "required",
                        GR      : "required",
                    },
                    messages: {
                        UBO:{
                            required: "Please enter the below details",
                            min: "Please enter all the UBO"
                        }
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