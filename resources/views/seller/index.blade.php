@extends('layouts.app-seller')

@section('styles')
    <!-- fullCalendar -->
    <link rel="stylesheet" href="/bower_components/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
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
                <div class="col-md-3">
                    
                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="/uploads/seller-{{ $seller->id }}.jpg" alt="User profile picture">

                            <h3 class="profile-username text-center">{{ Auth::user()->last_name }}, {{ Auth::user()->first_name  }}</h3>

                            <p class="text-muted text-center">{{ Auth::user()->role }}</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Representative 1</b> <a class="pull-right">{{ $seller->event_rep1 }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Representative 2</b> <a class="pull-right">{{ $seller->event_rep2 }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- About Me Box -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">About Company</h3>
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

                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#event" data-toggle="tab">Event</a></li>
                            <li><a href="#edit" data-toggle="tab">Edit Profile</a></li>
                            <li><a href="#final-schedule" data-toggle="tab"> Final Schedule</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="event">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-solid">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">{{$sellerEvent->event_name}}</h4>
                                            </div>
                                            <div class="box-body">
                                                <p>{{$sellerEvent->event_description}}</p>
                                            </div>
                                            <div class="box-footer">
                                                @if(($sellerEvent->event_status) == "Registration Closed")
                                                <input type="button" class="btn pull-right btn-primary disabled" value="Registration Closed!" />
                                                @elseif($preference)
                                                <input type="button" class="btn pull-right btn-primary disabled" value="You have selected buyers!" />
                                                @else
                                                <input type="button" class="btn pull-right btn-primary" onclick="location.href='pick';" value="Select Buyers" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="edit">
                                <form method="POST" action="{{ url('seller/submit')}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                    {{ method_field('POST') }}
                                    {{ csrf_field() }}
                                    <div class="form-group {{ $errors->has('company_logo') ? 'has-error' : ''}}">
                                        <label for="company_logo" class="col-md-2 control-label">{{ 'Company Logo' }}</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="file" name="company_logo" id="company_logo"
                                                   value="{{ old('company_logo', isset($seller) ? $seller->company_logo : '' ) }}">
                                            {!! $errors->first('company_logo', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('company_name') ? 'has-error' : ''}}">
                                        <label for="company_name" class="col-md-2 control-label">{{ 'Company Name' }}</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" name="company_name" id="company_name"
                                                   value="{{ old('company_name', isset($seller) ? $seller->company_name : '' ) }}">
                                            {!! $errors->first('company_name', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('company_name') ? 'has-error' : ''}}">
                                        <label for="company_name" class="col-md-2 control-label">{{ 'Company Address' }}</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" name="company_address" id="company_address"
                                                   value="{{ old('company_address', isset($seller) ? $seller->company_address : '' ) }}">
                                            {!! $errors->first('company_address', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('company_name') ? 'has-error' : ''}}">
                                        <label for="company_name" class="col-md-2 control-label">{{ 'Country' }}</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" name="country" id="country"
                                                   value="{{ old('company_name', isset($seller) ? $seller->country : '' ) }}">
                                            {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                        <label for="email" class="col-md-2 control-label">{{ 'Email' }}</label>

                                        @if(isset($isCreate))
                                            <div class="col-md-10 ">

                                                <input class="form-control" type="email" name="email" id="email"
                                                       value="{{ old('email', isset($seller) ? $seller->user->email : '') }}">
                                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        @else
                                            <div class="col-md-10">
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
                                        <label for="website" class="col-md-2 control-label">{{ 'Website' }}</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" name="website" id="website"
                                                   value="{{ old('website', isset($seller) ? $seller->website : '') }}">
                                            {!! $errors->first('website', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                                        <label for="phone" class="col-md-2 control-label">{{ 'Phone' }}</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" name="phone" id="phone"
                                                   value="{{ old('phone', isset($seller) ? $seller->phone : '') }}">
                                            {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('event_rep1') ? 'has-error' : ''}}">
                                        <label for="event_rep1" class="col-md-2 control-label">{{ 'Event Representative 1' }}</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" name="event_rep1" id="event_rep1"
                                                   value="{{ old('event_rep1', isset($seller) ? $seller->event_rep1 : '') }}">
                                            {!! $errors->first('event_rep1', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('event_rep2') ? 'has-error' : ''}}">
                                        <label for="event_rep2" class="col-md-2 control-label">{{ 'Event Representative 2' }}</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" name="event_rep2" id="event_rep2"
                                                   value="{{ old('event_rep2', isset($seller) ? $seller->event_rep2 : '') }}">
                                            {!! $errors->first('event_rep2', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('designation') ? 'has-error' : ''}}">
                                        <label for="designation" class="col-md-2 control-label">{{ 'Designation' }}</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" name="designation" id="designation"
                                                   value="{{ old('designation', isset($seller) ? $seller->designation : '') }}">
                                            {!! $errors->first('designation', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('products') ? 'has-error' : ''}}">
                                        <label for="products" class="col-md-2 control-label">{{ 'Products' }}</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" name="products" id="products"
                                                   value="{{ old('products', isset($seller) ? $seller->products : '') }}">
                                            {!! $errors->first('products', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Edit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->


                            <div class="tab-pane" id="final-schedule">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Finalized Schedule
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <thead>
                                            <tr>
                                                <th>Buyer Name</th>
                                                <th>Start</th>
                                                <th>Stop</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($schedule as $sched)
                                                <tr>
                                                    <td>
                                                        @foreach($info as $inf)
                                                            @if($inf->event_param_id === $sched->id)
                                                                @foreach($buyer as $bname)
                                                                    @if($bname->id === $inf->buyer_id)
                                                                        {{ $bname->last_name.', '.$bname->first_name}}
                                                                        @break
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td> {{ date('g:i A', strtotime($sched->start_time))}} </td>
                                                    <td> {{ date('g:i A', strtotime($sched->end_time))}} </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
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

