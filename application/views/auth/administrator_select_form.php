<?php

$new_admins = array(
	'name'	=> 'new_admins[]',
	'id'	=> 'new_admins',
	'value' => $admin,
	'size' 	=> 30,
	'class' => 'form-control',
	);
	
$new_supers = array(
	'name'	=> 'new_supers[]',
	'id'	=> 'new_supers',
	'value' => $super,
	'size' 	=> 30,
	'class' => 'form-control',
	);


$label = array(
	'class' => 'col-sm-2 control-label',
	);

$form = array(
	'class' => 'form-horizontal',
	'role' => 'form',
	);

foreach ($admin as $a)	$admin_users[$a->id] = $a->first_name . ' ' . $a->second_name . ' (' . $a->email . ')';
foreach ($super as $s)	$super_users[$s->id] = $s->first_name . ' ' . $s->second_name . ' (' . $s->email . ')';

$js = 'class="form-control"';
?>

<div class="well well-lg  div-center">

		<h2>Choose Administrators</h2>

		<?php 
		//echo form_open($this->uri->uri_string(), $form); 
		echo form_open('member/createPermissionChanges', $form);
		?>

		<?php //echo form_error($old_password['name']); ?><? //php echo isset($errors[$old_password['name']])?$errors[$old_password['name']]:''; ?>
    
		<div class="form-group">
		<?php echo form_label('Administrators', $new_admins['id'], $label); ?>
			<div class="col-sm-10">
				<?php if (isset($admin_users)) { echo form_multiselect($new_admins['name'], $admin_users, $js); } ?>
			</div>
		</div>
		
		<div class="form-group">
		<?php echo form_label('Super Administrators', $new_supers['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_multiselect($new_supers['name'], $super_users, $js); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">

				<?php echo form_submit('change', 'Swap Selected', 'class="btn btn-primary"'); ?>
				<?php echo form_reset('reset', 'Reset', 'class="btn btn-primary"'); ?>

			</div>
		</div>
		<?php echo form_close(); ?>

	</div>
<!-- CUSTOM MEMBERSHIP SECTION -->
<div class="well well-lg  div-center">
		<h2>Create Membership</h2>
		<div class="row">
		<!-- CURRENT MEMBERSHIPS -->
		<div id="memberships" class="col-lg-6">
			<table class="footable" data-filter="#filter">
  <thead>
    <tr>
      <th data-sort-initial="descending" data-class="expand">
        Name
      </th>
      <th data-sort-ignore="true">
        Start Date
      </th>
      <th >
        End Date
      </th>
      <th data-type="numeric">
        User Groups
      </th>
    </tr>
  </thead>
  <tbody>
  <tr>
  <td></td>
  <td></td>
  <td></td>
  <td></td>   
  </tr>  
  </tbody>
  </table>
			
		
		
		
		</div>
		
		<!-- CALANDERS -->
		<div id="memberships" class="col-lg-6">
		<div id="date-selector"></div>
		  <div class="form-group">
    <label for="MembershipName">Membership Name</label>
    <input type="text" class="form-control" id="MembershipName" placeholder="Enter Membership Name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Member Account Types</label>
<select multiple class="form-control">
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
</select>
<span class="help-block">Hold the control key to select multiple members.</span>
  </div>	

				<input type="button" name="change" value="Create Membership" class="btn btn-primary">				<input type="button" name="reset" value="Reset" class="btn btn-primary">
			</div>
</div>	
</div>
	</div>
