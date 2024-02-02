@extends('Backend.master')

@section('title')
    Savings Withdraws
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
                <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">Savings Withdraw Applications</h6>
                @if( $message = Session::get('mass') )
                    <h6 class="page-header text-danger" style="text-align: center">{{ $message }}</h6>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Account Name & No</th>
                            <th>Covered Scheme</th>
                            <th>Savings Amount (TK)</th>
                            <th>Profit (TK)</th>
                            <th>Bonus (TK)</th>
                            <th>Total (TK)</th>
                            <th>Supervisor Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        
                        @foreach($requestForAdmin as $item)
                            <tr class="odd gradeX">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->applicant_name}}(#{{ $item->accountNo}})</td>
                                <td>{{ $item->percentage}} %</td>
                                <td>{{ $item->savings_amount }}</td>
                                <td>{{ $item->profit }}</td>
                                <td>{{ $item->bonus}}</td>
                                <td>{{ $item->total}}</td>
                                <td>{{ $item->name}}</td>
                                <td>{{ $item->status==0 ? 'Pending':'Observed'}}</td>
                                <td style="width: 150px;padding: 0; margin: 0;">
                                    <a href="{{ url('/details-view-withdraw-request-admin/'.$item->id) }}" class="btn btn-primary btn-xl" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ url('approve-for-despatch/'.$item->id) }}" class="btn btn-success btn-xl" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    <a onclick="return confirm('Are you sure to Reject this?')" href="{{ url('/cancel-request-by-admin/'.$item->id) }}" class="btn btn-danger btn-xl" title="Cancel">
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
