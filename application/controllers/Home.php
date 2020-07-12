<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    ///load model
	public function __construct(){
		parent::__construct();
		$this->load->model('produk_model');
		$this->load->model('kategori_model');
	}

	///Halaman Utama Web
	public function index()
	{
		$kategori 	= $this->produk_model->nav_produk();
		$produk		= $this->produk_model->home();


		$data = array(	'title'		=> 'GhiNaj SHOP',
						'kategori'	=> 	$kategori,
						'produk'	=> 	$produk,
						'isi'		=>	'home/list');
		$this->load->view('layout/wrapper', $data, FALSE);
	}
}
