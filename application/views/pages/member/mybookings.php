
   <div id="wrapper" class="wrapper">

      <div id="page-wrapper">
    	
<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Current Bookings</h3>
				</div>
				<div class="panel-body">						
					
					<div class="manage-panel">
						<table id='class-types-table' class="table table-striped table-hover">
							<tr>
								<th>Class id</th>
								<th>Class</th>
								<th>Room</th>
								<th>Starting</th>
								<th>Ending</th>
								<th>Cancelled</th>
								<th>Attended</th>
								<th>Cancel Booking</th>
							</tr>
							
							<tbody>
	<?php foreach($bookings as $d): ?>
							
	<tr  booking_id="<?php echo $d['member_id'] ?>">

			<td class="class_id"><?php echo $d['class_id'] ?></td>
			<td class="class_id"><?php echo $d['title'] ?></td>
			<td class="class_id"><?php echo $d['room'] ?></td>
			<td class="class_id"><?php echo $d['start'] ?></td>
			<td class="class_id"><?php echo $d['end'] ?></td>
			<td class="class_id"><?php echo $d['cancelled'] ?></td>
			<td class="class_id"><?php echo $d['attended'] ?></td>
  			<td class="class_id"><button class="btn btn-warning" type="button">
    			Cancel Booking
  			</button></td>
															
		   </tr>
							
	<?php endforeach; ?>
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
								<th>Class id</th>
								<th>Class</th>
								<th>Room</th>
								<th>Starting</th>
								<th>Ending</th>
								<th>Cancelled</th>
								<th>Attended</th>
							</tr>
							
							<tbody>
	<?php foreach($bookingsPast as $d): ?>
							
	<tr  booking_id="<?php echo $d['member_id'] ?>">

			<td class="class_id"><?php echo $d['class_id'] ?></td>
			<td class="class_id"><?php echo $d['title'] ?></td>
			<td class="class_id"><?php echo $d['room'] ?></td>
			<td class="class_id"><?php echo $d['start'] ?></td>
			<td class="class_id"><?php echo $d['end'] ?></td>
			<td class="class_id"><?php echo $d['cancelled'] ?></td>
			<td class="class_id"><?php echo $d['attended'] ?></td>
													
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
<div class="push clearfix"></div>
