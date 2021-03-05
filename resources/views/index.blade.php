@extends('layouts.app')

@section('content')
<div class="main-menu"  style="height:100vh; overflow:auto">
    <div class="px-5 pt-5 main-menu-header">
        <div class="font-weight-bold header-number header-content header-content-a main-menu-profile-container py-3">
            <div class="main-menu-profile">
                <img src="{{asset('/image/doctor.png')}}" alt="">
            </div>
            <div class="main-menu-title">
                <p class="title font-24 m-0"> <span>Welcome</span> {{Auth::user()->userProfile->first_name}} {{Auth::user()->userProfile->last_name}}</p>
                <p class="m-0">Hope you are having a great day!</p>
            </div>
        </div>
        <div class="header-content header-content-c p-3 main-menu-children">
            <div class="header-number">
                <span class="material-icons md-36">
                    child_care
                </span>
                <span class="pl-3 font-32 font-weight-bold">
                    {{$patientProfilesCount}} 
                </span>
            </div>
            <div class="font-18" align="center">
                <p class="p-0 m-0">Patients in Care</p>
            </div>
        </div>

        <div class="header-content header-content-c p-3 main-menu-noti">
            <div class="header-number">
                <span class="material-icons md-36">
                    notifications_active
                </span>
                <span class="pl-3 font-32">
                    {{$notificationCount}}  
                </span>
            </div>
            <div class="font-18" align="center">
                <p class="p-0 m-0">New Notifications</p>
            </div>

        </div>
    </div>
    
    <div class="px-5 main-menu-body">
        <div class="main-menu-quick-start px-5">
            <div class="p-div">
                <p class="font-18 font-weight-bold">Welcome To Child Of Light</p>
                <p>The Presence Of The Doctor Is The Beginning Of The Cure. Let's Give The Children A Better Future!</p>
                <a href="{{route('patients.create')}}" class="btn btn-primary">Add New Patient</a>
            </div>
            
            {{-- <p>testing</p> --}}
            <div class="main-menu-img">
                <img src="{{asset('/image/MainMenu.png')}}" alt="MainMenu" width="100%" height="100%">
            </div>
        </div>
        
        {{-- <p class="font-semi font-28">
            Quick Actions
        </p>
        <div class="row py-3">
            <div class="col-lg-6">
                <div class="p-3 d-flex flex-column justify-content-between align-items-center backbone-panel">
                    <div>
                        <span class="material-icons px-3 md-48">
                            add_circle_outline
                        </span>
                    </div>
                    <div class="font-semi font-18">
                        <p class="p-0 m-0">Add New Patient</p>
                    </div>
                </div>
            </div> 
            <div class="col-lg-6">
                <div class="p-3 d-flex flex-column justify-content-between align-items-center backbone-panel">
                    <div>
                        <span class="material-icons px-3 md-48">
                            format_list_bulleted
                        </span>
                    </div>
                    <div class="font-semi font-18">
                        <p class="p-0 m-0">View All Patients</p>
                    </div>
                </div>
            </div> 
        </div>
        
        <div class="row py-3">
            <div class="col-lg-6">
                <div class="p-3 d-flex flex-column justify-content-between align-items-center backbone-panel">
                    <div>
                        <span class="material-icons px-3 md-48">
                            notifications_active
                        </span>
                    </div>
                    <div class="font-semi font-18">
                        <p class="p-0 m-0">Notifications</p>
                    </div>
                </div>
            </div> 
            <div class="col-lg-6">
                <div class="p-3 d-flex flex-column justify-content-between align-items-center backbone-panel">
                    <div>
                        <span class="material-icons px-3 md-48">
                            face
                        </span>
                    </div>
                    <div class="font-semi font-18">
                        <p class="p-0 m-0">My Profile</p>
                    </div>
                </div>
            </div> 
        </div> --}}
        {{-- <div>
            <div>
                <p class="font-semi font-32">
                    Quick Data
                </p>
            </div>
    
            <div class="flex-fill d-flex flex-column justify-content-between">
                <div class="p-3 d-flex flex-column align-items-center backbone-panel">
                    <div>
                        <span class="material-icons px-3 md-48">
                            child_care
                        </span>
                    </div>
                    <div class="font-semi font-18">
                        <p class="p-0 m-0">{{$patientProfilesCount}} Patients in Care</p>
                    </div>
    
                </div>
    
                <div class="p-3 d-flex flex-column align-items-center backbone-panel">
                    <div>
                        <span class="material-icons px-3 md-48">
                            notifications_active
                        </span>
                    </div>
                    <div class="font-semi font-18">
                        <p class="p-0 m-0">{{$notificationCount}} New Notifications</p>
                    </div>
    
                </div>
            </div>
        </div> --}}
    </div>
</div>

@endsection