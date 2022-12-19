<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Allrounder | Edit User</title>
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
                        <h4 class="page-title">Add User</h4>
                    </div>
                </div>

                <div class="page-content-wrapper ">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="m-t-0 m-b-30">Edit User</h4>
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
                                        <form method="post" action="{{route('user.update', ['id'=>$user->id])}}" class="form-horizontal">
                                            @method('patch')
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="example-text-input">Username</label>
                                                <div class="col-sm-10">
                                                    <input type="text" required name="name" value="{{$user->name}}" class="form-control" placeholder="will sam" id="example-text-input">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="example-text-input">Email address</label>
                                                <div class="col-sm-10">
                                                    <input type="email" required name="email" value="{{$user->email}}" class="form-control" placeholder="wilL@mail.com" id="example-text-input">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="example-text-input">Phone Number</label>
                                                <div class="col-sm-10">
                                                    <input type="text" required name="phone" value="{{$user->phone}}" class="form-control" placeholder="245245224" id="example-text-input">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="example-chasis">New Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" name="password"  id="example-chasis" name="example-chasis" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="example-chasis">Confirm New password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" name="password_confirmation" id="example-chasis" name="example-chasis" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="example-text-input">What Branch?</label>
                                                <div class="col-sm-10">
                                                    <select name="branch" class="select2 form-control" id="product" searchable="Search here..">
                                                        <option value="{{$user->branch->id}}">{{$user->branch->name}}</option>
                                                            @foreach ($bran as $br)
                                                            <option value="{{$br->id}}">{{$br->name}}</option>
                                                            @endforeach



                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                    <label class="col-sm-2 control-label">Pages Given access to</label>
                                                    <div class="checkbox checkbox-primary checkbox-circle">
                                                        <input name="superadmin"  @if ($user->role == 1) checked  @endif value="1" id="checkbox-25" type="checkbox">
                                                        <label for="checkbox-25">
                                                                Super admin
                                                            </label><br>
                                                            <h4>Normal User</h4>
                                                        <input name="dashboard" @if ($user->access->dashboard == 1) checked  @endif value="1" id="checkbox-9" type="checkbox">
                                                        <label for="checkbox-9">
                                                                Dashboard
                                                            </label>
                                                           <br> <input name="addproduct" @if ($user->access->addproduct == 1) checked  @endif  value="1" id="checkbox-10" type="checkbox">
                                                        <label for="checkbox-10">
                                                                Add Product
                                                            </label>
                                                           <br> <input name="viewproduct" @if ($user->access->viewproduct == 1) checked  @endif value="1" id="checkbox-11" type="checkbox">
                                                        <label for="checkbox-11">
                                                                View Product
                                                            </label>
                                                            <br><input name="saleslist" @if ($user->access->saleslist == 1) checked  @endif value="1" id="checkbox-12" type="checkbox">
                                                        <label for="checkbox-12">
                                                                Sales List
                                                            </label>
                                                            <br><input name="newsale" @if ($user->access->newsale == 1) checked  @endif value="1" id="checkbox-13" type="checkbox">
                                                        <label for="checkbox-13">
                                                                New Sale
                                                            </label>
                                                            <br><input name="adduser" @if ($user->access->adduser == 1) checked  @endif value="1" id="checkbox-14" type="checkbox">
                                                        <label for="checkbox-14">
                                                                Add User
                                                            </label>
                                                            <br> <input name="viewuser" @if ($user->access->viewuser == 1) checked  @endif value="1" id="checkbox-15" type="checkbox">
                                                        <label for="checkbox-15">
                                                                View Users
                                                            </label>
                                                            <br> <input name="addbranch" @if ($user->access->addbranch == 1) checked  @endif value="1" id="checkbox-16" type="checkbox">
                                                        <label for="checkbox-16">
                                                                    Add Branch
                                                            </label>
                                                            <br> <input name="viewbranch" @if ($user->access->viewbranch == 1) checked  @endif value="1" id="checkbox-17" type="checkbox">
                                                        <label for="checkbox-17">
                                                                  View Branch
                                                            </label>
                                                            <br> <input name="addreport" @if ($user->access->addreport == 1) checked  @endif value="1" id="checkbox-18" type="checkbox">
                                                        <label for="checkbox-18">
                                                                Add Report
                                                            </label>
                                                            <br> <input name="viewreport" @if ($user->access->viewreport == 1) checked  @endif value="1" id="checkbox-19" type="checkbox">
                                                        <label for="checkbox-19">
                                                                    View Report
                                                            </label>
                                                            <br> <input name="addnumber" @if ($user->access->addnumber == 1) checked  @endif value="1" id="checkbox-20" type="checkbox">
                                                            <label for="checkbox-20">
                                                                    Add Number Plate
                                                                </label>
                                                                <br> <input name="numberlist" @if ($user->access->numberlist == 1) checked  @endif value="1" id="checkbox-21" type="checkbox">
                                                            <label for="checkbox-21">
                                                                    View Number Lists
                                                            </label>
                                                            <br> <input name="warehouse" @if ($user->access->warehouse == 1) checked  @endif value="1" id="checkbox-22" type="checkbox">
                                                            <label for="checkbox-22">
                                                                    Warehouse
                                                            </label>
                                                    </div>
                                            </div>

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
