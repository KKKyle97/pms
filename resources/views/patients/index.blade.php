<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div id="patient-list">
    <div class="px-5 py-3">
        <div class="font-semi font-32 pb-3">
            <p class="m-0 p-0">Patient List</p>
        </div>
        <div class="backbone-panel px-5 py-3">
            <form action="{{route('patients.search')}}" method="POST" role="search" class="pb-3">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Search users"> <span
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
                            <th>Name</th>
                            <th>Age</th>
                            <th>IC</th>
                            <th>Cancer Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $patient)
                        <tr>
                            <td>{{$patient->first_name}} {{$patient->last_name}}</td>
                            <td>{{$patient->age}}</td>
                            <td>{{$patient->ic_number}}</td>
                            <td>{{Common::$cancer[$patient->cancer]}}</td>
                            <td><a href="{{route('patients.show',[$patient->id])}}" class="badge badge-success">View
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

    </div>

</div>
@endsection