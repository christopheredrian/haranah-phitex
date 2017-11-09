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
	<!-- List of All Buyers-->
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header">List</div>
					<div class="box-body">
						<div class="row">
							<div class="col-lg-12">
								<table id="buyer-list" class="display table table-responsive table-striped">
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
												<td> {{ $buyer->country }}
                                                    <input type="text" name="values[]" class="buyer-id" value="{{ $buyer->id }}">

                                                </td>

                                                <td class="action-btn-group">
                                                    <button type="button" class="btn btn-md btn-primary">View Profile</button>
                                                    <button type="button" class="add-btn btn btn-md btn-success">Add to List</button>
                                                </td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

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
                                    <form id="submit-form" action="/seller/events/{{ $event->id }}/submit" method="post">
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
		  <div class="modal fade" id="myModal" role="dialog">
		    <div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">REMINDER</h4>
		        </div>
		        <div class="modal-body">
		          <p>Lorem Ipsum...</p>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Accept</button>
		        </div>
		      </div>

		    </div>
		  </div>
	</div>s

@endsection

@section('scripts')

<script type="text/javascript" charset="utf8" src="/bower_components/DataTables/datatables.js"></script>
<script type="text/javascript" src="/bower_components/jquery-sortable/jquery-sortable.js"></script>
{{--<script type="text/javascript">--}}
    {{--var array = new Array();--}}
    {{--function printList(a,b,c) {--}}
        {{--var old_tbody=document.getElementById("preference_table");--}}
		{{--old_tbody.innerHTML='';--}}

		{{--array.push({last_name:a,first_name:b,id:c});--}}
        {{--printTable(array);--}}

    {{--}--}}

    {{--function printTable(array) {--}}
        {{--var table = document.getElementById("preference_table");--}}

        {{--for (var i = 0, len = array.length; i < len; i++) {--}}
            {{--var row = table.insertRow(0);--}}
            {{--var cell1 = row.insertCell(0);--}}
            {{--var cell2 = row.insertCell(1);--}}
            {{--var cell3 = row.insertCell(2);--}}
            {{--cell1.innerHTML=array[i].last_name+" "+array[i].first_name;--}}
            {{--cell3.innerHTML='<button type="button" class="btn btn-md btn-danger" onclick="removeFromList('+i+');">Remove from list</button>';--}}
        {{--}--}}
    {{--}--}}
    {{--function removeFromList(i){--}}
        {{--array.splice(i, 1);--}}
{{--//        var new_tbody = document.createElement('tbody');--}}
{{--//        new_tbody.id="preference_table";--}}
        {{--var old_tbody=document.getElementById("preference_table");--}}
{{--//        old_tbody.parentNode.replaceChild(new_tbody, old_tbody);--}}
		{{--old_tbody.innerHTML='';--}}
        {{--printTable(array);--}}




    {{--}--}}

	{{--$(document).ready(function() {--}}
    {{--$('#buyer-list').DataTable({--}}
    	{{--searching: true,--}}
    	{{--stateSave: true,--}}
    	{{--autoWidth : true,--}}
    	{{--pagingType: "simple",--}}
    {{--});--}}
    {{--$('#selected-buyer-list').DataTable({--}}
	    	{{--searching: false,--}}
	    	{{--stateSave: true,--}}
	    	{{--autoWidth : true,--}}
		    {{--lengthChange: false,--}}
		    {{--searching  : false,--}}
		    {{--ordering   : false,--}}
	    	{{--pagingType: "simple"--}}
	    {{--});--}}
	{{--$('#selected-buyer-list').sortable({--}}
		  {{--containerSelector: 'table',--}}
		  {{--itemPath: '> tbody',--}}
		  {{--itemSelector: 'tr',--}}
		  {{--placeholder: '<tr class="placeholder"/>'--}}
		{{--});--}}
{{--})--}}
{{--</script>--}}
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
    $(document).ready(function(){

        function updateHiddenInputs(){
            // add input type hidden
            $('#submit-form input.buyer-id').remove();
            $('#preference_table input.buyer-id').each(function(index, value){
                // for each of the input
                $input = $(value).clone(true);
                $input.val($input.val() + '-' + (index + 1));
                $('#submit-form').append($input);
            });
        }
        var util = function(){

            var currentElement = $(this).parent().parent();
            currentElement.find('button').remove();
            var removeBtn = $('<button class="btn btn-danger">');
            removeBtn.text("Remove");

            // Append this element to above
            removeBtn.click(function(){
                var tdToRemove = $(this).parent().parent();
                var addBtn = $('<button class="add-btn btn btn-success">');
                addBtn.text("Add to List");
                addBtn.click(util);
                tdToRemove.find('.action-btn-group').append(addBtn);
                tdToRemove.find('.btn-danger').remove();
                tdToRemove.appendTo('#buyer-list')
                updateHiddenInputs();
            });

            currentElement.prepend('<td><i class="fa fa-sort"></i></td>');
            currentElement.find('.action-btn-group').append(removeBtn);
            currentElement.append('<td class="rank">');
            $('#preference_table').append(currentElement);
            updateHiddenInputs();
        };

        $('.add-btn').on('click',util);

        /**
         * Sorting
         */
        $( "#preference_table" ).sortable( {
            update: function( event, ui ) {
                $(this).children().each(function(index) {
                    $(this).find('td').last().html(index + 1)
                });
            }
        });

        $( "#preference_table" ).on('sortchange sortreceive sortover ', function(){
            $('#preference_table').children().each(function(index) {
                $('#preference_table').find('td').last().html(index + 1)
            });
           updateHiddenInputs();
        });
    });
</script>
@endsection
