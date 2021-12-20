@extends('layouts.header')
@section('admincontent')
<head>
    <title>Admin | Add Tricycle</title>
</head>
<div class="content">

    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Add Product</h4>
        </div>
    </div>

    <div class="page-content-wrapper ">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="m-t-0 m-b-30">Add Product</h4>
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
                            <form method="POST" action="/add-products" class="form-horizontal">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-text-input">Brand</label>
                                    <div class="col-sm-10">
                                        <select name="brand_id" required class="select2 form-control brandsel" id="product" searchable="Search here..">
                                            <option value="{{old('branch_id')}}">{{old('branch_id')}}</option>
                                                @foreach ($bran as $br)
                                                <option value="{{$br->id}}">{{$br->name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-password-input">Model</label>
                                    <div class="col-sm-10">
                                        <select name="spec_id" required class="select2 form-control modelsel" id="product" searchable="Search here..">


                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-chasis">Chasis Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{old('chasisnumber')}}" required name="chasisnumber" id="example-chasis" name="example-chasis" class="form-control" placeholder="e.g MD2A25BY6">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-password-input">Engine Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{old('enginenumber')}}"value="{{old('branch_id')}}" required name="enginenumber" class="form-control" placeholder="e.g AZZWL" id="example-password-input">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-textarea-input">Trampoline</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{old('trampoline')}}"  name="trampoline" class="form-control" placeholder="e.g brown" id="example-password-input">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-textarea-input">Remark</label>
                                    <div class="col-sm-10">
                                        <textarea name="remark" class="form-control" rows="5" id="example-textarea-input">{{old('remark')}}</textarea>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10">Add Product</button>

                            </form>
                        </div>
                        <!-- card-body -->
                    </div>
                    <!-- card -->
                </div>
                <!-- col -->
            </div>
            <!-- End row -->
           @section('extra-js')
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
                            $('.modelsel').empty()
                        $.each(res.data, function(index, value){

                           $('.modelsel').append('<option value="'+value.id+'" >'+value.name+'</option>');

                          });
                        })
                        .catch(function(error){
                            $('.modelsel').empty();
                        });

                 });


               });

           </script>

           @endsection
        </div>
        <!-- container -->

    </div>
    <!-- Page content Wrapper -->

@endsection
