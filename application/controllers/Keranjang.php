<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang extends CI_Controller
{


	public function index()
	{
		$cart = $this->cart->contents();
		$data['cart'] = $cart;
		$this->load->view('template/header2');
		$this->load->view('keranjang', $data);
		$this->load->view('template/footer');
	}

	function add_to_cart()
	{
		$id			= $this->input->post('produk_id');
		$name 		= $this->input->post('produk_nama');
		$price 		= $this->input->post('produk_harga');
		$gambar		= $this->input->post('produk_gambar');
		$min_order	= $this->input->post('min_order');
		$qty 		= $this->input->post('quantity');

		$data = array(
			'id'		=> $id,
			'name' 		=> $name,
			'price' 	=> $price,
			'gambar'	=> $gambar,
			'qty' 		=> $qty,
			'min'		=> $min_order
		);
		$this->cart->insert($data);

		$data['cart'] = $this->show_cart();
		$data['cart1'] = $this->show_cart1();
		$data['cart2'] = $this->show_cart2();

		echo json_encode($data);

		// echo json_encode($data); //tampilkan cart setelah added
	}

	function cek_stok_cart()
	{
		$return = true;
		foreach ($this->cart->contents() as $items) {
			$id_produk = $items['id'];
			$produk = $this->db->get_where('produk', array('id_produk' => $id_produk))->row_array();
			if ($items['qty'] > $produk['stok']) {
				$return = false;
				break;
			}
		}
		echo json_encode($return);
	}

	function update_stok_cart()
	{
		foreach ($this->cart->contents() as $items) {
			$id_produk = $items['id'];
			$produk = $this->db->get_where('produk', array('id_produk' => $id_produk))->row_array();
			if ($items['qty'] > $produk['stok']) {
				$data = array(
					'rowid' => $items['rowid'],
					'qty' => $produk['stok'],
				);
				$this->cart->update($data);
			}
		}
		$data['cart'] = $this->show_cart();
		$data['cart2'] = $this->show_cart2();

		echo json_encode($data);
	}

	function cek_min_cart()
	{
		$return = true;
		foreach ($this->cart->contents() as $items) {
			$id_produk = $items['id'];
			$produk = $this->db->get_where('produk', array('id_produk' => $id_produk))->row_array();
			if ($items['qty'] < $produk['min_order']) {
				$return = false;
				break;
			}
		}
		echo json_encode($return);
	}

	function update_min_cart()
	{
		foreach ($this->cart->contents() as $items) {
			$id_produk = $items['id'];
			$produk = $this->db->get_where('produk', array('id_produk' => $id_produk))->row_array();
			if ($items['qty'] < $produk['min_order']) {
				$data = array(
					'rowid' => $items['rowid'],
					'qty' => $produk['min_order'],
				);
				$this->cart->update($data);
			}
		}
		$data['cart'] = $this->show_cart();
		$data['cart2'] = $this->show_cart2();

		echo json_encode($data);
	}

	function show_cart1()
	{
		$output 	= '';
		$no 		= 0;
		$total_item	= 0;

		foreach ($this->cart->contents() as $items) {
			$no++;
			$total_item += $items['qty'];
			$output .= '
				<div class="ps-cart__content">
					<div class="ps-cart-item">
						<button type="button" id="' . $items['rowid'] . '" nama="' . $items['name'] . '" class="hapus_cart ps-cart-item__close" href="#"></button>
						<div class="ps-cart-item__thumbnail">
							<a href="' . base_url() . 'produk/detail/' . $items['id'] . '"></a><img src="' . base_url() . 'uploads/gambar_produk/' . $items['gambar'] . '" alt="" />
						</div>
						<div class="ps-cart-item__content">
							<a class="ps-cart-item__title" href="' . base_url() . 'produk/detail/' . $items['id'] . '">' . $items['name'] . '</a>
							<p>
								<span>Quantity:<i>' . $items['qty'] . '</i></span><br><span>Harga:<i>Rp ' . number_format($items['price'], '0', ',', '.') . '</i></span><br><span>Subtotal:<i>Rp ' . number_format($items['subtotal'], '0', ',', '.') . '</i></span>
							</p>
						</div>
					</div>
				</div>
			';
		}
		if ($total_item > 0) {
			$output .= '
				<div class="ps-cart__total">
					<p>Number of items:<span>' . $total_item . '</span></p>
					<p>Item Total:<span>Rp ' . number_format($this->cart->total(), '0', ',', '.') . '</span></p>
				</div>
				<div class="ps-cart__footer">
					<a href="' . base_url() . 'keranjang">Lihat Keranjang</a>
				</div>
			';
		} else {
			$output .= '
				<div class="ps-cart__footer">
					<a href="">Keranjang Kosong</a>
				</div>
			';
		}
		return $output;
	}

	function show_cart()
	{ //Fungsi untuk menampilkan Cart
		$output = '';
		$no = 0;
		$total_item = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$total_item += $items['qty'];
			$output .= '
				<div class="ps-cart__content">
					<div class="ps-cart-item">
						<button type="button" id="' . $items['rowid'] . '" nama="' . $items['name'] . '" class="hapus_cart ps-cart-item__close" ></button>
						<div class="ps-cart-item__thumbnail"><a href="' . base_url() . 'produk/detail/' . $items['id'] . '"></a><img src="' . base_url() . 'uploads/gambar_produk/' . $items['gambar'] . '" alt="">
						</div>
						<div class="ps-cart-item__content"><a class="ps-cart-item__title" href="' . base_url() . 'produk/detail/' . $items['id'] . '">' . $items['name'] . '</a>
							<p><span>Quantity:<i>' . $items['qty'] . '</i></span><br><span>Harga:<i>Rp ' . number_format($items['price'], '0', ',', '.') . '</i></span><br><span>Subtotal:<i>Rp ' . number_format($items['subtotal'], '0', ',', '.') . '</i></span></p>
						</div>
					</div>
				</div>
			';
		}
		if ($total_item > 0) {
			$output .= '
				<div class="ps-cart__total">
					<p>Number of items:<span>' . $total_item . '</span></p>
					<p>Item Total:<span>Rp ' . number_format($this->cart->total(), '0', ',', '.') . '</span></p>
				</div>
				<div class="ps-cart__footer"><a href="' . base_url() . 'keranjang">Lihat Keranjang</a></div>
			';
		} else {
			$output .= '
				<div class="ps-cart__footer"><a href="#">Keranjang Kosong</a></div>
			';
		}


		return $output;
		// return $proses;
	}
	function show_cart2()
	{ //Fungsi untuk menampilkan Cart
		$output = '
			<div class="table-responsive">
				<table class="table ps-table ps-table--listing">
					<thead>
						<tr>
							<th>Produk</th>
							<th  class="text-center">Harga</th>
							<th class="text-center">Jumlah</th>
							<th class="text-center">Total</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
		';
		$no = 0;
		$total_item = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$total_item += $items['qty'];
			$output .= '
				<tr>
					<td>
						<a class="ps-product--table" href="' . base_url() . 'produk/detail/' . $items['id'] . '">
							<img class="mr-15" src="' . base_url() . 'uploads/gambar_produk/' . $items['gambar'] . '" alt="">
							' . $items['name'] . '
						</a>
					</td>
					<td  class="text-center">Rp ' . number_format($items['price'], '0', ',', '.') . '</td>
					<td class="text-center" >
						<div class="form-group--number">
							<button class="min_cart minus" data-id="' . $items['rowid'] . '" data-produkid="' . $items['id'] . '" data-produknama="' . $items['name'] . '" data-minorder="' . $items['min'] . '" ><span>-</span></button>
							<input class="edit_qty form-control" type="number" value="' . $items['qty'] . '" id="qty' . $items['id'] . '" data-id="' . $items['rowid'] . '" data-produkid="' . $items['id'] . '" data-produknama="' . $items['name'] . '" data-minorder="' . $items['min'] . '">
							<button class="tambah_cart2 plus" data-produkid="' . $items['id'] . '" data-produknama="' . $items['name'] . '" data-produkharga="' . $items['price'] . '" data-produkgambar="' . $items['gambar'] . '" data-minorder="' . $items['min'] . '"><span>+</span></button>
						</div>
					</td>
					<td  class="text-center"><strong>Rp ' . number_format($items['price'] * $items['qty'], '0', ',', '.') . '</strong></td>
					<td  class="text-center">
						<div class="hapus_cart2 ps-remove" id="' . $items['rowid'] . '" nama="' . $items['name'] . '" ></div>
					</td>
				</tr>
			';
		}
		if ($total_item > 0) {
			$output .= '
						</tbody>
					</table>
				</div>
				<div class="ps-cart__actions pt-2">
					<div class="ps-cart__promotion">
					</div>
					<div class="ps-cart__total">
						<h3>
							Total Price:  <span> Rp ' . number_format($this->cart->total(), '0', ',', '.') . '</span>
						</h3>
					</div>
				</div>
				<div class="text-right">
					<button class="checkout-booking ps-btn" id="checkout-booking">Checkout for Now</button>
					<button class="checkout-preorder ps-btn" id="checkout-preorder">Checkout for Preorder</button>
				</div>
			';
		} else {
			$output = '';
			$output .= '
				<div class="table-responsive">
					<table class="table ps-table">
						<thead>
							<tr class="text-center">
								<th>Keranjang Kosong</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="ps-cart__actions pt-2">
					<div class="ps-cart__promotion">
					</div>
					<div class="ps-cart__total">
						<a class="ps-btn" href="' . base_url() . 'produk">Kembali Lihat Produk</a>
					</div>
				</div>
			';
		}


		return $output;
		// return $proses;
	}

	function load_cart()
	{ //load data cart
		echo $this->show_cart();
	}

	function load_cart1()
	{ //load data cart
		echo $this->show_cart1();
	}

	function load_cart2()
	{ //load data cart
		echo $this->show_cart2();
	}

	function hapus_cart()
	{ //fungsi untuk menghapus item cart
		$data = array(
			'rowid' => $this->input->post('row_id'),
			'qty' => 0,
		);
		if ($this->cart->update($data)) {
			$data['cart'] = $this->show_cart();
			$data['cart2'] = $this->show_cart2();

			echo json_encode($data);
		}
	}

	function update_cart()
	{ //fungsi untuk menghapus item cart
		$data = array(
			'rowid' => $this->input->post('row_id'),
			'qty' => $this->input->post('quantity'),
		);
		if ($this->cart->update($data)) {
			$data['cart'] = $this->show_cart();
			$data['cart2'] = $this->show_cart2();

			echo json_encode($data);
		}
	}

	function get_cart()
	{
		$id_produk = $this->input->post('produk_id');
		$cart = $this->cart->contents();
		$nilai = 0;
		foreach ($cart as $key) {
			if ($id_produk == $key['id']) {
				$nilai = 1;
			}
		}

		echo $nilai;
	}
}
