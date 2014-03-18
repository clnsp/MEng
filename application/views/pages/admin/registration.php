<!--Basic Loading-->
<div class="row" id="registration-loading">
<div class="col-sm-1 col-md-offset-5" style="text-align: center;">
<i class="fa fa-spinner fa-spin fa-5x" style="display: inline-block; width: 100%;"></i><br/>
<h3>Loading</h3>
</div>
</div>

<table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-bordered dataTable display" style="display: none;" id="registration">
	<thead>
	  <tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>User</th>
		<th>Type</th>
		<th>Date</th>
	  </tr>
	</thead>
	<tfoot>
	  <tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>User</th>
		<th>Type</th>
		<th>Date</th>
	  </tr>
	</tfoot>
	<tbody>	
	  <?php foreach ($users as $usr) { ?> 
	  <tr id="<?php echo $usr->id;?>">
		<td class="first_name"><?php echo ucfirst($usr->first_name);?></td>
		<td class="second_name"><?php echo ucfirst($usr->second_name);?></td>
		<td class="email"><?php echo $usr->email;?></td>
		<td class="type"><?php echo ucfirst($usr->type)?></td>
		<td class="last_booking"><?php ?></td>
		<td class="status"><?php i?></td>
	  </tr>	  
	  <?php } ?>
	</tbody>
</table>
