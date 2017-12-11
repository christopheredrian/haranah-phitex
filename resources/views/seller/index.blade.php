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
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">

                            <h3 class="profile-username text-center">{{ Auth::user()->last_name }}, {{ Auth::user()->first_name  }}</h3>

                            <p class="text-muted text-center">{{ Auth::user()->rolel }}</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Products</b> <a class="pull-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Representative 1</b> <a class="pull-right">Emma Stone</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Representative 2</b> <a class="pull-right">Stone Emma</a>
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
                            <strong><i class="fa fa-book margin-r-5"></i> Companay Description</strong>

                            <p class="text-muted">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.
                            </p>

                            <hr>

                            <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                            <p class="text-muted">Malibu, California</p>

                            <hr>

                            <strong><i class="fa fa-map-marker margin-r-5"></i> Email</strong>

                            <p class="text-muted">abcdefg@gmail.com</p>

                            <hr>

                            <strong><i class="fa fa-pencil margin-r-5"></i>Products</strong>

                            <p class="text-muted">
                                <ul>
                                    <li>Product 1</li>
                                    <li>Product 2</li>
                                    <li>Product 3</li>
                                    <li>Product 4</li>
                                </ul>
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
                            <li class="active"><a href="#schedule" data-toggle="tab">Schedule</a></li>
                            <li><a href="#edit" data-toggle="tab">Edit Profile</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="schedule">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="box box-solid">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">Please drag to the calendar:</h4>
                                            </div>
                                            <div class="box-body">
                                                <!-- the events -->
                                                <div id="external-events">
                                                    <div class="external-event bg-green">Available</div>
                                                    <div class="external-event bg-red">Unavailable</div>
                                                    <div class="checkbox">
                                                        <label for="drop-remove">
                                                            <input type="checkbox" id="drop-remove">
                                                            remove after drop
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-9">
                                        <div class="box box-primary">
                                            <div class="box-body no-padding">
                                                <!-- THE CALENDAR -->
                                                <div id="calendar"></div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /. box -->
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="edit">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Company Name</label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Company Email</label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Company Description</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName" placeholder="Company Description">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSkills" class="col-sm-2 control-label">Services</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputSkills" placeholder="Services">
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

