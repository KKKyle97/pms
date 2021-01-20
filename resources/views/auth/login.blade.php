@extends('layouts.guest')

@section('content')
<div class="container-fluid h-100 d-flex align-items-center justify-content-center">
    <div class="h-75 w-50 login-panel p-5">
        <div class="pb-3 col text-center">
            <p class="font-weight-bold font-32 p-0 m-0">Child Of Light Patient Management System</p>
        </div>
        <div class="row">
            <div class="col-md-6 d-flex justify-content-start">
                <img src="{{asset('image/ribbon.png')}}" alt="ribbon" height="100%" width="100%">
            </div>
            <div class="col-md-6 d-flex justify-content-start">
                <div class="col py-5">
                    <div class="col">
                        <p class="h2 font-weight-bold">Sign In</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group font-semi font-18">
                            <label for="email" class="col col-form-label">{{ __('E-Mail Address') }}</label>

                            <div class="col">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group font-semi font-18">
                            <label for="password" class="col col-form-label">{{ __('Password') }}</label>

                            <div class="col">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row col ml-0">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="col form-group">
                            <button type="submit" class="btn btn-primary w-100 font-semi">
                                {{ __('Login') }}
                            </button>
                        </div>

                        <div class="col form-group d-flex justify-content-center">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                            @if (Route::has('register'))
                            <a class="btn btn-link" href="{{ route('register') }}">{{ __('New User?') }}</a>
                            @endif
                        </div>


                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection