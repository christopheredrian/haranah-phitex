@extends('layouts.app-seller')

@section('styles')
    <!-- fullCalendar -->
    <link rel="stylesheet" href="/bower_components/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">

    <style>

        .callout {
            margin: 0 15px 30px 15px;
        }

        h2.box-title {
            font-size: 24px !important;
            font-weight: 700;
            color: #605ca8;
        }
        .about-company .box-title {
            font-weight:700;
            margin: 10px 0;
        }
        .about-company p {
            margin-bottom: 0;
        }
        .about-company hr {
            margin-top: 7px;
            margin-bottom: 7px;
        }


    </style>
@endsection



@section('content')
    <section class="content">
        <div class="container">
            <div class="row">
                @if($preference)
                
                @else
                <div class="callout callout-warning">
                  <h4>Reminder</h4>

                  <p>You have not yet chosen your preferred buyers for your event.</p>
                </div>
                @endif
                @if(session('flash_message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-check"></i>Success!</h4>

                  <p>{{session('flash_message')}}</p>
                </div>
                @endif
                <div class="col-md-4">


                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <div class="profile-user-image">
                                <img class="profile-user-img" src="/uploads/seller-{{ $seller->id }}.jpg" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ Auth::user()->seller->company_name }}</h3>


                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Representative 1</b> <span class="pull-right">{{ $seller->event_rep1 }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Representative 2</b> <span class="pull-right">{{ $seller->event_rep2 }}</span>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- About Me Box -->
                    <div class="box box-primary about-company">
                        <div class="box-header with-border">
                            <h4 class="box-title">About Company</h4>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                            <p class="text-muted">{{ $seller->company_address }}</p>

                            <hr>

                            <strong><i class="fa fa-map-marker margin-r-5"></i> Email</strong>

                            <p class="text-muted">{{ $seller->user->email }}</p>

                            <hr>

                            <strong><i class="fa fa-pencil margin-r-5"></i>Products</strong>

                            <p class="text-muted">
                                {{ $seller->products }}
                            </p>

                            <hr>


                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-8">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#event" data-toggle="tab">Event</a></li>
                            <li><a href="#edit" data-toggle="tab">Edit Profile</a></li>
                            <li><a href="#final-schedule" data-toggle="tab"> Final Schedule</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="event">

                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <h2 class="box-title">{{$sellerEvent->event_name}}</h2>
                                    </div>
                                    <div class="box-body">
                                        <p>{{$sellerEvent->event_description}}</p>
                                    </div>
                                    <div class="box-footer">
                                        @if(($sellerEvent->event_status) == "Registration Closed")
                                        <span class="btn pull-right btn-danger disabled">Registration Closed!</span>
                                        @elseif($preference)
                                        <span class="btn pull-right btn-success disabled">You have selected buyers!</span>
                                        @else
                                        <input type="button" class="btn pull-right btn-primary" onclick="location.href='/seller/pick/{{$sellerEvent->id}}';" value="Select Buyers" />
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="edit">
                                <form method="POST" action="{{ url('/seller/submit')}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                    {{ method_field('POST') }}
                                    {{ csrf_field() }}

                                    <div class="form-group {{ $errors->has('company_logo') ? 'has-error' : ''}}">
                                        <label for="company_logo" class="col-md-4 control-label">{{ 'Company Logo' }}</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="file" name="company_logo" id="company_logo">
                                            {!! $errors->first('company_logo', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('company_name') ? 'has-error' : ''}}">
                                        <label for="company_name" class="col-md-4 control-label">{{ 'Company Name' }}</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="text" name="company_name" id="company_name"
                                                   value="{{ old('company_name', isset($seller) ? $seller->company_name : '' ) }}">
                                            {!! $errors->first('company_name', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('company_name') ? 'has-error' : ''}}">
                                        <label for="company_name" class="col-md-4 control-label">{{ 'Company Address' }}</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="text" name="company_address" id="company_address"
                                                   value="{{ old('company_address', isset($seller) ? $seller->company_address : '' ) }}">
                                            {!! $errors->first('company_address', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('company_name') ? 'has-error' : ''}}">
                                        <label for="company_name" class="col-md-4 control-label">{{ 'Country' }}</label>
                                        <div class="col-md-8">
                                            <select class="form-control" type="text" name="country" id="country">
                                                <option value="{{old('country', isset($seller) ? $seller->country : '')}}" selected="selected" style="display:none;">{{ old('country', isset($seller) ? $seller->country : '') }}</option>
                                                @foreach($countries as $key => $value)
                                                    <option value="{{$value}}" title="{{$value}}">
                                                        {{$value}}
                                                    </option>
                                                @endforeach

                                            </select>
                                            {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                        <label for="email" class="col-md-4 control-label">{{ 'Email' }}</label>

                                        @if(isset($isCreate))
                                            <div class="col-md-8 ">

                                                <input class="form-control" type="email" name="email" id="email"
                                                       value="{{ old('email', isset($seller) ? $seller->user->email : '') }}">
                                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        @else
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input style="cursor: pointer" disabled="disabled" class="form-control" type="email" name="email"
                                                           id="email"
                                                           value="{{ old('email', isset($seller) ? $seller->user->email : '') }}">

                                                </div>
                                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        @endif

                                    </div>
                                    <div class="form-group {{ $errors->has('website') ? 'has-error' : ''}}">
                                        <label for="website" class="col-md-4 control-label">{{ 'Website' }}</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="text" name="website" id="website"
                                                   value="{{ old('website', isset($seller) ? $seller->website : '') }}">
                                            {!! $errors->first('website', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                                        <label for="phone" class="col-md-4 control-label">{{ 'Phone' }}</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="text" name="phone" id="phone"
                                                   value="{{ old('phone', isset($seller) ? $seller->phone : '') }}">
                                            {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('event_rep1') ? 'has-error' : ''}}">
                                        <label for="event_rep1" class="col-md-4 control-label">{{ 'Event Representative 1' }}</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="text" name="event_rep1" id="event_rep1"
                                                   value="{{ old('event_rep1', isset($seller) ? $seller->event_rep1 : '') }}">
                                            {!! $errors->first('event_rep1', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('event_rep2') ? 'has-error' : ''}}">
                                        <label for="event_rep2" class="col-md-4 control-label">{{ 'Event Representative 2' }}</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="text" name="event_rep2" id="event_rep2"
                                                   value="{{ old('event_rep2', isset($seller) ? $seller->event_rep2 : '') }}">
                                            {!! $errors->first('event_rep2', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('designation') ? 'has-error' : ''}}">
                                        <label for="designation" class="col-md-4 control-label">{{ 'Designation' }}</label>
                                        <div class="col-md-8">
                                            {{--<input class="form-control" type="text" name="designation" id="designation"
                                                   value="{{ old('designation', isset($seller) ? $seller->designation : '') }}">
                                            {!! $errors->first('designation', '<p class="help-block">:message</p>') !!}--}}
                                            <select class="form-control" type="text" name="designation" id="designation">
                                                <option value="{{old('designation', isset($seller) ? $seller->designation : '')}}" selected="selected" style="display:none;">{{ old('designation', isset($seller) ? $seller->designation : '') }}</option>
                                                @foreach($countries as $key => $value)
                                                    <option value="{{$value}}" title="{{$value}}">
                                                        {{$value}}
                                                    </option>
                                                @endforeach

                                            </select>
                                            {!! $errors->first('designation', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('products') ? 'has-error' : ''}}">
                                        <label for="products" class="col-md-4 control-label">{{ 'Products' }}</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="text" name="products" id="products"
                                                   value="{{ old('products', isset($seller) ? $seller->products : '') }}">
                                            {!! $errors->first('products', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-6 col-sm-6">
                                            <button type="submit" class="btn btn-primary pull-right">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->


                            <div class="tab-pane" id="final-schedule">

                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <h2 class="box-title">Finalized Schedule</h2>
                                    </div>
                                    <div class="box-body">
                                        <p> {{ $sellerEvent->description }}</p>
                                        <p> {{ $sellerEvent->event_description  }}</p>

                                        @if($schedule->isEmpty())
                                        @else
                                            <a href="{{ url('/reports/' . $event_id . '/pdf') }}" title="Download PDF Schedule">
                                                @endif

                                                <button class="btn btn-success btn-small {{$schedule->isEmpty() ? 'disabled' : ''}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                    Download PDF Schedule
                                                </button>

                                                @if($schedule->isEmpty())
                                                @else
                                            </a>
                                        @endif
                                    </div>
                                    <div class="box-footer">
                                        @if($schedule->isEmpty())
                                            <p style="text-align: center"> No Schedule has been set</p>
                                        @else
                                            @foreach($schedule as $sched)
                                                <div class="pane-width text-center">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <h3>
                                                                @foreach($info as $inf)
                                                                    @if($inf->event_param_id === $sched->id)
                                                                        @foreach($buyer as $bname)
                                                                            @if($bname->id === $inf->buyer_id)
                                                                                <img style="max-width: 120px; max-height: 120px" class="profile-user-img img-responsive img-circle" src="/uploads/buyer-{{ $bname->id }}.jpg" alt="User profile picture">
                                                                                @break
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            </h3>
                                                        </div>
                                                        <ul class="list-group text-center">
                                                            @foreach($info as $inf)
                                                                @if($inf->event_param_id === $sched->id)
                                                                    @foreach($buyer as $bname)
                                                                        @if($bname->id === $inf->buyer_id)


                                                                            <li class="list-group-item">
                                                                                <p>Company Name: {{ $bname->company_name }}</p>


                                                                            </li>

                                                                            {{--<li class="list-group-item">--}}
                                                                                {{--<p>Owner:--}}
                                                                               {{----}}
                                                                                {{--</p>--}}
                                                                            {{--</li>--}}

                                                                            <li class="list-group-item">
                                                                                {{-- Time Stamps --}}

                                                                                {{ date('g:i A', strtotime($sched->start_time))}}
                                                                                -
                                                                                {{ date('g:i A', strtotime($sched->end_time))}}

                                                                            </li>

                                                                            <li class="list-group-item">
                                                                                {{-- representatives  --}}
                                                                                <p> Repesentative #1: {{ $bname->event_rep1 }}</p>
                                                                                <p> Repesentative #2: {{ $bname->event_rep2 }}</p>

                                                                            </li>
                                                                            @break
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>


                            </div>
                            <!-- /.tab-pane -->

                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>

    @section('scripts')
        <!-- fullCalendar -->
        <script src="/bower_components/moment/moment.js"></script>
        <script src="/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
        <!-- Page specific script -->
        <script>
            $(function () {

                /* initialize the external events
                 -----------------------------------------------------------------*/
                function init_events(ele) {
                    ele.each(function () {

                        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                        // it doesn't need to have a start or end
                        var eventObject = {
                            title: $.trim($(this).text()) // use the element's text as the event title
                        }

                        // store the Event Object in the DOM element so we can get to it later
                        $(this).data('eventObject', eventObject)

                        // make the event draggable using jQuery UI
                        $(this).draggable({
                            zIndex        : 1070,
                            revert        : true, // will cause the event to go back to its
                            revertDuration: 0  //  original position after the drag
                        })

                    })
                }

                init_events($('#external-events div.external-event'))

                /* initialize the calendar
                 -----------------------------------------------------------------*/
                //Date for the calendar events (dummy data)
                var date = new Date()
                var d    = date.getDate(),
                    m    = date.getMonth(),
                    y    = date.getFullYear()
                $('#calendar').fullCalendar({
                    header    : {
                        left  : 'prev,next today',
                        center: 'title',
                        right : 'month,agendaWeek,agendaDay'
                    },
                    buttonText: {
                        today: 'today',
                        month: 'month',
                        week : 'week',
                        day  : 'day'
                    },
                    editable  : true,
                    droppable : true, // this allows things to be dropped onto the calendar !!!
                    drop      : function (date, allDay) { // this function is called when something is dropped

                        // retrieve the dropped element's stored Event Object
                        var originalEventObject = $(this).data('eventObject')

                        // we need to copy it, so that multiple events don't have a reference to the same object
                        var copiedEventObject = $.extend({}, originalEventObject)

                        // assign it the date that was reported
                        copiedEventObject.start           = date
                        copiedEventObject.allDay          = allDay
                        copiedEventObject.backgroundColor = $(this).css('background-color')
                        copiedEventObject.borderColor     = $(this).css('border-color')

                        // render the event on the calendar
                        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                        // is the "remove after drop" checkbox checked?
                        if ($('#drop-remove').is(':checked')) {
                            // if so, remove the element from the "Draggable Events" list
                            $(this).remove()
                        }

                    }
                })

                /* ADDING EVENTS */
                var currColor = '#3c8dbc' //Red by default
                //Color chooser button
                var colorChooser = $('#color-chooser-btn')
                $('#color-chooser > li > a').click(function (e) {
                    e.preventDefault()
                    //Save color
                    currColor = $(this).css('color')
                    //Add color effect to button
                    $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
                })
                $('#add-new-event').click(function (e) {
                    e.preventDefault()
                    //Get value and make sure it is not null
                    var val = $('#new-event').val()
                    if (val.length == 0) {
                        return
                    }

                    //Create events
                    var event = $('<div />')
                    event.css({
                        'background-color': currColor,
                        'border-color'    : currColor,
                        'color'           : '#fff'
                    }).addClass('external-event')
                    event.html(val)
                    $('#external-events').prepend(event)

                    //Add draggable funtionality
                    init_events(event)

                    //Remove event from text input
                    $('#new-event').val('')
                })
            })
        </script>
    @endsection
@endsection

