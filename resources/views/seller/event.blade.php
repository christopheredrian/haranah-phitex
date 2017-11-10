@extends('layouts.app-seller')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">Events</div>
                    <div class="box-body">
                        <h2>Events associated with this seller</h2>
                        <table id="events-table" class="table table-striped table-responsive data-table">
                            <thead>
                            <th>Name</th>
                            <th>Place</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td>{{ $event->event_name }}</td>
                                    <td>{{ $event->event_place }}</td>
                                    <td>{{ $event->event_date }}</td>
                                    <td>{{ $event->event_status }}</td>
                                    <td>
                                        <a class="btn btn-info btn-xs" href="/seller/events/{{ $event->id }}">Show</a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script>
        $('#events-table').DataTable();
    </script>
@endsection