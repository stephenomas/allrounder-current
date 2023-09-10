@extends('layouts.header')
@section('admincontent')
<div class="content">

    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">New Sale CKD</h4>
        </div>
    </div>

    <div class="page-content-wrapper ">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="m-t-0 m-b-30">New Sale CKD</h4>
                            @if ($errors->count() > 0)
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                @foreach ($errors->all() as $message)
                                    {{$message}} <br>
                                @endforeach
                            </div>

                            @endif
                            @if(session()->has('failed'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                {{session()->get('failed')}}
                            </div>
                            @endif
                            <form class="form-horizontal" method="post" action="/new-sale-ckd">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-text-input">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" required class="form-control" placeholder="amusa saheed" id="example-text-input">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-email">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" id="example-email" name="email" class="form-control" placeholder="e.g abc@xyz.com">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-password-input">Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="number" maxlength="11" minlength="11" required class="form-control" placeholder="080" id="example-password-input">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-textarea-input">Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" required name="address" rows="5" id="example-textarea-input"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-password-input">CKD Type/Model:</label>
                                    <div class="col-sm-10">
                                        <select name="ckd_type" required class="select2 form-control brandsel" id="product" searchable="Search here..">
                                            @foreach ( $specs as $spec)
                                                <option value="{{$spec->id}}">{{$spec->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-text-input">Number of CKD:</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="no_of_ckd" required class="form-control" placeholder="20" id="example-text-input">
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label class="col-sm-2 engine control-label" for="example-text-input">Number of Engine:</label>
                                    <div class="col-sm-10">
                                        <input type="decimal" name="engines"  class="form-control bolt" placeholder="10" id="example-text-input">
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label class="col-sm-2 control-label bolt" for="example-text-input">Number of Bolts & Nuts:</label>
                                    <div class="col-sm-10">
                                        <input type="decimal" name="bolts"  class="form-control  bolt" placeholder="24" id="example-text-input">
                                    </div>
                                </div>

                                @include('partials.paymentmethods')
                               

                            <button type="submit" name="sub" class="btn btn-primary waves-effect waves-light m-l-10">Proceed</button>
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
    @section('extra-js')
        <script src="{{asset('js/app.js')}}"></script>
        <script>
             const check = (brand) => {
                var text = JSON.stringify(brand)
                //console.log(brand);
                if(text.includes('MOTOR') || text.includes("Motor") || text.includes("motor")){
                    $('.bolt').css('display','inline');

                    $('.engine').css('display','inline');
                }else{

                    $('.bolt').css('display','none');
                    $('.engine').css('display','none');
                }
            }
            $(document).ready(function() {
                var brand =  $('.brandsel').find(":selected").text();
                check(brand);
                $('.brandsel').change(function(){
                    var brand =  $('.brandsel').find(":selected").text();
                     check(brand);

                });


            })

        </script>
    @endsection
@endsection
