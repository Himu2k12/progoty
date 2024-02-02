@extends('Backend.master')

@section('title')
    ALL Loans
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
                <h4 class="text-primary" style="text-align: center">ALL Loans</h4>
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
                            <th>ED Note</th>
                            <th>Dispatch Date</th>
                            <th>Decline Date</th>
                            <th>Field Officer</th>
                            <th>Status</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($loans as $loan)
                            <tr class="odd gradeX">
                                <td>{{ $loan->loan_id}}</td>
                                <td>{{ $loan->loan_amount}}</td>
                                <td>{{ $loanAccount->AccountNameForCashier($loan->loan_id)->applicant_name}} ({{$loanAccount->AccountNameForCashier($loan->loan_id)->id}})</td>
                                <td>{{ $loan->service_charge }}%</td>
                                <td>{{ $loan->total_amount_with_charge }}</td>
                                <td>{{ $loan->note }}</td>
                                <td>{{ $loan->dispatch_date}}</td>
                                <td>{{ $loan->decline_date}}</td>
                                <td>{{ $loan->name }} #ID({{$loan->field_officer_id}})</td>
                                <td>@if($loan->situation==2)
                                        <div style="background-color: yellow; padding: 5px; border-radius: 10px;text-align: center">{{'Ready to Despatch'}}</div>
                                    @elseif($loan->situation==3)
                                        <div style="background-color: green;color: white; padding: 10px; border-radius: 10px; text-align: center"><p>{{'Despatched'}}</p> </div>
                                    @elseif($loan->situation==-1)
                                        <div style="background-color: red;color: white; padding: 10px; border-radius: 10px; text-align: center">{{'Canceled'}} </div>
                                    @elseif($loan->situation==4)
                                        <div style="background-color: blue;color: white; padding: 10px; border-radius: 10px; text-align: center">{{'Closed'}} </div>
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
