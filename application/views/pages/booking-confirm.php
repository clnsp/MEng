<div class="page-header text-center">
<div class="well well-lg">
  
  <h1>Please Confirm Your Booking
<br> <i class="glyphicon glyphicon-calendar"></i>
  </h1>
 
  <h1><small><b><?php echo $class_type;?></b> at <b><?php $d = new DateTime($class_start_date); echo $d->format("H:i")?> </b> on 
  	<b><?php echo $d->format("jS F Y")?></b> in <b><?php echo $room;?></b> 
</small></h1>
  


 		<?php 
 		if(isset($is_sport)){
 			$hidden = array(
 				'class_type_id' =>  $class_type_id,
 				'start' => $class_start_date,
 				'end' => $class_end_date,
 				'room_id' => $room_id
 			);
 			echo form_open("/booking/bookSport");			
 		}else{
 			$hidden = array(
 				'classid' =>  $class_id
 			);
 			echo form_open("/booking/bookClass");
 		}
 
 		echo form_hidden($hidden);
 		echo form_submit('submit', 'Book', "class='btn btn-primary'");
	 	echo form_close();

 		?>
 	</td>
 
 
 
  </div>
  
</div>
