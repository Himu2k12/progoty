@extends('back.master')
@section('title')
    Progoty|Savings Form
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center " style="padding-top: 39px">
            <div class="col-md-5 col-sm-offset-2">
                <div class="card" style="border: 1px dotted darkblue">
                    <div class="card-header" style="text-align: center"><h2>{{ __('Savings Form') }}</h2></div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/edit-savings') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="savingsInfo" class="col-md-4 col-form-label newLevel">{{ __('Selected ID') }}</label>
                                <div class="col-md-6" >
                                    <input type="number" class="form-control" name="amount" value="{{$updateInfo->member_id}}" disabled>
                                    <input id="id" type="hidden" class="form-control" name="id" value="{{$updateInfo->id}}">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount" class="col-md-4 col-form-label newLevel" >{{ __('Amount') }}</label>

                                <div class="col-md-6">
                                    <input id="amount" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{$updateInfo->amount}}" min="5" max="1000000" required autofocus>

                                    @if ($errors->has('amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sheetNo" class="col-md-4 col-form-label newLevel" >{{ __('Sheet No') }}</label>

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
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-md-offset-2" id="applicantPhoto">

                    </div>
                    <div class="col-sm-6 ">
                        <blockquote id="blockquotes">

                        </blockquote>
                        <p id="accountType"> </p>
                        <p id="paymentAmount"> </p>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection