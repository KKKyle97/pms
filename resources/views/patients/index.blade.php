<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div class="container" id="patient-list">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('All Patients') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="form-group">
                        <input type="text" name="search" id="search" class="form-control"
                            placeholder="Search Patient By Name / Age / Cancer Type" />
                    </div>
                    <div class="table-responsive">
                        <h3 align="center">Total Data : <span id="total_records"></span></h3>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Cancer Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="search-result">

                            </tbody>
                        </table>
                    </div>
                    {{-- <table class="table table-borderless">
                        <tr>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Cancer Type</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($patients as $patient)
                        <tr>
                            <td>{{$patient->first_name}} {{$patient->last_name}}</td>
                    <td>{{$patient->age}}</td>
                    <td>{{Common::$cancer[$patient->cancer]}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{route('patients.show',[$patient->id])}}">view
                            more</a>
                    </td>
                    </tr>
                    @endforeach
                    </table> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection