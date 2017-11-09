<div class="form-group {{ $errors->has('event_name') ? 'has-error' : ''}}">
    <label for="event_name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="event_name" type="text" id="event_name" value="{{ $event->event_name or ''}}" >
        {!! $errors->first('event_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('event_place') ? 'has-error' : ''}}">
    <label for="event_place" class="col-md-4 control-label">{{ 'Place' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="event_place" type="text" id="event_place" value="{{ $event->event_place or ''}}" >
        {!! $errors->first('event_place', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('event_date') ? 'has-error' : ''}}">
    <label for="event_date" class="col-md-4 control-label">{{ 'Date' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="event_date" type="date" id="event_date" value="{{ $event->event_date or ''}}" >
        {!! $errors->first('event_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('event_status') ? 'has-error' : ''}}">
    <label for="event_date" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="event_date" type="text" id="event_date" value="{{ $event->event_status or ''}}" >
        {!! $errors->first('event_status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('event_description') ? 'has-error' : ''}}">
    <label for="event_date" class="col-md-4 control-label">{{ 'Description' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="event_description" type="date" id="event_description" value="{{ $event->event_description or ''}}" >
        {!! $errors->first('event_description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
