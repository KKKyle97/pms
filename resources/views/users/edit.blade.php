<?php 
    use App\Common;
?>

@extends('layouts.app')
@section('pageTitle', 'Update User Profile')
@section('content')
<div class="header d-flex justify-content-center align-items-center">
    <p class="font-22 font-semi m-0 p-0">Update User Profile</p>
</div>
<div class="middle patient-list py-3">
    <form method="POST" action="{{ route('users.update',[$userProfile->id]) }}" id="update-user-profile-form">
        @csrf
        @method('PUT')
        <div class="mx-0 mb-3 p-3">
            <div class="col font-semi font-18">
                <p class="m-0">Profile Details <span class="font-14 font-grey">(Section 1 of 1)</span></p>
                <hr/>
            </div>
            {{-- user profile --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name" class="col col-form-label">{{ __('First Name') }}</label>
            
                        <div class="col">
                            <input id="first_name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="first_name" value="{{ $userProfile->first_name }}" placeholder="John" required oninput="validateRequiredField('p1','first_name',3,0);">
                            
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <p class="font-red m-0 font-10" id="p1">*This field is required.</p>
                        </div>
                    </div>
            
                    <div class="form-group">
                        <label for="last_name" class="col col-form-label">{{ __('Last Name') }}</label>
            
                        <div class="col">
                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                                name="last_name" value="{{ $userProfile->last_name }}" required
                                placeholder="Doe" oninput="validateRequiredField('p2','last_name',3,1);">
            
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <p class="font-red m-0 font-10" id="p2">*This field is required.</p>
                        </div>
                    </div>
            
                    <div class="form-group">
                        <label for="ic_number" class="col col-form-label">{{ __('IC') }}</label>
            
                        <div class="col">
                            <input id="ic_number" type="text" class="form-control @error('ic_number') is-invalid @enderror"
                                name="ic_number" minlength="12" maxlength="12" value="{{ $userProfile->ic_number }}" required
                                placeholder="990201025506" onkeypress="return isNumberKey(event)" oninput="validateRequiredField('p3','ic_number',3,2); validateDigitNum('p3e2','ic_number','ic',3,2);"
                                >
            
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
                        <label for="gender" class="col col-form-label ">{{ __('Gender') }}</label>
            
                        <div class="col">
                            <select id="gender" class="form-control" name="gender" required>
                                @foreach (Common::$gender as $key => $item)
                                <option value="{{$key}}" {{$userProfile->gender == $key ? "selected" : ""}}>
                                    {{$item}}</option>
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contact" class="col col-form-label">{{ __('Contact No') }}</label>
            
                        <div class="col">
                            <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror"
                                name="contact" minlength="10" maxlength="11" value="{{ $userProfile->contact }}" required
                                onkeypress="return isNumberKey(event)" oninput="validateRequiredField('g4','contact',3,3); validateDigitNum('g4e2','contact','contact',3,3);" placeholder="0123456789">
            
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
                        <label for="hospital" class="col col-form-label">{{ __('Hospital') }}</label>
            
                        <div class="col dropdown">
                            <select id="hospital" style="width:100%" class="form-control js-example-basic-single" name="hospital_code" required>
                                <optgroup label="Johor">
                                    @foreach (Common::$hospitals as $key => $item)
                                    @if (strpos($key,'J') !== false)
                                    <option value="{{$key}}" {{$userProfile->hospital_code == $key ? "selected" : ""}}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
            
                                <optgroup label="Kedah">
                                    @foreach (Common::$hospitals as $key => $item)
                                    @if (strpos($key,'K') !== false)
                                    <option value="{{$key}}" {{$userProfile->hospital_code == $key ? "selected" : ""}}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
            
                                <optgroup label="Kelantan">
                                    @foreach (Common::$hospitals as $key => $item)
                                    @if (strpos($key,'D') !== false)
                                    <option value="{{$key}}" {{$userProfile->hospital_code == $key ? "selected" : ""}}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
            
                                <optgroup label="Kuala Lumpur">
                                    @foreach (Common::$hospitals as $key => $item)
                                    @if (strpos($key,'W') !== false)
                                    <option value="{{$key}}" {{$userProfile->hospital_code == $key ? "selected" : ""}}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
            
                                <optgroup label="Labuan">
                                    @foreach (Common::$hospitals as $key => $item)
                                    @if (strpos($key,'L') !== false)
                                    <option value="{{$key}}" {{$userProfile->hospital_code == $key ? "selected" : ""}}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
            
                                <optgroup label="Melaka">
                                    @foreach (Common::$hospitals as $key => $item)
                                    @if (strpos($key,'M') !== false)
                                    <option value="{{$key}}" {{$userProfile->hospital_code == $key ? "selected" : ""}}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
            
                                <optgroup label="Negeri Sembilan">
                                    @foreach (Common::$hospitals as $key => $item)
                                    @if (strpos($key,'N') !== false)
                                    <option value="{{$key}}" {{$userProfile->hospital_code == $key ? "selected" : ""}}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
            
                                <optgroup label="Pahang">
                                    @foreach (Common::$hospitals as $key => $item)
                                    @if (strpos($key,'C') !== false)
                                    <option value="{{$key}}" {{$userProfile->hospital_code == $key ? "selected" : ""}}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
            
                                <optgroup label="Penang">
                                    @foreach (Common::$hospitals as $key => $item)
                                    @if (strpos($key,'P') !== false)
                                    <option value="{{$key}}" {{$userProfile->hospital_code == $key ? "selected" : ""}}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
            
                                <optgroup label="Perak">
                                    @foreach (Common::$hospitals as $key => $item)
                                    @if (strpos($key,'A') !== false)
                                    <option value="{{$key}}" {{$userProfile->hospital_code == $key ? "selected" : ""}}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
            
                                <optgroup label="Perlis">
                                    @foreach (Common::$hospitals as $key => $item)
                                    @if (strpos($key,'R') !== false)
                                    <option value="{{$key}}" {{$userProfile->hospital_code == $key ? "selected" : ""}}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
            
                                <optgroup label="Putrajaya">
                                    @foreach (Common::$hospitals as $key => $item)
                                    @if (strpos($key,'F') !== false)
                                    <option value="{{$key}}" {{$userProfile->hospital_code == $key ? "selected" : ""}}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
            
                                <optgroup label="Sabah">
                                    @foreach (Common::$hospitals as $key => $item)
                                    @if (strpos($key,'H') !== false)
                                    <option value="{{$key}}" {{$userProfile->hospital_code == $key ? "selected" : ""}}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
            
                                <optgroup label="Sarawak">
                                    @foreach (Common::$hospitals as $key => $item)
                                    @if (strpos($key,'V') !== false)
                                    <option value="{{$key}}" {{$userProfile->hospital_code == $key ? "selected" : ""}}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
            
                                <optgroup label="Selangor">
                                    @foreach (Common::$hospitals as $key => $item)
                                    @if (strpos($key,'S') !== false)
                                    <option value="{{$key}}" {{$userProfile->hospital_code == $key ? "selected" : ""}}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
            
                                <optgroup label="Terengganu">
                                    @foreach (Common::$hospitals as $key => $item)
                                    @if (strpos($key,'T') !== false)
                                    <option value="{{$key}}" {{$userProfile->hospital_code == $key ? "selected" : ""}}>{{$item}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
                            </select>
            
                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
            
                    <div class="form-group">
                        <label for="role" class="col col-form-label ">{{ __('Role') }}</label>
            
                        <div class="col">
                            <select id="role" class="form-control" name="role" required>
                                @foreach (Common::$role as $key => $item)
                                <option value="{{$key}}" {{$userProfile->role == $key ? "selected" : ""}}>{{$item}}
                                </option>
                                @endforeach
                            </select>
            
                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="form-group pt-3" align="center">
                <a  class="btn btn-normal btn-custom-width" onclick="validateBeforeSubmit(3)">
                    {{ __('Update') }}
                </a>
            </div>
        </div>
    </form>
</div>
<div class="footer d-flex justify-content-center align-items-center">
    <p class="font-14 m-0 p-0">Copyright 2021</p>
</div>


<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});

</script>
@endsection