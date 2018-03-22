<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>HES | SDP's </title>
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
            function show_cbos(id)
{
   
                    var baseURL = "http://" + window.location.host + "/hes/";
                var url = baseURL + "ajax/show_cbos/";
                $.ajax({
                    cache: false,
                    type: "post",
                    url: url,
                    data: {'sdpname': id},
                   beforeSend: function () {
  $("#loader").html("<img src='" + baseURL + "resources/layouts/layout4/img/ajax-loading.gif' />");
  
    }, 
    
         success: function (data) {
             
            // show bootstrap modal when complete loaded
            $("#form").html(data);
            $('.modal-title').text('CBOs'); // Set title to Bootstrap modal title
           $('#modal_form').modal('show');
             $("#loader").html("");
             
                   
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
                        <h1>
                            Service Delivery Patners

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
                        <span class="active">SDP</span>
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
                                    <i class="icon-globe font-dark"></i>
                                    <span class="caption-subject bold uppercase">SDP Management</span>
                                </div>
                                <div class="tools"> <div class="btn-group">
                                        <a  class="btn green" onclick="load_modal()">ADD SDP
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div></div>
                            </div>
                            <div class="portlet-body">
                                <div id="infoMessage"><?php echo $message; ?></div>
                                 <div class="table-toolbar">
                                <div class="row">&nbsp;<br>&nbsp;<br>
                                 <div id="infoMessage"></div>
                                </div>
                                 </div>
                                <div id="infoMessage"><span id="loader"></span></div>
                                <table class="table table-striped table-bordered table-hover" id="sdps">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>SDP Name</th>
                                            <th>County</th>
                                            <th>Coordinator</th>
                                            <th>CBOs</th>                                            
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>    
                                       
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
    <script src="<?php echo $includes_dir; ?>layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
    <script src="<?php echo $includes_dir; ?>layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->
    <script type="text/javascript">

var save_method; //for save method string
var table;
var base_url = '<?php echo base_url();?>';

$(document).ready(function() {

    //datatables
    table = $('#sdps').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "buttons": [
                { extend: 'print', className: 'btn dark btn-outline' },
                { extend: 'copy', className: 'btn red btn-outline' },
                { extend: 'pdf', className: 'btn green btn-outline' },
                { extend: 'excel', className: 'btn yellow btn-outline ' },
                { extend: 'csv', className: 'btn purple btn-outline ' },
                { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
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
            "url": "<?php echo site_url('sdp/ajax_list')?>",
            "type": "POST"
        },
       

        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },
            { 
                "targets": [ -2 ], //2 last column (photo)
                "orderable": false, //set not orderable
            },
        ],

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

    });

    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });

    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

});



function load_modal()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
     
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add SDP'); // Set Title to Bootstrap modal title

}

function edit_sdp(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string


    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('sdp/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="sdp_name"]').val(data.sdp_name);
            $('[name="county"]').val(data.county);
            $('[name="county_coordinator"]').val(data.county_coordinator);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit SDP'); // Set title to Bootstrap modal title


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
   
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method === 'add') {
        url = "<?php echo site_url('sdp/ajax_add')?>";
    } else {
        url = "<?php echo site_url('sdp/ajax_update')?>";
    }

    // ajax adding data to database

    var formData = new FormData($('#form')[0]);
  
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
               
                alert(JSON.stringify(formData));
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
           // alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function delete_sdp(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('sdp/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
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
$(function () {
    // when the modal is closed
    $('#modal_form').on('hidden.bs.modal', function () {
        // remove the bs.modal data attribute from it
        //$(this).removeData('bs.modal');
        // and empty the modal-content element
       //$('#modal_form .modal-content').empty();
        //$('#modal_form').modal('hide');
        reload_table();
    });
});

jQuery(document).ready(function() {
    TableDatatablesButtons.init();
});

   

</script>

    <div id="modal_form" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add SDP</h4>
                </div>
                   
               <form action="#" id="form" class="form-horizontal">
                   <input type="hidden" value="" name="id"/> 
                <div class="modal-body">
                    <div class="scroller" style="height:150px" data-always-visible="1" data-rail-visible1="1">
                        <div class="row" id="tbl">

                            <div class="col-md-12">

                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">SDP Name</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control input-circle" name="sdp_name" >
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-md-3 control-label">County</label>
                                        <div class="col-md-6">
                                            <select class="form-control input-circle" name="county">
                                                <option value="">Select County</option>
                                                <?php
                                                foreach ($county as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $value->county_name ?>"><?php echo $value->county_name ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">County Coordinator</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control input-circle" name="county_coordinator" >
                                        </div>
                                    </div>
                                  
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline" onclick="reload_table()">Close</button>
                    <button type="button" class="btn green" id="btnSave" onclick="save()">Save</button>
                </div>
              
              
            </div>
                   </form>
        </div>
    </div>
    </div>
</body>

</html>