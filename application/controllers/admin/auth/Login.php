<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	// tampil login
	public function index()
	{
		$this->session->sess_destroy();
		$this->load->view('admin/auth/template/header');
		$this->load->view('admin/auth/login');
		$this->load->view('admin/auth/template/footer');
	}

	// fungsi login
	public function login_user()
	{
		$this->form_validation->set_rules('email', 'email', 'required', ['required' => 'Email wajib diisi!']);
		$this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Password wajib diisi!']);
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/auth/template/header');
			$this->load->view('admin/auth/login');
			$this->load->view('admin/auth/template/footer');
		} else {
			$auth = $this->Model_login->cek_login();

			if ($auth == FALSE) {
				$this->session->set_flashdata(
					'pesan',
					'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                    <script type ="text/JavaScript">  
                    swal("Gagal Login","Password yang anda masukkan salah!","error")  
                    </script>'
				);
				redirect('admin/auth/login');
			} else {
				$this->session->set_userdata('nama', $auth->nama);
				$this->session->set_userdata('email', $auth->email);
				$this->session->set_userdata('role', $auth->role);
				$this->session->set_userdata('id_user', $auth->id_user);
				if ($auth->role == 77) {
					redirect('admin/dashboard');
				} elseif ($auth->role == 24) {
					redirect('kasir/kasir_page/dashboard');
				}
			}
		}
	}

	// fungsi log-out
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/auth/login');
	}
}
