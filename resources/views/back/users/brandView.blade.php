@extends('admin.master')
@section('title')
    All Brands
@endsection
@section('content')

    <div class="col-sm-offset-2 col-sm-10" style="padding-left: 2%">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
            <li><a data-toggle="tab" href="#products">Products</a></li>
            <li><a data-toggle="tab" href="#history">Sell-History</a></li>
            <li><a data-toggle="tab" href="#Account">Account</a></li>
        </ul>

        <hr>
        <div class="tab-content">
            <div class="tab-pane active" id="home">

                <!-- /.row -->

                <div class="panel panel-default" style="border: 2px solid #bbbbbb">
                    <div class="panel-heading" style="text-align: center">
                       All Brands Info
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
                                            <a href="{{ url('/admin-disable-brand/'.$customer->id) }}" class="btn btn-success btn-x1" title="Active Brand">
                                                <span class="glyphicon glyphicon-arrow-up"></span>
                                            </a>
                                        @else
                                            <a href="{{ url('/admin-active-brand/'.$customer->id) }}" class="btn btn-warning btn-x1" title="Disable Brand">
                                                <span class="glyphicon glyphicon-arrow-down"></span>
                                            </a>
                                        @endif
                                            <a href="{{ url('/view-brand-details/'.$customer->id) }}" class="btn btn-info btn-xl" title="view Brand">
                                                <span class="glyphicon glyphicon-eye-open"></span>

                                            </a>
                                        @if($brandDetails->CheckBrand($customer->id))
                                            <label class="btn btn-success">Profile Complete</label>
                                            @endif
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
            <div class="tab-pane" id="products">

                <div class="panel panel-default" style="border: 2px solid #bbbbbb">
                    <div class="panel-heading" style="text-align: center">
                        All Products Details
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example-four">
                            <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Brand Name</th>
                                <th>Category Name</th>
                                <th>Product Image</th>
                                <th>Product Price</th>
                                <th>Product Quantity</th>
                                <th>Product View</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($brandProducts as $brandProduct)
                                <tr class="odd gradeX">
                                    <td>{{ $i++ }}</td>
                                    <td>{{$brandProduct->id}}</td>
                                    <td>{{$brandProduct->product_name}}</td>
                                    <td>{{$brandProduct->name}}</td>
                                    <td>{{$brandProduct->category_name}}</td>
                                    <td><img src="{{$brandProduct->product_image}}" height="70px" width="70px"></td>
                                    <td>{{$brandProduct->product_price}}</td>
                                    <td>{{$brandProduct->product_quantity}}</td>
                                    <td>{{$brandProduct->view}}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>

            </div><!--/tab-pane-->
            <div class="tab-pane" id="history">
                <br>
                <h2 style="text-align: center">My Selling History</h2>
                <hr>
                <div class="panel-body" style="border: 2px solid #bbbbbb">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example-three">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Brand ID</th>
                            <th>Brand Name</th>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Sold Quantity</th>
                            <th>Sold Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($sellHistory as $history)
                            <tr class="odd gradeX">
                                <td>{{ $i++ }}</td>
                                <td>{{$history->brand_id}}</td>
                                <td>{{$history->name}}</td>
                                <td>{{$history->product_name}}</td>
                                <td><img src="{{$history->product_image}}" width="70px" height="70px"></td>
                                <td>{{$history->quantity}}</td>
                                <td>{{$history->total_amount}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>

            </div>
            <div class="tab-pane" id="Account">


                <hr>
                <h2 style="text-align: center; padding-bottom: 40px;">Brand Account History</h2>
                <div class="row" style="background-color: #F5F5F5; border-radius:10px;  padding:30px">
                    <div class="col-sm-2" style="height: 150px;">
                        <h4 style="text-align: center;">Brand Income</h4>
                        <h3 style="text-align: center; padding-top: 50px;">৳ {{$netIncome}}</h3>
                    </div>
                    <div class="col-sm-3" style="height:150px; border-left: 1px solid #BDBDBD; border-right: 1px solid #BDBDBD">
                        <h4 style="text-align: center; ">Withdrawn</h4>
                        <h3 style="text-align: center; padding-top: 50px;">৳ {{$OnlyWithdraw}}</h3>
                    </div>
                    <div class="col-sm-3" style="height:150px; border-right: 1px solid #BDBDBD;">
                        <h4 style="text-align: center;">Our Earning(On Withdrawal)</h4>
                        <h3 style="text-align: center; padding-top: 50px;">৳ {{$ourIncome}}</h3>
                    </div>
                    <div class="col-sm-4" style="height:150px;">
                        <h4 style="text-align: center">Waiting For Withdrawal</h4>
                        <h3 style="text-align: center; padding-top: 50px;">৳ {{$netIncome-$OnlyWithdraw-($netIncome)*5/100}}</h3>

                    </div>

                </div>
            </div>

        </div><!--/tab-pane-->

    </div><!--/tab-content-->


@endsection