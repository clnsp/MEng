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
                                    <p id="ban_reason"></p>
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
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Account Details</h3>
                        </div>
                        <div class="panel-body">
                            <!--LEFT-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">First:</label>
                                    <label class="editable" id="first_name">First Name</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Status:</label>
                                    <label id="home_number">Active</label>
                                </div>
                            </div>
                            <!--RIGHT-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Last:</label>
                                    <label class="editable" id="second_name">Second Name</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Membership:</label>
                                    <label id="member">13 - 14</label>
                                </div>
                            </div>
                            <p id="reason">REASONS</p>
                        </div>
                    </div>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Contact Details</h3>
                        </div>
                        <div class="panel-body">
                            <!--LEFT-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Home:</label>
                                    <label class="editable" id="home_number">00000000000</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email:</label>
                                    <label class="editable" id="home_number">00000000000</label>
                                </div>
                            </div>
                            <!--RIGHT-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mobile:</label>
                                    <label class="editable" id="mobile_number">00000000000</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Twitter:</label>
                                    <label class="editable" id="twitter">temptwitter</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-success btn-sm" id="views"><i class="fa fa-pencil fa-fw"></i>  Edit</i></button>
            </div>
            <!-- FOOTER-->
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-8" style="text-align: left;">
                        <!-- LEFT-->
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user fa-fw"></i> Contact <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#"><i class="fa fa-envelope fa-fw"></i>  Email</a></li>
								<li class="divider"></li>
                                <li><a href="#"><i class="fa fa-twitter fa-fw"></i>  Tweet</a></li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="fa fa-mobile fa-fw"></i>  SMS</a></li>
                            </ul>
                        </div>
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-search"></i> View <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#"><i class="fa fa-calendar-o fa-fw"></i>  Bookings</a></li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="fa fa-check-square-o"></i>  Attendance</a></li>
                            </ul>
                        </div>
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cogs"></i>  Options <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#mySubModal" data-toggle="submodal"><i class="fa fa-users"></i>  Update Membership</a></li>
                                <li class="divider"></li>
                                <li><a href="#mySubModal" data-toggle="submodal"><i class="fa fa-ban fa-fw"></i>  Block</a></li>
                                <li class="divider"></li>
                                <li><a href="#mySubModal" data-toggle="submodal"><i class="fa fa-trash-o fa-fw"></i>  Delete</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!-- RIGHT-->
                        <button type="button" class="btn btn-primary btn-sm" id="save_changes">Save changes</button>
                    </div>
                </div>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div><!-- /.modal -->
