
   <div id="wrapper" class="wrapper">

      <div id="page-wrapper">
    	
<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Current Bookings</h3>
				</div>
				<div class="panel-body">						
					
					<div class="manage-panel">
						<table id='class-types-table' class="table table-striped table-hover">

	<?php if(count($bookings) != 0){ ?>

							<tr>
								<th>Class</th>
								<th>Room</th>
								<th>Starting</th>
								<th>Ending</th>
								<th>Cancelled</th>
								<th>Cancel Booking</th>
							</tr>
							
							<tbody>
	<?php foreach($bookings as $d): ?>
		
		<?php $form = array('class' => 'form-horizontal','role' => 'form',);?>
		<?php $startDate = $d['start']; ?>
		<?php $startDate = strtotime($startDate); ?>				
		<?php $startDate = date('jS F Y h.i A', $startDate); ?>
		<?php $endDate = $d['end']; ?>
		<?php $endDate = strtotime($endDate); ?>				
		<?php $endDate = date('jS F Y h.i A', $endDate); ?>
		<?php $class_booking_id = $d['class_id']; ?>
		<?php $member_id = $d['member_id']; ?>
		<?php $class_booking_id = $d['class_id']; ?>
		<?php $hidden = array('class_booking_id' => $class_booking_id,
				      'member_id' => $member_id	); ?>
		<?php if($d['cancelled'] == "0"){
			$cancelled = "No";
			}else{
			$cancelled = "Yes";
} ?>
							
	<tr  booking_id="<?php echo $d['member_id'] ?>">

			<td class="class_id"><?php echo $d['title'] ?></td>
			<td class="class_id"><?php echo $d['room'] ?></td>
			<td class="class_id"><?php echo $startDate ?></td>
			<td class="class_id"><?php echo $endDate ?></td>
			<td class="class_id"><?php echo $cancelled ?></td>
			<?php echo form_open("/edit_bookings/cancelBooking", $form, $hidden); ?>
  			<td class="class_id"><?php echo form_submit('cancelBooking', 'Cancel Booking', "class= btn btn-warning"); ?>
			<?php echo form_close(); ?>
															
		   </tr>
							
	<?php endforeach; ?>
	<?php }else{
		echo("<td class='nofound' colspan='6'><h2>No classes found</h2></td>");}?>
</tbody>
		</table>
					</div>
					
				</div>

<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Past Bookings</h3>
				</div>
				<div class="panel-body">						
					
					<div class="manage-panel">
						<table id='class-types-table' class="table table-striped table-hover">
							<tr>
								<th>Class</th>
								<th>Room</th>
								<th>Starting</th>
								<th>Ending</th>
								<th>Cancelled</th>
								<th>Attended</th>
							</tr>
							
							<tbody>
	<?php foreach($bookingsPast as $d): ?>

		<?php $startDate = $d['start'] ?>
		<?php $startDate = strtotime($startDate); ?>				
		<?php $startDate = date('jS F Y h.i A', $startDate); ?>
		<?php $endDate = $d['end'] ?>
		<?php $endDate = strtotime($endDate); ?>				
		<?php $endDate = date('jS F Y h.i A', $endDate); ?>
		<?php if($d['cancelled'] == "0"){
			$cancelled = "No";
			}else{
			$cancelled = "Yes";
			}?>
		<?php if($d['attended'] == "0"){
			$attended = "No";
			}else{
			$attended = "Yes";
			}?>
							
	<tr  booking_id="<?php echo $d['member_id'] ?>">

			<td class="class_id"><?php echo $d['title'] ?></td>
			<td class="class_id"><?php echo $d['room'] ?></td>
			<td class="class_id"><?php echo $startDate ?></td>
			<td class="class_id"><?php echo $endDate ?></td>
			<td class="class_id"><?php echo $cancelled ?></td>
			<td class="class_id"><?php echo $attended ?></td>
													
		   </tr>
							
	<?php endforeach; ?>
</tbody>
		</table>
					</div>
					
				</div>

			</div>

			</div>
      
	    </div>

    </div>

