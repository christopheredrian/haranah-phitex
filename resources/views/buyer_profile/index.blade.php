@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-3">
                <div class="panel panel-default panel-flush">
                    <div class="panel-heading">
                        Buyer
                    </div>

                    <div class="panel-body">
                        <ul class="nav" role="tablist">
                            <li role="presentation">
                                <img src="https://maxcdn.icons8.com/Share/icon/Users//circled_user_female1600.png" style="width: 100%;">
                            </li>
                            <li role="presentation">
                                <a href="{{ url('/buyer_profile/profile') }}">
                                    Profile
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="{{ url('/admin') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="{{ url('/admin/buyers') }}">
                                    Buyers
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="{{ url('/admin/sellers') }}">
                                    Sellers
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="{{ url('/admin/events') }}">
                                    Events
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <img src="http://www.researchassociatesinc.com/RAI/media/RAIMedia/bizinvestigations.jpg" style="width: 100%">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <input type="email" class="form-control" placeholder="What are you up to?">
                    </div>
                    <div class="panel-footer">
                        <div class="btn-group">
                            <button type="button" class="btn btn-link btn-icon"><i class="fa fa-map-marker"></i>
                            </button>
                            <button type="button" class="btn btn-link btn-icon"><i class="fa fa-users"></i></button>
                            <button type="button" class="btn btn-link btn-icon"><i class="fa fa-camera"></i></button>
                            <button type="button" class="btn btn-link btn-icon"><i class="fa fa-video-camera"></i>
                            </button>
                        </div>

                        <div class="pull-right">
                            <button type="button" class="btn btn-success">Post</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Buyer_profile</div>
                    <div class="panel-body">
                        <a href="{{ url('/buyer_profile/create') }}" class="btn btn-success btn-sm"
                           title="Add New buyer_profile">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/buyer_profile') }}" accept-charset="UTF-8"
                              class="navbar-form navbar-right" role="search">
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
                        <div class="table">
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($buyer_profile as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>

                                        <td>
                                            <a href="{{ url('/buyer_profile/' . $item->id) }}"
                                               title="View buyer_profile">
                                                <button class="btn btn-info btn-xs"><i class="fa fa-eye"
                                                                                       aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                            <a href="{{ url('/buyer_profile/' . $item->id . '/edit') }}"
                                               title="Edit buyer_profile">
                                                <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                                          aria-hidden="true"></i> Edit
                                                </button>
                                            </a>

                                            <form method="POST" action="{{ url('/buyer_profile' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs"
                                                        title="Delete buyer_profile"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $buyer_profile->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
