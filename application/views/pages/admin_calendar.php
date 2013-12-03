
<div class="navbar">

	<div class="col-xs-3 pull-right input-group input-group-sm">
		<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Search calendar...">
	</div>
	<ul id="bookingCalTabs" class="nav nav-tabs">
		<li class="active"><a  href="allrooms">All Rooms</a></li>
		<li><a  href="sportshall">Sports Hall</a></li>
		<li><a href="activitiesroom" >Activities Room</a></li>
		<li><a href="royalcollegegym">Royal College Gym</a></li>
	</ul>

</div>

<div id='calendar' class="clearfix"></div>

<!-- Pasted here for convenience needs tidying up -->
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<div id="loading-indicator" class="hidden pull-right"><i class="fa fa-spin fa-refresh"></i></div>

</div>
<div class="tab-pane" id="sportshall"></div>
<div class="tab-pane" id="activitiesroom"></div>
<div class="tab-pane" id="royalcollegegym"></div>
</div>


<!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

				

				<div class="row">
					<div class="col-xs-6">
						<h3 class="modal-title" id="event-title">Class Title</h3>
					</div>

					<div class="col-xs-6">
						<i id="eventColor" class="pull-right glyphicon glyphicon-stop"></i>
					</div>
				</div>



				<div class="row">

					<div class="col-xs-6">
						<h5 id="event-date" class="modal-title">30 September 2013 9pm - 10pm</h5>
					</div>

					<div class="col-xs-6">
						<h5 class="clearfix pull-right modal-title">8/10 spaces filled</h5>		
					</div>

				</div>

			</div>
			<div class="modal-body">

				<div id="event-modal-left" class="col-xs-6">
					<form class="form-inline">							
						<input type="text" class="form-control inline input-sm cols-x2" placeholder="Search">
					</form>

					<div id="event-member-list">
						<ul class="list-group">
							<li class="list-group-item"> <input type="checkbox">Cras justo odio</li>
							<li class="list-group-item"> <input type="checkbox">Dapibus ac facilisis in</li>
							<li class="list-group-item"> <input type="checkbox">Morbi leo risus</li>
							<li class="list-group-item"> <input type="checkbox">Porta ac consectetur ac</li>
							<li class="list-group-item"> <input type="checkbox">Vestibulum at eros</li>
						</ul>

						<button class="btn btn-sm">Remove Member</button>
					</div><!-- event-member-list -->
				</div><!-- event-modal-left -->

				<div id="event-modal-right" class="col-xs-6">
					<h5 class="modal-title">Add Member</h5>
					<form class="form-inline" role="form">
						<div class="form-group">

							<label class="sr-only" for="event-add-memmber-text">Name</label>
							<input type="text" class="form-control input-sm" id="event-add-memmber-text" placeholder="Enter name">
						</div>


						<button type="submit" class="btn btn-sm btn-default">Add</button>
					</form>

				</div>

			</div>
			<div class="clearfix modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="clearfix"></div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/booking-calendar.js"></script>