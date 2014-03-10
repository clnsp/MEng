

<!-- 	<div class="row">
		<h1>Manage Hall</h1>
	</div>
-->
<div class="row">
		<div class="col-md-6">
				<div id="manage-add-sports" class="">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Add New Sport</h3>
							
						</div>
						<div class="panel-body">
						<p>Sports can be assigned to divisible rooms only</p>
							
							<form id="add-sport-type-form" class="prevent" role="form">
								<div class="form-group">
									<label for="class_type">Title</label>
									<input name="class_type" type="text" class="form-control" placeholder="Sport Title">
								</div>
	
								<div class="form-group">
									<label for="class_category">Category</label>
									<select name="category_id" type="dropdown" class="categories form-control"></select>
								</div>
	
								<div class="form-group">
									<label for="class_description">Description</label>
									<textarea name="class_description" class="form-control" rows="3"></textarea>
								</div>
	
								<div class="form-group">
									<button type="submit" class="btn btn-default">Add Class Type</button>
								</div>
							</form>
	
	
						</div>
					</div>
	
				</div>
	
			</div>
			<div class="col-md-6">
			<div id="manage-classes" class="">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Manage Class Types</h3>
							</div>
							<div class="panel-body ">						
			
								<table id='class-types-table' class="sportsclasstype footable table table-bordered table-striped table-hover scroll">
									<thead>
										<tr>
											<th >Title</th>
											<th data-hide="phone, tablet">Description</th>
											<th>Category</th>
										</tr>
									</thead>
			
									<tbody class="manage-panel"></tbody>
			
								</table>
							</div>
			
						</div>
					</div>
			
				</div>
					</div>
			
</div>



<div class="row">

	<div id="manage-divisible-room" class="panel panel-default ">
		<div class="panel-heading"><h3 class="panel-title">Manage Rooms</h3></div>
		<div class="panel-body">

			<div>

				<div class="form-group">
					<form id="manage-divisible-room-form" class="form-horizontal prevent" role="form">


						<div class="col-xs-10">
							<select name="room_id" type="dropdown" class="rooms form-control"></select>

						</div>
						<div class="col-xs-2 no-pad-right no-pad-left">
							<button type="submit" class="btn btn-primary">Save Setup</button>
						</div>

					</form>

				</div>

				
				<div class="">
					<div id="divisible-room"></div>

					<button id="add-col" type="button" class="btn btn-default pull-left">
						<span class="glyphicon glyphicon-plus"></span>
						<span class="glyphicon glyphicon-resize-horizontal"></span>
					</button>

					<button id="del-col" type="button" class="btn btn-default pull-left">
						<span class="glyphicon glyphicon-minus"></span>
						<span class="glyphicon glyphicon-resize-horizontal"></span>
					</button>

					<button id="del-row" type="button" class="btn btn-default pull-right">
						<span class="glyphicon glyphicon-minus"></span>
						<span class="glyphicon glyphicon-resize-vertical"></span>
					</button>
					<button id="add-row" type="button" class="btn btn-default pull-right">
						<span class="glyphicon glyphicon-plus"></span>
						<span class="glyphicon glyphicon-resize-vertical"></span>
					</button>





				</div>


			</form>



		</div>

	</div>

</div>
</div>

<div class="row">
	<div id="possible-sports" class="panel panel-default ">
		<div class="panel-heading"><h3 class="panel-title">Assign Divisions</h3></div>
		<div class="panel-body">

			<div  class="col-sm-6">

				<div class=" col-xs-6">
					<ul id="sports-list" class="sportsclasstype manage-panel list-group "></ul>
				</div>
				<div class=" col-xs-6">
					<div id="sports-divisions" class="divisions well well-sm manage-panel"><b class="">Assigned Divisions</b></div>
					
					<button id="assign-sports-to-courts" type="submit" class="pull-right btn btn-primary">Assign to Courts </button>
				</div>
				
				
				

				<div class="clearfix"></div>

			</div>



			<div class="col-sm-6">
				<form id="select-divisible-room" class="form-horizontal prevent" role="form">

					<select name="room_id" type="dropdown" class="divisiblerooms form-control"></select>

				</form>
				<div id="add-sports-to-room"></div>
			</div>



		</div>
	</div>
</div>

<div class="row">
	<div id="manage-restrictions" class="panel panel-default ">
		<div class="panel-heading"><h3 class="panel-title">Manage Restrictions</h3></div>
		<div class="panel-body">

			<div class="col-md-8">
				<select name="room_id" type="dropdown" class="divisiblerooms form-control"></select>

				<div id="the-restrictions">	


					<form id="form-block-restriction" class="form-inline prevent" role="form">
						<span><strong>Block</strong></span>
						<select name="sport_to_block_id" type="dropdown" class="sportsclasstype form-control form-inline"></select>
						<span>when </span>
						<select name="occurring_sport_id" type="dropdown" class="sportsclasstype form-control"></select> 
						<span>occurs </span>
						<button id="submit-block" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i></button>
					</form>

					<form id="form-limit-restriction" class="form-inline prevent" role="form">
						<span><strong>Limit </strong></span>
						<select name="sport_id" type="dropdown" class="sportsclasstype form-control form-inline"></select>
						<span>to </span>
						<input type="number" class="form-control" name="limit" placeholder="">
						<span>occurrences</span>

						<button id="submit-limit" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i></button>
					</form>
				</div>
			</div>

			<div class="col-md-4">


				<!-- Nav tabs -->
				<ul class="nav nav-tabs">
					<li class="active"><a href="#block" data-toggle="tab">Blocks</a></li>
					<li><a href="#limit" data-toggle="tab">Limits</a></li>

				</ul>

				<!-- Tab panes -->
				<div id="restrictions"class="tab-content manage-panel">

					<div class="tab-pane active" id="block">
						<table class='table restriction blocks'>
							<thead>
								<th>Occurring Sport</th>
								<th>Blocked Sport</th>
								<th></th>
							</thead>
							<tbody></tbody>
						</table>
					</div>

					<div class="tab-pane" id="limit">

						<table class='table restriction limits'>
							<thead>
								<th>Sport</th>
								<th>Limit</th>
								<th></th>
							</thead>

							<tbody></tbody>
						</table>
					</div>

				</div>
			</div>

		</div>
	</div>
</div>


<div id="modal-edit-class-type" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit Class Type</h4>
			</div>
			<div class="modal-body">
				<form id="edit-class-type-form" class="prevent" role="form">

					<input name="class_type_id" type="hidden" class="form-control">

					<div class="form-group">
						<label for="class_type">Title</label>
						<input name="class_type" type="text" class="form-control">
					</div>

					<div class="form-group">
						<label for="class_category">Category</label>
						<select name="category_id" type="dropdown" class="form-control"></select>
					</div>

					<div class="form-group">
						<label for="class_description">Description</label>
						<textarea name="class_description" class="form-control" rows="3"></textarea>
					</div>


				</div>
				<div class="modal-footer">
					<button id="remove-submit" type="button" class="btn btn-danger pull-left">Remove Class Type</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
