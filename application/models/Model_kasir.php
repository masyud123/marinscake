<?php
class Model_kasir extends CI_Model
{
	// get data tr langsung
	public function get_tr_langsung()
	{
        date_default_timezone_set('Asia/Jakarta');

		$this->db->select('total_belanja');
        $this->db->from('transaksi');
        $this->db->like('tanggal', date('Y-m-d'));
        return $this->db->get();
	}

    // get data tr preorder
	public function get_tr_preorder()
	{
		date_default_timezone_set('Asia/Jakarta');

		$this->db->select('jumlah');
        $this->db->from('preorder');
        $this->db->like('tanggal_pesan', date('Y-m-d'));
        return $this->db->get();
	}
    
    public function get_tr_langsung_mingguan()
	{
        for($i=0; $i<=6; $i++){
            $tanggal[] = date('Y-m-d', strtotime('+'.($i-date('w')).' days'));
            $this->db->select_sum('total_belanja');
            $this->db->from('transaksi');
            $this->db->like('tanggal', $tanggal[$i]);
            $data[$i] = $this->db->get()->result();
        } 
        return $data;
	}

    public function get_tr_preorder_mingguan()
	{
		for($i=0; $i<=6; $i++){
            $tanggal[] = date('Y-m-d', strtotime('+'.($i-date('w')).' days'));
            $this->db->select_sum('jumlah');
            $this->db->from('preorder');
            $this->db->like('tanggal_pesan', $tanggal[$i]);
            $data[$i] = $this->db->get()->result();
        }
        return $data;
	}
}