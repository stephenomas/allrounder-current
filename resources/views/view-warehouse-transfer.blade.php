@extends('layouts.header')
@section('admincontent')
<div class="content">


            <div class="">
                <div class="page-header-title">
                    <h4 class="page-title">Transfer Details</h4>
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
                                                <h4 class="float-right">Transfer Details</h4>
                                                <h3 class="m-t-0"><img src="assets/images/logo-dark.png" alt="" height="40"></h3>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <address>
                                                        <strong>Transfered From:</strong><br>
                                                        {{$warehouse->user->name}} / Branch: {{$warehouse->branch->name}} Branch/ Time: {{$warehouse->created_at}}
                                                    </address>
                                                </div>
                                                <div class="col-6">
                                                    <address>
                                                        <strong>Transfered To:</strong><br>
                                                       Branch: {{$warehouse->transfer_destination->name}} Branch / Received by : {{$warehouse->receiver_id != null ? $warehouse->receiver->name: ''}}
                                                    </address>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title text-dark m-0"><strong>Transfer summary</strong></h5>
                                                </div>
                                                <div class="card-body">
                                                    @if ($warehouse->cbu != null && $warehouse->cbu != '')
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <td><strong>S/N</strong></td>
                                                                    <td><strong>Chassis Number</strong></td>
                                                                    <td><strong>Engine Number</strong></td>
                                                                    <td><strong>Item Type</strong></td>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $specs= json_decode($warehouse->cbu);
                                                                    $sn = 0;
                                                                @endphp
                                                                @foreach ($specs as $spec => $cbus )
                                                                    @foreach ( $cbus as $cbu )
                                                                        @php
                                                                            $prod = App\Models\Product::find($cbu);
                                                                            $sn++;
                                                                        @endphp
                                                                        <tr>
                                                                            <td>{{$sn}}</td>
                                                                            <td>{{$prod->chasisnumber}}</td>
                                                                            <td>{{$prod->enginenumber}}</td>
                                                                            <td>{{$prod->spec->name}}</td>

                                                                        </tr>
                                                                    @endforeach
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    @else
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <td><strong>Ckd</strong></td>
                                                                        <td><strong>Amount</strong></td>
                                                                        @if ($warehouse->no_of_bolts != null)
                                                                        <td class=""><strong>No of Bolts</strong></td>
                                                                        <td class=""><strong>No of Engines</strong></td>
                                                                        @endif
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <!-- foreach (₦order->lineItems as ₦line) or some such thing here -->
                                                                    <tr>
                                                                        <td>{{$warehouse->spec->name}}</td>
                                                                        <td class="">{{$warehouse->no_of_ckd}}</td>
                                                                        @if ($warehouse->no_of_bolts != null)
                                                                        <td>{{$warehouse->no_of_bolts}}</td>
                                                                        <td>{{$warehouse->no_of_engine}}</td>
                                                                        @endif
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    @endif





                                                    <div class="hidden-print">
                                                        <div class="float-right">
                                                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"> Print<i class="fa fa-print"></i></a>

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
            © 2019 - 2022 Allrounder
        </footer>

    </div>


@endsection
