<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('My Profile') }}</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="col">
                        <div>
                            <table class="table table-borderless">
                                <tr>
                                    <th>Name</th>
                                    <th>IC Number</th>
                                    <th>Gender</th>
                                    <th>Contact No</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                </tr>
                                <tr>
                                    <td>{{$userProfile->first_name}} {{$userProfile->last_name}}</td>
                                    <td>{{$userProfile->ic_number}}</td>
                                    <td>{{Common::$gender[$userProfile->gender]}}</td>
                                    <td>{{$userProfile->contact}}</td>
                                    <td>{{Common::$role[$userProfile->role]}}</td>
                                    <td>{{$userProfile->email}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <a class="btn btn-primary" href="{{route('users.edit',[$userProfile->id])}}">Update
                        Details</a>
                </div>
            </div>
        </div>
    </div>
    @endsection