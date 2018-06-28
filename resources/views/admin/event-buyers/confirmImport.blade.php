@extends('layouts.app-admin')

@section('content')
    <div class="col-md-12">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="verificationModalLabel">Confirm Import for Buyers</h3>
                </div>
                <div class="modal-body">
                    <p id="newUsersParagraph" class="text-success"><strong>*</strong> Users highlighted in green are
                        <strong>NEW</strong> buyers. They will be registered in the system and will
                        be added
                        to the {{$event->event_name}} event.</p>
                    <p id="oldUsersParagraph" class="text-info"><strong>*</strong> Users highlighted in blue are
                        <strong>EXISTING</strong> buyers and
                        will be added
                        to the {{$event->event_name}} event.</p>

                    <p id="unverifiedUsersParagraph" class="text-danger"><strong>*</strong> Users highlighted in red are
                        <strong>EXISTING SELLERS</strong>
                        and are <strong>NOT BUYERS</strong>. They will not be imported and added to
                        the {{$event->event_name}}
                        event.</p>
                    <ul>
                        @foreach($buyers as $buyer)
                            @if ($buyer['isNew'])
                                <li class="text-success">
                            @elseif (!$buyer['isNew'] && $buyer['isVerifiedBuyer'])
                                <li class="text-info">
                            @else
                                <li class="text-danger">
                                    @endif
                                    {{$buyer['name']}} - {{$buyer['email']}} - {{$buyer['company']}}</li>
                                @endforeach
                    </ul>
                </div>

                <div class="modal-footer">
                    <a href="/admin/event-buyers/create/{{$event->id}}">
                        <button type="button" class="btn btn-secondary btn-primary">
                            Cancel Import
                        </button>
                    </a>
                    <a href="/importBuyersOrSellers">
                        <button type="button" class="btn btn-secondary btn-success">
                            Import Buyers
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection