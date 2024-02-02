@extends('Backend.master')

@section('title')
    Withdraw Form
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

        <div class="col-lg-12">

            <div class="card shadow mb-4 border-bottom-info">
                <div class="card-header py-3">
                    <h4 class="text-primary" style="text-align: center; ">{{ __('Savings Withdraw Form')}}</h4>
                    @if( $message = Session::get('message') )
                        <h4 class="page-header text-success" style="text-align: center">{{ $message }}</h4>
                    @endif
                    @if( $message = Session::get('Negmessage') )
                        <h4 class="page-header text-danger" style="text-align: center">{{ $message }}</h4>
                    @endif
                </div>
                <div class="card-body row">

                    <div class="col-md-6 border-right">
                        <form method="POST" action="{{ url('/withdraw-savings-account') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="savingsInfo" class="col-md-4 col-form-label newLevel">{{ __('Member ID') }}<span style="color: red">*</span></label>
                                <div class="col-md-6" >
                                    <input id="withdrawSavings" type="number" class="form-control" name="account_no" value="" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="amount" class="col-md-4 col-form-label newLevel" >{{ __('Withdraw Amount') }}<span style="color: red">*</span></label>

                                <div class="col-md-6">
                                    <input id="Maxamount" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}" required autofocus>

                                    @if ($errors->has('amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount" class="col-md-4 col-form-label newLevel" >{{ __('Mobile Number') }}<span style="color: red">*</span></label>

                                <div class="col-md-6">
                                    <input id="number" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" maxlength="11" required autofocus>

                                    @if ($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount" class="col-md-4 col-form-label newLevel" >{{ __('Form Fee') }}<span style="color: red">*</span></label>

                                <div class="col-md-6">
                                    <input id="number" type="number" class="form-control{{ $errors->has('form_fee') ? ' is-invalid' : '' }}" name="form_fee" value="{{ old('form_fee') }}" min="0" required autofocus>

                                    @if ($errors->has('form_fee'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('form_fee') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="savingsInfo" class="col-md-4 col-form-label newLevel">{{ __('Collection Category') }}<span style="color: red">*</span></label>
                                <div class="col-md-6" >
                                    <select class="form-control" id="withdrawSavings" name="category" required>
                                        <option value="">==Please Choose One==</option>
                                        @foreach($categories as $item)
                                            <option value="{{$item->id}}">{{$item->category}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount" class="col-md-4 col-form-label newLevel" >{{ __('Note') }}</label>

                                <div class="col-md-6">
                                    <textarea id="number" type="text" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note" rows="5" > {{ old('note') }}</textarea>

                                    @if ($errors->has('note'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 col-sm-12 offset-md-6">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-4 col-md-4 " id="applicantPhoto">

                            </div>
                            <div class="col-sm-7 offset-1">
                                <blockquote id="blockquotes">

                                </blockquote>
                                <p id="LoanStatus"> </p>
                                <p id="loanMoney"> </p>
                                <p id="loanpaidMoney"> </p>
                                <p id="loanpaidService"> </p>
                                <p id="savingsMoney"> </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection


