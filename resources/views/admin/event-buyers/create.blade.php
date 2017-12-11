@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New EventBuyer</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/event-buyers') }}" title="Back"><button class="btn btn-warning btn-xs">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a  id="createButton" class="btn btn-info btn-xs" title="Import from Excel">
                            <i class="fa fa-plus" aria-hidden="true"></i> Create
                        </a>
                        <a  id="excelImportButton" class="btn btn-success btn-xs" title="Import from Excel">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i> Import from Excel or CSV
                        </a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="aler.pt alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form id="createForm" method="POST" action="{{ url('/admin/event-buyers') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.event-buyers.form')

                        </form>

                        <form id="fileExport" action="/importBuyersOrSellers" enctype="multipart/form-data" method="POST"
                              accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            {{ csrf_field() }}
                            <input id="user_type" type="hidden" name="user_type" value="buyer">
                            <input id="event_id" type="hidden" name="event_id" value="{{$event_id}}">
                            @include('admin.userexport')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
