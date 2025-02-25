@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">EventParam {{ $eventparam->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/event-params') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/event-params/' . $eventparam->id . '/edit') }}" title="Edit EventParam"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/eventparams' . '/' . $eventparam->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete EventParam" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $eventparam->id }}</td>
                                    </tr>
                                    <tr><th> Start Time </th><td> {{ $eventparam->start_time }} </td></tr><tr><th> End Time </th><td> {{ $eventparam->end_time }} </td></tr><tr><th> Event Id </th><td> {{ $eventparam->event_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
