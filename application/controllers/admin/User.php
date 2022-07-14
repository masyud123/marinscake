<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != 77) {
            redirect('admin/auth/Login');
        }
    }

    // Tampilan akun
    public function index()
    {
        $data['user'] = $this->Model_user->get_data_user()->result_array();

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/user/data_user', $data);
        $this->load->view('admin/template/footer');
    }

    // tambah akun
    public function tambah_user()
    {
        $nama       = $this->input->post('nama');
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        $pwd        = password_hash($password, PASSWORD_DEFAULT);
        $role       = $this->input->post('role');

        $data = array(
            'nama'      => $nama,
            'email'     => $email,
            'password'  => $pwd,
            'role'      => $role
        );

        $simpan = $this->db->insert('user', $data);
        if ($simpan) {
            $this->session->set_flashdata(
            'user',
            '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Sukses","User baru berhasil ditambahkan","success"); 
                            </script>'
            );
        } else {
            $this->session->set_flashdata(
            'user',
            '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Gagal","User gagal ditambahkan","error"); 
                            </script>'
            );
        }
        redirect('admin/User');
    }

    // update akun
    public function update_user($idUser)
    {
        $nama       = $this->input->post('nama');
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        $pwd        = password_hash($password, PASSWORD_DEFAULT);
        $role       = $this->input->post('role');

        if ($password == null) {
            $data = array(
                'nama'      => $nama,
                'email'     => $email,
                'role'      => $role
            );
        } else {
            $data = array(
                'nama'      => $nama,
                'email'     => $email,
                'password'  => $pwd,
                'role'      => $role
            );
        }
        $where = array('id_user' => $idUser);

        $simpan = $this->db->update('user', $data, $where);
        if ($simpan) {
            $this->session->set_flashdata(
            'user',
            '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Sukses","Data user berhasil diubah","success"); 
                            </script>'
            );
        } else {
            $this->session->set_flashdata(
            'user',
            '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Gagal","Data user gagal diubah","error"); 
                            </script>'
            );
        }
        redirect('admin/User');
    }

    // hapus akun
    public function hapus_user($idUser)
    {

        $where = array('id_user' => $idUser);

        $hapus = $this->db->delete('user', $where);
        if ($hapus) {
            $this->session->set_flashdata(
            'user',
            '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Sukses","Data user berhasil dihapus","success"); 
                            </script>'
            );
        } else {
            $this->session->set_flashdata(
            'user',
            '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Gagal","Data User gagal dihapus","error"); 
                            </script>'
            );
        }
        redirect('admin/User');
    }
}
