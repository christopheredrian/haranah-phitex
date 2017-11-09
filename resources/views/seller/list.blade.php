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
								<table id="buyer-list" class="display">
									<thead>
										<tr>
											<th>Buyer Name</th>
											<th>Country</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($buyers as $item)
											<tr>
												<td> {{ $item->last_name.", ".$item->first_name }}</td>
												<td> {{ $item->country }}</td>

											<td>
												<button type="button" class="btn btn-md btn-primary">View Profile</button>
												<button type="button" class="btn btn-md btn-success" onclick="printList('{{$item->last_name}}','{{$item->first_name}}','{{$item->id}}')">Add to List</button>
											</td>
											</tr>
										@endforeach
									</tbody>
								</table>
								<a href="javascript:showonlyone(selected-buyers)"><button class="btn btn-warning" >Done</button></a>
							</div>
						</div>
					</div>
				</div>

				<div class="box box-info">
					<div class="box-header">List of selected buyers</div>
					<div class="box-body">
						<div class="row">
							<div class="col-lg-12"><!-- Second Table Selected Buyer List-->
								<div class="container" id="selected-buyers">
									<table id="selected-buyer-list" class="display">
										<thead>
											<tr>
												<th>Buyer Name</th>
												<th>Country</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="preference_table">


										</tbody>
									</table>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Submit List</button>
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
<script type="text/javascript">
    var array = new Array();
    function printList(a,b,c) {
        var old_tbody=document.getElementById("preference_table");
		old_tbody.innerHTML='';

		array.push({last_name:a,first_name:b,id:c});
        printTable(array);

    }

    function printTable(array) {
        var table = document.getElementById("preference_table");

        for (var i = 0, len = array.length; i < len; i++) {
            var row = table.insertRow(0);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            cell1.innerHTML=array[i].last_name+" "+array[i].first_name;
            cell3.innerHTML='<button type="button" class="btn btn-md btn-danger" onclick="removeFromList('+i+');">Remove from list</button>';
        }
    }
    function removeFromList(i){
        array.splice(i, 1);
//        var new_tbody = document.createElement('tbody');
//        new_tbody.id="preference_table";
        var old_tbody=document.getElementById("preference_table");
//        old_tbody.parentNode.replaceChild(new_tbody, old_tbody);
		old_tbody.innerHTML='';
        printTable(array);




    }

	$(document).ready(function() {
    $('#buyer-list').DataTable({
    	searching: true,
    	stateSave: true,
    	autoWidth : true,
    	pagingType: "simple",
    });
    $('#selected-buyer-list').DataTable({
	    	searching: false,
	    	stateSave: true,
	    	autoWidth : true,
		    lengthChange: false,
		    searching  : false,
		    ordering   : false,
	    	pagingType: "simple"
	    });
	$('#selected-buyer-list').sortable({
		  containerSelector: 'table',
		  itemPath: '> tbody',
		  itemSelector: 'tr',
		  placeholder: '<tr class="placeholder"/>'
		});
})
</script>
@endsection
