<?php
use App\Common;
?>

@extends('layouts.app')
@section('pageTitle', 'User Profile')
@section('content')
<div class="header d-flex justify-content-center align-items-center">
    <p class="font-22 font-semi m-0 p-0">User Profile</p>
</div>
<div class="patient-list py-5 middle" align="center">
    <div class="user-profile-card card-front d-flex flex-column" align="center">
        <div class="pb-3 d-flex flex-column align-items-center justify-content-end card-front-center">
            <img src="{{asset('/image/ribbon.png')}}" alt="" width="70px" height="60px">
            <p class="m-0 p-0 font-18 font-weight-bold">Child Of Light</p>
            <p class="m-0 p-0 font-10">Patient Management System</p>
        </div>
        
        <div class="d-flex px-5 flex-column align-items-center justify-content-end card-front-bottom">
            <p class="m-0 p-0 font-14 font-weight-bold">{{$userProfile->first_name}} {{$userProfile->last_name}}</p>
            <p class="m-0 p-0 font-10">{{Common::$hospitals[$userProfile->hospital_code]}}</p>
        </div>
    </div>
    <div class="user-profile-card d-flex align-items-center justify-content-between px-4 card-back-font" align="left">
        <div class="col-5">
            <p class="m-0 pb-4 d-flex align-items-center"><span class="material-icons pr-2">
                account_circle
                </span>{{$userProfile->first_name}} {{$userProfile->last_name}}</p>
            <p class="m-0 pb-4 d-flex align-items-center"><span class="material-icons pr-2">
                privacy_tip
                </span>{{$userProfile->ic_number}}</p>
            <p class="m-0 p-0 d-flex align-items-center"><span class="material-icons pr-2">
                face
                </span>{{Common::$gender[$userProfile->gender]}}</p>
        </div>
        <div class="pl-4" style="border-left: 1px solid #26a69a;">
            <p class="m-0 pb-4 d-flex align-items-center"><span class="material-icons pr-2">
                call
                </span>{{$userProfile->contact}}</p>
            <p class="m-0 pb-4 d-flex align-items-center"><span class="material-icons pr-2">
                medication
                </span>{{Common::$role[$userProfile->role]}} </p>
            <p class="m-0 p-0 d-flex align-items-center"><span class="material-icons pr-2">
                business
                </span>{{Common::$hospitals[$userProfile->hospital_code]}}</p>
        </div>
    </div>

    <div class="pt-3 m-0 d-flex justify-content-center">
        <a class="btn btn-normal btn-custom-width mr-2" href="{{route('users.edit',[$userProfile->id])}}">Update Details</a>
        <a class="btn btn-normal btn-custom-width" href="{{route('passwords.index')}}">Change Password</a>
    </div>
</div>
<div class="footer d-flex justify-content-center align-items-center">
    <p class="font-14 m-0 p-0">Copyright 2021</p>
</div>
@endsection