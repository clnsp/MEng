<?php
$firstname = array(
	'name'	=> 'first_name',
	'id'	=> 'first_name',
	'value'	=> set_value('first_name'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'First Name',
	);
$secondname = array(
	'name'	=> 'second_name',
	'id'	=> 'second_name',
	'value'	=> set_value('second_name'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'Second Name',
	);

$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'Email Address',
	);
$home_number = array(
	'name'	=> 'home_number',
	'id'	=> 'home_number',
	'value'	=> set_value('home_number'),
	'maxlength'	=> 12,
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'Home Number (Excluding 0)',
	);
$mobile_number = array(
	'name'	=> 'mobile_number',
	'id'	=> 'mobile_number',
	'value'	=> set_value('mobile_number'),
	'maxlength'	=> 12,
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'Mobile Number (Excluding 0)',
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

$comm_prefs = array(
	'name' => 'comms_preference',
	'id' => 'comms_preference',
	);

$comm_prefs_options = array('1'  => 'Email only','2'  => ' Email and SMS','3'  => 'Email, SMS and Twitter',);

$user_type = array(
	'name' => 'member_type',
	'id' => 'member_type',
	);

$radio_associate = array(
	'name'        => 'member_type',
	'id'          => 'associate-radio',
	'value'       => '1',
	'checked'     => FALSE,
	);

$radio_retired_staff  = array(
	'name'        => 'member_type',
	'id'          => 'retired-staff-radio',
	'value'       => '2',
	'checked'     => FALSE,
	);

$radio_external_student   = array(
	'name'        => 'member_type',
	'id'          => 'external-student-radio',
	'value'       => '3',
	'checked'     => FALSE,
	);

$radio_graduate  = array(
	'name'        => 'member_type',
	'id'          => 'graduate-radio',
	'value'       => '4',
	'checked'     => FALSE,
	);

$radio_affiliate = array(
	'name'        => 'type',
	'id'          => 'affiliate-radio',
	'value'       => '1',
	'checked'     => FALSE,
	);

$radio_affiliate_spouse  = array(
	'name'        => 'type',
	'id'          => 'retired-staff-radio',
	'value'       => '2',
	'checked'     => FALSE,
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
	<p>Lets register you as a member. <br/> Fields marked with * are required.</p>
	<div class="well well-lg  div-center">
		<?php echo form_open($this->uri->uri_string(), $form); ?>
		
		<div class="form-group">
			<?php echo form_label('User *', $user_type['id'], $label); ?>
			<div class="col-sm-10 input-radio-group btn-group">
				<button class="btn btn-default" type="button"><?php echo form_radio($radio_affiliate)  ;?>Affiliate</button>
				<button class="btn btn-default" type="button"><?php echo  form_radio($radio_affiliate_spouse); ?>Spouse / Partner of Affiliate</button>
			</div>
		</div>
		
		<div class="form-group">
			<?php echo form_label('Affiliate  Type *', $user_type['id'], $label); ?>
			<div class="col-sm-10 input-radio-group btn-group">
				<button class="btn btn-default" type="button"><?php echo form_radio($radio_associate); ?>Associate</button>
				<button class="btn btn-default" type="button"><?php echo form_radio($radio_retired_staff)  ;?>Retired Staff</button>
				<button class="btn btn-default" type="button"><?php echo form_radio($radio_external_student);?>External Student</button>
				<button class="btn btn-default" type="button"><?php echo form_radio($radio_graduate);?>Graduate</button>
			</div>
		</div>
		
		<?php echo form_error($firstname['name']); ?>
		<div class="form-group">
			<?php echo form_label('First Name *', $firstname['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_input($firstname); ?>
			</div>
		</div>

		<?php echo form_error($secondname['name']); ?>
		<div class="form-group">
			<?php echo form_label('Second Name *', $secondname['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_input($secondname); ?>
			</div>
		</div>

		<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
		<div class="form-group">
			<?php echo form_label('Email *', $email['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_input($email); ?>
			</div>
		</div>
		
		<div class="form-group">
			<?php echo form_label('Home Number', $home_number['id'], $label); ?>
			<div class="col-sm-10">
				<div class="input-group">
					<span class="input-group-addon">+44</span>
					<?php echo form_input($home_number); ?>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<?php echo form_label('Mobile Number', $mobile_number['id'], $label); ?>
			<div class="col-sm-10">
				<div class="input-group">
					<span class="input-group-addon">+44</span>
					<?php echo form_input($mobile_number); ?>
				</div>
			</div>
		</div>
		
		<?php echo form_error($password['name']); ?>
		<div class="form-group">
			<?php echo form_label('Password *', $password['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_password($password); ?>
			</div>
		</div>
		
		<?php echo form_error($confirm_password['name']); ?>
		<div class="form-group">
			<?php echo form_label('Confirm Password *', $confirm_password['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_password($confirm_password); ?>
			</div>
		</div>
		
		<div class="form-group">
			<?php echo form_label('Communication Preferences *', $comm_prefs['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo  form_dropdown($comm_prefs['name'], $comm_prefs_options, '1','class="form-control"'); ?>
			</div>
		</div>

		<?php if ($captcha_registration) {
			if ($use_recaptcha) { ?>


		<div class = "row">
		<div class="col-md-1"></div>
		<div class="col-md-1"></div>
			<div class="form-group">
			<div class="col-sm-5">
				<div  class="pull-left" id="recaptcha_image"></div>
			
			
		<div class="btn-group-vertica pull-left">
									<a class="btn btn-default" alt="Get another CAPTCHA" href="javascript:Recaptcha.reload()"><i class="glyphicon glyphicon-refresh"></i></a>
									<div class="recaptcha_only_if_image"><a alt ="Get an audio CAPTCHA" class="btn btn-default" href="javascript:Recaptcha.switch_type('audio')"><i class="glyphicon glyphicon-volume-up"></i></a></div>
									<div class="recaptcha_only_if_audio"><a alt="Get an image CAPTCHA" class="btn btn-default"href="javascript:Recaptcha.switch_type('image')"><i class="glyphicon glyphicon-picture"></i></a></div>
								</div>
			
		</div>
		</div>
	</div>

<div class = "row">
			<div class="col-md-1"></div>
		<div class="col-md-1"></div>

		<div class="form-group">
		<div class="col-sm-5">
								<div class="recaptcha_only_if_image"><b>Type What You See *</b></div>
								<div class="recaptcha_only_if_audio"><b>Type What You Hear *</b></div>
								<input type="text" class="form-control" id="recaptcha_response_field" name="recaptcha_response_field" />
								<td style="color: red;"><?php echo form_error('recaptcha_response_field'); ?></td>
								</div>
							</div>
															<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>
<script type="text/javascript" src="https://www.google.com/recaptcha/api/challenge?k=6LdW2uoSAAAAAPMDeZJTD7NIsJ6gdKRKKmcbQ_0Z"></script>
			<?php echo $recaptcha_html; ?>

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


<div class = "row">
			<div class="col-sm-2"></div>
	

		<div class="form-group">
		<div class="col-sm-5">
		
	<?php echo ("&nbsp");?>		<?php echo form_submit('register', 'Register', 'class="btn btn-primary"'); ?>

		</div>
	</div>
	

	<?php echo form_close(); ?>
	</div>

</div>
