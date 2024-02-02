@extends('Backend.master')

@section('title')
    Manage Role
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
                <h4 style="text-align: center" class="m-0 font-weight-bold text-primary">Employee</h4>
                <h6 style="text-align: center" class="text-success"></h6>
            </div>
            <div class="card mb-4 py-3 border-left-success">
                <div class="card-body">
                    <form method="POST" action="{{ route('update-staff') }}" name="editEmployee">
                        @csrf
                        <input type="hidden" name="id" value="{{$userInfo->id}}">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $userInfo->name }}" required autocomplete="name" autofocus>

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Employee Role') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="role" >
                                    @foreach($role as $item)
                                        <option value="{{$item->id}}">{{$item->role}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <script>
        document.forms['editEmployee'].elements['role'].value = '{{$userInfo->role}}';
    </script>

@endsection
@section('additionalScript')
    <!-- Page level plugins -->

@endsection
