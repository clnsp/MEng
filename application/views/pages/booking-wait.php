<div class="page-header text-center">
  <div class="well well-lg">
    
    <h1>Fully Booked
      <br> <i class="glyphicon glyphicon-time"></i>
    </h1>
    
    <h1><small><p><b><?php echo $class_type;?></b> starting at <b><?php $d = new DateTime($class_start_date); echo $d->format("H:i")?> </b> on 
     <b><?php echo $d->format("jS F Y")?></b> in <b><?php echo $room;?></b> is fully booked. </p>
     
     <p>You may add yourself to the waiting list to be notified if a space becomes available. When spaces become available, they are assigned on a first come first served basis.</p>  
   </small></h1>
   
   <?php 
   echo form_open("/booking/joinWaiting");
   echo form_hidden(array('class_id' =>  $class_id));
   echo form_submit('submit', 'Join Waiting List', "class='btn btn-primary'");
   echo form_close();
   ?>
 </td>
 
 
 
</div>

</div>
