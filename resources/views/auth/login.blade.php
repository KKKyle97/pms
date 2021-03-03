@extends('layouts.guest')

@section('content')
<div class="container-fluid d-flex justify-content-center">
    <div class="backbone-panel p-5">
        <div class="pb-3 text-center">
            <p class="font-weight-bold font-32 p-0 m-0">Child Of Light Patient Management System</p>
        </div>  
        <p class="font-22 font-weight-bold m-0 p-0">Sign In</p>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group font-semi font-18">
                <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>

                <div>
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
                <label for="password" class="col-form-label">{{ __('Password') }}</label>

                <div>
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

            <div class="form-group row ml-0">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary w-100 font-semi">
                    {{ __('Login') }}
                </button>
            </div>

            <div class="form-group d-flex justify-content-center">
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
@endsection