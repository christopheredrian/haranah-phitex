@extends('layouts.app-seller')

@section('styles')
    <link rel="stylesheet" type="text/css" href="/bower_components/DataTables/datatables.css">
    <style type="text/css">
        body.dragging, body.dragging * {
            cursor: move !important;
        }

        .dragged {
            position: absolute;
            opacity: 0.5;
            z-index: 2000;
        }

        table#selected-buyer-list tr.placeholder {
            position: relative;
        }

        table#selected-buyer-list tr.placeholder:before {
            position: absolute;
        }

        .list-profile-modal .modal-dialog {
            max-width: 400px;
            margin: auto;
        }

        .list-profile-modal .modal-header {
            height: auto;
            background-position: center;
            -webkit-background-size: cover;
            background-size: cover;
            position: relative;
            overflow: hidden;
            padding-top: 60px;
        }

        .list-profile-modal .modal-header:before {
            background-color: rgba(0, 0, 0, 0.3);
            position: absolute;
            width: 100%;
            height: 300px;
            top: 0;
            left: 0;
        }

        .list-profile-modal .modal-body {
            padding-top: 30px;
        }

        .comapny-logo, .company-name {
            position: relative;
            z-index: 9;
        }

        .comapny-logo {
            width: 100px;
            height: 100px;
            overflow: hidden;
            border-radius: 50%;
            margin: auto;
        }

        .comapny-logo img {
            object-fit: cover;
            width: 100%;
            height: 100%;
            object-position: center;
        }

        .company-name h3 {
            font-weight: 700;
            color: #fff;
            margin: 15px 0 0 0;
        }

        .list-information {
            margin-bottom: 30px;
        }

        .list-information strong {
            margin-bottom: 5px;
            display: block;
        }

        .close-modal-btn {
            position: absolute;
            z-index: 9;
            right: 0;
            top: 0;
            color: #fff;
            background-color: transparent;
            font-size: 18px;
        }
    </style>
@endsection

<!-- main content -->
@section('content')
    <section class="content-header">
        <a href="/seller/home/{{ $event->id }}">
            <button class="btn btn-sm btn-primary"><span class="fa fa-caret-left"></span> Back to Home</button>
        </a>
    </section>

    <!-- List of All Buyers-->
    <div class="content">
        @if(session('status'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i>Alert!</h4>

                <p>{{session('status')}}</p>
            </div>
        @endif
        @if(session('flash_message'))
            <div class="alert alert-success">
                {{ session('flash_message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-5">
                <div class="box box-info">
                    <div class="box-header">List of Buyers</div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <table id="buyer-list"
                                       class="display table table-responsive table-striped data-sortable">
                                    <thead>
                                    <tr>
                                        <th>Company</th>
                                        <th>Country</th>
                                        <th class="col-xs-2">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($buyers as $buyer)
                                        <tr>
                                            <td> {{ $buyer->company_name }}</td>
                                            <td> {{ $buyer->country}}
                                                <input type="hidden" name="values[]" class="buyer-id"
                                                       value="{{ $buyer->id }}">

                                            </td>
                                            <!-- //pass $buyer->user_id-->
                                            <td class="action-btn-group">
                                                {{--<input type="button" class="btn btn-sm btn-primary" onclick="location.href='{{ $buyer->user_id }}/profile';" value="View Profile" />--}}
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                        data-target="#modal{{$buyer->id}}"><i class="fa fa-eye"></i>
                                                </button>
                                                <button type="button" class="add-btn btn btn-sm btn-success"
                                                        data-buyer="{{ $buyer->id }}"><i
                                                            class="fa fa-plus"></i>
                                                </button>
                                                <div class="list-profile-modal modal fade" id="modal{{$buyer->id}}"
                                                     role="dialog">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header"
                                                                 style="background-image: url('/img/default-bg.png')">

                                                                <button class="close-modal-btn btn"
                                                                        data-dismiss="modal"><i class="fa fa-times"></i>
                                                                </button>

                                                                <div class="comapny-logo">
                                                                    <img class="img-responsive"
                                                                         src="/img/mystery-man.png" alt="">
                                                                </div>

                                                                <div class="company-name">
                                                                    <h3 class="text-center">{{ $buyer->company_name }}</h3>
                                                                </div>

                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="row">
                                                                    <div class="col-sm-12 list-information">
                                                                        <strong class="text-uppercase">Contact</strong>
                                                                        <ul class="list-unstyled">
                                                                            <li><span>Phone: </span><a
                                                                                        href="tel: {{ $buyer->phone }}">{{ $buyer->phone }}</a>
                                                                            </li>
                                                                            <li><span>Email: </span><a
                                                                                        href="mailto: {{ $buyer->user->email }}">{{ $buyer->user->email }}</a>
                                                                            </li>
                                                                            <li><span>Website: </span><a
                                                                                        href="{{$buyer->website}}"
                                                                                        target="_blank">{{$buyer->website}}</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-sm-12 list-information">
                                                                        <strong class="text-uppercase">Description</strong>
                                                                        <ul class="list-unstyled">
                                                                            <li>
                                                                                <span>Address: </span>{{ $buyer->company_address }}
                                                                            </li>
                                                                            <li>
                                                                                <span>Country: </span>{{ $buyer->country }}
                                                                            </li>
                                                                            <li>
                                                                                <span>Designation: </span>{{ $buyer->designation }}
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-sm-12 list-information">
                                                                        <strong class="text-uppercase">Event
                                                                            Representatives</strong>
                                                                        <ul class="list-unstyled">
                                                                            <li>
                                                                                <span>Rep 1: </span>{{ $buyer->event_rep1 }}
                                                                            </li>
                                                                            <li>
                                                                                <span>Rep 2: </span>{{ $buyer->event_rep2 }}
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="box box-info">
                    <div class="box-header">List of Selected buyers</div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-12"><!-- Second Table Selected Buyer List-->
                                <div class="" id="selected-buyers">
                                    <table id="selected-buyer-table" class="display table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Sort</th>
                                            <th>Company</th>
                                            <th>Country</th>
                                            <th>Action</th>
                                            <th>Rank</th>
                                        </tr>
                                        </thead>
                                        <tbody id="preference_table">


                                        </tbody>
                                    </table>

                                    <form class="submit-form" action="/seller/submitPick"
                                          method="post">
                                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                                        {{ csrf_field() }}

                                        {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">--}}
                                        {{--Submit List</button>--}}
                                        <button onclick="return confirm('Are you sure you want to save your preference (This cannot be undone)')" type="submit" class="btn btn-primary pull-right" style="margin-left: 5px">Submit</button>
                                    </form>
                                    <form class="submit-form" action="/seller/cacheSellerPreference"
                                          method="post">
                                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                                        <input type="hidden" name="seller_id" value="{{ $seller->id }}">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-info pull-right">Save as Draft</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript" charset="utf8" src="/bower_components/DataTables/datatables.js"></script>
    <script type="text/javascript" src="/bower_components/jquery-sortable/jquery-sortable.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function () {
            // Global vars
            var selectedCounter = 0;

            $('.dataTables_empty').remove();

            function updateHiddenInputs() {
                // add input type hidden
                $('.submit-form input.buyer-id').remove();
                $('#preference_table input.buyer-id').each(function (index, value) {
                    // for each of the input
                    $input = $(value).clone(true);
                    $input.val($input.val() + '-' + (index + 1));
                    $('.submit-form').append($input);
                });
                $('#preference_table tr').each(function (index, value) {
                    $(this).find('td').last().text(index + 1);
                });
            }

            var util = function () {
                selectedCounter++;
                var currentElement = $(this).parent().parent();
                currentElement.find('button.add-btn').remove();
                var removeBtn = $('<button class="btn btn-sm btn-danger">');
                removeBtn.html("<i class=\"fa fa-times\"></i> ");

                // Append this element to above
                removeBtn.click(function () {
                    selectedCounter--;
                    var tdToRemove = $(this).parent().parent();
                    var addBtn = $('<button class="add-btn btn-sm btn btn-success">');
                    addBtn.html("<i class='fa fa-plus'></i>");
                    addBtn.click(util);
                    tdToRemove.find('.action-btn-group').append(addBtn);
                    tdToRemove.find('.btn-danger').remove();
                    tdToRemove.find('.fa-sort').remove();
                    tdToRemove.find('.sortBuyers').remove();
                    tdToRemove.find('.rank').remove();
                    tdToRemove.appendTo('#buyer-list')
                    updateHiddenInputs();
                });
                currentElement.prepend('<td class = "sortBuyers"><i class="fa fa-sort"></i></td>');
                currentElement.find('.action-btn-group').append(removeBtn);
                currentElement.append('<td class="rank">');
                $('#preference_table').append(currentElement);
                updateHiddenInputs();
            };

            $('.add-btn').on('click', util);

            /**
             * Sorting
             */
            $("#preference_table").sortable({
                update: function (event, ui) {
                    $(this).children().each(function (index) {
                        $(this).find('td').last().html(index + 1)
                    });
                    updateHiddenInputs();
                }
            });

            $("#preference_table").on('sortchange sortreceive sortover ', function () {
                $('#preference_table').children().each(function (index) {
                    $('#preference_table').find('td').last().html(index + 1)
                });
                updateHiddenInputs();
            });

            var buyerValues = "{{ $seller_cache->buyer_ids or '' }}";
            if (buyerValues) {
                buyerValues = buyerValues.split(',');
            } else {
                buyerValues = [];
            }
            $.each($('button.add-btn'), function (index, value) {
                $button = $(value);
                $current_id = $button.data('buyer') + ''; //convert to string
                if (buyerValues.indexOf($current_id) > -1) {
                    $button.click();
                }
            })

        });
    </script>
@endsection
