<div class="navbar">
	<div class="col-xs-3 pull-right input-group input-group-sm">
		<span class="input-group-addon">
			<span class="glyphicon glyphicon-search"></span>
		</span>
		<input type="text" class="form-control" placeholder="Search calendar...">
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
				<button type="button" class="btn btn-primary">Cancel Class</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade submodal" id="addGuestModal" tabindex="-1" role="dialog" aria-labelledby="addGuestModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header ">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
				<h4 class="modal-title">Add Guest</h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div class="clearfix"></div>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/booking-calendar.js"></script>