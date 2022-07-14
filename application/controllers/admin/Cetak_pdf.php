<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak_pdf extends CI_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('role') != 77) {
			redirect('admin/auth/login');
		}
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
	}

	//	cetak pdf laporan gaji
	public function cetak_gaji_pdf($blnTh)
    {
     	$this->load->library('dompdf_gen');

     	$data['data_karyawan'] = $this->Model_karyawan->get_data_karyawan()->result_array();
     	$data['gaji_karyawan'] = $this->Model_laporan->get_gaji_karyawan($blnTh)->result_array();
     	$data['bulan_tahun']   = $blnTh;
     	
     	$this->load->view('admin/laporan/laporan_gaji_pdf', $data);

     	$paper_size 	= 'A4';
		$orientation 	= 'portrait';
		$html 			= $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Gaji_Karyawan.pdf", array('Attachment' =>0)); 
    }

	//	cetak pdf laporan pengeluaran modal
    public function cetak_modal_pdf($blnTh)
    {
     	$this->load->library('dompdf_gen');

     	$data['data_modal'] 	= $this->Model_laporan->get_data_modal($blnTh)->result_array();
        $data['detail_modal'] 	= $this->Model_laporan->get_detail_modal()->result_array();
     	$data['bulan_tahun']   = $blnTh;
     	
     	$this->load->view('admin/laporan/laporan_modal_pdf', $data);

     	$paper_size 	= 'A4';
		$orientation 	= 'portrait';
		$html 			= $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Pengeluaran_Modal.pdf", array('Attachment' =>0)); 
    }

    //	cetak pdf laporan transaksi langsung & preorder
    public function cetak_semua_pdf($blnTh)
    {
     	$this->load->library('dompdf_gen');
		$data['bulan_tahun'] = $blnTh;
     	$transaksi  = $this->Model_laporan->get_transaksi_langsung($blnTh)->result_array();

        $prd   = $this->Model_laporan->get_transaksi_preorder($blnTh)->result_array();
		foreach($prd as $key => $val):
			if($val['metode'] == 'Offline'){$pembayaran = 'Tunai';}
			else{$pembayaran = 'Transfer';}
			$preorder[] = array(
				'id_preorder' 	=> $val['id_preorder'],
				'total_belanja' => $val['jumlah'],
				'metode'		=> $val['metode'],
				'pembayaran' 	=> $pembayaran,
				'status' 		=> $val['status'],
				'tanggal'		=> $val['tanggal_pesan'],
			);
		endforeach;

		$gabung = array_merge($transaksi, $preorder);
		$data['semua_transaksi'] = array_chunk($gabung, 18, true);
		
     	$this->load->view('admin/laporan/laporan_semua_pdf', $data);

     	$paper_size 	= 'A4';
		$orientation 	= 'portrait';
		$html 			= $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Semua_Daftar_Transaksi.pdf", array('Attachment' =>0)); 
    }

    //	cetak pdf laporan transaksi langsung
    public function cetak_langsung_pdf($blnTh)
    {
     	$this->load->library('dompdf_gen');

     	$data_transaksi   = $this->Model_laporan->get_transaksi_langsung($blnTh)->result_array();
		$data['data_transaksi'] = array_chunk($data_transaksi, 18, true);
        $data['bulan_tahun'] = $blnTh;
     	
     	$this->load->view('admin/laporan/laporan_langsung_pdf', $data);

     	$paper_size 	= 'A4';
		$orientation 	= 'portrait';
		$html 			= $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Daftar_Transaksi_Langsung.pdf", array('Attachment' =>0)); 
    }

    //	cetak pdf laporan transaksi preorder
    public function cetak_preorder_pdf($blnTh)
    {
     	$this->load->library('dompdf_gen');

     	$data_preorder   = $this->Model_laporan->get_transaksi_preorder($blnTh)->result_array();
		$data['data_preorder'] = array_chunk($data_preorder, 18, true);
        $data['bulan_tahun'] = $blnTh;
     	
     	$this->load->view('admin/laporan/laporan_preorder_pdf', $data);

     	$paper_size 	= 'A4';
		$orientation 	= 'portrait';
		$html 			= $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Daftar_Transaksi_Preorder.pdf", array('Attachment' =>0)); 
    }

	//	cetak pdf laporan keuntungan
    public function cetak_keuntungan_pdf($filter)
    {
     	$this->load->library('dompdf_gen');

     	$data['data_transaksi']     = $this->Model_laporan->total_transaksi_langsung($filter)->result_array();
        $data['data_preorder']      = $this->Model_laporan->total_transaksi_preorder($filter)->result_array();
        $data['data_modal']         = $this->Model_laporan->total_pengeluaran_modal($filter)->result_array();
        $data['data_gaji']          = $this->Model_laporan->total_pengeluaran_gaji($filter)->result_array();
        $data['bulan_tahun'] = $filter;
     	
     	$this->load->view('admin/laporan/laporan_keuntungan_pdf', $data);

     	$paper_size 	= 'A4';
		$orientation 	= 'portrait';
		$html 			= $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Daftar_Transaksi_Preorder.pdf", array('Attachment' =>0)); 
    }

}   