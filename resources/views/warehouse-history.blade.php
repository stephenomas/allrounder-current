@extends('layouts.header')
@section('admincontent')
<div class="content">

    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Warehouse Transfer</h4>
        </div>
    </div>

    <div class="page-content-wrapper ">

        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="m-b-30 m-t-0">Transfer List</h4>
                            @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>

                                    {{session()->get('success')}} <br>
                            </div>
                            @endif
                            <table id="datatable-buttons" class="table table-stripe table-bordere dt-responsive nowrap" style="border-collapse: collapse; width: 100%;">
                                <thead>
                                    <tr>
                                        @if (App\Helpers\Utilities::admin())
                                        <th>Transferer</th>
                                        <th>Destination Branch</th>
                                        @endif
                                        <th>Source Branch</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Date-Time Transfered</th>

                                        <th>Date-Time Accepted</th>

                                        <th>Process</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($transfers as $transfer)
                                    <tr>
                                        @if (App\Helpers\Utilities::admin())
                                        <td>{{$transfer->user->name}}</td>
                                        <td>{{$transfer->transfer_destination->name}}</td>
                                        @endif
                                        <td>{{$transfer->branch->name}}</td>
                                        <td>{{
                                            $transfer->ckd != null ? 'ckd' : "cbu"
                                            }}
                                        </td>
                                        <td>{{$transfer->status}}</td>
                                        <td>{{$transfer->created_at}}</td>

                                        <td>{{$transfer->status == "fufilled" ? $transfer->updated_at : 'TBD'}}</td>

                                        <td>
                                            <a href="/warehouse-transfers/{{$transfer->id}}"><i class="ti-files"></i> View </a> •


                                            @if ($transfer->status != 'fufilled')
                                            <a href="/warehouse-transfers/{{$transfer->id}}/edit"> <i class="ti-ruler-pencil"></i>Edit</a>
                                            <a href="/warehouse-transfers/{{$transfer->id}}/delete"> <i class="ti-trash"></i>Delete</a>
                                            @endif

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

@endsection
