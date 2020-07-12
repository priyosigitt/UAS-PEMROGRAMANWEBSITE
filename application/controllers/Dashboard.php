<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    ///load model
	public function __construct(){
		parent::__construct();
		$this->load->model('pelanggan_model');
		$this->load->model('kelola_order_model');
		$this->load->model('transaksi_model');
		///Proteksi halaman dengan simple pelanggan => Check Login
        $this->simple_pelanggan->cek_login();
	}

	///Halaman Dashboard
	public function index(){
		///Ambil data login id_pelanggan
		$id_pelanggan = $this->session->userdata('id_pelanggan');
		$kelola_order = $this->kelola_order_model->pelanggan($id_pelanggan);

		$data = array(  'title'     	=> 'Halaman Dashboar Pelanggan',
						'kelola_order'	=>	$kelola_order,
                        'isi'      		=>  'dashboard/list');
        $this->load->view('layout/wrapper', $data, FALSE);
	}
	
	///Belanja
	public function belanja(){
		///Ambil data login id_pelanggan
		$id_pelanggan = $this->session->userdata('id_pelanggan');
		$kelola_order = $this->kelola_order_model->pelanggan($id_pelanggan);

		$data = array(  'title'     	=>  'Riwayat Belanja',
						'kelola_order'	=>	$kelola_order,
                        'isi'       	=>  'dashboard/belanja');
        $this->load->view('layout/wrapper', $data, FALSE);
	}

	///Detail
	public function detail($kode_transaksi){
		///Ambil data login id_pelanggan
		$id_pelanggan = $this->session->userdata('id_pelanggan');
		$kelola_order = $this->kelola_order_model->kode_transaksi($kode_transaksi);
		$transaksi    = $this->transaksi_model->kode_transaksi($kode_transaksi);

		///Pastikan bahwa pelanggan hanya mengakses data transaksinya
		if($kelola_order->id_pelanggan != $id_pelanggan){
			$this->session->set_flashdata('warning', 'Anda mencoba mengakses data traksaksi orang lain');
			redirect(base_url('masuk'));
		}

		$data = array(  'title'     	=>  'Riwayat Belanja',
						'kelola_order'	=>	$kelola_order,
						'transaksi'		=>	$transaksi,
                        'isi'       	=>  'dashboard/detail');
        $this->load->view('layout/wrapper', $data, FALSE);
	}

	///Profil
	public function profil(){
		///Ambil data login id_pelanggan
		$id_pelanggan 	= $this->session->userdata('id_pelanggan');
		$pelanggan 		= $this->pelanggan_model->detail($id_pelanggan);

		///Validasi Input
		$valid = $this->form_validation;

		$valid->set_rules('nama_pelanggan','Nama Lengkap', 'required',
		array( 'required'    => '%s harus diisi'));
		
		$valid->set_rules('telepon','Nomot Telepon', 'required',
		array( 'required'    => '%s harus diisi'));
		
		$valid->set_rules('alamat','Alamat Lengkap', 'required',
		array( 'required'    => '%s harus diisi'));


		if($valid->run()===FALSE){
			///End Validasi
			$data = array(  'title'     	=>  'Profil Saya',
							'pelanggan'		=>	$pelanggan,
							'isi'       	=>  'dashboard/profil');
			$this->load->view('layout/wrapper', $data, FALSE);
		///Masuk Database
		}else{
			$i = $this->input;
			
			///Kalau password sama dengan 6 atau lebih karakter, maka password ganti
			if(strlen($i->post('password')) >= 6){
				$data = array(  'id_pelanggan'  	=> $id_pelanggan,
								'nama_pelanggan'    => $i->post('nama_pelanggan'),
								'password'          => SHA1($i->post('password')),
								'telepon'           => $i->post('telepon'),
								'alamat'            => $i->post('alamat')
				);
			}else{
				///Jika password kurang dari 6 maka password tidak ganti
				$data = array(  'id_pelanggan'  	=> $id_pelanggan,
								'nama_pelanggan'    => $i->post('nama_pelanggan'),
								'telepon'           => $i->post('telepon'),
								'alamat'            => $i->post('alamat')
				);
			}
			///End data Update
			$this->pelanggan_model->edit($data);
			$this->session->set_flashdata('sukses', 'Update Profil berhasil');
			redirect(base_url('dashboard/profil'),'refresh');
		}
		///End masuk Database
	}

	///Konfirmasi Pembayaran
	public function konfirmasi($kode_transaksi){
		$kelola_order = $this->kelola_order_model->kode_transaksi($kode_transaksi);
		
		///Validasi Input
        $valid      = $this->form_validation;

        $valid->set_rules('tanggal_bayar','Tanggal Pembayaran', 'required',
            array(  'required'      => '%s harus diisi'));
		
		$valid->set_rules('jumlah_bayar','Jumlah Pembayaran', 'required',
            array(  'required'      => '%s harus diisi'));
        
        if($valid->run()){
            ///Check jika gambar diganti
            if(!empty($_FILES['bukti_bayar']['name'])){

                $config['upload_path']      = './assets/upload/image/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
                $config['max_size']         = '2400';///Dalam KB
                $config['max_width']        = '2024';
                $config['max_heigth']       = '2024';

                $this->load->library('upload', $config);

                if( ! $this->upload->do_upload('bukti_bayar')){
                    
                    ///End Validasi
					$data = array(	'title'			=> 	'Konfirmasi Pembayaran',
									'kelola_order'	=>	$kelola_order,
									'error'	    	=>  $this->upload->display_errors(),
									'isi'			=>	'dashboard/konfirmasi');
					$this->load->view('layout/wrapper', $data, FALSE);
				///Masuk Database
				}else{
					$upload_gambar = array('upload_data' => $this->upload->data());
					
					///CREATE thumbnail gambar
					$config['image_library']    = 'gd2';
					$config['source_image']     = './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
					///Lokasi folde thumbnail
					$config['new_image']        = './assets/upload/image/thumbs/';
					$config['create_thumb']     = TRUE;
					$config['maintain_ratio']   = TRUE;
					$config['width']            = 250;///Pixel
					$config['height']           = 250;///Pixel
					$config['thumb_marker']     = '';

					$this->load->library('image_lib', $config);

					$this->image_lib->resize();
					///end Create thumbnail

					$i = $this->input;
					
					$data = array(  'id_kelola_order'       => $kelola_order->id_kelola_order,
									'status_bayar'          => 'Konfirmasi',
									'jumlah_bayar'          => $i->post('jumlah_bayar'),
									'tanggal_bayar'         => $i->post('tanggal_bayar'),
									///Yg disimpan nama file gambar
									'bukti_bayar'           => $upload_gambar['upload_data']['file_name']
					);
					$this->kelola_order_model->edit($data);
					$this->session->set_flashdata('sukses', 'Konfirmasi Pembayaran berhasil');
					redirect(base_url('dashboard'),'refresh');
				}
			}else{
				///Edit produk tanpa ganti gambar
				$i = $this->input;
				
				$data = array(  'id_kelola_order'       => $kelola_order->id_kelola_order,
								'status_bayar'          => 'Konfirmasi',
								'jumlah_bayar'          => $i->post('jumlah_bayar'),
								'tanggal_bayar'         => $i->post('tanggal_bayar'),
								///Yg disimpan nama file gambar
								///'bukti_bayar'           => $upload_gambar['upload_data']['file_name']
				);
				$this->kelola_order_model->edit($data);
				$this->session->set_flashdata('sukses', 'Konfirmasi Pembayaran berhasil');
				redirect(base_url('dashboard'),'refresh');
			}
		}
		///End masuk Database
		$data = array(	'title'			=> 	'Konfirmasi Pembayaran',
						'kelola_order'	=>	$kelola_order,
						'isi'			=>	'dashboard/konfirmasi');
		$this->load->view('layout/wrapper', $data, FALSE);
	}
}