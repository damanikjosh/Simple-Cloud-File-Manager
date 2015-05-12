<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cloud_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

		// Menjalankan helper file dari codeigniter
		$this->load->helper(array('file'));
	}

	private function _modified($timestamp){
		$second = time() - $timestamp;
		$minute = intval($second/60);
		$hour = intval($second/3600);
		$day = intval($second/86400);
		if($second < 60) {
			$modified = $second . ' second';
			if($second > 1) $modified .= 's';
			$modified .= ' ago';
		}
		else if($second < 3600){
			$modified = $minute . ' minute';
			if($minute > 1) $modified .= 's';
			$modified .= ' ago';
		}
		else if($second < 86400){
			$modified = $hour . ' hour';
			if($hour > 1) $modified .= 's';
			$modified .= ' ago';
		}
		else if($second < 2592000){
			$modified = $day . ' day';
			if($day > 1) $modified .= 's';
			$modified .= ' ago';
		}
		else $modified = date('j F Y', $timestamp);
		return $modified;
	}

	private function _size($int_size) {
		if($int_size < 1000) $size = sprintf('%0.2f', $int_size) . ' B';
		else if($int_size < 1000000) $size = sprintf('%0.2f', $int_size/1000) . ' KB';
		else if($int_size < 1000000000) $size = sprintf('%0.2f', $int_size/1000000) . ' MB';
		else $size = sprintf('%0.2f', $int_size/1000000000) . ' GB';
		return $size;
	}

	private function _filetype($path) {
		$extension = (new SplFileInfo($path))->getExtension();
		$extensions = array(
			//Imageformats
			'jpg'=>1,'jpeg'=>1,'jpe'=>1,'gif'=>1,'png'=>1,'bmp'=>1,'tif'=>1,'tiff'=>1,'ico'=>1,
			//Videoformats
			'asf|asx'=>2,'wmv'=>2,'wmx'=>2,'wm'=>2,'avi'=>2,'divx'=>2,'flv'=>2,'mov'=>2,'qt'=>2,'mpeg'=>2,'mpg'=>2,'mpe'=>2,'mp4'=>2,'m4v'=>2,'ogv'=>2,'webm'=>2,'mkv'=>2,
			//Textformats
			'txt'=>3,'asc'=>3,'c'=>3,'cc'=>3,'h'=>3,'cpp'=>3,'csv'=>3,'tsv'=>3,'ics'=>3,'rtx'=>3,'css'=>3,'htm'=>3,'html'=>3,'php'=>3,'rtf'=>3,'js'=>3,
			//Audioformats
			'mp3'=>4,'m4a'=>4,'m4b'=>4,'ra'=>4,'ram'=>4,'wav'=>4,'ogg'=>4,'oga'=>4,'mid'=>4,'midi'=>4,'wma'=>4,'wax'=>4,'mka'=>4,
			//Application
			'exe'=>5,
			//Compressed
			'tar'=>6,'zip'=>6,'gz'=>6,'gzip'=>6,'rar'=>6,'7z'=>6,
			//Miscapplicationformats
			'pdf'=>7,'dot'=>7,'swf'=>7,'class'=>7,'doc'=>7,'pot'=>7,'pps'=>7,'ppt'=>7,'wri'=>7,'xla'=>7,'xls'=>7,'xlt'=>7,'xlw'=>7,'mdb'=>7,'mpp'=>7,'docx'=>7,'docm'=>7,'dotx'=>7,'dotm'=>7,'xlsx'=>7,'xlsm'=>7,'xlsb'=>7,'xltx'=>7,'xltm'=>7,'xlam'=>7,'pptx'=>7,'pptm'=>7,'ppsx'=>7,'ppsm'=>7,'potx'=>7,'potm'=>7,'ppam'=>7,'sldx'=>7,'sldm'=>7,'onetoc'=>7,'onetoc2'=>7,'onetmp'=>7,'onepkg'=>7,'odt'=>7,'odp'=>7,'ods'=>7,'odg'=>7,'odc'=>7,'odb'=>7,'odf'=>7,'wp'=>7,'wpd'=>7,'key'=>7,'numbers'=>7,'pages'=>7
		);
		$type = array('','Image','Video','Text','Audio','Application','Compressed','Document');
		if(isset($extensions[$extension])) return $type[$extensions[$extension]];
		else return 'Other';
	}

	public function get_folders($owner_id, $path)
	{
		// Menentukan directory yang akan discan
		$directory = '../cloud/' . $owner_id . '/' . $path;
		if(!is_dir($directory)) return NOT_EXIST;

		// Men-scan file dan folder yang ada di directory
		$contents = get_dir_file_info($directory);

		// Jika file atau folder ada
		if(!empty($contents)){

			// Definisi array kosong
			$folders = array();

			// Memasukkan data contents yang bertipe folder ke array folders
			foreach($contents as $content){
				$content['modified'] = $this->_modified($content['date']);
				$content['int_size'] = $content['size'];
				$content['size'] = $this->_size($content['size']);
				if(is_dir($directory . '/' . $content['name'])) array_push($folders, $content);
			}
			return $folders;
		}
		return NULL;
	}

	public function get_files($owner_id, $path)
	{

		// Menentukan directory yang akan discan
		$directory = '../cloud/' . $owner_id . '/' . $path;
		if(!is_dir($directory)) return NOT_EXIST;

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
					$content['file_type'] = $this->_filetype($file_path);
					$content['modified'] = $this->_modified($content['date']);
					$content['int_size'] = $content['size'];
					$content['size'] = $this->_size($content['size']);

					array_push($files, $content);
				}
			}
			return $files;
		}
		return NULL;
	}
}