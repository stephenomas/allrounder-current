@extends('layouts.header')
@section('admincontent')
<head>
    <title>Admin | View Inventory</title>
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
                            <h4 class="m-b-30 m-t-0">Available Products</h4>
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
                                        <th>Chasis Number</th>
                                        <th>Brand</th>
                                        <th>Engine Number</th>
                                        <th>Model</th>
                                        <th>Status</th>
                                        <th>Branch</th>
                                        <th>Process</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ( $prod as $prods )
                                    <tr>
                                        <td>{{$prods->user->name}}</td>
                                        <td>{{$prods->chasisnumber}}</td>
                                        <td>{{$prods->brand->name}}</td>
                                        <td>{{$prods->enginenumber}}</td>
                                        <td>{{$prods->spec->name}}</td>
                                        <td>{{$prods->status}}</td>
                                        <td>{{$prods->user->branch->name}}</td>
                                        <td><a href="edit-product/{{$prods->chasisnumber}}"><i class="ti-pencil-alt"></i> Edit</a> <a href="/edit-product/{{$prods->id}}/delete"><i class="ti-trash"></i> Delete</a></td>
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
