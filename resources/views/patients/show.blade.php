<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('All Patients') }}</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="col row">
                        {{-- parent profile --}}
                        <div class="col-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Cancer Type</th>
                                </tr>
                                <tr>
                                    <td>{{$patient->first_name}} {{$patient->last_name}}</td>
                                    <td>{{$patient->age}}</td>
                                    <td>{{Common::$cancer[$patient->cancer]}}</td>
                                </tr>
                            </table>
                        </div>
                        {{-- guardian profile --}}
                        <div class="col-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Name</th>
                                    <th>Relations</th>
                                </tr>
                                <tr>
                                    <td>{{$guardian->first_name}} {{$guardian->last_name}}</td>
                                    <td>{{$guardian->relations}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    {{-- patient account --}}
                    <div class="col">
                        <table class="table table-borderless">
                            <tr>
                                <th>Username</th>
                            </tr>
                            <tr>
                                <td>{{$account->username}}</td>
                            </tr>
                        </table>
                    </div>

                    <a class="btn btn-primary" href="{{route('patients.edit',[$patient->id])}}">Update Details</a>
                    <a class="btn btn-primary" href="{{route('patients.analyse',[$patient->id])}}">Analyse</a>
                    <form action="{{route('patients.destroy',[$patient->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-primary">Remove
                            Patients</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection