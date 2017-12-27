@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel x_panel">
                    <div class="panel-heading">Company: {{ $seller->company_name }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/sellers') }}" title="Back">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <a href="{{ url('/admin/sellers/' . $seller->id . '/edit') }}" title="Edit Seller">
                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>

                        <form method="POST" action="{{ url('admin/sellers' . '/' . $seller->id) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Seller"
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
                                    <td>{{ $seller->company_name}}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>{{ $seller->country }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $seller->company_address }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $seller->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Event Representatives</th>
                                    <td>{{ $seller->event_rep1 }}</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>{{ $seller->event_rep2 }}</td>
                                </tr>
                                <tr>
                                    <th>Products</th>
                                    <td>{{ $seller->products}}</td>
                                </tr>
                                <tr>
                                    <th>Designation</th>
                                    <td>{{ $seller->designation}}</td>
                                </tr>
                                <tr>
                                    <th>Website</th>
                                    <td>{{ $seller->website}}</td>
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
