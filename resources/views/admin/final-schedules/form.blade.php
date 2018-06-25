<div class="form-group {{ $errors->has('event_id') ? 'has-error' : ''}}">
    <label for="event_id" class="col-md-4 control-label">{{ 'Event Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="event_id" type="number" id="event_id" value="{{ $finalschedule->event_id or $events_id }}" >
        {!! $errors->first('event_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('buyer_id') ? 'has-error' : ''}}">
    <label for="buyer_id" class="col-md-4 control-label">{{ 'Buyer' }}</label>
    <div class="col-md-6">
        <select name="buyer_id" id="buyer_id" class="form-control">
            @foreach($buyer_names as $buyer_name)
                @if($finalschedule->event_id != null && $finalschedule->buyer_id == array_search ($buyer_name, $buyer_names))
                    <option selected="selected" value="{{array_search ($buyer_name, $buyer_names)}}">{{$buyer_name}}</option>
                @else
                    <option value="{{array_search ($buyer_name, $buyer_names)}}">{{$buyer_name}}</option>
                @endif

            @endforeach


        </select>
        {!! $errors->first('buyer_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('seller_id') ? 'has-error' : ''}}">
    <label for="seller_id" class="col-md-4 control-label">{{ 'Seller' }}</label>
    <div class="col-md-6">
        <select name="seller_id" id="seller_id" class="form-control">
            @foreach($seller_names as $seller_name)
                @if($finalschedule->event_id != null && $finalschedule->seller_id == array_search ($seller_name, $seller_names))
                    <option selected="selected" value="{{array_search ($seller_name, $seller_names)}}">{{$seller_name}}</option>
                @else
                    <option value="{{array_search ($seller_name, $seller_names)}}">{{$seller_name}}</option>
                @endif

            @endforeach
        </select>
        {{--<input class="form-control" name="seller_id" type="number" id="seller_id" value="{{ $eventseller->seller_id or ''}}" >--}}
        {!! $errors->first('seller_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('event_param_id') ? 'has-error' : ''}}">
    <label for="event_param_id" class="col-md-4 control-label">{{ 'Event Param' }}</label>
    <div class="col-md-6">
        <select name="event_param_id" id="event_param_id" class="form-control">
            @foreach($schedule_list as $schedule)
                @if($finalschedule->event_id != null && $finalschedule->event_param_id == array_search ($schedule, $schedule_list))
                    <option selected="selected" value="{{array_search ($schedule, $schedule_list)}}">{{$schedule}}</option>
                @else
                    <option value="{{array_search ($schedule, $schedule_list)}}">{{$schedule}}</option>
                @endif

            @endforeach


        </select>

        {!! $errors->first('event_param_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('table') ? 'has-error' : ''}}">
    <label for="event_param_id" class="col-md-4 control-label">{{ 'Table' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="table" type="number" id="table" value="{{ $finalschedule->table }}" min="1" max="1000">

        {!! $errors->first('event_param_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
