@extends('layouts.app')

@section('content')
<div>
    @if($errors->any())
    <h4>{{$errors->first()}}</h4>
    @endif

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
    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

</div>
@endsection