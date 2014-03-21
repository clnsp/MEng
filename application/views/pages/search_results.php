
<?php

if (count($classes) == 0) {
	echo("<td class='nofound' colspan='6'><h2 class='well'>No classes found</h2></td>");
}

foreach($classes as $row): ?>

<tr>

	<?php 
	$start_date = new DateTime($row['class_start_date']);
	$end_date = new DateTime($row['class_end_date']);
	$start_stamp = $start_date->getTimestamp();
	$end_stamp = $start_date->getTimestamp();
	
	?>

	<td data-title="Activity">
		<?php echo $row['class_type'];?>
	</td>
	<td data-value='<?php echo $start_stamp; ?>' data-title="Date">
		<?php echo $start_date->format('jS F Y'); ?>
	</td>
	<td data-value='<?php echo $start_stamp; ?>' data-title="Start" >
		<?php echo $start_date->format('h.i A'); ?>
	</td>
	<td data-value='<?php echo $end_stamp; ?>' data-title="End">
		<?php echo $end_date->format('h.i A'); ?>
	</td>
	<td data-title="Room">
		<?php echo $row['room'];?>
	</td>    	
	
	<td data-title="Book" data-sort-ignore="true">		
		
		<?php 
			echo form_open("/booking/confirm");
			if(isset($row['is_sport'])){
				$hidden = array(
					'class_type_id' =>  $row['class_type_id'],
					'class_start_date' => $row['class_start_date'],
					'class_end_date' => $row['class_end_date'],
					'room_id' => $row['room_id'],
					'room' => $row['room'],
					'class_type' => $row['class_type'],
				);
			}else{
				$hidden = array(
					'class_id' =>  $row['class_id']
				);
			}
				echo form_hidden($hidden);
		
			
			echo form_submit('submit', 'Book', "class='btn btn-primary'");
		?>
	</td>
	<?php echo form_close(); ?>

</tr>
<?php endforeach; ?> 

