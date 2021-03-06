<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div id="patient-list">
    <div class="patient-list py-3" style="height: 85vh; overflow: auto">
        <div class="font-semi font-32 pb-3" align="center">
            <p class="m-0 p-0">Patient List</p>
        </div>
        <div class="backbone-panel px-2 py-3">
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
                            <th class="t-responsive">Age</th>
                            <th class="t-responsive">IC</th>
                            <th class="t-responsive">Cancer Type</th>
                            <th>Action</th>
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

    </div>

</div>
@endsection