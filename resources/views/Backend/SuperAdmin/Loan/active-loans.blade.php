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
                <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">Active Loans</h6>
                @if( $message = Session::get('mass') )
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
                            <th>Account No & Name</th>
                            <th>Service Charge(%)</th>
                            <th>Total Amount</th>
                            <th>Dispatch Date</th>
                            <th>Decline Date</th>
                            <th>Remain Days</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($loanDispatch as $loan)
                            <tr class="odd gradeX">
                                <td>{{ $loan->loan_id}}</td>
                                <td>{{ $loan->loan_amount}}</td>
                                <td>{{ $loanAccount->loanDispatch($loan->loan_id)->applicant_name}} ({{$loanAccount->loanDispatch($loan->loan_id)->id}})</td>
                                <td>{{ $loan->service_charge }}</td>
                                <td>{{ $loan->total_amount_with_charge }}</td>
                                <td>{{ $loan->dispatch_date}}</td>
                                <td>{{ $loan->decline_date}}</td>

                                @php
                                    $d=date('Y-m-d'); @endphp
                                   @php     $earlier = new DateTime($d); @endphp
                                  @php     $later = new DateTime($loan->decline_date); @endphp
                                    @php   $diff = $later->diff($earlier)->format("%r%a");   @endphp
                                @if($diff<=0)
                                    <td STYLE="background-color: green">
                                        <b> {{$diff}} </b>Days
                                    </td>
                                @elseif($diff>0 && $diff<125)
                                    <td STYLE="background-color: yellow">
                                        <b> {{$diff}} Days</b>
                                    </td>
                                @else
                                    <td STYLE="background-color: red">
                                        <b> {{$diff}} Days</b><br>
                                        <b>(Over than 1 year)</b>
                                    </td>
                                @endif
                                <td>
                                    <a href="{{ url('/transaction-loan-payment-view/'.$loan->loan_id) }}" class="btn btn-info btn-xl" title="View Transaction Details">
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
