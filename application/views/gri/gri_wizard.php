<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>HES | GRI Wizard</title>
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

            function search() {
                var searchval = $('#searchval').val();
                var baseURL = "http://" + window.location.host + "/hes/";
                var url = baseURL + "ajax/search_household_gri/";
                $.ajax({
                    cache: false,
                    type: "post",
                    url: url,
                    data: {'searchval': searchval},
                    beforeSend: function () {

                        //$("#ajaxContent").html("<img src='" + baseURL + "resources/layouts/layout4/img/ajax-loading.gif' />");
                        //$('#loader').html("");
                        // $('#ajaxContent').html("");

                    },
                    success: function (data) {

                        $('#ajaxContent').html(data);
                    }
                });
            }

            function getSecondPart(str)
            {
                return str.split('M')[1];
            }
            function calculate_score() {
                document.listForm.total.value = '';
                /* var sum = 0;
                 var ln = document.getElementsByName('opt[]');
                 for (i = 0; i< ln.length; i++) {
                 //if (document.listForm.ln[i].checked) {
                 if (ln[i].checked) {
                 sum = sum + parseInt(getSecondPart(ln[i].value));
                 
                 }
                 }*/
                for (i = 0; i < document.listForm.opt.length; i++ )
                        {
                            if (document.listForm.opt[i].checked)
                            {
// get the value of checkbox ,to calculate price
sum = sum + parseInt(getSecondPart(document.listForm.opt[i].value));
                            }
                        }

                document.listForm.total.value = sum;
            }
            function calculate() {
                document.listForm.total.value = '';
                var el, i = 0;
                var totalz = 0;
                while (el = document.forms['listForm'].elements['opt[]'][i++]) {
                    if (el.checked)
                    {
                        totalz = totalz + Number(getSecondPart(el.value));
                    }
                }
                document.listForm.total.value = totalz;
            }
        </script>
        <!---    $(document).ready(function() {
                $("#calc").click(function(){
                    var favorite = [];
                    $.each($("input[name='opt']:checked"), function(){            
                        favorite.push($(this).val());
                    });
                    alert("My favourite sports are: " + favorite.join(", "));
                });
            });
        </script>-->
        <script type="text/javascript">
	function checkTotal() {
		document.listForm.total.value = '';
		var sum = 0;
               // document.listForm.opt.length;
               var el = document.forms['listForm'].elements[ 'opt[]' ];
              
		for (i=0;i<el.length;i++) {
		  if (document.listForm.opt[i].checked) {
                      alert(getSecondPart( document.forms['listForm'].elements[ 'opt[i].value' ]));
		  	//sum = sum + parseInt(getSecondPart( document.forms['listForm'].elements[ 'opt[i].value' ]));
		  }
		}
		//document.listForm.total.value = sum;
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
                            <h1>Graduation Readiness Index Wizard 

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
                            <span class="active">GRI Wizard</span>
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
                                        <span class="caption-subject font-red bold uppercase">Household GRI &nbsp;
                                            <span class="step-title"> Step 1 of 5 </span>
                                        </span>
                                    </div>

                                </div>
                                <div class="portlet-body form">
                                    <?php echo $this->session->flashdata('dispMessage'); ?>
                                    <!--<form class="form-horizontal" action="#" id="submit_form" method="POST">-->
                                    <?php //echo form_open_multipart(current_url(),array('method'=>'post','id' => 'submit_form',  'class' => 'form-horizontal','novalidate' => 'novalidate' )) ?> 
                                    <?php echo form_open("gri/save_data", array('method' => 'post', 'id' => 'submit_form', 'class' => 'form-horizontal', 'novalidate' => 'novalidate', 'name' => 'listForm')); ?>
                                    <div class="form-wizard">
                                        <div class="form-body">
                                            <ul class="nav nav-pills nav-justified steps">
                                                <li>
                                                    <a href="#tab0" data-toggle="tab" class="step">
                                                        <span class="number"> 1 </span>
                                                        <span class="desc">
                                                            <i class="fa fa-check"></i>Household Details</span>
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
                                                            <i class="fa fa-check"></i>Criteria C & D</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#tab3" data-toggle="tab" class="step">
                                                        <span class="number"> 5 </span>
                                                        <span class="desc">
                                                            <i class="fa fa-check"></i>Self-Evaluation & Summary</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div id="bar" class="progress progress-striped" role="progressbar">
                                                <div class="progress-bar progress-bar-success"> </div>
                                            </div>
                                            <div class="block text-right">
                                                <span  class="red">Score:<b id="scorez"><input type="text" size="2" name="total" value="0"/></b>/<b>180</b></span>
                                            </div>
                                            <div class="tab-content">

                                                <div class="tab-pane active" id="tab0">
                                                    <h4 class="block">Inputs marked in asterisk are compulsory</h4>

                                                    <!-- <div class="search-bar bordered">-->
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Search Household
                                                            <span class="required" aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-4 midtext">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="searchval" placeholder="Search household by ID Number or CBO....">
                                                               <!--<input required type="hidden" class="form-control" id-="rowid">-->
                                                               
                                                                <span class="input-group-btn">
                                                                    <button class="btn green-soft uppercase bold" type="button" onclick="search()">Search</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 extra-buttons">

                                                            <button class="btn grey-steel uppercase bold" type="button" onclick="location.href = '<?php echo $base_url ?>/gri'">Reset Search</button>
                                                        </div>
                                                    </div>
                                                    <!-- </div>-->
                                                     
                                                    <div class="row" id="ajaxContent" >
                                                       
                                                    </div>                          


                                                </div>
                                                <div class="tab-pane active" id="tab1">

                                                    <fieldset>
                                                        <legend class="bold blue">Food Security Indicators</legend>
                                                        <?php
                                                        foreach ($criteriaA as $key => $value) {
                                                            $criteria_name = $this->tabledata->getSingleRecord('gri_criteria', array('id' => $value->criteria_id), 'criteria_name');
                                                            $sname = substr($criteria_name, -1);
                                                            $snameZ = $sname . $value->id;
                                                            ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3"><?php echo '<b>' . $value->code . '</b>' . ' ' . $value->indicator_desc ?>
                                                                    <span class="required"> * </span>
                                                                </label>

                                                                <div class="col-md-6 radio-inline">
                                                                    <?php
                                                                    $groups = $this->db->query("SELECT * FROM gri_indicator_options WHERE indicator_id='" . $value->id . "'")->result();
                                                                    foreach ($groups as $g => $k):
                                                                        
                                                                        //$k->id . 'M' . 
                                                                        ?>
                                                                        <label class="mt-radio">

                                                                            <input type="checkbox" name="opt[]" value="<?php echo $k->id.'M'.$k->points; ?>"  onchange="calculate();" <?php //echo ($gID== $k->id)?'checked':''  ?>>
                                                                            <?php echo htmlspecialchars($k->option_name, ENT_QUOTES, 'UTF-8'); ?>
                                                                            <span></span>
                                                                        </label>
                                                                    <?php endforeach ?>

                                                                </div>

                                                            </div>

                                                            <?php
                                                        }
                                                        ?>


                                                    </fieldset>
                                                    <fieldset>
                                                        <legend class="bold blue">Savings And Asset indicators(Economic Strengthening)</legend>
                                                        <?php
                                                        foreach ($criteriaB as $key => $value) {
                                                            $criteria_name = $this->tabledata->getSingleRecord('gri_criteria', array('id' => $value->criteria_id), 'criteria_name');
                                                            $sname = substr($criteria_name, -1);
                                                            $snameZ = $sname . $value->id;
                                                            ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3"><?php echo '<b>' . $value->code . '</b>' . ' ' . $value->indicator_desc ?>
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-6">
                                                                    <?php
                                                                    $groups = $this->db->query("SELECT * FROM gri_indicator_options WHERE indicator_id='" . $value->id . "'")->result();
                                                                    foreach ($groups as $g => $k):
                                                                        ?>
                                                                        <label class="mt-radio">
                                                                            <?php
                                                                          //echo $k->id . $snameZ; 
                                                                            $checked = null;
                                                                          
                                                                            ?>
                                                                              <?php //echo $k->id . $snameZ;?>
                                                                            <input type="checkbox" name="opt[]" value="<?php echo $k->id . 'M' . $k->points; ?>" onchange="calculate();"  <?php //echo ($gID== $k->id)?'checked':''  ?> class="form-control"/>
                                                                            <?php echo htmlspecialchars($k->option_name, ENT_QUOTES, 'UTF-8'); ?>
                                                                            <span></span>
                                                                        </label>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </div>

                                                            <?php
                                                        }
                                                        ?>

                                                    </fieldset>
                                                </div>
                                                <div class="tab-pane" id="tab2">


                                                    <fieldset>
                                                        <legend class="bold blue">Housing and Shelter Indicators-(Health)</legend>
                                                        <?php
                                                        foreach ($criteriaC as $key => $value) {
                                                            $criteria_name = $this->tabledata->getSingleRecord('gri_criteria', array('id' => $value->criteria_id), 'criteria_name');
                                                            $sname = substr($criteria_name, -1);
                                                            $snameZ = $sname . $value->id;
                                                            ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3"><?php echo '<b>' . $value->code . '</b>' . ' ' . $value->indicator_desc ?>
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-6">
                                                                    <?php
                                                                    $groups = $this->db->query("SELECT * FROM gri_indicator_options WHERE indicator_id='" . $value->id . "'")->result();
                                                                    foreach ($groups as $g => $k):
                                                                        ?>
                                                                        <label class="mt-radio">
                                                                            <?php
                                                                            // $gID=$value->category;
                                                                            $checked = null;
                                                                            ?>
                                                                            <input type="checkbox" name="opt[]" value="<?php echo $k->id . 'M' . $k->points; ?>"  onchange="calculate();"  <?php //echo ($gID== $k->id)?'checked':''  ?>>
                                                                            <?php echo htmlspecialchars($k->option_name, ENT_QUOTES, 'UTF-8'); ?>
                                                                            <span></span>
                                                                        </label>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </div>

                                                            <?php
                                                        }
                                                        ?>
                                                    </fieldset>

                                                    <fieldset>
                                                        <legend class="bold blue">Self-esteem, education, child protection(Social)</legend>
                                                        <?php
                                                        foreach ($criteriaD as $key => $value) {
                                                            $criteria_name = $this->tabledata->getSingleRecord('gri_criteria', array('id' => $value->criteria_id), 'criteria_name');
                                                            $sname = substr($criteria_name, -1);
                                                            $snameZ = $sname . $value->id;
                                                            ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3"><?php echo '<b>' . $value->code . '</b>' . ' ' . $value->indicator_desc ?>
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-6 radio-inline">
                                                                    <?php
                                                                    $groups = $this->db->query("SELECT * FROM gri_indicator_options WHERE indicator_id='" . $value->id . "'")->result();
                                                                    foreach ($groups as $g => $k):
                                                                        ?>
                                                                        <label class="mt-radio">
                                                                            <?php
                                                                            // $gID=$value->category;
                                                                            $checked = null;
                                                                            ?>
                                                                            <input type="checkbox" name="opt[]" value="<?php echo $k->id . 'M' . $k->points; ?>"    <?php //echo ($gID== $k->id)?'checked':''  ?>>
                                                                            <?php echo htmlspecialchars($k->option_name, ENT_QUOTES, 'UTF-8'); ?>
                                                                            <span></span>            
                                                                        </label>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </div>

                                                            <?php
                                                        }
                                                        ?>
                                                    </fieldset>
                                                </div>

                                                <div class="tab-pane" id="tab3">
                                                    <fieldset> 
                                                        <legend class="bold blue"><h3 class="block">Self Evaluation</h3></legend>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Do you think your life has improved compared to last year?
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-4">
                                                                <div class="radio-list">  
                                                                    <label>
                                                                        <input type="radio" name="evaluation[]" value="Better"  /> Better </label>
                                                                    <label>
                                                                        <input type="radio" name="evaluation[]" value="Same"  /> Same </label>
                                                                    <label>
                                                                        <input type="radio" name="evaluation[]" value="Worse"  /> Worse </label>
                                                                    <span></span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">In which areas do you feel your household has improved most over the last one year?
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-4">
                                                                <textarea class="form-control" name="improvement"></textarea>
                                                            </div>
                                                        </div> 
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Are your children able to interact freely and show some level of confidence?
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <div class="radio-list">
                                                                    <label>
                                                                        <input type="radio" name="children_confidence[]" value="Always"  /> Always </label>
                                                                    <label>
                                                                        <input type="radio" name="children_confidence[]" value="Sometimes"  /> Sometimes </label>
                                                                    <label>
                                                                        <input type="radio" name="children_confidence[]" value="Never" /> Never </label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">In which areas do you feel least confident about in regards to your household?
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-4">
                                                                <textarea class="form-control" name="least_confidence"></textarea>
                                                            </div>
                                                        </div> 

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Do you as a household feel confident enough to graduate out of the project support?
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <div class="radio-list">
                                                                    <label>
                                                                        <input type="radio" name="graduate_confidence[]" value="Yes"  /> Yes </label>
                                                                    <label>
                                                                        <input type="radio" name="graduate_confidence[]" value="No"  /> No </label>

                                                                </div>

                                                            </div>
                                                        </div>
                                                        <fieldset>

                                                            <fieldset> 
                                                                <legend><h3 class="block">Assessors(HGC) General Impressions and Recommedations</h3></legend>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">How does the score attained compare with OLMIS records?
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <textarea class="form-control" name="olmis_comparison"></textarea>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Assessors general impressions?
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <textarea class="form-control" name="general_impressions"></textarea>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Recommendation:
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-6">
                                                                        <div class="radio-list">
                                                                            <label>
                                                                                <input type="radio" name="recommendation[]" value="To graduate"  /> To graduate </label>
                                                                            <label>
                                                                                <input type="radio" name="recommendation[]" value="Not to Graduate"  />Not to Graduate </label>
                                                                            <span></span>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </fieldset>     
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
                                                                       <!-- <input type="submit" name="save" value="Save Records" class="btn green button-submit"/>-->
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