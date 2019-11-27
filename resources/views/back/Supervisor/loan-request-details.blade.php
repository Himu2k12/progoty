@extends('back.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if( $message = Session::get('message') )
                <h1 class="page-header">{{ $message }}</h1>
            @endif
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-offset-3 col col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center">
                    <h2>Loan Application Details</h2>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <h3>Applicant Info</h3>
                    <hr/>
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Applicant Name</th>
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
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                    <h3>Account Info</h3>
                    <hr/>
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
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
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <h3>Permanent Address</h3>
                    <hr/>
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Permanent District</th>
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
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <h2 style="text-align: center">Loan Information</h2>
                    <hr/>
                    <h3>Loan Related</h3>
                    <hr/>
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Loan Amount</th>
                            <td>{{ $viewMember->loan_amount }}</td>
                        </tr>
                        <tr>
                            <th>Application Date</th>
                            <td>{{ $viewMember->application_date }}</td>
                        </tr>
                        <tr>
                            <th>Applicant Mobile</th>
                            <td>{{ $viewMember->mobile_one }}</td>
                        </tr>
                        <tr>
                            <th>Applicant Mobile 2</th>
                            <td>{{ $viewMember->mobile_two }}</td>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <h3>Present Address</h3>
                    <hr/>
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Present District</th>
                            <td>{{ $viewMember->present_district }}</td>
                        </tr>
                        <tr>
                            <th>Present  Thana/Upazila</th>
                            <td>{{ $viewMember->present_thana }}</td>
                        </tr>
                        <tr>
                            <th>Present Post Code</th>
                            <td>{{ $viewMember->present_post_code }}</td>
                        </tr>
                        <tr>
                            <th>Present Village/road</th>
                            <td>{{ $viewMember->present_village }}</td>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <h3>Nominee Info 1</h3>
                    <hr/>
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Application Name</th>
                            <td>{{ $nominee_one->applicant_name}}</td>
                        </tr>
                        <tr>
                            <th>Account No</th>
                            <td>{{ $nominee_one->id}}</td>
                        </tr>
                        <tr>
                            <th>Total Savings</th>
                            <td>{{ $nominee_one->total}}</td>
                        </tr>
                        <tr>
                            <th>Nominee Signature</th>
                            <td><img src="{{ asset($nominee_one->applicant_signature)}}" height="50px" width="50px"></td>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <h3>Nominee Info 2</h3>
                    <hr/>
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Application Name</th>
                            <td>{{ $nominee_two->applicant_name}}</td>
                        </tr>
                        <tr>
                            <th>Account No</th>
                            <td>{{ $nominee_two->id}}</td>
                        </tr>
                        <tr>
                            <th>Total Savings</th>
                            <td>{{ $nominee_two->total}}</td>
                        </tr>
                        <tr>
                            <th>Nominee Signature</th>
                            <td><img src="{{ asset($nominee_two->applicant_signature)}}" height="50px" width="50px"></td>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>

                            <th>Applicant Photo</th>
                            <th>Applicant NID</th>
                            <th>Nominee NID</th>
                            <th>Applicant Signature</th>
                        </tr>

                            <tr>
                                <td><img src="{{ asset($viewMember->applicant_photo) }}" height="200px" width="200px"></td>
                                <td><img src="{{ asset($viewMember->applicant_nid) }}" height="60px" width="60px"></td>
                                <td><img src="{{ asset($viewMember->nomine_nid) }}" height="60px" width="60px"></td>
                                <td><img src="{{ asset($viewMember->applicant_signature) }}" height="60px" width="60px"></td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="col-sm-3 col-sm-offset-3">
                    <a href="{{ url('/verify-members/'.$viewMember->id) }}" class="btn btn-success btn-lg" title="Confirm Verification">
                        <span class="glyphicon glyphicon-ok">Approve</span>
                    </a>
                    </div>
                    <div class="col-sm-3">
                     <a href="#" class="btn btn-danger btn-lg" title="Decline Verification">
                        <span class="glyphicon glyphicon-remove">Cancel</span>
                    </a>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection