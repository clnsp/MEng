
<div id="wrapper" class="wrapper">

	<div id="page-wrapper">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Current Bookings</h3>
			</div>
			<div class="panel-body">	

				<div class="booking-panel">		

					<table id='current-bookings-table'  class="table footable table-bordered table-striped table-hover" data-page-navigation=".current-pagination">

						<?php if(count($bookings) != 0){ ?>
						<thead>
							<tr>
								<th>Class</th>
								<th data-hide="phone">Room</th>
								<th data-type="date">Date</th>
								<th data-sort-initial="true" data-type="time">Start</th>
								<th data-hide="phone" data-type="time">End</th>
								<th data-sort-ignore="true" data-hide="phone">Cancel</th>		
							</tr>
						</thead>

						<tbody>
							<?php foreach($bookings as $d): 
							$form = array('class' => 'form','role' => 'form',);
							$startDate = new DateTime($d['start']); 			
							$endDate = new DateTime($d['end']);

							$hidden = array(
								'class_booking_id' =>$d['class_id'] ,
								'member_id' => $d['member_id']
								); ?>


								<tr booking_id="<?php echo $d['member_id'] ?>">

									<td class="class_type"><?php echo $d['title'] ?></td>
									<td class="room"><?php echo $d['room'] ?></td>
									<td data-value="<?php echo $startDate->getTimestamp();?>"class="start_date"><?php echo $startDate->format('jS F Y') ?></td>
									<td data-value="<?php echo $startDate->getTimestamp();?>" class="start_time"><?php echo $startDate->format('h.i A') ?></td>
									<td data-value="<?php echo $endDate->getTimestamp();?>" class="end_time"><?php echo $endDate->format('h.i A') ?></td>
									<td class="cancel">

										<?php 
										echo form_open(site_url(). "/booking/cancelBooking", $form, $hidden);
										echo form_submit('cancelBooking', 'Cancel Booking', "class='cancelbooking btn btn-sm btn-danger'");	
										echo form_close(); 
										?>

									</td>
								</tr>
							<?php endforeach; ?>

							<?php }else{
								echo("<td class='nofound' colspan='6'><h2>No classes found</h2></td>");}?>
							</tbody>
						</table>
					</div>	
					
					<div class="hide-if-no-paging current-pagination pull-right pagination">
						<ul class="pagination"></ul>
					</div>
				</div>

			</div>

						<?php if(count($waiting) != 0){ ?>

<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Current Waiting List</h3>
			</div>
			<div class="panel-body">	

				<div class="booking-panel">		

					<table id='current-waiting-table'  class="table footable table-bordered table-striped table-hover" data-page-navigation=".current-pagination">


						<thead>
							<tr>
								<th>Class</th>
								<th data-hide="phone">Room</th>
								<th data-type="date">Date</th>
								<th data-sort-initial="true" data-type="time">Start</th>
								<th data-hide="phone" data-type="time">End</th>
								<th data-sort-ignore="true" data-hide="phone">Cancel</th>		
							</tr>
						</thead>

						<tbody>
							<?php foreach($waiting as $d): 
							$form = array('class' => 'form','role' => 'form',);
							$startDate = new DateTime($d['start']); 			
							$endDate = new DateTime($d['end']);

							$hidden = array(
								'class_booking_id' =>$d['class_id'] ,
								'member_id' => $d['member_id']
								); ?>


								<tr booking_id="<?php echo $d['member_id'] ?>">

									<td class="class_type"><?php echo $d['title'] ?></td>
									<td class="room"><?php echo $d['room'] ?></td>
									<td data-value="<?php echo $startDate->getTimestamp();?>"class="start_date"><?php echo $startDate->format('jS F Y') ?></td>
									<td data-value="<?php echo $startDate->getTimestamp();?>" class="start_time"><?php echo $startDate->format('h.i A') ?></td>
									<td data-value="<?php echo $endDate->getTimestamp();?>" class="end_time"><?php echo $endDate->format('h.i A') ?></td>
									<td class="cancel">

										<?php 
										echo form_open(site_url(). "/booking/cancelWaiting", $form, $hidden);
										echo form_submit('cancelWaiting', 'Cancel Waiting', "class='cancelwaiting btn btn-sm btn-danger'");	
										echo form_close(); 
										?>

									</td>
								</tr>
							<?php endforeach; ?>

							
							</tbody>
						</table>
					</div>	
					
					<div class="hide-if-no-paging current-pagination pull-right pagination">
						<ul class="pagination"></ul>
					</div>
				</div>

			</div>
								<?php }?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Past Bookings</h3>
				</div>
				<div class="panel-body">						

					<div class="booking-panel">

						<table id='past-bookings-table' data-page-size="9" data-filter="#filter" data-page-navigation=".past-pagination" class="table table-bordered footable table-striped table-hover">
							<thead>
								<tr>
									<th>Class</th>
									<th data-hide="phone,tablet">Room</th>
									<th data-type="date">Date</th>
									<th data-hide="phone" data-type="time">Starting</th>
									<th data-hide="phone" data-type="time">Ending</th>
									<th data-hide="phone,tablet">Cancelled</th>
									<th data-hide="phone,tablet">Attended</th>
								</tr>
							</thead>

							<tbody>
								<?php foreach($bookingsPast as $d):

								$startDate = new DateTime($d['start']); 			
								$endDate = new DateTime($d['end']);
								
								if($d['cancelled'] == "0"){
									$cancelled = "No";
								}else{
									$cancelled = "Yes";
								}
								if($d['attended'] == "0"){
									$attended = "No";
								}else{
									$attended = "Yes";
								}
								?>

								<tr  booking_id="<?php echo $d['member_id'] ?>">

									<td class="class_type"><?php echo $d['title'] ?></td>
									<td class="room"><?php echo $d['room'] ?></td>
									<td data-value="<?php echo $startDate->getTimestamp();?>"class="start_date">
										<?php echo $startDate->format('jS F Y') ?>
									</td>
									<td data-value="<?php echo $startDate->getTimestamp();?>" class="start_time">
										<?php echo $startDate->format('h.i A') ?>
									</td>
									<td data-value="<?php echo $endDate->getTimestamp();?>" class="end_time">
										<?php echo $endDate->format('h.i A') ?>
									</td>
									<td class="cancelled"><?php echo $cancelled ?></td>
									<td class="attended"><?php echo $attended ?></td>

								</tr>

							<?php endforeach; ?>
						</tbody>
						
					</table>
				</div>
				
				<div class="pull-left col-xs-12 col-md-4 form-group input-group input-group-md">
					<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
					<input id="filter" placeholder="Search..." type="text" class="form-control " name="filter" value="" />	
				</div>

				<div class="hide-if-no-paging past-pagination pull-right pagination">
					<ul class="pagination"></ul>

				</div>

			</div>

		</div>

		</div>

	</div>

