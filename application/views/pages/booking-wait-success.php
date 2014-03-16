<div class="page-header text-center">
<div class="well well-lg">
  
  <h1>Added to Waiting List
<br> <i class="glyphicon glyphicon-time"></i>
  </h1>
 
  <h1><small><p><b><?php echo $class_type;?></b> starting at <b><?php $d = new DateTime($class_start_date); echo $d->format("H:i")?> </b> on 
  	<b><?php echo $d->format("jS F Y")?></b> in <b><?php echo $room;?></b> is fully booked. </p>
  	
  	
</small></h1>
  
 	<a class="btn btn-primary" href="<?php echo site_url()?>/mybookings">View my bookings</a>
 
 
  </div>
  
</div>
