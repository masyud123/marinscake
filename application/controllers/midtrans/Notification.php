<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$params = array('server_key' => 'Mid-server-DxDTjtva89-ipo-hqvFg5e-4', 'production' => true);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->helper('url');
	}

	public function index()
	{
		echo 'test notification handler';
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result, true);

		$id_preorder =  strtok($result['order_id'], '-');
		$data = array(
			'status' => $result['status_code']
		);

		echo json_encode($result);

		if ($result['status_code'] == 200) {
			$update = $this->db->update('midtrans', $data, array('id_preorder' => $id_preorder));
			$booking = $this->db->get_where('preorder', array('id_preorder' => $id_preorder))->row()->booking;

			if ($update) {
				if ($booking == 0) {
					$dt = array(
						'status' => "Menunggu Pengiriman"
					);
					$this->db->update('preorder', $dt, array('id_preorder' => $id_preorder));
					$notif = array(
						'id_preorder'	=> $id_preorder,
						'pesan'			=> 'Masuk data preorder menunggu pengiriman',
						'keterangan'	=> 'preorder',
						'waktu'			=> date('Y-m-d H:i:s'),
						'status_notif'	=> '0'
					);
					$update = $this->db->update('notifikasi', $notif, array('id_preorder' => $id_preorder));
					if (!$update) {
						$this->db->insert('notifikasi', $notif);
					}
				} else {
					$dt = array(
						'status' => "Menunggu Diambil"
					);
					$this->db->update('preorder', $dt, array('id_preorder' => $id_preorder));
					$produk = $this->db->get_where('detail_preorder', array('id_preorder' => $id_preorder))->result_array();
					foreach ($produk as $item) {
						$id_produk = $item['id_produk'];
						$jumlah = $item['jumlah'];
						$stok_awal = $this->db->get_where('produk', array('id_produk' => $id_produk))->row()->stok;
						$stok_akhir = $stok_awal - $jumlah;
						$data_stok = array('stok' => $stok_akhir);
						$this->db->update('produk', $data_stok, array('id_produk' => $id_produk));
					}
					$notif = array(
						'id_preorder'	=> $id_preorder,
						'pesan'			=> 'Masuk data booking menunggu diambil',
						'keterangan'	=> 'booking',
						'waktu'			=> date('Y-m-d H:i:s'),
						'status_notif'	=> '0'
					);
					$update = $this->db->update('notifikasi', $notif, array('id_preorder' => $id_preorder));
					if (!$update) {
						$this->db->insert('notifikasi', $notif);
					}
				}
			}
		} elseif ($result['status_code'] == 202) {
			$update = $this->db->update('midtrans', $data, array('id_preorder' => $id_preorder));

			if ($update) {
				$dt = array(
					'status' => "Transaksi Gagal"
				);

				$this->db->update('preorder', $dt, array('id_preorder' => $id_preorder));
			}
		}
	}
}
