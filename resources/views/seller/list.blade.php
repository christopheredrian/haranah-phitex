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


    </style>
@endsection

<!-- main content -->
@section('content')
<section class="content-header">
      <a href="home"><button class="btn btn-sm btn-primary "><span class="fa fa-caret-left"></span> Back to Home</button></a>
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
        <div class="row">
            <div class="col-md-5">
                <div class="box box-info">
                    <div class="box-header">List</div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <table id="buyer-list" class="display table table-responsive table-striped data-sortable">
                                    <thead>
                                    <tr>
                                        <th>Buyer Name</th>
                                        <th>Country</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($buyers as $buyer)
                                        <tr>
                                            <td> {{ $buyer->user->last_name.", ".$buyer->user->first_name }}</td>
                                            <td> {{ $buyer->country}}
                                                <input type="hidden" name="values[]" class="buyer-id"
                                                       value="{{ $buyer->id }}">

                                            </td>
                                            <!-- //pass $buyer->user_id-->
                                            <td class="action-btn-group">
                                                {{--<input type="button" class="btn btn-sm btn-primary" onclick="location.href='{{ $buyer->user_id }}/profile';" value="View Profile" />--}}
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal{{$buyer->id}}">View Profile</button>
                                                <button type="button" class="add-btn btn btn-sm btn-success"> Add to
                                                    List
                                                </button>
                                                <div class="modal fade" id="modal{{$buyer->id}}" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">REMINDER</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                phone{{ $buyer->phone }} <br>
                                                                country{{ $buyer->country }} <br>
                                                                company photo{{ $buyer->company_bg }} <br>
                                                                company logo{{ $buyer->company_logo }} <br>
                                                                comapny name{{ $buyer->company_name }} <br>
                                                                address{{ $buyer->company_address }} <br>

                                                                Event Representative 1{{ $buyer->event_rep1 }} <br>
                                                                Event Representative 2{{ $buyer->event_rep2 }} <br>
                                                                Designation{{ $buyer->designation }} <br>
                                                                Website{{ $buyer->website   }} <br>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Accept</button>
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
                    <div class="box-header">List of selected buyers</div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-12"><!-- Second Table Selected Buyer List-->
                                <div class="" id="selected-buyers">
                                    <table id="selected-buyer-table" class="display table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Sort</th>
                                            <th>Buyer Name</th>
                                            <th>Country</th>
                                            <th>Action</th>
                                            <th>Rank</th>
                                        </tr>
                                        </thead>
                                        <tbody id="preference_table">


                                        </tbody>
                                    </table>
                                    <form id="submit-form" action="/seller/submitPick"
                                          method="post">
                                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                                        {{ csrf_field() }}

                                        {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">--}}
                                        {{--Submit List</button>--}}
                                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
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

//            $('#buyer-list').DataTable({
//                paging: false,
//                "scrollY":        "200px",
//                "scrollCollapse": true
//            });
//            $('#selected-buyer-table').DataTable({
//                info: false,
//                paging: false,
//                "scrollY":        "200px",
//                "scrollCollapse": true,
//            });
            $('.dataTables_empty').remove();

            function updateHiddenInputs() {
                // add input type hidden
                $('#submit-form input.buyer-id').remove();
                $('#preference_table input.buyer-id').each(function (index, value) {
                    // for each of the input
                    $input = $(value).clone(true);
                    $input.val($input.val() + '-' + (index + 1));
                    $('#submit-form').append($input);
                });
                $('#preference_table tr').each(function(index, value){
                    $(this).find('td').last().text(index + 1);
                });
            }

            var util = function () {
                selectedCounter++;
                var currentElement = $(this).parent().parent();
                currentElement.find('button').remove();
                var removeBtn = $('<button class="btn btn-sm btn-danger">');
                removeBtn.text("Remove");

                // Append this element to above
                removeBtn.click(function () {
                    selectedCounter--;
                    var tdToRemove = $(this).parent().parent();
                    var addBtn = $('<button class="add-btn btn-sm btn btn-success">');
                    addBtn.text("Add to List");
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
        });
    </script>
@endsection
