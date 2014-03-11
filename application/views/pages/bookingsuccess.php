<div class="page-header text-center">
<div class="well well-lg">
  
  <h1>
  
  	
  Your Booking was Successful!
<br> <i class="glyphicon glyphicon-ok"></i>
  </h1>
 
  <h1><small>You will be attending <b><?php echo $classinfo['class_type'];?></b>


  	<br>at <b><?php $d = new DateTime($start); echo $d->format("H:i")?> </b> on 
  	<b><?php echo $d->format("jS F Y")?></b> in <b><?php echo $classinfo['room'];?></b> 
</small></h1>
  
  <a href="<?php echo base_url()?>index.php/mybookings"><button type="button" class="btn btn-primary" >
  View My Bookings  
    
  </button></a>
  </div>
  
</div>
