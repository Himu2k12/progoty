@extends('Backend.master')

@section('title')
    Daily All Collections

@endsection
@section('content')
    <style>
        .m-0{
            text-align: center;
        }
        .divstyle{
            background-color: white;
            border-radius: 10px;
        }
        th{
            text-align: center;
        }
        td{
            text-align: center;
        }
    </style>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <h4 style="text-align: center">Daily Field Officers Collection</h4>
{{--                    <div class="row" >--}}
{{--                        <div style="margin-top: 20px; text-align: right; vertical-align: middle" class="col-sm-2">--}}
{{--                            <label>Date: </label>--}}
{{--                        </div>--}}
{{--                        <div style="margin-top: 20px" class="col-sm-2">--}}
{{--                            <button disabled class="btn btn-warning">@if(isset($date)){{$date}}@endif</button>--}}
{{--                        </div>--}}
{{--                        <div style="margin-top: 20px; text-align: right; vertical-align: middle" class="offset-4 col-sm-2">--}}
{{--                            <label>Sheet No: </label>--}}
{{--                        </div>--}}
{{--                        <div style="margin-top: 20px" class="col-sm-2">--}}
{{--                            <button disabled class="btn btn-warning"> @if(isset($sheet_no)){{$sheet_no}}@endif</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    @if( $message = Session::get('message') )
                        <h1 class="page-header">{{ $message }}</h1>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="card-body">
                    <div class="col-md-12">
                        <nav class="divstyle border-bottom-success">
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Savings Collections</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-profile" aria-selected="false">Loan Collections</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-addition" role="tab" aria-controls="nav-profile" aria-selected="false">Additional Collections</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-presentAddess" role="tab" aria-controls="nav-contact" aria-selected="false">Total Collections</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Savings Collections From All FieldOfficers</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                                            <thead>
                                            <tr>
                                                <th>SL NO</th>
                                                <th>Field Officer</th>
                                                <th>Sheet No</th>
                                                <th>Total Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=1; $totalSavings=0; $totalLoan=0; $totalService=0; ?>
                                            @foreach($allCollection as $item)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$item->name}}({{$item->field_man_id}})</td>
                                                    <td>{{$item->sheet_no}}</td>
                                                    <td>{{$item->sumSavings}}</td>
                                                </tr>
                                                <?php $totalSavings+=$item->sumSavings ?>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="3"> Total</th>
                                                <th>{{$totalSavings}}</th>
                                                {{--<th>{{$totalLoan}}</th>--}}
                                                {{--<th>{{$totalService}}</th>--}}
                                                {{--<th>{{$totalService+$totalLoan+$totalSavings}}</th>--}}
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-account" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Loan Collections from All FieldOfficers</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable2">
                                            <thead>
                                            <tr>
                                                <th>SL NO</th>
                                                <th>Field Officer</th>
                                                <th>Sheet No</th>
                                                <th>Loan Collection</th>
                                                <th>Service Charge</th>
                                                <th>Total Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=1; $total=0; $totalLoanDate=0; $totalServiceDate=0; ?>
                                            @foreach($allLoanCollection as $item)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$item->name}}({{$item->field_man_id}})</td>
                                                    <td>{{$item->sheet_no}}</td>
                                                    <td>{{$item->sumLoans}}</td>
                                                    <td>{{$item->sumService}}</td>
                                                    <td>{{$item->sumService+$item->sumLoans}}</td>
                                                </tr>
                                                <?php $total+=$item->sumService+ $item->sumLoans ?>
                                                <?php $totalLoanDate+=$item->sumLoans ?>
                                                <?php $totalServiceDate+=$item->sumService ?>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="3"> Total</th>
                                                <th style="text-align: center">{{$totalLoanDate}}</th>
                                                <th style="text-align: center">{{$totalServiceDate}}</th>
                                                <th style="text-align: center">{{$total}}</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-addition" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">All Additional Collections</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable3">
                                            <thead>
                                            <tr>
                                                <th>SL NO</th>
                                                <th>Officer Name</th>
                                                <th>Total Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=1; $totalSum=0; ?>
                                            @foreach($additionalColections as $item)
                                                <tr>
                                                    <td >{{$i++}}</td>
                                                    <td >{{$userName->userName($item->created_by)->name}}({{$item->created_by}})</td>
                                                    <td >{{$item->sum}}</td>
                                                </tr>
                                                <?php $totalSum+=$item->sum; ?>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="2"> Total</th>
                                                <th>{{$totalSum}}</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-presentAddess" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Total Collections</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable3">
                                            <tbody>
                                            <tr>
                                                <th style="width: 50%">Savings </th>
                                                <td style="text-align:center; ">{{$totalSavings}}</td>
                                            </tr>
                                            <tr>
                                                <th>Loan </th>
                                                <td style="text-align:center; ">{{$totalLoanDate}}</td>
                                            </tr>
                                            <tr>
                                                <th>Service Charge</th>
                                                <td style="text-align:center;">{{$totalServiceDate}}</td>

                                            </tr>
                                            <tr>
                                                <th>Additional Collections</th>
                                                <td style="text-align:center;">{{$totalSum}}</td>

                                            </tr>
                                            <tr>
                                                <th>Total Amount</th>
                                                <th style="text-align:center;">{{$totalSavings+$totalLoanDate+$totalSum+$totalServiceDate}}</th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="offset-5 col-sm-2">
                                <a target="_blank" href="{{url('print-supervisor-daily-all-collection')}}">  <button style="text-align: center; width: 100%" class="btn btn-lg btn-primary">Print</button></a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- /.container-fluid -->
@endsection

