@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Event {{ $event->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/events') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/events/' . $event->id . '/edit') }}" title="Edit Event"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/events' . '/' . $event->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Event" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>

                        <a href="#"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#myViewSellerModal">Show Sellers</button></a>
                        <a href="#"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#myViewBuyerModal">Show Buyers</button></a>
                        <br>
                        <a href="{{ url('admin/event-params/create') }}" title="Add Param"><button class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Add Params </button></a>
                        <a href="{{ route('create.event.buyers', ['event_id' => $event->id]) }}" title="Add Buyers"><button class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Add Buyers </button></a>
                        <a href="{{ route('create.event.sellers', ['event_id' => $event->id]) }}" title="Add Sellers"><button class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Add Sellers </button></a>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $event->id }}</td>
                                    </tr>
                                    <tr><th> Event Name </th><td> {{ $event->event_name }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="modal fade in" id="myViewSellerModal" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">SELLER</h4>
                                </div>

                                    <!-- LOOP content -->
                                <div class="modal-body">
                                   
                                </div>

                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Accept</button>
                                </div>
                        </div>
                    </div>
                </div>

                        <div class="modal fade in" id="myViewBuyerModal" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">BUYER</h4>
                                </div>
                                <div class="modal-body">
                                 <ol>
                                    @foreach($eventbuyers as $item)
                                    <p> true </p>
                                    <li> {{$item->first()->last_name}}</li>   
                                    @endforeach 
                                </ol>
                                </div>
                                
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Accept</button>
                                </div>
                        </div>
                    </div>
                </div>
              
            </div>
          </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
