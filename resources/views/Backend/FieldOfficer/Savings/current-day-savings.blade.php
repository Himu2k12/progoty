@extends('Backend.master')

@section('title')
    Manage Savings
@endsection

@section('style')
    <link href="{{asset('/Assets/')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <h4 style="text-align: center">Daily Transaction Details</h4>
                    @if( $message = Session::get('message') )
                        <h5 class="page-header text-success text-md-center">{{ $message }}</h5>
                    @endif
                    @if( $message = Session::get('Negmessage') )
                        <h5 class="page-header text-danger text-md-center">{{ $message }}</h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                        <nav class="divstyle border-bottom-success">
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Savings Collections</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-profile" aria-selected="false">Loan Collections</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-md-center text-primary">Daily Savings Collections</h6>
                                        </div>
                                    </div>
                                   
                                    <div class="card-body table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                                            <thead>
                                            <tr>
                                                <th>Serial</th>
                                                <th>ID</th>
                                                <th>Member ID</th>
                                                <th>Member Name</th>
                                                <th>Sheet No</th>
                                                <th>Savings Amount</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=1; ?>
                                            @foreach($everyDayCollection as $member)
                                                <tr class="odd gradeX">
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $member->id }}</td>
                                                    <td>{{ $member->mid }}</td>
                                                    <td>{{ $member->applicant_name }}</td>
                                                    <td>{{ $member->sheet_no }}</td>
                                                    <td>{{ $member->amount }}</td>
                                                    <td>{{ $member->created_at }}</td>
                                                    <td>
                                                        @if(Auth::user()->id==$member->field_man_id)
                                                        <a href="{{ url('/edit-member-daily-savings/'.$member->slug) }}" class="btn btn-info btn-xl" title="View Member Details">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a onclick="return confirm('Are you sure? You want to Delete the Entry Permanently?')" href="{{ url('/delete-member-daily-savings/'.$member->slug) }}" class="btn btn-danger btn-xl" title="Delete Member Deposit">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                            @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="4" style="text-align: right">Total</th>
                                                <th>{{$sumOfDeposite}}</th>
                                                <th colspan="2" ></th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-account" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-md-center text-primary">Daily Loan Collections</h6>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable2">
                                            <thead>
                                            <tr>
                                                <th>Serial</th>
                                                <th>Transaction ID</th>
                                                <th>Loan ID</th>
                                                <th>Member ID</th>
                                                <th>Member Name</th>
                                                <th>Sheet No</th>
                                                <th>Loan Return</th>
                                                <th>Service Charge</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=1; ?>
                                            <?php $j=1; ?>
                                            @foreach($everyDayLoanApplication as $member)
                                                <tr class="odd gradeX">
                                                    <td>{{ $j++ }}</td>
                                                    <td>{{ $member->id }}</td>
                                                    <td>{{ $member->loan_id }}</td>
                                                    <td>{{ $member->account_no }}</td>
                                                    <td>{{ $member->applicant_name }}</td>
                                                    <td>{{ $member->sheet_no }}</td>
                                                    <td>{{ $member->amount }}</td>
                                                    <td>{{ $member->service_charge }}</td>
                                                    <td>{{ $member->created_at }}</td>
                                                    <td>
                                                        @if(Auth::user()->id==$member->field_man_id)
                                                        <a href="{{ url('/edit-daily-loan-deposites/'.$member->slug) }}" class="btn btn-info btn-xl" title="View Member Details">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a onclick="return confirm('Are you sure? You want to Delete the Entry Permanently?')" href="{{ url('/delete-daily-loan-deposites/'.$member->slug) }}" class="btn btn-danger btn-xl" title="Delete Loan Deposit">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                            @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="5" style="text-align: right">Total</th>
                                                <th>{{$sumOfDepositeLoanAmount}}</th>
                                                <th>{{$sumOfDepositeService}}</th>
                                                <th colspan="2" ></th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
        </div>
    </div>
    <!-- /.container-fluid -->



@endsection
@section('additionalScript')
    <!-- Page level plugins -->

@endsection
