<div id="MemberDetails" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" id="member" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Modal title</h4><span>Status: <strong class="mem-status"><span class="text-success">Active</span></strong></span>
            </div>
            <!--BODY-->
            <div class="modal-body">
                <!-- Sub-Modal -->
		<?php $this->load->view('templates/allan_template/bricks/staff/staff_member_sub_model'); ?>
                <!--End Sub-Modal -->
                <div id="mainContent" class="row" style="z-index:2;">
                    <div class="panel panel-primary col-lg-6" style="padding:0px;">
                        <div class="panel-heading">
                            <h3 class="panel-title views">Account Details <i class="fa fa-pencil fa-fw pull-right"></i></h3>
                        </div>
                        <div class="panel-body hidden-xs">
                            <!--LEFT-->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">First:</label>
                                    <label class="editable first_name" id="first_name">First Name</label>
			            <input type="hidden" id="id" value=""/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Type:</label>
                                    <label id="type">Student</label>
                                </div>
                            </div>
                            <!--RIGHT-->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Last:</label>
                                    <label class="editable second_name" id="second_name">Second Name</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Membership:</label>
                                    <label id="membership_type">13 - 14</label>
                                </div>
                            </div>
                        </div>
						 <div class="panel-body visible-xs">
                            <!--LEFT-->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">First:</label>
                                    <label class="editable first_name" id="first_name">First Name</label>
			            <input type="hidden" id="id" value=""/>
                                </div>
								 <div class="form-group">
                                    <label class="control-label">Last:</label>
                                    <label class="editable second_name" id="second_name">Second Name</label>
                                </div>
                            </div>
                            <!--RIGHT-->
                            <div class="col-sm-6">
                               <div class="form-group">
                                    <label class="control-label">Type:</label>
                                    <label id="type">Student</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Membership:</label>
                                    <label id="member">13 - 14</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-primary col-lg-6" style="padding:0px;">
                        <div class="panel-heading">
                            <h3 class="panel-title views">Contact Details <i class="fa fa-pencil fa-fw pull-right"></i></h3>
                        </div>
                        <div class="panel-body hidden-xs">
                            <!--LEFT-->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Home:</label>
                                    <label class="editable home_number" id="home_number">00000000000</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email:</label>
                                    <label class="editable email" id="email">00000000000</label>
                                </div>
                            </div>
                            <!--RIGHT-->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Mobile:</label>
                                    <label class="editable mobile_number" id="mobile_number">00000000000</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Twitter:</label>
                                    <label class="editable twitter" id="twitter">temptwitter</label>
                                </div>
                            </div>
                        </div>
						<div class="panel-body visible-xs"> <!-- Sort Order -->
                            <!--LEFT-->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Home:</label>
                                    <label class="editable home_number" id="home_number">00000000000</label>
                                </div>
								<div class="form-group">
                                    <label class="control-label">Mobile:</label>
                                    <label class="editable mobile_number" id="mobile_number">00000000000</label>
                                </div>
                            </div>
                            <!--RIGHT-->
                            <div class="col-sm-6">
								<div class="form-group">
                                    <label class="control-label">Email:</label>
                                    <label class="editable email" id="email">00000000000</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Twitter:</label>
                                    <label class="editable twitter" id="twitter">temptwitter</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<!--COLIN TEST --> <!--COLIN TEST--> 
				                <div id="mainContent" class="row" style="z-index:2;">
                    <div class="panel panel-primary col-lg-6" style="padding:0px;">
                        <div class="panel-heading">
                            <h3 class="panel-title">Bookings</h3>
                        </div>
                        <div class="panel-body">
<div class="panel-group" id="accordion">
</div>
                        </div>
                    </div>
                    <div class="panel panel-primary col-lg-6" style="padding:0px;">
                        <div class="panel-heading">
                            <h3 class="panel-title">Attendance</h3>
                        </div>
                        <div class="panel-body">
						<div class="row">
							<div class="col-md-6"><span>Class Bookings:  <strong>10</strong></span><br/><br/><span>Popular Class:  <strong>Zumba</strong></span><br/></div>
							<div class="col-md-6"><span>Class Attendance: <strong>50%</strong></span><br/><br/><span>Popular Time:  <strong>Tuesday, 5:00</strong></span><br/></div>
						</div>
                        </div>
						
</div>
                        </div>	
			<!--COLIN TEST --><!--COLIN TEST -->
			<div class="row">
			                    <div class="panel panel-primary col-lg-6" style="padding:0px;">
                        <div class="panel-heading">
                            <h3 class="panel-title views">Change Membership</h3>
                        </div>
                        <div class="panel-body">
							<span>Current Membership: <span class="pull-right"><span id="memType">N/A</span> <span id="memShipType">N/A</span></span></span><br/>
							
							<div class="row">
								<div class="col-md-4">Validity:</div>
								<div class="col-md-8 text-right">From: <strong id="dateStart">01/02/03</strong> To: <strong id="dateEnd">06/07/08</strong></div>
							</div>
							<form role="form">
								<div class="form-group">
									<label for="memberships">Avaliable Membership Types:</label>
									<select id="membershipSelect"class="form-control"></select>
								</div>
                        </div>
						</div>
			            <div class="panel panel-primary col-lg-6" style="padding:0px;">
                        <div class="panel-heading">
                            <h3 class="panel-title views">Custom Membership </h3>
                        </div>
                        <div class="panel-body">
							<div id="date-selector"></div>
						</div>
			</div>
			
			
			
			
			
			
            </div>
            <!-- FOOTER-->
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-8" style="text-align: left;">
                        <!-- LEFT-->
                        <!-- Single button -->
                            <button type="button" id="contact" class="btn btn-info btn-sm" href="#SubMemberDetails" data-toggle="submodal">
                                <i class="fa fa-user fa-fw"></i> Contact </span>
                            </button>
                        <!-- Single button -->
                            <button type="button" id="attendance"class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-search"></i> Attendance</span>
                            </button>
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cogs"></i>  Options <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li class="membership"><a href="#SubMemberDetails" data-toggle="submodal"><i class="fa fa-users"></i>  Update Membership</a></li>
                                <li class="divider"></li>
                                <li class="status"><a href="#SubMemberDetails" data-toggle="submodal"><i class="fa fa-ban fa-fw"></i>  Change Status</a></li>
                                <li class="divider"></li>
                                <li class="delete"><a href="#SubMemberDetails" data-toggle="submodal"><i class="fa fa-trash-o fa-fw"></i>  Delete</a></li>
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
