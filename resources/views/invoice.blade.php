<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Allrounder | Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">

</head>

<style>
.signature {
    border: 0;
    border-bottom: 1px solid #000;
}
div{
    font-size: 16px;
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
                        <h4 class="page-title">Invoice</h4>
                    </div>
                </div>

                <div class="page-content-wrapper ">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <!-- <div class="panel-heading">
                                            <h4>Invoice</h4>
                                        </div> -->
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="invoice-title">

                                                </div>
                                                <hr>
                                                <div class="row mt-5 pt-5">
                                                    <div class="col-6 mt-4">
                                                        <address>
                                                            <strong>Billed By:</strong><br>
                                                            {{$sale->user->name}}<br>
                                                            Branch: {{$sale->user->branch->name}} <br>
                                                            Time: {{$sale->created_at}}
                                                        </address>
                                                    </div>

                                                    <div class="col-6 mt-4 text-right">
                                                        <address>
                                                            <strong>Billed To:</strong><br>
                                                            {{$sale->name}}<br>
                                                            {{$sale->address}}<br>
                                                            {{$sale->number}}<br>
                                                        </address>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <address>
                                                            <strong>Payment Method:</strong><br>
                                                            @php
                                                                $method = json_decode($sale->paymentmethod);
                                                                if(is_array($method)){
                                                                    $count = count($method);
                                                                    $string = '';
                                                                    foreach ($method as $key => $value) {
                                                                    if($value !== ""){
                                                                        if($key == ($count-1)){
                                                                            $string .= $value;
                                                                        }else{
                                                                            if($method[$key+1] != ""){
                                                                                $string .= $value.', ';
                                                                            }else{
                                                                                $string .= $value;
                                                                            }
                                                                        }
                                                                    }
                                                                    }
                                                                }else{
                                                                    $string = $sale->paymentmethod;
                                                                }

                                                            @endphp
                                                            {{$string}}
                                                            <br>

                                                            <strong>Staff:</strong><br>
                                                            {{$sale->email}}
                                                        </address>
                                                    </div>
                                                    <div class="col-6 text-right">
                                                        <address>
                                                            <strong>Order Date:</strong><br>
                                                            {{$sale->created_at}}<br>
                                                        </address>
                                                        <address>
                                                            <strong>Order # :</strong><br>
                                                            {{$sale->id}}<br>
                                                        </address>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="card-title text-dark m-0"><strong>Order summary</strong></h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                @if(empty($sale->ckd_type) || $sale->ckd_type == null)
                                                                    <thead>
                                                                        <tr>
                                                                            <td><strong>Brand</strong></td>
                                                                            <th>Color</th>
                                                                            <th>Chasis Number</th>
                                                                            <th>Engine Number</th>
                                                                            <th>Model</th>
                                                                            <td class="text-center"><strong>Price</strong></td>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach ($sale->salesitem as $item)
                                                                    <tr>
                                                                        <td>{{$item->product->brand->name}}</td>
                                                                        <td>{{$item->product->color}}</td>
                                                                        <td>{{$item->product->chasisnumber}}</td>
                                                                        <td>{{$item->product->enginenumber}}</td>
                                                                        <td>{{$item->product->spec->name}}</td>
                                                                        <td>{{$item->price}}</td>
                                                                    </tr>
                                                                    @endforeach

                                                                        <tr>
                                                                            <th>total</th>
                                                                            <th>{{number_format($sale->price)}}</th>
                                                                        </tr>
                                                                        @if ($sale->discountPrice)
                                                                        <tr>
                                                                            <th>Discount Price</th>
                                                                            <th>{{number_format($sale->discountPrice)}}</th>
                                                                        </tr>
                                                                        @endif

                                                                    </tbody>
                                                                @else
                                                                    <thead>
                                                                        <tr>
                                                                            <td><strong>CKD Type</strong></td>

                                                                            <th> Unit</th>
                                                                            @if($sale->no_of_engine != null || !empty($sale->no_of_engine))
                                                                            <th>Number of Engines</th>
                                                                            <th>Bolts & Buts</th>
                                                                            @endif


                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    <tr>
                                                                        <td>{{$sale->ckd_type}}</td>

                                                                        <td>{{$sale->unit}}</td>
                                                                        @if ($sale->no_of_engine != null || !empty($sale->no_of_engine))
                                                                        <td>{{$sale->no_of_engine}}</td>
                                                                        <td>{{$sale->no_of_bolts}}</td>
                                                                        @endif


                                                                    </tr>


                                                                        <tr>
                                                                            <th>total</th>
                                                                            <th>{{number_format($sale->price)}}</th>
                                                                        </tr>
                                                                        @if ($sale->discountPrice)
                                                                        <tr>
                                                                            <th>Discount Price</th>
                                                                            <th>{{number_format($sale->discountPrice)}}</th>
                                                                        </tr>
                                                                        @endif

                                                                    </tbody>
                                                                @endif
                                                            </table>
                                                        </div>

                                                        <br><br><br>
                                                        <div class="row text-center">
                                                        <div class="col-md-6"><input type="text" class="signature" /> <br>Signature and Date <br>For Official Use</div>
                                                        <div class="col-md-6"><input type="text" class="signature" /> <br>Signature and Date <br>For Customer</div>
                                                        </div>

                                                        <div class="hidden-print">
                                                            <div class="float-right">
                                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- end row -->
                                    </div>
                                    <!-- panel body -->
                                </div>
                                <!-- end panel -->

                            </div>
                            <!-- end col -->

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

    <script src="{{asset('assets/js/app.js')}}"></script>

</body>

</html>
