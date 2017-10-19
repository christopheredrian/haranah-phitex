{{--<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">--}}
    {{--<label for="user_id" class="col-md-4 control-label">{{ 'Last Name' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="user_id" type="number" id="user_id" value="{{ $buyer->user_id or ''}}" >--}}
        {{--{!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}--}}

    {{--</div>--}}
{{--</div>--}}

<div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
    <label for="last_name" class="col-md-4 control-label">{{ 'Last Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" type="text" name="last_name" id="last_name" value="{{ $buyer->last_name or ''}}">
        {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
    <label for="first_name" class="col-md-4 control-label">{{ 'First Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" type="text" name="first_name" id="first_name" value="{{ $buyer->first_name or ''}}">
        {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="col-md-4 control-label">{{ 'Email' }}</label>
    <div class="col-md-6">
        <input class="form-control" type="email" name="email" id="email" value="{{ $buyer->email or ''}}">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    <label for="password" class="col-md-4 control-label">{{ 'Password' }}</label>
    <div class="col-md-6">
        <input class="form-control" type="password" name="password" id="password" value="{{ $buyer->first_name or ''}}">
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>

{{--<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">--}}
    {{--<label for="confirm_password" class="col-md-4 control-label">{{ 'Confirm Password' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" type="password" name="password" id="password" value="{{ $buyer->first_name or ''}}">--}}
        {{--{!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>