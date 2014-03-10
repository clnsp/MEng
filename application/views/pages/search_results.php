<?php $form = array('role' => 'form'); ?>


	
<?php

	if (count($classes) == 0) {
		echo("<td class='nofound' colspan='6'><h2 class='well'>No classes found</h2></td>");
	}

 foreach($classes as $row): ?>
	<tr>
				
	<?php 
		$start_date = new DateTime($row['class_start_date']);
		$end_date = new DateTime($row['class_end_date']);

		$hidden = array(
			'classid' =>  $row['class_id'],
			'start' => $row['class_start_date'],
			'end' => $row['class_end_date'],
			'fully_booked' => $row['fully_booked']);
		echo form_open("/userbook/index", $form, $hidden); ?>

		<td data-title="Activity"><?php echo $row['class_type'];?></td>
		<td data-title="Date"><?php echo $start_date->format('jS F Y'); ?></td>
		<td data-title="Start"><?php echo $start_date->format('h.i A'); ?></td>
		<td data-title="End"><?php echo $end_date->format('h.i A'); ?></td>
		<td data-title="Room"><?php echo $row['room'];?></td>    	

		<td data-title="Book">
			<?php 
				if($row['fully_booked']){
					echo form_submit('submit', 'Wait', "class='btn btn-warning'");
				}else{
					echo form_submit('submit', 'Book', "class='btn btn-primary'");
				}
				 ?>
			</td>
		<?php echo form_close(); ?>

	</tr>
<?php endforeach; ?> 

