<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Read Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- Summernote css -->
    <link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs4.css')}}" />
    <!--bootstrap-wysihtml5-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}">

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">

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
                                        <h4 class="m-b-20 m-t-0">{{$report->user->name}}</h4>
                                        <h4 class="m-b-20 m-t-0">Branch: {{$report->user->branch->name}} </h4>
                                        <h4 class="m-b-30 m-t-0">Date:{{$report->created_at}}</h4>
                                        @if(session()->has('message'))
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                            </button>
                                            {{session()->get('message')}}
                                        </div>
                                        @endif

                                            @csrf
                                        <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="example-text-input">Title of Report</label>
                                                <div class="col-sm-10">
                                                    <input type="text" readonly value="{{$report->title}}" name="title" class="form-control" placeholder="Missing Pen" id="example-text-input">
                                                </div>
                                        </div>
                                        <textarea name="body"  class="wysihtml5 form-control"  rows="9" disabled>{{$report->body}}</textarea><br>

                                    </div>
                                </div>
                            </div>

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
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/modernizr.min.js')}}"></script>
    <script src="{{asset('assets/js/detect.js')}}"></script>
    <script src="{{asset('assets/js/fastclick.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('assets/js/jquery.blockUI.js')}}"></script>
    <script src="{{asset('assets/js/waves.js')}}"></script>
    <script src="{{asset('assets/js/wow.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('assets/js/jquery.scrollTo.min.js')}}"></script>

    <!-- Wysihtml js -->
    <script src="{{asset('assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}"></script>

    <!--Summernote js-->
    <script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>


    <script src="{{asset('assets/js/app.js')}}"></script>

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
