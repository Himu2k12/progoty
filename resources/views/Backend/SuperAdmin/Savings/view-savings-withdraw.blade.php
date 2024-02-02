@extends('Backend.master')

@section('title')
    Account Details

@endsection
@section('content')
    <style>
        .m-0{
            text-align: center;
        }
        .xt td{
            width: 50%;
            text-align: center;
        }
        .cs th{
            text-align: center;
        }
        .cs td{
            text-align: center;
        }
        th{
            width: 50%;
        }

    </style>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <h4 style="text-align: center">Savings Account Detials</h4>
                    <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
                    <h6 style="text-align: center" class="text-danger">{{ Session::get('Negmessage') }}</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="offset-lg-0 col-lg-12">
                <div class="card mb-4 py-3 border-left-success">
                    <div class="card-body">
                        <div class="col-md-12" style="border-radius: 10px">
                            <nav class="border-bottom-info">
                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Savings Details</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Transactions</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="card-header py-3">
                                        <h6  class="m-0 font-weight-bold text-info"> View Savings Withdraw</h6>
                                    </div>
                                    <div class="card-body">
                                        <table width="100%"  class="table table-striped table-bordered table-hover" id="">
                                            <tbody>
                                            <tr>
                                                <th>Account Opening Date</th>
                                                <td>{{$allInfo->created_at }}</td>
                                            </tr>
                                                <tr class="odd gradeX">
                                                    <th>Withdrawal Application Date</th>
                                                    <td>{{$allInfo->applicationDate }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Savings period</th>
                                                    <td>{{ $allInfo->days_of_saving}} days</td>
                                                </tr>
                                            <tr>
                                                <th>Covered Scheme</th>
                                                <td>{{$editInfo->percentage}} %</td>

                                            </tr>
                                            <tr>
                                                <th>Savings Amount</th>
                                                <td>{{$SumofMoney}}</td>

                                            </tr>
                                            <tr>
                                                <th>Withdrawn Till Now</th>
                                                <td>{{$sum}}</td>

                                            </tr>
                                            <tr>
                                                <th>Current Balance</th>
                                                <td>{{$currentBalance}}</td>

                                            </tr>
                                            <tr>
                                                <th>Profit</th>
                                                <td>{{ $editInfo->profit }}</td>

                                            </tr>
                                            <tr>
                                                <th>Bonus</th>
                                                <td>{{ $editInfo->bonus }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total Payable</th>
                                                <td>{{ $editInfo->total }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade table-responsive" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="card-header py-3">
                                        <h6  class="m-0 font-weight-bold text-info">All Transaction Details</h6>
                                    </div>
                                    <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <table width="100%"  class="table table-striped table-bordered table-hover" id="dataTable">
                                                <thead>
                                                <tr>
                                                    <th>SL NO</th>
                                                    <th>Member ID</th>
                                                    <th>Sheet No</th>
                                                    <th>Savings Amount</th>
                                                    <th>FieldOfficer Name</th>
                                                    <th>Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i=1; ?>
                                                @foreach($allSavingsDetails as $member)
                                                    <tr class="odd gradeX">
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $member->id }}</td>
                                                        <td>{{ $member->sheet_no }}</td>
                                                        <td>{{ $member->amount }}</td>
                                                        <td>{{$username->userName( $member->field_man_id)->name }}({{ $member->field_man_id}})</td>
                                                        <td>{{ $member->created_at }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th colspan="3" style="text-align: right">Total</th>
                                                    <th colspan="3">{{$SumofMoney}}</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if($editInfo->status==0)
                                <div class="col-sm-12" style="text-align: center">
                                    <a href="{{url('/approve-for-despatch/'.$editInfo->id)}}" class="btn btn-success">Approve</a>
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

