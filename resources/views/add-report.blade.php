<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Add Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Summernote css -->
    <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.css" />
    <!--bootstrap-wysihtml5-->
    <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">

</head>


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
       @include('partials.topbar')
       @include('partials.sidebar')
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <div class="">
                    <div class="page-header-title">
                        <h4 class="page-title">Monthly Report</h4>
                    </div>
                </div>

                <div class="page-content-wrapper ">
                        <!-- End row -->


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="m-b-20 m-t-0">{{Auth::user()->name}}</h4>
                                        <h4 class="m-b-20 m-t-0">Branch: {{Auth::user()->branch->name}}</h4>
                                        <h4 class="m-b-30 m-t-0">Date: {{Carbon\Carbon::today()->toFormattedDateString()}}</h4>
                                        @if(session()->has('message'))
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                            </button>
                                            {{session()->get('message')}}
                                        </div>
                                        @endif
                                        <form method="POST" action="/add-report">
                                            @csrf
                                        <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="example-text-input">Title of Report</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="title" class="form-control" placeholder="Missing Pen" id="example-text-input">
                                                </div>
                                        </div>
                                        @if (Auth::user()->role == 1)
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label" for="example-text-input">What User?</label>
                                            <div class="col-sm-10">
                                                <select name="from" required class="select2 form-control" id="product" searchable="Search here..">
                                                        <option disabled selected>Select a User</option>
                                                        @foreach ($bran as $br)
                                                        <option value="{{$br->id}}">{{$br->name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif

                                        <textarea name="body" class="wysihtml5 form-control" rows="9"></textarea><br>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10">Add Report</button>
                                    </div>
                                </div>
                            </div>
                         </form>
                        </div>
                        <!-- End row -->

                    </div>
                    <!-- container-fluid -->

                </div>
                <!-- Page content Wrapper -->

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

    <!-- Wysihtml js -->
    <script src="assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
    <script src="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

    <!--Summernote js-->
    <script src="assets/plugins/summernote/summernote-bs4.min.js"></script>


    <script src="assets/js/app.js"></script>

    <script>
        jQuery(document).ready(function() {
            $('.wysihtml5').wysihtml5();

            $('.summernote').summernote({
                height: 200, // set editor height

                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor

                focus: true // set focus to editable area after initializing summernote
            });

        });
    </script>


</body>

</html>
