<div id="MemberDetails" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" id="member" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal title</h4><span>Status: <strong class="mem-status"><span class="text-success">Active</span></strong></span>
            </div>
            <!--BODY-->

            <!--End Sub-Modal -->
            <div id="mainContent" class="modal-body" style="">


                <div class="panel panel-default col-lg-6" style="padding:0px;">
                    <div class="panel-heading">
                        <h3 class="panel-title views">Account Details <i class="glyphicon glyphicon-pencil pull-right"></i></h3>
                    </div>
                    <div class="panel-body">
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

                </div>
                <div class="panel panel-default col-lg-6" style="padding:0px;">
                    <div class="panel-heading">
                        <h3 class="panel-title views">Contact Details <i class="glyphicon glyphicon-pencil pull-right"></i></h3>
                    </div>
                    <div class="panel-body">
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
                </div>
            </div>			

            <!-- FOOTER-->
            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-8" style="text-align: left;">
                        <!-- LEFT-->
                        <!-- Single button -->
                        <button type="button" id="contact" class="btn btn-info btn-sm" href="#SubMemberDetails" data-target="#SubMemberDetails" data-toggle="modal">
                            <i class="glyphicon glyphicon-user"></i> Contact </span>
                        </button>
                        <!-- Single button -->
                        <button type="button" id="attendance"class="btn btn-warning btn-sm" href="#SubMemberDetails" data-target="#SubMemberDetails" data-toggle="modal">
                            <i class="glyphicon glyphicon-search"></i> Attendance</span>
                        </button>
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-cog"></i>  Options <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li class="membership"><a href="#SubMemberDetails" data-target="#SubMemberDetails" data-toggle="modal"><i class="glyphicon glyphicon-bookmark"></i>  Update Membership</a></li>
                                <li class="divider"></li>
                                <li class="status"><a href="#SubMemberDetails" data-target="#SubMemberDetails" data-toggle="modal"><i class="glyphicon glyphicon-ban-circle"></i>  Change Status</a></li>
                                <li class="divider"></li>
                                <li class="delete"><a href="#SubMemberDetails" data-target="#SubMemberDetails" data-toggle="modal"><i class="glyphicon glyphicon-trash"></i>  Delete</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <!-- RIGHT-->
                        <button type="button" class="btn btn-primary btn-sm" id="save_changes">Save changes</button>
                    </div>
                </div>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div><!-- /.modal -->


