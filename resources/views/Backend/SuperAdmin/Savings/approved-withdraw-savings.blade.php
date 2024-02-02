@extends('Backend.master')

@section('title')
     Pending Despatch
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
                <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">Pending for Cashier Action</h5>
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
                            <th>Request ID</th>
                            <th>Account Name & No</th>
                            <th>Covered Scheme</th>
                            <th>Savings Amount (TK)</th>
                            <th>Total (TK)</th>
                            <th>Date of Confirmation</th>
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
                                <td>{{ $item->request_id}}</td>
                                <td>{{ $item->applicant_name}}(#{{ $item->accountNo}})</td>
                                <td>{{ $item->percentage}} %</td>
                                <td>{{ $item->savings_amount }}</td>
                                <td>{{ $item->total}}</td>
                                <td>{{ $item->created_at}}</td>
                                <td>{{ $item->name}}</td>
                                <td>
                                    @if($item->status==1)
                                    <p style="background-color: #2fa360;border-radius: 10px; color: white;width: 100%;padding: 10px">Send to Cashier</p>
                                        @elseif($item->status==2)
                                        <div style="background-color: #1b6d85;border-radius: 10px; color: white;width: 100%;padding: 10px">Despatched</div>
                                        @endif
                                </td>
                                <td>
                                    <a href="{{ url('/details-view-withdraw-request-admin/'.$item->id) }}" class="btn btn-primary btn-xl" title="View Details">
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
