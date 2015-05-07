<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cloud extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// User harus login untuk mengakses cloud
		if($this->session->userdata('user_id') == NULL) redirect('auth');
	}

	public function index()
	{
		redirect('cloud/folder');
	}

	public function folder()
	{
		// Mendapatkan user id dari php session
		$user_id = $this->session->userdata('user_id');

		// Mendapatkan path relatif folder dari parameter get
		$path = urldecode($this->input->get('path'));

		// Ambil data dari model
		$this->load->model('Cloud_model');
		$folders = $this->Cloud_model->get_folders($user_id, $path);
		$files = $this->Cloud_model->get_files($user_id, $path);

		// Menampilkan view
		$data = array(
			'path' => $path,
			'folders' => $folders,
			'files' => $files
		);
		$this->load->view('cloud/folder', $data);
	}

	public function upload()
	{
		
	}

}