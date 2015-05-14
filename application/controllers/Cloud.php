<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cloud extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// User harus login untuk mengakses cloud
		if($this->session->userdata('user_id') == NULL) redirect('auth');
		$this->load->model('Cloud_model');
	}

	private function _breadcrumbs($path_segments) {
		$url = '';
		$breadcrumbs = array();
		$real_path_segments = $this->Cloud_model->real_path_segments($path_segments);
		foreach($path_segments as $key=>$path){
			$url .= $path . '/';
			array_push($breadcrumbs, array('title'=> $real_path_segments[$key], 'url'=> site_url('cloud/folder/' . $url)));
		}
		return $breadcrumbs;
	}

	public function index()
	{
		redirect('cloud/folder');
	}

	public function folder()
	{
		// Olah data dari URL
		$this->load->helper('form');
		$user_id = $this->session->userdata('user_id');
		$url_segments = $this->uri->segments;
		unset($url_segments[1], $url_segments[2]);

		$sort = isset($_GET['sort']) ? $_GET['sort'] : 'name';
		$sort_asc = isset($_GET['asc']) ? $_GET['asc'] : 1;

		// Ambil data dari model
		$contents = $this->Cloud_model->get_contents($user_id, $url_segments, $sort, $sort_asc);

		$data = array(
			'path' => $this->Cloud_model->get_path(1, $url_segments),
			'real_path' => $contents['real_path'],
			'folders' => $contents['folders'],
			'files' => $contents['files'],
			'breadcrumbs' => $this->_breadcrumbs($url_segments),
			'sort' => $sort,
			'asc' => $sort_asc
		);
		$this->load->view('cloud/header', array('title'=>'Simple Cloud'));
		$this->load->view('cloud/folder', $data);
		$this->load->view('cloud/footer');
	}

	public function upload()
	{
		$this->load->helper(array('form', 'path'));
		$user_id = $this->session->userdata('user_id');
		$url_segments = $this->uri->segments;
		unset($url_segments[1], $url_segments[2]);

		$config['upload_path']		= set_realpath($_SERVER['DOCUMENT_ROOT'] . '/../cloud/' . $user_id . $this->Cloud_model->get_path(0, $url_segments));
		$config['allowed_types']	= '*';
		$config['overwrite']		= TRUE;
		$config['max_size']			= 3000;
		$config['remove_spaces']	= FALSE;

		$error = '';

		if(isset($_FILES['userfile'])){
			if($this->input->post('filename') !== '') $config['file_name'] = $this->input->post('filename');
			$this->load->library('upload', $config);

			$file_data = $this->upload->data();
			$upload_success = $this->upload->do_upload();
			if ($upload_success)
			{
				$file_data = $this->upload->data();
				redirect('cloud/folder'.$this->Cloud_model->get_path(1, $url_segments).'?upload_success=1&upload_name='.$file_data['file_name']);
			}
			else
			{
				$error = 'File upload cancelled';
			}
		}
		$data_header = array(
			'title'=>'Simple Cloud | Upload',
			'error'=>$error
		);
		$data = array(
			'path'=>$this->Cloud_model->get_path(1, $url_segments),
			'max_size'=>$config['max_size'],
			'breadcrumbs' => $this->_breadcrumbs($url_segments)
		);
		$this->load->view('cloud/header', $data_header);
		$this->load->view('cloud/upload', $data);
		$this->load->view('cloud/footer');
	}

	public function new_folder()
	{
		$user_id = $this->session->userdata('user_id');
		$url_segments = $this->uri->segments;
		$folder_name = $this->input->post('foldername');
		unset($url_segments[1], $url_segments[2]);

		if($this->Cloud_model->create_folder($user_id, $url_segments, $folder_name))
			redirect('cloud/folder'.$this->Cloud_model->get_path(1, $url_segments).'?create_success=1&create_name='.$folder_name);;
	}

}