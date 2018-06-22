
<input class="form-control" type="hidden" name="event_id" type="number" id="event_id" value="{{ $event_id or ''}}" >
{!! $errors->first('event_id', '<p class="help-block">:message</p>') !!}
<div class="form-group {{ $errors->has('seller_id') ? 'has-error' : ''}}">
    <label for="seller_id" class="col-md-4 control-label">{{ 'Seller' }}</label>
    <div class="col-md-6">
        <select name="seller_id" id="seller_id" class="form-control">
            @foreach($sellers as $seller)
                {{--<option value="{{array_search ($seller_name, $seller_names)}}">{{$seller_name}}</option>--}}
                <option value="{{ $seller->id }}">({{ $seller->user->email  }}) {{ $seller->company_name }}</option>
            @endforeach
        </select>
        {{--<input class="form-control" name="seller_id" type="number" id="seller_id" value="{{ $eventseller->seller_id or ''}}" >--}}
        {!! $errors->first('seller_id', '<p class="help-block">:message</p>') !!}
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
            $("#container").append('<div id="seller'+count+'" class="form-group {{ $errors->has('seller_id') ? 'has-error' : ''}}">\n' +
                '    <label for="seller_id" class="col-md-4 control-label">{{ 'Seller' }}</label>\n' +
                '    <div class="col-md-6">\n' +
                '        <select name="seller_id'+count+'" id="seller_id'+count+'" class="form-control">\n' +
                '            @foreach($sellers as $seller)\n' +
                '                {{--<option value="{{array_search ($seller_name, $seller_names)}}">{{$seller_name}}</option>--}}\n' +
                '                <option value="{{ $seller->id }}">{{ $seller->company_name }}</option>\n' +
                '            @endforeach\n' +
                '        </select>\n' +
                '        {{--<input class="form-control" name="seller_id" type="number" id="seller_id" value="{{ $eventseller->seller_id or \'\'}}" >--}}\n' +
                '        {!! $errors->first('seller_id', '<p class="help-block">:message</p>') !!}\n' +
                '    </div>\n' +
                '</div>');
            count=count+1;
        });
        $("#delete").click(function () {
            if(count>0){
                count=count-1;
            }
            $("#seller"+count).remove();

        });

    </script>
@endsection