<?php $TYP=1;?>
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
        <?php #$this->load->view('front/loader.php'); ?>
        <div class="container">
            <div class="row valign-wrapper">
                <div class="col s12">
                    <h2 align="center"><?php echo $CROW->company_name;?> - Company Structure</h2>
                </div>
            </div><hr />
            <div class="row">
                <div class="col m2">
                    <ul>
                        <li>
                            <h4 class="isLnk" id="addC">Add Company</h4>
                            <span id="tbC" class="input-field" style="display:none;">
                                <input type="text" name="Company" id="cnm"><i class="material-icons" id="cnmAdd">add_circle</i>
                            </span>
                        </li>
                        <li>
                            <h4 class="isLnk" id="addD">Add Director</h4>
                            <span id="tbD" class="input-field" style="display:none;">
                                <input type="text" name="Director" id="dnm"><i class="material-icons" id="dnmAdd">add_circle</i>
                            </span>
                        </li>
                        <li>
                            <h4 class="isLnk" id="addU">Add UBO</h4>
                            <span id="tbU" class="input-field" style="display:none;">
                                <input type="text" name="UBO" id="unm"><i class="material-icons" id="unmAdd">add_circle</i>
                            </span>
                        </li>
                    </ul>
                    <hr />
                    <h4>Legend:</h4>
                    <span style="background-color:#f57f17;color:#ffffff;padding:10px;width:150px"><b>Company</b></span><br />
                    <span style="background-color:#6a1b9a;color:#ffffff;padding:10px;width:150px"><b>Director</b></span><br />
                    <span style="background-color:#01579b;color:#ffffff;padding:10px;width:150px"><b>UBO</b></span><br />
                    <span style="background-color:#2e7d32;color:#ffffff;padding:10px;width:150px"><b>Main Company</b></span><hr />
                    <p>Notes:<br />
                    You can drag to position items in the white box.
                    To delete just click on an item and press the delete key.
                    To link a company just Drag it to either a company, ubo or director.<br /><br /></p>
                    <button class="btn black strong waves-effect btn-sm waves-light strong" id="saveMe" name="action">Submit</button>
                </div>
                <div class="col m10">
                    <div id="myDiagramDiv" style="width:auto; height:800px; background-color: #ffffff;"></div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url().'assets/vendor/jquery-3.2.1.min.js';?>"></script>
        <script src="<?php echo base_url().'assets/vendor/materialize/materialize.min.js';?>"></script>
        <script src="<?php echo base_url().'assets/vendor/go-debug.js';?>"></script>
        <script>
            let dataArray = [{ key: "0", name: "<?php echo $CROW->company_name;?>", typ: "#2e7d32" },];
            let nCnt = 1;
            $(window).on("load", function () {
                $(".loader").fadeOut();
                $("#preloader").delay(350).fadeOut("slow");
            });
            $("#addC").click(function() {$("#tbC").show();});
            $("#addD").click(function() {$("#tbD").show();});
            $("#addU").click(function() {$("#tbU").show();});
            $("#cnmAdd").click(function() {
                let nm = $("#cnm").val();
                $("#cnm").val("");
                model.addNodeData({ key:nCnt, name: nm, typ: "#f57f17"});
                nCnt++;
                $("#tbC").hide();
            });
            $("#dnmAdd").click(function() {
                let nm = $("#dnm").val();
                $("#dnm").val("");
                model.addNodeData({ key:nCnt, name: nm, typ: "#6a1b9a"});
                nCnt++;
                $("#tbD").hide();
            });
            $("#unmAdd").click(function() {
                let nm = $("#unm").val();
                $("#unm").val("");
                model.addNodeData({ key:nCnt, name: nm, typ: "#01579b"});
                nCnt++;
                $("#tbU").hide();
            });

            <?php
                /*
                PARENT CO:  2e7d32
                UBO:        01579b
                SHARE CO:   f57f17
                DIRECTORS:  6a1b9a
                */
            ?>
            <?php $i=1;foreach($URES as $UR){?>
                dataArray.push({ key:nCnt, name: "UBO<?php echo $i;?> (<?php echo $UR['ubo_share'];?>%)", typ: "#01579b" });
                nCnt++;
            <?php $i++;}?>
            var GO = go.GraphObject.make;
            var myDiagram =
                GO(go.Diagram, "myDiagramDiv",{"undoManager.isEnabled": true,layout: GO(go.TreeLayout, {angle: 90, layerSpacing: 35})});    
            myDiagram.nodeTemplate =
                GO(go.Node, "Auto",
                    GO(go.Shape, "RoundedRectangle", {fill:"white", portId:"", fromLinkableDuplicates: true, toLinkableDuplicates: true, fromLinkable: true, toLinkable: true}, new go.Binding("fill", "typ")),
                    GO(go.TextBlock, "Default Text", {margin:15, stroke: "white", font: "bold 16px sans-serif" }, new go.Binding("text", "name"))
                );
            
            myDiagram.linkTemplate = GO(go.Link,{ routing: go.Link.Orthogonal, corner: 5 },GO(go.Shape, { strokeWidth: 3, stroke: "#555" }));
            var model = GO(go.TreeModel);
            model.nodeDataArray = dataArray;
            let modelAsText ='';
            <?php if($SROW->info!=''){?>
                modelAsText = <?php echo $SROW->info;?>;
                myDiagram.model = go.Model.fromJson(modelAsText);
            <?php $TYP=0;}else{?>
                myDiagram.model = model;
            <?php }?>
            $("#saveMe").click(function() {
                $.ajax("<?php echo base_url();?>Ajax/savStru", {
                    type: 'POST', 
                    data: { typ: <?php echo $TYP;?>,cid: <?php echo $CROW->company_id?>, inf: myDiagram.model.toJson()},
                    success: function (data, status, xhr) {location.reload(true);}
                });
                console.log();
            });
        </script>
    </body>
</html>