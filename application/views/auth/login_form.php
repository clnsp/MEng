<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'Username',
	);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'Password',
	);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'type' => 'checkbox',

	);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
	);
	?>
	<?php echo form_open($this->uri->uri_string(), 'id="login-form"'); ?>

	<div class="row">
		<div class="col-md-6 div-center text-center">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Please Login</h3>
				</div>
				<div class="panel-body">


					<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>

					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
						<?php echo form_input($login); ?>
					</div>


					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
						<?php echo form_password($password); ?>

					</div>
					<div class="form-group">
						<?php echo anchor('/auth/forgot_password/', 'Forgot password?', 'class="pull-left"'); ?>

						<?php echo form_submit('submit', 'Login', 'class="btn btn-primary btn-default pull-right"'); ?>

						<div id ="remember-me" class="checkbox text-left pull-right clearfix">
							<label>
						<?php echo form_checkbox($remember); ?>  Remember Me		
							</label>
						</div>
					</div>

				</form>

			</div>
		</div>
	</div>
</div>



<?php
/*
?>
<table>
	<tr>
		<td><?php echo form_label($login_label, $login['id']); ?></td>
		<td><?php echo form_input($login, 'class="form-control" placeholder="Username"'); ?></td>
		<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
	</tr>
	<tr>
		<td><?php echo form_label('Password', $password['id']); ?></td>
		<td><?php echo form_password($password); ?></td>
		<td style="color: red;"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></td>
	</tr>

	<?php if ($show_captcha) {
		if ($use_recaptcha) { ?>
	<tr>
		<td colspan="2">
			<div id="recaptcha_image"></div>
		</td>
		<td>
			<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
			<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
			<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
		</td>
	</tr>
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

	<tr>
		<td colspan="3">
			<?php echo form_checkbox($remember); ?>
			<?php echo form_label('Remember me', $remember['id']); ?>
			<?php echo anchor('/auth/forgot_password/', 'Forgot password'); ?>
			<?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/auth/register/', 'Register'); ?>
		</td>
	</tr>
</table>
<?php echo form_submit('submit', 'Let me in'); ?>
<?php echo form_close(); ?>
*/