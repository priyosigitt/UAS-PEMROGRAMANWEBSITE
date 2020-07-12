<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    ///Load MODEL
    public function __construct(){
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('kategori_model');
        ///Proteksi halaman
        $this->simple_login->cek_login();
    }

    ///Data Produk
	public function index(){
        $produk = $this->produk_model->listing();
        $data = array(	'title'	    =>  'Data Produk',
                        'produk'    =>  $produk,
						'isi'	    =>	'admin/produk/list');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
    }
    
    ///Tambah Produk
	public function tambah(){
        ///Ambil data Kategori
        $kategori = $this->kategori_model->listing();

        ///Validasi Input
        $valid = $this->form_validation;

        $valid->set_rules('nama_produk','Nama Produk', 'required',
            array(  'required'    => '%s harus diisi'));

        $valid->set_rules('kode_produk','Kode Produk', 'required|is_unique[tb_produk.kode_produk]',
            array(  'required'      => '%s harus diisi',
                    'is_unique'     => '%s sudah ada. Buat kode Produk baru'));

        
        if($valid->run()){
            $config['upload_path']      = './assets/upload/image/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = '2400';///Dalam KB
            $config['max_width']        = '2024';
            $config['max_heigth']       = '2024';

            $this->load->library('upload', $config);

            if( ! $this->upload->do_upload('gambar')){
                   
                ///End Validasi
                $data = array(	'title'	    =>  'Tambah Produk',
                                'kategori'	=>  $kategori,
                                'error'	    =>  $this->upload->display_errors(),
                                'isi'	    =>	'admin/produk/tambah');
                $this->load->view('admin/layout/wrapper', $data, FALSE);

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
                ///SLUG PODUK
                $slug_poduk = url_title($this->input->post('nama_produk').'-'.$this->input->post('kode_produk'), 'dash', TRUE);

                $data = array(  'id_user'               => $this->session->userdata('id_user'),
                                'id_kategori'           => $i->post('id_kategori'),
                                'kode_produk'           => $i->post('kode_produk'),
                                'nama_produk'           => $i->post('nama_produk'),
                                'slug_produk'           => $slug_poduk,
                                'keywords'              => $i->post('keywords'),
                                'ukuran'                => $i->post('ukuran'),
                                'warna'                => $i->post('warna'),
                                'harga'                 => $i->post('harga'),
                                'stok'                  => $i->post('stok'),
                                ///Yg disimpan nama file gambar
                                'gambar'                => $upload_gambar['upload_data']['file_name'],
                                'keterangan_produk'     => $i->post('keterangan_produk'),
                                'status_produk'         => $i->post('status_produk'),
                                'tanggal_post'          => date('Y-m-d H:i:s')
                );
                $this->produk_model->tambah($data);
                $this->session->set_flashdata('sukses');
                redirect(base_url('admin/produk'),'refresh');
            }
        }
        ///End masuk Database
        $data = array(	'title'	    =>  'Tambah Produk',
                        'kategori'	=>  $kategori,
                        'isi'	    =>	'admin/produk/tambah');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    ///edit Produk
	public function edit($id_produk){
        ///Ambil data produk yang akan diedit
        $produk     = $this->produk_model->detail($id_produk);
        
        ///Ambil data Kategori
        $kategori   = $this->kategori_model->listing();

        ///Validasi Input
        $valid      = $this->form_validation;

        $valid->set_rules('nama_produk','Nama Produk', 'required',
            array(  'required'      => '%s harus diisi'));

        $valid->set_rules('kode_produk','Kode Produk', 'required',
            array(  'required'      => '%s harus diisi'));

        
        if($valid->run()){
            ///Check jika gambar diganti
            if(!empty($_FILES['gambar']['name'])){

                $config['upload_path']      = './assets/upload/image/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
                $config['max_size']         = '2400';///Dalam KB
                $config['max_width']        = '2024';
                $config['max_heigth']       = '2024';

                $this->load->library('upload', $config);

                if( ! $this->upload->do_upload('gambar')){
                    
                    ///End Validasi
                    $data = array(	'title'	    =>  'Edit Produk: '.$produk->nama_produk,
                                    'kategori'	=>  $kategori,
                                    'produk'	=>  $produk,
                                    'error'	    =>  $this->upload->display_errors(),
                                    'isi'	    =>	'admin/produk/edit');
                    $this->load->view('admin/layout/wrapper', $data, FALSE);

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
                    ///SLUG PODUK
                    $slug_poduk = url_title($this->input->post('nama_produk').'-'.$this->input->post('kode_produk'), 'dash', TRUE);

                    $data = array(  'id_produk'             => $id_produk,
                                    'id_user'               => $this->session->userdata('id_user'),
                                    'id_kategori'           => $i->post('id_kategori'),
                                    'kode_produk'           => $i->post('kode_produk'),
                                    'nama_produk'           => $i->post('nama_produk'),
                                    'slug_produk'           => $slug_poduk,
                                    'keywords'              => $i->post('keywords'),
                                    'ukuran'                => $i->post('ukuran'),
                                    'warna'                => $i->post('warna'),
                                    'harga'                 => $i->post('harga'),
                                    'stok'                  => $i->post('stok'),
                                    ///Yg disimpan nama file gambar
                                    'gambar'                => $upload_gambar['upload_data']['file_name'],
                                    'keterangan_produk'     => $i->post('keterangan_produk'),
                                    'status_produk'         => $i->post('status_produk')
                    );
                    $this->produk_model->edit($data);
                    $this->session->set_flashdata('sukses');
                    redirect(base_url('admin/produk'),'refresh');
                }
            }else{
                ///Edit produk tanpa ganti gambar
                $i = $this->input;
                ///SLUG PODUK
                $slug_poduk = url_title($this->input->post('nama_produk').'-'.$this->input->post('kode_produk'), 'dash', TRUE);

                $data = array(  'id_produk'             => $id_produk,
                                'id_user'               => $this->session->userdata('id_user'),
                                'id_kategori'           => $i->post('id_kategori'),
                                'kode_produk'           => $i->post('kode_produk'),
                                'nama_produk'           => $i->post('nama_produk'),
                                'slug_produk'           => $slug_poduk,
                                'keywords'              => $i->post('keywords'),
                                'ukuran'                => $i->post('ukuran'),
                                'warna'                => $i->post('warna'),
                                'harga'                 => $i->post('harga'),
                                'stok'                  => $i->post('stok'),
                                ///Yg disimpan nama file gambar (tidak diganti)
                                ///'gambar'                => $upload_gambar['upload_data']['file_name'],
                                'keterangan_produk'     => $i->post('keterangan_produk'),
                                'status_produk'         => $i->post('status_produk')
                );
                $this->produk_model->edit($data);
                $this->session->set_flashdata('sukses');
                redirect(base_url('admin/produk'),'refresh');
            }
        }
        ///End masuk Database
        $data = array(	'title'	    =>  'Edit Produk: '.$produk->nama_produk,
                        'kategori'	=>  $kategori,
                        'produk'	=>  $produk,
                        'isi'	    =>	'admin/produk/edit');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
    
    ///Delete Produk
    public function delete($id_produk){
        ///Proses hapus gambar
        $produk = $this->produk_model->detail($id_produk);
        unlink('./assets/upload/image/'.$produk->gambar);
        unlink('./assets/upload/image/thumbs/'.$produk->gambar);

        ///End Proses Hapus
        $data = array('id_produk' => $id_produk);
        $this->produk_model->delete($data);
        $this->session->set_flashdata('sukses', 'Data telah dihapus');
        redirect(base_url('admin/produk'),'refresh');
    }
}
