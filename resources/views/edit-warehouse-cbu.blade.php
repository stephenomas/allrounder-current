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

    <link href="{{asset('')}}assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="{{asset('')}}assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="{{asset('')}}assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="{{asset('')}}assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

    <link href="{{asset('')}}assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('')}}assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="{{asset('')}}assets/css/style.css" rel="stylesheet" type="text/css">
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
            <h4 class="page-title">Edit CBU Transfer</h4>
        </div>
    </div>

    <div class="page-content-wrapper ">

        <div class="container-fluid" style="overflow-y: scroll; height:600px;">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="m-t-0 m-b-30">Edit CBU Transfer</h4>


                                @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>

                                        {{session()->get('success')}} <br>

                                </div>

                                @endif

                            <?php
                             $content = json_decode($warehouse->cbu);
                             $count = 0;
                             ?>

                            <div class="row">
                                @foreach ($content as $con => $values)
                                    @foreach ( $values as $value )
                                    @php
                                        $prod = App\Models\Product::find($value)
                                    @endphp

                                        <div class="col-lg-4">
                                            <div class="card">
                                                <div class="card-body user-card">
                                                    <div class="media-main">
                                                        <a class="float-left" href="#">

                                                        </a>
                                                        <div class="info pl-3">
                                                            <h4 class="mt-3">{{$prod->chasisnumber}}</h4>


                                                        </div>


                                                    </div>
                                                </div>
                                                <!-- card-body -->
                                            </div>
                                        </div>
                                        @php
                                            $count ++;
                                        @endphp
                                    @endforeach
                                @endforeach
                            </div>
                            <h4 class="text-primary ml-3">Count: {{$count}}</h4>
                            @if ($count > 0)
                            <form action="/warehouse-transfers/{{$warehouse->id}}/edit" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-textarea-input">Destination Branch</label>
                                    <div class="col-sm-10">
                                       <select name="branch" class="form-control">
                                        <option value="{{$warehouse->destination_id}}">{{$warehouse->transfer_destination->name}}</option>
                                        @foreach ( $branches as $branch )
                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                        @endforeach
                                       </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10">Edit</button><p><br></p>
                            </form>

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
<script src="{{asset('')}}assets/js/jquery.min.js"></script>
<script src="{{asset('')}}assets/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('')}}assets/js/modernizr.min.js"></script>
<script src="{{asset('')}}assets/js/detect.js"></script>
<script src="{{asset('')}}assets/js/fastclick.js"></script>
<script src="{{asset('')}}assets/js/jquery.slimscroll.js"></script>
<script src="{{asset('')}}assets/js/jquery.blockUI.js"></script>
<script src="{{asset('')}}assets/js/waves.js"></script>
<script src="{{asset('')}}assets/js/wow.min.js"></script>
<script src="{{asset('')}}assets/js/jquery.nicescroll.js"></script>
<script src="{{asset('')}}assets/js/jquery.scrollTo.min.js"></script>
<script src="{{asset('')}}assets/plugins/timepicker/bootstrap-timepicker.js"></script>
<script src="{{asset('')}}assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="{{asset('')}}assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="{{asset('')}}assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="{{asset('')}}assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<!-- Plugins Init js -->
<script src="{{asset('')}}assets/pages/form-advanced.js"></script>

<script src="{{asset('')}}assets/js/app.js"></script>
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
