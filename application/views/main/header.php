<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/main.css">
	<title><?= isset($title)?$title:'SimpleCloud' ?></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<?= anchor('cloud', '<span class="glyphicon glyphicon-cloud"></span> <b>Simple</b>Cloud', array('class'=>'navbar-brand')) ?>
	</div>
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav navbar-right">
			<li><a href="<?= site_url('auth/profile') ?>"><span class="glyphicon glyphicon-user"></span> <?= $this->session->userdata('username') ?></a></li>
			<?php if($this->session->userdata('is_admin')==1): ?>
			<li><a href="<?= site_url('admin') ?>"><span class="glyphicon glyphicon-cog"></span> Admin Panel</a></li>
			<?php endif ?>
			<li><a href="<?= site_url('auth/logout') ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		</ul>
	</div>
	</div>
</nav>
<div id="alert">
	<?php if(isset($error)&&$error!==''): ?>
	<div class="alert alert-danger alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Error</b></span><span> <?= $error?></span>
	</div>
	<?php endif ?>
	<?php if(isset($_GET['error'])): ?>
	<div class="alert alert-danger alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Error</b></span><span> <?= $this->input->get('error') ?></span>
	</div>
	<?php endif ?>
	<?php if($this->input->get('upload_success')): ?>
	<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Success</b></span><span> File <?= $this->input->get('upload_name') ?> uploaded</span>
	</div>
	<?php endif ?>
	<?php if($this->input->get('create_success')): ?>
	<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Success</b></span><span> <?= $this->input->get('create_name') ?> created</span>
	</div>
	<?php endif ?>
	<?php if($this->input->get('delete_success')): ?>
	<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Success</b></span><span> <?= $this->input->get('delete_name') ?> deleted</span>
	</div>
	<?php endif ?>
	<?php if($this->input->get('modify_success')): ?>
	<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Success</b></span><span> <?= $this->input->get('old_name') ?>'s username changed to <?= $this->input->get('new_name') ?></span>
	</div>
	<?php endif ?>
	<?php if($this->input->get('password_success')): ?>
	<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Success</b></span><span> <?= $this->input->get('username') ?>'s password changed</span>
	</div>
	<?php endif ?>
	<?php if($this->input->get('promote_success')): ?>
	<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Success</b></span><span> <?= $this->input->get('username') ?> promoted as Admin</span>
	</div>
	<?php endif ?>
	<?php if($this->input->get('demote_success')): ?>
	<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Success</b></span><span> <?= $this->input->get('username') ?> demoted from Admin</span>
	</div>
	<?php endif ?>
	<?php if($this->input->get('settings_success')): ?>
	<div class="alert alert-success alert-fixed-top alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<span><b>Success</b></span><span> Cloud settings changed</span>
	</div>
	<?php endif ?>

</div>