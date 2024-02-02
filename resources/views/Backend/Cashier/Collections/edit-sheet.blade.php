@extends('Backend.master')

@section('title')
   Edit Received Collection
@endsection

@section('style')
    <link href="{{asset('/Assets/')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 style="text-align: center" class="m-0 font-weight-bold text-primary">Update Sheet Info</h4>
                @if( $message= Session::get('message'))
                    <h6 style="text-align: center" class="text-success">{{ $message }}</h6>
                @endif
            </div>
            <div class="offset-md-2 col-md-8 card mb-4 py-3 border-left-success">
                <div class="card-body">
                    <form method="POST" action="{{ route('update-sheet-info') }}" name="room_add">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Sheet No') }}<span style="color:red;">*</span></label>
                            <div class="col-md-6">
                                <input readonly type="number" class="form-control" name="sheet_no" value="{{$sheet->sheet_no}}" required  autofocus>
                                <input  type="hidden" class="form-control" name="id" value="{{$sheet->id}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cost_amount" class="col-md-4 col-form-label text-md-right">{{ __('Field Officer') }}<span style="color:red;">*</span></label>
                            <div class="col-md-6">
                                <input readonly type="text" class="form-control" name="" value="{{$username->userName($sheet->field_officer_id)->name}}({{$sheet->field_officer_id }})" required  autofocus>
                                <input  type="hidden" class="form-control" name="field_officer_id" value="{{ $sheet->field_officer_id }}" required  autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}<span style="color:red;">*</span></label>
                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control" name="date" value="{{ $sheet->collection_date }}"  required  autofocus>
                                <span  style="color: red;">{{ $errors->has('date') ? $errors->first('date') : ' ' }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cost_amount" class="col-md-4 col-form-label text-md-right">{{ __('Savings Amount') }}<span style="color:red;">*</span></label>
                            <div class="col-md-6">
                                <input readonly id="savings" max="10000000" min="1" type="number" class="form-control" name="savings" value="{{ $sheet->savings_amount }}" required  autofocus>
                                <span  style="color: red;">{{ $errors->has('savings') ? $errors->first('savings') : ' ' }}</span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Loan Amount') }}<span style="color:red;">*</span></label>
                            <div class="col-md-6">
                                <input readonly id="loan_return" max="10000000" min="1" type="number" class="form-control" name="loan_return" value="{{ $sheet->loan_amount}}" required  autofocus>
                                <span  style="color: red;">{{ $errors->has('loan_return') ? $errors->first('loan_return') : ' ' }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Service Charge') }}<span style="color:red;">*</span></label>
                            <div class="col-md-6">
                                <input readonly id="service_charge" max="10000000" min="1" type="number" class="form-control" name="service_charge" value="{{$sheet->loan_service }}" required  autofocus>
                                <span  style="color: red;">{{ $errors->has('service_charge') ? $errors->first('service_charge') : ' ' }}</span>
                            </div>
                            <span  style="color: red;">{{ $errors->has('service_charge') ? $errors->first('service_charge') : ' ' }}</span>

                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Additional Collection') }}<span style="color:green;">*</span></label>
                            <div class="col-md-6">
                                <input id="additional_collection"  onblur="addBonus()" max="10000000" min="0" type="number" class="form-control" name="additional_collection" value="{{$sheet->additional_collection}}"  autofocus>
                                <span  style="color: red;">{{ $errors->has('additional_collection') ? $errors->first('additional_collection') : ' ' }}</span>

                            </div>
                            <span  style="color: red;">{{ $errors->has('description') ? $errors->first('description') : ' ' }}</span>

                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right text-success"><b>{{ __('Total') }}</b><span style="color:red;">*</span></label>
                            <div class="col-md-6">
                                <input readonly id="total"  max="10000000" min="1" type="number" class="form-control" name="total" value="{{ $sheet->total}}"   autofocus>
                                <span  style="color: red;">{{ $errors->has('total') ? $errors->first('total') : ' ' }}</span>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-5">
                                <button type="submit"  class="col-md-7 btn btn-success">
                                    <i class="fas fa-plus"></i>
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- DataTales Example -->

    </div>
    <!-- /.container-fluid -->
    <script>
        function addBonus() {
            var savings = document.getElementById("savings").value;
            var loan = document.getElementById("loan_return").value;
            var service = document.getElementById("service_charge").value;
            var Ad = document.getElementById("additional_collection").value;
            var sum=Math.round(savings)+Math.round(loan)+Math.round(service)+Math.round(Ad);
            document.getElementById("total").value = sum;
        }
    </script>
@endsection
