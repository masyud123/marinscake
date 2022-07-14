<?php

class Model_dashboard extends CI_Model 
{
    // get data produk
    public function get_produk()
    {
        return $this->db->get('produk');
    }

    //get data transaksi langsung
    public function transaksi_langsung()
    {
        return $this->db->get('transaksi');
    }

    // get data transaksi preorder
    public function transaksi_preorder()
    {
        return $this->db->get('preorder');
    }

    //  <-- get data total transaksi langsung dalam setahun -->
    public function total_transaksi_langsung()
    {
        $tahun = date('Y');
        $tr_ls = array(''.$tahun.'-01',''.$tahun.'-02',''.$tahun.'-03',''.$tahun.'-04',''.$tahun.'-05',''.$tahun.'-06',''.$tahun.'-07',''.$tahun.'-08',''.$tahun.'-09',''.$tahun.'-10',''.$tahun.'-11',''.$tahun.'-12');
            
        for($i=0; $i<count($tr_ls); $i++){ 
            $this->db->select_sum('total_belanja');
            $this->db->from('transaksi');
            $this->db->like('tanggal', $tr_ls[$i]);
            $data[$i] = $this->db->get()->result();
        }
        return $data;
    }

    //  <-- get data total transaksi preorder dalam setahun -->
    public function total_transaksi_preorder()
    {
        $tahun = date('Y');
        $tr_pr = array(''.$tahun.'-01',''.$tahun.'-02',''.$tahun.'-03',''.$tahun.'-04',''.$tahun.'-05',''.$tahun.'-06',''.$tahun.'-07',''.$tahun.'-08',''.$tahun.'-09',''.$tahun.'-10',''.$tahun.'-11',''.$tahun.'-12');
            
        for($i=0; $i<count($tr_pr); $i++){
            $this->db->select_sum('jumlah');
            $this->db->from('preorder');
            $this->db->like('tanggal_pesan', $tr_pr[$i]);
            $data[$i] = $this->db->get()->result();
        }
        return $data;
    }

    //  <-- get data total pengeluaran dalam setahun -->
    public function total_pengeluaran()
    {
        $tahun = date('Y');
        $tt_klr = array(''.$tahun.'-01',''.$tahun.'-02',''.$tahun.'-03',''.$tahun.'-04',''.$tahun.'-05',''.$tahun.'-06',''.$tahun.'-07',''.$tahun.'-08',''.$tahun.'-09',''.$tahun.'-10',''.$tahun.'-11',''.$tahun.'-12');
            
        for($i=0; $i<count($tt_klr); $i++){
            $this->db->select_sum('total_modal');
            $this->db->from('modal');
            $this->db->like('tanggal', $tt_klr[$i]);
            $data[$i] = $this->db->get()->result();
        }
        return $data;
    }
    
}