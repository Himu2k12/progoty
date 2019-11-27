@extends('admin.master')
@section('title')
    All Customers
@endsection
@section('content')

    <div class="col-sm-offset-2 col-sm-10" style="padding-left: 2%">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
            <li><a data-toggle="tab" href="#products">Products</a></li>
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
            <div class="tab-pane" id="products">
                <br>
                <h2 style="text-align: center">My Products</h2>

                <hr>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        DataTables Advanced Tables
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example-two">
                            <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Customer ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Access</th>
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
                <form class="form" action="##" method="post" id="registrationForm">
                    <div class="form-group">

                        <div class="col-xs-6">
                            <label for="first_name"><h4>First name</h4></label>
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name if any.">
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-xs-6">
                            <label for="last_name"><h4>Last name</h4></label>
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any.">
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-xs-6">
                            <label for="phone"><h4>Phone</h4></label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your phone number if any.">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="mobile"><h4>Mobile</h4></label>
                            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="enter mobile number" title="enter your mobile number if any.">
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-xs-6">
                            <label for="email"><h4>Email</h4></label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-xs-6">
                            <label for="email"><h4>Location</h4></label>
                            <input type="email" class="form-control" id="location" placeholder="somewhere" title="enter a location">
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-xs-6">
                            <label for="password"><h4>Password</h4></label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="password" title="enter your password.">
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-xs-6">
                            <label for="password2"><h4>Verify</h4></label>
                            <input type="password" class="form-control" name="password2" id="password2" placeholder="password2" title="enter your password2.">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <br>
                            <button class="btn btn-lg btn-success pull-right" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                            <!--<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>-->
                        </div>
                    </div>
                </form>
            </div>

        </div><!--/tab-pane-->
    </div><!--/tab-content-->


@endsection