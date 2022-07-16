<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		if ($this->session->userdata('role') != 77) {
			redirect('admin/auth/login');
		}
		error_reporting(0);
	}

	public function get_notif()
	{
		$data['notif'] = $this->db->get_where('notifikasi', array('status_notif' => 0))->result_array();
		$this->load->view('admin/template/notif', $data);
	}

	public function baca_semua_notif()
	{
		$notif = $this->db->get_where('notifikasi', array('status_notif' => 0))->result_array();
		foreach ($notif as $woi) {
			$id_notif = $woi['id_notifikasi'];
			$data = array(
				'status_notif' => 1
			);
			$this->db->update('notifikasi', $data, array('id_notifikasi' => $id_notif));
		}
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	public function baca_notif($id)
	{
		$notif = $this->db->get_where('notifikasi', array('id_preorder' => $id))->row_array();
		$id_notif = $notif['id_notifikasi'];
		$data = array(
			'status_notif' => 1
		);
		$this->db->update('notifikasi', $data, array('id_notifikasi' => $id_notif));

		echo 1;
	}

	// tampil dashboard admin
	public function index()
	{
		// data array transaksi langsung
		$transaksi_ls = $this->Model_dashboard->total_transaksi_langsung();
		for ($i = 0; $i < count($transaksi_ls); $i++) {
			$tr_ls[] = array(
				$i => $transaksi_ls[$i][0]->total_belanja,
			);
		}
		$data['tr_langsung'] = $tr_ls;

		//data array transaksi preorder
		$transaksi_pr = $this->Model_dashboard->total_transaksi_preorder();
		for ($i = 0; $i < count($transaksi_pr); $i++) {
			$tr_pr[] = array(
				$i => $transaksi_pr[$i][0]->jumlah,
			);
		}
		$data['tr_preorder'] = $tr_pr;

		//data array pengeluaram modal
		$pengeluaran = $this->Model_dashboard->total_pengeluaran();
		for ($i = 0; $i < count($pengeluaran); $i++) {
			$klr_modal[] = array(
				$i => $pengeluaran[$i][0]->total_modal,
			);
		}
		$data['pengeluaran'] = $klr_modal;

		$data['produk'] 			= $this->Model_dashboard->get_produk()->result_array();
		$data['transaksi_langsung'] = $this->Model_dashboard->transaksi_langsung()->result_array();
		$data['transaksi_preorder'] = $this->Model_dashboard->transaksi_preorder()->result_array();
		$data['pengeluaran_modal']	= $this->db->get('modal')->result_array();

		$this->load->view('admin/template/header');
		$this->load->view('admin/template/sidebar');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/template/footer');
	}
}
