@extends('layouts.app-buyer')
@section('additional-css')

@endsection
@section('title')
    Profile
@endsection

@section('content')
    <div class="row" xmlns:http="http://www.w3.org/1999/xhtml">
        {{--<div class="col-md-12">--}}
            {{--<h4 class="page-head-line">{{ $buyer->company_name }}</h4>--}}
        {{--</div>--}}

        @if(Session::has('flash_message'))
            <div class="col-md-12">
                <p class="alert alert-success">{{ Session::get('flash_message') }}</p>
            </div>
        @endif

        <div class="col-sm-4">

            <div class="card hovercard">
                <div class="cardheader" style='background: url("/uploads/buyer-bg-{{$buyer->id}}.jpg")'>
                </div>
                <div class="avatar">
                    <img alt="" src="/uploads/buyer-{{ $buyer->id }}.jpg">
                </div>
                <div class="info">
                    <div class="title">
                        {{ $buyer->company_name }}
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $buyer->company_address }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $buyer->user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Website</th>
                                    <td><a target="_blank" href="{{ $buyer->website }}">{{ $buyer->website }}</a></td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td>{{ $buyer->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Representatives</th>
                                    <td>{{ $buyer->event_rep1 }}</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>{{ $buyer->event_rep2 }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="bottom">
                    <a href="{{ url('/buyer/edit') }}" title="Edit buyer">
                        <button class="btn btn-primary btn-md"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Edit
                        </button>
                    </a>
                </div>
            </div>

        </div>

        {{--                        <a href="{{ url('/buyer/home') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>--}}


        {{--<form method="POST" action="{{ url('buyer' . '/' . Auth::user()->id) }}" accept-charset="UTF-8" style="display:inline">--}}
        {{--{{ method_field('DELETE') }}--}}
        {{--{{ csrf_field() }}--}}
        {{--<button type="submit" class="btn btn-danger btn-xs" title="Delete buyer" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>--}}
        {{--</form>--}}

        {{--View Schedule--}}
        <div class="col-sm-8 ">

            @if($schedule->isEmpty())
                <div class="alert alert-info">
                    <strong>Schedule not yet Available</strong>
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    Event Details
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <th>Event</th>
                                <td>{{ $buyerEvent->event_name }}</td>
                            </tr>
                            <tr>
                                <th>Venue</th>
                                <td>{{ $buyerEvent->event_place }}</td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td>{{ $buyerEvent->event_date }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{ $buyerEvent->event_description }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Finalized Schedule
                    <br>
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
                </div>

                @foreach($schedule as $sched)
                    <div class="pane-width text-center">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3>
                                    @foreach($info as $inf)
                                        @if($inf->event_param_id === $sched->id)
                                            @foreach($seller as $bname)
                                                @if($bname->id === $inf->seller_id)
                                                    <img style="max-width: 290px" profile-user-img img-responsive img-circle"
                                                         src="/uploads/buyer-{{ $bname->id }}.jpg"
                                                         alt="User profile picture">
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </h3>
                            </div>
                            <ul class="list-group text-center">
                                @foreach($info as $inf)
                                    @if($inf->event_param_id === $sched->id)
                                        @foreach($seller as $bname)
                                            @if($bname->id === $inf->seller_id)

                                                <li class="list-group-item">
                                                    <p>Company Name: {{ $bname->company_name }}</p>

                                                </li>


                                                <li class="list-group-item">
                                                    {{-- Time Stamps --}}

                                                    {{ date('g:i A', strtotime($sched->start_time))}}
                                                    -
                                                    {{ date('g:i A', strtotime($sched->end_time))}}

                                                </li>

                                                <li class="list-group-item">
                                                    {{-- representatives  --}}
                                                    <p> Repesentative #1: {{ $bname->event_rep1 }}</p>
                                                    <p> Repesentative #2: {{ $bname->event_rep2 }}</p>

                                                </li>
                                                @break
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </div>
@endsection
