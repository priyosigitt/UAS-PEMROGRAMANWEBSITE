<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	///load model
	public function __construct(){
        parent::__construct();
        $this->load->model('kelola_order_model');
        $this->load->model('transaksi_model');
		///Proteksi halaman
        $this->simple_login->cek_login();
	}

	///Load data Transaksi
	public function index()
	{
        $kelola_order = $this->kelola_order_model->listing();
        $data = array(	'title'	        =>  'Data Transaksi',
                        'kelola_order'  => $kelola_order,
						'isi'	        =>	'admin/transaksi/list');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
    }
    
    ///Detail
    public function detail($kode_transaksi){

		$kelola_order = $this->kelola_order_model->kode_transaksi($kode_transaksi);
		$transaksi    = $this->transaksi_model->kode_transaksi($kode_transaksi);

		$data = array(  'title'     	=>  'Riwayat Belanja',
						'kelola_order'	=>	$kelola_order,
						'transaksi'		=>	$transaksi,
                        'isi'       	=>  'admin/transaksi/detail');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	///Cetak
	public function cetak($kode_transaksi){

		$kelola_order = $this->kelola_order_model->kode_transaksi($kode_transaksi);
		$transaksi    = $this->transaksi_model->kode_transaksi($kode_transaksi);

		$data = array(  'title'     	=>  'Riwayat Belanja',
						'kelola_order'	=>	$kelola_order,
						'transaksi'		=>	$transaksi);
        $this->load->view('admin/transaksi/cetak', $data, FALSE);
	}

	///Unduh PDF dengan MPDF
	public function pdf($kode_transaksi){

		$kelola_order = $this->kelola_order_model->kode_transaksi($kode_transaksi);
		$transaksi    = $this->transaksi_model->kode_transaksi($kode_transaksi);

		$data = array(  'title'     	=>  'Riwayat Belanja',
						'kelola_order'	=>	$kelola_order,
						'transaksi'		=>	$transaksi);
        ///$this->load->view('admin/transaksi/cetak', $data, FALSE);
		
		// Create an instance of the class:
		$html = $this->load->view('admin/transaksi/cetak', $data, TRUE);
		$mpdf = new \Mpdf\Mpdf();

		// Write some HTML code:
		$mpdf->WriteHTML($html);

		// Output a PDF file directly to the browser
		$mpdf->Output();
	}

}