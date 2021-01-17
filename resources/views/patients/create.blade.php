<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Patient') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('patients.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="first_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name') }}" required autocomplete="first_name"
                                    placeholder="John">

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text"
                                    class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name') }}" required autocomplete="last_name" placeholder="Doe">

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ic_number" class="col-md-4 col-form-label text-md-right">{{ __('IC') }}</label>

                            <div class="col-md-6">
                                <input id="ic_number" type="text"
                                    class="form-control @error('ic_number') is-invalid @enderror" name="ic_number"
                                    value="{{ old('ic_number') }}" required autocomplete="ic_number"
                                    placeholder="990201025506" minlength="12" maxlength="12"
                                    onkeypress="return isNumberKey(event)">

                                @error('ic_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" class="form-control" name="gender" required>
                                    @foreach (Common::$gender as $key => $item)
                                    <option value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>

                            <div class="col-md-6">
                                <select id="age" class="form-control" name="age" required>
                                    @foreach (Common::$age as $key => $item)
                                    <option value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>

                                @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cancer"
                                class="col-md-4 col-form-label text-md-right">{{ __('Cancer Type') }}</label>

                            <div class="col-md-6">
                                <select id="cancer" class="form-control" name="cancer" required>
                                    @foreach (Common::$cancer as $key => $item)
                                    <option value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>

                                @error('cancer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- guardian --}}

                        <div class="form-group row">
                            <label for="gfirst_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="gfirst_name" type="text"
                                    class="form-control @error('gfirst_name') is-invalid @enderror" name="gfirst_name"
                                    value="{{ old('gfirst_name') }}" required autocomplete="gfirst_name"
                                    placeholder="john">

                                @error('gfirst_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="glast_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="glast_name" type="text"
                                    class="form-control @error('glast_name') is-invalid @enderror" name="glast_name"
                                    value="{{ old('glast_name') }}" required autocomplete="glast_name"
                                    placeholder="doe">

                                @error('glast_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gic_number" class="col-md-4 col-form-label text-md-right">{{ __('IC') }}</label>

                            <div class="col-md-6">
                                <input id="gic_number" type="text"
                                    class="form-control @error('gic_number') is-invalid @enderror" name="gic_number"
                                    value="{{ old('gic_number') }}" required autocomplete="gic_number" minlength="12"
                                    maxlength="12" placeholder="890221023314" onkeypress="return isNumberKey(event)">

                                @error('gic_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="relations"
                                class="col-md-4 col-form-label text-md-right">{{ __('Relationship') }}</label>

                            <div class="col-md-6">
                                <select id="relations" class="form-control" name="relations" required>
                                    @foreach (Common::$relation as $key => $item)
                                    <option value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>

                                @error('relations')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact"
                                class="col-md-4 col-form-label text-md-right">{{ __('Contact No') }}</label>

                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control" name="contact" required
                                    minlength="10" maxlength="11" placeholder="0134402331"
                                    onkeypress="return isNumberKey(event)">

                                @error('contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address_one"
                                class="col-md-4 col-form-label text-md-right">{{ __('Address Line One') }}</label>

                            <div class="col-md-6">
                                <input id="address_one" type="text" class="form-control" name="address_one"
                                    placeholder="1, Jalan Damai" required>

                                @error('address_one')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address_two"
                                class="col-md-4 col-form-label text-md-right">{{ __('Address Line Two') }}</label>

                            <div class="col-md-6">
                                <input id="address_two" type="text" class="form-control" name="address_two"
                                    placeholder="Bandar Sg Long" required>

                                @error('address_two')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postcode"
                                class="col-md-4 col-form-label text-md-right">{{ __('PostCode') }}</label>

                            <div class="col-md-6">
                                <input id="postcode" type="text" class="form-control" name="postcode" required
                                    placeholder="43000" minlength="5" maxlength="5"
                                    onkeypress="return isNumberKey(event)">

                                @error('postcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" placeholder="Kajang"
                                    required>

                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                            <div class="col-md-6">
                                <select id="state" class="form-control" name="state" required>
                                    @foreach (Common::$state as $key => $item)
                                    <option value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>

                                @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- patient account --}}
                        <div class="form-group row">
                            <label for="username"
                                class="col-md-4 col-form-label text-md-right">{{ __('User Account') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" placeholder="johndoe97" required>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    placeholder="Account Password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" placeholder="Confirm Account Password" required
                                    autocomplete="new-password">
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" onclick="return confirm('Are you sure to create a new patient?')"
                                    class="btn btn-primary">
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