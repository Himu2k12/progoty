@extends('Backend.master')

@section('title')
    Sheet Reports
@endsection
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body" style="text-align: center">
                    <h4 style="text-align: center">Sheet Records</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="{{url('submit-sheet-reports')}}" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-sm-2" style="margin: auto">
                            <div class="form-group" style="margin: auto">
                                <label for="exampleInputEmail1"><b>Sheet No</b></label>
                            </div>
                        </div>
                        <div class="col-sm-4" style="margin: auto">
                            <div class="form-group" style="margin: auto">
                                <input type="number" min="0" class="form-control" name="sheet" required >
                            </div>
                        </div>
                        <div class="col-sm-2" style="margin: auto">
                            <div class="form-group" style="margin: auto">
                                <button type="submit" class="form-control btn btn-info">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>
        @if(isset($savings) && !$savings->IsEmpty())
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">Savings Records From  Sheet {{$sheet}}</h5>
                </div>
                <div class="card-body">
                    @php $s=0; @endphp
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Serial</th>
                                <th>ID</th>
                                <th>Account No</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Field Officer</th>
                                <th>Date</th>
                            </tr>
                            
                            </thead>
                            <?php
                            $totalCost=0;
                            $totalLoan=0;
                            $totalService=0;
                            ?>
                            <tbody>
                            @foreach($savings as $data)
                                <tr>
                                    <td>{{$s=$s+1}}</td>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->member_id}}</td>
                                    <td>{{$applicantName->ApplicantName($data->member_id)->applicant_name}}</td>
                                    <td>{{$data->amount}}</td>
                                    <td>{{$FoN->userName($data->field_man_id)->name}}({{$data->field_man_id}})</td>
                                    <td>{{$data->created_at}}</td>
                                </tr>
                                    <?php $totalCost+=$data->amount;   ?>
                            @endforeach
                            
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="3" style="text-align: right">Total</th>
                                <th colspan=""></th>
                                <th>{{$totalCost}}</th>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
                <div class="card-header py-3">
                    <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">Loan Return Records From  Sheet {{$sheet}}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Serial</th>
                                <th>ID</th>
                                <th>Account No</th>
                                <th>Name</th>
                                <th>Loan ID</th>
                                <th>Amount</th>
                                <th>Service Charge</th>
                                <th>Field Officer</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            @php $sl=0 @endphp
                            
                            
                
                            <tbody>
                            @foreach($loan as $data)
                                <tr>
                                    <td>{{$sl=$sl+1}}</td>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->account_no}}</td>
                                    <td>{{$applicantName->ApplicantName($data->account_no)->applicant_name}}</td>
                                    <td>{{$data->loan_id}}</td>
                                    <td>{{$data->amount}}</td>
                                    <td>{{$data->service_charge}}</td>
                                    <td>{{$FoN->userName($data->field_man_id)->name}}({{$data->field_man_id}})</td>
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
                        
                        <div style="text-align:center" class="card shadow mb-12">
                            <div class="card-header py-12">
                                <h5 class="m-0 font-weight-bold text-info"> Savings + Loan Return + Additional Collection=({{$totalCost}}+{{$totalLoan+$totalService}}+{{$additionalCollection}})={{$totalCost+$totalLoan+$totalService+$additionalCollection}}</h5>
                            </div>
                        </div>
                        
                        @if($savings)
                            <form style="text-align:center" action="{{url('generate-pdf-for-sheet')}}" method="post" target="_blank">
                                @csrf
                                <input type="hidden" name="sheet" @if(isset($sheet)) value="{{$sheet}}" @endif>
                                <button type="submit" class="btn btn-success">Print</button>
                            </form>
                        @endif
                       
                    </div>
                </div>
            </div>
        @else
            @if(isset($sheet))
                <div class="card-header py-3">
                    <h6 style="text-align: center" class="m-0 font-weight-bold text-danger">No Records From {{$sheet}}</h6>
                </div>
        @endif
    @endif
    <!-- DataTales Example -->

    </div>

@endsection

