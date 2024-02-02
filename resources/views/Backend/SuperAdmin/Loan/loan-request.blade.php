@extends('Backend.master')

@section('title')
    Loan Requests
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
                <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">New Loan Applications</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table  width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                        <thead>
                        <tr>
                            <th>Loan ID</th>
                            <th>Account No</th>
                            <th>Loan Amount</th>
                            <th>Application Date</th>
                            <th>Verification Date</th>
                            <th>Supervisor Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($SupervisorVerifiedLoan as $loan)
                            <tr class="odd gradeX">
                                <td>{{ $loan->id }}</td>
                                <td>{{ $loan->account_no }}</td>
                                <td>{{ $loan->loan_amount }}</td>
                                <td>{{ $loan->application_date }}</td>
                                <td>{{ $loan->VerifyDate }}</td>
                                <td>{{ $loan->name }}</td>
                                {{--<td><img src="{{url($member->applicant_photo)}}" width="60px" height="50px"></td>--}}
                                <td>
                                    <a href="{{ url('/details-loan-admin-view/'.$loan->slug) }}" class="btn btn-info btn-xl" title="View Member Details">
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
