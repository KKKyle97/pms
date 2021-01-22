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
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Cancer Type</th>
                        <th>Pain Score</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($patients as $patient)

                    @foreach ($patient->messages as $message)
                    <tr>
                        <td>{{$patient->first_name}} {{$patient->last_name}}</td>
                        <td>{{$patient->age}}</td>
                        <td>{{Common::$cancer[$patient->cancer]}}</td>
                        <td> <span>{{$message->score}}</span>
                            @if ($message->is_solved)
                            <span class="badge badge-success">Solved</span>
                            @else
                            @if($message->score > 7)
                            <span class="badge badge-danger">Emergency!</span>
                            @elseif($message->score > 3)
                            <span class="badge badge-warning">Medium</span>
                            @else
                            <span class="badge badge-primary">Low</span>
                            @endif
                            @endif
                        </td>
                        <td>
                            <a class="badge badge-info " href="{{route('notifications.show',[$message->id])}}">view
                                more</a>
                        </td>
                    </tr>
                    @endforeach

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