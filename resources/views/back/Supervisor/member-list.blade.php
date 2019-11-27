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
                            <th>Member ID</th>
                            <th>Member Name</th>
                            <th>National ID</th>
                            <th>Date</th>
                            <th>Field Man Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($newMembers as $member)
                            <tr class="odd gradeX">
                                <td>{{ $i++ }}</td>
                                <td>{{ $member->id }}</td>
                                <td>{{ $member->applicant_name }}</td>
                                <td>{{ $member->national_id }}</td>
                                <td>{{ $member->created_at }}</td>
                                <td>{{ $member->name }}</td>
                                <td><img src="{{url($member->applicant_photo)}}" width="60px" height="50px"></td>
                                <td>
                                    <a href="{{ url('/details-member-view/'.$member->slug) }}" class="btn btn-info btn-xl" title="View Member Details">
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