<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
	protected $cloud;
	public function __construct()
	{
		parent::__construct();
		$this->config->load('cloud');
		$this->config->set_item('cloud', $this->cloud);
	}
}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */