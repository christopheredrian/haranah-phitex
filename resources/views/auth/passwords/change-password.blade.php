@extends('layouts.app-'.$role)
@section('title')
    Account
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel x_panel">
                    <div class="panel-heading">Change Password</div>
                    <div class="panel-body">

                        @if (Session::has('alert-class') && Session::has('flash_message'))
                            <div class="alert {!! session('alert-class') !!} alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-warning"></i>Alert!</h4>

                                <p>{!! session('flash_message') !!}</p>
                            </div>
                        @elseif (Session::has('flash_message'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-check"></i>Success!</h4>

                                <p>{!! session('flash_message') !!}</p>
                            </div>
                        @endif


                        <form method="POST" action="{{ url('/change-password') }}" accept-charset="UTF-8"
                              class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include ('auth.passwords.change-password-form')

                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection
