@extends('Backend.master')

@section('title')
    Sheets
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
                <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">ALL Sheets</h5>
                @if( $message = Session::get('message') )
                    <h6 class="page-header text-success" style="text-align: center">{{ $message }}</h6>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sheet No</th>
                            
                            <th>Collection Date</th>
                            <th>Savings Amount</th>
                            <th>Loan Amount (TK)</th>
                            <th>Loan Service (TK)</th>
                            <th>Additional Collection</th>
                            <th>Total</th>
                            <th>Field Officer</th>
                            <th>Cashier Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($sheets as $item)
                            <tr class="odd gradeX">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->sheet_no}}</td>
                                <td>{{ $item->collection_date}} years</td>
                                <td>{{ $item->savings_amount }}</td>
                                <td>{{ $item->loan_amount }}</td>
                                <td>{{ $item->loan_service }}</td>
                                <td>{{ $item->additional_collection }}</td>
                                <td>{{ $item->total}}</td>
                                 <td>{{ $fon->userName($item->field_officer_id)->name}}(#{{ $item->field_officer_id}})</td>
                                <td>{{ $fon->userName($item->cashier_id)->name}}</td>
                                <td>{{ $item->status}}</td>
                                <td>
                                    <a href="{{ url('/edit-sheet-again/'.$item->id) }}" onclick="return confirm('Do you really want to delete this?');" class="btn btn-danger btn-xl" title="Restore Sheet to Fieldofficer" >
                                        <i class="fas fa-trash"></i>
                                    </a>
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
