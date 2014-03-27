<?php
$firstname = array(
	'name'	=> 'first_name',
	'id'	=> 'first_name',
	'value'	=> set_value('first_name',$fname),
	'maxlength'	=> 80,
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'First name',
	'readonly' => 'readonly',
	);
$secondname = array(
	'name'	=> 'second_name',
	'id'	=> 'second_name',
	'value'	=> set_value('second_name',$sname),
	'maxlength'	=> 80,
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'Second name',
	'readonly' => 'readonly',
	);

$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email',$mail),
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
$twitter = array(
	'name'	=> 'twitter',
	'id'	=> 'twitter',
	'value'	=> set_value('twitter'),
	'maxlength'	=> 15,
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'Twitter ID',
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
	'id'	=> 'confirm_t time.password',
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

$radio_student = array(
	'name'        => 'member_type',
	'id'          => 'student-radio',
	'value'       => '1',
	'checked'     => set_radio('member_type', 1),
	);

$radio_staff = array(
	'name'        => 'member_type',
	'id'          => 'staff-radio',
	'value'       => '2',
	'checked'     => set_radio('member_type', 2),
	);

$radio_student_partner = array(
	'name'        => 'member_type',
	'id'          => 'student-partner-radio',
	'value'       => '3',
	'checked'     => set_radio('member_type', 3),
	);

$radio_staff_partner = array(
	'name'        => 'member_type',
	'id'          => 'staff-partner-radio',
	'value'       => '4',
	'checked'     => set_radio('member_type', 4),
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

	<h2>Registration</h2>
	<p>Lets register you as a member. <br/> Fields marked with * are required.</p>
	<div class="well well-lg  div-center">
		<?php echo form_open($this->uri->uri_string(), $form); ?>
		<?php if(array_key_exists('username',$errors))
				{ echo('<p class="alert alert-danger text-center"><strong>'.$errors['username'] . '</strong></p><br/>');}?>
		
		<div class="form-group">

			<?php echo form_label('User Type *', $user_type['id'], $label); ?>

			<div class="col-sm-10 input-radio-group btn-group">
				<button class="btn btn-default <?php echo ($radio_student['checked'] ? 'active' : ''); ?>" type="button"><?php echo form_radio($radio_student)  ;?>Student</button>
				<button class="btn btn-default <?php echo ($radio_staff['checked'] ? 'active' : ''); ?>" type="button"><?php echo  form_radio($radio_staff); ?>Staff</button>

				<button class="btn btn-default <?php echo ($radio_student_partner['checked'] ? 'active' : ''); ?>" type="button"><?php echo  form_radio($radio_student_partner); ?>Student Partner/Spouse</button>
				<button class="btn btn-default <?php echo ($radio_staff_partner['checked'] ? 'active' : ''); ?>" type="button"><?php echo  form_radio($radio_staff_partner); ?>Staff Partner/Spouse</button>


			</div>
		</div>
		
		
		<?php echo form_error($firstname['name']); ?>
		<div class="form-group">
			<?php echo form_label('First Name', $firstname['id'], $label); ?>
			<div class="col-sm-10">
				<?php echo form_input($firstname); ?>
			</div>
		</div>

		<?php echo form_error($secondname['name']); ?>
		<div class="form-group">
			<?php echo form_label('Second Name', $secondname['id'], $label); ?>
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
					<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
					<?php echo form_input($home_number); ?>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<?php echo form_label('Mobile Number', $mobile_number['id'], $label); ?>
			<div class="col-sm-10">
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
					<?php echo form_input($mobile_number); ?>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<?php echo form_label('Twitter ID', $twitter['id'], $label); ?>
			<div class="col-sm-10">
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-link"></i></span>
					<?php echo form_input($twitter); ?>
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
				<div class="recaptcha_only_if_image">Type what you see</div>
				<div class="recaptcha_only_if_audio">Type what you hear</div>
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
</div>


