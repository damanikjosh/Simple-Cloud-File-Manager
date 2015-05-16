<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model {

	public function add_log($user_id, $type, $action, $content)
	{
		$data = array(
				'user_id' => $user_id,
				'type' => $type,
				'action' => $action,
				'content' => $content
			);
		$this->db->insert('track_record', $data);
	}

	public function get_logs($user_id = null, $type = null, $sort = 'id', $asc = 'asc')
	{
		if($user_id!=null) $this->db->where('user_id', $user_id);
		if($type!=null) $this->db->where('type', $type);
		$q = $this->db->order_by('LOWER(' . $sort . ')', $asc)->get('track_record');
		return $q->result();
	}

}

/* End of file Log_model.php */
/* Location: ./application/models/Log_model.php */