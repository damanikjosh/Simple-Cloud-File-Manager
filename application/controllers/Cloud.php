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

	private function _encode() {

	}

	/*
	private function _breadcrumbs($path) {
		$path_segments = array_filter(explode('/', $path));
		$segment_url = '';
		$breadcrumbs = array();
		foreach($path_segments as $segment) { 
			$segment_url .= $segment . '/';
			array_push($breadcrumbs, $segment_url);
		}
		return $breadcrumbs;
	}
	*/

	public function index()
	{
		redirect('cloud/folder');
	}

	public function folder()
	{
		// Mendapatkan user id dari php session
		$user_id = $this->session->userdata('user_id');

		// Mendapatkan path relatif folder dari parameter get
		$path = '';
		for($i=3; $this->uri->segment($i) !== NULL; $i++) {
			$path .= urldecode($this->uri->segment($i)) . '/';
		}
		$sort = $this->input->get('sort');
		$asc = $this->input->get('asc');

		// Ambil data dari model
		$this->load->model('Cloud_model');
		$folders = $this->Cloud_model->get_folders($user_id, $path);
		$files = $this->Cloud_model->get_files($user_id, $path);

		if($folders == NOT_EXIST) redirect('erros/error_404');

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
		// $breadcrumbs = $this->_breadcrumbs($path);
		$data = array(
			'path' => $path,
			'folders' => $folders,
			'files' => $files,
			// 'breadcrumbs' => $breadcrumbs,
			'sort' => $sort,
			'asc' => $asc
		);
		$this->load->view('cloud/header', array('path'=>$path));
		$this->load->view('cloud/folder', $data);
		$this->load->view('cloud/footer');
	}

	public function upload()
	{
		
	}

}