<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != 24) {
            redirect('admin/auth/Login');
        }
    }

    // Tampilan akun
    public function index()
    {
        $id_user        = $this->session->userdata('id_user');
        $data['user']   = $this->Model_user->get_user_id($id_user)->row();

        $this->load->view('kasir/template/header');
        $this->load->view('kasir/template/sidebar');
        $this->load->view('kasir/data_user', $data);
        $this->load->view('kasir/template/footer');
    }

    public function edit_user()
    {
        $id_user        = $this->session->userdata('id_user');
        $data['user']   = $this->Model_user->get_user_id($id_user)->row();

        $this->load->view('kasir/template/header');
        $this->load->view('kasir/template/sidebar');
        $this->load->view('kasir/edit_user', $data);
        $this->load->view('kasir/template/footer');
    }

    // update akun
    public function update_user()
    {
        $id_user    = $this->session->userdata('id_user');
        $nama       = $this->input->post('nama');
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        $pwd        = password_hash($password, PASSWORD_DEFAULT);

        if ($password == null) {
            $data = array(
                'nama'      => $nama,
                'email'     => $email,
            );
        } else {
            $data = array(
                'nama'      => $nama,
                'email'     => $email,
                'password'  => $pwd,
            );
        }

        $where = array('id_user' => $id_user);

        $this->db->update('user', $data, $where);
        $this->session->set_flashdata(
            'akun',
            '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Sukses","Data profil Anda berhasil diupdate","success"); 
                            </script>'
        );
        redirect('kasir/Akun');
    }
}
