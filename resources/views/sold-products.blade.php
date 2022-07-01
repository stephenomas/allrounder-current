@extends('layouts.header')
@section('admincontent')
<head>
    <title>Admin | View Product</title>
</head>
<div class="content">

    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Products</h4>
        </div>
    </div>

    <div class="page-content-wrapper ">

        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="m-b-30 m-t-0">Products</h4>
                            @if(session()->has('message'))
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                            </button>
                                            {{session()->get('message')}}
                                        </div>
                                        @endif
                            <table id="datatable-buttons" class="table table-stripe table-bordere dt-responsive nowrap" style="border-collapse: collapse; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Chasis Number</th>
                                        <th>Brand</th>
                                        <th>Engine Number</th>
                                        <th>Model</th>
                                        <th>Branch</th>
                                        <th>Buyer</th>
                                        <th>date</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ( $prod as $prods )
                                    <tr>
                                        <td>{{$prods->salesitem->sales->user->name ?? ''}}</td>
                                        <td>{{$prods->chasisnumber}}</td>
                                        <td>{{$prods->brand->name}}</td>
                                        <td>{{$prods->enginenumber}}</td>
                                        <td>{{$prods->spec->name}}</td>

                                        <td>{{$prods->user->branch->name}}</td>
                                        <td>
                                            {{$prods->salesitem->sales->name ?? ''}}
                                        </td>
                                        <td>
                                            {{$prods->salesitem->sales->created_at ?? ''}}
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
            <!-- End Row -->


        </div>
        <!-- container-fluid -->

    </div>
    <!-- Page content Wrapper -->
<!-- Required datatable js-->


@endsection
