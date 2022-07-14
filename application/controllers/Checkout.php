<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$data['keranjang'] 	= $this->cart->contents();
		$data['kota']		= $this->Model_kota->get_kota()->result_array();

		$this->load->view('template/header2');
		$this->load->view('checkout', $data);
		$this->load->view('template/footer');
	}

	public function save_order()
	{
		$total_belanja 	= $this->input->post('total_belanja');
		$metode			= "Online";
		$status			= "Menunggu Pembayaran";
		$tanggal		= date('Y-m-d H:i:s');
		$tanggal_kirim	= $this->input->post('tanggal_kirim');
		$data_preorder	= array(
			'jumlah'			=> $total_belanja,
			'metode'			=> $metode,
			'status'			=> $status,
			'tanggal_pesan'		=> $tanggal,
			'tanggal_dikirim'	=> $tanggal_kirim,
		);
		$insert_preorder = $this->db->insert('preorder', $data_preorder);
		if ($insert_preorder) {
			$id_preorder = $this->db->insert_id();

			$cart = $this->cart->contents();
			foreach ($cart as $key) {
				$data_detailPreorder = array(
					'id_preorder'	=> $id_preorder,
					'id_produk'		=> $key['id'],
					'nama_produk'	=> $key['name'],
					'jumlah'		=> $key['qty'],
					'total'			=> $key['price'] * $key['qty']
				);
				$insert_detailPreorder = $this->db->insert('detail_preorder', $data_detailPreorder);
			}
			if ($insert_detailPreorder) {
				$data_pengiriman = array(
					'id_preorder' 	=> $id_preorder,
					'nama'			=> $this->input->post('nama'),
					'email'			=> $this->input->post('email'),
					'no_hp'			=> $this->input->post('no_hp'),
					'id_daerah'		=> $this->input->post('kota'),
					'alamat'		=> $this->input->post('alamat'),
					'catatan'		=> $this->input->post('catatan')
				);
				$insert_pengiriman = $this->db->insert('pengiriman', $data_pengiriman);
				if ($insert_pengiriman) {
					$this->cart->destroy();
					redirect('Checkout/pembayaran/' . $id_preorder);
				}
			}
		}
	}

	public function pembayaran($id_preorder)
	{
		$data['preorder'] 	= $this->Model_preorder->get_preorder($id_preorder)->row();
		$data['detail'] 	= $this->Model_preorder->get_detailPreorder($id_preorder)->result_array();
		$data['pengiriman'] = $this->Model_preorder->get_pengiriman($id_preorder)->row();
		$data['midtrans']	= $this->Model_preorder->get_midtrans($id_preorder)->row();

		$this->load->view('template/header2');
		$this->load->view('pembayaran', $data);
		$this->load->view('template/footer');
	}
}
