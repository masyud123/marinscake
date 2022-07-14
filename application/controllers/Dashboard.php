<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{


	public function index()
	{
		$data['produk'] = $this->Model_produk->get_produk_terbaru()->result_array();
		$data['gambar'] = $this->Model_produk->get_gambar()->result_array();
		$data['slider'] = $this->Model_slider->get_slider_aktif()->result_array();

		$this->load->view('template/header');
		$this->load->view('dashboard', $data);
		$this->load->view('template/footer');
	}
}
