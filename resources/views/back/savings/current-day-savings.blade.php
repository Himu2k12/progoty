@extends('back.master')
@section('title')
   Today Collections
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-offset-3 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="text-info" style="text-align: center">Today Collection On Savings</h1>
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
                            <th>Member ID</th>
                            <th>Member Name</th>
                            <th>Sheet No</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
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
                                <td>
                                    <a href="{{ url('/edit-member-daily-savings/'.$member->slug) }}" class="btn btn-info btn-xl" title="View Member Details">
                                        <span class="glyphicon glyphicon-edit"></span>
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