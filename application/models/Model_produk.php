<?php

class Model_produk extends CI_Model
{
	// get data produk dan jenis produk join
	public function get_produk()
	{
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->join('gambar_produk', 'produk.id_produk = gambar_produk.id_produk');
		$this->db->join('jenis_produk', 'produk.id_jenis=jenis_produk.id_jenis');
		$this->db->group_by('gambar_produk.id_produk');
		return $this->db->get();
	}

	// get data harga termahal pada tb produk
	public function get_max_harga()
	{
		$this->db->select_max('harga');
		$this->db->from('produk');
		return $this->db->get();
	}

	// get data produk dan jenis produk join where id produk sesuai param
	public function get_produk_where($id_produk)
	{
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->join('jenis_produk', 'jenis_produk.id_jenis = produk.id_jenis');
		$this->db->where('id_produk', $id_produk);
		return $this->db->get();
	}

	// get data produk where parameter
	public function get_filter($min_price, $max_price, $where, $rowperpage, $rowno)
	{
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->join('jenis_produk', 'jenis_produk.id_jenis = produk.id_jenis');
		// $this->db->join('gambar_produk', 'produk.id_produk = gambar_produk.id_produk', 'left');
		// $this->db->order_by('id_produk');
		if ($where != null) {
			foreach ($where as $whr) {
				$this->db->where('id_jenis', $whr);
			}
		}
		if ($min_price != null) {
			$this->db->where('harga >=', $min_price);
		}
		if ($max_price != null) {
			$this->db->where('harga <=', $max_price);
		}
		$this->db->where('status_produk', 1);
		$this->db->limit($rowperpage, $rowno);
		return $this->db->get();
	}

	public function get_filter_where($where, $min_price, $max_price, $rowperpage, $rowno)
	{
		$this->db->select('*');
		$this->db->from('produk');
		if ($where != null) {
			$where2 = explode(",", $where);
			$count = count($where2);
			for ($x = 0; $x < $count; $x++) {
				$this->db->where('id_jenis', $where2[$x]);
			}
		}
		if ($min_price != null) {
			$this->db->where('harga >=', $min_price);
		}
		if ($max_price != null) {
			$this->db->where('harga <=', $max_price);
		}
		$this->db->limit($rowperpage, $rowno);
		return $this->db->get();
	}

	public function get_filter_count($where, $min_price, $max_price)
	{
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->join('gambar_produk', 'produk.id_produk = gambar_produk.id_produk');
		if ($where != null) {
			$this->db->where('id_jenis', $where);
		}
		if ($min_price != null) {
			$this->db->where('harga >=', $min_price);
		}
		if ($max_price != null) {
			$this->db->where('harga <=', $max_price);
		}
		$this->db->group_by('gambar_produk.id_produk', 'ASC');
		$this->db->where('status_produk', 1);
		return $this->db->get();
	}

	// get data produk limit 6
	public function get_produk_terbaru()
	{
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->join('jenis_produk', 'produk.id_jenis=jenis_produk.id_jenis');
		$this->db->where('jenis_produk.status', 1);
		$this->db->where('produk.status_produk', 1);
		$this->db->limit(6);
		$this->db->order_by('id_produk', 'DESC');
		return $this->db->get();
	}

	// get data produk sesuai kategori dan id produk limit 4
	public function get_all_rekom($id_kategori, $id_produk)
	{
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->join('gambar_produk', 'produk.id_produk = gambar_produk.id_produk');
		$this->db->where('id_jenis', $id_kategori);
		$this->db->where('status_produk', 1);
		$this->db->where('produk.id_produk!=', $id_produk);
		$this->db->group_by('gambar_produk.id_produk');
		return $this->db->get();
	}

	public function get_rekom_limit($id_kategori, $id_produk, $limit)
	{
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->join('gambar_produk', 'produk.id_produk = gambar_produk.id_produk');
		$this->db->group_by('gambar_produk.id_produk');
		$this->db->where('id_jenis', $id_kategori);
		$this->db->where('produk.id_produk!=', $id_produk);
		$this->db->limit($limit);
		return $this->db->get();
	}

	// get data produk sesuai kategori
	public function get_per_kategori($id_kategori)
	{
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->where('id_jenis', $id_kategori);
		return $this->db->get();
	}

	// get data jenis produk
	public function get_kategori_produk()
	{
		return $this->db->get('jenis_produk');
	}

	// get data produk sesuai parameter
	public function cari_produk($keyword, $rowno, $rowperpage)
	{
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->join('gambar_produk', 'produk.id_produk = gambar_produk.id_produk');
		$this->db->join('jenis_produk', 'jenis_produk.id_jenis = produk.id_jenis');
		$this->db->group_by('gambar_produk.id_produk');
		$this->db->like('nama_produk', $keyword);
		$this->db->where('status', 1);
		$this->db->where('status_produk', 1);
		$this->db->limit($rowperpage, $rowno);
		return $this->db->get();
	}

	public function cari_count($keyword)
	{
		$this->db->select('count(*) as allcount');
		$this->db->from('produk');
		$this->db->join('jenis_produk', 'jenis_produk.id_jenis = produk.id_jenis');
		$this->db->like('nama_produk', $keyword);
		$this->db->where('status', 1);
		$this->db->where('status_produk', 1);
		$query = $this->db->get();
		$result = $query->result_array();

		return $result[0]['allcount'];
	}

	// get data gambar produk dengan kelompok sesuai id produk
	public function get_gambar()
	{
		$this->db->select('*');
		$this->db->from('gambar_produk');
		$this->db->group_by('gambar_produk.id_produk');
		return $this->db->get();
	}

	// get gambar produk sesuai parameter
	public function get_gambar_produk($id_produk)
	{
		$this->db->select('*');
		$this->db->from('gambar_produk');
		$this->db->where('id_produk', $id_produk);
		return $this->db->get();
	}

	// Fetch records
	public function getData($rowno, $rowperpage)
	{
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->join('gambar_produk', 'produk.id_produk = gambar_produk.id_produk', 'l');
		$this->db->join('jenis_produk', 'jenis_produk.id_jenis = produk.id_jenis');
		$this->db->group_by('gambar_produk.id_produk');
		$this->db->where('status', 1);
		$this->db->where('status_produk', 1);
		$this->db->limit($rowperpage, $rowno);
		$query = $this->db->get();

		return $query->result_array();
	}

	// Select total records
	public function getrecordCount()
	{

		$this->db->select('count(*) as allcount');
		$this->db->from('produk');
		$this->db->join('jenis_produk', 'jenis_produk.id_jenis = produk.id_jenis');
		$this->db->where('status', 1);
		$this->db->where('status_produk', 1);
		$query = $this->db->get();
		$result = $query->result_array();

		return $result[0]['allcount'];
	}
}
