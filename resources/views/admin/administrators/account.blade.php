@extends('layouts.app-admin')
@section('styles')
    <style>
        td > * {
            float: left;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div>
                <div class="panel x_panel">
                    <div class="panel-heading">Administrators</div>
                    <div class="panel-body">
                        <a href="{{ url('admin/administrators/create') }}" class="btn btn-success btn-sm" title="Add New Administrator">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/administrators') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div>
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($administrators as $item)
                                    <tr>
                                        <td>{{ $item->last_name }}</td>
                                        <td>{{ $item->first_name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            <a href="{{ url('admin/administrators/' . $item->id) }}" title="View Administrator"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('admin/administrators/' . $item->id . '/edit') }}" title="Edit Administrator"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('admin/users' . '/' . $item->id . '/reset_password') }}" accept-charset="UTF-8" style="display:inline">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-warning btn-xs" title="Reset Password" onclick="return confirm('Send reset password via email?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Reset Password</button>
                                            </form>

                                            <form method="POST" action="{{ url('admin/administrators' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete Administrator" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $administrators->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
