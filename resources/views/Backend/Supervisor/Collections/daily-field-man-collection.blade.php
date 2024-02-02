@extends('Backend.master')

@section('title')
    Collection Details

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
                    <h4 style="text-align: center">Daily Collection Details</h4>
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
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Savings Collections</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-profile" aria-selected="false">Loan Collections</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-addition" role="tab" aria-controls="nav-profile" aria-selected="false">Additional Collections</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Collection On Savings</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                                            <thead>
                                            <tr>
                                                <th>SL NO</th>
                                                <th>Member ID</th>
                                                <th>Member Name</th>
                                                <th>Sheet No</th>
                                                <th>Savings Amount</th>
                                                <th>Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=1; ?>
                                            @foreach($everyDayCollection as $member)
                                                <tr class="odd gradeX">
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $member->mid }}</td>
                                                    <td>{{ $member->applicant_name }}</td>
                                                    <td>{{ $member->sheet_no }}</td>
                                                    <td>{{ $member->amount }}</td>
                                                    <td>{{ $member->created_at }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="4" style="text-align: right">Total</th>
                                                <th>{{$sumOfDeposite}}</th>
                                                <th></th>
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
                                            <h6 class="m-0 font-weight-bold text-primary">Collection On Loans</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable2">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Loan ID</th>
                                                <th>Member ID</th>
                                                <th>Member Name</th>
                                                <th>Loan Return</th>
                                                <th>Service Charge</th>
                                                <th>Sheet No</th>
                                                <th>Date&Time</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=1; ?>
                                            @foreach($everyDayLoanApplication as $member)
                                                <tr class="odd gradeX">
                                                    <td>{{ $member->id }}</td>
                                                    <td>{{ $member->loan_id }}</td>
                                                    <td>{{ $member->account_no }}</td>
                                                    <td>{{ $member->applicant_name }}</td>
                                                    <td>{{ $member->amount }}</td>
                                                    <td>{{ $member->service_charge }}</td>
                                                    <td>{{ $member->sheet_no }}</td>
                                                    <td>{{ $member->created_at }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="4" style="text-align: right">Total</th>
                                                <th>{{$sumOfDepositeLoanAmount}}</th>
                                                <th>{{$sumOfDepositeService}}</th>
                                                <th>Grand Total</th>
                                                <th>{{$sumOfDepositeLoanAmount+$sumOfDepositeService}}</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-addition" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 font-weight-bold text-primary">Collection On Additional Collection</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable3">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Collection Category</th>
                                                <th>Description</th>
                                                <th>Date</th>
                                                <th>Field Officer</th>
                                                <th>Additional Cost</th>
                                                <th>Created At</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $total=0; ?>

                                            @foreach($additionalCollection as $items)
                                                <tr class="odd gradeX">
                                                    <td>{{ $items->id }}</td>
                                                    <td>{{ $colcate->collectionCategoryName($items->collection_category)->category }}</td>
                                                    <td>{{ $items->description }}</td>
                                                    <td>{{ $items->date_of_cost }}</td>
                                                    <td>{{ $foN->userName($items->created_by)->name}} ({{$items->created_by}})</td>
                                                    <td>{{ $items->additional_cost }}</td>
                                                    <td>{{ $items->created_at }}</td>

                                                </tr>
                                                <?php  $total+=$items->additional_cost ?>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="5" style="text-align: right">Total</th>

                                                <th>{{$total}}</th>
                                                <th></th>
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
        </div>

        <!-- /.container-fluid -->
@endsection

