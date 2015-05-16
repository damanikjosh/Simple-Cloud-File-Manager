<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function _cloud_config($edit_config)
	{
		$this->config->set_item('cloud', $this->edit_config);
	}
}

/* End of file config_model.php */
/* Location: ./application/models/config_model.php */