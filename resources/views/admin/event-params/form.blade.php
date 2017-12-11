<div class="form-group {{ $errors->has('start_time') ? 'has-error' : ''}}">
    <label for="start_time" class="col-md-4 control-label">{{ 'Start Time' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="start_time" type="time" id="start_time" value="{{ $eventparam->start_time or ''}}" >
        {!! $errors->first('start_time', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('end_time') ? 'has-error' : ''}}">
    <label for="end_time" class="col-md-4 control-label">{{ 'End Time' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="end_time" type="time" id="end_time" value="{{ $eventparam->end_time or ''}}" >
        {!! $errors->first('end_time', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<input type="hidden" class="form-control" name="event_id" type="number" id="event_id" value="{{ $event_id or ''}}" >
{!! $errors->first('event_id', '<p class="help-block">:message</p>') !!}


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
