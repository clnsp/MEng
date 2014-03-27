<?php

$new_members = array(
	'name'	=> 'new_members[]',
	'id'	=> 'new_members',
	'value' => $member,
	'size' 	=> 30,
	'class' => 'form-control',
	);

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

$member_users = array();
$admin_users = array();
$super_users = array();

foreach ($member as $m)	$member_users[$m->id] = $m->first_name . ' ' . $m->second_name . ' (' . $m->email . ')';
foreach ($admin as $a)	$admin_users[$a->id] = $a->first_name . ' ' . $a->second_name . ' (' . $a->email . ')';
foreach ($super as $s)	$super_users[$s->id] = $s->first_name . ' ' . $s->second_name . ' (' . $s->email . ')';

$js = 'class="form-control"';
$member_js = 'id="new_members" class="form-control"';
$admin_js = 'id="new_admins" class="form-control"';
$super_js = 'id="new_supers" class="form-control"';
?>

<div class="well well-lg  div-center">

		<h2>Choose Permissions</h2>

		<?php 
		//echo form_open($this->uri->uri_string(), $form); 
		echo form_open('member/createPermissionChanges', $form);
		?>

		<?php //echo form_error($old_password['name']); ?><? //php echo isset($errors[$old_password['name']])?$errors[$old_password['name']]:''; ?>
 		
 		<div id="admin" class="form-group">
		<?php echo form_label('Members', $new_members['id'], $label); ?>
			<div class="col-sm-10">
				<?php if (isset($member_users)) { echo form_multiselect($new_members['name'], $member_users, '',$member_js); } ?>
			</div>
		</div>   

    	<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button class="btn btn-primary" type="button" onclick="adminToMember();">
					<span class="glyphicon glyphicon-arrow-up"></span>
				</button>

				<button class="btn btn-primary" type="button" onclick="memberToAdmin();">
					<span class="glyphicon glyphicon-arrow-down"></span>
				</button>
			</div>
		</div>

		<div id="admin" class="form-group">
		<?php echo form_label('Administrators', $new_admins['id'], $label); ?>
			<div class="col-sm-10">
				<?php if (isset($admin_users)) { echo form_multiselect($new_admins['name'], $admin_users, '',$admin_js); } ?>
			</div>
		</div>

		    	<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button class="btn btn-primary" type="button" onclick="superToAdmin();">
					<span class="glyphicon glyphicon-arrow-up"></span>
				</button>

				<button class="btn btn-primary" type="button" onclick="adminToSuper();">
					<span class="glyphicon glyphicon-arrow-down"></span>
				</button>
			</div>
		</div>
		
		<div id="super" class="form-group">
		<?php echo form_label('Super Administrators', $new_supers['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_multiselect($new_supers['name'], $super_users, '', $super_js); ?>
			</div>
		</div>
		<?php echo form_close(); ?>

	</div>

