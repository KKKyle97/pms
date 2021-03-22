<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div class="header d-flex justify-content-center align-items-center">
    <p class="font-22 font-semi m-0 p-0">Add New Patient</p>
</div>
<div class="middle patient-list py-3 d-flex justify-content-center" style="overflow:auto"> 
    <form method="POST" action="{{ route('patients.store') }}" id="create-patient-form">
        @csrf
        <div class="mx-0 mb-3 p-3">
            <div class="col font-semi font-18">
                <p class="m-0">Patient Details <span class="font-14 font-grey">(Section 1 of 3)</span></p>
                <hr/>
            </div>
            <div class="row justify-content-between">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="first_name" class="col col-form-label">{{ __('First Name') }}<span class="font-red">*</span></label>
    
                        <div class="col">
                            <input id="first_name" type="text"
                                class="form-control validate @error('first_name') is-invalid @enderror" name="first_name" required placeholder="John" oninput="validateRequiredField('p1','first_name',0,0)">
    
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <p class="font-red m-0 font-10" id="p1">*This field is required.</p>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="last_name" class="col col-form-label">{{ __('Last Name') }}<span class="font-red">*</span></label>
    
                        <div class="col">
                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                                name="last_name" required
                                placeholder="Doe" oninput="validateRequiredField('p2','last_name',0,1)">
    
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <p class="font-red m-0 font-10" id="p2">*This field is required.</p>
                        </div>
                    </div>
                </div>
    
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="ic_number" class="col col-form-label">{{ __('IC Number') }}<span class="font-red">*</span></label>
    
                        <div class="col">
                            <input id="ic_number" type="text" class="form-control @error('ic_number') is-invalid @enderror"
                                name="ic_number" required
                                placeholder="990201025506" minlength="12" maxlength="12"
                                onkeypress="return isNumberKey(event)" oninput="validateRequiredField('p3','ic_number',0,2); validateDigitNum('p3e2','ic_number','ic',0,2);">
    
                            @error('ic_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <p class="font-red m-0 font-10" id="p3">*This field is required.</p>
                            <p class="font-red m-0 font-10" id="p3e2">*Minimum digit is 12.</p>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="gender" class="col col-form-label">{{ __('Gender') }}<span class="font-red">*</span></label>
    
                        <div class="col">
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
                </div>
    
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="age" class="col col-form-label">{{ __('Age') }}<span class="font-red">*</span></label>
    
                        <div class="col">
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
    
                    <div class="form-group">
                        <label for="cancer" class="col col-form-label">{{ __('Cancer Type') }}<span class="font-red">*</span></label>
    
                        <div class="col">
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
                </div>
            </div>
        </div>

        <div class="mx-0 mb-3 p-3">
            <div class="col font-semi font-18">
                <p>Guardian Details <span class="font-14 font-grey">(Section 2 of 3)</span></p>
                <hr/>
            </div>
            <div class="row justify-content-between">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="gfirst_name" class="col col-form-label">{{ __('First Name') }}<span class="font-red">*</span></label>
    
                        <div class="col">
                            <input id="gfirst_name" type="text"
                                class="form-control @error('gfirst_name') is-invalid @enderror" name="gfirst_name"
                                required placeholder="john" oninput="validateRequiredField('g1','gfirst_name',0,3)">
    
                            @error('gfirst_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <p class="font-red m-0 font-10" id="g1">*This field is required.</p>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="glast_name" class="col col-form-label">{{ __('Last Name') }}<span class="font-red">*</span></label>
    
                        <div class="col">
                            <input id="glast_name" type="text"
                                class="form-control @error('glast_name') is-invalid @enderror" name="glast_name"
                                required placeholder="doe" oninput="validateRequiredField('g2','glast_name',0,4)">
    
                            @error('glast_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <p class="font-red m-0 font-10" id="g2">*This field is required.</p>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="gic_number" class="col col-form-label">{{ __('IC Number') }}<span class="font-red">*</span></label>
    
                        <div class="col">
                            <input id="gic_number" type="text"
                                class="form-control @error('gic_number') is-invalid @enderror" name="gic_number"
                                required minlength="12"
                                maxlength="12" placeholder="890221023314" onkeypress="return isNumberKey(event)" oninput="validateRequiredField('g3','gic_number',0,5); validateDigitNum('g3e2','gic_number','ic',0,5);">
    
                            @error('gic_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <p class="font-red m-0 font-10" id="g3">*This field is required.</p>
                            <p class="font-red m-0 font-10" id="g3e2">*Minimum digit is 12.</p>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="relations" class="col col-form-label">{{ __('Relationship') }}<span class="font-red">*</span></label>
    
                        <div class="col">
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
                </div>
    
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="contact" class="col col-form-label">{{ __('Contact No') }}<span class="font-red">*</span></label>
    
                        <div class="col">
                            <input id="contact" type="text" class="form-control" name="contact" required minlength="10"
                                maxlength="11" placeholder="0134402331" onkeypress="return isNumberKey(event)" oninput="validateRequiredField('g4','contact',0,6); validateDigitNum('g4e2','contact','contact',0,6); ">
    
                            @error('contact')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <p class="font-red m-0 font-10" id="g4">*This field is required.</p>
                            <p class="font-red m-0 font-10" id="g4e2">*Minimum digit is 10.</p>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="address_one" class="col col-form-label">{{ __('Address Line One') }}<span class="font-red">*</span></label>
    
                        <div class="col">
                            <input id="address_one" type="text" class="form-control" name="address_one"
                                placeholder="1, Jalan Damai" required oninput="validateRequiredField('g5','address_one',0,7)">
    
                            @error('address_one')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <p class="font-red m-0 font-10" id="g5">*This field is required.</p>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="address_two" class="col col-form-label">{{ __('Address Line Two') }}<span class="font-red">*</span></label>
    
                        <div class="col">
                            <input id="address_two" type="text" class="form-control" name="address_two"
                                placeholder="Bandar Sg Long" required oninput="validateRequiredField('g6','address_two',0,8)">
    
                            @error('address_two')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <p class="font-red m-0 font-10" id="g6">*This field is required.</p>
                        </div>
                    </div>
                </div>
    
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="postcode" class="col col-form-label">{{ __('Post Code') }}<span class="font-red">*</span></label>

                        <div class="col">
                            <input id="postcode" type="text" class="form-control" name="postcode" required
                                placeholder="43000" minlength="5" maxlength="5" onkeypress="return isNumberKey(event)" oninput="validateRequiredField('g7','postcode',0,9); validateDigitNum('g7e2','postcode','postcode',0,9);">
    
                            @error('postcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <p class="font-red m-0 font-10" id="g7">*This field is required.</p>
                            <p class="font-red m-0 font-10" id="g7e2">*Minimum digit is 5.</p>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="city" class="col col-form-label">{{ __('City') }}<span class="font-red">*</span></label>
    
                        <div class="col">
                            <input id="city" type="text" class="form-control" name="city" placeholder="Kajang" required oninput="validateRequiredField('g8','city',0,10)">
    
                            @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <p class="font-red m-0 font-10" id="g8">*This field is required.</p> 
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="state" class="col col-form-label">{{ __('State') }}<span class="font-red">*</span></label>
    
                        <div class="col">
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
                </div>
            </div>
        </div>

        <div class=" mx-0 p-3">
            <div class="col font-semi font-18">
                <p>Mobile Account <span class="font-14 font-grey">(Section 3 of 3)</span></p>
                <hr/>
            </div>
            <div class="row justify-content-between">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="username" class="col col-form-label">{{ __('User Account') }}<span class="font-red">*</span></label>
    
                        <div class="col">
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" placeholder="johndoe97" required oninput="validateRequiredField('a1','username',0,11)">
    
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <p class="font-red m-0 font-10" id="a1">*This field is required.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="password" class="col col-form-label">{{ __('Password') }}<span class="font-red">*</span></label>
    
                        <div class="col">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" minlength="8"
                                placeholder="Account Password" required oninput="validateRequiredField('a2','password',0,12); validateDigitNum('a2e2','password','password',0,12);">
    
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <p class="font-red m-0 font-10" id="a2">*This field is required.</p> 
                            <p class="m-0 font-10" id="a2e2">*Minimum 8 characters.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="password-confirm" class="col col-form-label">{{ __('Confirm Password') }}<span class="font-red">*</span></label>
    
                        <div class="col">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                placeholder="Confirm Account Password" required oninput="validateMatchingPassword(0,13)">
                            <p class="font-red m-0 font-10" id="a3">*Password Does Not Match.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-0 p-3" align="center">
            <a
                    class="btn btn-normal btn-custom-width font-semi" onclick="validateBeforeSubmit(0)">
                    {{ __('Register') }}
            </a>
        </div>

        
    </form>
</div>
<div class="footer d-flex justify-content-center align-items-center">
    <p class="font-14 m-0 p-0">Copyright 2021</p>
</div>

@endsection