
<div class="container">

	<div class="row">
		<h1>Manage</h1>
	</div>
	
	<div class="row">

		<div class="col-md-6">
			
			<div id="manage-categories" class="panel panel-default">
				<div class="panel-heading"><h3 class="panel-title">Categories</h3></div>
				<div class="panel-body">
					
					<div  class="col-sm-6">
						<h5>Add New Category</h5>
						<form id="add-category-form" class="form-horizontal prevent" role="form">
							<div class="form-group">
								<label for="category" class="col-sm-3 control-label">Title</label>
								<div class="col-sm-9">
									<input name="category" type="text" class="form-control" placeholder="Category Title">
								</div>
							</div>
							
							<div class="form-group">
								<label for="color" class="col-sm-3 control-label">Color</label>
								<div class="col-sm-9">
									<div class="minicolors minicolors-theme-bootstrap minicolors-position-bottom minicolors-position-left minicolors-focus">
										<input name="color" type="text" class="form-control demo minicolors-inline" data-control="wheel" value="#ff99ee" size="7">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-9">
									<button type="submit" class="btn btn-default">Add Category</button>
								</div>
							</div>
						</form>
					</div>
					
					<div class="col-sm-6">
						<h5>Edit Categories</h5>
						<div class="manage-panel">
							<form id="remove-category-form" class="prevent">
								<ul id='class-categories-list' class="list-group checkbox-group"></ul>
							</div>
							<button type="submit" class="btn btn-danger pull-right">Remove</button>
						</form>
					</div>
					
					
					
				</div>
			</div>
			



		</div>

		<div id="manage-add-classes" class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Add New Class Type</h3>
				</div>
				<div class="panel-body">
					
					<form id="add-class-type-form" class="prevent" role="form">
						<div class="form-group">
							<label for="class_type">Title</label>
							<input name="class_type" type="text" class="form-control" placeholder="Class Title">
						</div>
						
						<div class="form-group">
							<label for="class_category">Category</label>
							<select name="category_id" type="dropdown" class="form-control"></select>
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
		
		
		<div id="manage-classes" class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Manage Class Types</h3>
				</div>
				<div class="panel-body">						
					
					<div class="manage-panel">
						<table id='class-types-table' class="table table-striped table-hover">
							<tr>
								<th>Title</th>
								<th>Description</th>
								<th>Category</th>
							</tr>
							
							<tbody></tbody>
						</table>
					</div>
					
				</div>
			</div>
			
		</div>


		<div id="add-block-classes" class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Add Block Bookings</h3>
				</div>
				<div class="panel-body" >						
					
					<form id="add-block-classes-form" class="form-horizontal prevent" role="form">
						<div class="form-group">
							<label for="class_type_id" class="col-sm-3 control-label">Class Type</label>
							<div class="col-sm-9">
								<select name="class_type_id" type="dropdown" class="form-control"></select>							</div>
							</div>

							<div class="form-group">
								<label for="max_attendance" class="col-sm-3 control-label">Max Capacity</label>
								<div class="col-sm-9">
									<input name="maximum_attendance" type="text" class="form-control" placeholder="Maximum Capacity">
								</div>
							</div>

							<div class="form-group">
								<label for="class_start_date" class="col-sm-3 control-label">Class Start</label>
								<div class="col-sm-9">
									<input name="class_start_date" type="datetime" class="form-control" >
								</div>
							</div>
							<div class="form-group">
								<label for="class_end_date" class="col-sm-3 control-label">Class End</label>
								<div class="col-sm-9">
									<input name="class_end_date" type="datetime" class="form-control" >
								</div>
							</div>

							<div class="form-group">
								<label for="room_id" class="col-sm-3 control-label">Room</label>
								<div class="col-sm-9">
									<select name="room_id" type="dropdown" class="form-control"></select>							</div>
								</div>


								<div class="form-group">
									<label for="repeat" class="col-sm-3 control-label">Repeat</label>
									<div class="col-sm-9">
										<select name="repeat" type="dropdown" class="form-control">
											<option>None (run once)</option>
											<option>Hourly</option>
											<option>Daily</option>
											<option>Weekly</option>
											<option>Monthly</option>
											<option>Yearly</option>
										</select>							
									</div>
								</div>

								<div class="form-group">
									<label for="until" class="col-sm-3 control-label">Until</label>
									<div class="col-sm-9">
										<input name="until" type="date" class="form-control" >

									</div>
								</div>


								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-9">
										<button type="submit" class="btn btn-primary">Add Block</button>
									</div>
								</div>
							</div>

						</form>

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


	</div><!--/container-->

