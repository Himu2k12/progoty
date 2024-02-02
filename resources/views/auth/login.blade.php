@extends('layouts.app')

@section('content')

    <div class="limiter">
        <div class="container-login100" style="background-image: url('{{asset('/sty/')}}/images/login_page.JPG');">
            <div class="wrap-login100">
                <form class="login100-form validate-form"  method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <span class="login100-form-logo">
						<img src="{{asset('/asset/images/logo_menu.jpg')}}" width="60%">
					</span>

                    <span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="wrap-input100 validate-input" data-validate = "Enter username">
                            <input id="email" class="input100" type="email" name="email" placeholder="Email Address">
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div>
                        @if ($errors->has('email'))

                            <span class="help-block">
                                <h5 style="color: black"><strong>{{ $errors->first('email') }}</strong></h5>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                            <input id="password" class="input100" type="password" name="password" placeholder="Password">
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>

                        </div>

                        @if ($errors->has('password'))
                            <span class="help-block">
                            <h5 style="color: black"><strong>{{ $errors->first('password') }}</strong></h5>
                                    </span>
                        @endif
                    </div>

                    <div class="contact100-form-checkbox" >

                        <a href="{{url('/register')}}"><span style="color: white">Not Registered?</span></a>

                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>

                    <div style="text-align: center; padding-top: 20px">
                        <a class="txt1" href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>



@endsection
