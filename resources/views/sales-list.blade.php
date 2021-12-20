@extends('layouts.header')
@section('admincontent')
<div class="content">

    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Sales</h4>
        </div>
    </div>

    <div class="page-content-wrapper ">

        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="m-b-30 m-t-0">Sales List</h4>

                            <table id="datatable-buttons" class="table table-stripe table-bordere dt-responsive nowrap" style="border-collapse: collapse; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Seller</th>
                                        <th>Customer Name</th>

                                        <th>Total Price</th>

                                        <th>Unit</th>
                                        <th>Branch</th>
                                        <th>Date</th>
                                        <th>Process</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($sale as $sales)


                                    <tr>
                                        <td>{{$sales->user->name}}</td>
                                        <td>{{$sales->name}}</td>


                                        <td>{{number_format($sales->price)}}</td>

                                        <td>{{$sales->unit}}</td>
                                        <td>{{$sales->user->branch->name}}</td>
                                        <td>{{$sales->created_at}}</td>
                                        <td><a href="{{route('sales-list.show', ['sales_list'=> $sales->id])}}"><i class="ti-files"></i> Invoice </a> • @if (Auth::user()->role == 1)

                                       <a href="{{route('sales-list.edit', ['sales_list'=> $sales->id])}}"> <i class="ti-ruler-pencil"></i>Edit</a> @endif</td>
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
