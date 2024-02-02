@extends('Backend.master')

@section('title')
    Manage Slides
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
                <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">Slider</h5>
                <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="card-body">
                    <nav class="divstyle border-bottom-success">
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Slider Add Form</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-profile" aria-selected="false">All Slides</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="card shadow mb-12">
                                <div class="card-header py-12">
                                    <div>
                                        <h6 class="m-0 text-md-center font-weight-bold text-md-center text-primary">Add Slide</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('/new-slide') }}" enctype="multipart/form-data" method="POST" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                            <label class="col-sm-4 offset-1" style="text-align: center">Slide Picture</label>
                                            <div class="col-sm-5">
                                                <input type="file" required accept="image/*" onchange="readURL2(this)" name="slide_name" class=""/>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="submit" name="btn" class="btn btn-success btn-block" value="Save"/>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body row table-responsive">
                                    <img id="slider" src="#" alt="Slider" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-account" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="card shadow mb-12">
                                <div class="card-header py-12">
                                    <div>
                                        <h6 class="m-0 text-md-center font-weight-bold text-md-center text-primary">All Slides</h6>
                                    </div>
                                </div>
                                <div class="card-body row table-responsive">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                                        <thead>
                                        <tr>
                                            <th>Slide ID</th>
                                            <th>Slide Picture</th>
                                            <th>Date</th>
                                            <th>Slide Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($slides as $item)
                                            <tr class="odd gradeX">

                                                <td>{{ $item->id }}</td>
                                                <td> <img src="{{ $item->slide_name}}" height="100px" width="400px"></td>
                                                <td>{{$item->created_at}}</td>
                                                <td style="text-align: center">
                                                    @if($item->status ==1)
                                                        <span style="background-color: green;color: white; border-radius: 5px; padding: 5px"> Active </span>
                                                    @else
                                                        <span style="background-color: red;color: white; border-radius: 5px; padding: 5px"> InActive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->status ==1)
                                                        <a href="{{ url('/inactive-slide/'.$item->id) }}" class="btn btn-success btn-xl" title="Disable Slide">
                                                            <i class="fas fa-arrow-alt-circle-up"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ url('/active-slide/'.$item->id) }}" class="btn btn-warning btn-xl" title="Active Slide">
                                                            <i class="fas fa-arrow-alt-circle-down"></i>
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

                       <div class="offset-4 col-sm-4">
                        <span style="color: red;padding-left: 10px">{{ $errors->has('slide_name') ? $errors->first('slide_name') : ' ' }}</span>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- /.container-fluid -->



@endsection
