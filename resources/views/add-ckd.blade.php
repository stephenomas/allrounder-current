@extends('layouts.header')
@section('admincontent')
<head>
    <title>Admin | Add Ckd</title>
</head>
<div class="content">

    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Add Ckd</h4>
        </div>
    </div>

    <div class="page-content-wrapper ">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="m-t-0 m-b-30">Add Ckd</h4>
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
                            <form method="POST" action="/add-ckd" class="form-horizontal">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-password-input">Name</label>
                                    <div class="col-sm-10">
                                        <select name="name" required class="select2 form-control modelsel" id="product" searchable="Search here..">
                                            @foreach ( $specs as $spec)
                                            <option value="{{$spec->id}}">{{$spec->name}}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-password-input">Type</label>
                                    <div class="col-sm-10">
                                        <select name="type" required class="select2 form-control modelsel" id="product" searchable="Search here..">
                                            <option value="Motorcycle">Motorcycle</option>
                                            <option value="Tricycle">Tricycle</option>
                                        </select>
                                    </div>
                                </div>
                                    


                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-textarea-input">Amount</label>
                                    <div class="col-sm-10">
                                        <input type="number" value="{{old('amount')}}" required  name="amount" class="form-control" placeholder="e.g 50" id="example-password-input">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-textarea-input">Remark</label>
                                    <div class="col-sm-10">
                                        <textarea name="remark" class="form-control" rows="5" id="example-textarea-input">{{old('remark')}}</textarea>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary waves-effect waves-light m-l-10">Add Ckd</button>

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


           @endsection
        </div>
        <!-- container -->

    </div>
    <!-- Page content Wrapper -->

@endsection
