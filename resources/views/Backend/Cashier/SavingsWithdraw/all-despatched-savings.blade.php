@extends('Backend.master')

@section('title')
    Despatched-Accounts
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
                <h4 class="text-primary" style="text-align: center">Despatched Account History</h4>
                @if( $message = Session::get('mass') )
                    @if( $message = Session::get('mass') )
                        <div style="text-align: center" class="alert alert-success alert-dismissible fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{$message}}
                        </div>
                    @endif
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Withdraw Info ID</th>
                            <th>Account Name & No</th>
                            <th>Total (TK)</th>
                            <th>Despatch Date</th>
                            <th>Field Officer Name</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($alreadyDespatched as $item)
                            <tr class="odd gradeX">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->savings_withdraw_id }}</td>
                                <td>{{ $item->applicant_name}}(#{{ $item->accountNo}})</td>
                                <td><b>{{ $item->total_despatched}}</b></td>
                                <td>{{ $item->despatched_date}}</td>
                                <td>{{ $item->name}}(# {{$item->field_man_id}})</td>
                                <td>

                                    @if($item->status==1)
                                        <div style="padding:5px;color:white;background: cornflowerblue; border-radius: 10px; text-align: center">Despatched</div>
                                    @else
                                        <div style="padding:5px; background: greenyellow; border-radius: 10px; text-align: center">Not Despatched</div>
                                    @endif

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
