@extends('back.master')
@section('title')
    Manage Staffs
@endsection
@section('content')
    <br/>

    <div class="row">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="text-info" style="text-align: center">Manage Staffs</h1>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Staff ID</th>
                            <th>Staff Name</th>
                            <th>Staff Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($staffs as $role)
                            <tr class="odd gradeX">
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->email }}</td>
                                <td style="text-align: center">@if($role->role==3)<span style="background-color: blue; color: white; border-radius: 10px; padding: 5px"> Field Officer</span> @elseif($role->role==2)<span style="background-color: darkslategrey; color: white; border-radius: 10px; padding: 5px"> Supervisor</span> @elseif($role->role==4)<span style="background-color: brown; color: white; border-radius: 10px; padding: 5px"> Cashier</span> @else Not Specific @endif</td>
                                <td style="text-align: center">@if($role->access ==1)<span style="background-color: green; color:white; border-radius: 10px; padding: 5px">Active</span>@else <span style="width:40px; background-color: red;color: white; border-radius: 10px; padding: 5px">InActive</span>@endif</td>
                                <td>
                                    @if($role->access ==1)
                                        <a href="{{ url('/inactive-staff/'.$role->id) }}" class="btn btn-success btn-xl" title="Active Role">
                                            <span class="glyphicon glyphicon-arrow-up"></span>
                                        </a>
                                    @else
                                        <a href="{{ url('/active-staff/'.$role->id) }}" class="btn btn-warning btn-xl" title="Disabled Role">
                                            <span class="glyphicon glyphicon-arrow-down"></span>
                                        </a>
                                    @endif

                                    <a href="{{ url('/edit-staff/'.$role->id) }}" class="btn btn-primary btn-xl" title="Edit Role">
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