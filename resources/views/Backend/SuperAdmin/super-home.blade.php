@extends('Backend.master')

@section('title')
   Progoty
    @endsection

@section('content')
    <!-- Begin Page Content -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="bg-gradient-info" style="padding: 30px" >
                    <h1 style="text-align: center" class="h3 mb-0 text-gray-100">SUPER ADMIN DASHBOARD</h1>
                </div>
                <div style="padding: 30px; text-align: center">
                    <h6 class="m-0 font-weight-bold text-primary">CURRENT MONTH OVERVIEW</h6>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <!-- Earnings  Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                             <div class="card-body" style="padding-right:0px ">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Savings Deposite</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">৳{{$CurrentMonthsSavings}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <img width="60%" src="{{asset('Assets/')}}/img/savings.png" class="text-gray-300">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings  Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body" style="padding-right: 0px">
                                <div class="row no-gutters align-items-center" >
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Loan Return </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">৳{{$CurrentMonthsLoan}}</div>
                                    </div>
                                    <div class="col-auto">
{{--                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>--}}
                                        <img width="60%" src="{{asset('Assets/')}}/img/loan.png" class="text-gray-300">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        var janSav='{{$janSavings}}';
                        var febSav='{{$febSavings}}';
                        var marSav='{{$marSavings}}';
                        var aprSav='{{$aprSavings}}';
                        var maySav='{{$maySavings}}';
                        var juneSav='{{$juneSavings}}';
                        var julySav='{{$julySavings}}';
                        var augSav='{{$augSavings}}';
                        var sepSav='{{$sepSavings}}';
                        var octSav='{{$octSavings}}';
                        var novSav='{{$novSavings}}';
                        var decSav='{{$decSavings}}';
                        var janLoan='{{$janLoans}}';
                        var febLoan='{{$febLoans}}';
                        var marLoan='{{$marLoans}}';
                        var aprLoan='{{$aprLoans}}';
                        var mayLoan='{{$mayLoans}}';
                        var juneLoan='{{$juneLoans}}';
                        var julyLoan='{{$julyLoans}}';
                        var augLoan='{{$augLoans}}';
                        var sepLoan='{{$sepLoans}}';
                        var octLoan='{{$octLoans}}';
                        var novLoan='{{$novLoans}}';
                        var decLoan='{{$decLoans}}';
                    </script>

                    <!-- Earnings  Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Service CHARGE Collection </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">৳{{$CurrentMonthsLoanService}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body" style="padding-right: 0">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Loan Despatched </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">৳{{$CurrentMonthloanDespatched}}</div>
                                    </div>
                                    <div class="col-auto" style="text-align:right;padding-right: 4%">
                                        <img width="40%" src="{{asset('Assets/')}}/img/loan_des.png" class="text-gray-300">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <!-- Earnings  Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-secondary shadow h-100 py-2">
                            <div class="card-body" style="padding-right: 0px">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2" >
                                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Additional Collections</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">৳{{$CurrentMonthsAdditionalCollection}}</div>
                                    </div>
                                    <div class="col-auto" style="text-align:right;padding-right: 6%">
                                        <i class="text-gray-300"><img src="{{asset('Assets/')}}/img/additional_collection.png"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings  Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body" style="padding-right: 0px">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Additional Expenditure</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">৳{{$CurrentMonthsAdditionalCost}}</div>
                                    </div>
                                    <div class="col-auto" style="text-align:right;padding-right: 6%">
                                        <i class="text-gray-300"><img src="{{asset('Assets/')}}/img/addtional_expense.png"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings  Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body" style="padding-right: 0px">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">New Accounts</div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$CurrentMonthsNewMember}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto"  style="text-align:right;padding-right: 6%">
                                        <i class="text-gray-300"><img src="{{asset('Assets/')}}/img/user.png"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-secondary shadow h-100 py-2">
                            <div class="card-body" style="padding-right: 0px">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">New Loans </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$CurrentMonthloanNumber}}</div>
                                    </div>
                                    <div class="col-auto"  style="text-align:right;padding-right: 6%">
                                        <i class="text-gray-300"><img src="{{asset('Assets/')}}/img/new_loan.png"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->

                <div class="row">

                    <!-- Area Chart -->
                    <div class="col-xl-12 col-md-12 col-lg-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Yearly Overview On Collections({{\Carbon\Carbon::now()->year}})</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Dropdown Header:</div>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="myAreaChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pie Chart -->
{{--                    <div class="col-xl-4 col-lg-5">--}}
{{--                        <div class="card shadow mb-4">--}}
{{--                            <!-- Card Header - Dropdown -->--}}
{{--                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">--}}
{{--                                <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>--}}
{{--                                <div class="dropdown no-arrow">--}}
{{--                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>--}}
{{--                                    </a>--}}
{{--                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">--}}
{{--                                        <div class="dropdown-header">Dropdown Header:</div>--}}
{{--                                        <a class="dropdown-item" href="#">Action</a>--}}
{{--                                        <a class="dropdown-item" href="#">Another action</a>--}}
{{--                                        <div class="dropdown-divider"></div>--}}
{{--                                        <a class="dropdown-item" href="#">Something else here</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- Card Body -->--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="chart-pie pt-4 pb-2">--}}
{{--                                    <canvas id="myPieChart"></canvas>--}}
{{--                                </div>--}}
{{--                                <div class="mt-4 text-center small">--}}
{{--                    <span class="mr-2">--}}
{{--                      <i class="fas fa-circle text-primary"></i> Direct--}}
{{--                    </span>--}}
{{--                                    <span class="mr-2">--}}
{{--                      <i class="fas fa-circle text-success"></i> Social--}}
{{--                    </span>--}}
{{--                                    <span class="mr-2">--}}
{{--                      <i class="fas fa-circle text-info"></i> Referral--}}
{{--                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

@endsection
@section('additional_script')
    <!-- Core plugin JavaScript-->
    <script src="{{asset('/Assets/')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('/Assets/')}}/js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="{{asset('/Assets/')}}/vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="{{asset('/Assets/')}}/js/custom.js"></script>
    <script src="{{asset('/Assets/')}}/js/demo/chart-area-demo.js"></script>
    <script src="{{asset('/Assets/')}}/js/demo/chart-pie-demo.js"></script>

@endsection
