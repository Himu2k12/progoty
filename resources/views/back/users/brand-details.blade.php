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
                    if(!isset($BrandById)){ ?>

                    This Brand didn't Completed their profile


                   <?php }else{ ?>
                  Brand Details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Details ID</th>
                            <td>{{ $BrandById->id }}</td>
                        </tr>
                        <tr>
                            <th>User ID</th>
                            <td>{{ $BrandById->user_id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $BrandById->name }}</td>
                        </tr>
                        <tr>
                            <th>Email ID</th>
                            <td>{{ $BrandById->email }}</td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td>{{ $BrandById->country }}</td>
                        </tr>
                        <tr>
                            <th>Brand Image</th>
                            <td><img src="{{asset($BrandById->brand_image) }}" height="70" width="70"> </td>
                        </tr>
                        <tr>
                            <th>Position</th>
                            <td>{{ $BrandById->position }}</td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td>{{ $BrandById->mobile }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $BrandById->work_address }}</td>
                        </tr>
                        <tr>
                            <th>Brand Description</th>
                            <td>{{ $BrandById->brand_description }}</td>
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