@extends('layouts.app-admin')

@section('styles')
    <style>
        .label{
            display: block;
            padding: 7px;
            max-width: 115px;
        }
    </style>

@endsection
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="x_panel">
                    <h1 class="x_title">Events
                        <a href="{{ url('/admin/events/create') }}" class="btn btn-success btn-small pull-right" title="Add New Event">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                    </h1>
                    <div class="panel-body">
                        <form method="GET" action="{{ url('/admin/events') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Place</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach($events as $item)
                                    <tr>
                                        <td>{{ $item->event_name }}</td>
                                        <td>{{ $item->event_date }} </td>
                                        <td>{{ $item->event_place }}</td>
                                        <td><span class="{{ $item->getLabelClass() }}">{{ $item->event_status }}</span></td>
                                        <td>
                                            <a href="{{ url('/admin/events/' . $item->id) }}" title="View Event"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/events/' . $item->id . '/edit') }}" title="Edit Event"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <a id="mymodal" type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Are you sure?</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="form-group">
                                                            <label for="comment">Reason for Deleting:</label>
                                                            <textarea class="form-control" rows="5" id="comment"></textarea>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST" action="{{ url('/admin/events' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $events->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
