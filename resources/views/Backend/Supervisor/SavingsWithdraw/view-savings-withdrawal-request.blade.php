@extends('Backend.master')

@section('title')
    Member Details

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
            width: 50%;
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
                    <h4 style="text-align: center">Withdraw Savings Application Details</h4>
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
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Basic Info</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-profile" aria-selected="false">Account Info</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-presentAddess" role="tab" aria-controls="nav-contact" aria-selected="false">Present Address</a>
                                <a class="nav-item nav-link" id="nav-documents-tab" data-toggle="tab" href="#nav-permanentAddress" role="tab" aria-controls="nav-documents" aria-selected="false">Permanent Address</a>
                                <a class="nav-item nav-link" id="nav-documents-tab" data-toggle="tab" href="#nav-nominee" role="tab" aria-controls="nav-assignation" aria-selected="false">Savings Info</a>
                                <a class="nav-item nav-link" id="nav-documents-tab" data-toggle="tab" href="#nav-documents" role="tab" aria-controls="nav-assignation" aria-selected="false">Documents</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Applicant Basic Information</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table  table-bordered table-hover">
                                            <tbody>
                                            <tr>
                                                <th style="width: 50%">Applicant Name</th>
                                                <td>{{ $viewMember->applicant_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Father's Name</th>
                                                <td>{{ $viewMember->applicants_father_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>NID Number</th>
                                                <td class="th">{{ $viewMember->national_id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Gender</th>
                                                <td>{{ $viewMember->gender }}</td>
                                            </tr>
                                            <tr>
                                                <th>Marital Status</th>
                                                <td>{{ $viewMember->marital_status }}</td>
                                            </tr>
                                            <tr>
                                                <th>Religion</th>
                                                <td>{{ $viewMember->religion }}</td>
                                            </tr>
                                            <tr>
                                                <th>Spouse Name</th>
                                                <td>{{ $viewMember->husband_name }}</td>
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
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover">
                                            <tbody>
                                            <tr>
                                                <th>Account No</th>
                                                <td>{{ $viewMember->id }}</td>
                                            </tr>
                                            <tr>
                                                <th style="width: 50%">Yearly Scheme</th>
                                                <td>{{ $viewMember->yearly_scheme }} years</td>
                                            </tr>
                                            <tr>
                                                <th>Deposite Type</th>
                                                <td>{{ $viewMember->deposite_type }}</td>
                                            </tr>
                                            <tr>
                                                <th>Amount of Deposite</th>
                                                <td>{{ $viewMember->amount_of_money }}</td>
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
                                            <h6 class="m-0 font-weight-bold text-primary">Present Address</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover">
                                            <tbody>
                                            <tr>
                                                <th style="width: 50%">Present District</th>
                                                <td>{{ $viewMember->present_dist }}</td>
                                            </tr>
                                            <tr>
                                                <th>Present  Thana/Upazila</th>
                                                <td>{{ $viewMember->present_upa }}</td>
                                            </tr>
                                            <tr>
                                                <th>Present Post Code</th>
                                                <td>{{ $viewMember->present_post_code }}</td>
                                            </tr>
                                            <tr>
                                                <th>Present Village/road</th>
                                                <td>{{ $viewMember->present_village }}</td>
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
                                            <h6 class="m-0 font-weight-bold text-primary">Permanent Address</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover">
                                            <tbody>
                                            <tr>
                                                <th style="width: 50%">Permanent District</th>
                                                <td>{{ $viewMember->permanent_dist==1 ?'Kurigram':'Lalmonirhat' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Permanent  Thana/Upazila</th>
                                                <td>{{ $viewMember->permanent_upa }}</td>
                                            </tr>
                                            <tr>
                                                <th>Permanent Post Code</th>
                                                <td>{{ $viewMember->permanent_post_code }}</td>
                                            </tr>
                                            <tr>
                                                <th>Permanent Village/road</th>
                                                <td>{{ $viewMember->permanent_village }}</td>
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
                                            <h6 class="m-0 font-weight-bold text-primary">Savings Info</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-danger table-bordered table-hover">
                                            <tbody>
                                            <tr>
                                                <th style="width: 50%">Total Savings Days</th>
                                                <td>{{ $viewMember->days_of_saving }}</td>
                                            </tr>
                                            <tr>
                                                <th>Application Date</th>
                                                <td>{{ $viewMember->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <th>Current Mobile</th>
                                                <td>{{ $viewMember->mobile }}</td>
                                            </tr>
                                            <tr>
                                                <th>Note (By Field Officer)</th>
                                                <td>{{ $viewMember->note }}</td>
                                            </tr>
                                            <tr>
                                                <th>Field Officer ID</th>
                                                <td>{{ $viewMember->field_man_id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Withdraw Request(By Field Officer)</th>
                                                <td style="color: green; font-size: 15px">{{ $viewMember->total_savings }}</td>
                                            </tr>
                                            <tr>
                                                <th style="color: red">Total Saving</th>
                                                <td style="color: red"><b>{{ $totalApplicantDeposite }}</b></td>
                                            </tr>
                                            </tbody>
                                        </table>
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
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr style="background-color: black; color: white">

                                                <th style="width: 33%">Applicant Photo</th>
                                                <th style="width: 33%">Applicant NID</th>
                                                <th style="width: 33%">Applicant Signature</th>
                                            </tr>

                                            <tr>
                                                <td><img id="myImg" src="{{ asset($viewMember->applicant_photo) }}" alt="{{$viewMember->applicant_name}}" ></td>
                                                <td><img id="myImg2" src="{{ asset($viewMember->applicant_nid) }}" width="100%"></td>
                                                <td><img id="myImg3" src="{{ asset($viewMember->applicant_signature) }}" height="80px" width="100%" ></td>
                                            </tr>
                                            <div id="myModal" class="modal">
                                                <span class="close">&times;</span>
                                                <img class="modal-content" id="img01">
                                                <div id="caption"></div>
                                            </div>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            @if($viewMember->Sstatus==0)
                            <div class="col-sm-3 offset-3">
                                <a href="{{ url('/approve-request-by-supervisor/'.$viewMember->Lid) }}" class="btn btn-success btn-lg" title="Confirm Verification">
                                    <i class="fas fa-check"> Approve</i>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="{{ url('/cancel-request-by-supervisor/'.$viewMember->Lid) }}" ONCLICK="return confirm('Are you Sure, to refuse it?')" class="btn btn-danger btn-lg" title="Decline Verification">
                                    <i class="fas fa-trash"> Cancel</i>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- /.container-fluid -->
@endsection

