@extends('Backend.master')

@section('title')
   Edit Role
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 style="text-align: center" class="m-0 font-weight-bold text-primary">Edit Status</h4>
                <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
            </div>
            <div class="card mb-4 py-3 border-left-success">
                <div class="card-body">

                    <form class="form-inline" name="editstatusForm" action="{{url('/update-status')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group" style="width: 100%">
                            <label class="col-sm-3" style="text-align: center">Status Type Name</label>

                                <input type="hidden" value="{{$editById->id}}" name="id"/>
                                <input type="text" value="{{$editById->status_name}}" name="status_name" class="col-sm-2 form-control"/>
                                <label class="col-sm-2" style="text-align: center">Status</label>
                                <select name="status" class="col-sm-2 form-control" style="margin-right: 20px">
                                    <option value="1">Activate</option>
                                    <option value="0">Deactivate</option>
                                </select>
                                <span  style="color: red;">{{ $errors->has('status') ? $errors->first('status') : ' ' }}</span>
                                <input type="submit" name="btn" class=" col-sm-1 btn btn-success btn-block" value="Update"/>
                            <span  style="color: red;">{{ $errors->has('status_name') ? $errors->first('status_name') : ' ' }}</span>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.forms['editstatusForm'].elements['status'].value = '{{$editById->status }}';
    </script>
@endsection









