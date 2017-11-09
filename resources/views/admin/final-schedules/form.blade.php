<div class="form-group {{ $errors->has('event_id') ? 'has-error' : ''}}">
    <label for="event_id" class="col-md-4 control-label">{{ 'Event Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="event_id" type="number" id="event_id" value="{{ $finalschedule->event_id or ''}}" >
        {!! $errors->first('event_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('buyer_id') ? 'has-error' : ''}}">
    <label for="buyer_id" class="col-md-4 control-label">{{ 'Buyer Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="buyer_id" type="number" id="buyer_id" value="{{ $finalschedule->buyer_id or ''}}" >
        {!! $errors->first('buyer_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('seller_id') ? 'has-error' : ''}}">
    <label for="seller_id" class="col-md-4 control-label">{{ 'Seller Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="seller_id" type="number" id="seller_id" value="{{ $finalschedule->seller_id or ''}}" >
        {!! $errors->first('seller_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('event_param_id') ? 'has-error' : ''}}">
    <label for="event_param_id" class="col-md-4 control-label">{{ 'Event Param Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="event_param_id" type="number" id="event_param_id" value="{{ $finalschedule->event_param_id or ''}}" >
        {!! $errors->first('event_param_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
