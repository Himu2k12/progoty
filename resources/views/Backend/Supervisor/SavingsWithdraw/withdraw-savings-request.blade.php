@extends('Backend.master')

@section('title')

@endsection

@section('style')
    <link href="{{asset('/Assets/')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="text-primary" style="text-align: center">Savings Withdraw Request</h4>
                @if( $message = Session::get('message') )
                    <h4 class="page-header text-success" style="text-align: center">{{ $message }}</h4>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Member Name</th>
                            <th>Mobile No</th>
                            <th>Total Savings</th>
                            <th>Note</th>
                            <th>Deposite period <br> (Days)</th>
                            <th>Field Officer Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($requests as $item)
                            <tr class="odd gradeX">
                                <td>{{ $item->id }}</td>

                                <td>{{ $item->applicant_name}}({{$item->account_no}})</td>
                                <td>{{ $item->mobile}}</td>
                                <td>{{ $item->total_savings }}</td>
                                <td>{{ $item->note }}</td>
                                <td>{{ $item->days_of_saving}}</td>
                                <td>{{ $item->name }}({{$item->field_man_id }})</td>
                                <td>
                                    <a href="{{ url('/withdraw-requests-by-id/'.$item->id) }}" class="btn btn-info btn-xl" title="View Member Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->



@endsection
@section('additionalScript')
    <!-- Page level plugins -->

@endsection
