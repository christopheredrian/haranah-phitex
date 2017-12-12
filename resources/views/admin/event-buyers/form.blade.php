
<input class="form-control" type="hidden" name="event_id" type="number" id="event_id" value="{{ $event_id or ''}}" >
{!! $errors->first('event_id', '<p class="help-block">:message</p>') !!}
<div class="form-group {{ $errors->has('buyer_id') ? 'has-error' : ''}}">
    <label for="buyer_id" class="col-md-4 control-label">{{ 'Buyer' }}</label>
    <div class="col-md-6">
        <select name="buyer_id" id="buyer_id" class="form-control">
            @foreach($buyers as $buyer)
                {{--<option value="{{array_search ($buyer_name, $buyer_names)}}">{{$buyer_name}}</option>--}}
                <option value="{{ $buyer->id }}">{{$buyer->company_name}}</option>
            @endforeach


        </select>
        {{--{!! Form::select('buyer_id', $buyer_names, ['class' => 'form-control', 'id'=>'buyer_id']) !!}--}}
        {{--<input class="form-control" name="buyer_id" type="number" id="buyer_id" value="{{  $eventbuyer->buyer_id or ''}}" >--}}
        {!! $errors->first('buyer_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
