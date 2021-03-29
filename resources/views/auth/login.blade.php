@extends('layouts.guest')

@section('pageTitle', 'Login')

@section('content')
<div class="container-fluid d-flex justify-content-center">
    <div class="backbone-panel px-5 pt-5 pb-2">
        <div class="pb-3 text-center d-flex align-items-center">
            <img src="{{asset('/image/ribbon.png')}}" alt="ribbon" height="40vh" width="50vw" style="display: block">
            <p class="font-weight-bold font-28 p-0 m-0">Child Of Light</p>
        </div>  
        {{-- <p class="font-22 font-weight-bold m-0 p-0">Sign In</p> --}}
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

            <div class="form-group font-semi font-18 pb-3">
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

            <div class="form-group">
                <button type="submit" class="btn btn-primary w-100 font-semi">
                    {{ __('Login') }}
                </button>
            </div>

            <div class="form-group d-flex justify-content-center">
                @if (Route::has('password.request'))
                {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a> --}}
                @endif
                @if (Route::has('register'))
                <a class="btn btn-link" href="{{ route('register') }}">{{ __('New User?') }}</a>
                @endif
            </div>


        </form>
        <p class="font-14 m-0 p-0" align="center">copyright 2021</p>
    </div>
</div>
@endsection