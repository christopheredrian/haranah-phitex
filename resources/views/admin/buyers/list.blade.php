@extends('layouts.app-admin')

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
	<p> this is the main for the data tables</p>
	<div class="container">
		<table id="buyer-list" class="display">
		    <thead>
		        <tr>
		            <th>Buyer Name</th>
		            <th>Country</th>
		            <th>Action</th>
		        </tr>
		    </thead>
		    <tbody>
		        <tr>
	                <td>Mikoto Kusaki</td>
	                <td>Japan</td>
		        	<td>
		        		<button type="button" class="btn btn-md btn-primary">View Profile</button>
		        		<button type="button" class="btn btn-md btn-success">Add to List</button>
		        	</td>
		        </tr>
		        <tr>
                  <td>Juan Dela Cruz</td>
                  <td>Philippines</td>
                  <td>
		        		<button type="button" class="btn btn-md btn-primary">View Profile</button>
		        		<button type="button" class="btn btn-md btn-success">Add to List</button>
		        	</td>
                </tr>
                <tr>
                  <td>Jane Doe</td>
                  <td>USA</td>
                  <td>
		        		<button type="button" class="btn btn-md btn-primary">View Profile</button>
		        		<button type="button" class="btn btn-md btn-success">Add to List</button>
		        	</td>
                </tr>

		    </tbody>
		</table>
		<a href="javascript:showonlyone(selected-buyers)"><button class="btn btn-warning" >Done</button></a>
	</div>


	<!-- Second Table Selected Buyer List-->
	<div class="container" id="selected-buyers">	
	<p> this will show the list of selected buyers</p> 
		<table id="selected-buyer-list" class="display">
		    <thead>
		        <tr>
		            <th>Buyer Name</th>
		            <th>Country</th>
		            <th>Action</th>
		        </tr>
		    </thead>
		    <tbody>
		        <tr>
                  <td>Yuso Antenov</td>
                  <td>Russia</td>
                  <td><button type="button" class="btn btn-md btn-danger">Remove from list</button></td>
                </tr>
                 <tr>
                  <td>Solara Arceus</td>
                  <td>Italy</td>
                  <td><button type="button" class="btn btn-md btn-danger">Remove from list</button></td>
                </tr>
                <tr>
                  <td>Kimhara Cajun</td>
                  <td>Taiwan</td>
                  <td><button type="button" class="btn btn-md btn-danger">Remove from list</button></td>
                </tr>
                <tr>
                  <td>Shana Marie</td>
                  <td>Australia</td>
                  <td><button type="button" class="btn btn-md btn-danger">Remove from list</button></td>
                </tr>
                 <tr>
                  <td>Louise Branford</td>
                  <td>England</td>
                  <td><button type="button" class="btn btn-md btn-danger">Remove from list</button></td>
                </tr>
                <tr>
                  <td>Corell Mard</td>
                  <td>USA</td>
                  <td><button type="button" class="btn btn-md btn-danger">Remove from list</button></td>
                </tr>
		    </tbody>
		</table>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Submit List</button>



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
	</div>

@endsection

@section('scripts')

<script type="text/javascript" charset="utf8" src="/bower_components/DataTables/datatables.js"></script>
<script type="text/javascript" src="/bower_components/jquery-sortable/jquery-sortable.js"></script>
<script type="text/javascript">
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
