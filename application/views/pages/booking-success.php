<div class="page-header text-center">
	<div class="well well-lg">

		<h1>Your Booking was Successful!<br> <i class="glyphicon glyphicon-ok"></i> </h1>

		<h1><small>You will be attending <b><?php echo $classinfo['class_type'];?></b>


			<br>at <b><?php $d = new DateTime($classinfo['class_start_date']); echo $d->format("H:i")?> </b> on 
			<b><?php echo $d->format("jS F Y")?></b> in <b><?php echo $classinfo['room'];?></b> 
		</small></h1>
		<div class="button-group">
			<a class="btn btn-primary" href="<?php echo site_url()?>/booking/">Make Another Booking</a>
			<a class="btn btn-primary" href="<?php echo site_url()?>/booking/mybookings">View My Bookings</a>
		</div>

	</div>

</div>
