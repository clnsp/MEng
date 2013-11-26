<?php
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'type'	=> 'password',
	'class' => 'form-control',
	);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'type'	=> 'email',
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
		


		<h2>Change Email</h2>
		<?php echo form_open($this->uri->uri_string(), $form); ?>

		<?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>

		<div class="form-group">


			<?php echo form_label('Password', $password['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_password($password); ?>
			</div>
		</div>

		<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
		<div class="form-group">
			<?php echo form_label('New email address', $email['id'], $label); ?>

			<div class="col-sm-10">
				<?php echo form_input($email); ?>

			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">

				<?php echo form_submit('change', 'Send confirmation email', 'class="btn btn-primary"'); ?>

			</div>
		</div>
		<?php echo form_close(); ?>

	</div>