<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div class="container">
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
                {{-- <div class="modal-footer">
                    
                </div> --}}
            </div>
        </div>
    </div>
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
                    {{-- message --}}
                    <div class="col-6">
                        <table class="table table-borderless">
                            <tr>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Cancer Type</th>
                                <th>Score</th>
                                <th>Message</th>
                            </tr>
                            <tr>
                                <td>{{$patient->first_name}} {{$patient->last_name}}</td>
                                <td>{{$patient->age}}</td>
                                <td>{{Common::$cancer[$patient->cancer]}}</td>
                                <td>{{$message->score}}</td>
                                <td>{{$message->message}}</td>
                            </tr>
                        </table>

                        @if (!$message->is_solved)
                        <button class="btn btn-primary" data-toggle="modal"
                            data-target="#exampleModalCenter">Solve</button>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection