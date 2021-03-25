<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div class="header d-flex justify-content-center align-items-center">
    <p class="font-22 font-semi m-0 p-0">Patient List</p>
</div>
<div class="patient-list py-5 middle">
    <form action="{{route('patients.search')}}" method="POST" role="search" class="pb-3">
        {{ csrf_field() }}
        <div class="input-group">
            <input type="text" class="form-control" name="q" placeholder="Search First Name / Last Name / IC Number"> <span
                class="input-group-btn">
                <button type="submit" class="btn btn-default">
                    <span class="material-icons">
                        search
                    </span>
                </button>
            </span>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th id="tName">Name</th>
                    <th id="tAge" class="t-responsive">Age</th>
                    <th id="tIC" class="t-responsive">IC</th>
                    <th id="tCancerType" class="t-responsive">Cancer Type</th>
                    <th id="Action">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                <tr>
                    <td>{{$patient->first_name}} {{$patient->last_name}}</td>
                    <td class="t-responsive">{{$patient->age}}</td>
                    <td class="t-responsive">{{$patient->ic_number}}</td>
                    <td class="t-responsive">{{Common::$cancer[$patient->cancer]}}</td>
                    <td><a href="{{route('patients.show',[$patient->id])}}" class="badge badge-info">View
                            more</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $patients->appends(Request::except('page'))->links() }}
        </div>
    </div>
</div>
<div class="footer d-flex justify-content-center align-items-center">
    <p class="font-14 m-0 p-0">Copyright 2021</p>
</div>
@endsection