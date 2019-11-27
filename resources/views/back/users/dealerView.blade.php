@extends('admin.master')
@section('title')
    Add-product
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
                            @foreach($dealerProductsOnSales as $dealerProductsOnSale)
                                <tr class="odd gradeX">
                                    <td>{{ $i++ }}</td>
                                    <td>{{$dealerProductsOnSale->id}}</td>
                                    <td>{{$dealerProductsOnSale->product_name}}</td>
                                    <td>{{$dealerProductsOnSale->name}}</td>
                                    <td>{{$dealerProductsOnSale->category_name}}</td>
                                    <td><img src="{{$dealerProductsOnSale->product_image}}" height="70px" width="70px"></td>
                                    <td>{{$dealerProductsOnSale->product_price}}</td>
                                    <td>{{$dealerProductsOnSale->product_quantity}}</td>
                                    <td>{{$dealerProductsOnSale->view}}</td>

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
                <h2 style="text-align: center">Dealer Selling History</h2>
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
                        <h3 style="text-align: center; padding-top: 50px;">৳ {{$netIncome-$OnlyWithdraw-($netIncome)*7/100}}</h3>

                    </div>

                </div>
            </div>

        </div><!--/tab-pane-->
    </div><!--/tab-content-->


@endsection