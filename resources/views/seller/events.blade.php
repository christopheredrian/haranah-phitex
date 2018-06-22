<style>
    .list-group{
        margin: 10px 30px;
    }
</style>
@extends('layouts.app-seller')

@section('content')
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Choose Event</h3>
                        </div>
                        <div class="box-body">
                            <ul class="list-group">
                                @foreach($events as $event)
                                    <li class="list-group-item">
                                        <a href="/seller/home/{{$event->id}}">
                                            {{$event->event_name}} <span class="badge pull-right">{{$event->event_date}}</span><br>{{$event->event_description}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection