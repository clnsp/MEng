<?php
$first_name = array(
	'name'	=> 'first_name',
	'id'	=> 'first_name',
	'value' => $member -> first_name,
	'size' 	=> 30,
	'class' => 'form-control',
	);
$second_name = array(
	'name'	=> 'second_name',
	'id'	=> 'second_name',
	'value' => $member -> second_name,
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
?>

<div class="well well-lg  div-center">

		<h2>Choose Administrators</h2>

		<?php 
		//echo form_open($this->uri->uri_string(), $form); 
		echo form_open('member/setAdministrators', $form);
		?>

		<?php //echo form_error($old_password['name']); ?><? //php echo isset($errors[$old_password['name']])?$errors[$old_password['name']]:''; ?>

		<div class="form-group">
		<?php echo form_label('First Name', $first_name['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_input($first_name); ?>
			</div>
		</div>

		<div class="form-group">
		<?php echo form_label('Surname', $second_name['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_input($second_name); ?>
			</div>
		</div>
		

		
		<div class="form-group">
		<?php echo form_label('Home Phone Number', $home_number['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_input($home_number); ?>
			</div>
		</div>
		
		<div class="form-group">
		<?php echo form_label('Mobile Phone Number', $mobile_number['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_input($mobile_number); ?>
			</div>
		</div>
		
		<div class="form-group">
		<?php echo form_label('Twitter', $twitter['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_input($twitter); ?>
			</div>
		</div>
		
		<div class="form-group">
		<?php echo form_label('Communication', $comms_preference['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_input($comms_preference); ?>
			</div>
		</div>

		<!--
		<div class="form-group">
		<?php echo form_label('Email', $email['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_input($email); ?>
			</div>
		</div>
		-- >
		
<!--
		<?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?>
		<div class="form-group"><?php echo form_label('New Password', $new_password['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_password($new_password); ?>
			</div>
		</div>

		<?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?>
		<div class="form-group"><?php echo form_label('Confirm New Password', $confirm_new_password['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_password($confirm_new_password); ?>
			</div>
		</div>
-->

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">

				<?php echo form_submit('change', 'Save Changes', 'class="btn btn-primary"'); ?>
				<?php echo form_reset('reset', 'Reset', 'class="btn btn-primary"'); ?>

			</div>
		</div>
		<?php echo form_close(); ?>

	</div>