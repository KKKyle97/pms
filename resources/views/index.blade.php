@extends('layouts.app')

@section('content')
<div class="p-5 m-0 row">
    <div class="col-3">
        <img src="{{asset('/image/hospital.png')}}" alt="hospital" height="200px" width="200px">
    </div>

    <div class="col-9 pl-5 font-weight-bold font-32">
        <p class="title">Welcome to Child Of Light Patient Management System</p>
        <p class="title">{{Auth::user()->userProfile->first_name}} {{Auth::user()->userProfile->last_name}}</p>
    </div>
</div>

<div class="flex-grow-1 row p-5 d-flex justify-content-between">
    <div class="col-7 d-flex flex-column p-5 backbone-panel">
        <div>
            <p class="font-semi font-32">
                Quick Actions
            </p>
        </div>
        <div class="flex-fill d-flex flex-column justify-content-between">
            <div class="row justify-content-between">
                <div class="col-5 p-3 d-flex flex-column justify-content-between align-items-center backbone-panel">
                    <div>
                        <span class="material-icons px-3 md-48">
                            add_circle_outline
                        </span>
                    </div>
                    <div class="font-semi font-18">
                        <p class="p-0 m-0">Add New Patient</p>
                    </div>

                </div>
                <div class="col-5 p-3 d-flex flex-column justify-content-between align-items-center backbone-panel">
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

            <div class="row justify-content-between">
                <div class="col-5 p-3 d-flex flex-column justify-content-between align-items-center backbone-panel">
                    <div>
                        <span class="material-icons px-3 md-48">
                            notifications_active
                        </span>
                    </div>
                    <div class="font-semi font-18">
                        <p class="p-0 m-0">Notifications</p>
                    </div>

                </div>
                <div class="col-5 p-3 d-flex flex-column justify-content-between align-items-center backbone-panel">
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
        </div>


    </div>
    <div class="col-4 d-flex flex-column p-5 backbone-panel">
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
    </div>
</div>
@endsection