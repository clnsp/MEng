<?php
$first_name = array(
	'name'	=> 'first_name',
	'id'	=> 'first_name',
	'value' => ucfirst($member -> first_name),
	'size' 	=> 30,
	'class' => 'form-control',
	);
$second_name = array(
	'name'	=> 'second_name',
	'id'	=> 'second_name',
	'value' => ucfirst($member -> second_name),
	'size' 	=> 30,
	'class' => 'form-control',
	);
$home_number = array(
	'name'	=> 'home_number',
	'id'	=> 'home_number',
	'value' => $member -> home_number,
	'size' 	=> 30,
	'class' => 'form-control',
	);
$mobile_number = array(
	'name'	=> 'mobile_number',
	'id'	=> 'mobile_number',
	'value' => $member -> mobile_number,
	'size' 	=> 30,
	'class' => 'form-control',
	);
$twitter = array(
	'name'	=> 'twitter',
	'id'	=> 'twitter',
	'value' => $member -> twitter,
	'size' 	=> 30,
	'class' => 'form-control',
	);
$comms_preference = array(
	'name'	=> 'comms_preference',
	'id'	=> 'comms_preference',
	'value' => $member -> comms_preference,
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

//print_r($comm_prefs);
foreach ($comm_prefs as $p)	$prefs[$p->id] = $p->comms_preference;

$js = 'class="form-control"';
?>

<div class="well well-lg  div-center">

		<h2>Change Account Information</h2>

		<?php 
		//echo form_open($this->uri->uri_string(), $form); 
		echo form_open('member/createUserChanges', $form);
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
				<?php
					foreach ($comm_prefs as $p) {
						$data = array(
    						'name'        => 'new_preferences[]',
    						'id'          => 'new_preferences[]',
    						'value'       => $p->id,
    						'checked'     => TRUE,
    					);
    					echo form_checkbox($data);
    					echo form_label($p->comms_preference); ?> <br>
    					<?php
					} ?>
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

				<?php echo form_submit('change', 'Save Changes', 'class="btn btn-success"'); ?>
				<?php echo form_reset('reset', 'Reset Unsaved Changes', 'class="btn btn-danger"'); ?>

			</div>
		</div>
		<?php echo form_close(); ?>

	</div>