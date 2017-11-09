@extends('layouts.app-admin')

@section('styles')
<link rel="stylesheet" type="text/css" href="/bower_components/DataTables/datatables.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel x-panel">
                    <div class="panel-heading">Buyer {{ $buyer->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/buyers') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/buyers/' . $buyer->id . '/edit') }}" title="Edit Buyer"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/buyers' . '/' . $buyer->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Buyer" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr><th>First Name</th>
                                        <td>{{ $buyer->user->first_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Name</th>
                                        <td>{{ $buyer->user->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $buyer->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $buyer->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status:</th>
                                        <td>{{ ($buyer->user->activated > 0 ? "Activated" : "Deactivated") }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
