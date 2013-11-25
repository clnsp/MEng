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


					<?php echo form_error($login['name']); ?>
					<?php echo isset($errors[$login['name']])? 'hi' . $errors[$login['name']]:''; ?>

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

