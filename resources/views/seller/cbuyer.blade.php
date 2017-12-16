@extends('layouts.app-seller') 

@section('content')
<section class="content-header">
    <a href="/seller/pick"><button class="btn btn-lg btn-primary "><span class="fa fa-caret-left"></span> Back to Home</button></a>
</section>
<!-- List of All Buyers-->
<div class="content">
    <div class="row">
        <div class="col-md-12">
                        <div class="col-lg-12">

                            <div class="box box-primary">
                                <div class="box-header">Profile of: {{ $buyer->user->first_name }} {{ $buyer->user->last_name }}</div>
                            <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="/uploads/buyer-{{ $buyer->id }}.jpg" alt="User profile picture">

                            <h3 class="profile-username text-center">{{ $buyer->company_name }}</h3>


                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Address</b> <a class="pull-right">{{ $buyer->company_address }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Representative 1</b> <a class="pull-right">{{ $buyer->event_rep1 }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Representative 2</b> <a class="pull-right">{{ $buyer->event_rep2 }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Designation</b> <a class="pull-right">{{ $buyer->designation }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Representative 2</b> <a href="{{ $buyer->website }}" class="pull-right">{{ $buyer->website }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>


@endsection
