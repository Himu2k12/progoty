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
    </style>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <h4 style="text-align: center">Member Details</h4>
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
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Basic Info</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-profile" aria-selected="false">Account Info</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-presentAddess" role="tab" aria-controls="nav-contact" aria-selected="false">Present Address</a>
                                <a class="nav-item nav-link" id="nav-documents-tab" data-toggle="tab" href="#nav-permanentAddress" role="tab" aria-controls="nav-documents" aria-selected="false">Permanent Address</a>
                                <a class="nav-item nav-link" id="nav-documents-tab" data-toggle="tab" href="#nav-nominee" role="tab" aria-controls="nav-assignation" aria-selected="false">Nominee Info</a>
                                <a class="nav-item nav-link" id="nav-documents-tab" data-toggle="tab" href="#nav-documents" role="tab" aria-controls="nav-assignation" aria-selected="false">Documents</a>
                            </div>
                        </nav>
                <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Basic Information</h6>
                                        </div>
                                    </div>
                                        <div class="card-body row table-responsive">
                                            <table class="table table-bordered table-hover table-striped">
                                                <tr>
                                                    <th>Member Name</th>
                                                    <td>{{ $viewMember->applicant_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Father's Name</th>
                                                    <td>{{ $viewMember->applicants_father_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>NID Number</th>
                                                    <td>{{ $viewMember->national_id }}</td>
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
                                            <tr>
                                                <th>Yearly Scheme</th>
                                                <td>{{ $viewMember->yearly_scheme }}</td>
                                            </tr>
                                            <tr>
                                                <th>Deposite Type</th>
                                                <td>{{ $viewMember->deposite_type }}</td>
                                            </tr>
                                            <tr>
                                                <th>Amount of money</th>
                                                <td>{{ $viewMember->amount_of_money }}</td>
                                            </tr>
                                            <tr>
                                                <th>Form fee</th>
                                                <td>{{ $viewMember->form_fee }}</td>
                                            </tr>
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
                                            <tr>
                                                <th>Present District</th>
                                                <td>{{ $viewMember->present_dist }}</td>
                                            </tr>
                                            <tr>
                                                <th>Present  Thana/Upazila</th>
                                                <td>{{ $viewMember->present_upa}}</td>
                                            </tr>
                                            <tr>
                                                <th>Present Post Code</th>
                                                <td>{{ $viewMember->present_post_code }}</td>
                                            </tr>
                                            <tr>
                                                <th>Present Village/road</th>
                                                <td>{{ $viewMember->present_village }}</td>
                                            </tr>
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
                                            <tr>
                                                <th>Permanent District</th>
                                                <td>{{ $viewMember->permanent_dist==1 ?'Kurigram':'Lalmonirhat' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Permanent  Thana/Upazila</th>
                                                <td>{{ $upazilaName->upazilaName($viewMember->permanent_upa)->upazila_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Permanent Post Code</th>
                                                <td>{{ $viewMember->permanent_post_code }}</td>
                                            </tr>
                                            <tr>
                                                <th>Permanent Village/road</th>
                                                <td>{{ $viewMember->permanent_village }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-nominee" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Nominee Info</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <th>Nominee Name</th>
                                                <td>{{ $viewMember->nominee_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Relationship</th>
                                                <td>{{ $viewMember->relation}}</td>
                                            </tr>
                                            <tr>
                                                <th>Nominee District</th>
                                                <td>{{ $viewMember->nominee_dist==1?'Kurigram':'Lalmonirhat'}}</td>
                                            </tr>
                                            <tr>
                                                <th>Nominee  Thana/Upazila</th>
                                                <td>{{ $upazilaName->upazilaName($viewMember->nominee_upazila)->upazila_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nominee Post Code</th>
                                                <td>{{ $viewMember->nominee_post_code }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nominee Village/road</th>
                                                <td>{{ $viewMember->nominee_address }}</td>
                                            </tr>
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
                                            <tr>
                                                <th style="text-align: center;vertical-align: middle;">Applicant Photo</th>
                                                <td><img src="{{ asset($viewMember->applicant_photo) }}"></td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: center;vertical-align: middle;">Applicant NID</th>
                                                <td><img src="{{ asset($viewMember->applicant_nid) }}"></td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: center;vertical-align: middle;">Nominee NID</th>
                                                <td><img src="{{ asset($viewMember->nomine_nid) }}" ></td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: center;vertical-align: middle;">Applicant Signature</th>
                                                <td><img src="{{ asset($viewMember->applicant_signature) }}"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>

        <!-- /.container-fluid -->
@endsection

