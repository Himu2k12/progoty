@extends('Backend.master')

@section('title')
    Edit Savings

@endsection
@section('content')
    <style>
        .m-0{
            text-align: center;


        }
        .xt td{
            width: 50%;
            text-align: center;
        }
        .cs th{
            text-align: center;
        }
        .cs td{
            text-align: center;
        }
    </style>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-6 offset-3">
            <div class="card shadow mb-4 border-bottom-info">
                <div class="card-header py-3">
                    <h4 class="text-primary" style="text-align: center; ">Edit Savings</h4>
                    @if( $message = Session::get('message') )
                        <h4 class="page-header text-success" style="text-align: center">{{ $message }}</h4>
                    @endif
                </div>
                <div class="card-body row">
                    <div class="col-md-12">
                        <form method="POST" action="{{ url('/edit-savings') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="savingsInfo" class="col-md-4 col-form-label newLevel">{{ __('Selected ID') }}<span style="color: red">*</span></label>
                                <div class="col-md-6" >
                                    <input type="number" class="form-control" name="amount" value="{{$updateInfo->member_id}}" disabled>
                                    <input id="id" type="hidden" class="form-control" name="id" value="{{$updateInfo->id}}">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount" class="col-md-4 col-form-label newLevel" >{{ __('Amount') }}<span style="color: red">*</span></label>

                                <div class="col-md-6">
                                    <input id="amount" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{$updateInfo->amount}}" min="1" max="1000000" required autofocus>

                                    @if ($errors->has('amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sheetNo" class="col-md-4 col-form-label newLevel" >{{ __('Sheet No') }}<span style="color: red">*</span></label>

                                <div class="col-md-6">
                                    <input id="sheetNo" type="number" class="form-control{{ $errors->has('sheet_no') ? ' is-invalid' : '' }}" name="sheet_no" value="{{$updateInfo->sheet_no }}" min="1" max="10000000" required autofocus>

                                    @if ($errors->has('sheet_no'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sheet_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-6">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection


