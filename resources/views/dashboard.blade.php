<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Allrounder | Admin</title>
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

</head>
<style>
.invisible {
  visibility: hidden;
}
</style>
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
                        <h4 class="page-title">Dashboard</h4>
                    </div>

                </div>

                <div class="page-content-wrapper ">
                    @if (App\Helpers\Utilities::notification())
                    <div class="alert alert-danger alert-dismissible bg-danger text-light" role="alert">

                            Please Accept Pending Incoming Request From Warehouse
                             <br>
                    </div>
                 @endif
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-heading p-4">
                                        <div>
                                            <input class="knob" data-width="80" data-height="80" data-linecap=round data-fgColor="#6cbafa" value="{{$soldm->count()}}" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".15" />
                                            <div class="float-right">
                                                <h2 class="text-primary mb-0">{{$soldm->count() + $ckdsoldm->sum('unit')}}</h2>
                                                <p class="text-muted mb-0 mt-2">Total Motorcycle Sales</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-heading p-4">
                                        <div>
                                            <input class="knob" data-width="80" data-height="80" data-linecap=round data-fgColor="#6cbafa" value="{{$soldt->count()}}" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".15" />
                                            <div class="float-right">
                                                <h2 class="text-primary mb-0">{{$soldt->count()+ $ckdsoldt->sum('unit')}}</h2>
                                                <p class="text-muted mb-0 mt-2">Total Tricycle Sales</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-heading p-4">
                                        <div>
                                            <input class="knob" data-width="80" data-height="80" data-linecap=round data-fgColor="#61d7c7" value="{{$todaym}}" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".15" />
                                            <div class="float-right">
                                                <h2 class="text-info mb-0">{{$todaym}}</h2>
                                                <p class="text-muted mb-0 mt-2">Today Motorcycle Sale</p>
                                            </div>
                                            <p class="mt-4 mb-0 text-muted">Sales from Last 24 hours</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-heading p-4">
                                        <div>
                                            <input class="knob" data-width="80" data-height="80" data-linecap=round data-fgColor="#61d7c7" value="{{$todayt}}" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".15" />
                                            <div class="float-right">
                                                <h2 class="text-info mb-0">{{$todayt}}</h2>
                                                <p class="text-muted mb-0 mt-2">Today Tricycle Sale</p>
                                            </div>
                                            <p class="mt-4 mb-0 text-muted">Sales from Last 24 hours</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-heading p-4">
                                        <div>
                                            <input class="knob" data-width="80" data-height="80" data-linecap=round data-fgColor="#61d7c7" value="{{$availm->count() + $ckdm}}" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".15" />
                                            <div class="float-right">
                                                <h2 class="text-info mb-0">{{ $availm->count()}}</h2>
                                                <p class="text-muted mb-0 mt-2">CBU Motorcycle</p>
                                                <!-- <p class="text-muted mb-0 mt-2">Unique Visitors</p> -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-heading p-4">
                                        <div>
                                            <input class="knob" data-width="80" data-height="80" data-linecap=round data-fgColor="#61d7c7" value="{{$availm->count() + $ckdm}}" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".15" />
                                            <div class="float-right">
                                                <h2 class="text-info mb-0">{{$availt->count()}}</h2>
                                                <p class="text-muted mb-0 mt-2">CBU Tricycle</p>
                                                <!-- <p class="text-muted mb-0 mt-2">Unique Visitors</p> -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-heading p-4">
                                        <div>
                                            <input class="knob" data-width="80" data-height="80" data-linecap=round data-fgColor="#61d7c7" value="{{$availm->count() + $ckdm}}" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".15" />
                                            <div class="float-right">
                                                <h2 class="text-info mb-0">{{ $ckdm}}</h2>
                                                <p class="text-muted mb-0 mt-2">CKD Motorcycle</p>
                                                <!-- <p class="text-muted mb-0 mt-2">Unique Visitors</p> -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-heading p-4">
                                        <div>
                                            <input class="knob" data-width="80" data-height="80" data-linecap=round data-fgColor="#61d7c7" value="{{$availm->count() + $ckdm}}" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".15" />
                                            <div class="float-right">
                                                <h2 class="text-info mb-0">{{$ckdt}}</h2>
                                                <p class="text-muted mb-0 mt-2">CKD Tricycle</p>
                                                <!-- <p class="text-muted mb-0 mt-2">Unique Visitors</p> -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-heading p-4">
                                        <div>
                                            <input class="knob" data-width="80" data-height="80" data-linecap=round data-fgColor="#6cbafa" value="{{$availt->count()+ $ckdt}}" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".15" />
                                            <div class="float-right">
                                                <h2 class="text-primary mb-0">{{$availt->count() + $ckdt}}</h2>
                                                <p class="text-muted mb-0 mt-2">Available Tricycle</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-heading p-4">
                                        <div>
                                            <input class="knob" data-width="80" data-height="80" data-linecap=round data-fgColor="#61d7c7" value="{{$availm->count() + $ckdm}}" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".15" />
                                            <div class="float-right">
                                                <h2 class="text-info mb-0">{{$availm->count() + $ckdm}}</h2>
                                                <p class="text-muted mb-0 mt-2">Available Motorcycle</p>
                                                <!-- <p class="text-muted mb-0 mt-2">Unique Visitors</p> -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>


                        <!-- end row -->

                        <div class="row">
                        <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="m-b-30 m-t-0">Report</h4>
                                        <div class="inbox-widget slimscroller" style="max-height:360px;">
                                            @foreach ($report as $rep)
                                            <div class="media inbox-item">
                                                <img class="mr-3 rounded-circle" src="assets/images/users/avatar-1.jpg" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="mt-0">{{$rep->user->name}}</h5>
                                                    <p class="text-muted">{{$rep->title}} ......</p>
                                                    <p class="inbox-item-time">{{$rep->created_at}}</p>
                                                </div>
                                            </div>

                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-xl-4 invisible">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="m-b-30 m-t-0">Monthly Earning</h4>

                                        <div id="website-stats" style="height: 200px" class="flot-chart"></div>

                                        <!-- <div class="row mt-4 pt-2">
                                            <div class="col-lg-6">
                                                <div class="text-center pl-4 pr-4">
                                                    <h4 class="mb-0 text-primary">This Month</h4>
                                                    <p class="text-muted mt-2">It will be as simple as in fact it will be occidental.</p>
                                                    <h4>$34,252 </h4>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="text-center pl-4 pr-4">
                                                    <h4 class="mb-0 text-primary">Last Month</h4>
                                                    <p class="text-muted mt-2">It will be as simple as in fact it will be occidental.</p>
                                                    <h4>$36,253</h4>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row invisible">
                            <div class="col-xl-7">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="m-t-0 m-b-30">Multiple Statistics</h4>
                                        <div id="combine-chart-container" class="flot-chart" style="height: 360px"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="m-t-0 m-b-30">Realtime Statistics</h4>
                                        <div id="pie-chart-container" class="flot-chart" style="height: 360px"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- end row -->

                        </div>
                        <!-- container-fluid -->

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

    <script src="assets/js/app.js"></script>

</body>

</html>
