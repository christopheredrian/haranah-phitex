@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel x_panel">
                    <h1 class="x_title">Event: <b>{{ $event->event_name }}</b>
                        @if($event->event_status == "New Event")
                            <form id="submit-form" action="/admin/events/{{ $event->id }}/openRegistration"
                                  method="post" style="display:inline">
                                {{ csrf_field() }}
                                {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">--}}
                                {{--Submit List</button>--}}
                                <button type="submit" class="btn btn-small btn-primary pull-right">Open Registration
                                </button>
                            </form>
                        @endif
                        @if($event->event_status == "Registration Open")
                            <form id="submit-form" action="/admin/events/{{ $event->id }}/closeRegistration"
                                  method="post" style="display:inline">
                                {{ csrf_field() }}
                                {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">--}}
                                {{--Submit List</button>--}}
                                <button type="submit"
                                        class="btn btn-small btn-danger pull-right" {{$event->event_params->isEmpty() ? 'disabled' : ''}}>
                                    Close Registration
                                </button>
                            </form>
                        @endif

                        @if($event->event_status == "Registration Closed")
                            {{--<a href="{{ route('show.final.schedule', ['event_id' => $event->id]) }}" title="Edit Event">--}}
                            {{--<button class="btn btn-primary">Finalize Schedule</button>--}}
                            {{--</a>--}}


                            <a href="{{ url('/admin/final-schedules/list/' . $event_id) }}" title="Edit Event">
                                <button class="btn btn-small btn-primary pull-right">Finalize Schedule
                                </button>
                            </a>
                        @endif
                        @if($event->event_status == "Schedule Finalized")
                            <a href="{{ route('show.final.list.schedule', ['event_id' => $event->id]) }}"
                               title="See Event">
                                <button class="btn btn-small btn-primary pull-right">View Finalized Schedules</button>
                            </a>
                        @endif
                        @if($event->event_status == "Registration Closed")
                            <form id="submit-form" action="/admin/events/{{ $event->id }}/openRegistration"
                                  method="post" style="display:inline">
                                {{ csrf_field() }}
                                {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">--}}
                                {{--Submit List</button>--}}
                                <button type="submit" class="btn btn-small btn-success pull-right">Re-Open
                                    Registration
                                </button>
                            </form>
                        @endif
                    </h1>
                    <div class="panel-body">

                        <a href="{{ url('/admin/events') }}" title="Back">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <a href="{{ url('/admin/events/' . $event->id . '/edit') }}" title="Edit Event">
                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>
                        {{--                        {{dd($schedule)}}--}}
                        @if($schedule->isEmpty())
                        @else
                            <a href="{{ url('/reports/' . $event_id . '/pdf') }}" title="Download PDF Schedule">
                                @endif

                                <button class="btn btn-success btn-xs {{$schedule->isEmpty() ? 'disabled' : ''}}"><i
                                            class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                    Download PDF Schedule
                                </button>
                                @if($schedule->isEmpty())
                                @else
                            </a>
                        @endif


                        <form method="POST" action="{{ url('admin/events' . '/' . $event->id) }}" accept-charset="UTF-8"
                              style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Event"
                                    onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                                                                             aria-hidden="true"></i>
                                Delete
                            </button>
                        </form>

                        {{--<a href="#">--}}
                        {{--<button class="btn btn-success btn-xs" data-toggle="modal" data-target="#myViewSellerModal">--}}
                        {{--Show Sellers--}}
                        {{--</button>--}}
                        {{--</a>--}}
                        {{--<a href="#">--}}
                        {{--<button class="btn btn-success btn-xs" data-toggle="modal" data-target="#myViewBuyerModal">--}}
                        {{--Show Buyers--}}
                        {{--</button>--}}
                        {{--</a>--}}

                        <br/>
                    </div>

                    <div class="x_panel">
                        <div>
                            <h1 class="x_title"><i class="fa fa-envelope-o"></i> Mail
                                <div class="btn-group pull-right">
                                    <a class="btn btn-primary btn-md"
                                       href="{{ url('/admin/sendNotificationEmails/' . $event->id) }}"
                                       title="Send Notification Email">
                                        <i class="fa fa-envelope-o"></i> Send Notification Emails
                                    </a>
                                    <a class="btn btn-primary btn-md"
                                       href="{{ url('/admin/event/' . $event->id . '/mail?to=sellers') }}"
                                       title="Edit Event">
                                        <i class="fa fa-users"></i> Sellers
                                    </a>
                                    <a class="btn btn-primary btn-md"
                                       href="{{ url('/admin/event/' . $event->id . '/mail?to=buyers') }}"
                                       title="Edit Event">
                                        <i class="fa fa-money"></i> Buyers
                                    </a>
                                    <a class="btn btn-primary btn-md"
                                       href="{{ url('/admin/event/' . $event->id . '/mail?to=all') }}"
                                       title="Edit Event">
                                        <i class="fa fa-reply-all"></i> Buyers and Sellers
                                    </a>
                                </div>
                            </h1>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $event->id }}</td>
                                </tr>
                                <tr>
                                    <th> Event Name</th>
                                    <td> {{ $event->event_name }} </td>
                                </tr>
                                <tr>
                                    <th>Event Place</th>
                                    <td>{{ $event->event_place }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $event->event_description }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $event->event_status }}</td>
                                </tr>
                                <tr>
                                    <th>Created at</th>
                                    <td>{{ $event->created_at }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="x_panel">
                    <h1 class="x_title">Schedules
                        <a href="{{ route('create.event.params', ['event_id' => $event->id]) }}" title="Add Param">
                            <button class="btn btn-success btn-small pull-right"><i class="fa fa-pencil-square-o"
                                                                                    aria-hidden="true"></i> Add Schedule
                            </button>
                        </a></h1>
                    <p class="x_content">
                    <ul>
                        @foreach($event->event_params as $s)
                            <li>{{ date('g:i A', strtotime($s->start_time)) }}
                                - {{ date('g:i A', strtotime($s->end_time)) }}</li>
                        @endforeach
                    </ul>
                    </p>
                </div>


                <div class="x_panel">
                    <div class="table-responsive">
                        <h1 class="x_title">Sellers
                            <a href="{{ route('create.event.sellers', ['event_id' => $event->id]) }}"
                               title="Add Sellers">
                                <button class="btn btn-success btn-small pull-right"><i class="fa fa-pencil-square-o"
                                                                                        aria-hidden="true"></i> Add
                                    Sellers
                                </button>
                            </a></h1>
                        <table id="sellers-table" class="table table-compresed table-borderless data-table">
                            <thead>
                            <tr>
                                <th>Representative 1</th>
                                <th>Representative 2</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Country</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Representative 1</th>
                                <th>Representative 2</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Country</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($sellers as $s)
                                <tr>
                                    <td>{{ $s->event_rep1 }}</td>
                                    <td>{{ $s->event_rep2 }}</td>
                                    <td>{{ $s->company_name }}</td>
                                    <td>{{ $s->user->email }}</td>
                                    <td>{{ $s->phone }}</td>
                                    <td>{{ $s->country }}</td>
                                    <td>
                                        <form method="POST"
                                              action="{{ url('/admin/event-sellers/'.$event->id.'/'.$s->id.'/delete' ) }}"
                                              accept-charset="UTF-8" style="display:inline">

                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-xs"
                                                    title="Delete EventBuyer"
                                                    onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="x_panel">
                    <div class="table-responsive">
                        <h1 class="x_title">Buyers
                            <a href="{{ route('create.event.buyers', ['event_id' => $event->id]) }}" title="Add Buyers">
                                <button class="btn btn-success btn-small pull-right"><i class="fa fa-pencil-square-o"
                                                                                        aria-hidden="true"></i> Add
                                    Buyers
                                </button>
                            </a>
                        </h1>
                        <table id="buyers-table" class="table table-compresed table-borderless data-table">
                            <thead>
                            <tr>
                                <th>Representative 1</th>
                                <th>Representative 2</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Country</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Representative 1</th>
                                <th>Representative 2</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Country</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($buyers as $b)
                                <tr>
                                    <td>{{ $b->event_rep1}}</td>
                                    <td>{{ $b->event_rep2}}</td>
                                    <td>{{ $b->company_name }}</td>
                                    <td>{{ $b->user->email }}</td>
                                    <td>{{ $b->phone }}</td>
                                    <td>{{ $b->country }}</td>
                                    <td>
                                        <form method="POST"
                                              action="{{ url('/admin/event-buyers/'.$event->id.'/'.$b->id.'/delete' ) }}"
                                              accept-charset="UTF-8" style="display:inline">

                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-xs"
                                                    title="Delete EventBuyer"
                                                    onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="modal fade in" id="myViewSellerModal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">SELLER</h4>
                            </div>

                            <!-- LOOP content -->
                            <div class="modal-body">
                                <ol>
                                    @foreach($eventsellers as $item)
                                        <li> {{$item->last_name. ", " .$item->first_name}}</li>
                                    @endforeach
                                </ol>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Accept
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade in" id="myViewBuyerModal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">BUYER</h4>
                            </div>
                            <div class="modal-body">
                                <ol>
                                    @foreach($eventbuyers as $item)
                                        <li> {{$item->last_name. ", " .$item->first_name}}</li>
                                    @endforeach
                                </ol>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Accept
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $('#sellers-table').DataTable();
        $('#buyers-table').DataTable();
    </script>
@endsection