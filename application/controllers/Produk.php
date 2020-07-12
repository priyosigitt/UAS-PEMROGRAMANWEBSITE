<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
    
    ///load databse
	public function __construct(){
		parent::__construct();
		$this->load->model('produk_model');
		$this->load->model('kategori_model');
	}

	///Listing data produk
	public function index(){
        ///Data Global
        $listing_kategori 	= $this->produk_model->listing_kategori();
        ///Ambil data total
        $total		= $this->produk_model->total_produk();
        ///Paginasi start
        $this->load->library('pagination');

        $config['base_url']         = base_url().'produk/index/';
        $config['total_rows']       = $total->total;
        $config['use_page_numbers'] = TRUE;
        $config['per_page']         = 6;
        $config['uri_segment']      = 3;
        $config['num_links']        = 10;
        $config['full_tag_open']    = '<ul class="pagination">';
        $config['full_tag_close']   = '</ul>';
        $config['first_link']       = 'First';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['last_link']        = 'Last';
        $config['last_tag_open']    = '<li class="disabled"><li class="active"><a href="#">';
        $config['last_tag_close']   = '<span class="sr-only"></a></li></li>';
        $config['next_link']        = '&gt;';
        $config['next_tag_open']    = '<div>';
        $config['next_tag_close']   = '</div>';
        $config['prev_link']        = '&lt;';
        $config['prev_tag_open']    = '<div>';
        $config['prev_tag_close']   = '</div>';
        $config['cur_tag_open']     = '<b>';
        $config['cur_tag_close']    = '</b>';
        $config['first_url']        = base_url().'/produk/';

        $this->pagination->initialize($config);
        ///Ambil data Produk
        $page   = ($this->uri->segment(3)) ? ($this->uri->segment(3)-1) * $config['per_page']:0;
        $produk = $this->produk_model->produk($config['per_page'],$page);
        ///Paginasi end

		$data = array(	'title'		        => 'Joom Store',
						'listing_kategori'	=> 	$listing_kategori,
						'produk'	        => 	$produk,
						'pagin'	            => 	$this->pagination->create_links(),
						'isi'		        =>	'produk/list');
		$this->load->view('layout/wrapper', $data, FALSE);
    }
    

    ///Detail
    public function detail($slug_produk){
        $produk         = $this->produk_model->read($slug_produk);
        $id_produk      = $produk->id_produk;
        $produk_related = $this->produk_model->home(); 

        $data = array(	'title'		        =>  $produk->nama_produk,
						'produk'	        => 	$produk,
						'produk_related'	=> 	$produk_related,
						'isi'		        =>	'produk/detail');
		$this->load->view('layout/wrapper', $data, FALSE);
    }

    ///Listing data kategori produk
	public function kategori($slug_kategori){

        ///kategori detail
        $kategori = $this->kategori_model->read($slug_kategori);
        $id_kategori = $kategori->id_kategori;
        
        ///Data Global
        $listing_kategori 	= $this->produk_model->listing_kategori();
        ///Ambil data total
        $total		= $this->produk_model->total_kategori($id_kategori);
        ///Paginasi start
        $this->load->library('pagination');

        $config['base_url']         = base_url().'produk/kategori/'.$slug_kategori.'/index/';
        $config['total_rows']       = $total->total;
        $config['use_page_numbers'] = TRUE;
        $config['per_page']         = 5;
        $config['uri_segment']      = 5;
        $config['num_links']        = 10;
        $config['full_tag_open']    = '<ul class="pagination">';
        $config['full_tag_close']   = '</ul>';
        $config['first_link']       = 'First';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['last_link']        = 'Last';
        $config['last_tag_open']    = '<li class="disabled"><li class="active"><a href="#">';
        $config['last_tag_close']   = '<span class="sr-only"></a></li></li>';
        $config['next_link']        = '&gt;';
        $config['next_tag_open']    = '<div>';
        $config['next_tag_close']   = '</div>';
        $config['prev_link']        = '&lt;';
        $config['prev_tag_open']    = '<div>';
        $config['prev_tag_close']   = '</div>';
        $config['cur_tag_open']     = '<b>';
        $config['cur_tag_close']    = '</b>';
        $config['first_url']        = base_url().'/produk/kategori/'.$slug_kategori;

        $this->pagination->initialize($config);
        ///Ambil data Produk
        $page   = ($this->uri->segment(5)) ? ($this->uri->segment(5)-1) * $config['per_page']:0;
        $produk = $this->produk_model->kategori($id_kategori, $config['per_page'], $page);
        ///Paginasi end

		$data = array(	'title'		        =>  $kategori->nama_kategori,
						'listing_kategori'	=> 	$listing_kategori,
						'produk'	        => 	$produk,
						'pagin'	            => 	$this->pagination->create_links(),
						'isi'		        =>	'produk/list');
		$this->load->view('layout/wrapper', $data, FALSE);
    }

    public function search(){
        $keyword = $this->input->post('keyword');
        $produk  = $this->produk_model->get_keyword($keyword);
        ///Data Global
        $listing_kategori 	= $this->produk_model->listing_kategori();

        
        $data = array(	'title'		        =>  'GhiNaj SHOP',
                        'produk'	        => 	$produk,
                        'listing_kategori'	=> 	$listing_kategori,
						'isi'		        =>	'produk/search');
        $this->load->view('layout/wrapper', $data, FALSE);
    }
}
