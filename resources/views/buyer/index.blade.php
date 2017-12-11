@extends('layouts.app-buyer')

@section('content')

    <div class="row">

        <div class="col-md-12">
            <h4 class="page-head-line">DASHBOARD</h4>
        </div>

        <div class="col-md-12">
            <!--    Hover Rows  -->
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
                                <th>Seller</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($buyers as $buyer)
                                <tr>
                                    <td>{{ $buyer->event_name }}</td>
                                    <td>{{ $buyer->seller_id }}</td>
                                    <td>{{ $buyer->event_date }}</td>
                                    <td>{{ $buyer->s_time }}</td>
                                    <td>{{ $buyer->e_time }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End  Hover Rows  -->
        </div>
    </div>
@endsection
