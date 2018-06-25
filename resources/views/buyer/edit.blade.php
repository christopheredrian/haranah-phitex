{{--@extends('layouts.app-buyer')--}}

{{--@section('content')--}}

        <div class="panel panel-default">
            <div class="panel-heading">Profile</div>
            <div class="panel-body">

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form method="POST" action="{{ url('buyer/submit')}}" accept-charset="UTF-8"
                      class="form-horizontal" enctype="multipart/form-data">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}

                    @include ('buyer.form', ['submitButtonText' => 'Update'])

                </form>

            </div>
        </div>

{{--@endsection--}}
