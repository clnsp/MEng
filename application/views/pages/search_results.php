<?php

$form = array(
	'class' => 'form-horizontal',
	'role' => 'form',
	);

	?>

	<div class="col-sm-8">

		<table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped table-condensed table-bordered dataTable display pull-right" id="SearchResultsTable">
			<thead>
				<tr>
					<th>Activity</th>
					<th>Start Time</th>
					<th>End Time</th>
					<th>Room</th> 	
					<th>Book</th>
				</tr>
			</thead>
			<tbody>
				<?php $count = 0; ?>
				<?php foreach($classes as $row): ?>
				<tr>

					<?php $class_type1 = $row['class_type'];?>
					<?php $start_date1 = $row['class_start_date'];?>
					<?php $mystartdate = strtotime($start_date1); ?>				
					<?php $start_test = date('jS F Y h.i A', $mystartdate); ?>
					<?php $end_date1 = $row['class_end_date'];?>
					<?php $myenddate = strtotime($end_date1); ?>				
					<?php $end_test = date('jS F Y h.i A', $myenddate); ?>
					<?php $room1 = $row['room'];?>
					<?php $classid = $row['class_id'];?>
					<?php $hidden = array('classid' => $classid,
						'start' => $start_test,
						'end' => $end_test);?> 

						<?php echo form_open("/userbook/index", $form,$hidden); ?>

						<td data-title="Activity"><?php echo $row['class_type'];?></td>

						<td data-title="Start"><?php echo $start_test; ?></td>

						<td data-title="End"><?php echo $end_test; ?></td>

						<td data-title="Room"><?php echo $row['room'];?></td>    


						<td data-title="Book"><?php echo form_submit('letssubmit', 'Book', 'class=' . '"' .$buttondata[$count] . '"'); ?></td>
						<?php $count = $count + 1; ?>
						<?php echo form_close(); ?>

					</tr>
				<?php endforeach; ?> 

			</tbody>
		</table>
	</div> 

