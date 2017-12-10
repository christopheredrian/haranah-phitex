@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="x_panel">
                    <div class="panel-heading">Create New Buyer</div>
                    <div class="panel-body">
                        <a href="{{ url('admin/buyers') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a  id="createButton" class="btn btn-info btn-sm" title="Import from Excel">
                            <i class="fa fa-plus" aria-hidden="true"></i> Create
                        </a>
                        <a  id="excelImportButton" class="btn btn-success btn-sm" title="Import from Excel">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i> Import from Excel
                        </a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form id="createForm" method="POST" action="{{ url('admin/buyers') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.buyers.form')

                        </form>

                        @include('admin.userexport')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
