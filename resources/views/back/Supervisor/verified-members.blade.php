@extends('back.master')
@section('title')
    Manage-Customer-order
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-offset-3 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="text-info" style="text-align: center">Progoty Members</h1>
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
                            <th>Applicant ID</th>
                            <th>Applicant Name</th>
                            <th>National ID</th>
                            <th>Join Date</th>
                            <th>Field Officer Name</th>
                            <th>Applicant Image</th>
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
                                    <a href="{{ url('/details-verified-member/'.$member->slug) }}" class="btn btn-info btn-xl" title="View Member Details">
                                        <span class="glyphicon glyphicon-zoom-in"></span>
                                    </a>
                                    @if($member->verify ==0)
                                        <a href="{{ url('/verify-members/'.$member->slug) }}" class="btn btn-danger btn-xl" title="Confirm Verification">
                                            <span class="glyphicon glyphicon-arrow-up"></span>
                                        </a>
                                    @endif

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