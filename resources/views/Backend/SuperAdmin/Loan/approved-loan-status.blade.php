@extends('Backend.master')

@section('title')
 Approved Loans
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
                <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">Approved Loans</h6>
                 @if( $message = Session::get('mass') )
                    <div style="text-align: center" class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> {{$message}}
                    </div>
                @endif
                 @if( $message = Session::get('dmass') )
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
                            <th>Loan Amount</th>
                            <th>Sanction Amount</th>
                            <th>Application Date</th>
                            <th>Verification Date</th>
                            <th>Supervisor Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($adminVerifiedLoan as $loan)
                            <tr class="odd gradeX">
                                <td>{{ $loan->id }}</td>
                                <td>{{ $loan->loan_amount }}</td>
                                <td>{{ $loan->final_amount }}</td>
                                <td>{{ $loan->application_date }}</td>
                                <td>{{ $loan->VerifyDate }}</td>
                                <td>{{ $loan->name }}</td>
                                <td>@if($loan->status==2)
                                        <div style="background-color: yellow; padding: 5px; border-radius: 10px;text-align: center">{{'Ready to Despatch'}}</div>
                                    @elseif($loan->status==3)
                                        <div style="background-color: green;color: white; padding: 10px; border-radius: 10px; text-align: center"><p>{{'Despatched'}}</p> </div>
                                    @elseif($loan->status==-1)
                                        <div style="background-color: red;color: white; padding: 10px; border-radius: 10px; text-align: center">{{'Canceled'}} </div>
                                    @elseif($loan->status==4)
                                        <div style="background-color: blue;color: white; padding: 10px; border-radius: 10px; text-align: center">{{'Closed'}} </div>
                                    @endif
                                </td>

                                {{--<td><img src="{{url($member->applicant_photo)}}" width="60px" height="50px"></td>--}}
                                <td>
                                    @if($loan->status==2)
                                    <a href="{{ url('/ready-to-dispatch-loan-request-admin') }}" class="btn btn-info btn-xl" title="View Loan Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @else
                                    <a href="{{ url('/details-loan-admin-view/'.$loan->slug) }}" class="btn btn-info btn-xl" title="View Loan Details">
                                        <i class="fas fa-eye"></i>
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
