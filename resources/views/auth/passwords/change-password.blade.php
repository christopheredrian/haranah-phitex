@extends('layouts.app-'.$role)

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <div class="panel x_panel">
                    <div class="panel-heading">Change Password</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif




                        <form method="POST" action="{{ url('/change-password') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('auth.passwords.change-password-form')

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection