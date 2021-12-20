@extends('layouts.header')
@section('admincontent')
<head>
    <title>Admin | View Model</title>
</head>
<div class="content">

    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Models</h4>
        </div>
    </div>

    <div class="page-content-wrapper ">

        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="m-b-30 m-t-0">Models</h4>
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
                                        <th>Model Name</th>
                                        <th>Brand</th>
                                        <th>Engine</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>branch</th>
                                        <th>Process</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ( $mod as $mo )
                                    <tr>
                                        <td>{{$mo->name}}</td>
                                        <td>{{$mo->brand->name}}</td>
                                        <td>{{$mo->engine}}</td>
                                        <td>{{$mo->type}}</td>
                                        <td>{{$mo->price}}</td>
                                        <td>{{$mo->branch->name}}</td>
                                        <td><a href="/view-model/{{$mo->id}}/edit"><i class="ti-pencil-alt"></i> Edit</a> <a href="/view-model/{{$mo->id}}/delete"><i class="ti-trash"></i> Delete</a></td>
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
