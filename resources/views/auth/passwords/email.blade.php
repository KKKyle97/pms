@extends('layouts.guest')

@section('content')
<div class="container-fluid h-100 d-flex align-items-center justify-content-center ">
    <div class="login-panel col-md-4 p-5">
        <div class="pb-3 col text-center">
            <p class="font-weight-bold font-32 p-0 m-0">Reset Password</p>
        </div>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="col col-form-label font-semi font-18">{{ __('E-Mail Address') }}</label>

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

            <div class="form-group mb-0">
                <div class="col pb-3">
                    <a href="#" class="w-100 btn btn-primary  font-semi">
                        {{ __('Send Password Reset Link') }}
                    </a>
                </div>
                <div class="col">
                    <a href="{{route('login')}}" class="w-100 btn btn-primary  font-semi">
                        {{ __('Back to Login') }}
                    </a>
                </div>
            </div>
        </form>

    </div>

</div>
@endsection