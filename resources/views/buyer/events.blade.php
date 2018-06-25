<style>
    .list-group {
        margin: 10px 30px;
    }

    .event-row {

    }
    .event-item {
        margin-bottom: 30px;
    }
    .event-item > div {
        border-top: 5px solid #C36464;
        padding-top: 10px;
        position: relative;
        transition: ease-in-out 0.2s;
    }
    .event-item > div:hover {
        border-top: 5px solid #a03737;
    }
    .event-item .select-event {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    .event-item h4 {
        margin-top: 0;
        margin-bottom: 5px;
        color: #C36464;
    }
    .event-item > div:hover h4 {
        color: #a03737;
    }
    .event-description {
        margin-top: 15px;
        line-height: 25px;
    }

    h2.box-title {
        font-size: 24px !important;
        font-weight: 700;
        margin-bottom: 30px !important;
    }

</style>

@extends('layouts.app-buyer')

@section('content')

    @if(empty($events))
        <p class="alert alert-info"> There are currently no new Events. </p>
    @else

        <div class="container">
            <div class="content">
                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="box-title">Select Event</h2>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            @php $counter = 1; @endphp
                            @foreach($events as $event)
                                <div class="col-sm-4 event-item">
                                    <div class="">
                                        <h4><strong>{{$event->event_name}}</strong></h4>
                                        @php
                                            $date = new \Carbon\Carbon($event->event_date);
                                        @endphp
                                        <span><em>{{ $date
                                                        ->toFormattedDateString()}}</em></span>

                                        <div class="event-description">
                                            {{$event->event_description}}
                                        </div>
                                        <a class="select-event" href="/buyer/profile/{{ $event->id }}"></a>

                                    </div>
                                </div>
                                @if($counter % 3 === 0)
                                    <div class="clearfix"></div>
                                @endif
                                @php $counter++; @endphp
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif

@endsection
