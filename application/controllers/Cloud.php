<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cloud extends CI_Controller {
	private $cloud;
	public function __construct()
	{
		parent::__construct();

		// User harus login untuk mengakses cloud
		if($this->session->userdata('user_id') == NULL) redirect('auth');
		$this->load->model('Cloud_model');
		$this->load->model('Log_model');
		$config_file = fopen(APPPATH . 'config/cloud/config', "r+");
		$this->cloud = unserialize(fgets($config_file));
		fclose($config_file);
	}

	function alpha_numeric_dash_space($str)
	{
		return ( ! preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
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

		$delete = $this->input->get('delete');
		$sort = isset($_GET['sort']) ? $_GET['sort'] : 'name';
		$sort_asc = isset($_GET['asc']) ? $_GET['asc'] : 1;

		if($delete==1&&$this->Cloud_model->delete_folder($user_id, $url_segments)){
			$delete_name = base64_decode(array_pop($url_segments));
			$path = $this->Cloud_model->get_path(1, $url_segments);
			$this->Log_model->add_log($user_id, 'cloud', 'delete folder', $this->Cloud_model->get_path(0, $url_segments).'/'.$delete_name);
			redirect('cloud/folder'.$path.'?delete_success=1&delete_name='.$delete_name);
		}

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
		$this->load->view('main/header', array('title'=>'SimpleCloud'));
		$this->load->view('cloud/folder', $data);
		$this->load->view('main/footer');
	}

	public function upload()
	{
		$this->load->helper(array('form', 'path'));
		$user_id = $this->session->userdata('user_id');
		$url_segments = $this->uri->segments;
		unset($url_segments[1], $url_segments[2]);

		$error = '';

		if(isset($_FILES['userfile'])){
			$this->cloud['upload_path'] .= $user_id . $this->Cloud_model->get_path(0, $url_segments);
			if($this->input->post('filename') !== '') $this->cloud['file_name'] = $this->input->post('filename');
			$this->load->library('upload', $this->cloud);

			$file_data = $this->upload->data();
			$upload_success = $this->upload->do_upload();
			if ($upload_success)
			{
				$file_data = $this->upload->data();
				$this->Log_model->add_log($user_id, 'cloud', 'upload', $this->Cloud_model->get_path(0, $url_segments).'/'.$this->cloud['file_name']);
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
			'max_size'=>$this->cloud['max_size'],
			'breadcrumbs' => $this->_breadcrumbs($url_segments)
		);
		$this->load->view('main/header', $data_header);
		$this->load->view('cloud/upload', $data);
		$this->load->view('main/footer');
	}

	public function new_folder()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('foldername', 'New Folder','required|callback_alpha_numeric_dash_space');
		if($this->form_validation->run()) {
			$user_id = $this->session->userdata('user_id');
			$url_segments = $this->uri->segments;
			$folder_name = $this->input->post('foldername');
			unset($url_segments[1], $url_segments[2]);

			if($this->Cloud_model->create_folder($user_id, $url_segments, $folder_name)){
				$this->Log_model->add_log($user_id, 'cloud', 'add folder', $this->Cloud_model->get_path(0, $url_segments).'/'.$folder_name);
				redirect('cloud/folder'.$this->Cloud_model->get_path(1, $url_segments).'?create_success=1&create_name='.$folder_name);;
			}
		}
		redirect('cloud/folder'.$this->Cloud_model->get_path(1, $url_segments));
	}

	public function download_file($path)
	{
		$path_segments = explode('/', $path);
		$file = array_pop($path_segments);
		if (file_exists($path)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'. $file . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($path));
			readfile($path);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function file()
	{
		$this->load->helper('form');
		$user_id = $this->session->userdata('user_id');
		$url_segments = $this->uri->segments;
		unset($url_segments[1], $url_segments[2]);

		$path = $this->Cloud_model->get_path(1, $url_segments);
		$real_path = $this->Cloud_model->get_path(0, $url_segments);

		$delete = $this->input->get('delete');

		if($delete==1&&$this->Cloud_model->delete_file($user_id, $url_segments)){
			$delete_name = base64_decode(array_pop($url_segments));
			$path = $this->Cloud_model->get_path(1, $url_segments);
			$this->Log_model->add_log($user_id, 'cloud', 'delete file', $real_path);
			redirect('cloud/folder'.$path.'?delete_success=1&delete_name='.$delete_name);
		}

		$download = $this->input->get('download');

		if($download==1){
			$file = $this->Cloud_model->get_file($user_id, $real_path);
			$this->download_file($file);
			$this->Log_model->add_log($user_id, 'cloud', 'download', $real_path);
		}
	}

}