
<input class="form-control" type="hidden" name="event_id" type="number" id="event_id" value="{{ $event_id or ''}}" >
{!! $errors->first('event_id', '<p class="help-block">:message</p>') !!}
<div class="form-group {{ $errors->has('buyer_id') ? 'has-error' : ''}}">
    <label for="buyer_id" class="col-md-4 control-label">{{ 'Buyer' }}</label>
    <div class="col-md-6">
        <select name="buyer_id" id="buyer_id" class="form-control">
            @foreach($buyers as $buyer)
                {{--<option value="{{array_search ($buyer_name, $buyer_names)}}">{{$buyer_name}}</option>--}}
                <option value="{{ $buyer->id }}">({{$buyer->user->email}}) {{$buyer->company_name}}</option>
            @endforeach


        </select>
        {{--{!! Form::select('buyer_id', $buyer_names, ['class' => 'form-control', 'id'=>'buyer_id']) !!}--}}
        {{--<input class="form-control" name="buyer_id" type="number" id="buyer_id" value="{{  $eventbuyer->buyer_id or ''}}" >--}}
        {!! $errors->first('buyer_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div id="container"></div>
<div class="col-md-offset-4 col-md-6">
    <button id="delete" class="pull-right" type="button">Delete</button>
    <button id="addMore" class="pull-right" type="button">Add more</button>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>

@section('scripts')
    <script>
        var count = 1;
        $("#addMore").click(function () {
            $("#container").append('<div id="buyer'+count+'" class="form-group {{ $errors->has('buyer_id') ? 'has-error' : ''}}">\n' +
                '    <label for="buyer_id" class="col-md-4 control-label">{{ 'Buyer' }}</label>\n' +
                '    <div class="col-md-6">\n' +
                '        <select name="buyer_id'+count+'" id="buyer_id'+count+'" class="form-control">\n' +
                '            @foreach($buyers as $buyer)\n' +
                '                {{--<option value="{{array_search ($buyer_name, $buyer_names)}}">{{$buyer_name}}</option>--}}\n' +
                '                <option value="{{ $buyer->id }}">{{$buyer->company_name}}</option>\n' +
                '            @endforeach\n' +
                '\n' +
                '\n' +
                '        </select>\n' +
                '        {{--{!! Form::select(\'buyer_id\', $buyer_names, [\'class\' => \'form-control\', \'id\'=>\'buyer_id\']) !!}--}}\n' +
                '        {{--<input class="form-control" name="buyer_id" type="number" id="buyer_id" value="{{  $eventbuyer->buyer_id or \'\'}}" >--}}\n' +
                '        {!! $errors->first('buyer_id', '<p class="help-block">:message</p>') !!}\n' +
                '    </div>\n' +
                '</div>');
            count=count+1;
        });
        $("#delete").click(function () {
            if(count>0){
                count=count-1;
            }
            $("#buyer"+count).remove();

        });

    </script>
@endsection