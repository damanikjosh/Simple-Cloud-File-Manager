<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login View</title>
	<style type="text/css">
	label{
		display: block;
	}
	.error {
		color: red;
	}
	</style>
</head>
<body>
	<p><?= anchor('', 'Home'); ?></p>
	<h1>Register</h1>
	<?php echo form_open('auth/register'); ?>
	<p>
		<?php echo form_label('Email Address:', 'email_address'); ?>
		<?php echo form_input('email_address', set_value('email_address'), 'id=email_address'); ?>
	</p>
	<p>
		<?php echo form_label('First Name:', 'first_name'); ?>
		<?php echo form_input('first_name', set_value('first_name'), 'id=first_name'); ?>
	</p>
	<p>
		<?php echo form_label('Last Name:', 'last_name'); ?>
		<?php echo form_input('last_name', set_value('last_name'), 'id=last_name'); ?>
	</p>
	<p>
		<?php echo form_label('Password:', 'password'); ?>
		<?php echo form_password('password', '', 'id=password'); ?>
	</p>
	<?php echo form_submit('submit', 'Register'); ?>
	<?php echo form_close(); ?>
	<div class="error">
		<?php echo validation_errors(); ?>
		<?php if(isset($error)) echo '<p>' . $error . '</p>' ?>
	</div>
</body>
</html>