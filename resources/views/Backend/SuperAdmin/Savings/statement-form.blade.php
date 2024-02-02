@extends('Backend.master')

@section('title')
    Savings Statement
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body" style="text-align: center">
                    <h4 style="text-align: center">Savings Statement</h4>
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
        <div class="card shadow mb-4" id="fromTo">
            <div class="card-header py-3">
                <form action="{{url('submit-savings-statement')}}"  method="get">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3" style="margin: auto">
                            <div class="form-group" style="margin: auto">
                                <label for="exampleInputEmail1"><b>Savings Account No</b></label>
                            </div>
                        </div>
                        <div class="col-sm-4" style="margin: auto">
                            <div class="form-group" style="margin: auto">
                                <input type="number" class="form-control" name="id"   @if(isset($statement)) value="{{$statement->loan_id}}" @endif required>
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
        @if(isset($statements) && !$statements->isEmpty())
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">Savings Deposite Statement</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead style="">
                            <tr style="font-size: .85rem">
                                <th>Collection ID</th>
                                <th>Account No</th>
                                <th>sheet No</th>
                                <th>Date</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody style="font-size: .80rem">
                            <?php
                            $totalCost=0;
                            ?>
                            @foreach($statements as $statement)
                                <tr>
                                    <td>{{$statement->id}}</td>
                                    <td>{!! $statement->member_id !!}</td>
                                    <td>{!! $statement->sheet_no !!}</td>
                                    <td>{{$statement->created_at}}</td>
                                    <td>{{$statement->amount}}</td>
                                </tr>
                                <?php $totalCost+=$statement->amount;   ?>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr style="">
                                <th colspan="3" style="text-align: right">Total</th>
                                <th colspan="1"></th>
                                <th>{{$totalCost}}</th>
                            </tr>
                            </tfoot>
                        </table>
                        <form action="{{url('generate-pdf-for-savings-statment')}}" method="get" target="_blank">
                            @csrf
                            <input type="hidden" name="id" @if(isset($statement)) value="{{$statement->member_id}}" @endif>
                            <button type="submit" class="btn btn-success">Print</button>
                        </form>
                    </div>
                </div>
            </div>
        @else

            <div class="card-header py-3">
                <h6 style="text-align: center" class="m-0 font-weight-bold text-danger">No Savings Statement Found!</h6>
            </div>

    @endif
    <!-- DataTales Example -->
    </div>
    <!-- /.container-fluid -->

@endsection

