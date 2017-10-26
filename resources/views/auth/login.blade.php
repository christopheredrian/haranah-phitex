@extends('layouts.public')

@section('content')
<div class="container">
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <h1>Login Form</h1>

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
