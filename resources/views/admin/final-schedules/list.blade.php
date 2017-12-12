@extends('layouts.app-admin')

@section('content')
        <div class="row">


            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Finalschedules</div>
                    <div class="panel-body">
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
                                        <td>{{ $event }}</td>
                                        <td>{{ \App\Buyer::find($item->buyer_id)->company_name }}</td>
                                        <td>{{ \App\Seller::find($item->seller_id)->company_name }}</td>
                                        <td>{{ $schedule_list[$item->event_param_id] }}</td>
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
@endsection
