<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div id="patient-list">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div class="px-5 py-3">
        <div class="pb-3 font-semi font-32">
            <p class="m-0 p-0">Patient List</p>
        </div>
        <div>
            <div class="form-group">
                <input type="text" name="search" id="search" class="form-control"
                    placeholder="Search Patient By Name / Age / Cancer Type" />
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
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
        </div>
    </div>

</div>
@endsection