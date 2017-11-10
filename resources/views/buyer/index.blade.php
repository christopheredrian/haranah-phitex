@extends('layouts.app-buyer')

@section('content')

    <div class="row">

        <div class="col-md-12">
            <h4 class="page-head-line">DASHBOARD</h4>
        </div>

        <div class="col-md-12">
            <!--    Hover Rows  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Events
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Event Name</th>
                                <th>Venue</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td>{{ $event->id }}</td>
                                    <td>{{ $event->event_name }}</td>
                                    <td>{{ $event->event_place }}</td>
                                    <td>{{ $event->event_date }}</td>
                                    <td>{{ $event->event_status }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End  Hover Rows  -->
        </div>
    </div>
@endsection
