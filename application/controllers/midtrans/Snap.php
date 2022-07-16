<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller
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
		$params = array('server_key' => 'Mid-server-DxDTjtva89-ipo-hqvFg5e-4', 'production' => true);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('checkout_snap');
	}

	public function token()
	{
		$id_preorder = $this->input->post('id_preorder');
		$total_bayar = $this->input->post('total_bayar');

		$booking = $this->db->get_where('preorder', array('id_preorder' => $id_preorder))->row()->booking;

		$pengiriman		= $this->Model_preorder->get_pengiriman($id_preorder)->row();
		$item			= $this->Model_preorder->get_detailPreorder($id_preorder)->result_array();

		$midtrans = $this->Model_preorder->get_id_midtrans()->result_array();

		$cek = 1;

		while ($cek == 1) {
			$order_id = $id_preorder . '-' . rand(10000, 100000);
			$cek = in_array($order_id, $midtrans);
		}

		// Required
		$transaction_details = array(
			'order_id' => $order_id,
			'gross_amount' => $total_bayar, // no decimal allowed for creditcard
		);

		$item_details = array();
		foreach ($item as $xyz) {
			$item_details[] = array(
				'price'     => $xyz['total'] / $xyz['jumlah'],
				'quantity'  => $xyz['jumlah'],
				'name'      => $xyz['nama_produk'],
			);
		}
		if ($booking == 0) {
			$item_details[] = array(
				'price' => (int)$pengiriman->ongkir,
				'quantity' => 1,
				'name' => "Ongkir"
			);
		}


		// Optional
		if ($booking == 0) {
			$billing_address = array(
				'first_name'    => $pengiriman->nama,
				// 'last_name'     => "Litani",
				'address'       => $pengiriman->alamat,
				'city'          => $pengiriman->nama_kota,
				// 'postal_code'   => "16602",
				'phone'         => $pengiriman->no_hp,
				'country_code'  => 'IDN'
			);
		} else {
			$billing_address = array(
				'first_name'    => $pengiriman->nama,
				// 'last_name'     => "Litani",
				'address'       => $pengiriman->alamat,
				// 'city'          => $pengiriman->nama_kota,
				// 'postal_code'   => "16602",
				'phone'         => $pengiriman->no_hp,
				'country_code'  => 'IDN'
			);
		}


		// Optional
		if ($booking == 0) {
			$shipping_address = array(
				'first_name'    => $pengiriman->nama,
				// 'last_name'     => "Litani",
				'address'       => $pengiriman->alamat,
				'city'          => $pengiriman->nama_kota,
				// 'postal_code'   => "16602",
				'phone'         => $pengiriman->no_hp,
				'country_code'  => 'IDN'
			);
		} else {
			$shipping_address = array(
				'first_name'    => $pengiriman->nama,
				// 'last_name'     => "Litani",
				'address'       => $pengiriman->alamat,
				// 'city'          => $pengiriman->nama_kota,
				// 'postal_code'   => "16602",
				'phone'         => $pengiriman->no_hp,
				'country_code'  => 'IDN'
			);
		}


		// Optional
		$customer_details = array(
			'first_name'    => $pengiriman->nama,
			// 'last_name'     => "Litani",
			'email'         => $pengiriman->email,
			'phone'         => $pengiriman->no_hp,
			'billing_address'  => $billing_address,
			'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;
		//ser save_card true to enable oneclick or 2click
		//$credit_card['save_card'] = true;

		$time = time();
		if ($booking == 0) {
			$custom_expiry = array(
				'start_time' => date("Y-m-d H:i:s O", $time),
				'unit' => 'day',
				'duration'  => 1
			);
		} else {
			$custom_expiry = array(
				'start_time' => date("Y-m-d H:i:s O", $time),
				'unit' => 'minute',
				'duration'  => 5
			);
		}


		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			'expiry'             => $custom_expiry
		);


		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);

		error_log($snapToken);
		echo $snapToken;
	}

	public function finish()
	{
		$result = json_decode($this->input->post('result_data'), true);

		if ($result['payment_type'] == "bank_transfer") {
			$data = array(
				'id_midtrans' 		=> $result['order_id'],
				'id_preorder' 		=> strtok($result['order_id'], '-'),
				'status'			=> $result['status_code'],
				'total_bayar'		=> $result['gross_amount'],
				'metode'			=> $result['payment_type'],
				'waktu'				=> $result['transaction_time'],
				'url'				=> $result['pdf_url']
			);
		} else {
			$data = array(
				'id_midtrans' 		=> $result['order_id'],
				'id_preorder' 		=> strtok($result['order_id'], '-'),
				'status'			=> $result['status_code'],
				'total_bayar'		=> $result['gross_amount'],
				'metode'			=> $result['payment_type'],
				'waktu'				=> $result['transaction_time'],
			);
		}

		$simpan = $this->db->insert('midtrans', $data);

		if ($simpan) {
			$id_preorder = $result['order_id'];
			redirect('Checkout/pembayaran/' . $id_preorder);
		}
	}
}
