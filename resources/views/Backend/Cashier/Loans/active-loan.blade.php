@extends('Backend.master')

@section('title')
    Active Loans
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
                <h4 class="text-primary" style="text-align: center">Active Loans</h4>
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
                            <th>Loan Amount</th>
                            <th>Account No & Name</th>
                            <th>Service Charge</th>
                            <th>Total Amount</th>
                            <th>Cashier D.Note</th>
                            <th>Dispatch Date</th>
                            <th>Decline Date</th>
                            <th>Field Officer</th>
                            <th>Remain Days</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($loanDispatch as $loan)
                            <tr class="odd gradeX">
                                <td>{{ $loan->loan_id}}</td>
                                <td>{{ $loan->loan_amount}}</td>
                                <td>{{ $loanAccount->loanDispatch($loan->loan_id)->applicant_name}} ({{$loanAccount->loanDispatch($loan->loan_id)->id}})</td>
                                <td>{{ $loan->service_charge }}%</td>
                                <td>{{ $loan->total_amount_with_charge }}</td>
                                <td>{{ $loan->note }}</td>
                                <td>{{ $loan->dispatch_date}}</td>
                                <td>{{ $loan->decline_date}}</td>
                                <td>{{ $loan->name }} #ID({{$loan->field_officer_id}})</td>
                                @php
                                    $d=date('Y-m-d');
                                       $earlier = new DateTime($d);
                                       $later = new DateTime($loan->decline_date);
                                       $diff = $later->diff($earlier)->format("%r%a");

                                @endphp
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
                                        <b>(Over a Year loan Sanctioned)</b>
                                    </td>
                                @endif
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
