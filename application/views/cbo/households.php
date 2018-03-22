<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>HES | Caregivers </title>
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
        <link href="<?php echo $includes_dir; ?>global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $includes_dir; ?>global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $includes_dir; ?>global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
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
                     function dependants(gid) {
                var baseURL = "http://" + window.location.host + "/hes/";
                var url = baseURL + "ajax/get_ovcs/";
                $.ajax({
                    cache: false,
                    type: "post",
                    url: url,
                    data: {'caregiver': gid},
                    beforeSend: function() {

                        $("#loadovcz").html("<img src='" + baseURL + "includes/img/ajax_loader.gif' />");
                    },
                    success: function(data) {
                        $("#details").html(data);
                        $("#loadovcz").html("");
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
                            <h1>Caregivers/Household Manager

                            </h1>


                        </div>
                        <!-- END PAGE TITLE -->

                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="<?php echo $base_url ?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>

                        <li>
                            <span class="active">Caregivers</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->




                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Caregivers Manager</span>
                                    </div>
                                    <div class="tools"></div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <?php echo $this->session->flashdata('dispMessage'); ?>
                                            

                                        </div>
                                    </div>
                                  
                                    
                                            <table id="sample_1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Caregiver Name</th>
                    <th>ID Number</th>
                    <th>HIV Status</th>                   
                    
                    <th>Household Category</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=1;
                foreach($households as $key=>$value)
                {
                 echo '<tr>';
                 echo '<td>'.$i.'</td>';
                 echo '<td>'.$value->first_name.' '.$value->middle_name.' '.$value->surname.'</td>';
                 echo '<td>'.$value->national_id.'</td>';
                 echo '<td>'.$value->hiv_status.'</td>';
                 echo '<td>'.$this->tabledata->getSingleRecord('hva_levels',array('id'=>$value->category),'level_name').'</td>';
                 
                 echo '</tr>'; 
                 $i++;
                }
                ?>
            </tbody>

           
        </table>
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
<?php $this->load->view('includes/footer') ?>
        <!-- END FOOTER -->
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
    <script src="<?php echo $includes_dir; ?>global/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo $includes_dir; ?>global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo $includes_dir; ?>global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo $includes_dir; ?>global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo $includes_dir; ?>global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo $includes_dir; ?>pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="<?php echo $includes_dir; ?>layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>