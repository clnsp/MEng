<?php
$old_password = array(
	'name'	=> 'old_password',
	'id'	=> 'old_password',
	'value' => set_value('old_password'),
	'size' 	=> 30,
	'class' => 'form-control',
	);
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'class' => 'form-control',
	);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
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

		<h2>Change Password</h2>

		<?php echo form_open($this->uri->uri_string(), $form); ?>

		<?php echo form_error($old_password['name']); ?><?php echo isset($errors[$old_password['name']])?$errors[$old_password['name']]:''; ?>
		<div class="form-group">
			<?php echo form_label('Old Password', $old_password['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_password($old_password); ?>
			</div>
		</div>

		<?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?>
		<div class="form-group">
			<?php echo form_label('New Password', $new_password['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_password($new_password); ?>
			</div>
		</div>

		<?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?>
		<div class="form-group">
			<?php echo form_label('Confirm New Password', $confirm_new_password['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_password($confirm_new_password); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">

				<?php echo form_submit('change', 'Change Password', 'class="btn btn-primary"'); ?>

			</div>
		</div>
		<?php echo form_close(); ?>

	</div>