@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Administrator {{ $administrator->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/administrators') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/administrators/' . $administrator->id . '/edit') }}" title="Edit Administrator"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/administrators' . '/' . $administrator->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Administrator" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>Last Name</th>
                                        <td>{{ $administrator->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>First Name</th>
                                        <td>{{ $administrator->first_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $administrator->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status:</th>
                                        <td>{{ ($administrator->activated > 0 ? "Activated" : "Deactivated") }}</td>
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
