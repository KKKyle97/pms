<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div class="patient-list py-3">
    <div class="font-semi font-32" align="center">
        <p class="m-0 p-0">My Profile</p>
    </div>
    <div class="m-0 mb-3 py-3">
        <div class="col backbone-panel px-3 py-3 row justify-content-between m-0">
            <div class="col-md-4">
                <div class="pb-3">
                    <p class="m-0 p-0 font-semi font-18">Name</p>
                    <p class="m-0 p-0">{{$userProfile->first_name}} {{$userProfile->last_name}}</p>
                </div>
                <div class="pb-3">
                    <p class="m-0 p-0 font-semi font-18">IC</p>
                    <p class="m-0 p-0">{{$userProfile->ic_number}}</p>
                </div>
                <div class="pb-3">
                    <p class="m-0 p-0 font-semi font-18">Gender</p>
                    <p class="m-0 p-0">{{Common::$gender[$userProfile->gender]}}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pb-3">
                    <p class="m-0 p-0 font-semi font-18">Contact Number</p>
                    <p class="m-0 p-0">{{$userProfile->contact}}</p>
                </div>
                <div class="pb-3">
                    <p class="m-0 p-0 font-semi font-18">Role</p>
                    <p class="m-0 p-0">{{Common::$role[$userProfile->role]}}</p>
                </div>
                <div class="pb-3">
                    <p class="m-0 p-0 font-semi font-18">Hospital</p>
                    <p class="m-0 p-0">{{Common::$hospitals[$userProfile->hospital_code]}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-3 m-0">
        <a class="btn btn-primary col font-semi" href="{{route('users.edit',[$userProfile->id])}}">Update Details</a>
    </div>
</div>
@endsection