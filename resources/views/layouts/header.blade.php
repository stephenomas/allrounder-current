<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    <link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

        <!-- DataTables -->
        <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/fixedHeader.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/scroller.bootstrap4.min.css" rel="stylesheet" type="text/css" />


</head>

<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">



    @include('partials.topbar')
    @include('partials.sidebar')

        <!-- Start right Content here -->

        <div class="content-page">
            <!-- Start content -->
                @yield('admincontent')

            </div>
            <!-- content -->

            <footer class="footer">
                © 2019 - 2020 Allrounder
            </footer>

        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>

    <!--Morris Chart-->
    <script src="assets/plugins/morris/morris.min.js"></script>
    <script src="assets/plugins/raphael/raphael.min.js"></script>

    <!-- KNOB JS -->
    <script src="assets/plugins/jquery-knob/excanvas.js"></script>
    <script src="assets/plugins/jquery-knob/jquery.knob.js"></script>

    <script src="assets/plugins/flot-chart/jquery.flot.min.js"></script>
    <script src="assets/plugins/flot-chart/jquery.flot.tooltip.min.js"></script>
    <script src="assets/plugins/flot-chart/jquery.flot.resize.js"></script>
    <script src="assets/plugins/flot-chart/jquery.flot.pie.js"></script>
    <script src="assets/plugins/flot-chart/jquery.flot.selection.js"></script>
    <script src="assets/plugins/flot-chart/jquery.flot.stack.js"></script>
    <script src="assets/plugins/flot-chart/jquery.flot.crosshair.js"></script>

    <script src="assets/pages/dashboard.js"></script>

    <script src="assets/plugins/timepicker/bootstrap-timepicker.js"></script>
    <script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

     <!-- Required datatable js-->
     <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
     <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
     <!-- Buttons examples -->
     <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
     <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>

     <script src="assets/plugins/datatables/jszip.min.js"></script>
     <script src="assets/plugins/datatables/pdfmake.min.js"></script>
     <script src="assets/plugins/datatables/vfs_fonts.js"></script>
     <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
     <script src="assets/plugins/datatables/buttons.print.min.js"></script>
     <script src="assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
     <script src="assets/plugins/datatables/dataTables.keyTable.min.js"></script>
     <script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>

     <!-- Responsive examples -->
     <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
     <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

     <!-- Datatable init js -->
     <script src="assets/pages/datatables.init.js"></script>

    <!-- Plugins Init js -->
    <script src="assets/pages/form-advanced.js"></script>

    <script src="assets/js/app.js"></script>

    <script src="{{asset('js/app.js')}}"></script>

    @yield('extra-js')

</body>

</html>
