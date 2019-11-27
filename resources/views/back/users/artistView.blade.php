@extends('admin.master')
@section('title')
    All Artist
@endsection
@section('content')

    <div class="col-sm-offset-2 col-sm-10" style="padding-left: 2%">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
            <li><a data-toggle="tab" href="#post">Posts</a></li>
            <li><a data-toggle="tab" href="#history">Sell-History</a></li>
            <li><a data-toggle="tab" href="#orders">Orders</a></li>
            <li><a data-toggle="tab" href="#Account">Account</a></li>
        </ul>

        <hr>
        <div class="tab-content">
            <div class="tab-pane active" id="home">

                <!-- /.row -->

                <div class="panel panel-default">
                    <div class="panel-heading">
                        DataTables Advanced Tables
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Customer ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Access</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($customers as $customer)
                                <tr class="odd gradeX">
                                    <td>{{ $i++ }}</td>
                                    <td>{{$customer->id}}</td>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>{{$customer->access==0?'No':'Yes'}}</td>
                                    <td>
                                        @if($customer->access ==1)
                                            <a href="{{ url('/admin-disable-artist/'.$customer->id) }}" class="btn btn-success btn-x1" title="Active Artist">
                                                <span class="glyphicon glyphicon-arrow-up"></span>
                                            </a>
                                        @else
                                            <a href="{{ url('/admin-active-artist/'.$customer->id) }}" class="btn btn-warning btn-x1" title="Disable Artist">
                                                <span class="glyphicon glyphicon-arrow-down"></span>
                                            </a>
                                        @endif
                                        <a href="{{ url('/view-artist-details/'.$customer->id) }}" class="btn btn-info btn-xl" title="View Artist">
                                            <span class="glyphicon glyphicon-eye-open"></span>

                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>

                <!-- /.row -->
            </div><!--/tab-pane-->
            <div class="tab-pane" id="post">
                @foreach($posts as $post)
                <div class="panel panel-body row">
                    <div class="col-sm-1" style="text-align: right">
                        <img src="{{$post->artist_pp}}" width="60%" height="40px" class="img-circle">
                    </div>
                    <div class="col-sm-10">
                        <p>{{$post->post}}</p>
                        <img src="{{$post->post_image}}" width="20%" class="img-thumbnail"><br>
                       <b>{{$post->name}}</b>
                        <div class="post__date">
                            <time class="published" datetime="2004-07-24T18:18">
                                {{$post->created_at}}
                            </time>
                        </div>
                    </div>
                    <div class="col-sm-1" style="text-align: right">
                        <a href="{{url('/delete-post/'.$post->id)}}"><span class="glyphicon glyphicon-trash"></span></a>
                    </div>
                </div>
                @endforeach

            </div><!--/tab-pane-->
            <div class="tab-pane" id="history">
                <br>
                <h2 style="text-align: center">My Selling History</h2>
                <hr>

            </div>
            <div class="tab-pane" id="orders">
                <br>
                <h2 style="text-align: center">My Orders</h2>

                <hr>

            </div>

            <div class="tab-pane" id="Account">


                <hr>
                </div>

        </div><!--/tab-pane-->

    </div><!--/tab-content-->


@endsection