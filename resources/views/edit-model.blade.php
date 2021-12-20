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

        <!-- Start right Content here -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <div class="">
                    <div class="page-header-title">
                        <h4 class="page-title">Edit Model</h4>
                    </div>
                </div>

                <div class="page-content-wrapper ">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="m-t-0 m-b-30">Edit Model</h4>
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
                                        <form method="post" action="/view-model/{{$spec->id}}/edit" class="form-horizontal">
                                            @csrf
                                            @method('put')
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="example-text-input">Brand Name</label>
                                                <div class="col-sm-10">
                                                    <select name="brand" class="select2 form-control" id="product" searchable="Search here..">
                                                        <option value="{{$spec->brand_id}}">{{$spec->brand->name}}</option>
                                                            @foreach ($bran as $br)
                                                            <option value="{{$br->id}}">{{$br->name}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="example-text-input">Model Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="name" value="{{$spec->name}}" required class="form-control" placeholder="e.g Rs 45" id="example-text-input">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="example-text-input">Type of machine</label>
                                                <div class="col-sm-10">
                                                    <select name="type" class="select2 form-control" id="product" searchable="Search here..">
                                                             <option >{{$spec->type}}</option>

                                                            <option>Tricycle</option>
                                                            <option >Motorcycle</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="example-text-input">Engine</label>
                                                <div class="col-sm-10">
                                                    <input type="text" value="{{$spec->engine}}" name="engine" required class="form-control" placeholder="e.g 1900c " id="example-text-input">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="example-text-input">Price</label>
                                                <div class="col-sm-10">
                                                    <input type="number" value="{{$spec->price}}" name="price" required class="form-control" placeholder="6000" id="example-text-input">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="example-text-input">Minimum digits of chasis number</label>
                                                <div class="col-sm-10">
                                                    <input type="number" value="{{$spec->chasisdigit}}" name="chasisdigit" required class="form-control" placeholder="e.g Bajaj" id="example-text-input">
                                                </div>
                                            </div><div class="form-group row">
                                                <label class="col-sm-2 control-label" for="example-text-input">Minimum digits of engine number</label>
                                                <div class="col-sm-10">
                                                    <input type="number" value="{{$spec->enginedigit}}" name="enginedigit" required class="form-control" placeholder="e.g Bajaj" id="example-text-input">
                                                </div>
                                            </div>
                                            @if (Auth::user()->role == 1)
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="example-text-input">What Branch?</label>
                                                <div class="col-sm-10">
                                                    <select name="branch" class="select2 form-control" id="product" searchable="Search here..">
                                                            <option value="{{$spec->branch->id}}" selected>{{$spec->branch->name}}</option>
                                                            @foreach ($branch as $br)
                                                            @if ($spec->branch_id != $br->id)
                                                            <option value="{{$br->id}}">{{$br->name}}</option>
                                                            @endif

                                                            @endforeach



                                                    </select>
                                                </div>
                                            </div>
                                            @endif


                                            <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10">Update</button>

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

    <script src="{{asset('assets/plugins/timepicker/bootstrap-timepicker.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>

    <!-- Plugins Init js -->
    <script src="{{asset('assets/pages/form-advanced.js')}}"></script>

    <script src="{{asset('assets/js/app.js')}}"></script>

</body>

</html>
