<?php
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'type'	=> 'password',
	'class'	=> 'form-control',
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

		<h2>Unregister Account</h2>
		<?php echo form_open($this->uri->uri_string(), $form); ?>

		<?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>
		<div class="form-group">
			<?php echo form_label('Password', $password['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_password($password); ?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<?php echo form_submit('cancel', 'Delete account', 'class="btn btn-primary"'); ?>

			</div>
		</div>
		<?php echo form_close(); ?>

	</div>