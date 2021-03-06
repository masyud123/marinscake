<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modal extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        if ($this->session->userdata('role') != 77) {
            redirect('admin/auth/login');
        }
        date_default_timezone_set('Asia/Jakarta');
        error_reporting(0);
    }

    // Tampilan pengeluaran modal
    public function pengeluaran_modal($bulan)
    {
        $data['data_modal']     = $this->Model_laporan->get_data_modal($bulan)->result_array();
        $data['detail_modal']   = $this->Model_laporan->get_detail_modal()->result_array();
        $data['tanggal']        = $bulan;

        $this->load->view('admin/template/header'); 
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/modal_pengeluaran/keluar_modal', $data);
        $this->load->view('admin/template/footer'); 
    }

    // tambah data pengeluaran modal
    public function tambah_data_modal()
    {
        $totalHargaSemua = 0;
        foreach ($_POST['totalHarga'] as $key => $val) {
            $totalHargaSemua += $val;

            $data = array(
                'jenis_pengeluaran' => $this->input->post('jenis_pengeluaran'),
                'total_modal'    => $totalHargaSemua,
                'tanggal'       => date('Y-m-d'),
            );
        }

        $this->db->insert('modal', $data);
        $idModal    = $this->db->insert_id();

        foreach ($_POST['namaBahan'] as $key => $val) :
            $data2[]    = array(
                'id_modal'       => $idModal,
                'nama_bahan'     => $_POST['namaBahan'][$key],
                'jumlah'        => $_POST['jumlah'][$key],
                'harga_satuan'   => $_POST['hargaSatuan'][$key],
                'total_harga'    => $_POST['totalHarga'][$key],
            );
        endforeach;

        $this->db->insert_batch('detail_modal', $data2);
        $this->session->set_flashdata(
            'berhasil_tambah_modal',
            '<script type ="text/JavaScript">  
                            swal("Berhasil","Data modal berhasil ditambahkan","success")  
                        </script>'
        );
        // redirect('admin/modal/pengeluaran_modal/' . date('Y-m'));
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    // hapus data pengeluaran modal
    public function hapus_modal($idModal_tanggal)
    {
        // pecah id modal dan tanggal
        $idModal = strstr($idModal_tanggal, '_', true);
        $tanggal = substr($idModal_tanggal, strpos($idModal_tanggal, "_") + 1);

        $where = array('id_modal' => $idModal);

        $this->db->delete('detail_modal', $where);
        $this->db->delete('modal', $where);
        $this->session->set_flashdata(
            'berhasil_tambah_modal',
            '<script type ="text/JavaScript">  
                        swal("Berhasil","Data modal berhasil dihapus","success")  
                        </script>'
        );
        // redirect('admin/modal/pengeluaran_modal/' . $tanggal);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    // tampilan edit data pengeluaran modal
    public function edit_modal($idModal, $tanggal, $jenis)
    {
        $data['detail_modal'] = $this->Model_laporan->get_detail_modal_where($idModal)->result_array();
        $data['bulan'] = $tanggal;
        $data['jenis'] = $jenis;
        $jns_png = $this->db->get_where('modal', ['id_modal' => $idModal])->row();
        $data['jns_png'] = $jns_png->jenis_pengeluaran; 

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/modal_pengeluaran/edit_modal', $data);
        $this->load->view('admin/template/footer');
    }

    // update bahan pada data pengeluaran modal
    public function update_bahan()
    {
        $idModal = $this->input->post('idModal');

        $where = array('id_modal' => $idModal);

        // hapus semua detail
        $this->db->delete('detail_modal', $where);

        // update total pengeluaran pada tb_modal
        $totalHargaSemua = 0;
        foreach ($_POST['totalHarga'] as $key => $val) {
            $totalHargaSemua += $val;

            $data = array(
                'total_modal'    => $totalHargaSemua,
                'tanggal_edit'      => date('Y-m-d'),
            );

            $this->db->update('modal', $data, $where);
        }

        foreach ($_POST['namaBahan'] as $key => $val) :
            $data2[]    = array(
                'id_modal'       => $idModal,
                'nama_bahan'     => $_POST['namaBahan'][$key],
                'jumlah'        => $_POST['jumlah'][$key],
                'harga_satuan'  => $_POST['hargaSatuan'][$key],
                'total_harga'    => $_POST['totalHarga'][$key],
            );
        endforeach;

        $this->db->insert_batch('detail_modal', $data2);
        $this->session->set_flashdata(
            'edit_modal',
            '<script type ="text/JavaScript">  
                            swal("Berhasil","Data modal berhasil diupdate","success")  
                        </script>'
        );
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    public function bahan_baku($bulan)
    {
        $data['data_modal']     = $this->Model_laporan->get_data_modal_bahan_baku($bulan)->result_array();
        $data['detail_modal']   = $this->Model_laporan->get_detail_modal()->result_array();
        $data['tanggal']        = $bulan;
        // echo "<pre>"; print_r($data); exit;
        $this->load->view('admin/template/header'); 
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/modal_pengeluaran/bahan_baku', $data);
        $this->load->view('admin/template/footer'); 
    }

    public function akomodasi($bulan)
    {
        $data['data_modal']     = $this->Model_laporan->get_data_modal_akomodasi($bulan)->result_array();
        $data['detail_modal']   = $this->Model_laporan->get_detail_modal()->result_array();
        $data['tanggal']        = $bulan;
        // echo "<pre>"; print_r($data); exit;
        $this->load->view('admin/template/header'); 
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/modal_pengeluaran/akomodasi', $data);
        $this->load->view('admin/template/footer'); 
    }

    public function lain_lain($bulan)
    {
        $data['data_modal']     = $this->Model_laporan->get_data_modal_lain_lain($bulan)->result_array();
        $data['detail_modal']   = $this->Model_laporan->get_detail_modal()->result_array();
        $data['tanggal']        = $bulan;
        // echo "<pre>"; print_r($data); exit;
        $this->load->view('admin/template/header'); 
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/modal_pengeluaran/lain_lain', $data);
        $this->load->view('admin/template/footer'); 
    }
}
