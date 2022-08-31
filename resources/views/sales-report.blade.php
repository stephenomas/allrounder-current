@extends('layouts.header')
@section('admincontent')
<div class="content">

    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Sales Report</h4>
        </div>
    </div>

    <div class="page-content-wrapper ">

        <div class="container-fluid">
            <div class="row">
                <div class="">
                    <div class="card">
                        <h3 class="text-center">Search Filter</h3>
                        <form action="{{url('/sales-report')}}" method="get">
                            <div class="card-heading p-4">
                                <div>
                                    <div class="d-flex">
                                            <div class="form-group m-3">
                                                <label for="">start date</label>
                                            <input type="date" name="start" value="{{old('start')}}" required class="form-control">
                                            </div>
                                            <div class="form-group m-3">
                                                <label for="">end date</label>
                                            <input type="date" required name="end" value="{{old('end')}}"  class="form-control">
                                            </div>
                                            @if(App\Helpers\Utilities::admin())
                                                <div class="form-group m-3">
                                                    <label for="">branch</label>
                                                    <select class="form-control" name="branch" id="">
                                                        @if(old('branch'))
                                                            @php
                                                                $br = old('branch');
                                                                $branch = App\Models\Branch::find($br);
                                                            @endphp
                                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                        @else
                                                            <option value="0">ALL</option>
                                                        @endif

                                                        @foreach ( $branch as $br )
                                                        <option value="{{$br->id}}">{{$br->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif

                                    </div>

                                    <input type="submit" value="Filter" class="btn btn-primary m-3">

                                </div>
                            </div>
                         </form>
                    </div>
                </div>
            </div>

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

                                        <a href="{{route('sales-list.edit', ['sales_list'=> $sales->id])}}"> <i class="ti-ruler-pencil"></i>Edit</a>
                                        <a href="{{route('sales-list.delete', ['sales'=> $sales->id])}}"> <i class="ti-trash"></i>Delete</a> @endif</td>
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
