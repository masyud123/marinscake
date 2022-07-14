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

		$id_preorder = $result['order_id'];
		$data = array(
			'status' => $result['status_code']
		);

		echo json_encode($result);

		if ($result['status_code'] == 200) {
			$update = $this->db->update('midtrans', $data, array('id_preorder' => $id_preorder));

			if ($update) {
				$dt = array(
					'status' => "Menunggu Pengiriman"
				);

				$this->db->update('preorder', $dt, array('id_preorder' => $id_preorder));
			}
		} elseif($result['status_code'] == 202) {
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
