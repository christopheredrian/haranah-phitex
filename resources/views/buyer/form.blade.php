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
                <input style="cursor: pointer" disabled="disabled" class="form-control" type="email" name="email"
                       id="email"
                       value="{{ old('email', isset($buyer) ? $buyer->user->email : '') }}">
                <span class="input-group-btn">
                  <button style="margin-right:0" type="button"
                          class="undisable btn btn-danger pull-right">Change Email</button>
              </span>

            </div>
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    @endif

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
    <label for="phone" class="col-md-4 col-xs-4 control-label">{{ 'Phone' }}</label>
    <div class="col-md-6 col-xs-6">
        <input class="form-control" type="text" name="phone" id="phone"
               value="{{ old('phone', isset($buyer) ? $buyer->phone : '') }}">
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
