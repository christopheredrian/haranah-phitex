@extends('layouts.app-buyer')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">PROFILE</h4>
        </div>

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                <div class="panel-body">

                    {{--                        <a href="{{ url('/buyer/home') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>--}}
                    <a href="{{ url('/buyer/edit') }}" title="Edit buyer">
                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Edit
                        </button>
                    </a>

                    {{--<form method="POST" action="{{ url('buyer' . '/' . Auth::user()->id) }}" accept-charset="UTF-8" style="display:inline">--}}
                    {{--{{ method_field('DELETE') }}--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<button type="submit" class="btn btn-danger btn-xs" title="Delete buyer" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>--}}
                    {{--</form>--}}
                    <br/>
                    <br/>

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ Auth::user()->id }}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
