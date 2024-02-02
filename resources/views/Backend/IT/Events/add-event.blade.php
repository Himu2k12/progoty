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
                        <nav class="divstyle border-bottom-success">
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Add Event</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-profile" aria-selected="false">All Events</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="card shadow mb-12">
                                    <div class="card-header py-12">
                                        <div>
                                            <h6 class="m-0 text-md-center font-weight-bold text-md-center text-primary">Add Event Detials</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ url('/store-new-event') }}" enctype="multipart/form-data" method="POST" class="form-horizontal">
                                            {{ csrf_field() }}
                                            <div class="form-group row">
                                                <label class="col-sm-3" style="text-align: center">Picture (250*300)<span style="color: red">*</span></label>
                                                <div class="col-sm-6">
                                                    <input type="file" accept="image/*"  required name="event_picture" class="form-control"/>
                                                    <span  style="color: red;">{{ $errors->has('event_picture') ? $errors->first('event_picture') : ' ' }}</span>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3" style="text-align: center">Event Heading<span style="color: red">*</span></label>
                                                <div class="col-sm-6">
                                                    <input type="text" maxlength="2000" required name="heading" class="form-control"/>
                                                    <span  style="color: red;">{{ $errors->has('heading') ? $errors->first('heading') : ' ' }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3" style="text-align: center">Event Date<span style="color: red">*</span></label>
                                                <div class="col-sm-6">
                                                    <input type="date" maxlength="2000" required name="date" class="form-control"/>
                                                    <span  style="color: red;">{{ $errors->has('date') ? $errors->first('date') : ' ' }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3" style="text-align: center">Event Location<span style="color: red">*</span></label>
                                                <div class="col-sm-6">
                                                    <input type="text" maxlength="2000" required name="location" class="form-control"/>
                                                    <span  style="color: red;">{{ $errors->has('location') ? $errors->first('location') : ' ' }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3" style="text-align: center">Event Description<span style="color: red">*</span></label>
                                                <div class="col-sm-6">
                                                    <textarea maxlength="2000" rows="5" required name="description" class="form-control"></textarea>
                                                    <span  style="color: red;">{{ $errors->has('description') ? $errors->first('description') : ' ' }}</span>
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
                                            <h6 class="m-0 text-md-center font-weight-bold text-md-center text-primary">All Events</h6>
                                        </div>
                                    </div>
                                    <div class="card-body row table-responsive">
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                                            <thead>
                                            <tr>
                                                <th>Event ID</th>
                                                <th>Picture</th>
                                                <th>Heading</th>
                                                <th>Description</th>
                                                <th>Date</th>
                                                <th>Location</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($events as $item)
                                                <tr class="odd gradeX">

                                                    <td>{{ $item->id }}</td>
                                                    <td> <img src="{{asset($item->event_picture)}}" height="100px" width="200px"></td>
                                                    <td>{{$item->heading}}</td>
                                                    <td>{{$item->description}}</td>
                                                    <td>{{$item->date}}</td>
                                                    <td>{{$item->location}}</td>
                                                    <td>{{$item->created_at}}</td>
                                                    <td>{{$item->updated_at}}</td>
                                                    <td>
                                                        @if($item->status ==0)
                                                            <span style="background-color: greenyellow; border-radius: 10px; padding: 5px"> Active </span>
                                                        @elseif($item->status ==1)
                                                            <span style="background-color: red; border-radius: 10px; padding: 5px"> Completed</span>
                                                            @else
                                                            <span style="background-color: red; border-radius: 10px; padding: 5px"> Canceled</span>
                                                        @endif
                                                    </td>
                                                    <td><p style="width: 100px">
                                                            <a href="{{ url('/edit-event/'.$item->id) }}" class="btn btn-info btn-xl" title="Edit Event">
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
