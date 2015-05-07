<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
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
		$this->form_validation->set_rules('email_address', 'Email Address','required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		// Jika validasi berhasil
		if($this->form_validation->run())
		{
			// Ambil data dari model
			$this->load->model('Auth_model');
			$email = $this->input->post('email_address');
			$password = $this->input->post('password');
			$user = $this->Auth_model->login($email, $password);

			// Jika gagal log in
			if(!$user)
			{
				$data['error'] = 'Wrong email address or password.';
				$this->load->view('auth/login', $data);
			}

			// Jika berhasil
			else
			{
				// Set php session
				$user_sess = array(
					'user_id' => $user->id,
					'email' => $user->email_address,
					'is_admin' => $user->is_admin
				);
				$this->session->set_userdata($user_sess);

				redirect('cloud');
			}
		}

		// Jika validasi gagal
		else
		{
			$this->load->view('auth/login');
		}
	}

	public function register()
	{
		// Jika user sudah login, redirect ke cloud
		if($this->session->userdata('user_id') !== NULL) redirect('cloud');

		// Validasi form registrasi
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_address', 'Email Address','required|valid_email|is_unique[users.email_address]');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

		// Jika validasi berhasil
		if($this->form_validation->run())
		{
			// Ambil data dari model
			$this->load->model('Auth_model');
			$user = array(
				'email_address' => $this->input->post('email_address'),
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'password' => $this->input->post('password'),
			);
			// Jika berhasil register, redirect ke halaman login
			if($this->Auth_model->register($user)) redirect('auth/login');

			// Jika tidak berhasil register
			else $this->load->view('auth/register', array('error' => 'Error creating user'));
		}

		// Jika validasi gagal
		else
		{
			$this->load->view('auth/register');
		}

	}

	public function logout()
	{
		// Destroy php session
		$this->session->sess_destroy();

		redirect('auth/login');
	}

}