@extends('layouts.app-admin')

@section('content')
    <div class="col-md-12">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="verificationModalLabel">Confirm Import for Sellers</h3>
                </div>
                <div class="modal-body">
                    <p id="newUsersParagraph" class="text-success"><strong>*</strong> Users highlighted in green are
                        <strong>NEW</strong> sellers. They will be registered in the system and will
                        be added
                        to the {{$event->event_name}} event.</p>
                    <p id="oldUsersParagraph" class="text-info"><strong>*</strong> Users highlighted in blue are
                        <strong>EXISTING</strong> sellers and
                        will be added
                        to the {{$event->event_name}} event.</p>

                    <p id="unverifiedUsersParagraph" class="text-danger"><strong>*</strong> Users highlighted in red are
                        <strong>EXISTING BUYERS</strong>
                        and are <strong>NOT SELLERS</strong>. They will not be imported and added to
                        the {{$event->event_name}}
                        event.</p>
                    <ul>
                        @foreach($sellers as $seller)
                            @if ($seller['isNew'])
                                <li class="text-success">
                            @elseif (!$seller['isNew'] && $seller['isVerifiedSeller'])
                                <li class="text-info">
                            @else
                                <li class="text-danger">
                                    @endif
                                    {{$seller['name']}} - {{$seller['email']}} - {{$seller['company']}}</li>
                                @endforeach
                    </ul>
                </div>

                <div class="modal-footer">
                    <a href="/admin/event-sellers/create/{{$event->id}} ">
                        <button type="button" class="btn btn-secondary btn-primary">
                            Cancel Import
                        </button>
                    </a>
                    <a href="/importBuyersOrSellers">
                        <button type="button" class="btn btn-secondary btn-success">
                            Import Sellers
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{--<script>--}}
    {{--$(document).ready(function () {--}}
    {{--$("#importButton").change(function (e) {--}}
    {{--$.ajaxSetup({--}}
    {{--headers: {--}}
    {{--'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')--}}
    {{--}--}}
    {{--});--}}

    {{--e.preventDefault();--}}

    {{--$.ajax({--}}

    {{--type: 'POST',--}}
    {{--url: '/verifyUsers',--}}
    {{--data: {--}}
    {{--_token: '{{csrf_token()}}'--}}
    {{--},--}}
    {{--}).then(function (data) {--}}
    {{--for (i = 0; i < data.length; i++) {--}}
    {{--var newItem = $("<li></li>").text(data[i]['name'] + ' - ' + data[i]['email'] + ' - ' + data[i]['company']);--}}
    {{--if (data[i]['isNew']) {--}}
    {{--$('#newUsersList').append(newItem);--}}
    {{--} else if (!$data[$i]['isNew'] && $data[$i]['isVerifiedSeller']) {--}}
    {{--$('#oldUsersList').append(newItem);--}}
    {{--} else {--}}
    {{--$('#unverifiedUsersList').append(newItem);--}}
    {{--}--}}
    {{--}--}}

    {{--$("#verificationButton").click();--}}

    {{--}).catch(function () {--}}
    {{--alert('there was an error');--}}
    {{--});--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}
@endsection