@extends('back.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-offset-3">
                <div class="card" style="border: 1px dotted darkblue">
                    <div class="card-header" style="text-align: center"><h2>{{ __('Staff Registration') }}</h2></div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/new-staffs') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label newLevel" >{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="color: red" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label newLevel">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="color: red" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label newLevel">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="color: red" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label newLevel">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-md-4 col-form-label newLevel">{{ __('Select Role') }}</label>

                                <div class="col-md-6" >
                                    <select class="form-control" name="role">
                                        @foreach(\App\Role::where('access','=',1)->get() as $roles)
                                            <option value="{{$roles->id}}">{{$roles->role}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection