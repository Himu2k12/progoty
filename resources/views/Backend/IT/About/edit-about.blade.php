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
                <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">Edit About Content</h5>
                <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <div class="card shadow mb-12">
                            <div class="card-header py-12">
                                <div>
                                    <h6 class="m-0 text-md-center font-weight-bold text-md-center text-primary">Edit About</h6>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('/update-about-content') }}" enctype="multipart/form-data" method="POST" class="form-horizontal">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label class="col-sm-3" style="text-align: center">Picture (540*360)<span style="color: red">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="file" accept="image/*"  required name="about_picture" class="form-control"/>
                                            <input type="hidden" name="id" value="{{$editInfo->id}}">
                                            <img src="{{asset($editInfo->about_image)}}" height="200" width="480">
                                            <span  style="color: red;">{{ $errors->has('about_picture') ? $errors->first('about_picture') : ' ' }}</span>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3" style="text-align: center">About Content<span style="color: red">*</span></label>
                                        <div class="col-sm-6">
                                            <textarea maxlength="2000" rows="5" required name="about_content" class="form-control">{{$editInfo->about_content}}</textarea>
                                            <span  style="color: red;">{{ $errors->has('about_content') ? $errors->first('about_content') : ' ' }}</span>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3" style="text-align: center">About Content (Bangla)<span style="color: red">*</span></label>
                                        <div class="col-sm-6">
                                            <textarea maxlength="2000" rows="5" required name="about_content_bangla" class="form-control">{{$editInfo->about_content_bangla}}</textarea>
                                            <span  style="color: red;">{{ $errors->has('about_content_bangla') ? $errors->first('about_content_bangla') : ' ' }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="submit" name="btn" class="btn btn-success btn-block" value="Update"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->



@endsection
