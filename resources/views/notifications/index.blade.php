<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('All Notifications') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <table class="table table-borderless">
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
                            <td>{{$message->score}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{route('notifications.show',[$message->id])}}">view
                                    more</a>
                            </td>
                        </tr>
                        @endforeach

                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection