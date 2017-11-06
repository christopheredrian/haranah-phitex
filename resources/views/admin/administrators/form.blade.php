<div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
    <label for="last_name" class="col-md-4 col-xs-4 control-label">{{ 'Last Name' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="last_name" id="last_name"
               value="{{ old('last_name', isset($administrator) ? $administrator->last_name : '' ) }}">
        {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
    <label for="first_name" class="col-md-4 col-xs-4 control-label">{{ 'First Name' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="first_name" id="first_name"
               value="{{ old('first_name', isset($administrator) ? $administrator->first_name : '') }}">
        {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="col-md-4 col-xs-4 control-label">{{ 'Email' }}</label>

    @if(isset($isCreate))
        <div class="col-md-6 col-xs-6 ">

            <input class="form-control" type="email" name="email" id="email"
                   value="{{ old('email', isset($administrator) ? $administrator->email : '') }}">
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    @else
        <div class="col-md-6 col-xs-6">
            <div class="input-group">
                <input style="cursor: pointer" disabled="disabled" class="form-control" type="email" name="email" id="email"
                       value="{{ old('email', isset($administrator) ? $administrator->email : '') }}">
                <span class="input-group-btn">
                  <button style="margin-right:0" type="button" class="undisable btn btn-danger pull-right">Change Email</button>
              </span>

            </div>
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    @endif
</div>



<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
