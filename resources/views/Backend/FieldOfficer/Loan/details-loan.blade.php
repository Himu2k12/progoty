@extends('Backend.master')

@section('title')
    Loan Details

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
                    <h4 style="text-align: center">Loan Description</h4>
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
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Applicant Information</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-profile" aria-selected="false">Account Info</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-presentAddess" role="tab" aria-controls="nav-contact" aria-selected="false">Address</a>
                                <a class="nav-item nav-link" id="nav-documents-tab" data-toggle="tab" href="#nav-permanentAddress" role="tab" aria-controls="nav-documents" aria-selected="false">Loan</a>
                                <a class="nav-item nav-link" id="nav-documents-tab" data-toggle="tab" href="#nav-nominee" role="tab" aria-controls="nav-assignation" aria-selected="false">Nominee Info</a>
                                <a class="nav-item nav-link" id="nav-documents-tab" data-toggle="tab" href="#nav-documents" role="tab" aria-controls="nav-assignation" aria-selected="false">Documents</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Applicant Information</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row">
                                        <table width="100%" class="table  table-bordered table-hover table-striped">
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
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-account" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Account Info</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row">
                                        <table width="100%" class="table table-striped table-bordered table-hover">
                                            <tbody>
                                            <tr>
                                                <th style="width: 50%">Account No</th>
                                                <td>{{ $customerInfo->id }}</td>
                                            </tr>
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
                            <div class="tab-pane fade" id="nav-presentAddess" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Permanent Address</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row">
                                        <table width="100%" class="table table-striped table-bordered table-hover">
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
                                </div>
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Loan time Present Address</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row">
                                        <table width="100%" class="table table-striped table-bordered table-hover">
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
                            <div class="tab-pane fade" id="nav-permanentAddress" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Loan Related Information</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row">
                                        <table width="100%" class="table table-striped table-bordered table-hover">
                                            <tbody>
                                            <tr>
                                                <th style="width: 50%">Loan ID</th>
                                                <td style="color: green"><b>{{ $loanInfo->id }}</b></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 50%">Loan Amount</th>
                                                <td style="color: #1b4b72"><b>{{ $loanInfo->loan_amount }}</b></td>
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
                            <div class="tab-pane fade" id="nav-nominee" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Nominee Info 1</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row">
                                        <table width="100%" class="table table-striped table-bordered table-hover">
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
                                                <td class="th">{{$nominee_one_savings}}</td>
                                            </tr>
                                            <tr>
                                                <th>Nominee Signature</th>
                                                <td><img id="myImg5" src="{{ asset($nominee_one->applicant_signature)}}" height="50px" width="50px"></td>
                                            </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Nominee Info 2</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row">
                                        <table width="100%" class="table table-striped table-bordered table-hover">
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
                            <div class="tab-pane fade" id="nav-nominee1" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Documents</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-nominee2" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Documents</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-documents" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Documents</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row">
                                        <table width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr style="background-color: black; color: white">

                                                <th style="width: 33%">Applicant Photo</th>
                                                <th style="width: 33%">Applicant NID</th>
                                                <th style="width: 33%">Applicant Signature</th>
                                            </tr>

                                            <tr>
                                                <td><img id="myImg" src="{{ asset($customerInfo->applicant_photo) }}" alt="{{$customerInfo->applicant_name}}" ></td>
                                                <td><img id="myImg2" src="{{ asset($customerInfo->applicant_nid) }}" width="100%"></td>
                                                <td><img id="myImg3" src="{{ asset($customerInfo->applicant_signature) }}" height="80px" width="100%" ></td>
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
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- /.container-fluid -->
@endsection

