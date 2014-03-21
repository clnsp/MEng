<!--Basic Loading-->
<div class="row" id="member-loading">
	<div class="col-sm-1 col-md-offset-5" style="text-align: center;">
		<i class="fa fa-spinner fa-spin fa-5x" style="display: inline-block; width: 100%;"></i><br/>
		<h3>Loading</h3>
	</div>
</div>

<table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-bordered dataTable display" style="display: none;" id="member">
	<thead>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Type</th>
			<th>Last Booking</th>
			<th>Status</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Type</th>
			<th>Last Booking</th>
			<th>Status</th>
		</tr>
	</tfoot>
	<tbody>	
		<?php foreach ($users as $usr) { ?> 
		<tr id="<?php echo $usr->id;?>">
			<td class="first_name"><?php echo ucfirst($usr->first_name);?></td>
			<td class="second_name"><?php echo ucfirst($usr->second_name);?></td>
			<td class="email"><?php echo $usr->email;?></td>
			<td class="type"><?php echo ucfirst($usr->type)?></td>
			<td class="last_booking"><?php echo ucfirst($usr->lastClass);?></td>
			<td class="status"><?php if($usr->activated && $usr->banned){echo "Blocked";}else if($usr->activated){echo "Active";}else{echo "Pending";}?></td>
		</tr>	  
		<?php } ?>
	</tbody>
</table>
<?php 
$this->load->view('templates/allan_template/bricks/staff/staff_member_sub_model'); 
$this->load->view('templates/allan_template/bricks/staff/staff_member_model');
?>
