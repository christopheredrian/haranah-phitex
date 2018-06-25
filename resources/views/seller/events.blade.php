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
        border-top: 5px solid #605ca8;
        padding-top: 10px;
        position: relative;
        transition: ease-in-out 0.2s;
    }
    .event-item > div:hover {
        border-top: 5px solid darkorange;
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
        color: #605ca8;
    }
    .event-item > div:hover h4 {
        color: darkorange;
    }
    .event-description {
        margin-top: 15px;
    }

    h2.box-title {
        font-size: 24px !important;
        font-weight: 700;
        margin-bottom: 30px !important;
    }

</style>
@extends('layouts.app-seller')

@section('content')
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    @if($events->count() !== 0)
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
                                                <a class="select-event" href="/seller/home/{{$event->id}}"></a>

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
                    @else
                        <div class="alert alert-info">
                            <p>You have no events associated with your account, please contact the administrators. </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection