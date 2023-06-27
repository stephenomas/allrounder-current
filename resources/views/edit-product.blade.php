
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Allrounder | Edit Product</title>
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
                        <h4 class="page-title">Edit Product</h4>
                    </div>
                </div>

                <div class="page-content-wrapper ">

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="m-t-0 m-b-30">Edit Product</h4>
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
                                        <form method="POST" action="/edit-product/{{$prod->chasisnumber}}" class="form-horizontal">
                                            @method('put')
                                            @csrf
                                            <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-text-input">Brand</label>
                                    <div class="col-sm-10">
                                        <select name="brand_id" class="select2 form-control brandsel" id="product" searchable="Search here..">
                                            <option value="{{$prod->brand->id}}">{{$prod->brand->name}}</option>
                                                @foreach ($bran as $br)
                                                <option value="{{$br->id}}">{{$br->name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-chasis">Chasis Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{$prod->chasisnumber}}" required name="chasisnumber" id="example-chasis" name="example-chasis" class="form-control" placeholder="e.g MD2A25BY6">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-password-input">Engine Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" required value="{{$prod->enginenumber}}" name="enginenumber" class="form-control" placeholder="e.g AZZWL" id="example-password-input">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-password-input">Model</label>
                                    <div class="col-sm-10">
                                        <select name="spec_id"  required class="select2 form-control modelsel" id="product" searchable="Search here..">
                                            <option value="{{$prod->spec->id}}">{{$prod->spec->name}}</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-password-input">Color</label>
                                    <div class="col-sm-10">
                                        <select name="color" required class="select2 form-control " searchable="Search here..">
                                            <option value="{{$prod->color}}">{{$prod->color}}</option>
                                            <option value="Red">RED</option>
                                            <option value="Blue">BLUE</option>
                                            <option value="Black">BLACK</option>
                                            <option value="Yellow">YELLOW</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-textarea-input">Trampoline</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{$prod->trampoline}}"  name="trampoline" class="form-control" placeholder="e.g brown" id="example-password-input">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-textarea-input">Remark</label>
                                    <div class="col-sm-10">
                                        <textarea name="remark"  class="form-control" rows="5" id="example-textarea-input">{{$prod->remark}}</textarea>
                                    </div>
                                </div>


                                            <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10">Update Product</button>

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
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        $(document).ready(function() {

           var brand =  $('.brandsel').val();
            var url = '/brand/'+brand;

          axios.get(url).then((res) =>{
           $.each(res.data, function(index, value){

             $('.modelsel').append('<option value="'+value.id+'" >'+value.name+'</option>');
           });
          })
          .catch(function(error){
                     $('.modelsel').empty();
                 });;

          $('.brandsel').change(function(){
                     var brand =  $('.brandsel').val();
                 var url = '/brand/'+brand;

                 axios.get(url).then((res) =>{
                 $.each(res.data, function(index, value){

                    $('.modelsel').empty().append('<option value="'+value.id+'" >'+value.name+'</option>');

                   });
                 })
                 .catch(function(error){
                     $('.modelsel').empty();
                 });

          });


        });

    </script>

</body>

</html>
