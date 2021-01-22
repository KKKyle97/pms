<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div class="px-5 py-3 font-semi font-32">
    <p class="m-0 p-0">Update Patient Profile</p>
</div>
<form method="POST" action="{{ route('patients.update',[$patient->id]) }}" class="px-5 py-3"
    style="height:85%; overflow:auto">
    @csrf
    @method('PUT')
    <div class="col mx-0 mb-3 p-3 backbone-panel">
        <div class="col font-semi font-18">
            <p>Patient Details</p>
        </div>
        <div class="row justify-content-between">
            <div class="col-4">
                <div class="form-group">
                    <label for="first_name" class="col col-form-label">{{ __('First Name') }}</label>

                    <div class="col">
                        <input id="first_name" type="text"
                            class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                            value="{{ $patient->first_name }}" required autocomplete="first_name" placeholder="John">

                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="last_name" class="col col-form-label">{{ __('Last Name') }}</label>

                    <div class="col">
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                            name="last_name" value="{{$patient->last_name}}" required autocomplete="last_name"
                            placeholder="Doe">

                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="ic_number" class="col col-form-label">{{ __('IC') }}</label>

                    <div class="col">
                        <input id="ic_number" type="text" class="form-control @error('ic_number') is-invalid @enderror"
                            name="ic_number" value="{{ $patient->ic_number }}" required autocomplete="ic_number"
                            placeholder="990201025506" minlength="12" maxlength="12"
                            onkeypress="return isNumberKey(event)">

                        @error('ic_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="gender" class="col col-form-label">{{ __('Gender') }}</label>

                    <div class="col">
                        <select id="gender" class="form-control" name="gender" required>
                            @foreach (Common::$gender as $key => $item)
                            <option value="{{$key}}" {{$patient->gender == $key ? "selected" : ""}}>{{$item}}</option>
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

            <div class="col-4">
                <div class="form-group">
                    <label for="age" class="col col-form-label">{{ __('Age') }}</label>

                    <div class="col">
                        <select id="age" class="form-control" name="age" required>
                            @foreach (Common::$age as $key => $item)
                            <option value="{{$key}}" {{$patient->age == $key ? "selected" : ""}}>{{$item}}</option>
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
                    <label for="cancer" class="col col-form-label">{{ __('Cancer Type') }}</label>

                    <div class="col">
                        <select id="cancer" class="form-control" name="cancer" required>
                            @foreach (Common::$cancer as $key => $item)
                            <option value="{{$key}}" {{$patient->cancer == $key ? "selected" : ""}}>{{$item}}</option>
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


    {{-- guardian --}}
    <div class="col mx-0 mb-3 p-3 backbone-panel">
        <div class="col font-semi font-18">
            <p>Guardian Details</p>
        </div>
        <div class="row justify-content-between">
            <div class="col-4">
                <div class="form-group">
                    <label for="gfirst_name" class="col col-form-label">{{ __('First Name') }}</label>

                    <div class="col">
                        <input id="gfirst_name" type="text"
                            class="form-control @error('gfirst_name') is-invalid @enderror" name="gfirst_name"
                            value="{{ $guardian->first_name }}" required autocomplete="gfirst_name" placeholder="john">

                        @error('gfirst_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="glast_name" class="col col-form-label">{{ __('Last Name') }}</label>

                    <div class="col">
                        <input id="glast_name" type="text"
                            class="form-control @error('glast_name') is-invalid @enderror" name="glast_name"
                            value="{{ $guardian->last_name }}" required autocomplete="glast_name" placeholder="doe">

                        @error('glast_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="gic_number" class="col col-form-label">{{ __('IC') }}</label>

                    <div class="col">
                        <input id="gic_number" type="text"
                            class="form-control @error('gic_number') is-invalid @enderror" name="gic_number"
                            value="{{ $guardian->ic_number }}" required autocomplete="gic_number" minlength="12"
                            maxlength="12" placeholder="890221023314" onkeypress="return isNumberKey(event)">

                        @error('gic_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="relations" class="col col-form-label">{{ __('Relationship') }}</label>

                    <div class="col">
                        <select id="relations" class="form-control" name="relations" required>
                            @foreach (Common::$relation as $key => $item)
                            <option value="{{$key}}" {{$guardian->relations == $key ? "selected" : ""}}>{{$item}}
                            </option>
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

            <div class="col-4">
                <div class="form-group">
                    <label for="contact" class="col col-form-label">{{ __('Contact No') }}</label>

                    <div class="col">
                        <input id="contact" type="text" class="form-control" name="contact" required minlength="10"
                            maxlength="11" placeholder="0134402331" value="{{$guardian->contact}}"
                            onkeypress="return isNumberKey(event)">

                        @error('contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="address_one" class="col col-form-label">{{ __('Address Line One') }}</label>

                    <div class="col">
                        <input id="address_one" type="text" class="form-control" name="address_one"
                            value="{{$guardian->address_one}}" placeholder="1, Jalan Damai" required>

                        @error('address_one')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="address_two" class="col col-form-label">{{ __('Address Line Two') }}</label>

                    <div class="col">
                        <input id="address_two" type="text" class="form-control" name="address_two"
                            value="{{$guardian->address_two}}" placeholder="Bandar Sg Long" required>

                        @error('address_two')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>


            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="postcode" class="col col-form-label">{{ __('Post Code') }}</label>

                    <div class="col">
                        <input id="postcode" type="text" class="form-control" name="postcode"
                            value="{{$guardian->postcode}}" required placeholder="43000" minlength="5" maxlength="5"
                            onkeypress="return isNumberKey(event)">

                        @error('postcode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="city" class="colcol-form-label">{{ __('City') }}</label>

                    <div class="col">
                        <input id="city" type="text" class="form-control" name="city" placeholder="Kajang"
                            value="{{$guardian->city}}" required>

                        @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="state" class="col col-form-label">{{ __('State') }}</label>

                    <div class="col">
                        <select id="state" class="form-control" name="state" required>
                            @foreach (Common::$state as $key => $item)
                            <option value="{{$key}}" {{$guardian->state == $key ? "selected" : ""}}>{{$item}}</option>
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


    <div class="col row px-0 py-3 m-0">
        <button type="submit" onclick="return confirm('Are you sure to update with new details?')"
            class="btn btn-primary w-100 font-semi">
            {{ __('Update') }}
        </button>
    </div>

</form>
@endsection