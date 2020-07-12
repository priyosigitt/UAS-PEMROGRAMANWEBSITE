<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_order_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    ///Listing all kelola order
    public function listing(){
        $this->db->select(  'tb_kelola_order.*,
                            tb_pelanggan.nama_pelanggan,
                            SUM(tb_transaksi.jumlah) AS total_item');
        $this->db->from('tb_kelola_order');
        ///JOIN
        $this->db->join('tb_transaksi', 'tb_transaksi.kode_transaksi = tb_kelola_order.kode_transaksi', 'left');
        $this->db->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_kelola_order.id_pelanggan', 'left');
        ///End JOIN
        $this->db->group_by('tb_kelola_order.id_kelola_order');
        $this->db->order_by('id_kelola_order', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    ///Detail kelola_order
    public function detail($id_kelola_order){
        $this->db->select('*');
        $this->db->from('tb_kelola_order');
        $this->db->where('id_kelola_order', $id_kelola_order);
        $this->db->order_by('id_kelola_order', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    ///Tambah
    public function tambah($data){
        $this->db->insert('tb_kelola_order', $data);
    }

    ///Edit
    public function edit($data){
        $this->db->where('id_kelola_order', $data['id_kelola_order']);
        $this->db->update('tb_kelola_order', $data);
    }

    ///Delete
    public function delete($data){
        $this->db->where('id_kelola_order', $data['id_kelola_order']);
        $this->db->delete('tb_kelola_order', $data);
    }

   ///Listing all kelola order dari pelanggan
   public function pelanggan($id_pelanggan){
        $this->db->select('tb_kelola_order.*,
                            SUM(tb_transaksi.jumlah) AS total_item');
        $this->db->from('tb_kelola_order');
        $this->db->where('tb_kelola_order.id_pelanggan', $id_pelanggan);
        ///JOIN
        $this->db->join('tb_transaksi', 'tb_transaksi.kode_transaksi = tb_kelola_order.kode_transaksi', 'left');
        ///End JOIN
        $this->db->group_by('tb_kelola_order.id_kelola_order');
        $this->db->order_by('id_kelola_order', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    ///Detail kelola_order
    public function kode_transaksi($kode_transaksi){
        $this->db->select(  'tb_kelola_order.*,
                            tb_pelanggan.nama_pelanggan,
                            SUM(tb_transaksi.jumlah) AS total_item');
        $this->db->from('tb_kelola_order');
        ///JOIN
        $this->db->join('tb_transaksi', 'tb_transaksi.kode_transaksi = tb_kelola_order.kode_transaksi', 'left');
        $this->db->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_kelola_order.id_pelanggan', 'left');
        ///End JOIN
        $this->db->group_by('tb_kelola_order.id_kelola_order');
        $this->db->where('tb_transaksi.kode_transaksi', $kode_transaksi);
        $this->db->order_by('id_kelola_order', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
}