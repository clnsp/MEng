<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" id="member" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<!--BODY-->
			<div class="modal-body">
			</div>
			<form class="form-horizontal" role="form">
  <div class="form-group">
    <label class="col-sm-2 control-label">Name</label>
     <label class="editable" id="fname">email@example.com</label> <label class="editable" id="sname">email@example.com</label>
  </div>
</form>
			<button type="button" class="btn btn-info" id="views">Edit View</button>	
			
			
			<!-- FOOTER-->
			<div class="modal-footer">
				<div class="alert alert-warning alert-dismissable fade in">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Warning!</strong> To block <span> </span>, enter a reason and email address in the boxs below<br />
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label for="userEmail" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="userEmail" placeholder="User Email">
							</div>
						</div>
						<div class="form-group">
							<label for="reason" class="col-sm-2 control-label">Reason</label>
							<div class="col-sm-10">
								<textarea class="form-control" rows="3" id="reason" placeholder="Reason for block"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-warning">Block</button>
							</div>
						</div>
					</form>
				</div>
				<div class="alert alert-danger alert-dismissable fade in">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Danger!</strong> Best check yo self, you're not looking too good.
				</div>
				<button type="button" class="btn btn-danger">Delete User</button>
				<button type="button" class="btn btn-warning">Block User</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
