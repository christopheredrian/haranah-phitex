@extends('layouts.app-buyer')

@section('content')
    <div class="col-md-12">
        <h4 class="page-head-line">EDIT</h4>
    </div>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">{{ $buyer->user->first_name }} {{ $buyer->user->last_name }}</div>
            <div class="panel-body">
                <a href="{{ url('/buyer/'.Auth::user()->id.'/profile') }}" title="Back">
                    <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                    </button>
                </a>
                <br/>
                <br/>

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form method="POST" action="{{ url('/buyer/' . $buyer->id) }}" accept-charset="UTF-8"
                      class="form-horizontal" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}

                    @include ('buyer.form', ['submitButtonText' => 'Update'])

                </form>

            </div>
        </div>
    </div>

@endsection
