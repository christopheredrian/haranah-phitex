@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">FinalSchedule {{ $finalschedule->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/final-schedules') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/final-schedules/' . $finalschedule->id . '/edit') }}" title="Edit FinalSchedule"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/finalschedules' . '/' . $finalschedule->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete FinalSchedule" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $finalschedule->id }}</td>
                                    </tr>
                                    <tr><th> Event Id </th><td> {{ $finalschedule->event_id }} </td></tr><tr><th> Buyer Id </th><td> {{ $finalschedule->buyer_id }} </td></tr><tr><th> Seller Id </th><td> {{ $finalschedule->seller_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
