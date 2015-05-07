<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cloud extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// User harus login untuk mengakses cloud
		if($this->session->userdata('user_id') == NULL) redirect('auth');
	}

	private function _sortfile($data, $idx, $asc) {
		if(!isset($data[0][$idx])) return $data;
		if(is_string($data[0][$idx])) {
			foreach ($data as $key => $row) {
			    $sort[$key]  = array_map('strtolower', $row)[$idx]; 
			}
		}
		else {
			foreach ($data as $key => $row) {
			    $sort[$key]  = $row[$idx]; 
			}
		}
		array_multisort($sort, $asc, $data);
		return $data;
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
		$sort = $this->input->get('sort');
		$asc = $this->input->get('asc');

		// Ambil data dari model
		$this->load->model('Cloud_model');
		$folders = $this->Cloud_model->get_folders($user_id, $path);
		$files = $this->Cloud_model->get_files($user_id, $path);

		// Menampilkan view
		if($sort!==NULL){
			if($asc||$asc==NULL) $asc = SORT_ASC;
			else $asc = SORT_DESC;
		}
		else {
			$sort = 'name'; $asc = SORT_ASC;
		}
		$folders = $this->_sortfile($folders, $sort, $asc);
		$files = $this->_sortfile($files, $sort, $asc);
		$data = array(
			'path' => $path,
			'folders' => $folders,
			'files' => $files,
			'sort' => $sort,
			'asc' => $asc
		);
		$this->load->view('cloud/header');
		$this->load->view('cloud/folder', $data);
		$this->load->view('cloud/footer');
	}

	public function upload()
	{
		
	}

}