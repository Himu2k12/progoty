@extends('Backend.master')

@section('title')
    Cashier Collections
@endsection
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body" style="text-align: center">
                    <h4 style="text-align: center">Collection By Cashier</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Page Heading -->
        <div class="card shadow mb-4" id="daily" >
            <div class="card-header py-3">
                <form action="{{url('daily-collection-cashier')}}" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-sm-1" style="margin: auto">
                            <div class="form-group" style="margin: auto">
                                <label for="exampleInputEmail1"><b>Date</b></label>
                            </div>
                        </div>
                        <div class="col-sm-4" style="margin: auto">
                            <div class="form-group" style="margin: auto">
                                <input type="date" class="form-control" name="date"  @if(isset($from)) value="{{$from}}"@endif required>
                            </div>
                        </div>
                        <div class="col-sm-2" style="margin: auto">
                            <div class="form-group" style="margin: auto">
                                <button type="submit" class="form-control btn btn-info">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if(isset($data) && !$data->isEmpty())
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">Cashier Recieved Money From Officers at {{$from}}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead style="">
                            <tr style="font-size: .85rem">
                                <th>ID</th>
                                <th>sheet No</th>
                                <th>Field Officer</th>
                                <th>Date</th>
                                <th>Savings Amount</th>
                                <th>Loan Collection</th>
                                <th>Service Charge</th>
                                <th>Additional Collection</th>
                                
                                <th>Total</th>
                                <th>Cashier</th>
                            </tr>
                            </thead>
                            <tbody style="font-size: .80rem">
                            <?php
                            $totalCost=0;
                            $totalService=0;
                            ?>

                            @foreach($data as $datam)
                                <tr>
                                    <td>{{$datam->id}}</td>
                                    <td>{{$datam->sheet_no}}</td>
                                    <td>{!! $FoN->userName($datam->field_officer_id)->name !!}({{$datam->field_officer_id}})</td>
                                    <td>{!! $datam->collection_date !!}</td>
                                    <td>{{$datam->savings_amount}}</td>
                                    <td>{{$datam->loan_amount}}</td>
                                    <td>{{$datam->loan_service}}</td>
                                    <td>{{$datam->additional_collection}}</td>
                                    <td>{{$datam->total}}</td>
                                    <td>{!! $FoN->userName($datam->cashier_id)->name !!}({{$datam->cashier_id}})</td>
                                </tr>
                                <?php $totalCost+=$datam->total;   ?>


                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr style="">
                                <th colspan="3" style="text-align: right">Total</th>
                                <th colspan="5"></th>
                                <th>{{$totalCost}}</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>

                            <form action="{{url('daily-generate-pdf-for-cashier-collection')}}" method="get" target="_blank">
                                @csrf
                                <input type="hidden" name="date" @if(isset($from)) value="{{$from}}" @endif>
                                <button type="submit" class="btn btn-success">Print</button>
                            </form>
                    </div>
                </div>
            </div>
        @else
            @if(isset($from))
                <div class="card-header py-3">
                    <h6 style="text-align: center" class="m-0 font-weight-bold text-danger">No Cashier Collection From {{$from}} </h6>
                </div>
        @endif
    @endif
    <!-- DataTales Example -->
    </div>
    <!-- /.container-fluid -->

@endsection

