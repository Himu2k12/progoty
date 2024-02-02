@extends('Backend.master')

@section('title')
    Manage About
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
                <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">About Content</h5>
                <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <nav class="divstyle border-bottom-success">
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Add About</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-profile" aria-selected="false">About Content</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 text-md-center font-weight-bold text-md-center text-primary">Add About</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ url('/store-about-content') }}" enctype="multipart/form-data" method="POST" class="form-horizontal">
                                            {{ csrf_field() }}
                                            <div class="form-group row">
                                                <label class="col-sm-3" style="text-align: center">Picture (540*360)<span style="color: red">*</span></label>
                                                <div class="col-sm-6">
                                                    <input type="file" accept="image/*"  required name="about_picture" class="form-control"/>
                                                    <span  style="color: red;">{{ $errors->has('about_picture') ? $errors->first('about_picture') : ' ' }}</span>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3" style="text-align: center">About Content<span style="color: red">*</span></label>
                                                <div class="col-sm-6">
                                                    <textarea maxlength="2000" rows="5" required name="about_content" class="form-control"></textarea>
                                                    <span  style="color: red;">{{ $errors->has('about_content') ? $errors->first('about_content') : ' ' }}</span>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3" style="text-align: center">About Content (Bangla)<span style="color: red">*</span></label>
                                                <div class="col-sm-6">
                                                    <textarea maxlength="2000" rows="5" required name="about_content_bangla" class="form-control"></textarea>
                                                    <span  style="color: red;">{{ $errors->has('about_content_bangla') ? $errors->first('about_content_bangla') : ' ' }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <input type="submit" name="btn" class="btn btn-success btn-block" value="Save"/>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-account" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 text-md-center font-weight-bold text-md-center text-primary">About Contents</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                                            <thead>
                                            <tr>
                                                <th>About ID</th>
                                                <th>Picture</th>
                                                <th>Content</th>
                                                <th>Content (Bangla)</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($about as $item)
                                                <tr class="odd gradeX">

                                                    <td>{{ $item->id }}</td>
                                                    <td> <img src="{{asset($item->about_image)}}" height="100px" width="200px"></td>
                                                    <td>{{$item->about_content}}</td>
                                                    <td>{{$item->about_content_bangla}}</td>
                                                    <td>{{$item->created_at}}</td>
                                                    <td>
                                                        @if($item->status ==1)
                                                            <span style="background-color: greenyellow; border-radius: 10px; padding: 5px"> Active </span>
                                                        @else
                                                            <span style="background-color: red; border-radius: 10px; padding: 5px"> InActive</span>
                                                        @endif
                                                    </td>
                                                    <td><p style="width: 100px">
                                                        @if($item->status ==1)
                                                            <a href="{{ url('/inactive-about/'.$item->id) }}" class="btn btn-success btn-xl" title="Active About">
                                                                <span class="fas fa-arrow-alt-circle-up"></span>
                                                            </a>
                                                        @else
                                                            <a href="{{ url('/active-about/'.$item->id) }}" class="btn btn-warning btn-xl" title="Disable About">
                                                                <span class="fas fa-arrow-alt-circle-down"></span>
                                                            </a>
                                                        @endif
                                                            <a href="{{ url('/edit-about/'.$item->id) }}" class="btn btn-info btn-xl" title="Edit About">
                                                                <span class="fas fa-edit"></span>
                                                            </a>
                                                        </p>
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
