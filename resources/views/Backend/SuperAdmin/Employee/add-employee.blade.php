@extends('Backend.master')

@section('title')
    Manage Employee
@endsection

@section('style')
    <link href="{{asset('/Assets/')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">Employee Management</h5>
                <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <nav class="divstyle border-bottom-success">
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Employee Add Form</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-profile" aria-selected="false">All Employees</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 text-md-center font-weight-bold text-md-center text-primary">Add Employee</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ url('/new-staffs') }}" style="text-align: center">
                                            @csrf

                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 col-form-label newLevel" >{{ __('Name') }}</label>

                                                <div class="col-md-6">
                                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" style="color: red" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-md-4 col-form-label newLevel">{{ __('E-Mail Address') }}</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" style="color: red" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label newLevel">{{ __('Password') }}</label>

                                                <div class="col-md-6">
                                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" style="color: red" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password-confirm" class="col-md-4 col-form-label newLevel">{{ __('Confirm Password') }}</label>

                                                <div class="col-md-6">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="role" class="col-md-4 col-form-label newLevel">{{ __('Select Role') }}</label>

                                                <div class="col-md-6" >
                                                    <select class="form-control" name="role">
                                                        @foreach($roles as $role)
                                                            <option value="{{$role->id}}">{{$role->role}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="offset-md-4 col-md-6">
                                                    <button type="submit" class="col-md-12 btn btn-primary">
                                                        {{ __('Register') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-account" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 text-md-center font-weight-bold text-md-center text-primary">All Employees</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
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
                                                    <td style="text-align: center">@if($role->role==3)<span style="background-color: blue; color: white; border-radius: 10px; padding: 5px">{{$role->roleName}}</span> @elseif($role->role==2)<span style="background-color: darkslategrey; color: white; border-radius: 10px; padding: 5px">{{$role->roleName}}</span> @elseif($role->role==4)<span style="background-color: brown; color: white; border-radius: 10px; padding: 5px"> {{$role->roleName}}</span> @elseif($role->role==5) <span style="background-color: #1b6d85; color: white; border-radius: 10px; padding: 5px"> {{$role->roleName}}</span> @else Not Specific @endif</td>
                                                    <td style="text-align: center">@if($role->access ==1)<span style="background-color: green; color:white; border-radius: 10px; padding: 5px">Active</span>@else <span style="width:40px; background-color: red;color: white; border-radius: 10px; padding: 5px">InActive</span>@endif</td>
                                                    <td>
                                                        @if($role->access ==1)
                                                            <a href="{{ url('/inactive-staff/'.$role->id) }}" class="btn btn-success btn-xl" title="Active Role">
                                                                <span class="fas fa-arrow-circle-up"></span>
                                                            </a>
                                                        @else
                                                            <a href="{{ url('/active-staff/'.$role->id) }}" class="btn btn-warning btn-xl" title="Disabled Role">
                                                                <span class="fas fa-arrow-circle-down"></span>
                                                            </a>
                                                        @endif

                                                        <a href="{{ url('/edit-staff/'.$role->id) }}" class="btn btn-primary btn-xl" title="Edit Role">
                                                            <span class="fas fa-edit"></span>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->



@endsection
