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
            <hr />
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
                    <div class="py-3">
                        <a href="#" class="badge badge-info"
                            onclick="viewGuardianInfo('{{$guardian->first_name}} {{$guardian->last_name}}','{{$guardian->ic_number}}','{{$guardian->contact}}','{{Common::$relation[$guardian->relations]}}','{{$guardian->address_one}}, {{$guardian->address_two}}, {{$guardian->postcode}}, {{Common::$state[$guardian->state]}} {{$guardian->city}}')">View
                            Guardian Info</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-5 p-3">
            <div class="font-semi font-18">
                <p class="m-0 p-0">Application Account</p>
            </div>
            <hr />
            <div class="pb-3">
                <p class="m-0 p-0 font-semi">Username</p>
                <p class="m-0 p-0">{{$account->username}}</p>
            </div>
        </div>
    </div>
    <div class="col px-3 pb-3">
        <div class="font-semi font-18 d-flex align-items-center justify-content-between">
            <p class="m-0 p-0">Basic Analysis</p>
            @if($reportCount != 0)
            <a class="badge badge-info m-0 font-12" href="{{route('patients.analyse',[$patient->id])}}">Detail
                Analysis</a>
            @else
            <a class="badge badge-info m-0 font-12" onclick="rejectRequest()">Detail
                Analysis</a>
            @endif
        </div>
        <hr />
        @if($reportCount == 0 )
        <p>No Report Sent From Patient Yet</p>
        @else
        <div class="analysis-wrapper p-0 m-0 justify-content-between">
            {{-- Current Mood --}}
            <div class="analysis-container d-flex justify-content-between align-items-center left">
                <div class="d-flex align-items-center">
                    <span class="material-icons mr-1">
                        mood
                    </span>
                    Current Mood
                </div>
                <div>{{Common::$mood[$currentMoodAndPainLevel->mood]}}</div>
            </div>
            {{-- Highest Number of Pain Location --}}
            <div class="analysis-container d-flex justify-content-between align-items-center right">
                <div class="d-flex align-items-center">
                    <span class="material-icons mr-1">
                        attribution
                    </span>
                    Most Frequent Pain Location
                </div>
                <div>{{$painLocation->body_part}}</div>
            </div>
        </div>
        <div class="analysis-wrapper p-0 m-0 justify-content-between">
            {{-- Current Pain Level --}}
            <div class="analysis-container d-flex justify-content-between align-items-center left">
                <div class="d-flex align-items-center">
                    <span class="material-icons mr-1">
                        bolt
                    </span>
                    Current Pain Level
                </div>
                <div>{{$currentMoodAndPainLevel->level}}</div>
            </div>
            {{-- Average Pain Level --}}
            <div class="analysis-container d-flex justify-content-between align-items-center right">
                <div class="d-flex align-items-center">
                    <span class="material-icons mr-1">
                        bolt
                    </span>
                    Average Pain Level
                </div>
                <div>{{$avgPainLevel->count}}</div>
            </div>
        </div>
        @endif
    </div>

    <div class="d-flex justify-content-center">
        <div class="pb-3 mr-3">
            <a class="btn btn-normal btn-custom-width" href="{{route('patients.edit',[$patient->id])}}">Update
                Details</a>
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

<script>
    function viewGuardianInfo(name, ic, contact, relation, address){

        Swal.fire({
            title: 'Guardian Profile',
            html:'<table class="table table-bordered">'
                    + '<tr><td>Name</td><td>' + name + '</td></tr>'
                    + '<tr><td>IC Number</td><td>' + ic + '</td></tr>'
                    + '<tr><td>Contact</td><td>' + contact + '</td></tr>'
                    + '<tr><td>Relation</td><td>' + relation + '</td></tr>'
                    + '<tr><td>Address</td><td>' + address + '</td></tr>'
                + '</table>',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        });
}

function rejectRequest(){
    
    Swal.fire({
            title: 'No Report Found Yet',
            icon: 'error',
            confirmButtonColor: '#3085d6',
        });
}
</script>
@endsection