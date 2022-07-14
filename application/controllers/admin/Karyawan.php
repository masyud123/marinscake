<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != 77) {
            redirect('admin/auth/login');
        }
        error_reporting(0);
    }

    // tampilan karyawan
    public function index()
    {
        $data['data_karyawan'] = $this->Model_karyawan->get_data_karyawan()->result_array();

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/karyawan/data_karyawan', $data);
        $this->load->view('admin/template/footer');
    }

    // tambah data karyawan
    public function tambah_karyawan()
    {
        $nama     = $this->input->post('nama');
        $kelamin  = $this->input->post('kelamin');
        $posisi   = $this->input->post('posisi');
        $noHp     = $this->input->post('noHp');
        $status     = $this->input->post('status');
        $gaji     = $this->input->post('gaji');

        $data = array(
            'nama'         => $nama,
            'jenis_kelamin' => $kelamin,
            'posisi'       => $posisi,
            'no_hp'         => $noHp,
            'status'         => $status,
            'gaji'         => $gaji,
        );

        $this->db->insert('karyawan', $data);
        $this->session->set_flashdata(
            'karyawan',
            '<script type ="text/JavaScript">  
                            swal("Sukses","Data karyawan berhasil ditambahkan","success"); 
                            </script>'
        );
        redirect('admin/karyawan/index/');
    }

    // update data karyawan
    public function update_karyawan($idKaryawan)
    {
        $nama     = $this->input->post('nama');
        $kelamin  = $this->input->post('kelamin');
        $posisi   = $this->input->post('posisi');
        $noHp     = $this->input->post('noHp');
        $status     = $this->input->post('status');
        $gaji     = $this->input->post('gaji');

        $data = array(
            'nama'          => $nama,
            'jenis_kelamin'  => $kelamin,
            'posisi'        => $posisi,
            'no_hp'          => $noHp,
            'status'         => $status,
            'gaji'          => $gaji,
        );

        $where = array('id_karyawan' => $idKaryawan);

        $this->db->update('karyawan', $data, $where);
        $this->session->set_flashdata(
            'karyawan',
            '<script type ="text/JavaScript">  
                            swal("Sukses","Data karyawan berhasil diupdate","success"); 
                            </script>'
        );
        redirect('admin/karyawan/index/');
    }

    // update data karyawan
    public function hapus_karyawan($idKaryawan)
    {

        $where = array('id_karyawan' => $idKaryawan);

        $this->db->delete('karyawan', $where);
        $this->session->set_flashdata(
            'karyawan',
            '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Sukses","Data karyawan berhasil dihapus","success"); 
                            </script>'
        );
        redirect('admin/karyawan/index/');
    }
}
