@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <a class="btn btn-primary" href="{{route('patients.create')}}">Add Patient</a>
                    <a class="btn btn-primary" href="{{route('patients.index')}}">View all patients </a>
                    <a class="btn btn-primary" href="{{route('notifications.index')}}">Notifications</a>
                    <a class="btn btn-primary" href="{{route('users.show',[Auth::user()->id])}}">My Profile</a>
                    <a class="btn btn-primary" href="{{route('passwords.index')}}">Reset Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection