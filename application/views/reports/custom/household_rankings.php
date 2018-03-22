<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>HES |Custom Household Ranking </title>
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
         <link href="<?php echo $includes_dir; ?>global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
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
       
        <link href="<?php echo $includes_dir; ?>pages/css/profile-2.min.css" rel="stylesheet" type="text/css" />

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

                        $("#loadConstituency").html("<img src='" + baseURL + "resources/layout4/img/ajax_loading.gif' />");
                    },
                    success: function (data) {
                        $("#constituency").html(data);
                        $("#loadConstituency").html("");
                    }
                });
            }

            function getWards(iid) {
                var baseURL = "http://" + window.location.host + "/hes/";
                var url = baseURL + "ajax/getwards/";
                $.ajax({
                    cache: false,
                    type: "post",
                    url: url,
                    data: {'constId': iid},
                    beforeSend: function () {

                        $("#loadWard").html("<img src='" + baseURL + "resources/layout4/img/ajax_loading.gif' />");
                    },
                    success: function (data) {
                        $("#ward").html(data);
                        $("#loadWard").html("");
                    }
                });
            }
            
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
        </script>
    </head>


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
                        <h1>General Settings

                        </h1>


                    </div>
                    <!-- END PAGE TITLE -->

                </div>
                <!-- END PAGE HEAD-->
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <a href="<?php echo $base_url ?>">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>

                    <li>
                        <span class="active">Settings</span>
                    </li>
                </ul>
                <!-- END PAGE BAR -->

                <!-- END PAGE HEADER-->
                <div class="mt-bootstrap-tables">
                    <?php echo $this->session->flashdata('dispMessage'); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-blue">
                                        <i class="icon-users font-blue"></i>
                                        <span class="caption-subject bold uppercase">Search Household</span>
                                    </div>

                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                    <div class="col-md-8 midtext">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="searchval" placeholder="Search caregiver ID Number or First Name">
                                                               
                                                                <span class="input-group-btn">
                                                                    <button class="btn green-soft uppercase bold" type="button" onclick="search()">Search</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 extra-buttons">

                                                            <button class="btn grey-steel uppercase bold" type="button" onclick="location.href = '<?php echo $base_url ?>/gri'">Reset Search</button>
                                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="row">
                                        <div class="portlet-title">
                                        <h3>Household Profile</h3>
                                        </div>
                                        <div class="col-md-3">
                                            <ul class="list-unstyled profile-nav">
                                               
                                                <li>
                                                    <a href="javascript:;"> Caregiver Name </a>
                                                     <span> </span>
                                                </li>
                                                <li>
                                                    <a href="javascript:;"> National ID
                                                       
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;"> CBO </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;"> HIV Status </a>
                                                </li>
                                                 <li>
                                                    <a href="javascript:;"> No of OVCs </a>
                                                </li>
                                                
                                                <li>
                                                    <a href="javascript:;"> House Ranking </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-bar-chart"></i>Longitudinal HVA Report</div>

                                </div>
                                <div class="portlet-body">
<div class="row">
                                    <div  class="table-scrollable scroller"  style="height:300px" data-always-visible="1" data-rail-visible1="1">
                                      

                                    </div>
                                </div>
                                    <div class="row">
                                        <h4>Graphical View</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->

    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
<?php $this->load->view('includes/footer') ?>
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
    <script>
            var save_method; //for save method string
            var table;
            var base_url = '<?php echo base_url(); ?>';

            $(document).ready(function () {

                //datatables
                table = $('#indicators').DataTable({

                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.
                    "buttons": [
                        {extend: 'print', className: 'btn dark btn-outline'},
                        {extend: 'copy', className: 'btn red btn-outline'},
                        {extend: 'pdf', className: 'btn green btn-outline'},
                        {extend: 'excel', className: 'btn yellow btn-outline '},
                        {extend: 'csv', className: 'btn purple btn-outline '},
                        {extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
                    ],
                    "language": {
                        "aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                        "emptyTable": "No data available in table",
                        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                        "infoEmpty": "No entries found",
                        "infoFiltered": "(filtered1 from _MAX_ total entries)",
                        "lengthMenu": "_MENU_ entries",
                        "search": "Search:",
                        "zeroRecords": "No matching records found"
                    },
                    responsive: true,
                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "<?php echo site_url('auth_admin/gri_list') ?>",
                        "type": "POST"
                    },

                    //Set column definition initialisation properties.
                    "columnDefs": [
                        {
                            "targets": [-1], //last column
                            "orderable": false //set not orderable
                        },
                        {
                            "targets": [-2], //2 last column (photo)
                            "orderable": false //set not orderable
                        }
                    ],

                    "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>" // horizobtal scrollable datatable

                });

                //datepicker
                $('.datepicker').datepicker({
                    autoclose: true,
                    format: "yyyy-mm-dd",
                    todayHighlight: true,
                    orientation: "top auto",
                    todayBtn: true
                });

                //set input/textarea/select event when change value, remove class error and remove text help block 
                $("input").change(function () {
                    $(this).parent().parent().removeClass('has-error');
                    $(this).next().empty();
                });
                $("textarea").change(function () {
                    $(this).parent().parent().removeClass('has-error');
                    $(this).next().empty();
                });
                $("select").change(function () {
                    $(this).parent().parent().removeClass('has-error');
                    $(this).next().empty();
                });

            });




            function edit_intervention(id)
            {
                save_method = 'update';
                $('#form')[0].reset(); // reset form on modals
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').empty(); // clear error string


                //Ajax Load data from ajax
                $.ajax({
                    url: "<?php echo site_url('auth_admin/gri_edit') ?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function (data)
                    {

                        $('[name="id"]').val(data.id);
                        $('[name="level"]').val(data.level_id);
                        $('[name="activity"]').val(data.activity);
                        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Edit Activity'); // Set title to Bootstrap modal title


                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
            }

            function reload_table()
            {
                table.ajax.reload(null, false); //reload datatable ajax 
            }

            function save()
            {

               // $('#btnSave').text('saving...'); //change button text
               // $('#btnSave').attr('disabled', true); //set button disable 
                var url;

                if (save_method === 'add') {
                    url = "<?php echo site_url('auth_admin/gri_add') ?>";
                } else {
                    url = "<?php echo site_url('auth_admin/gri_update') ?>";
                }

                // ajax adding data to database

                var formData = new FormData($('#form2')[0]);

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function (data)
                    {

                        if (data.status) //if success close modal and reload ajax table
                        {
                            $('#modal_form2').modal('hide');
                            reload_table();
                        } else
                        {

                            alert(JSON.stringify(formData));
                            for (var i = 0; i < data.inputerror.length; i++)
                            {
                                $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                                $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                            }
                        }
                        //$('#btnSave').text('save'); //change button text
                       // $('#btnSave').attr('disabled', false); //set button enable 


                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        // alert('Error adding / update data');
                        $('#btnSave').text('save'); //change button text
                        $('#btnSave').attr('disabled', false); //set button enable 

                    }
                });
            }

            function delete_intervention(id)
            {
                if (confirm('Are you sure delete this Indicator?'))
                {
                    // ajax delete data to database
                    $.ajax({
                        url: "<?php echo site_url('auth_admin/gri_delete') ?>/" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function (data)
                        {
                            //if success reload ajax table
                            $('#modal_form').modal('hide');
                            reload_table();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error deleting data');
                        }
                    });

                }
            }
            function add_option(id)
            {

                $('#form2')[0].reset(); // reset form on modals
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').empty(); // clear error string
                save_method = 'add';

                //Ajax Load data from ajax
                $.ajax({
                    url: "<?php echo site_url('auth_admin/gri_edit') ?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function (data)
                    {

                        $('[name="rowid"]').val(data.id);
                        $('#modal_form2').modal('show'); // show bootstrap modal when complete loaded


                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
            }
    </script>



</body>

</html>