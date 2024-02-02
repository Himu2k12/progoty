@extends('Backend.master')

@section('title')
    New Loan Requests
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
                <h4 class="text-primary" style="text-align: center">New Loan Request</h4>
                @if( $message = Session::get('message') )
                    <h4 class="page-header text-success" style="text-align: center">{{ $message }}</h4>
                @endif
                 @if( $message = Session::get('mass') )
                    <h6 class="page-header text-danger" style="text-align: center">{{ $message }}</h4>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Loan ID</th>
                            <th>Account No</th>
                            <th>Loan Amount</th>
                            <th>Application Date</th>
                            <th>Field Officer</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($newLoan as $loan)
                            <tr class="odd gradeX">
                                <td>{{ $i++ }}</td>
                                <td>{{ $loan->id }}</td>
                                <td>{{ $loan->account_no }}</td>
                                <td>{{ $loan->loan_amount }}</td>
                                <td>{{ $loan->application_date }}</td>
                                <td>{{ $loan->name }}</td>
                                {{--<td><img src="{{url($member->applicant_photo)}}" width="60px" height="50px"></td>--}}
                                <td>
                                    <a href="{{ url('/details-loan-view/'.$loan->slug) }}" class="btn btn-info btn-xl" title="View Member Details">
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
