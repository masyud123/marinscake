<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Preorder extends CI_Controller
{


	public function index()
	{
		$data['kategori']	= $this->Model_produk->get_kategori_produk()->result_array();
		$data['produk']		= $this->Model_produk->get_produk()->result_array();

		$this->load->view('template/header2');
		$this->load->view('produk_preorder', $data);
		$this->load->view('template/footer');
	}

	public function detail($id_produk)
	{
		$data['produk']	= $this->Model_produk->get_produk_where($id_produk)->result_array();
		$id_kategori	= $this->Model_produk->get_produk_where($id_produk)->row()->idJenis;
		$data['rekom']	= $this->Model_produk->get_produk_kategori($id_kategori, $id_produk)->result_array();

		$this->load->view('template/header2');
		$this->load->view('detail_preorder', $data);
		$this->load->view('template/footer');
	}

	public function cari()
	{
		$cari = $this->input->post('cari');
		$data['pencarian'] 	= $this->Model_produk->cari_produk($cari)->result_array();
		$data['kategori']	= $this->Model_produk->get_kategori_produk()->result_array();

		$this->load->view('template/header2');
		$this->load->view('cari_produk', $data);
		$this->load->view('template/footer');
	}
}
