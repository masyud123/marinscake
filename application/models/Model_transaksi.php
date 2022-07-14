<?php

class Model_transaksi extends CI_Model
{
    // get data transaksi sesuai parameter
    public function get_riwayat_transaksi($tanggal)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->like('tanggal', $tanggal);
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get();
    }

    // get data detail transaksi dan produk join
    public function detail_riwayat_transaksi()
    {
        $this->db->select('*');
        $this->db->from('detail_transaksi');
        $this->db->join('produk', 'produk.id_produk = detail_transaksi.id_produk');
        return $this->db->get('');
    }

    // get data preorder sesuai parameter
    public function get_riwayat_preorder($tanggal)
    {
        $this->db->select('*');
        $this->db->from('preorder');
        $this->db->like('tanggal_pesan', $tanggal);
        $this->db->join('pengiriman', 'preorder.id_preorder = pengiriman.id_preorder');
        $this->db->join('daerah_kirim', 'pengiriman.id_daerah = daerah_kirim.id_daerah');
        $this->db->order_by('tanggal_pesan', 'DESC');
        return $this->db->get();
    }

    // get data detail preorder join produk
    public function detail_riwayat_preorder()
    {
        $this->db->select('*');
        $this->db->from('detail_preorder');
        $this->db->join('produk', 'produk.id_produk = detail_preorder.id_produk');
        return $this->db->get('');
    }

    // get data preorder where status menunggu pengiriman
    public function barang_belum_dikirim()
    {
        $this->db->select('*');
        $this->db->from('preorder');
        $this->db->join('pengiriman', 'preorder.id_preorder = pengiriman.id_preorder');
        $this->db->join('daerah_kirim', 'pengiriman.id_daerah = daerah_kirim.id_daerah');
        $this->db->order_by('tanggal_pesan', 'DESC');
        $this->db->where('status', 'Menunggu Pengiriman');
        return $this->db->get();
    }
    
    // get data preorder where status belum dibayar
    public function barang_belum_dibayar()
    {
        $this->db->select('*');
        $this->db->from('preorder');
        $this->db->join('pengiriman', 'preorder.id_preorder = pengiriman.id_preorder');
        $this->db->join('daerah_kirim', 'pengiriman.id_daerah = daerah_kirim.id_daerah');
        $this->db->order_by('tanggal_pesan', 'DESC');
        $this->db->where('status', 'Menunggu Pembayaran');
        return $this->db->get();
    }

    // get data transaksi sesuai parameter
    public function get_transaksi($id_transaksi)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->get('');
    }

    // get data detail transaksi sesuai parameter
    public function get_detailTransaksi($id_transaksi)
    {
        $this->db->select('*');
        $this->db->from('detail_transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->get('');
    }

    // get data pengiriman sesuai parameter
    public function get_pengiriman($id_transaksi)
    {
        $this->db->select('*');
        $this->db->from('pengiriman');
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->get('');
    }

    // get data midtrans sesuai parameter
    public function get_midtrans($id_transaksi)
    {
        $this->db->select('*');
        $this->db->from('midtrans');
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->get('');
    }

    //get biaya ongkir
    public function get_ongkir($id_daerah)
    {
        $this->db->select('ongkir');
        $this->db->from('daerah_kirim');
        $this->db->where('id_daerah', $id_daerah);
        return $this->db->get();   
    }
}
