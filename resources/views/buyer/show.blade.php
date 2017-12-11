@extends('layouts.app-buyer')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">{{ $buyer->company_name }}</h4>
        </div>

        <div class="col-lg-4 col-sm-6">

            <div class="card hovercard">
                <div class="cardheader">
                </div>
                <div class="avatar">
                    <img alt="" src="http://lorempixel.com/100/100/people/9/">
                </div>
                <div class="info">
                    <div class="title">
                        <a target="_blank" href="{{ $buyer->website }}">{{ $buyer->company_name }}</a>
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
                                    <td>{{ $buyer->website }}</td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td>{{ $buyer->phone }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="bottom">
                    <a href="{{ url('/buyer/'.$buyer->user_id.'/edit') }}" title="Edit buyer">
                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
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
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Schedule
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Representatives</th>
                                <th>Seller</th>
                                <th>Venue</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($buyers as $buyer)
                                <tr>
                                    <td>{{ $buyer->event_name }}</td>
                                    <td>
                                        {{ $buyer->rep1 }}
                                        <br/>
                                        {{ $buyer->rep2 }}
                                    </td>
                                    <td>{{ $buyer->fname }} {{ $buyer->lname }}</td>
                                    <td>{{ $buyer->venue }}</td>
                                    <td>{{ $buyer->event_date }}</td>
                                    <td>{{ date('G:i A', strtotime($buyer->s_time)) }} - {{ date('G:i A', strtotime($buyer->e_time)) }}</td>
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
