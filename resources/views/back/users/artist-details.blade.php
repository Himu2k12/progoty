@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if( $message = Session::get('message') )
                <h1 class="page-header">{{ $message }}</h1>
            @endif
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-offset-3 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <?php
                    if(!isset($ArtistById)){ ?>

                    This Brand didn't Completed their profile


                   <?php }else{ ?>
                  Artist Details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Details ID</th>
                            <td>{{ $ArtistById->id }}</td>
                        </tr>
                        <tr>
                            <th>User ID</th>
                            <td>{{ $ArtistById->artist_id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $ArtistById->artist_name }}</td>
                        </tr>
                        <tr>
                            <th>Email ID</th>
                            <td>{{ $ArtistById->email }}</td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td>{{ $ArtistById->country }}</td>
                        </tr>
                        <tr>
                            <th>Artist Profile Picture</th>
                            <td><img src="{{asset($ArtistById->artist_pp) }}" height="70" width="70"> </td>
                        </tr>
                        <tr>
                            <th>Artist Type</th>
                            <td>{{ $ArtistById->artist_type }}</td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td>{{ $ArtistById->mobile }}</td>
                        </tr>
                        <tr>
                            <th>Facebook Link</th>
                            <td>{{ $ArtistById->fb_link }}</td>
                        </tr>
                        <tr>
                            <th>Website</th>
                            <td>{{ $ArtistById->website }}</td>
                        </tr>
                        <tr>
                            <th>Artist Bio</th>
                            <td>{{ $ArtistById->artist_bio }}</td>
                        </tr>
                        </thead>
                    </table>
                    </div>
                <!-- /.panel-body -->
                <?php } ?>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection