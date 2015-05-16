<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function check_user($username)
	{
		// Ambil data dari database
		$q = $this
				->db
				->where('username', $username)
				->limit(1)
				->get('users');

		// Jika ditemukan
		if($q->num_rows() > 0){
			return $q->row()->id;
		}

		// Jika tidak ditemukan
		return false;
	}

	public function get_username($id)
	{
		$q = $this
				->db
				->where('id', $id)
				->limit(1)
				->get('users');

		// Jika ditemukan
		if($q->num_rows() > 0){
			return $q->row()->username;
		}

		// Jika tidak ditemukan
		return false;
	}

	public function count_user()
	{
		return $this->db->count_all('users');
	}

	public function list_user($start = 0, $limit = 10, $sort = 'id', $asc = 'asc')
	{
		$this
				->db
				->limit($limit, $start)
				->select('id, username, date_created, is_admin')
				->order_by('LOWER(' . $sort . ')', $asc);
		$q = $this->db->get('users');

		return $q->result();
	}

	public function login($username, $password)
	{
		// Ambil data dari database
		$q = $this
				->db
				->where('username', $username)
				->where('password', sha1($password))
				->limit(1)
				->get('users');

		// Jika ditemukan
		if($q->num_rows() > 0){

			// Return data user
			return $q->row();
		}

		// Jika tidak ditemukan
		return false;
	}

	public function register($user)
	{
		// Enkripsi password
		$user['password'] = sha1($user['password']);

		// Input data ke database
		$this->db->insert('users', $user);

		// Cek jika data berhasil dimasukkan
		if($this->check_user($user['username'])!==false) return true;
		return false;
	}

	public function update_user($id, $field, $content)
	{
		$data = array($field => $content);
		$this
			->db
			->where('id', $id)
			->update('users', $data);
		return true;
	}

	public function change_password($id, $old_password, $new_password)
	{
		$q = $this
				->db
				->where('id', $id)
				->where('password', $old_password)
				->limit(1)
				->get('users');

		if($q->num_rows() > 0){
			$this
				->db
				->where('id', $id)
				->update('users', array('password'=>$new_password));
			return true;
		}
		return false;
	}

	public function delete_user($id)
	{
		$this
			->db
			->where('id', $id)
			->delete('users');
		return true;
	}

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */