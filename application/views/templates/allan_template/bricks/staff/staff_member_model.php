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
                <div id="mainContent" style="z-index:2;">
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
				<!--COLIN TEST --> <!--COLIN TEST 
				                <div id="mainContent" style="z-index:2;">
                    <div class="panel panel-primary col-lg-6" style="padding:0px;">
                        <div class="panel-heading">
                            <h3 class="panel-title">Bookings</h3>
                        </div>
                        <div class="panel-body hidden-xs">
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Collapsible Group Item #1
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Collapsible Group Item #2
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          Collapsible Group Item #3
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>
                        </div>
						 <div class="panel-body visible-xs">
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Collapsible Group Item #1
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Collapsible Group Item #2
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          Collapsible Group Item #3
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>
                        </div>
                    </div>
                    <div class="panel panel-primary col-lg-6" style="padding:0px;">
                        <div class="panel-heading">
                            <h3 class="panel-title">Attendance</h3>
                        </div>
                        <div class="panel-body hidden-xs">
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Collapsible Group Item #1
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Collapsible Group Item #2
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          Collapsible Group Item #3
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>
                        </div>
						<div class="panel-body visible-xs"> 
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Collapsible Group Item #1
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Collapsible Group Item #2
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          Collapsible Group Item #3
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>
                        </div>
                    </div>
                </div>
				
			-->	<!--COLIN TEST --><!--COLIN TEST -->
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
                                <li id="email" class="message"><a href="#SubMemberDetails" data-toggle="submodal"><i class="fa fa-envelope fa-fw"></i>  Email</a></li>
								<?php if($twitter) {?>
								<li class="divider tweet"></li>
                                <li id="tweet" class="message tweet"><a href="#SubMemberDetails" data-toggle="submodal"><i class="fa fa-twitter fa-fw"></i>  Tweet</a></li>
								<?php }?>
								<?php if($sms) {?>
                                <li class="divider sms"></li>
                                <li id="sms" class="message sms"><a href="#SubMemberDetails" data-toggle="submodal"><i class="fa fa-mobile fa-fw"></i>  SMS</a></li>
								<?php }?>
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
                                <li><a href="#SubMemberDetails" data-toggle="submodal"><i class="fa fa-users"></i>  Update Membership</a></li>
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
