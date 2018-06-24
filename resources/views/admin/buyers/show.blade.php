@extends('layouts.app-admin')

@section('styles')
    <link rel="stylesheet" type="text/css" href="/bower_components/DataTables/datatables.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel x-panel">
                    <div class="x_title">Buyer {{ $buyer->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/buyers') }}" title="Back">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <a href="{{ url('/admin/buyers/' . $buyer->id . '/edit') }}" title="Edit Buyer">
                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>

                        <form method="POST" action="{{ url('admin/buyers' . '/' . $buyer->id) }}" accept-charset="UTF-8"
                              style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Buyer"
                                    onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                                                                             aria-hidden="true"></i>
                                Delete
                            </button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">

                                <tbody>
                                <tr>
                                    <th>Company Name</th>
                                    <td>{{ $buyer->company_name}}</td>
                                </tr>
                                <tr>
                                    <th>Company Address</th>
                                    <td>{{ $buyer->company_address}}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>{{ $buyer->country}}</td>
                                </tr>
                                <tr>
                                    <th>Website</th>
                                    <td>{{ $buyer->website}}</td>
                                </tr>

                                <tr>
                                    <th>Contact Number</th>
                                    <td>{{ $buyer->phone}}</td>
                                </tr>
                                <tr>
                                    <th>Event Representatives</th>
                                    <td>{{ $buyer->event_rep1}}</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>{{ $buyer->event_rep2}}</td>
                                </tr>
                                <tr>
                                    <th>Designation</th>
                                    <td>{{ $buyer->designation}}</td>
                                </tr>


                                {{-- company_name,  company_address, country  phone, , event, event_rep1,
                            event_rep2, designation, website--}}

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
