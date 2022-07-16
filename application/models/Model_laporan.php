<?php

class Model_laporan extends CI_Model {

    // get data gaji karyawan sesuai parameter
    public function get_gaji_karyawan($query)
    {
        $this->db->select('*');
        $this->db->from('gaji_karyawan');
        $this->db->like('bulan', $query);
        return $this->db->get();
    }

    // get data karyawan sesuai parameter
    public function get_gaji($id_karyawan)
    {
        $this->db->select('gaji');
        $this->db->from('karyawan');
        $this->db->where('id_karyawan', $id_karyawan);
        return $this->db->get();
    } 


    //          Permodalan
    // get data modal sesai parameter
    public function get_data_modal($bulan)
    {
        $this->db->select('*');
        $this->db->from('modal');
        $this->db->like('tanggal', $bulan);
        return $this->db->get();
    }

    // get data detail modal
    public function get_detail_modal()
    {
        return $this->db->get('detail_modal');
    }

    // get data detai modal where id modal sesuai parameter
    public function get_detail_modal_where($idModal)
    {
        return $this->db->get_where('detail_modal', array('id_modal' => $idModal));
    } 

    public function get_data_modal_bahan_baku($bulan)
    {
        $this->db->select('*');
        $this->db->from('modal');
        $this->db->where('jenis_pengeluaran', 1);
        $this->db->like('tanggal', $bulan);
        return $this->db->get();
    }

    public function get_data_modal_akomodasi($bulan)
    {
        $this->db->select('*');
        $this->db->from('modal');
        $this->db->where('jenis_pengeluaran', 2);
        $this->db->like('tanggal', $bulan);
        return $this->db->get();
    }

    public function get_data_modal_lain_lain($bulan)
    {
        $this->db->select('*');
        $this->db->from('modal');
        $this->db->where('jenis_pengeluaran', 3);
        $this->db->like('tanggal', $bulan);
        return $this->db->get();
    }

    //              Transaksi Langsung
    // get data transaksi langsung 
    public function get_transaksi_langsung($filter)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->like('tanggal', $filter);
        return $this->db->get();
    }

    // get data produk dan detail transaksi join
    public function get_detail_transaksi_langsung()
    {
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->join('detail_transaksi', 'detail_transaksi.id_produk = produk.id_produk');
        return $this->db->get();
    }


     //              Transaksi Preorder
     // get data transaksi preorder 
    public function get_transaksi_preorder($filter)
    {
        $this->db->select('*');
        $this->db->from('preorder');
        $this->db->join('pengiriman','pengiriman.id_preorder = preorder.id_preorder');
        $this->db->join('daerah_kirim','daerah_kirim.id_daerah = pengiriman.id_daerah');
        $this->db->where('preorder.booking', 0);
        $this->db->like('tanggal_pesan', $filter);
        return $this->db->get();
    }

     // get data transaksi booking 
     public function get_transaksi_booking($filter)
     {
         $this->db->select('*');
         $this->db->from('preorder');
         $this->db->where('booking', 1);
         $this->db->like('tanggal_pesan', $filter);
         return $this->db->get();
     }

    // get data produk dan detail preorder join
    public function get_detail_transaksi_preorder()
    {
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->join('detail_preorder', 'detail_preorder.id_produk = produk.id_produk');
        return $this->db->get();
    }


    //          Laporan Keuntungan
    //get data dan hitung jumlah pemasukan transaksi langsung
    public function total_transaksi_langsung($filter)
    {
        $this->db->select('SUM(total_belanja) as langsung');
        $this->db->from('transaksi');
        $this->db->like('tanggal', $filter);
        $this->db->where(array('status' => 'Selesai'));
        return $this->db->get();
    }

    //get data dan hitung jumlah pemasukan transaksi preorder
    public function total_transaksi_preorder($filter)
    {
        $this->db->select('SUM(jumlah) as preorder');
        $this->db->from('preorder');
        $this->db->where('booking', 0);
        $this->db->like('tanggal_pesan', $filter);
        $this->db->where(array('status' => 'Selesai'));
        return $this->db->get();
    }

    //get data dan hitung jumlah pemasukan transaksi booking
    public function total_transaksi_booking($filter)
    {
        $this->db->select('SUM(jumlah) as preorder');
        $this->db->from('preorder');
        $this->db->where('booking', 1);
        $this->db->like('tanggal_pesan', $filter);
        $this->db->where(array('status' => 'Selesai'));
        return $this->db->get();
    }

    //get data dan hitung jumlah pengeluaran modal
    public function total_pengeluaran_modal($filter)
    {
        // $this->db->select('SUM(total_modal) as keluar_modal');
        // $this->db->from('modal');
        // $this->db->like('tanggal', $filter);
        // return $this->db->get();
        $data1   =   $this->db->select('SUM(total_modal) as bahan_baku')
                    ->from('modal')
                    ->where('jenis_pengeluaran', 1)
                    ->like('tanggal', $filter)
                    ->get()->result_array();
        
        $data2   =   $this->db->select('SUM(total_modal) as akomodasi')
                    ->from('modal')
                    ->where('jenis_pengeluaran', 2)
                    ->like('tanggal', $filter)
                    ->get()->result_array();

        $data3   =   $this->db->select('SUM(total_modal) as lain_lain')
                    ->from('modal')
                    ->where('jenis_pengeluaran', 3)
                    ->like('tanggal', $filter)
                    ->get()->result_array();
        $data = [$data1, $data2, $data3];
        return $data;
    }

    //get data dan hitung jumlah pengeluaran gaji
    public function total_pengeluaran_gaji($filter)
    {
        $this->db->select('SUM(uang_gaji) as keluar_gaji');
        $this->db->from('gaji_karyawan');
        $this->db->like('bulan', $filter);
        return $this->db->get();
    }
}