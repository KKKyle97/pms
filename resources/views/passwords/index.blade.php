@extends('layouts.app')
@section('content')
<div class="header d-flex justify-content-center align-items-center">
    <p class="font-22 font-semi m-0 p-0">Change Password</p>
</div>
<div class="middle patient-list py-3">
    <div class="row justify-content-center">
        <div class="card-body">
            <form method="POST" action="{{ route('passwords.update') }}" id="update-password-form">
                @csrf
                @method('PUT')

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <div class="form-group">
                    <label for="current_password"
                        class="col col-form-label">{{ __('Current Password') }}</label>

                    <div class="col">
                        <input id="current_password" type="password"
                            class="form-control @error('current_password') is-invalid @enderror"
                            name="current_password" required placeholder="current password" oninput="validateRequiredField('p1','current_password',4,0);">

                        @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <p class="font-red m-0 font-10" id="p1">*This field is required.</p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="new_password"
                        class="col col-form-label">{{ __('New Password') }}</label>

                    <div class="col">
                        <input id="password" type="password"
                            class="form-control @error('new_password') is-invalid @enderror" name="new_password"
                            required placeholder="new password" oninput="validateRequiredField('a2','password',4,1); validateDigitNum('a2e2','password','password',4,1);">

                        @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <p class="font-red m-0 font-10" id="a2">*This field is required.</p>
                        <p class="m-0 font-10" id="a2e2">*Minimum 8 characters.</p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm"
                        class="col col-form-label">{{ __('Confirm Password') }}</label>

                    <div class="col">
                        <input id="password-confirm" type="password"
                            class="form-control @error('new_confirm_password') is-invalid @enderror"
                            name="new_confirm_password" required placeholder="confirm your password" oninput="validateMatchingPassword(4,2)">

                        @error('new_confirm_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <p class="font-red m-0 font-10" id="a3">*Password Does Not Match.</p>
                    </div>
                </div>

                <div class="form-group mb-0 pt-3" align="center">
                    <div class="">
                        <a class="btn btn-normal btn-custom-width" onclick="validateBeforeSubmit(4)">
                            Update Password
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="footer d-flex justify-content-center align-items-center">
    <p class="font-14 m-0 p-0">Copyright 2021</p>
</div>
@endsection