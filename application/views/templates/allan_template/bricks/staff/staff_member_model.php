<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="z-index:5;">
                <button type="button" id="member" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <!--BODY-->
            <div class="modal-body">
                <!-- Sub-Modal -->
                <div id="mySubModal" class="modal-content sub-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:4;">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p class="center">Are you sure you want to close your account?<br />You won't be able to undo this.</p>
                            <hr />
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label" for="inputEmail">Confirm Your Password: </label>
                                    <input class="form-control" type="text" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="inputEmail">Confirm Your Password: </label>
                                    <textarea class="form-control" type="text"></textarea>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button class="btn btn-sm" data-dismiss="submodal" aria-hidden="true">Cancel</button>
                                <button class="btn btn-sm btn-danger" data-dismiss="submodal">Close Account</button>
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
				<div class="row">
					<div class="col-md-6"  style="text-align: left;"> <!-- LEFT-->
					<!-- Single button -->
					<div class="btn-group">
						<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
							Contact <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Email<i class="fa fa-envelope pull-right"></i></a></li>
							<li><a href="#">Tweet<i class="fa fa-twitter pull-right"></i></a></li>
							<li class="divider"></li>
							<li><a href="#">SMS<i class="fa fa-mobile pull-right"></i></a></li>
						</ul>
					</div>
					<!-- Single button -->
					<div class="btn-group">
						<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
							Restrict <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#mySubModal" data-toggle="submodal">Block</a></li>
							<li class="divider"></li>
							<li><a href="#mySubModal" data-toggle="submodal">Delete</a></li>
						</ul>
					</div>
					</div>
					<div class="col-md-6"> <!-- RIGHT-->
						<button type="button" class="btn btn-primary" id="save_changes">Save changes</button>
					</div>
				</div>
			</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div><!-- /.modal -->
