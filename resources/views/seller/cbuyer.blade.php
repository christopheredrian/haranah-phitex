@extends('layouts.app-buyer')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">PROFILE</h4>
        </div>

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $buyer->first_name }} {{ $buyer->last_name }}</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $buyer->id }}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $buyer->first_name }} {{ $buyer->last_name }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
