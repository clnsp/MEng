<?php
if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
		'class' => 'form-control',
		'placeholder' => 'Username',

		);
}
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'Email Address',

	);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'type'  => 'password',
	'class' => 'form-control',
	'placeholder' => 'Password',
	
	);


$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'Confirm Password',
	);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
	);
$label = array(
	'class' => 'col-sm-2 control-label',
	);

$form = array(
	'class' => 'form-horizontal',
	'role' => 'form',
	);

	?>	

	<h1>Registration</h1>
	<p>Lorem ipsum dolor sit amet, feugiat apeirian contentiones ut ius, ius probatus rationibus repudiandae ad. Ad sed vero periculis. An posse delectus philosophia vel. Ne ius pertinax consectetuer, eam ex mundi aeterno dissentiunt. Saepe ancillae assueverit vis et, eam rebum delenit deterruisset cu.</p>
	<div class="well well-lg  div-center">
		<?php echo form_open($this->uri->uri_string(), $form); ?>
		<?php if ($use_username) { ?>
		<div class="form-group">
			<?php echo form_label('Username', $username['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_input($username); ?>
			</div>
			<?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?>
		</div>
		<?php } ?>

		<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>

		<div class="form-group">
			<?php echo form_label('Email', $email['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_input($email); ?>
			</div>
		</div>
		
		<?php echo form_error($password['name']); ?>


		<div class="form-group">
			<?php echo form_label('Password', $password['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_password($password); ?>
			</div>
		</div>
		<?php echo form_error($confirm_password['name']); ?>

		<div class="form-group">
			<?php echo form_label('Confirm Password', $confirm_password['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_password($confirm_password); ?>
			</div>
		</div>

		<?php if ($captcha_registration) {
			if ($use_recaptcha) { ?>


			<div class="form-group">
				<div id="recaptcha_image"></div>
			</td>
			<td>
				<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
				<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
				<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
			</td>
		</div>


		<tr>
			<td>
				<div class="recaptcha_only_if_image">Enter the words above</div>
				<div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
			</td>
			<td><input type="text" id="recaptcha_response_field" name="recaptcha_response_field" /></td>
			<td style="color: red;"><?php echo form_error('recaptcha_response_field'); ?></td>
			<?php echo $recaptcha_html; ?>
		</tr>
		<?php } else { ?>
		<tr>
			<td colspan="3">
				<p>Enter the code exactly as it appears:</p>
				<?php echo $captcha_html; ?>
			</td>
		</tr>
		<tr>
			<td><?php echo form_label('Confirmation Code', $captcha['id']); ?></td>
			<td><?php echo form_input($captcha); ?></td>
			<td style="color: red;"><?php echo form_error($captcha['name']); ?></td>
		</tr>
		<?php }
	} ?>


	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">

			<?php echo form_submit('register', 'Register', 'class="btn btn-primary"'); ?>

		</div>
	</div>

	<?php echo form_close(); ?>



