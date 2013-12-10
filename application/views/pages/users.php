<link rel="stylesheet" href="<?php echo base_url();?>assets/datatab/css/DT_bootstrap.css"/>
<table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-bordered dataTable display" id="member">
	<thead>
	  <tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
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
		<th>Membership</th>
		<th>Last Booking</th>
		<th>Status</th>
	  </tr>
	</tfoot>
	<tbody>		
	  <?php foreach ($users as $usr) { ?> 
	  <tr id="<?php echo $usr->id;?>">
		<td><?php echo  ucfirst($usr->first_name);?></td>
		<td><?php echo  ucfirst($usr->second_name);?></td>
		<td><?php echo  $usr->email;?></td>
		<td><?php echo "None";?></td>
		<td><?php echo "None";?></td>
		<td><?php if($usr->activated && $usr->banned){echo "Blocked";}else if($usr->activated){echo "Active";}else{echo "In-Active";}?></td>
	  </tr>	  
	  <?php } ?>
	</tbody>
</table>
<?php 
$this->load->view('templates/allan_template/bricks/staff/staff_member_model');
?>