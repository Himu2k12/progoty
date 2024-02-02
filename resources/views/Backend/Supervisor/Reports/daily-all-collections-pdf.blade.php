<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
    <title>প্রগতি</title>
    <style>
        th{
            text-align: center;
        }

    </style>
</head>

<body>

<div class="container pdf">
    <div class="row">
        <div class="col-xs-12">
            <div style="float: left;padding-top: 0px">
                <img src="{{asset('asset/')}}/images/logo.png"  alt="Progoty" height="100px" width="100px" />
            </div>
            <div style="float:left; padding-right:25%; ">

                {{--<h1 class="panel-title" style="text-align: center"><strong>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার কতৃক অনুমোদিত</strong></h1>--}}
                <h5 class="panel-title" style="text-align: center;margin: 0px"><strong>Approved by the People's Republic of Bangladesh</strong></h5>
                <h4 class="panel-title" style="text-align: center;color: darkblue;margin: 0px"><strong>Progoty Savings and Loans Co-operative Society Ltd.</strong></h4>
                <h5 class="panel-title" style="text-align: center; color: darkslategrey;margin: 0px"><strong>Newashi, Nageswari, Kurigram</strong></h5>
                <h5 class="panel-title" style="text-align: center;color: darkslategrey;margin: 0px"><strong>GOV: REG: No: 67/ Reformed REG: No: 001</strong></h5>
                <h5 class="panel-title" style="text-align: center;color: darkslategrey; margin: 0px"><strong>Founded: 2005 </strong></h5>
            </div>
            <div class="col-sm-10" style="clear: both">
                {{--<h3 >Order # {{$order->id}}</h3>--}}
            </div>
            <hr>
            <div class="row">
                <h2 style="text-align: center; margin: 0px">Daily Total Collection Sheet</h2>
            </div>
            <div class="row">
                <div class="col-xs-4" style="float: left">
                    @if(isset($date)&& isset($sheet))
                        <address>
                            <h3 style="color: #1B0034"><u>Report Date</u></h3>
                            <p>{{$date}}</p>
                        </address>
                        <address>
                            <h3 style="color: #1B0034">Sheet No</h3>
                            <p>{{$sheet}}</p>
                        </address>

                    @elseif(isset($date))
                        <address>
                            <h4><u>Report Date</u></h4>
                            <p>{{$date}}</p>
                        </address>

                    @elseif(isset($sheet))
                        <address>
                            <h3 style="color: #1B0034">Sheet No</h3>
                            <p>{{$sheet}}</p>
                        </address>
                    @endif
                </div>

                <div class="col-xs-8 text-right" style="text-align: right">
                    <address>
                        <h4><u>Supervisor</u></h4>
                        <p>{{Auth::user()->name}} #{{Auth::user()->id}} </p>

                    </address>
                </div>
                <div  style="clear: both">

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 style="text-align: center;color: #0b2e13">Collection On Savings</h2>
                </div>
                <div class="panel-body" style="text-align: center;">
                    <div class="table-responsive" style="text-align: center">
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>Field Officer</th>
                                    <th>Sheet No</th>
                                    <th>Total Amount</th>
                                    <th>Field Officer Signature</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; $totalSavings=0; $totalLoan=0; $totalService=0; ?>
                                @foreach($allCollection as $item)
                                    <tr>
                                        <td style="text-align:center; border: 1px solid black">{{$i++}}</td>
                                        <td style="text-align:center; border: 1px solid black">{{$item->name}}({{$item->field_man_id}})</td>
                                        <td style="text-align:center; border: 1px solid black">{{$item->sheet_no}}</td>
                                        <td style="text-align:center; border: 1px solid black">{{$item->sumSavings}}</td>
                                        <td style="text-align:center; border: 1px solid black"></td>
                                    </tr>
                                    <?php $totalSavings+=$item->sumSavings ?>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="3" > Total</th>
                                    <th style="text-align: center">{{$totalSavings}}</th>
                                    {{--<th>{{$totalLoan}}</th>--}}
                                    {{--<th>{{$totalService}}</th>--}}
                                    {{--<th>{{$totalService+$totalLoan+$totalSavings}}</th>--}}
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <h3></h3>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 style="text-align: center;color: #0b2e13">Collection On Loans</h2>
                </div>
                <div class="panel-body" style="text-align: center;">
                    <div class="table-responsive" style="text-align: center">
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr style="text-align: center">
                                    <th>SL NO</th>
                                    <th>Field Officer</th>
                                    <th>Sheet No</th>
                                    <th>Loan Collection</th>
                                    <th>Service Charge</th>
                                    <th>Total Amount</th>
                                    <th>Field Officer Signature</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; $total=0; $totalLoanDate=0; $totalServiceDate=0; ?>
                                @foreach($allLoanCollection as $item)
                                    <tr>
                                        <td style="text-align:center; border: 1px solid black">{{$i++}}</td>
                                        <td style="text-align:center; border: 1px solid black">{{$item->name}}({{$item->field_man_id}})</td>
                                        <td style="text-align:center; border: 1px solid black">{{$item->sheet_no}}</td>
                                        <td style="text-align:center; border: 1px solid black">{{$item->sumLoans}}</td>
                                        <td style="text-align:center; border: 1px solid black">{{$item->sumService}}</td>
                                        <td style="text-align:center; border: 1px solid black">{{$item->sumService+$item->sumLoans}}</td>
                                    <td style="text-align:center; border: 1px solid black"></td>
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
                <div class="panel-footer">
                    <h3></h3>
                </div>

            </div>
        </div>
    </div>
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 style="text-align: center;color: #0b2e13">Total Collection</h2>
                </div>
                <div class="panel-body" style="text-align: center;">
                    <div class="table-responsive" style="text-align: center">
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>Savings </th>
                                    <th>Loan </th>
                                    <th>Service Charge</th>
                                    <th>Total Amount</th>
                                    <th>Supervisor Signature</th>
                                </tr>
                                </thead>
                                <tbody>
<?php $i=1; ?>

                                    <tr>
                                        <td style="text-align:center; border: 1px solid black">{{$i++}}</td>
                                        <td style="text-align:center; border: 1px solid black">{{$totalSavings}}</td>
                                        <td style="text-align:center; border: 1px solid black">{{$totalLoanDate}}</td>
                                        <td style="text-align:center; border: 1px solid black">{{$totalServiceDate}}</td>
                                        <td style="text-align:center; border: 1px solid black">{{$totalSavings+$totalLoanDate+$totalServiceDate}}</td>
                                    <td style="text-align:center; border: 1px solid black"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
</body>
</html>



