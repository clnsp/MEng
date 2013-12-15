<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" id="member" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<!--BODY-->
			<div class="modal-body">

        <!-- Sub-Modal -->
        <div id="mySubModal" class="modal-content sub-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:4";>
		<div class="modal-content">
            <div class="modal-body">
                <p class="center">Are you sure you want to close your account?<br />You won't be able to undo this.</p>
                <hr />
                <form class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Confirm Your Password: </label>
                        <div class="controls">
                            <input type="text">
                        </div>
                </form>
				</div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="submodal" aria-hidden="true">Cancel</button>
                <button class="btn btn-danger" data-dismiss="submodal">Close Account</button>
            </div>
		</div>
            </div>
                 </div>
				 <div id="mainContent" style="z-index:2;">
				 
			<form class="form-horizontal" role="form">
			  <div class="form-group">
			    <label class="col-sm-3 control-label">Name:</label>
			     <label class="editable" id="first_name">First Name</label> <label class="editable" id="second_name">Second Name</label>
			  </div>
			    <div class="form-group">
			    <label class="col-sm-3 control-label">Home Number:</label>
			     <label class="editable" id="home_number">00000000000</label>
			  </div>
			    <div class="form-group">
			    <label class="col-sm-3 control-label">Mobile Number:</label>
			     <label class="editable" id="mobile_number">00000000000</label>
			  </div>
			    <div class="form-group">
			    <label class="col-sm-3 control-label">Twitter:</label>
			     <label class="editable" id="twitter">temptwitter</label>
			  </div>
			</form>
			<button type="button" class="btn btn-info" id="views">Edit View</button>	
			</div>
			</div>
			<!-- FOOTER-->
			<div class="modal-footer">
				<button type="button" href="#mySubModal" class="btn btn-danger" data-toggle="submodal">Delete User</button>
				<button type="button" href="#mySubModal" class="btn btn-warning" data-toggle="submodal">Block User</button>
				<button type="button" class="btn btn-primary" id="save_changes">Save changes</button>
			</div>
		</div> <!-- /.modal-content -->
	</div> <!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
/*
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
*/
?>
