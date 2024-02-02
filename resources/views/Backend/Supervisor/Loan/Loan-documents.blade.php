@extends('Backend.master')

@section('title')
    Manage Loans
@endsection

@section('style')
    <link href="{{asset('/Assets/')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="text-primary" style="text-align: center">Pending Loans for ED</h4>
                @if( $message = Session::get('message') )
                    <h4 class="page-header text-success" style="text-align: center">{{ $message }}</h4>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                        <thead>
                        <tr>
                            <th>Loan ID</th>
                            <th>Account No</th>
                            <th>Check No</th>
                            <th>Consider Amount</th>
                            <th>Bank Name</th>
                            <th>Note</th>
                            <th>Document Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($newLoan as $loan)
                            <tr class="odd gradeX">
                                <td>{{ $loan->loan_id }}</td>
                                <td>{{ $newAccount->AccountNumber($loan->loan_id)->account_no }}</td>
                                <td>{{ $loan->check_no }}</td>
                                <td>{{ $loan->loan_suggest }}</td>
                                <td>{{ $loan->bank_name }}</td>
                                <td>{{ $loan->note }}</td>
                                <td>
                                    @foreach($newObject->documents($loan->loan_id) as $doc)
                                        <a href="{{url('/view-document/'.$doc->id)}}" target="_blank">   {{ $doc->other_document}}</a><br><hr>
                                    @endforeach
                                </td>
                                <td>{{ $loan->status==0?'Pending':'Checked' }}</td>
                                {{--<td><img src="{{url($member->applicant_photo)}}" width="60px" height="50px"></td>--}}
                                <td style="width: 300px;">
                                    <a href="{{ url('/edit-loan-documents/'.$loan->id) }}" class="btn btn-info btn-xl" title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>|
                                    <a href="{{ url('/download-loan-document/'.$loan->loan_id) }}" class="btn btn-success btn-xl" title="Download Files">
                                        <i class="fas fa-download"></i> Download
                                    </a>|
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->



@endsection
@section('additionalScript')
    <!-- Page level plugins -->

@endsection
