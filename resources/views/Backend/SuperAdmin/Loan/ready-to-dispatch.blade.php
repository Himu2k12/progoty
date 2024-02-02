@extends('Backend.master')

@section('title')
    Loans To Dispatch 
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
                <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">Waiting For Loan Dispatches</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table  width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                        <thead>
                        <tr>
                            <th>Loan ID</th>
                            <th>Account No</th>
                            <th>Supervisor Considered Amount</th>
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
                                <td style="text-align:center"><b>{{ $loan->loan_amount }}</b></td>
                                <td>{{ $loan->application_date }}</td>
                                <td>{{ $loan->VerifyDate }}</td>
                                <td>{{ $loan->name }}</td>
                                {{--<td><img src="{{url($member->applicant_photo)}}" width="60px" height="50px"></td>--}}
                                <td>
                                    <a href="{{ url('/edit-admin-consider-loan-amount/'.$loan->slug) }}" class="btn btn-danger btn-xl" title="View Edit Info">
                                        <i class="fas fa-edit"></i>
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
