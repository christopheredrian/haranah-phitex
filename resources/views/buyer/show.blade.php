@extends('layouts.app-buyer')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">PROFILE</h4>
        </div>

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                <div class="panel-body">

                    {{--                        <a href="{{ url('/buyer/home') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>--}}
                    <a href="{{ url('/buyer/'.Auth::user()->id.'/edit') }}" title="Edit buyer">
                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Edit
                        </button>
                    </a>

                    {{--<form method="POST" action="{{ url('buyer' . '/' . Auth::user()->id) }}" accept-charset="UTF-8" style="display:inline">--}}
                    {{--{{ method_field('DELETE') }}--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<button type="submit" class="btn btn-danger btn-xs" title="Delete buyer" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>--}}
                    {{--</form>--}}
                    <br/>
                    <br/>

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ Auth::user()->id }}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</td>
                            </tr>

                            <tr>
                                <th>Company Name</th>
                                <td>{{ $buyer->company_name }}</td>
                            </tr>
                            <tr>
                                <th>Company Address</th>
                                <td>{{ $buyer->company_address }}</td>
                            </tr>
                            <tr>
                                <th>Event Representative 1</th>
                                <td>{{ $buyer->event_rep1 }}</td>
                            </tr>
                            <tr>
                                <th>Event Representative 2</th>
                                <td>{{ $buyer->event_rep2 }}</td>
                            </tr>
                            <tr>
                                <th>Designation</th>
                                <td>{{ $buyer->desgination }}</td>
                            </tr>
                            <tr>
                                <th>Website</th>
                                <td>{{ $buyer->website }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-12">
            <h4 class="page-head-line">Schedule</h4>
        </div>
        @foreach($buyerEvent as $event)
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <th>Event Name</th>
                            <td>{{ $event->event_name}}</td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td> {{ $event->event_place}}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td> {{ $event->event_description }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <p></p>
                @foreach($schedule as $sched)
                    <p> Event Starts at {{ date('g:i A', strtotime($sched->start_time))}} </p>
                    <p> Event Ends at {{ date('g:i A', strtotime($sched->end_time))}} </p>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>


@endsection
