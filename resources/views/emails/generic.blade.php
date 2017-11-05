@extends('layouts.mail')

@section('content')
    <h2 class="page-header">Email from Haranah</h2>
    <p>
        {{ $data['body']}}
    </p>
@endsection
