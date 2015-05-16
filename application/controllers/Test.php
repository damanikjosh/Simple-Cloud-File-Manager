<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {


	public function index()
	{
		$this->load->helper(array('path'));
		echo sha1('demo');
		$this->config->load('cloud');
		$config = $this->config->item('cloud');
		print_r($config);
	}

}

/* End of file Test.php */
/* Location: ./application/controllers/Test.php */