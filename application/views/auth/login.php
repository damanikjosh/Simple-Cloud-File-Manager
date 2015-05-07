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
	<h1>Login</h1>
	<?php echo form_open('auth/login'); ?>
	<p>
		<?php echo form_label('Email Address:', 'email_address'); ?>
		<?php echo form_input('email_address', set_value('email_address'), 'id=email_address'); ?>
	</p>
	<p>
		<?php echo form_label('Password:', 'password'); ?>
		<?php echo form_password('password', '', 'id=password'); ?>
	</p>
	<?php echo form_submit('submit', 'Login'); ?>
	<?php echo form_close(); ?>
	<div class="error">
		<?php echo validation_errors(); ?>
		<?php if(isset($error)) echo '<p>' . $error . '</p>' ?>
	</div>
</body>
</html>