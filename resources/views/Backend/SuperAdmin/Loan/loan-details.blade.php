@extends('Backend.master')

@section('title')
    Loan Application Details

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
    </style>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <h4 style="text-align: center">Loan Application Details</h4>
                    <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
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
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Basic Info</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Account Type</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-address" role="tab" aria-controls="nav-address" aria-selected="false">Address</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-loan" role="tab" aria-controls="nav-loan" aria-selected="false">Loan Request</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-loan-address" role="tab" aria-controls="nav-loan-address" aria-selected="false">Final Loan Info</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-nominee-info" role="tab" aria-controls="nav-nominee-info" aria-selected="false">Nominee</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-applicant-document" role="tab" aria-controls="nav-applicant-document" aria-selected="false">Documents</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-supervisor-review" role="tab" aria-controls="nav-supervisor-review" aria-selected="false"> Verification</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="card-header py-3">
                                        <h6  class="m-0 font-weight-bold text-info">Member Info</h6>
                                    </div>
                                    <table width="100%" class="table  table-bordered table-hover">
                                        <thead>
                                        <td colspan="2" style="background-color: #FF4800;color: white; font-size: 20px; text-align: center;font-style: oblique; ">Applicant Information</td>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th style="width: 50%">Applicant Name</th>
                                            <td>{{ $customerInfo->applicant_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Father's Name</th>
                                            <td>{{ $customerInfo->applicants_father_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>NID Number</th>
                                            <td class="th">{{ $customerInfo->national_id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Gender</th>
                                            <td>{{ $customerInfo->gender }}</td>
                                        </tr>
                                        <tr>
                                            <th>Marital Status</th>
                                            <td>{{ $customerInfo->marital_status }}</td>
                                        </tr>
                                        <tr>
                                            <th>Religion</th>
                                            <td>{{ $customerInfo->religion }}</td>
                                        </tr>
                                        <tr>
                                            <th>Spouse Name</th>
                                            <td>{{ $customerInfo->husband_name }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade table-responsive" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="card-header py-3">
                                        <h6  class="m-0 font-weight-bold text-info">Member Info</h6>
                                    </div>
                                    <div class="card shadow mb-4">
                                        <div class="card-body table-responsive">
                                            <table width="100%" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <td colspan="2" style="background-color: #FF4800;color: white; font-size: 20px; text-align: center;font-style: oblique; ">Account Information</td>
                                                </thead>
                                                <tbody>

                                                <tr>
                                                    <th style="width: 50%">Yearly Scheme</th>
                                                    <td>{{ $customerInfo->yearly_scheme }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Deposite Type</th>
                                                    <td>{{ $customerInfo->deposite_type }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Amount of Deposite</th>
                                                    <td>{{ $customerInfo->amount_of_money }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="color: red">Total Saving Till Now</th>
                                                    <td style="color: red"><b>{{ $totalApplicantDeposite }}</b></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade table-responsive" id="nav-address" role="tabpanel" aria-labelledby="nav-address-tab">
                                    <div class="card-header py-3">
                                        <h6  class="m-0 font-weight-bold text-info">Member Info</h6>
                                    </div>
                                    <div class="card shadow mb-4">
                                        <div class="card-body table-responsive">
                                            <table width="100%" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <td colspan="2" style="background-color: #FF4800;color: white; font-size: 20px; text-align: center;font-style: oblique; ">Permanent Address</td>
                                                </thead>
                                            
                                                <tbody>
                                                <tr>
                                                    <th style="width: 50%">Permanent District</th>
                                                    <td>{{ $customerInfo->permanent_dist==1 ?'Kurigram':'Lalmonirhat' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Permanent  Thana/Upazila</th>
                                                    <td>{{ $customerInfo->permanent_upa }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Permanent Post Code</th>
                                                    <td>{{ $customerInfo->permanent_post_code }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Permanent Village/road</th>
                                                    <td>{{ $customerInfo->permanent_village }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            
                                            
                                            
                                        </div>
                                         <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <table width="100%" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <td colspan="2" style="background-color: black;color: white; font-size: 20px; text-align: center;font-style: oblique; ">Present Address</td>
                                                </tr>
                                                </thead>
                                                 <tbody>
                                                <tr>
                                                    <th style="width: 50%">Present District</th>
                                                    <td>{{ $loanInfo->present_district }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Present  Thana/Upazila</th>
                                                    <td>{{ $loanInfo->present_thana }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Present Post Code</th>
                                                    <td>{{ $loanInfo->present_post_code }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Present Village/road</th>
                                                    <td>{{ $loanInfo->present_village }}</td>
                                                </tr>

                                                </tbody>
                                            
                                               </table>
                                        </div>
                                    </div>
                              
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-loan" role="tabpanel" aria-labelledby="nav-loan-tab">
                                    <div class="card-header py-3">
                                        <h6  class="m-0 font-weight-bold text-info">Loan Infos</h6>
                                    </div>
                                    <div class="card shadow mb-4">
                                        <div class="card-body table-responsive">
                                            <table width="100%" class="table table-danger table-bordered table-hover">
                                                <thead>
                                                <td colspan="2" style="background-color: black;color: white; font-size: 20px; text-align: center;font-style: oblique; ">Loan Details</td>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th style="width: 50%">Loan Amount</th>
                                                    <td style="font-size: 18px; color: #0c5460"> {{ $loanInfo->loan_amount }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Application Date</th>
                                                    <td>{{ $loanInfo->application_date }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Applicant Mobile</th>
                                                    <td>{{ $loanInfo->mobile_one }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Applicant Mobile 2</th>
                                                    <td>{{ $loanInfo->mobile_two }}</td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-loan-address" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <div class="card-header py-3">
                                        <h6  class="m-0 font-weight-bold text-info">Loan Closing Infos</h6>
                                    </div>
                                    <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <table width="100%" class="table table-striped table-bordered table-hover">
                                                @if($loanInfo->status ==2 || $loanInfo->status==3)
                                                <thead>
                                                <tr>
                                                    <td colspan="2" style="background-color: black;color: white; font-size: 20px; text-align: center;font-style: oblique; ">Last Updated Info</td>
                                                </tr>
                                                </thead>
                                                 <tbody>
                                                <tr>
                                                    <th style="width: 50%">Dispatch Date</th>
                                                    <td>{{ $loanLastInfo->dispatch_date }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 50%">End Date</th>
                                                    <td>{{ $loanLastInfo->decline_date }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Loan Amount</th>
                                                    <td><b>{{ $loanLastInfo->loan_amount }}</b></td>
                                                </tr>
                                                <tr>
                                                    <th>Service Charge (%)</th>
                                                    <td>{{ $loanLastInfo->service_charge }} %</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Payable Amount</th>
                                                    <td style="color:Red">{{ $loanLastInfo->total_amount_with_charge }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Paid Loan Amount+Service</th>
                                                    <td style="color:Green">{{ $totalLoanPay+$totalLoanService }}</td>
                                                </tr>
                                               
                                                    <th>Discount Given</th>
                                                    <td>{{ $loanLastInfo->discount }}</td>
                                                </tr>

                                                </tbody>
                                            @endif
                                               </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-nominee-info" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <div class="card-header py-3">
                                        <h6  class="m-0 font-weight-bold text-info">Nominee Infos</h6>
                                    </div>
                                    <div class="card shadow mb-4">
                                        <div class="card-body  table-responsive">
                                            <table width="100%" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <td colspan="2" style="background-color: black;color: white; font-size: 20px; text-align: center">Nominee Information 1</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th style="width: 50%">Application Name</th>
                                                    <td>{{ $nominee_one->applicant_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Account No</th>
                                                    <td>{{ $nominee_one->id}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Savings</th>
                                                    <td class="th">{{ $nominee_one_savings}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nominee Signature</th>
                                                    <td><img id="myImg5" src="{{ asset($nominee_one->applicant_signature)}}" height="50px" width="50px"></td>
                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-body table-responsive ">
                                            <table width="100%" class="table table-stripedtable-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <td colspan="2" style="background-color: black;color: white; font-size: 20px; text-align: center">Nominee Information 2</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th style="width: 50%">Application Name</th>
                                                    <td>{{ $nominee_two->applicant_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Account No</th>
                                                    <td>{{ $nominee_two->id}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Savings</th>
                                                    <td class="th">{{ $nominee_two_Savings}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nominee Signature</th>
                                                    <td><img id="myImg4" src="{{ asset($nominee_two->applicant_signature)}}" height="50px" width="50px"></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-applicant-document" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <div class="card-header py-3">
                                        <h6  class="m-0 font-weight-bold text-info">Applicant Documents(Savings Accounts)</h6>
                                    </div>
                                    <div class="card shadow mb-4">
                                        <div class="card-body table-responsive">
                                            <table width="100%" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr style="background-color: black; color: white">

                                                    <th style="width: 33%">Applicant Photo</th>
                                                    <th style="width: 33%">Applicant NID</th>
                                                    <th style="width: 33%">Applicant Signature</th>
                                                </tr>

                                                <tr>
                                                    <td><img id="myImg" src="{{ asset($customerInfo->applicant_photo) }}" width="100%" alt="{{$customerInfo->applicant_name}}" ></td>
                                                    <td><img id="myImg2" src="{{ asset($customerInfo->applicant_nid) }}" width="100%"></td>
                                                    <td><img id="myImg3" src="{{ asset($customerInfo->applicant_signature) }}" width="100%" ></td>
                                                </tr>
                                                <div id="myModal" class="modal">
                                                    <span class="close">&times;</span>
                                                    <img class="modal-content" id="img01">
                                                    <div id="caption"></div>
                                                </div>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-supervisor-review" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <div class="card-header py-3">
                                        <h6  class="m-0 font-weight-bold text-info">Supervisor Review</h6>
                                    </div>
                                    <div class="card shadow mb-4">
                                        <div class="card-body table-responsive">
                                            <table width="100%" class="table table-striped  table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th colspan="2" style="background-color: green;color: black; font-size: 20px; text-align: center">Supervisor Verified Documents</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th style="width: 50%;color: #0c5460">Suggest Amount</th>
                                                    <td style="font-size: 18px; color: #0c5460"><i>{{ $supervisorVerificationInfo->loan_suggest}}</i></td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 50%">Check No</th>
                                                    <td>{{ $supervisorVerificationInfo->check_no}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Bank Name</th>
                                                    <td>{{ $supervisorVerificationInfo->bank_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Supervisor Comment</th>
                                                    <td>{{ $supervisorVerificationInfo->note}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Supervisor Name&ID</th>
                                                    <td>{{ $supervisorName->name}}({{$supervisorVerificationInfo->supervisor_id}})</td>
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
                            </div>
                            <div class="row">
                                @if($loanInfo->status==1)
                                    <div class="col-sm-3 offset-1">
                                        <a href=""  class="btn btn-info btn-md" title="Print Documents">
                                            <i class="fas fa-print"> Print</i>
                                        </a>
                                    </div>
                                    <div class="col-sm-3 offset-1">
                                        <a href="{{ url('/verify-loan-first-admin/'.$loanInfo->slug) }}" class="btn btn-success btn-md" title="Confirm Verification">
                                            <i class="fas fa-check"> Approve</i>
                                        </a>
                                    </div>
                                    <div class="col-sm-3 offset-1">
                                        <a href="{{ url('/admin-cancel-loan/'.$loanInfo->slug) }}" class="btn btn-danger btn-md" title="Decline Verification">
                                            <i class="fas fa-trash"> Cancel</i>
                                        </a>
                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

