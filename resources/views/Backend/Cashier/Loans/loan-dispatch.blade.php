@extends('Backend.master')

@section('title')
    Loan for Despatch
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
                <h4 class="text-primary" style="text-align: center">Overview Loan Dispatch</h4>
                @if( $message = Session::get('message') )
                    <div style="text-align: center" class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> {{$message}}
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                        <thead>
                        <tr>
                            <th>Loan ID</th>
                            <th>Account No</th>
                            <th>Loan Amount</th>
                            <th>Application Date</th>
                            <th>ED Verification Date</th>
                            <th>Field Officer Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($dispatchLoan as $loan)
                            <tr class="odd gradeX">
                                <td>{{ $loan->id }}</td>
                                <td><a href="{{url('details-verified-member/'.$accountInfo->accountInfo($loan->account_no)->slug)}}">{{ $loan->account_no }}</a></td>
                                <td>{{ $loan->LoanAm}}</td>
                                <td>{{ $loan->application_date }}</td>
                                <td>{{ $loan->VerifyAdminDate }}</td>
                                <td>{{ $loan->name }} #ID({{$loan->field_officer_id}})</td>
                                <td>
                                    <a href="{{ url('/dispatch-loan-form/'.$loan->slug) }}" class="btn btn-info btn-xl" title="View Member Details">
                                        <span>Dispatch</span>
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
