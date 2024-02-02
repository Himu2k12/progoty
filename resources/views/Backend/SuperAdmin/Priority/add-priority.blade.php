@extends('Backend.master')

@section('title')
    Manage Priority
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
                <h4 style="text-align: center" class="m-0 font-weight-bold text-primary">Priority</h4>
                <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
            </div>
        <div class="card mb-4 py-3 border-left-success">
            <div class="card-body">

                <form class="form-inline" action="{{url('/add-priority')}}" method="post">
                    {{ csrf_field() }}
                    <label style="margin-left: 20px" class="col-sm-4" for="status">Priority Type<span style="color:red ">*</span></label>
                     <input type="text" name="priority" class="col-sm-4 form-control" placeholder="Enter Priority Type">
                    <button style="margin-left: 20px" type="submit" class="btn btn-success">Submit</button>
                </form>
                <div class="offset-4 col-sm-4">
                    <span style="color: red;padding-left: 10px">{{ $errors->has('priority') ? $errors->first('priority') : ' ' }}</span>
                </div>

            </div>
        </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">All Priorities</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Priority Type Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($priority as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->priority}}</td>
                            <td> @if($item->status==1)
                                <a  class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                    </span>
                                    <span class="text">{{$item->status==1?"Active": "Deactive"}}</span>
                                </a>
                                    @else

                                    <a  class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-exclamation-triangle"></i>
                    </span>
                                        <span class="text">{{$item->status==1?"Active": "Deactive"}}</span>
                                    </a>
                                @endif
                                </td>
                            <td>

                                <a href="{{ url('/edit-priority/'.$item->id) }}" class="btn btn-primary btn-xl" title="Edit Status">
                                    <span><i class="fas fa-edit"></i></span>
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
@section('additionalScript')
    <!-- Page level plugins -->

    @endsection
