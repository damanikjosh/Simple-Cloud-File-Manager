<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cloud_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

		// Menjalankan helper file dari codeigniter
		$this->load->helper(array('file'));
	}

	public function get_folders($owner_id, $path)
	{
		// Menentukan directory yang akan discan
		$directory = '../cloud/' . $owner_id . '/' . $path;

		// Men-scan file dan folder yang ada di directory
		$contents = get_dir_file_info($directory);

		// Jika file atau folder ada
		if(!empty($contents)){

			// Definisi array kosong
			$folders = array();

			// Memasukkan data contents yang bertipe folder ke array folders
			foreach($contents as $content){
				if(is_dir($directory . '/' . $content['name'])) array_push($folders, $content);
			}
			return $folders;
		}
		return false;
	}

	public function get_files($owner_id, $path)
	{

		// Menentukan directory yang akan discan
		$directory = '../cloud/' . $owner_id . '/' . $path;

		// Men-scan file dan folder yang ada di directory
		$contents = get_dir_file_info($directory);

		// Jika file atau folder ada
		if(!empty($contents)){

			// Definisi array kosong
			$files = array();

			// Memasukkan data contents yang bertipe folder ke array folders
			foreach($contents as $content){
				if(is_file($file_path = $directory . '/' . $content['name'])){

					// Menambah element file_type ke array
					$file_type = get_mime_by_extension($file_path);
					$content['file_type'] = $file_type;

					array_push($files, $content);
				}
			}
			return $files;
		}
		return false;
	}
}