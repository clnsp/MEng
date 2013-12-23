<div class="navbar">

	<!--
	<div class="col-xs-3 pull-right input-group input-group-sm">
		<span class="input-group-addon">
			<span class="glyphicon glyphicon-search"></span>
		</span>
		<input type="text" class="form-control" placeholder="Search calendar...">
	</div>
-->


<div id="category-dropdown" class="dropdown pull-right">
	<button class="btn dropdown-toggle" type="button" id="category-dropdown-btn" data-toggle="dropdown">Categories
		<span class="caret"></span>
	</button>

	<ul class=" dropdown-menu" role="menu">
		<?php foreach($categories as $cat): ?>
		<li role="presentation"><a style="color:<?php echo $cat['color'] ?>" href="<?php echo $cat['category_id'] ?>"><?php echo $cat['category'] ?></a></li>

	<?php endforeach; ?>
</ul>
</div>

<ul id="bookingCalTabs" class="nav nav-tabs">
	<li class="active">
		<a href="allrooms">All Rooms</a>
	</li>
	<?php foreach($rooms as $room): ?>
	<li><a href="<?php echo $room['room_id'] ?>"><?php echo $room['room'] ?></a></li>

<?php endforeach; ?>
</ul>
</div>



<div id='calendar' class="clearfix"></div>
<!-- Pasted here for convenience needs tidying up -->
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<div id="loading-indicator" class="hidden pull-right">
	<i class="fa fa-spin fa-refresh"></i>
</div>

<!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
				<div class="row">
					<div class="col-xs-8">
						<h3 class="modal-title" id="event-title">Class Title</h3>
					</div>
					<div class="col-xs-4">
						<i id="eventColor" class="pull-right glyphicon glyphicon-stop"></i>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-8">
						<h5 id="event-date-1" class="modal-title"></h5>
					</div>
					<div class="col-xs-4">
						<h5 class="clearfix pull-right modal-title">
							<span id="event-spaces-taken"></span>/<span id="event-spaces-max"></span> spaces filled</h5>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-8">
							<h5 id="event-date-2" class="modal-title"></h5>
						</div>
						<div id="event-location" class="col-xs-4 text-right">
							<span id="" ></span>
						</div>
					</div>
				</div>
				<div class="modal-body">

					<div id="event-warning" class="hidden alert alert-warning fade in"><span id="msg-body"></span><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button></div>

					<div id="event-modal-left" class="col-xs-6">
					<!-- <form class="form-inline">							
							<input type="text" class="form-control inline input-sm cols-x2" placeholder="Search">
						</form>
					-->					

					<div id="event-member-list">
						<form id="event-remove-member-form" method="post" action="">
							<ul class="list-group"></ul>
							<button type="submit" id="event-remove-member-button" class="btn btn-sm">Remove</button>

						</form>
					</div>
					
					
					<!-- event-member-list -->
				</div>
				<!-- event-modal-left -->
				<div id="event-modal-right" class="col-xs-6">
					<form class="form-inline" id="event-add-member-form" role="form">
						<div class="input-group input-xl">
							<input type="hidden" id="class-booking-id" name="class_booking_id" value="" />
							<input id="search-users" type="text" class="form-control" name="member_name" data-member-id="" placeholder="Enter name">
							<span class="input-group-btn">
								<button class="btn btn-default" id="btn-add-member" type="submit">Add</button>
							</span>
						</div>
						<!-- /input-group -->
					</form>
				</div>

				<div class="clearfix"></div><!-- Fix body of modal running over the footer-->




			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button id="event-cancel-class-btn" data-target="#cancelClassModal" data-toggle='modal' type="button" class="btn btn-primary">Cancel Class</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade submodal" id="addGuestModal" tabindex="-1" role="dialog" aria-labelledby="addGuestModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header ">
				<h4 class="modal-title">Add Guest</h4>
			</div>
			<div class="modal-body">
				<form></form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Add New Member</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade submodal" id="cancelClassModal" tabindex="-1" role="dialog" aria-labelledby="cancelClassModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header ">
				<h4 class="modal-title">Cancel Class</h4>
			</div>
			<div class="modal-body">
				<p>Please enter a reason for cancelling this class to send to members.</p>
				<textarea id="cancelMessage" class="form-control" rows="3"></textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
				<button id="confirmCancelBtn" type="button"  class="btn btn-primary">Confirm Cancellation</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="clearfix"></div>
