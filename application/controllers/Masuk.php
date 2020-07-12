<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masuk extends CI_Controller {
    
    ///load model
	public function __construct(){
		parent::__construct();
		$this->load->model('pelanggan_model');
	}

	///Login Pelanggan
	public function index(){
        ///Validation
		$this->form_validation->set_rules('email','Email/Username', 'required',
        array('required' => '%s harus diisi'));
    
        $this->form_validation->set_rules('password','Password', 'required',
            array('required' => '%s harus diisi'));

        if($this->form_validation->run()){
            $email  	= $this->input->post('email');
            $password	= $this->input->post('password');
            ///proses ke simple pelanggan
            $this->simple_pelanggan->login($email,$password);
        }

    ///End Validasi
		$data = array(	'title'		=> 'Login Pelanggan',
						'isi'		=>	'masuk/list');
		$this->load->view('layout/wrapper', $data, FALSE);
    }
    
    ///Logout
    public function logout(){
        ///ambil fungsi logout di simple_pelanggan yang sudah diset pada autoload libraries
        $this->simple_pelanggan->logout();
    }
}
