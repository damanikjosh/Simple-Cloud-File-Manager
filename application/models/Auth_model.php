<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	private function check_user($email)
	{
		// Ambil data dari database
		$q = $this
				->db
				->where('email_address', $email)
				->limit(1)
				->get('users');

		// Jika ditemukan
		if($q->num_rows() > 0){
			return true;
		}

		// Jika tidak ditemukan
		return false;
	}

	public function login($email, $password)
	{
		// Ambil data dari database
		$q = $this
				->db
				->where('email_address', $email)
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
		if($this->check_user($user['email_address'])) return true;
		return false;
	}

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */