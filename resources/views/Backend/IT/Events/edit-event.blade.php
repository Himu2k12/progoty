@extends('Backend.master')

@section('title')
    Manage Event
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
                <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">Event Content</h5>
                <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="card shadow mb-12">
                                <div class="card-header py-12">
                                    <div>
                                        <h6 class="m-0 text-md-center font-weight-bold text-md-center text-primary">Edit Event Details</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('/update-event') }}" enctype="multipart/form-data" method="POST" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                            <label class="col-sm-3" style="text-align: center">Picture (250*300)<span style="color: red">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="file" accept="image/*"  required name="event_picture" class="form-control"/>
                                                <img src="{{asset($editInfo->event_picture)}}" height="200" width="200">
                                                <span  style="color: red;">{{ $errors->has('event_picture') ? $errors->first('event_picture') : ' ' }}</span>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3" style="text-align: center">Event Heading<span style="color: red">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="text" maxlength="2000" required name="heading" value="{{$editInfo->heading}}" class="form-control"/>
                                                <input type="hidden" name="id" value="{{$editInfo->id}}" class="form-control"/>
                                                <span  style="color: red;">{{ $errors->has('heading') ? $errors->first('heading') : ' ' }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3" style="text-align: center">Event Date<span style="color: red">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="date" maxlength="2000" required name="date" value="{{$editInfo->date}}" class="form-control"/>
                                                <span  style="color: red;">{{ $errors->has('date') ? $errors->first('date') : ' ' }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3" style="text-align: center">Event Location<span style="color: red">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="text" maxlength="2000" required name="location" value="{{$editInfo->location}}" class="form-control"/>
                                                <span  style="color: red;">{{ $errors->has('location') ? $errors->first('location') : ' ' }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3" style="text-align: center">Event Description<span style="color: red">*</span></label>
                                            <div class="col-sm-6">
                                                <textarea maxlength="2000" rows="5" required name="description" class="form-control">{{$editInfo->description}}</textarea>
                                                <span  style="color: red;">{{ $errors->has('description') ? $errors->first('description') : ' ' }}</span>
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
    </div>
    <!-- /.container-fluid -->



@endsection
