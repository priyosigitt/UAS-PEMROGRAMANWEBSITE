<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Belanja extends CI_Controller {
    
    ///load model
	public function __construct(){
		parent::__construct();
		$this->load->model('produk_model');
		$this->load->model('kategori_model');
        $this->load->model('pelanggan_model');
        $this->load->model('kelola_order_model');
        $this->load->model('transaksi_model');
        ///load helper random_string CI
        $this->load->helper('string');
	}

	///Halaman Belanja
	public function index()
	{
		$keranjang 	= $this->cart->contents();

		$data = array(	'title'		=> 'Keranjang Belanja',
						'keranjang'	=> 	$keranjang,
						'isi'		=>	'belanja/list');
		$this->load->view('layout/wrapper', $data, FALSE);
    }

    ///Halaman Belanja Sukses
	public function sukses()
	{
		$data = array(	'title'		=> 'Belanja Berhasil',
						'isi'		=>	'belanja/sukses');
		$this->load->view('layout/wrapper', $data, FALSE);
    }
    
    //Tambahkan ke keranjang belanja
    public function add(){
        ///Ambil data dari home
        $id             = $this->input->post('id');
        $qty            = $this->input->post('qty');
        $price          = $this->input->post('price');
        $name           = $this->input->post('name');
        $redirect_page  = $this->input->post('redirect_page');
        ///Proses masukkan ke keranjang belanja
        $data = array(  'id'        =>  $id,
                        'qty'       =>  $qty, 
                        'price'     =>  $price, 
                        'name'      =>  $name);
        $this->cart->insert($data); 
        ///redirect page
        redirect($redirect_page,'refresh');
    }


    ///Hapus semua isi keranjang belanja
    public function hapus($rowid){

        if($rowid){
            ///Hapus per item
            $this->cart->remove($rowid);
            $this->session->set_flashdata('sukses', 'Data keranjang belanja telah dihapus');
            redirect(base_url('belanja'),'refresh');
        }
        else{
            ///Hapus All
            $this->cart->destroy();
            $this->session->set_flashdata('sukses', 'Data keranjang belanja telah dihapus');
            redirect(base_url('belanja'),'refresh');
        }
    }

    ///Update Cart
    public function update_cart($rowid){
        
        if($rowid){
            ///jika ada data rowid
            $data = array(  'rowid'     =>   $rowid,
                            'qty'       =>   $this->input->post('qty')
                        );
            $this->cart->update($data);
            $this->session->set_flashdata('session', 'Data Keranjang telah diupdate');
            redirect(base_url('belanja'),'refresh');
        }else{
            ///jika tidak ada rowid
            redirect(base_url('belanja'),'refresh');
        }
    }

    ///Checkout
    public function checkout(){
        ///check pelanggan sudah login atau belum
        ///jika belum makan harus registrasi terlebih dahulu, dan juga sekaligus login

        ///kondisi sudah login
        if($this->session->userdata('email')){
            $email = $this->session->userdata('email');
            $nama_pelanggan = $this->session->userdata('nama_pelanggan');
            $pelanggan = $this->pelanggan_model->sudah_login($email,$nama_pelanggan);

            $keranjang 	= $this->cart->contents();

            ///Validasi Input
            $valid = $this->form_validation;

            $valid->set_rules('nama_pelanggan','Nama Lengkap', 'required',
            array( 'required'    => '%s harus diisi'));
            
            $valid->set_rules('email','Email', 'required|valid_email',
            array( 'required'      =>  '%s harus diisi',
                    'valid_email'   =>  '%s tidak valid'));
            
            $valid->set_rules('telepon','Nomor Telepon', 'required',
            array( 'required'    => '%s harus diisi'));

            $valid->set_rules('alamat','Alamat', 'required',
            array( 'required'    => '%s harus diisi'));
    
            if($valid->run()===FALSE){
            ///End Validasi

                $data = array(	'title'		=> 'Checkout',
                                'keranjang'	=> 	$keranjang,
                                'pelanggan'	=> 	$pelanggan,
                                'isi'		=>	'belanja/checkout');
                $this->load->view('layout/wrapper', $data, FALSE);
            
            ///Masuk Database
            }else{
                $i = $this->input;
                $data = array(  'id_pelanggan'      => $pelanggan->id_pelanggan,
                                'nama_pelanggan'    => $i->post('nama_pelanggan'),
                                'email'             => $i->post('email'),
                                'telepon'           => $i->post('telepon'),
                                'alamat'            => $i->post('alamat'),
                                'kode_transaksi'    => $i->post('kode_transaksi'),
                                'tanggal_transaksi' => $i->post('tanggal_transaksi'),
                                'jumlah_transaksi'  => $i->post('jumlah_transaksi'),
                                'status_bayar'      => 'Belum',
                                'tanggal_post'      => date('Y-m-d H:i:s')
                );
                ///Masuk ke Kelola order
                $this->kelola_order_model->tambah($data);

                ///Proses masuk ke tabel transaksi
                foreach($keranjang as $keranjang) { 
                    $sub_total = $keranjang['price'] * $keranjang['qty'];
                    $data = array(  'id_pelanggan'      =>  $pelanggan->id_pelanggan,
                                    'kode_transaksi'    =>  $i->post('kode_transaksi'),
                                    'id_produk'         =>  $keranjang['id'],
                                    'harga'             =>  $keranjang['price'],
                                    'jumlah'            =>  $keranjang['qty'],
                                    'total_harga'       =>  $sub_total,
                                    'tanggal_transaksi' =>  $i->post('tanggal_transaksi')
                                );
                    $this->transaksi_model->tambah($data);
                }
                ///End proses masuk ke tabel transaksi
                
                ///Setelah masuk ke tabel Transaksi maka Keranjang akan dikosongkan lagi
                $this->cart->destroy();

                ///End Pengosongan Keranjang
                $this->session->set_flashdata('sukses', 'Check Out berhasil');
                redirect(base_url('belanja/sukses'),'refresh');
            }
            ///End masuk Database

        }else{
            ///kalau belum, maka registrasi
            $this->session->set_flashdata('sukses', 'Silahkan login atau registrasi terlebih dahulu');
            redirect(base_url('registrasi'),'refresh');
        }
    }
   

}
