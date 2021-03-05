<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Problem solved?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('notifications.update',[$message->id])}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="solution">Solution</label>
                            <textarea class="form-control" name="solution" id="solution" rows="3" required
                                placeholder="write the solution here..."></textarea>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
<div class="patient-list py-3">
    <div class="font-semi font-32 pb-3" align="center">
        <p class="m-0 p-0">Notification detail</p>
    </div>
    <div class="m-0 mb-3 py-3">
        <div class="col backbone-panel px-5 py-3">
            <div class="col">
                <div class="pb-3">
                    <p class="m-0 p-0 font-semi font-18">Name</p>
                    <p class="m-0 p-0">{{$patient->first_name}} {{$patient->last_name}}</p>
                </div>
                <div class="pb-3">
                    <p class="m-0 p-0 font-semi font-18">Age</p>
                    <p class="m-0 p-0">{{$patient->age}}</p>
                </div>
                <div class="pb-3">
                    <p class="m-0 p-0 font-semi font-18">Cancer Type</p>
                    <p class="m-0 p-0">{{Common::$cancer[$patient->cancer]}}</p>
                </div>
                <div class="pb-3">
                    <p class="m-0 p-0 font-semi font-18">Pain Level</p>
                    <p class="m-0 p-0">{{$message->score}}</p>
                </div>
                <div class="pb-3">
                    <p class="m-0 p-0 font-semi font-18">Pain Body Parts</p>
                    <p class="m-0 p-0">{{$message->message}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-3 m-0">
        @if (!$message->is_solved)
        <button class="btn btn-primary w-100" data-toggle="modal"
            data-target="#exampleModalCenter">Solve</button>
        @endif
    </div>
</div>
@endsection