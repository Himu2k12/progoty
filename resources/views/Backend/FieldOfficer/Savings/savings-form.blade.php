@extends('Backend.master')

@section('title')
    Savings Form

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
        <div class="card shadow mb-4 border-bottom-info">
                <div class="card-header py-3">
                    <h4 class="text-primary" style="text-align: center; ">Add Savings</h4>
                    @if( $message = Session::get('message') )
                        <h6 class="page-header text-success text-md-center" style="text-align: center">{{ $message }}</h6>
                    @endif
                    @if( $message = Session::get('Negmessage') )
                        <h6 class="page-header text-danger text-md-center" style="text-align: center">{{ $message }}</h6>
                    @endif
                </div>
                <div class="card-body row">
                    <div class="col-md-6 border-right">
                         <form method="POST" action="{{ url('/new-savings') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-5">
                            <label for="savingsInfo" >{{ __('Account No') }}<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-6" >
                                <input class="form-control" type="number" id="savingsInfo" name="member_id" required>
{{--                                <select class="form-control" id="savingsInfo" name="member_id" required>--}}
{{--                                    <option value="">==Please Choose One==</option>--}}
{{--                                    @foreach($MembersById as $item)--}}
{{--                                        <option value="{{$item->id}}">{{$item->applicant_name}}({{$item->id}})</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                            <label for="amount"  >{{ __('New Savings Amount') }}<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-6">
                                <input id="amount" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}" min="0" max="1000000" required autofocus>

                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div id="loanLevel" class="col-md-5">

                            </div>

                            <div class="col-md-6" id="loanDiv">
                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div id="loaniv">
                            </div>

                        </div>
                        <div class="form-group row">
                            <div id="loanServiceLevel" class="col-md-5">

                            </div>
                            <div class="col-md-6" id="loanServiceDiv">
                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                            <label for="sheetNo" class=" col-form-label newLevel" >{{ __('Sheet No') }}<span style="color: red">*</span></label>
                            </div>
                            <div class="col-md-6">
                                <input id="sheetNo" type="number" class="form-control{{ $errors->has('sheet_no') ? ' is-invalid' : '' }}" name="sheet_no" value="{{ old('sheet_no') }}" min="1" max="10000000" required autofocus>

                                @if ($errors->has('sheet_no'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sheet_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-5 offset-md-5">
                                <button type="submit" class="btn btn-primary col-md-12">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-6" id="applicantPhoto">

                            </div>
                            <div class="col-sm-5 col-md-5 offset-1">
                                <blockquote id="blockquotes">

                                </blockquote>
                                <p id="accountType"> </p>
                                <p id="accountDuration"> </p>
                                <p id="paymentAmount"> </p>
                                <p id="loanAmount"> </p>
                                <p id="serviceAmount"> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection


