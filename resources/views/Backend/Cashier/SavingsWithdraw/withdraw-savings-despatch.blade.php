@extends('Backend.master')

@section('title')
    Withdraw Applications
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
                <h4 class="text-primary" style="text-align: center">Savings Despatch Applications</h4>
                @if( $message = Session::get('mass') )
                    <div style="text-align: center" class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> {{$message}}
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Account Name & No</th>
                            <th>Scheme</th>
                            <th>Savings Amount (TK)</th>
                            <th>Profit (TK)</th>
                            <th>Bonus (TK)</th>
                            <th>Total (TK)</th>
                            <th>Confirmation Date</th>
                            <th>Field Officer Name</th>
                            <th>Status</th>
                            <th  style="text-align: center" colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($confirmedByAdmin as $item)
                            <tr class="odd gradeX">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->applicant_name}}(#{{ $item->accountNo}})</td>
                                <td>{{ $item->percentage}} %</td>
                                <td>{{ $item->savings_amount }}</td>
                                <td>{{ $item->profit }}</td>
                                <td>{{ $item->bonus}}</td>
                                <td><b>{{ $item->total}}</b></td>
                                <?php
                                $AcOD=$item->created_at;
                                $AcOD=date('d-m-Y', strtotime($AcOD));
                                ?>
                                <td>{{ $AcOD}}</td>
                                <td>{{ $item->name}}(#{{$item->FOID}})</td>
                                <td>
                                    @if($item->status==1)
                                        <div style="padding:5px;background: cornflowerblue;color:white; border-radius: 10px; text-align: center">ED Signed</div>
                                    @elseif($item->status==2)
                                        <div style="padding:5px; background: greenyellow; border-radius: 10px; text-align: center"> Despatched </div>
                                    @elseif($item->status==-1)
                                        Canceled
                                    @else
                                        Problem
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('/amount-despatched-to-field-officer/'.$item->id) }}" class="btn btn-success btn-xl" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </a>
                                </td>
                                <td>
                                    <a style="float: left" href="{{ url('/cancel-despatched/'.$item->id) }}" class="btn btn-danger btn-xl" title="Cancel">
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
