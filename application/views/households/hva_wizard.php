<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>HES | HVA Wizard</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo $includes_dir; ?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $includes_dir; ?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $includes_dir; ?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $includes_dir; ?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo $includes_dir; ?>global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo $includes_dir; ?>global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $includes_dir; ?>global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo $includes_dir; ?>global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo $includes_dir; ?>global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo $includes_dir; ?>layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $includes_dir; ?>layouts/layout4/css/themes/light.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo $includes_dir; ?>layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 

        <script type="text/javascript">
            function getConstituencies(iid) {
                var baseURL = "http://" + window.location.host + "/hes/";
                var url = baseURL + "ajax/getConstituencies/";
                $.ajax({
                    cache: false,
                    type: "post",
                    url: url,
                    data: {'countyId': iid},
                    beforeSend: function () {

                        $("#loadConstituency").html("<img src='" + baseURL + "resources/layouts/layout4/img/ajax-loading.gif' />");
                    },
                    success: function (data) {
                        $("#constituency").html(data);
                        $("#loadConstituency").html("");
                    }
                });
            }

            function getWards(iid) {
                var baseURL = "http://" + window.location.host + "/hes/";
                var url = baseURL + "ajax/getwards_hva/";
                $.ajax({
                    cache: false,
                    type: "post",
                    url: url,
                    data: {'constId': iid},
                    beforeSend: function () {

                        $("#loadWard").html("<img src='" + baseURL + "resources/layouts/layout4/img/ajax-loading.gif' />");
                    },
                    success: function (data) {
                        $("#ward").html(data);
                        $("#loadWard").html("");
                    }
                });
            }
            /* function loadDistricts(iid) {
             var baseURL = "http://" + window.location.host + "/hes/";
             var url = baseURL + "ajax/loadDistricts/";
             $.ajax({
             cache: false,
             type: "post",
             url: url,
             data: {'countyId': iid},
             beforeSend: function () {
             
             $("#loader1").html("<img src='" + baseURL + "resources/layouts/layout4/img/ajax-loading.gif' />");
             },
             success: function (data) {
             
             $("#district").html(data);
             $("#loader1").html("");
             }
             });
             }*/

            function loadCBO(iid) {
                var baseURL = "http://" + window.location.host + "/hes/";
                var url = baseURL + "ajax/loadCBO/";
                $.ajax({
                    cache: false,
                    type: "post",
                    url: url,
                    data: {'ward': iid},
                    beforeSend: function () {

                        $("#cbo_loader").html("<img src='" + baseURL + "resources/layouts/layout4/img/ajax-loading.gif' />");
                    },
                    success: function (data) {
                        
                       // alert(data);
                        $("#cbo").html(data);
                      $("#cbo_loader").html("");
                    }
                });
                 }
                 
                 function initiate_wizard(cbo,chv,serial,datez)
                 {
                  var baseURL = "http://" + window.location.host + "/hes/";
                var url = baseURL + "ajax/initiate_wizard/";
                $.ajax({
                    cache: false,
                    type: "post",
                    url: url,
                    data: {'cbo': cbo,'chv':chv,'serial':serial,'datez':datez},
                    
                    
                     beforeSend: function ()
                     {
                      alert('You are on track.Now lets define the CBO household characteristics....');
                     },
                    success: function (data) {
                        
                      //alert(data);
                        $("#rowidz").html(data);
                    }
                });   
                 }
        </script>

    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
        <!-- BEGIN HEADER -->
        <?php $this->load->view('includes/header'); ?>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <?php $this->load->view('includes/sidebar'); ?> 
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Household Vulnerability Assessment 

                            </h1>
                        </div>
                        <!-- END PAGE TITLE -->

                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="javascript:;">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">HVA Tool</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">

                            <div class="portlet light bordered" id="form_wizard_1">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-red"></i>
                                        <span class="caption-subject font-red bold uppercase">HVA &nbsp;
                                            <span class="step-title"> Step 1 of 5 </span>
                                        </span>
                                    </div>

                                </div>
                                <div class="portlet-body form">
                                    <?php echo $this->session->flashdata('dispMessage'); ?>
                                    <!--<form class="form-horizontal" action="#" id="submit_form" method="POST">-->
                                       <?php //echo form_open_multipart(current_url(),array('method'=>'post','id' => 'submit_form',  'class' => 'form-horizontal','novalidate' => 'novalidate' )) ?> 
 <?php echo form_open("hva/save_data",array('method'=>'post','id' => 'submit_form',  'class' => 'form-horizontal','novalidate' => 'novalidate' ));?>
                                        <div class="form-wizard">
                                            <div class="form-body">
                                                <ul class="nav nav-pills nav-justified steps">
                                                    <li>
                                                        <a href="#tab0" data-toggle="tab" class="step">
                                                            <span class="number"> 1 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i>Initial Details</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab1" data-toggle="tab" class="step">
                                                            <span class="number"> 2 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i>Criteria A & B</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab2" data-toggle="tab" class="step">
                                                            <span class="number"> 3 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i>Criteria C & E</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab3" data-toggle="tab" class="step active">
                                                            <span class="number"> 4 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i>Criteria E & F</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab4" data-toggle="tab" class="step">
                                                            <span class="number"> 5 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i>Summary</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div id="bar" class="progress progress-striped" role="progressbar">
                                                    <div class="progress-bar progress-bar-success"> </div>
                                                </div>
                                                <div class="tab-content">
                                                    <div class="alert alert-danger display-none">
                                                        <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. </div>
                                                    <div class="alert alert-success display-none">
                                                        <button class="close" data-dismiss="alert"></button> Your form validation is successful! </div>
                                                    <div class="tab-pane active" id="tab0">
                                                        <h4 class="block">Inputs marked in asterisk are compulsory</h4>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">County</label>
                                                            <div class="col-md-4">
                                                                <select class="form-control" name="county" id="county" onChange="getConstituencies(document.getElementById('county').value)" required>
                                                                    <option value="">Select County</option>
                                                                    <?php
                                                                    foreach ($county as $key => $value) {
                                                                        ?>
                                                                        <option value="<?php echo $value->id ?>"><?php echo $value->county_name ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <span id="loadConstituency"></span>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Sub County</label>
                                                            <div class="col-md-4">
                                                                <select class="form-control" name="constituency" id="constituency" onChange="getWards(document.getElementById('constituency').value)" required>
                                                                    <option value="">Select Constituency</option>
                                                                    <?php
                                                                    foreach ($constituency as $key => $value) {
                                                                        ?>
                                                                        <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <span id="loadWard"></span>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Ward</label>
                                                            <div class="col-md-4">
                                                                <select class="form-control" name="ward" id="ward" onChange="loadCBO(document.getElementById('ward').value)"  required>
                                                                    <option value="">Select ward</option>
                                                                    <?php
                                                                    foreach ($ward as $key => $value) {
                                                                        ?>
                                                                        <option value="<?php echo $value->ward_name; ?>"><?php echo $value->ward_name; ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <span id="cbo_loader"></span>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">CBO Name
                                                                <span class="required" aria-required="true"> * </span>
                                                            </label>
                                                            <div class="col-md-4">
                                                                <select class="form-control" name="cbo" id="cbo">
                                                                    <option value="">Select CBO</option>

                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Lead CHV
                                                                <span class="required" aria-required="true"> * </span>
                                                            </label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" name="lead" id="lead">

                                                            </div>
                                                        </div>
                                                      <div class="form-group">
                                                            <label class="control-label col-md-3">Date Conducted
                                                                <span class="required" aria-required="true"> * </span>
                                                            </label>
                                                            <div class="col-md-4">
                                                                 <input class="form-control" name="date" id="date" type="date" value="" />
                                                    
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Serial No
                                                                <span class="required" aria-required="true"> * </span>
                                                            </label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" name="serial" id="serial"  onchange="initiate_wizard(document.getElementById('cbo').value, document.getElementById('lead').value,document.getElementById('serial').value,document.getElementById('date').value)">
            
                                                            </div>
                                                        </div>
                                     <div hidden id="rowidz">
                                     
                                     </div>

                                                    </div>
                                                    <div class="tab-pane active" id="tab1">
                                                        <h3 class="block small red">Discuss and describe the characteristics of these types of households in your area based on the following indicators</h3>
                                                        <fieldset>
                                                            <legend>Food Security</legend>
                                                            <?php
                                                            foreach ($criteriaA as $key => $value) {
                                                                $criteria_name = $this->tabledata->getSingleRecord('hva_criteria', array('id' => $value->criteria_id), 'criteria_name');
                                                                $sname = substr($criteria_name, -1);
                                                                $snameZ = $sname . $value->id;
                                                                ?>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3"><?php echo $value->indicators_desc ?>
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-6">
                                                                        <?php foreach ($household_types as $k => $v) { ?>
                                                                            <input type="text" class="form-control" name="<?php echo $snameZ . $v->level; ?>" placeholder="<?php echo $v->level_name ?>"  /><br>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>

                                                                <?php
                                                            }
                                                            ?>


                                                         
                                                        </fieldset>
                                                        <fieldset>
                                                            <legend>Savings And Assets</legend>
                                                            <?php
                                                            foreach ($criteriaB as $key => $value) {
                                                                $criteria_name = $this->tabledata->getSingleRecord('hva_criteria', array('id' => $value->criteria_id), 'criteria_name');
                                                                $sname = substr($criteria_name, -1);
                                                                $snameZ = $sname . $value->id;
                                                                ?>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3"><?php echo $value->indicators_desc ?>
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-6">
                                                                        <?php foreach ($household_types as $k => $v) { ?>
                                                                            <input type="text" class="form-control" name="<?php echo $snameZ . $v->level; ?>" placeholder="<?php echo $v->level_name ?>  " /><br>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>

                                                                <?php
                                                            }
                                                            ?>

                                                        </fieldset>
                                                    </div>
                                                    <div class="tab-pane" id="tab2">


                                                        <fieldset>
                                                            <legend>Shelter and Dwellings</legend>
                                                            <?php
                                                            foreach ($criteriaC as $key => $value) {
                                                                $criteria_name = $this->tabledata->getSingleRecord('hva_criteria', array('id' => $value->criteria_id), 'criteria_name');
                                                                $sname = substr($criteria_name, -1);
                                                                $snameZ = $sname . $value->id;
                                                                ?>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3"><?php echo $value->indicators_desc ?>
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-6">
                                                                        <?php foreach ($household_types as $k => $v) { ?>
                                                                            <input type="text" class="form-control" name="<?php echo $snameZ . $v->level; ?>" placeholder="<?php echo $v->level_name ?>" /><br>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>

                                                                <?php
                                                            }
                                                            ?>
                                                        </fieldset>

                                                        <fieldset>
                                                            <legend>Health</legend>
                                                            <?php
                                                            foreach ($criteriaD as $key => $value) {
                                                                $criteria_name = $this->tabledata->getSingleRecord('hva_criteria', array('id' => $value->criteria_id), 'criteria_name');
                                                                $sname = substr($criteria_name, -1);
                                                                $snameZ = $sname . $value->id;
                                                                ?>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3"><?php echo $value->indicators_desc ?>
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-6">
                                                                        <?php foreach ($household_types as $k => $v) { ?>
                                                                            <input type="text" class="form-control" name="<?php echo $snameZ . $v->level; ?>" placeholder="<?php echo $v->level_name ?>" /><br>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>

                                                                <?php
                                                            }
                                                            ?>
                                                        </fieldset>
                                                    </div>
                                                    <div class="tab-pane" id="tab3">
                                                        <fieldset>
                                                            <legend>Self-esteem/Self-confidence/Agency</legend>
                                                            <?php
                                                            foreach ($criteriaE as $key => $value) {
                                                                $criteria_name = $this->tabledata->getSingleRecord('hva_criteria', array('id' => $value->criteria_id), 'criteria_name');
                                                                $sname = substr($criteria_name, -1);
                                                                $snameZ = $sname . $value->id;
                                                                ?>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3"><?php echo $value->indicators_desc ?>
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-6">
                                                                        <?php foreach ($household_types as $k => $v) { ?>
                                                                            <input type="text" class="form-control" name="<?php echo $snameZ . $v->level; ?>" placeholder="<?php echo $v->level_name ?>" /><br>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>

                                                                <?php
                                                            }
                                                            ?>
                                                        </fieldset>

                                                        <fieldset>
                                                            <legend>Social</legend>
                                                            <?php
                                                            foreach ($criteriaF as $key => $value) {
                                                                $criteria_name = $this->tabledata->getSingleRecord('hva_criteria', array('id' => $value->criteria_id), 'criteria_name');
                                                                $sname = substr($criteria_name, -1);
                                                                $snameZ = $sname . $value->id;
                                                                ?>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3"><?php echo $value->indicators_desc ?>
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-6">
                                                                        <?php foreach ($household_types as $k => $v) { ?>
                                                                        <input type="text" class="form-control" name="<?php echo $snameZ . $v->level; ?>" placeholder="<?php echo $v->level_name ?>" /><br>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>

                                                                <?php
                                                            }
                                                            ?>
                                                        </fieldset>
                                                    </div>
                                                    <div class="tab-pane" id="tab4">
                                                        <h3 class="block">Assessment Summary</h3>
                                                        <h4 class="form-section">Food Security</h4>
                                                        <h4 class="form-section">Savings And Assets</h4>
                                                        <h4 class="form-section">Shelter And Dwellings</h4>
                                                        <h4 class="form-section">Health</h4>
                                                        <h4 class="form-section">Self-esteem/Self-confidence/Agency</h4>
                                                    </div>
                                                </div>
                                            </div>
                                           <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <a href="javascript:;" class="btn default button-previous">
                                                            <i class="fa fa-angle-left"></i> Back </a>
                                                        <a href="javascript:;" class="btn btn-outline green button-next"> Continue
                                                            <i class="fa fa-angle-right"></i>
                                                        </a>
                                                       <!-- <a href="javascript:;" class="btn green button-submit"> Submit
                                                            <i class="fa fa-check"></i>
                                                        </a>-->
                                                       <input type="submit" name="save" value="save" class="btn green button-submit"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!--</form>-->
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->

        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php $this->load->view('includes/footer'); ?>
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo $includes_dir; ?>global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo $includes_dir; ?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo $includes_dir; ?>global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo $includes_dir; ?>global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?php echo $includes_dir; ?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo $includes_dir; ?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo $includes_dir; ?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo $includes_dir; ?>global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
     <script src="<?php echo $includes_dir; ?>global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo $includes_dir; ?>global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
       
        <script src="<?php echo $includes_dir; ?>global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
        <script src="<?php echo $includes_dir; ?>global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo $includes_dir; ?>global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo $includes_dir; ?>pages/scripts/form-wizard.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo $includes_dir; ?>layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
       <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>