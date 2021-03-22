<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div class="header d-flex justify-content-center align-items-center">
    <p class="font-22 font-semi m-0 p-0">Patient Profile</p>
</div>
<div class="middle patient-list">
    <div class="row m-0 justify-content-between">
        <div class="col-md-7 p-3">
            <div class="font-semi font-18">
                <p class="m-0 p-0">Patients Info</p>
            </div>
            <hr/>
            <div class="row p-0">
                <div class="col-sm-5">
                    <div class="pb-3">
                        <p class="m-0 p-0 font-semi">Name</p>
                        <p class="m-0 p-0">{{$patient->first_name}} {{$patient->last_name}}</p>
                    </div>
                    <div class="pb-3">
                        <p class="m-0 p-0 font-semi">IC</p>
                        <p class="m-0 p-0">{{$patient->ic_number}}</p>
                    </div>
                    <div class="pb-3">
                        <p class="m-0 p-0 font-semi">Gender</p>
                        <p class="m-0 p-0">{{Common::$gender[$patient->gender]}}</p>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="pb-3">
                        <p class="m-0 p-0 font-semi">Age</p>
                        <p class="m-0 p-0">{{$patient->age}}</p>
                    </div>
                    <div class="pb-3">
                        <p class="m-0 p-0 font-semi">Cancer type</p>
                        <p class="m-0 p-0">{{Common::$cancer[$patient->cancer]}}</p>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-md-5 p-3">
            <div class="font-semi font-18">
                <p class="m-0 p-0">Application Account</p>
            </div>
            <hr/>
            <div class="pb-3">
                <p class="m-0 p-0 font-semi">Username</p>
                <p class="m-0 p-0">{{$account->username}}</p>
            </div>
        </div>
    </div>
    <div class="col px-3 pb-3">
        <div class="font-semi font-18">
            <p class="m-0 p-0">Patients Guardian Info</p>
        </div>
        <hr/>
        <div class="row p-0">
            <div class="col-sm-7">
                <div class="pb-3">
                    <p class="m-0 p-0 font-semi">Name</p>
                    <p class="m-0 p-0">{{$guardian->first_name}} {{$guardian->last_name}}</p>
                </div>
                <div class="pb-3">
                    <p class="m-0 p-0 font-semi">Relationship</p>
                    <p class="m-0 p-0">{{Common::$relation[$guardian->relations]}}</p>
                </div>
                <div class="pb-3">
                    <p class="m-0 p-0 font-semi">Address</p>
                    <p class="m-0 p-0">
                        {{$guardian->address_one}}, {{$guardian->address_two}}, {{$guardian->postcode}}, {{Common::$state[$guardian->state]}} 
                        {{$guardian->city}}</p>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="pb-3">
                    <p class="m-0 p-0 font-semi">IC</p>
                    <p class="m-0 p-0">{{$guardian->ic_number}}</p>
                </div>
                <div class="pb-3">
                    <p class="m-0 p-0 font-semi">Contact number</p>
                    <p class="m-0 p-0">{{$guardian->contact}}</p>
                </div>
            </div>
        </div>
        
        
        
        
        
    </div>

    <div class="d-flex justify-content-center">
        <div class="pb-3 mr-3">
            <a class="btn btn-normal btn-custom-width" href="{{route('patients.edit',[$patient->id])}}">Update Details</a>
        </div>
    
        <div class="pb-3 mr-3">
            <a class="btn btn-normal btn-custom-width" href="{{route('patients.analyse',[$patient->id])}}">Analyse</a>
        </div>
    
        <div class="pb-3">
            <form action="{{route('patients.destroy',[$patient->id])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure?')"
                    class="btn btn-normal btn-custom-width">Remove
                    Patients</button>
            </form>
        </div>
    </div>
</div>
<div class="footer d-flex justify-content-center align-items-center">
    <p class="font-14 m-0 p-0">Copyright 2021</p>
</div>
@endsection