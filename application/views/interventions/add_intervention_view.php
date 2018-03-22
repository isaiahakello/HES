<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>HES | Add Intervention</title>
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
                            <h1>Add Intervention 

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
                            <a href="javascript:;">Interventions</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Add Intervention</span>
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
                                        <span class="caption-subject font-red bold uppercase">New Intervention &nbsp;
                                            <span class="step-title"> Step 1 of 5 </span>
                                        </span>
                                    </div>

                                </div>
                                <div class="portlet-body form">
                                    <form class="form-horizontal" action="#" id="submit_form" method="POST">
                                        <div class="form-wizard">
                                            <div class="form-body">
                                                <ul class="nav nav-pills nav-justified steps">
                                                    <li>
                                                        <a href="#tab0" data-toggle="tab" class="step">
                                                            <span class="number"> 1 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i>Activity</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab1" data-toggle="tab" class="step">
                                                            <span class="number"> 2 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i>Outputs</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab2" data-toggle="tab" class="step">
                                                            <span class="number"> 3 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i>Intermediary</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab3" data-toggle="tab" class="step active">
                                                            <span class="number"> 4 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i>Outcomes</span>
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
                                                            <label class="control-label col-md-3">Household Vulnerability Level
                                                                <span class="required" aria-required="true"> * </span>
                                                            </label>
                                                            <div class="col-md-4">
                                                                <select class="form-control" name="level" id="level">
                                                                    <option value="">Select Level</option>
                                                                    <?php
                                                                    foreach ($levels as $key => $value) {
                                                                        ?>
                                                                        <option value="<?php echo $value->id ?>"><?php echo $value->level_name ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>

                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Activity
                                                                <span class="required" aria-required="true"> * </span>
                                                            </label>
                                                            <div class="col-md-4" >
                                                                <input type="text" class="form-control lg" name="activity" id="activity" onchange="step_one(document.getElementById('level').value, document.getElementById('activity').value)"/>

                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="tab-pane active" id="tab1">
                                                        <div class="hidden" id="iid">
                                                         
                                                        </div>

                                                        <div id="load">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Output
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control lg" name="output" id="output"/>

                                                                </div>
                                                                <div class="col-md-4">

                                                                    <a class="btn btn-success" onclick="saveoutput(document.getElementById('output').value, document.getElementById('rowid').value)">Save</a>

                                                                    <a class="btn btn-danger" onclick="newoutput()">New Output</a>

                                                                </div>
                                                                <span id="output_loader"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" >
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-6" id="ptable">


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab2">
                                                        <div id="iload">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Intermediary Outcome
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control lg" name="intermediary" id="intermediary"/>

                                                                </div>
                                                                <div class="col-md-4">

                                                                    <a class="btn btn-success" onclick="saveintermediary(document.getElementById('intermediary').value, document.getElementById('rowid').value)">Save</a>

                                                                    <a class="btn btn-danger" onclick="newintermediary()">New Intermediary</a>

                                                                </div>
                                                                
                                                            </div>
                                                            <span id="i_loader"></span>
                                                        </div>
                                                        <div class="form-group" >
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-6" id="itable">


                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane" id="tab3">
                                                        <div id="iload">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Outcome
                                                                    <span class="required" aria-required="true"> * </span>
                                                                </label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control lg" name="outcome" id="outcome"/>

                                                                </div>
                                                                <div class="col-md-4">

                                                                    <a class="btn btn-success" onclick="saveoutcome(document.getElementById('outcome').value, document.getElementById('rowid').value)">Save</a>

                                                                    <a class="btn btn-danger" onclick="newoutcome()">New Outcome</a>

                                                                </div>
                                                                
                                                            </div>
                                                            <span id="o_loader"></span>
                                                        </div>
                                                        <div class="form-group" >
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-6" id="otable">


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab4">
                                                        <h3 class="block">Summary</h3>
                                                         
                                                        <h4 class="form-section">Activity</h4>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Household Level:</label>
                                                            <div class="col-md-4">
                                                                <p class="form-control-static" data-display="level"> </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Activity:</label>
                                                            <div class="col-md-4">
                                                                <p class="form-control-static" data-display="activity"> </p>
                                                            </div>
                                                        </div>
                                                        <h4 class="form-section">Outputs</h4>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Output:</label>
                                                            <div class="col-md-4">
                                                                <p class="form-control-static" data-display="output"> </p>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <h4 class="form-section">Intermediary Outcomes</h4>
                                                         <div class="form-group">
                                                            <label class="control-label col-md-3">Intermediary:</label>
                                                            <div class="col-md-4">
                                                                <p class="form-control-static" data-display="intermediary"> </p>
                                                            </div>
                                                        </div>
                                                        <h4 class="form-section">Outcomes</h4>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Outcomes:</label>
                                                            <div class="col-md-4">
                                                                <p class="form-control-static" data-display="outcome"> </p>
                                                            </div>
                                                        </div>
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
                                                        <a href="javascript:;" class="btn green button-submit"> Submit
                                                            <i class="fa fa-check"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
        <script type="text/javascript">

                                                                        function step_one(level, activity)
                                                                        {
                                                                            var baseURL = "http://" + window.location.host + "/hes/";
                                                                            var url = baseURL + "ajax/step_one/";
                                                                            $.ajax({
                                                                                cache: false,
                                                                                type: "post",
                                                                                url: url,
                                                                                data: {'level': level, 'activity': activity},
 beforeSend: function () {
alert('You are on track.Set up the outputs in the next stage....');
                                                                                },
                                                                                success: function (data) {
                                                                                    $("#iid").html(data);
                                                                                   
                                                                                }
                                                                            });
                                                                        }


                                                                        function newoutput()
                                                                        {
                                                                            var baseURL = "http://" + window.location.host + "/hes/";
                                                                            var url = baseURL + "ajax/newoutput/";
                                                                            $.ajax({
                                                                                cache: false,
                                                                                type: "post",
                                                                                url: url,
                                                                                data: {},
                                                                                beforeSend: function () {

                                                                                    $("#output_loader").html("<img src='" + baseURL + "resources/layouts/layout4/img/ajax-loading.gif' />");
                                                                                },
                                                                                success: function (data) {
                                                                                    $("#load").html(data);
                                                                                    $("#output_loader").html("");
                                                                                }
                                                                            });
                                                                        }
                                                                        function saveoutput(output, rowid)
                                                                        {
                                                                            var baseURL = "http://" + window.location.host + "/hes/";
                                                                            var url = baseURL + "ajax/saveoutput/";
                                                                            $.ajax({
                                                                                cache: false,
                                                                                type: "post",
                                                                                url: url,
                                                                                data: {'output': output, 'rowid': rowid},
                                                                                beforeSend: function () {
                                                                                    $("#output_loader").html("<img src='" + baseURL + "resources/layouts/layout4/img/ajax-loading.gif' />");
                                                                                    $("#ptable").html("");
                                                                                },
                                                                                success: function (data) {
                                                                                    $("#ptable").html(data);
                                                                                    $("#output_loader").html("");
                                                                                }
                                                                            });
                                                                        }
                                                                        function newintermediary()
                                                                        {
                                                                            var baseURL = "http://" + window.location.host + "/hes/";
                                                                            var url = baseURL + "ajax/newintermediary/";
                                                                            $.ajax({
                                                                                cache: false,
                                                                                type: "post",
                                                                                url: url,
                                                                                data: {},
                                                                                beforeSend: function () {

                                                                                    $("#i_loader").html("<img src='" + baseURL + "resources/layouts/layout4/img/ajax-loading.gif' />");
                                                                             $("#iload").html("");

                                                                                },
                                                                                success: function (data) {
                                                                                    $("#iload").html(data);
                                                                                    $("#i_loader").html("");
                                                                                }
                                                                            });
                                                                        }
                                                                        function saveintermediary(intermediary,rowid)
                                                                        {
                                                                            var baseURL = "http://" + window.location.host + "/hes/";
                                                                            var url = baseURL + "ajax/saveintermediary/";
                                                                            $.ajax({
                                                                                cache: false,
                                                                                type: "post",
                                                                                url: url,
                                                                                data: {'intermediary':intermediary, 'rowid': rowid},
                                                                                beforeSend: function () {

                                                                                    $("#i_loader").html("<img src='" + baseURL + "resources/layouts/layout4/img/ajax-loading.gif' />");
                                                                                },
                                                                                success: function (data) {
                                                                                    $("#itable").html(data);
                                                                                    $("#i_loader").html("");
                                                                                }
                                                                            });
                                                                        }
                                                                        function newoutcome()
                                                                        {
                                                                            var baseURL = "http://" + window.location.host + "/hes/";
                                                                            var url = baseURL + "ajax/newoutcome/";
                                                                            $.ajax({
                                                                                cache: false,
                                                                                type: "post",
                                                                                url: url,
                                                                                data: {},
                                                                                beforeSend: function () {

                                                                                    $("#o_loader").html("<img src='" + baseURL + "resources/layouts/layout4/img/ajax-loading.gif' />");
                                                                                 $("#oload").html("");
                                                                                },
                                                                                success: function (data) {
                                                                                    $("#oload").html(data);
                                                                                    $("#o_loader").html("");
                                                                                }
                                                                            });
                                                                        }
                                                                          function saveoutcome(outcome,rowid)
                                                                        {
                                                                            var baseURL = "http://" + window.location.host + "/hes/";
                                                                            var url = baseURL + "ajax/saveoutcome/";
                                                                            $.ajax({
                                                                                cache: false,
                                                                                type: "post",
                                                                                url: url,
                                                                                data: {'outcome':outcome, 'rowid': rowid},
                                                                                beforeSend: function () {

                                                                                    $("#o_loader").html("<img src='" + baseURL + "resources/layouts/layout4/img/ajax-loading.gif' />");
                                                                               $("#oload").html("");
                                                                               },
                                                                                success: function (data) {
                                                                                    $("#oload").html(data);
                                                                                    $("#o_loader").html("");
                                                                                }
                                                                            });
                                                                        }
        </script>
    </body>

</html>