@extends('Backend.master')
@section('title')
    Savings Report
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body" style="text-align: center">
                    <h4 style="text-align: center">Savings Reports</h4>
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
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <input type="checkbox" @if(isset($check)) {{$check}} @endif id="checkbox"> Single Day Report
            </div>
        </div>
        <!-- Page Heading -->
        <div class="card shadow mb-4" id="fromTo">
            <div class="card-header py-3">
                <form action="{{url('savings-report')}}"  method="get">
                    @csrf
                    <div class="row">
                        <div class="col-sm-1" style="margin: auto">
                            <div class="form-group" style="margin: auto">
                                <label for="exampleInputEmail1"><b>From</b></label>
                            </div>
                        </div>
                        <div class="col-sm-4" style="margin: auto">
                            <div class="form-group" style="margin: auto">
                                <input type="date" onfocusout="checkDate()" class="form-control" id="From" name="from" required @if(isset($from)) value="{{$from}}"@else Date @endif>
                            </div>

                        </div>
                        <div class="col-sm-1" style="margin: auto;">
                            <div class="form-group" style="text-align: center;margin: auto;">
                                <label for="exampleInputEmail1"><b>To</b></label>
                            </div>
                        </div><!-- modal-body -->

                        <div class="col-sm-4" style="margin: auto">
                            <div class="form-group" style="margin: auto">
                                <input type="date" class="form-control" id="to" aria-describedby="emailHelp"  name="to" required @if(isset($to)) value="{{$to}}" @else Date @endif>
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
        <div class="card shadow mb-4" id="daily" >
            <div class="card-header py-3">
                  <form action="{{url('daily-savings-reports')}}" method="get">
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
        @if(isset($expenses) && !$expenses->isEmpty())
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">Collections From {{$from}}@if(isset($to)) to {{$to}}@endif</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead style="">
                            <tr style="font-size: .85rem">
                                <th>Collection ID</th>
                                <th>Account No</th>
                                <th>Account Name</th>
                                <th>Sheet No</th>
                                <th>Insertion Date</th>
                                <th>Field Officer</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody style="font-size: .80rem">
                            <?php
                            $totalCost=0;
                            ?>

                            @foreach($expenses as $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->member_id}}</td>
                                    <td>{{$userName->ApplicantName($data->member_id)->applicant_name}}</td>
                                    <td>{!! $data->sheet_no !!}</td>
                                    <td>{{$data->created_at}}</td>
                                    <td>{{$data->name}}({{$data->field_man_id}})</td>
                                    <td>{!! $data->amount !!}</td>
                                </tr>
                                <?php $totalCost+=$data->amount;   ?>

                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="3" style="text-align: right">Total</th>
                                <th colspan="3"></th>
                                <th>{{$totalCost}}</th>
                            </tr>
                            </tfoot>
                        </table>

                        @if(isset($to) && isset($from))
                            <form style="text-align:center" action="{{url('generate-pdf-for-savings-reports')}}" method="get" target="_blank">
                                @csrf
                                <input type="hidden" name="from" @if(isset($from)) value="{{$from}}" @endif>
                                <input type="hidden" name="to" @if(isset($to)) value="{{$to}}" @endif>
                                <button type="submit" class="btn btn-info btn-lg">Print</button>
                            </form>
                            @else
                            <form style="text-align:center" action="{{url('daily-generate-pdf-for-savings-reports')}}" method="get" target="_blank">
                                @csrf
                                <input type="hidden" name="from" @if(isset($from)) value="{{$from}}" @endif>
                                <button type="submit" class="btn btn-success btn-lg">Print</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            @else
            @if(isset($from) && isset($to))
            <div class="card-header py-3">
                <h6 style="text-align: center" class="m-0 font-weight-bold text-danger">No Collection From {{$from}} to {{$to}}</h6>
            </div>
            @endif
    @endif
    <!-- DataTales Example -->
        <script>
            @if(isset($check))

            $("#daily").show() ;
            $("#fromTo").hide()
           @else
            $( window ).on( "load",  $("#daily").hide() );
            @endif
            $("#checkbox").change(function() {
                if(this.checked) {

                    $("#daily").show()
                    $("#fromTo").hide()
                }else{
                    $("#daily").hide()
                    $("#fromTo").show()
                }
            });
        </script>
    </div>
    <!-- /.container-fluid -->

@endsection

