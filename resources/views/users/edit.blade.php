<?php 
    use App\Common;
?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update',[$userProfile->id]) }}">
                        @csrf
                        @method('PUT')

                        {{-- user profile --}}

                        <div class="form-group row">
                            <label for="first_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="first_name"
                                    value="{{ $userProfile->first_name }}" required autocomplete="first_name" autofocus
                                    placeholder="John">

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text"
                                    class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ $userProfile->last_name }}" required autocomplete="last_name" autofocus
                                    placeholder="Doe">

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ic_number" class="col-md-4 col-form-label text-md-right">{{ __('IC') }}</label>

                            <div class="col-md-6">
                                <input id="ic_number" type="text"
                                    class="form-control @error('ic_number') is-invalid @enderror" name="ic_number"
                                    minlength="12" maxlength="12" value="{{ $userProfile->ic_number }}" required
                                    autocomplete="ic_number" placeholder="990201025506"
                                    onkeypress="return isNumberKey(event)" autofocus>

                                @error('ic_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" class="form-control" name="gender" required>
                                    @foreach (Common::$gender as $key => $item)
                                    <option value="{{$key}}" {{$userProfile->gender == $key ? "selected" : ""}}>
                                        {{$item}}</option>
                                    @endforeach
                                </select>

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact"
                                class="col-md-4 col-form-label text-md-right">{{ __('Contact No') }}</label>

                            <div class="col-md-6">
                                <input id="contact" type="text"
                                    class="form-control @error('contact') is-invalid @enderror" name="contact"
                                    minlength="10" maxlength="11" value="{{ $userProfile->contact }}" required
                                    autocomplete="contact" onkeypress="return isNumberKey(event)"
                                    placeholder="0123456789" autofocus>

                                @error('contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hospital"
                                class="col-md-4 col-form-label text-md-right">{{ __('Hospital') }}</label>

                            <div class="col-md-6 dropdown">
                                <select id="hospital" class="form-control js-example-basic-single" name="hospital"
                                    required>
                                    <optgroup label="Johor">
                                        @foreach (Common::$hospitals as $key => $item)
                                        @if (strpos($key,'J') !== false)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endif
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Kedah">
                                        @foreach (Common::$hospitals as $key => $item)
                                        @if (strpos($key,'K') !== false)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endif
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Kelantan">
                                        @foreach (Common::$hospitals as $key => $item)
                                        @if (strpos($key,'D') !== false)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endif
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Kuala Lumpur">
                                        @foreach (Common::$hospitals as $key => $item)
                                        @if (strpos($key,'W') !== false)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endif
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Labuan">
                                        @foreach (Common::$hospitals as $key => $item)
                                        @if (strpos($key,'L') !== false)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endif
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Melaka">
                                        @foreach (Common::$hospitals as $key => $item)
                                        @if (strpos($key,'M') !== false)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endif
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Negeri Sembilan">
                                        @foreach (Common::$hospitals as $key => $item)
                                        @if (strpos($key,'N') !== false)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endif
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Pahang">
                                        @foreach (Common::$hospitals as $key => $item)
                                        @if (strpos($key,'C') !== false)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endif
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Penang">
                                        @foreach (Common::$hospitals as $key => $item)
                                        @if (strpos($key,'P') !== false)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endif
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Perak">
                                        @foreach (Common::$hospitals as $key => $item)
                                        @if (strpos($key,'A') !== false)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endif
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Perlis">
                                        @foreach (Common::$hospitals as $key => $item)
                                        @if (strpos($key,'R') !== false)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endif
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Putrajaya">
                                        @foreach (Common::$hospitals as $key => $item)
                                        @if (strpos($key,'F') !== false)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endif
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Sabah">
                                        @foreach (Common::$hospitals as $key => $item)
                                        @if (strpos($key,'H') !== false)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endif
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Sarawak">
                                        @foreach (Common::$hospitals as $key => $item)
                                        @if (strpos($key,'V') !== false)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endif
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Selangor">
                                        @foreach (Common::$hospitals as $key => $item)
                                        @if (strpos($key,'S') !== false)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endif
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Terengganu">
                                        @foreach (Common::$hospitals as $key => $item)
                                        @if (strpos($key,'T') !== false)
                                        <option value="{{$key}}">{{$item}}</option>
                                        @endif
                                        @endforeach
                                    </optgroup>
                                </select>

                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select id="role" class="form-control" name="role" required>
                                    @foreach (Common::$role as $key => $item)
                                    <option value="{{$key}}" {{$userProfile->role == $key ? "selected" : ""}}>{{$item}}
                                    </option>
                                    @endforeach
                                </select>

                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
@endsection