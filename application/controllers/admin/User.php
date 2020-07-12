<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    ///Load MODEL
    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        ///Proteksi halaman
        $this->simple_login->cek_login();
    }

    ///Data User
	public function index(){
        $user = $this->user_model->listing();
        $data = array(	'title'	=>  'Data Pengguna',
                        'user'  =>  $user,
						'isi'	=>	'admin/user/list');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
    }
    
    ///Tambah User
	public function tambah(){
        ///Validasi Input
        $valid = $this->form_validation;

        $valid->set_rules('nama_user','Nama Lengkap', 'required',
        array( 'required'    => '%s harus diisi'));
        
        $valid->set_rules('email','Email', 'required|valid_email',
        array( 'required'       =>  '%s harus diisi',
                'valid_email'   =>  '%s tidak valid'));

        $valid->set_rules('username','Username', 'required|min_length[6]|max_length[32]|is_unique[tb_user.username]',
        array( 'required'       => '%s harus diisi',
                'min_length'    => '%s minimal 6 karakter',
                'max_length'    => '%s maksimal 32 karakter',
                'is_unique'     => '%s sudah ada, Buat Username baru.'));

        $valid->set_rules('password','Password', 'required',
        array( 'required'    => '%s harus diisi'));

        if($valid->run()===FALSE){
        ///End Validasi
            $data = array(	'title'	=>  'Tambah Pengguna',
                            'isi'	=>	'admin/user/tambah');
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        ///Masuk Database
        }else{
            $i = $this->input;
            $data = array(  'nama_user'     => $i->post('nama_user'),
                            'email'         => $i->post('email'),
                            'username'      => $i->post('username'),
                            'password'      => SHA1($i->post('password')),
                            'akses_level'   => $i->post('akses_level'),
            );
            $this->user_model->tambah($data);
            $this->session->set_flashdata('sukses');
            redirect(base_url('admin/user'),'refresh');
        }
        ///End masuk Database
    }

    ///edit User
	public function edit($id_user){
        $user = $this->user_model->detail($id_user);

        ///Validasi Input
        $valid = $this->form_validation;

        $valid->set_rules('nama_user','Nama Lengkap', 'required',
        array( 'required'    => '%s harus diisi'));
        
        $valid->set_rules('email','Email', 'required|valid_email',
        array( 'required'       =>  '%s harus diisi',
                'valid_email'   =>  '%s tidak valid'));

        $valid->set_rules('password','Password', 'required',
        array( 'required'    => '%s harus diisi'));

        if($valid->run()===FALSE){
        ///End Validasi
            $data = array(	'title'	=>  'Tambah Pengguna',
                            'user'  =>  $user,
                            'isi'	=>	'admin/user/edit');
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        ///Masuk Database
        }else{
            $i = $this->input;
            $data = array(  'id_user'       =>$id_user,
                            'nama_user'     => $i->post('nama_user'),
                            'email'         => $i->post('email'),
                            'username'      => $i->post('username'),
                            'password'      => SHA1($i->post('password')),
                            'akses_level'   => $i->post('akses_level'),
            );
            $this->user_model->edit($data);
            $this->session->set_flashdata('sukses');
            redirect(base_url('admin/user'),'refresh');
        }
        ///End masuk Database
    }
    
    ///Delete User
    public function delete($id_user){
        $data = array('id_user' => $id_user);
        $this->user_model->delete($data);
        $this->session->set_flashdata('sukses', 'Data telah dihapus');
        redirect(base_url('admin/user'),'refresh');
    }
}
