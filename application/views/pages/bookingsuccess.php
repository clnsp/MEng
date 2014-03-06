<div class="page-header text-center">
<div class="well well-lg">
  <h1>Your Booking was Successful! <br><?php echo $bookingtype;?> 
  <?php echo $classinfo['class_type'];?> 
  	<br>at the Time: <?php echo $start;?>
  	<br>in the Room: <?php echo $classinfo['room'];?> 
  </h1>
  
  <a href="<?php echo base_url()?>index.php/mybookings"><button type="button" class="btn btn-primary" >
  View My Bookings  
    
  </button></a>
  </div>
  
</div>
