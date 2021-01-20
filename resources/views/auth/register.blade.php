<?php
use App\Common;
?>

@extends('layouts.guest')

@section('content')
<div class="container-fluid h-100 d-flex align-items-center justify-content-center">
    <div class="login-panel p-5">
        <div class="text-center pb-3">
            <p class="font-weight-bold font-32 p-0 m-0">Registration Form</p>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="row">
                <div>
                    <div class="form-group">
                        <label for="email" class="col col-form-label">{{ __('E-Mail Address') }}</label>

                        <div class="col">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                placeholder="johndoe@gmail.com">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col col-form-label">{{ __('Password') }}</label>

                        <div class="col">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="new password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col col-form-label">{{ __('Confirm Password') }}</label>

                        <div class="col">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="repeat new password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sq_one_q" class="col col-form-label">{{ __('Security Question One') }}</label>

                        <div class="col">
                            <select id="sq_one_q" class="form-control" name="sq_one_q" required>
                                @foreach (Common::$securityQuestionOne as $key => $item)
                                <option value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>

                            @error('sq_one_q')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sq_one_a" class="col col-form-label">{{ __('Answer') }}</label>

                        <div class="col">
                            <input id="sq_one_a" type="text" class="form-control" name="sq_one_a" required
                                placeholder="answer for security question one">

                            @error('sq_one_a')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sq_two_q" class="col col-form-label">{{ __('Security Question Two') }}</label>

                        <div class="col">
                            <select id="sq_two_q" class="form-control" name="sq_two_q" required>
                                @foreach (Common::$securityQuestionTwo as $key => $item)
                                <option value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>

                            @error('sq_two_q')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sq_two_a" class="col col-form-label">{{ __('Answer') }}</label>

                        <div class="col">
                            <input id="sq_two_a" type="text" class="form-control" name="sq_two_a" required
                                placeholder="answer for security question two">

                            @error('sq_two_a')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>


                {{-- user profile --}}
                <div>
                    <div class="form-group">
                        <label for="first_name" class="col col-form-label">{{ __('First Name') }}</label>

                        <div class="col">
                            <input id="first_name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name"
                                autofocus placeholder="John">

                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="col col-form-label">{{ __('Last Name') }}</label>

                        <div class="col">
                            <input id="last_name" type="text"
                                class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                value="{{ old('last_name') }}" required autocomplete="last_name" autofocus
                                placeholder="Doe">

                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ic_number" class="col col-form-label">{{ __('IC') }}</label>

                        <div class="col">
                            <input id="ic_number" type="text"
                                class="form-control @error('ic_number') is-invalid @enderror" name="ic_number"
                                minlength="12" maxlength="12" value="{{ old('ic_number') }}" required
                                autocomplete="ic_number" placeholder="990201025506"
                                onkeypress="return isNumberKey(event)" autofocus>

                            @error('ic_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="gender" class="col col-form-label">{{ __('Gender') }}</label>

                        <div class="col">
                            <select id="gender" class="form-control" name="gender" required>
                                @foreach (Common::$gender as $key => $item)
                                <option value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>

                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contact" class="col col-form-label">{{ __('Contact No') }}</label>

                        <div class="col">
                            <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror"
                                name="contact" minlength="10" maxlength="11" value="{{ old('contact') }}" required
                                autocomplete="contact" onkeypress="return isNumberKey(event)" placeholder="0123456789"
                                autofocus>

                            @error('contact')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="hospital" class="col col-form-label">{{ __('Hospital') }}</label>

                        <div class="col dropdown">
                            <select id="hospital" class="js-example-basic-single form-control" name="hospital" required>
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


                    <div class="form-group">
                        <label for="role" class="col col-form-label">{{ __('Role') }}</label>

                        <div class="col">
                            <select id="role" class="form-control" name="role" required>
                                @foreach (Common::$role as $key => $item)
                                <option value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>

                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-3">
                <button type="submit" class="btn btn-primary  col">
                    {{ __('Register') }}
                </button>
            </div>
            <div class="">
                <a href="{{route('login')}}" class="btn btn-primary  col">
                    {{ __('Back') }}
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2({
        'theme':'bootstrap4',
    });
});
</script>
@endsection