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
                    <h1 class="x_title">Sellers
                        <a href="{{ url('admin/sellers/create') }}" class="btn btn-success btn-small pull-right" title="Add New Seller">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                    </h1>
                    <div class="panel-body">
                        <form method="GET" action="{{ url('admin/sellers') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ Request::get('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <div class="x_content">
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Contact #</th>
                                    <th>Representative 1</th>
                                    <th>Representative 2</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sellers as $seller)
                                    <tr>
                                        <td>{{ $seller->company_name }}</td>
                                        <td>{{ $seller->phone }}</td>
                                        <td>{{ $seller->event_rep1 }}</td>
                                        <td>{{ $seller->event_rep2 }}</td>
                                        <td>{{ $seller->user->email }}</td>
                                        <td>
                                            <a href="{{ url('admin/sellers/' . $seller->id) }}" title="View Buyer">
                                                <button class="btn btn-info btn-xs"><i class="fa fa-eye"
                                                                                       aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                            {{--<a href="{{ url('admin/buyers/' . $buyer->id. '/edit') }}"--}}
                                            {{--title="Edit Buyer">--}}
                                            {{--<button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"--}}
                                            {{--aria-hidden="true"></i> Edit--}}
                                            {{--</button>--}}
                                            {{--</a>--}}
                                            <form method="POST"
                                                  action="{{ url('admin/users' . '/' . $seller->user->id . '/reset_password') }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-warning btn-xs"
                                                        title="Reset Password"
                                                        onclick="return confirm('Send reset password via email?')"><i
                                                            class="fa fa-envelope" aria-hidden="true"></i> Reset
                                                    Password
                                                </button>
                                            </form>
                                            {{--<form method="POST" action="{{ url('admin/buyers' . '/' . $buyer->id) }}"--}}
                                            {{--accept-charset="UTF-8" style="display:inline">--}}
                                            {{--{{ method_field('DELETE') }}--}}
                                            {{--{{ csrf_field() }}--}}
                                            {{--<button type="submit" class="btn btn-danger btn-xs" title="Delete Buyer"--}}
                                            {{--onclick="return confirm('Confirm delete?')"><i--}}
                                            {{--class="fa fa-trash-o" aria-hidden="true"></i> Delete--}}
                                            {{--</button>--}}
                                            {{--</form>--}}
                                            <form method="POST" action="{{ url('/change-status/'.$seller->user->id) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ csrf_field() }}
                                                <button type="submit"
                                                        class="btn {{ $seller->user->activated === 1 ? 'btn-danger' : 'btn-success'  }} btn-xs"
                                                        title="{{ $seller->user->activated > 0 ? 'Deactivate Buyer' : 'Activate Buyer' }}"
                                                        onclick="return confirm('Deactivate/Activate User?')"
                                                        aria-hidden="true">
                                                    <i class="fa fa-bell" aria-hidden="true"></i>

                                                    {{ $seller->user->activated > 0 ? 'Deactivate' : 'Activate' }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $sellers->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
