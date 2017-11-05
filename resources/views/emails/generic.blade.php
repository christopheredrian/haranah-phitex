@extends('layouts.mail')

@section('content')
    <h2 class="page-header">{{ $data['subject'] }}</h2>

    {!! $data['body'] !!}

@endsection
