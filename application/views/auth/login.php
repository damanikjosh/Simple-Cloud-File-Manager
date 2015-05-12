	<div class="cloud">
		<div class="cloud-logo">
			<span class="glyphicon glyphicon-cloud"></span><p class="logo-text"><a href="/"><b>Simple</b>Cloud</p></a>
		</div>
	</div>
	<div class="login-form">
	<?php echo form_open('auth/login', array('class'=>'form-inline')); ?>
	<div class="form-group">
		<label class="sr-only" for="email_address">Email address</label>
		<input type="text" name="email_address" class="form-control" placeholder="Email Address" value="<?= set_value('email_address') ?>" rel="tooltip-manual-bottom" title="<?= form_error('email_address', ' ', ' '); ?>" />
	</div>
	<div class="form-group">
		<label class="sr-only" for="password">Password</label>
		<input type="password" name="password" class="form-control" placeholder="Password" rel="tooltip-manual-bottom" title="<?= form_error('password', ' ', ' '); ?>" />
	</div>
	<button type="submit" class="btn btn-success">Log In</button>
	<?php echo form_close(); ?>
	</div>
	<?php if(isset($error)) { ?>
	<div class="alert alert-danger alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo '<p>' . $error . '</p>' ?>
	</div>
	<?php } ?>
	