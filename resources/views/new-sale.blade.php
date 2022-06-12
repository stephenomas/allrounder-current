<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Allrounder | New Sale</title>
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
            <h4 class="page-title">New Sale</h4>
        </div>
    </div>

    <div class="page-content-wrapper ">

        <div class="container-fluid" style="overflow-y: scroll; height:600px;">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="m-t-0 m-b-30">New Sale</h4>
                            <form class="form-horizontal" action="/addtocart" method="post">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="control-label">Product</label>
                                        <br><select class="select2 form-control" name="product" id="product" searchable="Search here..">
                                                <option disabled selected>Select a product</option>
                                                @foreach ($prod as $prods)
                                                <option value="{{$prods->chasisnumber}}">{{$prods->chasisnumber}}</option>
                                                @endforeach



                                        </select>

                                    </div>
                                    <!-- <div class="col-md-3">
                                        <label class="control-label">Quantity</label>
                                        <br><input type="number" name="quant" class="form-control" value="1" readonly>

                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Price</label>
                                        <br><input type="number" name="price" class="form-control" value="300" readonly>

                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Measurement</label>
                                        <br><select class="form-control" name="size" searchable="Search here..">
                                            <option disabled selected>How do you measure this</option>
                                            <option value="kg">Kilogram</option>
                                            <option value="g">Gram</option>
                                            <option value="item(s)">per Item</option>
                                        </select>

                                    </div> -->
                                    <div class="col-md-6">
                                        <label class="control-label">Note</label>
                                        <br><input type="text"  name="note" class="form-control">

                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10">Add to cart</button>

                            </form>
                            <?php
                            $userId =  Auth::user()->id;
                             $content = \Cart::session($userId)->getContent();
                             ?>
                             <h4 class="text-primary ml-3">Cart: {{$content->count()}}</h4>
                            <div class="row">
                                @foreach ($content as $con)
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body user-card">
                                            <div class="media-main">
                                                <a class="float-left" href="#">

                                                </a>
                                                <div class="info pl-3">
                                                    <h4 class="mt-3">{{$con->name}}</h4>
                                                    <p class="text-muted">N {{number_format($con->price)}} X {{$con->quantity}}</p>
                                                    <p class="text-muted">{{$con->attributes->note}}</p>
                                                    <a href="/removecart/{{$con->id}}" class="text-danger">Delete</a>
                                                </div>


                                            </div>
                                        </div>
                                        <!-- card-body -->
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @if ($content->count() > 0)
                            <a href="buyer-details" class="btn btn-primary waves-effect waves-light m-l-10">Checkout</a><p><br></p>
                            @endif


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
