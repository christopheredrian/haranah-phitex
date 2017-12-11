
<input class="form-control" type="hidden" name="event_id" type="number" id="event_id" value="{{ $event_id or ''}}" >
{!! $errors->first('event_id', '<p class="help-block">:message</p>') !!}
<div class="form-group {{ $errors->has('seller_id') ? 'has-error' : ''}}">
    <label for="seller_id" class="col-md-4 control-label">{{ 'Seller' }}</label>
    <div class="col-md-6">
        <select name="seller_id" id="seller_id" class="form-control">
            @foreach($seller_names as $seller_name)
                <option value="{{array_search ($seller_name, $seller_names)}}">{{$seller_name}}</option>
            @endforeach
        </select>
        {{--<input class="form-control" name="seller_id" type="number" id="seller_id" value="{{ $eventseller->seller_id or ''}}" >--}}
        {!! $errors->first('seller_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
