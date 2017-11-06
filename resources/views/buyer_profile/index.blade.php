@extends('layouts.app-buyer')

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">

                        <div class="header">
                            <h4 class="title">Email Statistics</h4>
                            <p class="category">Last Campaign Performance</p>
                        </div>
                        <div class="content">
                            <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

                            <div class="footer">
                                <div class="legend">
                                    <i class="fa fa-circle text-info"></i> Open
                                    <i class="fa fa-circle text-danger"></i> Bounce
                                    <i class="fa fa-circle text-warning"></i> Unsubscribe
                                </div>
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Users Behavior</h4>
                            <p class="category">24 Hours performance</p>
                        </div>
                        <div class="content">
                            <div id="chartHours" class="ct-chart"></div>
                            <div class="footer">
                                <div class="legend">
                                    <i class="fa fa-circle text-info"></i> Open
                                    <i class="fa fa-circle text-danger"></i> Click
                                    <i class="fa fa-circle text-warning"></i> Click Second Time
                                </div>
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-history"></i> Updated 3 minutes ago
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-6">
                    <div class="card ">
                        <div class="header">
                            <h4 class="title">2014 Sales</h4>
                            <p class="category">All products including Taxes</p>
                        </div>
                        <div class="content">
                            <div id="chartActivity" class="ct-chart"></div>

                            <div class="footer">
                                <div class="legend">
                                    <i class="fa fa-circle text-info"></i> Tesla Model S
                                    <i class="fa fa-circle text-danger"></i> BMW 5 Series
                                </div>
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-check"></i> Data information certified
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card ">
                        <div class="header">
                            <h4 class="title">Tasks</h4>
                            <p class="category">Backend development</p>
                        </div>
                        <div class="content">
                            <div class="table-full-width">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <input id="checkbox1" type="checkbox">
                                                <label for="checkbox1"></label>
                                            </div>
                                        </td>
                                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                                        <td class="td-actions text-right">
                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <input id="checkbox2" type="checkbox" checked>
                                                <label for="checkbox2"></label>
                                            </div>
                                        </td>
                                        <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                                        <td class="td-actions text-right">
                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <input id="checkbox3" type="checkbox">
                                                <label for="checkbox3"></label>
                                            </div>
                                        </td>
                                        <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                                        </td>
                                        <td class="td-actions text-right">
                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <input id="checkbox4" type="checkbox" checked>
                                                <label for="checkbox4"></label>
                                            </div>
                                        </td>
                                        <td>Create 4 Invisible User Experiences you Never Knew About</td>
                                        <td class="td-actions text-right">
                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <input id="checkbox5" type="checkbox">
                                                <label for="checkbox5"></label>
                                            </div>
                                        </td>
                                        <td>Read "Following makes Medium better"</td>
                                        <td class="td-actions text-right">
                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <input id="checkbox6" type="checkbox" checked>
                                                <label for="checkbox6"></label>
                                            </div>
                                        </td>
                                        <td>Unfollow 5 enemies from twitter</td>
                                        <td class="td-actions text-right">
                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="footer">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-history"></i> Updated 3 minutes ago
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="container">--}}
        {{--<div class="row">--}}

            {{--<div class="col-md-3">--}}
                {{--<div class="panel panel-default panel-flush">--}}
                    {{--<div class="panel-heading">--}}
                        {{--Buyer--}}
                    {{--</div>--}}

                    {{--<div class="panel-body">--}}
                        {{--<ul class="nav" role="tablist">--}}
                            {{--<li role="presentation">--}}
                                {{--<img src="https://maxcdn.icons8.com/Share/icon/Users//circled_user_female1600.png" style="width: 100%;">--}}
                            {{--</li>--}}
                            {{--<li role="presentation">--}}
                                {{--<a href="{{ url('/buyer_profile/profile') }}">--}}
                                    {{--Profile--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li role="presentation">--}}
                                {{--<a href="{{ url('/admin') }}">--}}
                                    {{--Dashboard--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li role="presentation">--}}
                                {{--<a href="{{ url('/admin/buyers') }}">--}}
                                    {{--Buyers--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li role="presentation">--}}
                                {{--<a href="{{ url('/admin/sellers') }}">--}}
                                    {{--Sellers--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li role="presentation">--}}
                                {{--<a href="{{ url('/admin/events') }}">--}}
                                    {{--Events--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-md-6">--}}
                {{--<img src="http://www.researchassociatesinc.com/RAI/media/RAIMedia/bizinvestigations.jpg" style="width: 100%">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-body">--}}
                        {{--<input type="email" class="form-control" placeholder="What are you up to?">--}}
                    {{--</div>--}}
                    {{--<div class="panel-footer">--}}
                        {{--<div class="btn-group">--}}
                            {{--<button type="button" class="btn btn-link btn-icon"><i class="fa fa-map-marker"></i>--}}
                            {{--</button>--}}
                            {{--<button type="button" class="btn btn-link btn-icon"><i class="fa fa-users"></i></button>--}}
                            {{--<button type="button" class="btn btn-link btn-icon"><i class="fa fa-camera"></i></button>--}}
                            {{--<button type="button" class="btn btn-link btn-icon"><i class="fa fa-video-camera"></i>--}}
                            {{--</button>--}}
                        {{--</div>--}}

                        {{--<div class="pull-right">--}}
                            {{--<button type="button" class="btn btn-success">Post</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}


            {{--<div class="col-md-3">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Buyer_profile</div>--}}
                    {{--<div class="panel-body">--}}
                        {{--<a href="{{ url('/buyer_profile/create') }}" class="btn btn-success btn-sm"--}}
                           {{--title="Add New buyer_profile">--}}
                            {{--<i class="fa fa-plus" aria-hidden="true"></i> Add New--}}
                        {{--</a>--}}

                        {{--<form method="GET" action="{{ url('/buyer_profile') }}" accept-charset="UTF-8"--}}
                              {{--class="navbar-form navbar-right" role="search">--}}
                            {{--<div class="input-group">--}}
                                {{--<input type="text" class="form-control" name="search" placeholder="Search...">--}}
                                {{--<span class="input-group-btn">--}}
                                    {{--<button class="btn btn-default" type="submit">--}}
                                        {{--<i class="fa fa-search"></i>--}}
                                    {{--</button>--}}
                                {{--</span>--}}
                            {{--</div>--}}
                        {{--</form>--}}

                        {{--<br/>--}}
                        {{--<br/>--}}
                        {{--<div class="table">--}}
                            {{--<table class="table table-borderless">--}}
                                {{--<thead>--}}
                                {{--<tr>--}}
                                    {{--<th>#</th>--}}
                                    {{--<th>Actions</th>--}}
                                {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tbody>--}}
                                {{--@foreach($buyer_profile as $item)--}}
                                    {{--<tr>--}}
                                        {{--<td>{{ $loop->iteration or $item->id }}</td>--}}

                                        {{--<td>--}}
                                            {{--<a href="{{ url('/buyer_profile/' . $item->id) }}"--}}
                                               {{--title="View buyer_profile">--}}
                                                {{--<button class="btn btn-info btn-xs"><i class="fa fa-eye"--}}
                                                                                       {{--aria-hidden="true"></i> View--}}
                                                {{--</button>--}}
                                            {{--</a>--}}
                                            {{--<a href="{{ url('/buyer_profile/' . $item->id . '/edit') }}"--}}
                                               {{--title="Edit buyer_profile">--}}
                                                {{--<button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"--}}
                                                                                          {{--aria-hidden="true"></i> Edit--}}
                                                {{--</button>--}}
                                            {{--</a>--}}

                                            {{--<form method="POST" action="{{ url('/buyer_profile' . '/' . $item->id) }}"--}}
                                                  {{--accept-charset="UTF-8" style="display:inline">--}}
                                                {{--{{ method_field('DELETE') }}--}}
                                                {{--{{ csrf_field() }}--}}
                                                {{--<button type="submit" class="btn btn-danger btn-xs"--}}
                                                        {{--title="Delete buyer_profile"--}}
                                                        {{--onclick="return confirm(&quot;Confirm delete?&quot;)"><i--}}
                                                            {{--class="fa fa-trash-o" aria-hidden="true"></i> Delete--}}
                                                {{--</button>--}}
                                            {{--</form>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                {{--@endforeach--}}
                                {{--</tbody>--}}
                            {{--</table>--}}
                            {{--<div class="pagination-wrapper"> {!! $buyer_profile->appends(['search' => Request::get('search')])->render() !!} </div>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
