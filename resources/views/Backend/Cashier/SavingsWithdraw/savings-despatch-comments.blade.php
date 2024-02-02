@extends('Backend.master')

@section('title')
    Savings Withdraws

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
    </style>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <h4 style="text-align: center">Final Form on Savings Withdraw</h4>
                    @if( $message = Session::get('message') )
                        <h1 class="page-header">{{ $message }}</h1>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                        <nav class="divstyle border-bottom-success">
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Confirmation Form</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-profile" aria-selected="false">Balance Sheet</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Confirmation Form</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <form style="border: 1px solid #bbbbbb; padding: 20px" enctype="multipart/form-data" name="documents" action="{{url('/cash-final-despatch')}}" method="post">
                                            {{csrf_field()}}
                                            <div class="row">
                                                <div class="col-sm-6 offset-sm-3" style="margin-bottom: 20px">
                                                    <fieldset class="field_border" >
                                                        <div class="col-sm-12" style=" margin-bottom: 20px">
                                                            <label class="required">Account Name</label>
                                                            <input type="text" class="form-control" readonly value="{{$confirmedByAdmin->applicant_name}}">
                                                        </div>
                                                        <div class="col-sm-12" style=" margin-bottom: 20px">
                                                            <label class="required">Account No.</label>
                                                            <input type="number" name="account_no" class="form-control" readonly value="{{$confirmedByAdmin->accountNo}}">
                                                            <input type="hidden" name="id"  value="{{$confirmedByAdmin->id}}">
                                                        </div>

                                                        <div class="col-sm-12" style=" margin-bottom: 20px">
                                                            <label class="required">Savings Amount</label>
                                                            <input readonly type="text" class="form-control" id="savingsAmount" name="savings_amount" value="{{$SumofMoney}}" required minlength="4">
                                                            <span  id="error_applicant_name" style="color: red;">{{ $errors->has('check_no') ? $errors->first('check_no') : ' ' }}</span>
                                                            <input type="hidden" value="" name="slug">
                                                        </div>
                                                        <div class="col-sm-12" style=" margin-bottom: 20px">
                                                            <label class="required">Current Available Amount</label>
                                                            <input readonly type="text" class="form-control" id="savingsAmount" name="savings_amount" value="{{$currentBalance}}" minlength="4">
                                    
                                                            <input type="hidden" value="" name="slug">
                                                        </div>
                                                        <div class="col-sm-12" style=" margin-bottom: 20px">
                                                            <label class="required">Total Amount</label>
                                                            <input type="text" name="total" class="form-control" readonly value="{{$confirmedByAdmin->total}}">
                                                        </div>

                                                        <div class="col-sm-12" style=" margin-bottom: 20px">
                                                            <label class="required">Despatch Detials<span style="color: red">*</span></label>
                                                            <textarea class="form-control" required name="note" placeholder="Please mention the Detials"></textarea>
                                                            <span  id="error_nationality" style="color: red;">{{ $errors->has('note') ? $errors->first('note') : ' ' }}</span>
                                                        </div>
                                                        <div class="col-sm-12" style="text-align: center">
                                                            <button type="submit" class="btn btn-success">Submit</button>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-account" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">All Transactions</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%"  class="table table-striped table-bordered table-hover" id="dataTable">
                                            <thead>
                                            <tr>
                                                <th>SL NO</th>
                                                <th>Member ID</th>
                                                <th>Sheet No</th>
                                                <th>Savings Amount</th>
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
                                                    <td>{{ $member->created_at }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="3" style="text-align: right">Total</th>
                                                <th>{{$SumofMoney}}</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        <script>
            function profitCalculation(){

                var year = document.getElementById("scheme").value;
                var savingsAmount = document.getElementById("savingsAmount").value;
                if(year==0){
                    var profit= 0;
                    savingsAmount=Math.round(savingsAmount);
                    var total= profit + savingsAmount;
                    document.getElementById("profit").value = profit;
                    document.getElementById("total_money").value = total;
                }
                else if(year==2){
                    var profit= savingsAmount*.15;
                    profit=Math.round(profit);
                    savingsAmount=Math.round(savingsAmount);
                    var total= profit + savingsAmount;
                    document.getElementById("profit").value = profit;
                    document.getElementById("total_money").value = total;
                }else if(year==3){
                    var profit= savingsAmount*.26;
                    profit=Math.round(profit);
                    savingsAmount=Math.round(savingsAmount);
                    var total= profit + savingsAmount;
                    document.getElementById("profit").value = profit;
                    document.getElementById("total_money").value = total;
                }else if(year==4){
                    var profit= savingsAmount*.36;
                    profit=Math.round(profit);
                    savingsAmount=Math.round(savingsAmount);
                    var total= profit + savingsAmount;
                    document.getElementById("profit").value = profit;
                    document.getElementById("total_money").value = total;
                }else if(year==5){
                    var profit= savingsAmount*.40;
                    profit=Math.round(profit);
                    savingsAmount=Math.round(savingsAmount);
                    var total= profit + savingsAmount;
                    document.getElementById("profit").value = profit;
                    document.getElementById("total_money").value = total;
                }else if(year==1){
                    var profit= 0;
                    savingsAmount=Math.round(savingsAmount);
                    var total= profit + savingsAmount;
                    document.getElementById("profit").value = profit;
                    document.getElementById("total_money").value = total;
                }


            }

            function addBonus() {
                var year = document.getElementById("bonus").value;
                var profit = document.getElementById("profit").value;
                var savingsAmount = document.getElementById("savingsAmount").value;
                var sum=Math.round(year)+Math.round(savingsAmount)+Math.round(profit);
                document.getElementById("total_money").value = sum;
            }

        </script>
        <!-- /.container-fluid -->
@endsection

