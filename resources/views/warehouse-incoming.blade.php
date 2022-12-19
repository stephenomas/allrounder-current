<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Allrounder | New CBU Transfer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

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
                        <h4 class="page-title">CBU</h4>
                    </div>
                </div>

                <div class="page-content-wrapper ">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card card-fill bg-light">
                                    <div class="card-body">
                                        <h4 class="m-t-0">Set Spec ID</h4>
                                        @if ($errors->count() > 0)
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                            </button>
                                            @foreach ($errors->all() as $message)
                                                {{$message}} <br>
                                            @endforeach
                                        </div>

                                        @endif
                                        @if (session()->has('success'))
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                            </button>

                                                {{session()->get('success')}} <br>
                                        </div>
                                        @endif
                                        <div class="row">


                                            @foreach ( $packages as $package )

                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="m-b-30 m-t-0">{{$package->cbu ? 'CBU' : 'CKD'}}
                                                            <span class="text-primary float-right dropdown show">
                                                                <i class="ti-more dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                                                    <a class="dropdown-item" href="/warehouse-transfers/{{$package->id}}">View All Items in Group</a>
                                                                </div>
                                                            </span>
                                                        </h4>
                                                        <form method="post" action="/warehouse-incoming">
                                                        @csrf
                                                        @if ($package->cbu != null)
                                                        @php
                                                            $items = json_decode($package->cbu)

                                                        @endphp


                                                        <input type="text" hidden value="{{$package->id}}" name="package">
                                                        @foreach ( $items as $key => $value )
                                                        @php
                                                            $spec = App\Models\Spec::find($key);
                                                        @endphp
                                                            <div class="d-flex justify-content-between">

                                                                <span>
                                                                    <h5>{{$spec->name}}</h5>
                                                                </span>
                                                                <span>
                                                                    <h5><span class="text-primary float-right">{{count($value)}}</span></h5>
                                                                </span>
                                                                <span class="pl-2">
                                                                    <select name="spec[]" required class="form-control">
                                                                        <option value=""  >select new spec</option>
                                                                        @foreach ( $specs as $sp )
                                                                        <option value="{{$sp->id}}"  >{{$sp->name}}</option>
                                                                        @endforeach
                                                                </select>
                                                                </span>
                                                            </div>
                                                        @endforeach

                                                        @else
                                                            <div class="d-flex justify-content-between">

                                                                <span>
                                                                    <h5>{{$package->spec->name}}</h5>
                                                                </span>
                                                                <span>
                                                                    <h5><span class="text-primary float-right">{{$package->no_of_ckd}}</span></h5>
                                                                </span>
                                                                <input type="text" hidden value="{{$package->id}}" name="package">
                                                                <span class="pl-2">
                                                                    <select name="spec" required class="form-control">
                                                                        <option value=""  >select new spec</option>
                                                                        @foreach ( $specs as $sp )
                                                                        @if(stripos($sp->name, 'ckd'))
                                                                        @php
                                                                            $ckd = App\Models\Ckd::where('spec_id', $sp->id)->first();
                                                                        @endphp
                                                                        @if ($ckd)
                                                                        <option value="{{$sp->id}}"  >{{$sp->name}}</option>
                                                                        @endif
                                                                        @endif
                                                                        @endforeach
                                                                </select>
                                                                </span>
                                                            </div>
                                                        @endif
                                                        <h5>Branch Source <span class="text-primary float-right">{{$package->branch->name}}</span></h5>
                                                        <h5>Date Added <span class="text-primary float-right">{{$package->created_at}}</span></h5>
                                                        <p> <button type="submit" class="btn btn-success waves-effect waves-light"><i class="ti-check"></i> Accept</button></p>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>

                                            @endforeach


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title m-0" id="custom-width-modalLabel">CBU Group 1</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-inline">
                                                <div class="form-group">
                                                    <label class="sr-only" for="exampleInputID">Spec ID</label>
                                                    <input type="text" class="form-control" id="exampleInputID" placeholder="Enter Spec ID">
                                                </div>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10">Apply to all</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                            <!-- <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button> -->
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                        </div>
                        <!-- end row -->

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

<script src="assets/plugins/timepicker/bootstrap-timepicker.js"></script>
<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<!-- Plugins Init js -->
<script src="assets/pages/form-advanced.js"></script>

<script src="assets/js/app.js"></script>
<script>
$('.select2').select2();
</script>
<script>
$('#product').change(function() {
// get the class of the selected option
var select_class = $("option:selected", this).attr("class");
// clone all options from the pot select
var $options = $('#pot > option.' + select_class).clone();
// delete all of the options in the township select and append
// the new options
$('#township')
    .find('option')
    .remove()
    .end()
    .append($options);
});
</script>

</body>

</html>
