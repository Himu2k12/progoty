@extends('Backend.master')

@section('title')
    Case Details

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
        td{
            width: 50%;
            text-align: center;
        }
    </style>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <h4 style="text-align: center">Current Loan Details</h4>
                    @if( $message = Session::get('message') )
                        <h5 style="text-align:center" class="page-header text-danger">{{ $message }}</h5>
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
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Loan Summery</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-profile" aria-selected="false">Supervisor Steps</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-presentAddess" role="tab" aria-controls="nav-contact" aria-selected="false">ED Steps</a>
                                <a class="nav-item nav-link" id="nav-documents-tab" data-toggle="tab" href="#nav-permanentAddress" role="tab" aria-controls="nav-documents" aria-selected="false">Cashier Steps</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Summery</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <fieldset class="field_border" >
                                            <div class="col-sm-6 offset-3" style=" margin-bottom: 20px">
                                                <label class="required">Loan Amount(ঋণের পরিমাণ)</label>
                                                <input type="number" readonly class="form-control" value="{{$loanAmount->loan_amount}}" min="1" required>
                                            </div>
                                            <div class="col-sm-6 offset-3" style=" margin-bottom: 20px">
                                                <label class="required">Service Charge(সেবামূল্য)</label>
                                                <input readonly type="number" class="form-control" name="final_amount" value="{{$loanAmount->total_amount_with_charge-$loanAmount->loan_amount}}" min="1" required>
                                                <span style="color: red;">{{ $errors->has('loan_suggest') ? $errors->first('loan_suggest') : ' ' }}</span>
                                            </div>
                                            <div class="col-sm-6 offset-3" style=" margin-bottom: 20px">
                                                <label class="required">Repayment loan(পরিশোধিত ঋণ)</label>
                                                <input style="color: green" type="number" readonly class="form-control" value="{{$paidAmount}}" min="1" required>
                                            </div>
                                            <div class="col-sm-6 offset-3" style=" margin-bottom: 20px">
                                                <label class="required">Paid Service Charge (পরিশোধিত সেবামূল্য) </label>
                                                <input style="color: green" type="number" readonly class="form-control" value="{{$paidService}}" min="1" required>
                                            </div>
                                            
                                        </fieldset>
                                        <hr>
                                        <form action="{{url('/close-loan')}}" method="post">
                                        <div class="col-sm-6 offset-3" style=" margin-bottom: 20px">
                                            <label class="required">Due Loan Amount(বাকি ঋণের পরিমাণ)</label>
                                            <input style="color: red" type="number" readonly name="rest_loan" class="form-control" value="{{$loanAmount->loan_amount-$paidAmount}}" required>
                                        </div>
                                        <div class="col-sm-6 offset-3" style=" margin-bottom: 20px">
                                            <label class="required">Due Service Charge(বাকি সেবামূল্য)</label>
                                            <input style="color: red" type="number" readonly name="rest_service" class="form-control" value="{{($loanAmount->total_amount_with_charge-$loanAmount->loan_amount)-$paidService}}" required>
                                        </div>
                                        <hr>
                                        
                        {{ csrf_field() }}
                        
                                        <div class="col-sm-6 offset-3" style=" margin-bottom: 20px">
                                                <label class="required">Discount Given <span style="color:red">*</span>(ডিসকাউন্ট দেওয়া হলো)</label>
                                                <input style="color: green" type="number" name="discount"  class="form-control" value="{{($loanAmount->loan_amount-$paidAmount)+(($loanAmount->total_amount_with_charge-$loanAmount->loan_amount)-$paidService)}}" min="0" required>
                                            </div>
                                            <div class="col-sm-3 offset-5">
                                                <input type="hidden" name=loan_id value="{{$loanAmount->loan_id}}" >
                                                <input type="submit"  class="form-control btn btn-danger" value="Close Loan"  >
                                            </div>
                                               
                                        </div>
                                        </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-account" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Supervisor Summery</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover">
                                            <tbody>
                                            <tr>
                                                <th style="width: 50%;color: #0c5460">Suggest Amount</th>
                                                <td style="font-size: 18px; color: #0c5460"><i>{{ $supervisor->loan_suggest}}</i></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 50%">Check No</th>
                                                <td>{{ $supervisor->check_no}}</td>
                                            </tr>
                                            <tr>
                                                <th>Bank Name</th>
                                                <td>{{ $supervisor->bank_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Supervisor Comment</th>
                                                <td>{{ $supervisor->note}}</td>
                                            </tr>
                                            <tr>
                                                <th>Supervisor Name&ID</th>
                                                <td>{{ $userName->userName($supervisor->supervisor_id)->name}}({{$supervisor->supervisor_id}})</td>
                                            </tr>
                                            <tr>
                                                <th style="vertical-align: middle">Document Name</th>
                                                <td>
                                                    @foreach($supervisorVerificationDocuments as $doc)
                                                        <a href="{{url('/view-document/'.$doc->id)}}" target="_blank">   {{ $doc->other_document}}</a><br><hr>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-presentAddess" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Admin Summery</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <th>Admin Considered Amount</th>
                                                <td>{{ $AdminVerification->final_amount }}</td>
                                            </tr>
                                            <tr>
                                                <th>Admin Note</th>
                                                <td>{{ $AdminVerification->note }}</td>
                                            </tr>
                                            <tr>
                                                <th>Created At</th>
                                                <td>{{ $AdminVerification->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <th>Updated At</th>
                                                <td>{{ $AdminVerification->updated_at }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-permanentAddress" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Cashier Comments</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <th>Despatch Date</th>
                                                <td>{{ $CashierComment->dispatch_date}}</td>
                                            </tr>
                                            <tr>
                                                <th>Loan Amount</th>
                                                <td>{{ $CashierComment->loan_amount }}</td>
                                            </tr>
                                            <tr>
                                                <th>Service Charge</th>
                                                <td>{{ $CashierComment->service_charge }} %</td>
                                            </tr>
                                            <tr>
                                                <th>Total(Inc Service)</th>
                                                <td>{{ $CashierComment->total_amount_with_charge }}</td>
                                            </tr>
                                            <tr>
                                                <th>Note</th>
                                                <td>{{ $CashierComment->note }}</td>
                                            </tr>
                                            <tr>
                                                <th>Loan Expiration Date</th>
                                                <td>{{ $CashierComment->decline_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Cashier Name</th>
                                                <td>{{ $userName->userName($CashierComment->cashier_id)->name}}(#{{$CashierComment->cashier_id}})</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- /.container-fluid -->
@endsection

