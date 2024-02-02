@extends('Backend.master')

@section('title')
    Pending Request
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
                <h4 class="text-primary" style="text-align: center">Pending Savings Withdraw Applications For ED</h4>
                @if( $message = Session::get('message') )
                    <h4 class="page-header text-success" style="text-align: center">{{ $message }}</h4>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Request ID</th>
                            <th>Account No</th>
                            <th>Scheme</th>
                            <th>Last Savings</th>
                            <th>Profit</th>
                            <th>Bonus</th>
                            <th>Total</th>
                            <th>Date of Confirmation</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($pendingForAdminApproval as $item)
                            <tr class="odd gradeX">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->request_id}}</td>
                                <td>{{ $item->accountNo}}</td>
                                <td>{{$item->percentage}}%</td>
                                <td>{{ $item->savings_amount }}</td>
                                <td>{{ $item->profit }}</td>
                                <td>{{ $item->bonus}}</td>
                                <td>{{ $item->total}}</td>
                                <td>{{ $item->created_at}}</td>
                                <td>{{ $item->status==0 ? 'Pending':'Observed'}}</td>
                                <td style="width: 100%">
                                    <a href="{{ url('/edit-submit-requests-by-id/'.$item->id) }}" class="btn btn-success btn-xl" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ url('/withdraw-requests-by-id/'.$item->request_id) }}" class="btn btn-info btn-xl" title="Details">
                                        <i class="fas fa-eye"></i>
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
