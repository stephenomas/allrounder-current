<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Allrounder | Edit Model</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <title>Admin | Edit Ckd</title>
    <link href="{{asset('assets/plugins/timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">

</head>


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

    @include('partials.topbar')
    @include('partials.sidebar')


<div class="content-page">

    <div class="content">

    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Edit Ckd</h4>
        </div>
    </div>

    <div class="page-content-wrapper ">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="m-t-0 m-b-30">Edit Ckd</h4>
                            @if ($errors->count() > 0)
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                @foreach ($errors->all() as $message)
                                    {{$message}} <br>
                                @endforeach
                            </div>

                            @endif
                            @if(session()->has('message'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                {{session()->get('message')}}
                            </div>
                            @endif
                            @if(session()->has('error'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                {{session()->get('error')}}
                            </div>
                            @endif
                            <form method="POST" action="/edit-ckd/{{$ckd->id}}/edit" class="form-horizontal">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-textarea-input">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text"  required value="{{$ckd->name}}" disabled  name="name" class="form-control"id="example-password-input">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-textarea-input">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" required value="{{$ckd->type}}" disabled  name="name" class="form-control"  id="example-password-input">
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-textarea-input">Amount</label>
                                    <div class="col-sm-10">
                                        <input type="number" required value="{{$ckd->amount}}"  name="amount" class="form-control" placeholder="e.g 50" id="example-password-input">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-textarea-input">Remark</label>
                                    <div class="col-sm-10">
                                        <textarea name="remark" class="form-control" rows="5" id="example-textarea-input">{{$ckd->remark}}</textarea>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10">Edit Ckd</button>

                            </form>
                        </div>
                        <!-- card-body -->
                    </div>
                    <!-- card -->
                </div>
                <!-- col -->
            </div>
            <!-- End row -->

        </div>
        <!-- container -->

    </div>
    <!-- Page content Wrapper -->

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

    <script src="{{asset('assets/plugins/timepicker/bootstrap-timepicker.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>

    <!-- Plugins Init js -->
    <script src="{{asset('assets/pages/form-advanced.js')}}"></script>

    <script src="{{asset('assets/js/app.js')}}"></script>

</div></body>

</html>
