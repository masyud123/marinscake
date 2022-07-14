<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir_page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != 24) {
            redirect('admin/auth/Login');
        }
        date_default_timezone_set('Asia/Jakarta');
        error_reporting(0);
    }

    // dashboard kasir
    public function dashboard()
    {
        $id_user        = $this->session->userdata('id_user');
        $data['user']   = $this->Model_user->get_user_id($id_user)->row();
        $data['tr_langsung'] = $this->Model_kasir->get_tr_langsung()->result_array();
        $data['tr_preorder'] = $this->Model_kasir->get_tr_preorder()->result_array();

        // grafik transaksi langsung mingguan
        $transaksi_ls = $this->Model_kasir->get_tr_langsung_mingguan();
        for ($i = 0; $i < count($transaksi_ls); $i++) {
            $tr_ls[] = array(
                $i => $transaksi_ls[$i][0]->total_belanja,
            );
        }
        $data['grafik_ls'] = $tr_ls;

        // grafik transaksi preorder mingguan
        $transaksi_pr = $this->Model_kasir->get_tr_preorder_mingguan();
        for ($i = 0; $i < count($transaksi_pr); $i++) {
            $tr_pr[] = array(
                $i => $transaksi_pr[$i][0]->jumlah,
            );
        }
        $data['grafik_pr'] = $tr_pr;
        // echo "<pre>"; print_r($data);
        // exit;
        $this->load->view('kasir/template/header');
        $this->load->view('kasir/template/sidebar');
        $this->load->view('kasir/dashboard', $data);
        $this->load->view('kasir/template/footer');
    }

    // transaksi langsung pada kasir
    public function langsung()
    {
        $data['jenis_produk']   = $this->db->get_where('jenis_produk', array('status' => 1))->result_array();
        $data['daftar_produk']  = $this->Model_produk->get_produk()->result_array();
        $data['gambar']         = $this->Model_produk->get_gambar()->result_array();

        $this->load->view('kasir/template/header');
        $this->load->view('kasir/template/sidebar');
        $this->load->view('kasir/kasir_page', $data);
        $this->load->view('kasir/template/footer');
    }

    // transaksi preorder pada kasir
    public function preorder()
    {
        $data['jenis_produk']   = $this->db->get_where('jenis_produk', array('status' => 1))->result_array();
        $data['daftar_produk']  = $this->Model_produk->get_produk()->result_array();
        $data['gambar']         = $this->Model_produk->get_gambar()->result_array();
        $data['daerah']         = $this->db->get('daerah_kirim')->result_array();

        $this->load->view('kasir/template/header');
        $this->load->view('kasir/template/sidebar');
        $this->load->view('kasir/preorder', $data);
        $this->load->view('kasir/template/footer');
    }

    // get biaya ongkir
    public function get_ongkir($id_daerah)
    {
        $data = $this->Model_transaksi->get_ongkir($id_daerah)->result();
        foreach ($data as $dt) {
            echo $dt->ongkir;
        }
    }

    // tambah data transaksi
    public function terjual_atau_preorder()
    {
        if ($this->input->post('tglDikirim') != null) {

            // Pembelian Preorder
            $nama       = $this->input->post('nama');
            $no_hp      = $this->input->post('no_hp');
            $id_daerah  = $this->input->post('id_daerah');
            $alamat     = $this->input->post('alamat');
            $catatan    = $this->input->post('catatan');
            $tanggalDikirim = $this->input->post('tglDikirim');
            $total_belanja  = $this->input->post('total_belanja');

            $data = array(
                'jumlah'            => $total_belanja,
                'metode'            => "Offline",
                'tanggal_pesan'     => date("Y-m-d H:i:s"),
                'tanggal_dikirim'   => $tanggalDikirim,
                'status'            => "Menunggu Pengiriman",
            );

            $simpan = $this->db->insert('preorder', $data);
            $insert_id = $this->db->insert_id();

            if ($simpan) {
                $data2 = array();
                foreach ($_POST['namaProduk'] as $key => $val) :
                    $ttProduk     = $_POST['totalProduk'][$key];
                    $rpl1         = str_replace('Rp. ', '', $ttProduk);
                    $rpl2         = str_replace('.00', '', $rpl1);
                    $data2[]      = array(
                        'id_preorder'   => $insert_id,
                        'id_produk'     => $_POST['idProduk'][$key],
                        'nama_produk'   => $_POST['namaProduk'][$key],
                        'jumlah'        => $_POST['jumlahProduk'][$key],
                        'total'         => $rpl2,
                    );
                endforeach;

                $this->db->insert_batch('detail_preorder', $data2);
            }

            $data3 = array(
                'id_preorder' => $insert_id,
                'nama'       => $nama,
                'no_hp'      => $no_hp,
                'id_daerah'  => $id_daerah,
                'alamat'     => $alamat,
                'catatan'    => $catatan,
            );
            // echo "<pre>"; print_r($data3); exit;
            $this->db->insert('pengiriman', $data3);

            $this->session->set_flashdata(
                'berhasil_preorder',
                '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Berhasil","Data Preorder berhasil ditambahkan","success")  
                            </script>'
            );
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {

            // Pembelian Langsung
            $total_belanja = $this->input->post('total_belanja');
            $data = array(
                'total_belanja' => $total_belanja,
                'metode'        => "Offline",
                'pembayaran'    => "Tunai",
                'status'        => "Selesai",
                'tanggal'       => date("Y-m-d H:i:s"),
            );

            $simpan = $this->db->insert('transaksi', $data);
            $insert_id = $this->db->insert_id();

            if ($simpan) {
                $data2 = array();
                foreach ($_POST['namaProduk'] as $key => $val) :
                    $ttProduk   = $_POST['totalProduk'][$key];
                    $rpl1       = str_replace('Rp. ', '', $ttProduk);
                    $rpl2       = str_replace('.00', '', $rpl1);
                    $data2[]    = array(
                        'id_transaksi'  => $insert_id,
                        'id_produk'     => $_POST['idProduk'][$key],
                        'nama_produk'   => $_POST['namaProduk'][$key],
                        'jumlah'        => $_POST['jumlahProduk'][$key],
                        'total'         => $rpl2,
                    );
                endforeach;

                $this->db->insert_batch('detail_transaksi', $data2);
                $this->session->set_flashdata(
                    'berhasil_beli',
                    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
	                            <script type ="text/JavaScript">  
	                            swal("Berhasil","Pembelian berhasil dilakukan","success")  
	                            </script>'
                );
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }
        }
    }
}
