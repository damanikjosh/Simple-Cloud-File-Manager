<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/cloud.css">
	<title>My Cloud</title>
</head>
<body>
<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="container-fluid">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<?= anchor('cloud', '<span class="glyphicon glyphicon-cloud"></span> My Cloud', array('class'=>'navbar-brand')) ?>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav navbar-right">
			<p class="navbar-text"><?= $this->session->userdata('email') ?></p>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Options <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Profile</a></li>
					<li><?= anchor('auth/logout', 'Log Out') ?></li>
				</ul>
			</li>
		</ul>
	</div><!-- /.navbar-collapse -->
	</div>
</nav>