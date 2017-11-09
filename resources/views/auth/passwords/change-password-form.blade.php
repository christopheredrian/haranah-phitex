<div class="form-group {{ $errors->has('current_password') ? 'has-error' : ''}}">
    <label for="current_password" class="col-md-4 col-xs-4 control-label">{{ 'Current Password' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="password" name="current_password" id="current_password">
        {!! $errors->first('current_password', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('new_password') ? 'has-error' : ''}}">
    <label for="new_password" class="col-md-4 col-xs-4 control-label">{{ 'New Password' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="password" name="new_password" id="new_password">
        {!! $errors->first('current_password', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('confirm_new_password') ? 'has-error' : ''}}">
    <label for="confirm_new_password" class="col-md-4 col-xs-4 control-label">{{ 'Confirm New Password' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="password" name="confirm_new_password" id="confirm_new_password">
        {!! $errors->first('current_password', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="Change">
    </div>
</div>