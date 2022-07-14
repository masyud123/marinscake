<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengiriman extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != 77) {
            redirect('admin/auth/login');
        }
        error_reporting(0);
    }

    public function index()
    {
        $data['kota'] = $this->Model_kota->get_kota()->result_array();

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/pengiriman/data_kota', $data);
        $this->load->view('admin/template/footer');
    }

    public function tambah_kota()
    {
        $nama_kota  = $this->input->post('nama_kota');
        $ongkir     = $this->input->post('ongkir');

        $data = array(
            'nama_kota' => $nama_kota,
            'ongkir'    => $ongkir,
        );

        $this->db->insert('daerah_kirim', $data);
        $this->session->set_flashdata(
            'kota',
            '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Sukses","Data ' . $nama_kota . ' berhasil ditambahkan","success"); 
                            </script>'
        );
        redirect('admin/pengiriman');
    }

    public function update_kota($id_kota)
    {
        $nama_kota  = $this->input->post('nama_kota');
        $ongkir     = $this->input->post('ongkir');

        $data = array(
            'nama_kota' => $nama_kota,
            'ongkir'    => $ongkir,
        );
        $where = array('id_daerah' => $id_kota);

        $this->db->update('daerah_kirim', $data, $where);
        $this->session->set_flashdata(
            'kota',
            '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Sukses","Data ' . $nama_kota . ' berhasil diupdate","success"); 
                            </script>'
        );
        redirect('admin/pengiriman');
    }

    public function hapus_kota($id_kota)
    {
        $kota = $this->Model_kota->get_kota_where($id_kota)->row();
        $where = array('id_daerah' => $id_kota);

        $this->db->delete('daerah_kirim', $where);
        $this->session->set_flashdata(
            'kota',
            '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Sukses","Data ' . $kota->nama_kota . ' berhasil dihapus","success"); 
                            </script>'
        );
        redirect('admin/pengiriman');
    }
}
