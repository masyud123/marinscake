<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak_pdf extends CI_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('role') != 77) {
			redirect('admin/auth/login');
		}
		error_reporting(0);
		$this->load->library('pdf');
	}

	//	cetak pdf laporan gaji
	public function cetak_gaji_pdf($blnTh)
    {
     	$data['data_karyawan'] = $this->Model_karyawan->get_data_karyawan()->result_array();
     	$data['gaji_karyawan'] = $this->Model_laporan->get_gaji_karyawan($blnTh)->result_array();
     	$data['bulan_tahun']   = $blnTh;
     	
     	$this->load->view('admin/laporan/laporan_gaji_pdf', $data);

     	$paper_size 	= 'A4';
		$orientation 	= 'portrait';
		$html 			= $this->output->get_output();
		$this->pdf->set_paper($paper_size, $orientation);

		$this->pdf->load_html($html);
		$this->pdf->render();
		$this->pdf->stream("Gaji_Karyawan.pdf", array('Attachment' =>0)); 
    }

	//	cetak pdf laporan pengeluaran modal
    public function cetak_modal_pdf($blnTh, $jenis_pengeluaran)
    {
		if($jenis_pengeluaran == 0){
			$data['data_modal'] 	= $this->Model_laporan->get_data_modal($blnTh)->result_array();
			$data['detail_modal'] 	= $this->Model_laporan->get_detail_modal()->result_array();
			$data['bulan_tahun']   	= $blnTh;
			$data['jenis'] 			= "Semua pengeluaran ";
		}elseif($jenis_pengeluaran == 1){
			$data['data_modal'] 	= $this->Model_laporan->get_data_modal_bahan_baku($blnTh)->result_array();
			$data['detail_modal'] 	= $this->Model_laporan->get_detail_modal()->result_array();
			$data['bulan_tahun']   	= $blnTh;
			$data['jenis'] 			= "Pengeluaran bahan baku ";
		}elseif($jenis_pengeluaran == 2){
			$data['data_modal'] 	= $this->Model_laporan->get_data_modal_akomodasi($blnTh)->result_array();
			$data['detail_modal'] 	= $this->Model_laporan->get_detail_modal()->result_array();
			$data['bulan_tahun']   	= $blnTh;
			$data['jenis'] 			= "Pengeluaran akomodasi ";
		}elseif($jenis_pengeluaran == 3){
			$data['data_modal'] 	= $this->Model_laporan->get_data_modal_lain_lain($blnTh)->result_array();
			$data['detail_modal'] 	= $this->Model_laporan->get_detail_modal()->result_array();
			$data['bulan_tahun']   	= $blnTh;
			$data['jenis'] 			= "Pengeluaran lain-lain ";
		}

     	$this->load->view('admin/laporan/laporan_modal_pdf', $data);

     	$paper_size 	= 'A4';
		$orientation 	= 'portrait';
		$html 			= $this->output->get_output();
		$this->pdf->set_Paper($paper_size, $orientation);

		$this->pdf->load_html($html);
		$this->pdf->render();
		$this->pdf->stream("Pengeluaran_Modal.pdf", array('Attachment' =>0)); 
    }

    //	cetak pdf laporan transaksi langsung & preorder
    public function cetak_semua_pdf($blnTh)
    {
		$data['bulan_tahun'] = $blnTh;
     	// $transaksi  = $this->Model_laporan->get_transaksi_langsung($blnTh)->result_array();

        // $prd   = $this->Model_laporan->get_transaksi_preorder($blnTh)->result_array();
		// foreach($prd as $key => $val):
		// 	if($val['metode'] == 'Offline'){$pembayaran = 'Tunai';}
		// 	else{$pembayaran = 'Transfer';}
		// 	$preorder[] = array(
		// 		'id_preorder' 	=> $val['id_preorder'],
		// 		'total_belanja' => $val['jumlah'],
		// 		'metode'		=> $val['metode'],
		// 		'pembayaran' 	=> $pembayaran,
		// 		'status' 		=> $val['status'],
		// 		'tanggal'		=> $val['tanggal_pesan'],
		// 	);
		// endforeach;

		// $gabung = array_merge($transaksi, $preorder);
		// $data['semua_transaksi'] = array_chunk($gabung, 18, true);

		// $dtl_langsung = $this->db->get('detail_transaksi')->result_array();
		// $dtl_preorder = $this->db->get('detail_preorder')->result_array();
		// $gabung2 = array_merge($dtl_langsung, $dtl_preorder);
		// $data['detail_transaksi'] = $gabung2;

		$data_transaksi1   = $this->Model_laporan->get_transaksi_langsung($blnTh)->result_array();
		foreach($data_transaksi1 as $dt_trans){
			$dt_join1[] = [
				'tanggal' 	=> $dt_trans['tanggal'],
				'total_belanja' => $dt_trans['total_belanja'],
				'detail' => $this->db->select('*')
								->from('detail_transaksi')
								->join('produk', 'produk.id_produk = detail_transaksi.id_produk')
								->where('detail_transaksi.id_transaksi', $dt_trans['id_transaksi'])
								->get()->result_array()
			];
		}
		$data['data_transaksi1'] = $dt_join1;

		$data_transaksi2   = $this->Model_laporan->get_transaksi_preorder($blnTh)->result_array();
		foreach($data_transaksi2 as $dt_trans){
			$dt_join2[] = [
				'tanggal' 	=> $dt_trans['tanggal_pesan'],
				'total_belanja' => $dt_trans['jumlah'],
				'detail' => $this->db->select('*')
								->from('detail_preorder')
								->join('produk', 'produk.id_produk = detail_preorder.id_produk')
								->where('detail_preorder.id_preorder', $dt_trans['id_preorder'])
								->get()->result_array()
			];
		}
		$data['data_transaksi2'] = $dt_join2;

		// echo "<pre>"; print_r($data); exit;
     	$this->load->view('admin/laporan/laporan_semua_pdf', $data);

     	$paper_size 	= 'A4';
		$orientation 	= 'landscape';
		$html 			= $this->output->get_output();
		$this->pdf->set_paper($paper_size, $orientation);

		$this->pdf->load_html($html);
		$this->pdf->render();
		$this->pdf->stream("Semua_Daftar_Transaksi.pdf", array('Attachment' =>0)); 
    }

    //	cetak pdf laporan transaksi langsung
    public function cetak_langsung_pdf($blnTh)
    {
     	$data_transaksi   = $this->Model_laporan->get_transaksi_langsung($blnTh)->result_array();
		foreach($data_transaksi as $dt_trans){
			$dt_join[] = [
				'tanggal' 	=> $dt_trans['tanggal'],
				'total_belanja' => $dt_trans['total_belanja'],
				'detail' => $this->db->select('*')
								->from('detail_transaksi')
								->join('produk', 'produk.id_produk = detail_transaksi.id_produk')
								->where('detail_transaksi.id_transaksi', $dt_trans['id_transaksi'])
								->get()->result_array()
			];
		}
		$data['data_transaksi'] = $dt_join;
		// $data['data_transaksi'] = array_chunk($data_transaksi, 18, true);

        $data['bulan_tahun'] = $blnTh;
     	// echo "<pre>"; print_r($data); exit;
     	$this->load->view('admin/laporan/laporan_langsung_pdf', $data);

     	$paper_size 	= 'A4';
		$orientation 	= 'landscape';
		$html 			= $this->output->get_output();
		$this->pdf->set_paper($paper_size, $orientation);

		$this->pdf->load_html($html);
		$this->pdf->render();
		$this->pdf->stream("Daftar_Transaksi_Langsung.pdf", array('Attachment' =>0)); 
    }

    //	cetak pdf laporan transaksi preorder
    public function cetak_preorder_pdf($blnTh)
    {
     	// $data_preorder   = $this->Model_laporan->get_transaksi_preorder($blnTh)->result_array();
		// $data['data_preorder'] = array_chunk($data_preorder, 18, true);

		$data_transaksi   = $this->Model_laporan->get_transaksi_preorder($blnTh)->result_array();
		foreach($data_transaksi as $dt_trans){
			$dt_join[] = [
				'tanggal' 	=> $dt_trans['tanggal_pesan'],
				'total_belanja' => $dt_trans['jumlah'],
				'detail' => $this->db->select('*')
								->from('detail_preorder')
								->join('produk', 'produk.id_produk = detail_preorder.id_produk')
								->where('detail_preorder.id_preorder', $dt_trans['id_preorder'])
								->get()->result_array()
			];
		}
		$data['data_transaksi'] = $dt_join;

        $data['bulan_tahun'] = $blnTh;
     	
     	$this->load->view('admin/laporan/laporan_preorder_pdf', $data);

     	$paper_size 	= 'A4';
		$orientation 	= 'landscape';
		$html 			= $this->output->get_output();
		$this->pdf->set_paper($paper_size, $orientation);

		$this->pdf->load_html($html);
		$this->pdf->render();
		$this->pdf->stream("Daftar_Transaksi_Preorder.pdf", array('Attachment' =>0)); 
    }

	//	cetak pdf laporan keuntungan
    public function cetak_keuntungan_pdf($filter)
    {
     	$data['data_transaksi']     = $this->Model_laporan->total_transaksi_langsung($filter)->result_array();
        $data['data_preorder']      = $this->Model_laporan->total_transaksi_preorder($filter)->result_array();
        $data['data_modal']         = $this->Model_laporan->total_pengeluaran_modal($filter);
        $data['data_gaji']          = $this->Model_laporan->total_pengeluaran_gaji($filter)->result_array();
        $data['bulan_tahun'] = $filter;
     	
		// echo "<pre>"; print_r($data); exit;
     	$this->load->view('admin/laporan/laporan_keuntungan_pdf', $data);

     	$paper_size 	= 'A4';
		$orientation 	= 'portrait';
		$html 			= $this->output->get_output();
		$this->pdf->set_paper($paper_size, $orientation);

		$this->pdf->load_html($html);
		$this->pdf->render();
		$this->pdf->stream("Daftar_Transaksi_Preorder.pdf", array('Attachment' =>0)); 
    }

}   