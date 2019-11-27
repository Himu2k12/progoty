@extends('back.master')
@section('title')
    Manage Role
@endsection
@section('content')
    <br/>
    <div class="row">
        <div class="col-sm-offset-3 col-sm-8">
            <div class="well">
                <h3 class="text-primary" style="text-align: center">Add Role</h3>
               <h4 style="text-align: center" class="text-success">{{ Session::get('message') }}</h4>

                <form action="{{ url('/new-role') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-sm-3" style="text-align: center">Role Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="role" class="form-control"/>
                            <span  style="color: red;">{{ $errors->has('role') ? $errors->first('role') : ' ' }}</span>

                        </div>
                        <div class="col-sm-3">
                            <input type="submit" name="btn" class="btn btn-success btn-block" value="Save"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-offset-3 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="text-info" style="text-align: center">Manage Category</h1>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Role ID</th>
                            <th>Role Name</th>
                            <th>Role Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($roles as $role)
                            <tr class="odd gradeX">
                                <td>{{ $i++ }}</td>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->role }}</td>
                                <td><span style="background-color: yellow; border-radius: 10px; padding: 5px"> {{ $role->access ==1 ? 'Active' : 'Inactive' }}</span></td>
                                <td>
                                    @if($role->access ==1)
                                        <a href="{{ url('/inactive-role/'.$role->id) }}" class="btn btn-success btn-xl" title="Active Role">
                                            <span class="glyphicon glyphicon-arrow-up"></span>
                                        </a>
                                    @else
                                        <a href="{{ url('/active-role/'.$role->id) }}" class="btn btn-warning btn-xl" title="Disabled Role">
                                            <span class="glyphicon glyphicon-arrow-down"></span>
                                        </a>
                                    @endif

                                    <a href="{{ url('/edit-role/'.$role->id) }}" class="btn btn-primary btn-xl" title="Edit Role">
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