@extends('layouts.header')
@section('admincontent')
<div class="content">

    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Number Plates</h4>
        </div>
    </div>

    <div class="page-content-wrapper ">

        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="m-b-30 m-t-0">Number Plates list</h4>
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
                                        <th>Id</th>
                                        <th>Number Plate</th>
                    
                                        <th>Date</th>
                                        <th>Process</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($sale as $sales)


                                    <tr>
                                        <td>{{$sales->id}}</td>
                                        <td>{{$sales->numberplate}}</td>
                                        <td>{{$sales->created_at}}</td>
                                        <td>

                                       <a href="/number-list/{{$sales->id}}/{{$sales->numberplate}}/delete"> <i class="ti-ruler-pencil"></i>Delete</a></td>
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

@endsection
