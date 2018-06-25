@extends('layouts.app-buyer')

@section('content')

    @if(empty($events))
        <p class="alert alert-info"> There are currently no new Events. </p>
    @else
        <div class="content-wrapper">
            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Choose event
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($events as $event)
                                <li class="list-group-item" style="width: 100%">
                                    <a href="/buyer/profile/{{ $event->id }}">{{ $event->event_name }} <span
                                                class="badge pull-right">{{ $event->event_date }}</span>
                                        <br> {{ $event->event_description }}
                                    </a>

                                </li>

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
