<div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
    <label for="last_name" class="col-md-4 col-xs-4 control-label">{{ 'Last Name' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="last_name" id="last_name"
               value="{{ old('last_name', isset($buyer) ? $buyer->user->last_name : '' ) }}">
        {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
    <label for="first_name" class="col-md-4 col-xs-4 control-label">{{ 'First Name' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="first_name" id="first_name"
               value="{{ old('first_name', isset($buyer) ? $buyer->user->first_name : '') }}">
        {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="col-md-4 col-xs-4 control-label">{{ 'Email' }}</label>

    @if(isset($isCreate))
        <div class="col-md-6 col-xs-6 ">

            <input class="form-control" type="email" name="email" id="email"
                   value="{{ old('email', isset($buyer) ? $buyer->user->email : '') }}">
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    @else
        <div class="col-md-6 col-xs-6">
            <div class="input-group">
                <input style="cursor: pointer" disabled="disabled" class="form-control" type="email" name="email" id="email"
                       value="{{ old('email', isset($buyer) ? $buyer->user->email : '') }}">
                <span class="input-group-btn">
                  <button style="margin-right:0" type="button" class="undisable btn btn-danger pull-right">Change Email</button>
              </span>

            </div>
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    @endif

</div>

<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    <label for="phone" class="col-md-4 col-xs-4 control-label">{{ 'Phone' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="phone" id="phone"
               value="{{ old('phone', isset($buyer) ? $buyer->phone : '') }}">
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('country') ? 'has-error' : ''}}">
    <label for="country" class="col-md-4 col-xs-4 control-label">{{ 'Country' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="phone" id="phone"
               value="{{ old('country', isset($buyer) ? $buyer->country : '') }}">
        {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('company_name') ? 'has-error' : ''}}">
    <label for="company_name" class="col-md-4 col-xs-4 control-label">{{ 'Company_Name' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="company_name" id="company_name"
               value="{{ old('company_name', $buyer->company_name) }}">
        {!! $errors->first('company_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('company_address') ? 'has-error' : ''}}">
    <label for="company_address" class="col-md-4 col-xs-4 control-label">{{ 'Company Address' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="company_address" id="company_address"
               value="{{ old('company_address', isset($buyer) ? $buyer->company_address : '') }}">
        {!! $errors->first('company_address', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('event_rep1') ? 'has-error' : ''}}">
    <label for="event_rep1" class="col-md-4 col-xs-4 control-label">{{ 'Event Represenative 1' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="event_rep1" id="event_rep1"
               value="{{ old('event_rep1', isset($buyer) ? $buyer->event_rep1 : '') }}">
        {!! $errors->first('event_rep1', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('event_rep2') ? 'has-error' : ''}}">
    <label for="event_rep2" class="col-md-4 col-xs-4 control-label">{{ 'Event Represenative 2' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="event_rep2" id="event_rep2"
               value="{{ old('event_rep2', isset($buyer) ? $buyer->event_rep2 : '') }}">
        {!! $errors->first('event_rep2', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('designation') ? 'has-error' : ''}}">
    <label for="designation" class="col-md-4 col-xs-4 control-label">{{ 'Designation' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="event_rep2" id="event_rep2"
               value="{{ old('designation', isset($buyer) ? $buyer->designation : '') }}">
        {!! $errors->first('designation', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('website') ? 'has-error' : ''}}">
    <label for="website" class="col-md-4 col-xs-4 control-label">{{ 'Website URL' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="website" id="website"
               value="{{ old('website', isset($buyer) ? $buyer->website : '') }}">
        {!! $errors->first('website', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
