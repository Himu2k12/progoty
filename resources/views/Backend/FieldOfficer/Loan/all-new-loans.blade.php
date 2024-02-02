@extends('Backend.master')

@section('title')
    Manage Loans
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
                <h4 class="text-primary" style="text-align: center">My Loans</h4>
                @if( $message = Session::get('message') )
                    <h4 class="page-header text-success" style="text-align: center">{{ $message }}</h4>
                @endif
                @if( $mass = Session::get('mass') )
                    <h4 class="page-header text-danger" style="text-align: center">{{ $mass }}</h4>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Loan ID</th>
                            <th>Account No & Name</th>
                            <th>Loan Amount</th>
                            <th>Application Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($AllLoans as $loan)
                            <tr class="odd gradeX">
                                <td>{{ $i++ }}</td>
                                <td>{{ $loan->id }}</td>
                                <td>{{ $loanAccount->loanAccount($loan->account_no)->applicant_name}} ({{$loan->account_no}})</td>
                                <td>{{ $loan->loan_amount }}</td>
                                <td>{{ $loan->application_date }}</td>
                                @if($loan->status==1)
                                    <td><p style="background-color: darkblue; color: white; border-radius: 10px;padding: 10px">Supervisor Confirmed</p></td>
                                    {{--<td><img src="{{url($member->applicant_photo)}}" width="60px" height="50px"></td>--}}
                                @elseif($loan->status==2)
                                    <td><p style="background-color: seagreen; color: white; border-radius: 10px;padding: 10px">ED Confirmed</p></td>
                                @elseif($loan->status==3)
                                    <td><p style="background-color: green; color: white; border-radius: 10px;padding: 10px">Dispatched</p></td>
                                @elseif($loan->status==-1)
                                    <td><p style="background-color: red; color: white; border-radius: 10px;padding: 10px">Canceled</p></td>
                                @elseif($loan->status==0)
                                    <td><p style="background-color:purple; color: white; border-radius: 10px;padding: 10px">New Loan</p></td>
                                @else
                                    <td><p style="background-color: darkgrey; color: white; border-radius: 10px;padding: 10px">Loan Closed</p></td>
                                @endif

                                <td>
                                    <a href="{{ url('/loan-details/'.$loan->slug) }}" class="btn btn-info btn-xl" title="View Member Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($loan->status==0)
                                        <a href="{{ url('/edit-loan-info/'.$loan->slug) }}" class="btn btn-success btn-xl" title="View Member Details">
                                            <i class="fas fa-edit"></i>
                                        </a>
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
    <!-- /.container-fluid -->



@endsection
@section('additionalScript')
    <!-- Page level plugins -->

@endsection
