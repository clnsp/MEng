<!--Basic Loading-->
<div class="row" id="registration-loading">
<div class="col-sm-1 col-md-offset-5" style="text-align: center;">
<i class="glyphicon glyphicon-refresh" style="display: inline-block; width: 100%;"></i><br/>
<h3>Loading</h3>
</div>
</div>

<?php print_r($users); ?>

<table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-bordered dataTable display" id="registration">
	<thead>
	  <tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>User</th>
		<th>Type</th>
		<th>Register Date</th>
		<th>Options</th>
	  </tr>
	</thead>
	<tfoot>
	  <tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>User</th>
		<th>Type</th>
		<th>Register Date</th>
		<th>Options</th>
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
		<td class="status"><?php echo $usr->created;?></td>
		<td class="options"><div class="btn-group">
  <div class="btn-group">
    <button type="button" class="btn btn-default">Allow</button>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-default">Block</button>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-default">Delete</button>
  </div>
</div></td>
	  </tr>	  
	  <?php } ?>
	</tbody>
</table>
