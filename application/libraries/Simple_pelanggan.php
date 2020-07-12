<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simple_pelanggan {

    protected $CI;

    public function __construct(){
        $this->CI =& get_instance();
        ///Load data model pelanggan
        $this->CI->load->model('pelanggan_model');
    }

    ///Funsi login
    public function login($email,$password){
        $check = $this->CI->pelanggan_model->login($email,$password);
        ///Jika ada data pelanggan, maka create session login
        if($check){
            $id_pelanggan    = $check->id_pelanggan;
            $nama_pelanggan  = $check->nama_pelanggan;
            ///Create session
            $this->CI->session->set_userdata('id_pelanggan',$id_pelanggan);
            $this->CI->session->set_userdata('nama_pelanggan',$nama_pelanggan);
            $this->CI->session->set_userdata('email',$email);
            ///redirect ke halaman admin yg di proteksi
            redirect(base_url('dashboard'),'refresh');
        }else{
            ///Kalau tidak ada (username password salah) maka harus login lagi
            $this->CI->session->set_flashdata('warning', 'Username atau Password salah');
            redirect(base_url('masuk'),'refresh');
        }
    }

    ///Fungsi cek login
    public function cek_login(){
        ///Memeriksa apakah session sudah ada atau belum, jika belum alihkan ke halaman login
        if($this->CI->session->userdata('email') == ""){
            $this->CI->session->set_flashdata('warning', 'Anda belum login');
            redirect(base_url('masuk'),'refresh');
        }
    }

    ///Fungsi logout
    public function logout(){
        ///Membuat semua session yg telah di set pada saat login
        $this->CI->session->unset_userdata('id_pelanggan');
        $this->CI->session->unset_userdata('nama_pelanggan');
        $this->CI->session->unset_userdata('email');
        ///Setelah session diunset, maka redirect ke login
        $this->CI->session->set_flashdata('sukses', 'Anda berhasil logout');
        redirect(base_url('masuk'),'refresh');
    }
}
