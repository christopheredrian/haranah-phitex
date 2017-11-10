@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Finalschedules</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/final-schedules/create') }}" class="btn btn-success btn-sm" title="Add New FinalSchedule">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {{--<form method="GET" action="{{ url('/admin/final-schedules') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">--}}
                            {{--<div class="input-group">--}}
                                {{--<input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">--}}
                                {{--<span class="input-group-btn">--}}
                                    {{--<button class="btn btn-default" type="submit">--}}
                                        {{--<i class="fa fa-search"></i>--}}
                                    {{--</button>--}}
                                {{--</span>--}}
                            {{--</div>--}}
                        {{--</form>--}}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Event</th><th>Buyer</th><th>Seller</th><th>Schedule</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach($finalschedules as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ \App\Event::where('id','=',$item->event_id)->first()->event_name }}</td>
                                        <td>{{ \App\User::where('id','=', \App\Buyer::where('id','=',$item->buyer_id)->first()->user_id)->first()->last_name.', '.\App\User::where('id','=', \App\Buyer::where('id','=',$item->buyer_id)->first()->user_id)->first()->first_name }}</td>
                                        <td>{{ \App\User::where('id','=', \App\Seller::where('id','=',$item->seller_id)->first()->user_id)->first()->last_name.', '. \App\User::where('id','=', \App\Seller::where('id','=',$item->seller_id)->first()->user_id)->first()->first_name }}</td>
                                        <td>{{ \App\EventParam::where('id','=',$item->event_param_id)->first()->start_time.'-'.\App\EventParam::where('id','=',$item->event_param_id)->first()->end_time }}</td>
                                        <td>
                                            {{--<a href="{{ url('/admin/final-schedules/' . $item->id) }}" title="View FinalSchedule"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>--}}
                                            <a href="{{ url('/admin/final-schedules/' . $item->id . '/edit') }}" title="Edit FinalSchedule"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/final-schedules' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete FinalSchedule" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $finalschedules->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                        <form id="submit-form" action="/admin/events/{{ $finalschedules->first()->event_id }}/finalizeSchedule" method="post">
                            {{ csrf_field() }}
                            {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">--}}
                            {{--Submit List</button>--}}
                            <button type="submit" class="btn btn-primary pull-right">Finalize Schedule</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
