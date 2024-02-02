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
    <div class="container-fluid row">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <h4 style="text-align: center">Final Check on Savings Withdraw</h4>
                    @if( $message = Session::get('message') )
                        <h1 class="page-header">{{ $message }}</h1>
                    @endif
                </div>
            </div>
        </div>

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
                                        <form style="border: 1px solid #bbbbbb; padding: 20px" enctype="multipart/form-data" name="documents" action="{{url('/submit-to-super')}}" method="post">
                                            {{csrf_field()}}
                                            <div class="row">
                                                <div class="col-sm-6 offset-3" style="margin-bottom: 20px">
                                                    <fieldset class="field_border" >
                                                        <legend class="legend_border" style="text-align: center;"> (যাচাই করা তথ্য)</legend>

                                                        <div class="col-sm-12" style=" margin-bottom: 20px">
                                                            <label class="required">Account Opening Date(অ্যাকাউন্ট খোলার দিন)</label>
                                                            <?php

                                                            $AcOD=$allInfo->created_at;
                                                            $AcOD=date('d-m-Y', strtotime($AcOD));

                                                            $ApD=$allInfo->applicationDate;
                                                            $ApD=date('d-m-Y',strtotime($ApD));
                                                            ?>
                                                            <input readonly type="text" id="" class="form-control" name="" value="{{$AcOD}}" required minlength="4">
                                                            <span  id="error_bank_name" style="color: red;">{{ $errors->has('') ? $errors->first('') : ' ' }}</span>
                                                        </div>
                                                        <div class="col-sm-12" style=" margin-bottom: 20px">
                                                            <label class="required">Withdrawal Application Date (আবেদনের তারিখ)</label>
                                                            <input  readonly type="text" class="form-control" name="loan_suggest" value="{{$ApD}}" required>
                                                            <input  name="request_id" type="hidden" value="{{$allInfo->id}}">
                                                            <input  name="withdraw_id" type="hidden" value="{{$allInfo->Lid}}">
                                                            <span style="color: red;">{{ $errors->has('loan_suggest') ? $errors->first('loan_suggest') : ' ' }}</span>
                                                        </div>
                                                        <div class="col-sm-12" style=" margin-bottom: 20px">
                                                            <label class="required">Savings period (সঞ্চয় সময়কাল)</label>
                                                            <input type="text" class="form-control" readonly value="{{$allInfo->days_of_saving}} days">
                                                            <span style="color: red;">{{ $errors->has('loan_suggest') ? $errors->first('loan_suggest') : ' ' }}</span>
                                                        </div>
                                                        <div class="col-sm-12" style=" margin-bottom: 20px">
                                                            <label class="required">Scheme<span style="color: red">*</span> (অন্যান্য নথি)</label>
                                                            <select required onchange="profitCalculation()" id="scheme" name="scheme_year" class="form-control">
                                                                <option value="">==Select One==</option>
                                                                <option value="0">less than 2 year</option>
                                                                <option value="2">2 years(15%)</option>
                                                                <option value="3">3 years(26%)</option>
                                                                <option value="4">4 years(36%)</option>
                                                                <option value="5">5 years(40%)</option>
                                                            </select>
                                                            <span  id="error_nationality" style="color: red;">{{ $errors->has('other_document') ? $errors->first('other_document') : ' ' }}</span>
                                                        </div>
                                                        <div class="col-sm-12" style=" margin-bottom: 20px">
                                                            <label class="required">Savings Amount(সঞ্চয়ের পরিমান)</label>
                                                            <input readonly type="text" class="form-control" id="savingsAmount" name="savings_amount" value="{{$SumofMoney}}" required minlength="4">
                                                            <span  id="error_applicant_name" style="color: red;">{{ $errors->has('check_no') ? $errors->first('check_no') : ' ' }}</span>
                                                            <input type="hidden" value="" name="slug">
                                                        </div>
                                                        <div class="col-sm-12" style=" margin-bottom: 20px">
                                                            <label class="required">Profit<span style="color: red">*</span> (লভ্যাংশ)</label>
                                                            <input id="profit" name="profit" min="0" required type="number" class="form-control" readonly>
                                                            <span  id="error_nationality" style="color: red;">{{ $errors->has('other_document') ? $errors->first('other_document') : ' ' }}</span>
                                                        </div>
                                                        <div class="col-sm-12" style=" margin-bottom: 20px">
                                                            <label class="required">Bonus<span style="color: red">*</span> (বোনাস)</label>
                                                            <input id="bonus" onblur="addBonus()" name="bonus" type="number" class="form-control" >
                                                            <span  id="error_total_money" style="color: red;">{{ $errors->has('total_money') ? $errors->first('total_money') : ' ' }}</span>
                                                        </div>
                                                        <div class="col-sm-12" style=" margin-bottom: 20px">
                                                            <label class="required">Total Payable<span style="color: red">*</span> (লভ্যাংশ সহ মোট প্রদেয়)</label>
                                                            <input id="total_money" required min="0" name="total" type="number" class="form-control" >
                                                            <span  id="error_total_money" style="color: red;">{{ $errors->has('total_money') ? $errors->first('total_money') : ' ' }}</span>
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
                                                <th colspan="4" style="text-align: right">Total</th>
                                                <th>{{$SumofMoney}}</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

        <!-- /.container-fluid -->
@endsection

