@extends('back.master')
@section('title')
    Manage-Customer-order
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-offset-3 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="text-info" style="text-align: center">Overview New Member</h1>
                    @if( $message = Session::get('message') )
                        <h4 class="page-header text-success" style="text-align: center">{{ $message }}</h4>
                    @endif
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Loan ID</th>
                            <th>Account No</th>
                            <th>Loan Amount</th>
                            <th>Application Date</th>
                            <th>Field Officer</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($newLoan as $loan)
                            <tr class="odd gradeX">
                                <td>{{ $i++ }}</td>
                                <td>{{ $loan->id }}</td>
                                <td>{{ $loan->account_no }}</td>
                                <td>{{ $loan->loan_amount }}</td>
                                <td>{{ $loan->application_date }}</td>
                                <td>{{ $loan->name }}</td>
                                {{--<td><img src="{{url($member->applicant_photo)}}" width="60px" height="50px"></td>--}}
                                <td>
                                    <a href="{{ url('/details-loan-view/'.$loan->slug) }}" class="btn btn-info btn-xl" title="View Member Details">
                                        <span class="glyphicon glyphicon-zoom-in"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection