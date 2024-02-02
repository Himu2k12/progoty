@extends('Backend.master')

@section('title')
    Manage Scheme
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
                <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">Scheme Management</h5>
                <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <nav class="divstyle border-bottom-success">
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Scheme Form</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-profile" aria-selected="false">All Schemes</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 text-md-center font-weight-bold text-md-center text-primary">Add Percentage</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ url('/new-percent') }}" style="text-align: center">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 col-form-label newLevel" >{{ __('Scheme Title') }}</label>

                                                <div class="col-md-6">
                                                    <input id="name" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>

                                                    @if ($errors->has('title'))
                                                        <span class="invalid-feedback" style="color: red" role="alert">
                                                             <strong>{{ $errors->first('title') }}</strong>
                                                         </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-md-4 col-form-label newLevel">{{ __('Percent') }}</label>

                                                <div class="col-md-6">
                                                    <input id="percentage" type="text" class="form-control{{ $errors->has('percentage') ? ' is-invalid' : '' }}" name="percentage" value="{{ old('percentage') }}" required>

                                                    @if ($errors->has('percentage'))
                                                        <span class="invalid-feedback" style="color: red" role="alert">
                                                            <strong>{{ $errors->first('percentage') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="offset-md-4 col-md-6">
                                                    <button type="submit" class="col-md-12 btn btn-primary">
                                                        {{ __('Save') }}
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
                                                <th>ID</th>
                                                <th>Scheme Title</th>
                                                <th>Percentage</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=1; ?>
                                            @foreach($schemes as $scheme)
                                                <tr class="odd gradeX">
                                                    <td>{{ $scheme->id }}</td>
                                                    <td>{{ $scheme->title }}</td>
                                                    <td>{{ $scheme->percentage }}%</td>
                                                    <td>
                                                        @if($scheme->status==1)
                                                            <a href="{{ url('/inactive-percentage/'.$scheme->id) }}" class="btn btn-success btn-xl" title="Active Percent">
                                                                <span class="fas fa-arrow-circle-up"></span>
                                                            </a>
                                                        @else
                                                            <a href="{{ url('/active-percentage/'.$scheme->id) }}" class="btn btn-warning btn-xl" title="Inactive Percent">
                                                                <span class="fas fa-arrow-circle-down"></span>
                                                            </a>
                                                        @endif

                                                        <a href="{{ url('/edit-percentage/'.$scheme->id) }}" class="btn btn-primary btn-xl" title="Edit">
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
