<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    ///Listing all USER
    public function listing(){
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    ///Detail transaksi
    public function detail($id_transaksi){
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    ///Detail slug transaksi
    public function read($slug_transaksi){
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('slug_transaksi', $slug_transaksi);
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    ///Tambah
    public function tambah($data){
        $this->db->insert('tb_transaksi', $data);
    }

    ///Edit
    public function edit($data){
        $this->db->where('id_transaksi', $data['id_transaksi']);
        $this->db->update('tb_transaksi', $data);
    }

    ///Delete
    public function delete($data){
        $this->db->where('id_transaksi', $data['id_transaksi']);
        $this->db->delete('tb_transaksi', $data);
    }

    ///Login transaksi
    public function login($username,$password){
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where(array( 'username'  => $username,
                                'password'  => SHA1($password)));
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    ///Listing all USER berdasarkan kelola order
    public function kode_transaksi($kode_transaksi){
        $this->db->select(  'tb_transaksi.*,
                            tb_produk.nama_produk,
                            tb_produk.kode_produk');
        $this->db->from('tb_transaksi');
        ///JOIN  transaksi dng produk
        $this->db->join('tb_produk', 'tb_produk.id_produk = tb_transaksi.id_produk', 'left');
        ///End JOIB
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
}