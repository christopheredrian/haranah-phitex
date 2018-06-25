<div class="form-group {{ $errors->has('company_bg') ? 'has-error' : ''}}">
    <label for="company_bg" class="col-md-4 col-xs-4 control-label">{{ 'Cover Photo' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="file" name="company_bg" id="company_bg">
        {!! $errors->first('company_bg', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('company_logo') ? 'has-error' : ''}}">
    <label for="company_logo" class="col-md-4 col-xs-4 control-label">{{ 'Company Logo' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="file" name="company_logo" id="company_logo">
        {!! $errors->first('company_logo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('company_name') ? 'has-error' : ''}}">
    <label for="company_name" class="col-md-4 col-xs-4 control-label">{{ 'Company Name' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="company_name" id="company_name"
               value="{{ old('company_name', isset($buyer) ? $buyer->company_name : '' ) }}">
        {!! $errors->first('company_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('company_address') ? 'has-error' : ''}}">
    <label for="company_address" class="col-md-4 col-xs-4 control-label">{{ 'Company Address' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="company_address" id="company_address"
               value="{{ old('company_address', isset($buyer) ? $buyer->company_address : '' ) }}">
        {!! $errors->first('company_address', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<?php $countryList = config('country'); ?>

<div class="form-group {{ $errors->has('country') ? 'has-error' : ''}}">
    <label for="country" class="col-md-4 col-xs-4 control-label">{{ 'Country' }}</label>
    <div class="col-md-6 col-xs-6">
        <select class="form-control" type="text" name="country" id="country">
            <option value="{{old('country', isset($buyer) ? $buyer->country : '')}}" selected="selected" style="display:none;">{{ old('country', isset($buyer) ? $buyer->country : '') }}</option>
            @foreach ($countryList as $countryId=>$name)
                <option value="{{ $countryId }}">{{ $name }}</option>
            @endforeach
        </select>
        {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('website') ? 'has-error' : ''}}">
    <label for="website" class="col-md-4 col-xs-4 control-label">{{ 'Website' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="website" id="website"
               value="{{ old('website', isset($buyer) ? $buyer->website : '') }}">
        {!! $errors->first('website', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    <label for="phone" class="col-md-4 col-xs-4 control-label">{{ 'Phone Number' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="phone" id="phone"
               value="{{ old('phone', isset($buyer) ? $buyer->phone : '') }}">
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('event_rep1') ? 'has-error' : ''}}">
    <label for="event_rep1" class="col-md-4 col-xs-4 control-label">{{ 'Event Representative 1' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="event_rep1" id="event_rep1"
               value="{{ old('event_rep1', isset($buyer) ? $buyer->event_rep1 : '') }}">
        {!! $errors->first('event_rep1', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('event_rep2') ? 'has-error' : ''}}">
    <label for="event_rep2" class="col-md-4 col-xs-4 control-label">{{ 'Event Representative 2' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="event_rep2" id="event_rep2"
               value="{{ old('event_rep2', isset($buyer) ? $buyer->event_rep2 : '') }}">
        {!! $errors->first('event_rep2', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('designation') ? 'has-error' : ''}}">
    <label for="designation" class="col-md-4 col-xs-4 control-label">{{ 'Designation' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="designation" id="designation"
               value="{{ old('designation', isset($buyer) ? $buyer->designation : '') }}">
        {!! $errors->first('designation', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
