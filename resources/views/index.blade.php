@extends('layouts.app')
@section('pageTitle', 'Main Menu')
@section('content')
<div class="header d-flex justify-content-center align-items-center">
    <p class="font-22 font-semi m-0 p-0">Main Menu</p>
</div>
<div class="main-menu middle">
    <div class="pt-4 pb-3 px-5">
        <div class="font-weight-bold header-number header-content header-content-a main-menu-profile-container py-4">
            <div class="main-menu-profile">
                <img src="{{asset('/image/doctor.png')}}" alt="">
            </div>
            <div class="main-menu-title pl-4">
                <p class="title font-24 m-0"> <span>Welcome</span> {{Auth::user()->userProfile->first_name}} {{Auth::user()->userProfile->last_name}}</p>
                <p class="m-0">Hope you are having a great day!</p>
            </div>
        </div>
    </div>
    
    <div class="px-5 main-menu-header">
        <a href="{{route('patients.index')}}" class=" main-menu-children">
            <div class="header-content header-content-c p-3">
                <div class="header-number">
                    <span class="material-icons md-36">
                        child_care
                    </span>
                    <span class="pl-3 font-36 font-weight-bold">
                        {{$patientProfilesCount}} 
                    </span>
                </div>
                <div class="font-18" align="center">
                    <p class="p-0 m-0 font-semi">Patients in Care</p>
                </div>
            </div>
        </a>
        
        
        <a href="{{route('notifications.index')}}" class="main-menu-noti">
            <div class="header-content header-content-c p-3 main-menu-noti">
                <div class="header-number">
                    <span class="material-icons md-36">
                        notifications_active
                    </span>
                    <span class="pl-3 font-36">
                        {{$notificationCount}}  
                    </span>
                </div>
                <div class="font-18" align="center">
                    <p class="p-0 m-0 font-semi">New Notifications</p>
                </div>
            </div>
        </a>
        
    </div>
    
    <div class="px-5 main-menu-body">
        <div class="main-menu-quick-start px-5">
            <div class="p-div">
                <p class="font-18 font-weight-bold">Welcome To Child Of Light</p>
                <p>The Presence Of The Doctor Is The Beginning Of The Cure. Let's Give The Children A Better Future!</p>
                <a href="{{route('patients.create')}}" class="btn btn-normal">Add New Patient</a>
            </div>
            
            {{-- <p>testing</p> --}}
            <div class="main-menu-img">
                <img src="{{asset('/image/MainMenu.png')}}" alt="MainMenu" width="100%" height="100%">
            </div>
        </div>
    </div>
</div>
<div class="footer d-flex justify-content-center align-items-center">
    <p class="font-14 m-0 p-0">Copyright 2021</p>
</div>


@endsection