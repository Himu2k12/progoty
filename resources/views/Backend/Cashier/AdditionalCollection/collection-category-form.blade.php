@extends('Backend.master')

@section('title')
    Manage Additional Collection
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
                <h4 style="text-align: center" class="m-0 font-weight-bold text-primary">Add New Collection Category</h4>
                @if( $message= Session::get('message'))
                    <h6 style="text-align: center" class="text-success">{{ $message }}</h6>
                @endif
            </div>
            <div class="offset-md-2 col-md-8 card mb-4 py-3 border-left-success">
                <div class="card-body">
                    <form method="POST" action="{{ route('create-category-additional-collection') }}" >
                        @csrf
                        <div class="form-group row">
                            <label for="cost_amount" class="col-md-4 col-form-label text-md-right">{{ __('Category Name') }}<span style="color:red;">*</span></label>
                            <div class="col-md-6">
                                <input id="cost_amount" type="text" class="form-control" name="category" value="{{ old('category') }}" required  autofocus>
                                <span  style="color: red;">{{ $errors->has('category') ? $errors->first('category') : ' ' }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}<span style="color:red;">*</span></label>
                            <div class="col-md-6">
                                <select class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-5">
                                <button type="submit"  class="col-md-5 btn btn-success">
                                    <i class="fas fa-plus"></i>
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">All Additional Collection Categories</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Created By (#ID)</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allCategory as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->category}}</td>
                                <td>{{$category->status==1?"Active":"Inactive"}}</td>
                                <td>{{$category->created_at}}</td>
                                <td>{{$name->userName($category->admin_id)->name}}({{$category->admin_id}})</td>
                                <td>
                                    @if($category->status==1)
                                        <a href="{{ url('/inactive-collection-category/'.$category->id) }}" class="btn btn-success btn-xl" title="Active Category">
                                            <span class="fas fa-arrow-circle-up"></span>
                                        </a>
                                    @else
                                        <a href="{{ url('/active-collection-category/'.$category->id) }}" class="btn btn-warning btn-xl" title="Inactive Category">
                                            <span class="fas fa-arrow-circle-down"></span>
                                        </a>
                                    @endif
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
