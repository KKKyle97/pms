<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div class="px-5 py-3">
    <div class="font-semi font-32 pb-3">
        <p class="m-0 p-0">Patient Details</p>
    </div>
    <div class="row m-0 mb-3 pb-3 justify-content-between">
        <div class="col-3 backbone-panel px-5 py-3">
            <div class="font-semi font-22 pb-3">
                <u class="m-0 p-0">Patients Info</u>
            </div>
            <div class="pb-3">
                <p class="m-0 p-0 font-semi font-18">Name</p>
                <p class="m-0 p-0">{{$patient->first_name}} {{$patient->last_name}}</p>
            </div>
            <div class="pb-3">
                <p class="m-0 p-0 font-semi font-18">IC</p>
                <p class="m-0 p-0">{{$patient->ic_number}}</p>
            </div>
            <div class="pb-3">
                <p class="m-0 p-0 font-semi font-18">Gender</p>
                <p class="m-0 p-0">{{Common::$gender[$patient->gender]}}</p>
            </div>
            <div class="pb-3">
                <p class="m-0 p-0 font-semi font-18">Age</p>
                <p class="m-0 p-0">{{$patient->age}}</p>
            </div>
            <div class="pb-3">
                <p class="m-0 p-0 font-semi font-18">Cancer type</p>
                <p class="m-0 p-0">{{Common::$cancer[$patient->cancer]}}</p>
            </div>
        </div>
        <div class="col-5 backbone-panel px-5 py-3">
            <div class="font-semi font-22 pb-3">
                <u class="m-0 p-0">Patients Guardian Info</u>
            </div>
            <div class="pb-3">
                <p class="m-0 p-0 font-semi font-18">Name</p>
                <p class="m-0 p-0">{{$guardian->first_name}} {{$guardian->last_name}}</p>
            </div>
            <div class="pb-3">
                <p class="m-0 p-0 font-semi font-18">IC</p>
                <p class="m-0 p-0">{{$guardian->ic_number}}</p>
            </div>
            <div class="pb-3">
                <p class="m-0 p-0 font-semi font-18">Relationship</p>
                <p class="m-0 p-0">{{Common::$relation[$guardian->relations]}}</p>
            </div>
            <div class="pb-3">
                <p class="m-0 p-0 font-semi font-18">Contact number</p>
                <p class="m-0 p-0">{{$guardian->contact}}</p>
            </div>
            <div class="pb-3">
                <p class="m-0 p-0 font-semi font-18">Address</p>
                <p class="m-0 p-0">
                    {{$guardian->address_one}},{{$guardian->address_two}},{{$guardian->postcode}},{{$guardian->state}}
                    {{$guardian->city}}</p>
            </div>
        </div>

        <div class="col-3 backbone-panel px-5 py-3">
            <div class="font-semi font-22 pb-3">
                <u class="m-0 p-0">Application Account</u>
            </div>
            <div class="pb-3">
                <p class="m-0 p-0 font-semi font-18">Username</p>
                <p class="m-0 p-0">{{$account->username}}</p>
            </div>
        </div>
    </div>

    <div class="pb-3">
        <a class="btn btn-primary w-100 font-semi" href="{{route('patients.edit',[$patient->id])}}">Update Details</a>
    </div>

    <div class="pb-3">
        <a class="btn btn-success w-100 font-semi" href="{{route('patients.analyse',[$patient->id])}}">Analyse</a>
    </div>

    <div class="pb-3">
        <form action="{{route('patients.destroy',[$patient->id])}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure?')"
                class="btn btn-danger font-semi w-100">Remove
                Patients</button>
        </form>
    </div>





</div>
@endsection