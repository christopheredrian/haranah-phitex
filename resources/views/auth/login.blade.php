@extends('layouts.public')

@section('content')
    <style>
        .featured-image {
            background: no-repeat center;
            width: 100%;
            height: 590px;
            background-size: cover;
        }
        .login_content {
            background-color : #2B1C1C;
            opacity: 0.9;
            border: 10%;
        }
    </style>
    {{--Image used is not owned by the developers, credit owns to the rightful owner of the photo--}}
<div class="container featured-image" style="background-image:url('/img/terraces.jpg');">
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <img src="/img/Phitex Logo.jpg" alt="logo" style="width: 100px; height: 150px">
                <div class="panel-body">
                    <section class="login_content">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input placeholder="Email" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <input placeholder="Password" id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>



                                    <div>
                                        <button type="submit" class="btn btn-default">
                                            Login
                                        </button>

                                        <a class="reset_pass" href="{{ route('password.request') }}">
                                            Lost your password?
                                        </a>
                                    </div>
                                    {{--<div>--}}
                                    {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                    {{--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me--}}
                                    {{--</label>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                </form>
                            </section>
                        </div>
                    </section>
                </div>
            </div>

</div>
@endsection
