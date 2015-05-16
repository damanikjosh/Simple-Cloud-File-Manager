<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$cloud['upload_path'] 	= '/usr/local/www/cloud/';
$cloud['allowed_types']	= '*';
$cloud['overwrite']		= FALSE;
$cloud['max_size']		= 3000;
$cloud['remove_spaces']	= TRUE;

$config['cloud'] = $cloud;