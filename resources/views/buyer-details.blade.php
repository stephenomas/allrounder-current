@extends('layouts.header')
@section('admincontent')
<div class="content">

    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">New Sale</h4>
        </div>
    </div>

    <div class="page-content-wrapper ">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="m-t-0 m-b-30">New Sale</h4>

                            <form class="form-horizontal" method="post" action="/buyer-details">
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
                                <input type="number" hidden name='price' value="{{\Cart::session(Auth::user()->id)->getSubTotal()}}">
                               @include('partials.paymentmethods')
                               
                                <?php
                                $userId =  Auth::user()->id;
                                 $content = \Cart::session($userId)->getContent();
                                 ?>
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



@endsection
