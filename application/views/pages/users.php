<table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-bordered dataTable display" id="member">
	<thead>
	  <tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Type</th>
		<th>Membership</th>
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
		<th>Membership</th>
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
		<td class="membership_type"><?php echo ucfirst($usr->membership_type);?></td>
		<td class="last_booking"><?php echo "None";?></td>
		<td class="status"><?php if($usr->activated && $usr->banned){echo "Blocked";}else if($usr->activated){echo "Active";}else{echo "Pending";}?></td>
	  </tr>	  
	  <?php } ?>
	</tbody>
</table>
<?php 
$this->load->view('templates/allan_template/bricks/staff/staff_member_model');
?>