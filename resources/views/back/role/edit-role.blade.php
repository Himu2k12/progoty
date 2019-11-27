@extends('back.master')
@section('title')
   Edit Role
@endsection
@section('content')
    <br/>
    <div class="row">
        <div class="col-sm-offset-4 col-sm-5 col-sm-offset-4">
            <div class="well">
                <h3 class="text-primary" style="text-align: center; padding-bottom: 20px">Edit Role</h3>
                <h6>{{ Session::get('message') }}</h6>

                <form name="editRoleForm" action="{{ url('/update-role') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3" style="text-align: center">Role Name</label>
                            <div class="col-sm-8" style="padding-bottom:20px">
                                <input type="hidden" value="{{$editById->id}}" name="id" class="form-control"/>
                                <input type="text" value="{{$editById->role}}" name="role" class="form-control"/>
                                <span  style="color: red;">{{ $errors->has('role') ? $errors->first('role') : ' ' }}</span>
                            </div>
                            <label class="col-sm-3" style="text-align: center">Role Status</label>
                            <div class="col-sm-8" style="padding-bottom:20px">
                                <select name="access" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span  style="color: red;">{{ $errors->has('access') ? $errors->first('access') : ' ' }}</span>
                            </div>
                            <div class="col-sm-3 col-sm-offset-5">
                                <input type="submit" name="btn" class="btn btn-success btn-block" value="Update"/>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.forms['editRoleForm'].elements['status'].value = '{{$editById->access }}';
    </script>
@endsection









