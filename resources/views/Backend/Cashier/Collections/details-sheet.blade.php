@extends('Backend.master')

@section('title')
    Sheet Collections
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
                <h4 class="text-primary" style="text-align: center">Sheet's Collections</h4>
                @if( $message = Session::get('message') )
                    <h4 class="page-header text-success" style="text-align: center">{{ $message }}</h4>
                @endif
            </div>
            @php $total=0; @endphp
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Field Officer Name</th>
                            <th>Sheet No</th>
                            <th>Collection Date</th>
                            <th>Savings Amount</th>
                            <th>Loan Amount</th>
                            <th>Loan Service</th>
                            <th>Additional Collection</th>
                            <th>Total</th>
                            <th>Cashier</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($sheet as $item)
                            <tr class="odd gradeX">
                                <td>{{ $item->id }}</td>
                                <td>{{ $FieldOfficerName->userName($item->field_officer_id)->name }}</td>
                                <td>{{ $item->sheet_no }}</td>
                                <td>{{ $item->collection_date }}</td>
                                <td>{{ $item->savings_amount }}</td>
                                <td>{{ $item->loan_amount }}</td>
                                <td>{{ $item->loan_service }}</td>
                                <td>{{ $item->additional_collection }}</td>
                                <td>{{ $item->total }}</td>
                                <td>{{ $FieldOfficerName->userName($item->cashier_id)->name }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    @if($item->cashier_id==\Illuminate\Support\Facades\Auth::id())
                                    <a href="{{ url('/cashier-edit-sheet/'.$item->slug) }}" class="btn btn-info btn-xl" title="Edit">
                                        <span class="fas fa-edit"></span>
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            @php $total+=$item->total @endphp
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="8">Grand Total:</th>
                            <th>{{$total}}</th>
                        </tr>
                        </tfoot>
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
