@extends('layouts.header')
@section('admincontent')
<head>
    <title>Admin | Added Stock</title>
</head>
<div class="content">

    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Addd Stock History</h4>
        </div>
    </div>

    <div class="page-content-wrapper ">

        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="m-b-30 m-t-0">Added Stock History</h4>
                            @if(session()->has('message'))
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                            </button>
                                            {{session()->get('message')}}
                                        </div>
                            @endif
                            <form action="{{route('inventory.added')}}" method="get">
                                <div class="form-group row">
                                        <div class="col">
                                            <label class=" control-label" for="example-password-input">Start Date</label>
                                            <input name="start_date" type="date" required class="select2 form-control " value="{{request('start_date') ?? ''}}">

                                        </div>
                                        <div class="col">
                                            <label class=" control-label" for="example-password-input">End Date</label>
                                            <input name="end_date" type="date"  class="select2 form-control " value="{{request('end_date') ?? ''}}">
                                        </div>
                                        @if (App\Helpers\Utilities::admin())
                                        <div class="col">
                                            <label class=" control-label" for="example-password-input">Branch</label>
                                            <select name="branch" type="" required class="select2 form-control " >
                                                @php
                                                $current =  request('branch') && request('branch') != 0 ? App\Models\Branch::find(request('branch')) : null;
                                                @endphp
                                                <option value="{{$current->id ?? 0}}">{{$current->name ?? "All"}}</option>
                                                @if ($current)
                                                <option value="0">All</option>
                                                @endif
                                                @foreach ($branches as  $branch)
                                                @if (!$current)
                                                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                @else
                                                    @if($current->id != $branch->id)
                                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                    @endif
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        @endif
                                        <div class="col align-self-center">
                                            <button type="submit" class="btn waves-effect text-light waves-light mt-4" style="background-color: #08417a;">Apply </button>
                                        </div>
                                </div>
                            </form>
                            <table id="datatable-buttons" class="table table-stripe table-bordere dt-responsive nowrap" style="border-collapse: collapse; width: 100%;">
                                <thead>
                                    <tr>

                                        <th>Name</th>
                                        <th>Branch</th>
                                        <th>Amount</th>

                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($added_array as $key => $amount )
                                    @php
                                        $spec = App\Models\Spec::find($key);
                                    @endphp
                                    <tr>

                                        <td>{{$spec->name}}</td>
                                        <td>{{$spec->branch->name}}</td>
                                        <td>{{$amount}}</td>

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
