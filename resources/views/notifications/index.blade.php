<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div class="header d-flex justify-content-center align-items-center">
    <p class="font-22 font-semi m-0 p-0">Notification List</p>
</div>
<div class="patient-list py-5 middle">
    <form action="{{route('notifications.search')}}" method="POST" role="search" class="pb-3">
        {{ csrf_field() }}
        <div class="input-group">
            <input type="text" class="form-control" name="q" placeholder="Search First Name / Last Name"> <span
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
                <th id="tName">Name</th>
                <th id="tAge" class="t-responsive">Age</th>
                <th id="tCancerType" class="t-responsive">Cancer Type</th>
                <th id="tPainScore" class="t-responsive">Pain Score</th>
                <th id="tTime" class="t-responsive">Sent At</th>
                <th id="tAction">Action</th>
            </tr>

            @foreach($patients as $patient)
            <tr>
                <td>{{$patient->first_name}} {{$patient->last_name}}</td>
                <td class="t-responsive">{{$patient->age}}</td>
                <td class="t-responsive">{{Common::$cancer[$patient->cancer]}}</td>
                <td class="t-responsive"> <span>{{$patient->score}}</span>
                    @if ($patient->is_solved)
                    <span class="badge badge-success">Solved</span>
                    @else
                    @if($patient->score > 7)
                    <span class="badge badge-danger">Emergency!</span>
                    @elseif($patient->score > 3)
                    <span class="badge badge-warning">Medium</span>
                    @else
                    <span class="badge badge-primary">Low</span>
                    @endif
                    @endif
                </td>
                <td class="t-responsive">{{$patient->created_at}}</td>
                <td>
                    <a class="badge badge-info " onclick="updateMsg({{$patient->id}},'{{$patient->first_name}}','{{$patient->last_name}}',
                    '{{$patient->ic_number}}','{{$patient->age}}',
                    '{{$patient->score}}','{{$patient->message}}',
                    '{{$patient->updated_at}}','{{$patient->is_solved}}','{{$patient->solution}}')">view
                        more</a>
                </td>
            </tr>
            @endforeach
        </table>
        <div>
            {{ $patients->appends(Request::except('page'))->links() }}
        </div>
    </div>
</div>
<div class="footer d-flex justify-content-center align-items-center">
    <p class="font-14 m-0 p-0">Copyright 2021</p>
</div>
<script>
    function updateMsg(msgId, pFirstName, pLastName, pIc, pAge, score, msg, msgTime, msgIsSolved, msgSolution){
        console.log(msgIsSolved);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if(msgIsSolved == '0'){
        Swal.fire({
            title: 'Please Help!',
            icon: 'warning',
            html:'<table class="table table-bordered">'
                    + '<tr><td>Name</td><td>' + pFirstName + ' ' + pLastName + '</td></tr>'
                    + '<tr><td>IC Number</td><td>' + pIc + '</td></tr>'
                    + '<tr><td>Age</td><td>' + pAge + '</td></tr>'
                    + '<tr><td>Score</td><td>' + score + '</td></tr>'
                    + '<tr><td>Message</td><td>' + msg + '</td></tr>'
                    + '<tr><td>Sent Time</td><td>' + msgTime + '</td></tr>'
                + '</table>',
            input:'text',
            inputLabel:'Write Your Solution Here',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    if(result.value != ""){
                        $.ajax({
                                type:'PUT',
                                url:'/notifications/'+msgId,
                                dataType:'json',
                                data:{
                                    "solution": result.value
                                },
                                success:function(data) {
                                    let timerInterval
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Thank You!',
                                            text: 'This window will be closed automatically...',
                                            allowOutsideClick:false,
                                            allowEscapeKey:false,
                                            timer: 2000,
                                            timerProgressBar: true,
                                            didOpen: () => {
                                                Swal.showLoading()
                                                timerInterval = setInterval(() => {
                                                const content = Swal.getContent()
                                                if (content) {
                                                    const b = content.querySelector('b')
                                                    if (b) {
                                                    b.textContent = Swal.getTimerLeft()
                                                    }
                                                }
                                                }, 100)
                                            },
                                            willClose: () => {
                                                clearInterval(timerInterval)
                                            }
                                        }).then((result) => {
                                        /* Read more about handling dismissals below */
                                            if (result.dismiss === Swal.DismissReason.timer) {
                                                location.reload();
                                            }
                                        })
                                }
                            });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Please provide a solution!'
                        })
                    }
                }
            })
    }else {
        Swal.fire({
            title: 'Problem Solved!',
            icon: 'success',
            html:'<table class="table table-bordered">'
                    + '<tr><td>Name</td><td>' + pFirstName + ' ' + pLastName + '</td></tr>'
                    + '<tr><td>IC Number</td><td>' + pIc + '</td></tr>'
                    + '<tr><td>Age</td><td>' + pAge + '</td></tr>'
                    + '<tr><td>Score</td><td>' + score + '</td></tr>'
                    + '<tr><td>Message</td><td>' + msg + '</td></tr>'
                    + '<tr><td>Solution</td><td>' + msgSolution + '</td></tr>'
                    + '<tr><td>Update Time</td><td>' + msgTime + '</td></tr>'
                + '</table>',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        });
    }
}
        
</script>
@endsection