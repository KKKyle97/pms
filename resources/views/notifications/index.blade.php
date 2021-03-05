<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div id="patient-list">
    <div class="patient-list py-3" style="height: 85vh; overflow: auto">
        <div class="font-semi font-32 pb-3" align="center">
            <p class="m-0 p-0">Notification List</p>
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
                    <tr>
                        <th>Name</th>
                        <th class="t-responsive">Age</th>
                        <th class="t-responsive">Cancer Type</th>
                        <th class="t-responsive">Pain Score</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($patients as $patient)
                    <tr>
                        <td>{{$patient->first_name}} {{$patient->last_name}}</td>
                        <td class="t-responsive">{{$patient->age}}</td>
                        <td class="t-responsive">{{Common::$cancer[$patient->cancer]}}</td>
                        <td class="t-responsive"> <span>{{$patient->score}}</span>
                            @if ($patient->is_solved)
                            <span class="badge badge-success">Solved</span>
                            @else
                            @if($patient->score > 7)
                            <span class="badge badge-danger">Emergency!</span>
                            @elseif($patient->score > 3)
                            <span class="badge badge-warning">Medium</span>
                            @else
                            <span class="badge badge-primary">Low</span>
                            @endif
                            @endif
                        </td>
                        <td>
                            <a class="badge badge-info " href="{{route('notifications.show',[$patient->id])}}">view
                                more</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div>
                    {{ $patients->appends(Request::except('page'))->links() }}
                </div>
            </div>
        </div>

    </div>

</div>
@endsection