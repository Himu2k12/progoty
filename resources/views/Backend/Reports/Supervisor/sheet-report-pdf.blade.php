<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <title>
        Sheet Statement
    </title>
    <style>
        address{
            font-size: 13px;
        }
        
        table {

            border-collapse: collapse
        }
        th {
            text-align: inherit
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent
        }

        .table td,
        .table th {
           
            vertical-align: top;
            border-top: 1px solid #dee2e6
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6
        }

        .table tbody + tbody {
            border-top: 0px solid #dee2e6
        }

        .table .table {
            background-color: #fff
        }

        .table-sm td,
        .table-sm th {
           
        }

        .table-bordered {
            border: 1px solid #dee2e6
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6
        }

        .table-bordered thead td,
        .table-bordered thead th {
            border-bottom-width: 1px
        }

        .table-borderless tbody + tbody,
        .table-borderless td,
        .table-borderless th,
        .table-borderless thead th {
            border: 0
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, .05)
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, .075)
        }

        .table-primary,
        .table-primary > td,
        .table-primary > th {
            background-color: #b8daff
        }

        .table-primary tbody + tbody,
        .table-primary td,
        .table-primary th,
        .table-primary thead th {
            border-color: #7abaff
        }

        .table-hover .table-primary:hover {
            background-color: #9fcdff
        }

        .table-hover .table-primary:hover > td,
        .table-hover .table-primary:hover > th {
            background-color: #9fcdff
        }

        .table-secondary,
        .table-secondary > td,
        .table-secondary > th {
            background-color: #d6d8db
        }

        .table-secondary tbody + tbody,
        .table-secondary td,
        .table-secondary th,
        .table-secondary thead th {
            border-color: #b3b7bb
        }

        .table-hover .table-secondary:hover {
            background-color: #c8cbcf
        }

        .table-hover .table-secondary:hover > td,
        .table-hover .table-secondary:hover > th {
            background-color: #c8cbcf
        }

        .table-success,
        .table-success > td,
        .table-success > th {
            background-color: #c3e6cb
        }

        .table-success tbody + tbody,
        .table-success td,
        .table-success th,
        .table-success thead th {
            border-color: #8fd19e
        }

        .table-hover .table-success:hover {
            background-color: #b1dfbb
        }

        .table-hover .table-success:hover > td,
        .table-hover .table-success:hover > th {
            background-color: #b1dfbb
        }

        .table-info,
        .table-info > td,
        .table-info > th {
            background-color: #bee5eb
        }

        .table-info tbody + tbody,
        .table-info td,
        .table-info th,
        .table-info thead th {
            border-color: #86cfda
        }

        .table-hover .table-info:hover {
            background-color: #abdde5
        }

        .table-hover .table-info:hover > td,
        .table-hover .table-info:hover > th {
            background-color: #abdde5
        }

        .table-warning,
        .table-warning > td,
        .table-warning > th {
            background-color: #ffeeba
        }

        .table-warning tbody + tbody,
        .table-warning td,
        .table-warning th,
        .table-warning thead th {
            border-color: #ffdf7e
        }

        .table-hover .table-warning:hover {
            background-color: #ffe8a1
        }

        .table-hover .table-warning:hover > td,
        .table-hover .table-warning:hover > th {
            background-color: #ffe8a1
        }

        .table-danger,
        .table-danger > td,
        .table-danger > th {
            background-color: #f5c6cb
        }

        .table-danger tbody + tbody,
        .table-danger td,
        .table-danger th,
        .table-danger thead th {
            border-color: #ed969e
        }

        .table-hover .table-danger:hover {
            background-color: #f1b0b7
        }

        .table-hover .table-danger:hover > td,
        .table-hover .table-danger:hover > th {
            background-color: #f1b0b7
        }

        .table-light,
        .table-light > td,
        .table-light > th {
            background-color: #fdfdfe
        }

        .table-light tbody + tbody,
        .table-light td,
        .table-light th,
        .table-light thead th {
            border-color: #fbfcfc
        }

        .table-hover .table-light:hover {
            background-color: #ececf6
        }

        .table-hover .table-light:hover > td,
        .table-hover .table-light:hover > th {
            background-color: #ececf6
        }

        .table-dark,
        .table-dark > td,
        .table-dark > th {
            background-color: #c6c8ca
        }

        .table-dark tbody + tbody,
        .table-dark td,
        .table-dark th,
        .table-dark thead th {
            border-color: #95999c
        }

        .table-hover .table-dark:hover {
            background-color: #b9bbbe
        }

        .table-hover .table-dark:hover > td,
        .table-hover .table-dark:hover > th {
            background-color: #b9bbbe
        }

        .table-active,
        .table-active > td,
        .table-active > th {
            background-color: rgba(0, 0, 0, .075)
        }

        .table-hover .table-active:hover {
            background-color: rgba(0, 0, 0, .075)
        }

        .table-hover .table-active:hover > td,
        .table-hover .table-active:hover > th {
            background-color: rgba(0, 0, 0, .075)
        }

        .table .thead-dark th {
            color: #fff;
            background-color: #212529;
            border-color: #32383e
        }

        .table .thead-light th {
            color: #495057;
            background-color: #e9ecef;
            border-color: #dee2e6
        }

        .table-dark {
            color: #fff;
            background-color: #212529
        }

        .table-dark td,
        .table-dark th,
        .table-dark thead th {
            border-color: #32383e
        }

        .table-dark.table-bordered {
            border: 0
        }

        .table-dark.table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, .05)
        }

        .table-dark.table-hover tbody tr:hover {
            background-color: rgba(255, 255, 255, .075)
        }

        @media (max-width:575.98px) {
            .table-responsive-sm {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: -ms-autohiding-scrollbar
            }

            .table-responsive-sm > .table-bordered {
                border: 0
            }
        }

        @media (max-width:767.98px) {
            .table-responsive-md {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: -ms-autohiding-scrollbar
            }

            .table-responsive-md > .table-bordered {
                border: 0
            }
        }

        @media (max-width:991.98px) {
            .table-responsive-lg {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: -ms-autohiding-scrollbar
            }

            .table-responsive-lg > .table-bordered {
                border: 0
            }
        }

        @media (max-width:1199.98px) {
            .table-responsive-xl {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: -ms-autohiding-scrollbar
            }

            .table-responsive-xl > .table-bordered {
                border: 0
            }
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar
        }

        .table-responsive > .table-bordered {
            border: 0
        }
        @media print {
            .table {
                border-collapse: collapse !important
            }
        
            .table td,
            .table th {
                background-color: #fff !important
            }

            .table-bordered td,
            .table-bordered th {
                border: 1px solid #dee2e6 !important
            }

            .table-dark {
                color: inherit
            }

            .table-dark tbody + tbody,
            .table-dark td,
            .table-dark th,
            .table-dark thead th {
                border-color: #dee2e6
            }

            .table .thead-dark th {
                color: inherit;
                border-color: #dee2e6
            }
        }
    </style>
</head>
<!------ Include the above in your HEAD tag ---------->
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div style="float: left">
                <img src="{{asset('asset/images/')}}/logo_menu.jpg"  alt="Progaty Logo" height="100px" width="100px" />

            </div>
            <div style="width: 470px; float: left; text-align: center" >
                <h3 style="padding-left: 5px; margin-bottom: 0px; color:#354356"><strong>Progaty Savings and Loans Co-operative Society Ltd.</strong></h3>
                <h6 style="padding-left: 5px; margin-top: 0px;margin-bottom: 0px; color:green"><strong>Approved by the People's Republic of Bangladesh</strong></h6>
                <h6 style="padding-left: 5px; margin-top: 0px;margin-bottom: 0px; color:darkolivegreen"><strong>Newashi, Nageswari, Kurigram</strong></h6>
                <h6 style="padding-left: 5px; margin-top: 0px;margin-bottom: 0px; color:#354356"><strong>GOV: REG: No: 67/ Reformed REG: No: 001</strong></h6>
                <h6 style="padding-left: 5px; margin-top: 0px;margin-bottom: 0px; color:#354356"><strong>Founded: 2005</strong></h6>
            </div>
            <div style="width:150px; float: left;padding-top: 25px ">
                <h6 style="margin: 0; padding: 0"> Call Us: +8801718910757</h6>
                <h6 style="margin: 0; padding: 0">bdpssl@gmail.com</h6>
                <h6 style="margin: 0; padding: 0">www.progatybd.com</h6>
                <p style="font-size: 10px">Printed By: <span style="color: #2fa360;"> {{Auth::user()->name}}</span> | {{Date("h:i:sa")}} | {{Date('Y-m-d')}}</p>
            </div>
            <div style="clear: both"></div>

            <div style="clear: both"></div>
            <hr>
        </div>
    </div>
</div>

<div class="card-body">
    <h4 style="text-align: center;color: #0b2e13">Savings Collection On Sheet {{$sheet}}</h4>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            @php $s=0 @endphp
            <thead style="font-size: .8em">
            <tr>
               <th style="width:2%">SL.</th>
                <th style="width:3%">DB ID</th>
                <th style="width:3%">Account No</th>
                <th style="width:25%">Name</th>
                <th>Amount</th>
                <th>Field Officer</th>
                <th style="width:20%">Date</th>
            </tr>
             <?php
                            $totalCost=0;
                            $totalLoan=0;
                            $totalService=0;
                            ?>
            </thead>
            <tbody style="font-size: .7em">
            @foreach($savings as $data)
                <tr>
                    <td>{{$s=$s+1}}</td>
                    <td>{{$data->id}}</td>
                    <td>{{$data->member_id}}</td>
                    <td>{{$applicantName->ApplicantName($data->member_id)->applicant_name}}</td>
                    <td>{{$data->amount}}</td>
                    <td>{{$foN->userName($data->field_man_id)->name}} ({{$data->field_man_id}})</td>
                    <td>{{$data->created_at}}</td>
                </tr>
                     <?php $totalCost+=$data->amount;   ?>
            @endforeach
                            
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align: right">Total</th>
                    <th colspan=""></th>
                    <th colspan="">{{$totalCost}}</th>
                    <th colspan=""></th>
                    <th colspan=""></th>
                </tr>
            </tfoot>
        </table>
        
        <h4 style="text-align: center;color: #0b2e13">Loan Return Collection On Sheet {{$sheet}}</h4>
        <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
            <thead style="font-size: .8em">
            <tr>
                <th style="width:2%">SL.</th>
                <th style="width:3%">DB ID</th>
                <th style="width:3%">Account No</th>
                <th style="width:25%">Name</th>
                <th>Loan ID</th>
                <th>Amount</th>
                <th>Service Charge</th>
                <th style="width:15%">Field Officer</th>
                <th style="width:17%">Date</th>
            </tr>
            
            </thead>
            @php $sl=0 @endphp
            <tbody style="font-size: .7em">
            @foreach($loans as $data)
                <tr>
                    <td>{{$sl=$sl+1}}</td>
                    <td>{{$data->id}}</td>
                    <td>{{$data->account_no}}</td>
                    <td>{{$applicantName->ApplicantName($data->account_no)->applicant_name}}</td>
                    <td>{{$data->loan_id}}</td>
                    <td>{{$data->amount}}</td>
                    <td>{{$data->service_charge}}</td>
                    <td>{{$foN->userName($data->field_man_id)->name}}({{$data->field_man_id}})</td>
                    <td>{{$data->created_at}}</td>
                </tr>
                            <?php $totalLoan+=$data->amount;   ?>
                            <?php $totalService+=$data->service_charge;   ?>
            @endforeach
                            
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" style="text-align: right">Total</th>
                        <th ></th>
                        <th>{{$totalLoan}}</th>
                        <th>{{$totalService}}</th>
                        <th colspan='2'>= {{$totalLoan + $totalService}}</th>
                </tr>
                
            </tfoot>
        </table>
                        <div style="text-align:center;" class="card shadow mb-12">
                            <div class="card-header py-12">
                                <h3 style="color:#354356"> Savings + Loan Return+Additional Collection =({{$totalCost}}+{{$totalLoan+$totalService}}+{{$additionalCollection}})={{$totalCost+$totalLoan+$totalService+$additionalCollection}} TK</h3>
                            </div>
                        </div>

    </div>
</div>
</body>
</html>
