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
                            @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>

                                    {{session()->get('success')}} <br>
                            </div>
                            @endif
                            <form class="form-horizontal" method="post" action="/warehouse-transfers/{{$warehouse->id}}/edit">
                                @csrf





                            <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-password-input">CKD Type/Model:</label>
                                    <div class="col-sm-10">
                                        <select name="ckd_type" disabled required class="select2 form-control brandsel" id="product" searchable="Search here..">
                                            <option value="{{$warehouse->spec->ckd->id}}">{{$warehouse->spec->name}}</option>
                                            


                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label" for="example-text-input">Number of CKD:</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="no_of_ckd" value={{$warehouse->no_of_ckd}} required class="form-control" placeholder="20" id="example-text-input">
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label class="col-sm-2 engine control-label" for="example-text-input">Number of Engine:</label>
                                    <div class="col-sm-10">
                                        <input type="decimal" name="engines" value={{$warehouse->no_of_engine}}  class="form-control bolt" placeholder="10" id="example-text-input">
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label class="col-sm-2 control-label bolt" for="example-text-input">Number of Bolts & Nuts:</label>
                                    <div class="col-sm-10">
                                        <input type="decimal" name="bolts" value={{$warehouse->no_of_bolts}} class="form-control  bolt" placeholder="24" id="example-text-input">
                                    </div>
                                </div>

                                <div class="form-group row ">
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
