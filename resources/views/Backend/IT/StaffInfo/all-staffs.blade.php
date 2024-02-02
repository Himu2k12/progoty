@extends('Backend.master')

@section('title')
    Manage Profiles
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
                <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">Employees Profile</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Staff ID</th>
                            <th>Staff Name</th>
                            <th>Staff Email</th>
                            <th>Role</th>
                            <th>Status</th>
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
                                <td style="text-align: center">@if($role->role==3)<span style="background-color: blue; color: white; border-radius: 10px; padding: 5px"> Field Officer</span> @elseif($role->role==2)<span style="background-color: darkslategrey; color: white; border-radius: 10px; padding: 5px"> Supervisor</span> @elseif($role->role==4)<span style="background-color: brown; color: white; border-radius: 10px; padding: 5px"> Cashier</span> @elseif($role->role==5) <span style="background-color: #1b6d85; color: white; border-radius: 10px; padding: 5px"> IT Specialist</span> @else Not Specific @endif</td>
                                <td style="text-align: center">@if($role->access ==1)<span style="background-color: green; color:white; border-radius: 10px; padding: 5px">Active</span>@else <span style="width:40px; background-color: red;color: white; border-radius: 10px; padding: 5px">InActive</span>@endif</td>
                                <td>
                                    <a href="{{ url('new-staff-info/'.$role->id) }}" class="btn btn-primary btn-xl" title="Edit Profile">
                                        <span class="fas fa-eye"></span>
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

