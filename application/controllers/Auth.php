<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Log_model');
	}

	public function index()
	{
		redirect('auth/login');
	}

	public function login()
	{
		// Jika user sudah login, redirect ke cloud
		if($this->session->userdata('user_id') !== NULL) redirect('cloud');

		// Validasi form login
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username','required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_message('required', 'Required');

		// Jika validasi berhasil
		if($this->form_validation->run())
		{
			// Ambil data dari model
			$this->load->model('Auth_model');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$user = $this->Auth_model->login($username, $password);

			// Jika gagal log in
			if(!$user)
			{
				$data['error'] = 'Wrong username or password.';
				$this->load->view('landing/header', array('title'=>'SimpleCloud | Log In'));
				$this->load->view('auth/login', $data);
				$this->load->view('landing/footer');
			}

			// Jika berhasil
			else
			{
				// Set php session
				$user_sess = array(
					'user_id' => $user->id,
					'username' => $user->username,
					'is_admin' => $user->is_admin
				);
				$this->session->set_userdata($user_sess);
				$this->Log_model->add_log($user->id, 'auth', 'login', $user->username);

				redirect('cloud');
			}
		}

		// Jika validasi gagal
		else
		{
			$this->load->view('landing/header', array('title'=>'SimpleCloud | Log In'));
			$this->load->view('auth/login');
			$this->load->view('landing/footer');
		}
	}

	public function profile()
	{
		$user_id = $this->session->userdata('user_id');
		$username = $this->session->userdata('username');
		if($this->input->get('edit')){
			$this->load->model('Auth_model');
			$this->load->library('form_validation');
			if($this->input->post('modify')=='username'){
				$this->form_validation->set_rules('username', 'Username','required|alpha_numeric|is_unique[users.username]');
				if($this->form_validation->run()){
					$modify_username = $this->input->post('username');
					if($this->Auth_model->update_user($user_id, 'username', $modify_username)){
						$this->session->set_userdata('username', $modify_username);
						$this->Log_model->add_log($user_id, 'auth', 'edit username', $user_id.'('.$username.'=>'.$modify_username.')');
						redirect('auth/profile' . '?modify_success=1&old_name='.$username.'&new_name='.$modify_username);
					}
				}
				redirect('admin/users/'.$user_id);
			}
			else if($this->input->post('modify')=='password'){
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
				if($this->form_validation->run()){
					$old_password = $this->input->post('old-password');
					$modify_password = $this->input->post('password');

					if($this->Auth_model->change_password($user_id, sha1($old_password), sha1($modify_password))){
						$this->Log_model->add_log($user_id, 'auth', 'edit password', $user_id.'('.$username.')');
						redirect('auth/profile' . '?password_success=1&username='.$username);
					}
				}
			}
		}
		$header_data = array('title' => 'SimpleCloud | Edit Profile');
		$this->load->view('main/header', $header_data);

		$data =  array('id' => $user_id, 'username' => $username);
		$this->load->view('auth/profile', $data);

		$this->load->view('main/footer');
	}

	public function logout()
	{
		// Destroy php session
		$user_id = $this->session->userdata('user_id');
		$username = $this->session->userdata('username');
		$this->Log_model->add_log($user_id, 'auth', 'logout', $user_id.'('.$username.')');
		$this->session->sess_destroy();

		redirect('auth/login');
	}

}