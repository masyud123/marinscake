<?php

class Model_login extends CI_Model
{
	// cek akun user
	public function cek_login()
	{
		$email		= set_value('email');
		$password	= set_value('password');

		$this->input->post('email', $email);
		$this->input->post('password', $password);

		$cek  = $this->db->get_where('user', ['email' => $email]);

		if ($cek->num_rows() > 0) {
			$hasil = $cek->row();
			if (password_verify($password, $hasil->password)) {
				//mengembalikan hasil password benar
				return $hasil;
			} else {
				//mengembalikan hasil password salah
				return array();
			}
		} else {
			// email tidak ditemukan
			$this->session->set_flashdata(
				'pesan',
				'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                    <script type ="text/JavaScript">  
                    swal("Gagal Login","Email yang anda masukkan salah!","error")  
                    </script>'
			);
			redirect('admin/auth/login');
		}
	}
}
