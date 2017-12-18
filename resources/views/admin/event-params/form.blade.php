
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
<div id="container"></div>
<div class="col-md-offset-4 col-md-6">
    <button id="delete" class="pull-right" type="button">Delete</button>
    <button id="addMore" class="pull-right" type="button">Add more</button>
</div>
<input type="hidden" class="form-control" name="event_id" type="number" id="event_id" value="{{ $event_id or ''}}" >
{!! $errors->first('event_id', '<p class="help-block">:message</p>') !!}

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
@section('scripts')
    <script>
        var count = 1;
        $("#addMore").click(function () {
            $("#container").append('<div id="start'+count+'" class="form-group {{ $errors->has('start_time') ? 'has-error' : ''}}">\n' +
                '    <label for="start_time" class="col-md-4 control-label">{{ 'Start Time' }}</label>\n' +
                '    <div class="col-md-6">\n' +
                '        <input class="form-control" name="start_time'+count+'" type="time" id="start_time'+count+'" value="{{ $eventparam->start_time or ''}}" >\n' +
                '        {!! $errors->first('start_time', '<p class="help-block">:message</p>') !!}\n' +
                '    </div>\n' +
                '</div><div id="end'+count+'" class="form-group {{ $errors->has('end_time') ? 'has-error' : ''}}">\n' +
                '    <label for="end_time" class="col-md-4 control-label">{{ 'End Time' }}</label>\n' +
                '    <div class="col-md-6">\n' +
                '        <input class="form-control" name="end_time'+count+'" type="time" id="end_time'+count+'" value="{{ $eventparam->end_time or ''}}" >\n' +
                '        {!! $errors->first('end_time', '<p class="help-block">:message</p>') !!}\n' +
                '    </div>\n' +
                '</div>');
            count=count+1;
        });
        $("#delete").click(function () {
            if(count>0){
                count=count-1;
            }
            $("#start"+count).remove();
            $("#end"+count).remove();

        });

    </script>
@endsection