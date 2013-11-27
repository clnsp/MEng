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
					<?php if ($show_captcha) {?>

					<div class="well text-center">
						

						<div class="form-group">

							<div class="div-center">
								<div class="pull-left" id="recaptcha_image"></div>

								<div class="btn-group-vertica pull-left">
									<a class="btn btn-default" alt="Get another CAPTCHA" href="javascript:Recaptcha.reload()"><i class="glyphicon glyphicon-refresh"></i></a>
									<div class="recaptcha_only_if_image"><a alt ="Get an audio CAPTCHA" class="btn btn-default" href="javascript:Recaptcha.switch_type('audio')"><i class="glyphicon glyphicon-volume-up"></i></a></div>
									<div class="recaptcha_only_if_audio"><a alt="Get an image CAPTCHA" class="btn btn-default"href="javascript:Recaptcha.switch_type('image')"><i class="glyphicon glyphicon-picture"></i></a></div>
								</div>
							</div>
							<?php echo form_error('recaptcha_response_field'); ?>

							<div class="form-group">
								<input type="text" class="form-control recaptcha_only_if_image" placeholder = "Enter the words above" id="recaptcha_response_field" name="recaptcha_response_field" />
								<input type="text" class="form-control recaptcha_only_if_audio" placeholder = "Enter the numbers you hear" id="recaptcha_response_field" name="recaptcha_response_field" />
								<?php echo $recaptcha_html; ?>
							</div>
						</div>
					</div>
					<?php }?>

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

