<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = 'Email';
} else {
	$login_label = 'Email';
}
?>


<div class="well well-lg text-center col-md-8 div-center">

<p>Please enter your email address to request a new password.</p>

<?php echo form_open($this->uri->uri_string(), array('class' => 'form-inline', 'role'=>'form')); ?>
<?php echo form_label($login_label, $login['id']); ?>

<div class="form-group">
		<?php echo form_input($login, '', 'class="form-control"'); ?>
	
		
		<?php echo form_error($login['name']); ?>
		
		<?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
		
</div>
<?php echo form_submit('reset', 'Reset Password', 'class="btn btn-default"'); ?>

<?php echo form_close(); ?>
</div>