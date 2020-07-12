<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    ///Listing all Produk
    public function listing(){
        $this->db->select(' tb_produk.*,
                            tb_user.nama_user,
                            tb_kategori.nama_kategori,
                            tb_kategori.slug_kategori');
        $this->db->from('tb_produk');
        ///JOIN
        $this->db->join('tb_user','tb_user.id_user = tb_produk.id_user', 'left');
        $this->db->join('tb_kategori','tb_kategori.id_kategori = tb_produk.id_kategori', 'left');

        ///END JOIN
        $this->db->group_by('tb_produk.id_produk');
        $this->db->order_by('id_produk', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    ///Detail Produk
    public function detail($id_produk){
        $this->db->select('*');
        $this->db->from('tb_produk');
        $this->db->where('id_produk', $id_produk);
        $this->db->order_by('id_produk', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    ///Tambah
    public function tambah($data){
        $this->db->insert('tb_produk', $data);
    }

    ///Edit
    public function edit($data){
        $this->db->where('id_produk', $data['id_produk']);
        $this->db->update('tb_produk', $data);
    }

    ///Delete
    public function delete($data){
        $this->db->where('id_produk', $data['id_produk']);
        $this->db->delete('tb_produk', $data);
    }

    ///Login Produk
    public function login($username,$password){
        $this->db->select('*');
        $this->db->from('tb_produk');
        $this->db->where(array( 'username'  => $username,
                                'password'  => SHA1($password)));
        $this->db->order_by('id_produk', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    ///Load menu kategori produk
    public function nav_produk(){
        $this->db->select(' tb_produk.*,
                            tb_kategori.nama_kategori,
                            tb_kategori.slug_kategori');
        $this->db->from('tb_produk');
        ///JOIN
        $this->db->join('tb_kategori','tb_kategori.id_kategori = tb_produk.id_kategori', 'left');

        ///END JOIN
        $this->db->group_by('tb_produk.id_kategori');
        $this->db->order_by('tb_kategori.urutan', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    ///Listing all Produk Home
    public function home(){
        $this->db->select(' tb_produk.*,
                            tb_user.nama_user,
                            tb_kategori.nama_kategori,
                            tb_kategori.slug_kategori');
        $this->db->from('tb_produk');
        ///JOIN
        $this->db->join('tb_user','tb_user.id_user = tb_produk.id_user', 'left');
        $this->db->join('tb_kategori','tb_kategori.id_kategori = tb_produk.id_kategori', 'left');

        ///END JOIN
        $this->db->where('tb_produk.status_produk', 'Publish');
        $this->db->group_by('tb_produk.id_produk');
        $this->db->order_by('id_produk', 'desc');
        $this->db->limit(12);
        $query = $this->db->get();
        return $query->result();
    }

    ///Listing kategori
    public function listing_kategori(){
        $this->db->select(' tb_produk.*,
                            tb_user.nama_user,
                            tb_kategori.nama_kategori,
                            tb_kategori.slug_kategori');
        $this->db->from('tb_produk');
        ///JOIN
        $this->db->join('tb_user','tb_user.id_user = tb_produk.id_user', 'left');
        $this->db->join('tb_kategori','tb_kategori.id_kategori = tb_produk.id_kategori', 'left');

        ///END JOIN
        $this->db->group_by('tb_produk.id_kategori');
        $this->db->order_by('id_produk', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    ///Produk 
    public function produk($limit,$start){
        $this->db->select(' tb_produk.*,
                            tb_user.nama_user,
                            tb_kategori.nama_kategori,
                            tb_kategori.slug_kategori');
        $this->db->from('tb_produk');
        ///JOIN
        $this->db->join('tb_user','tb_user.id_user = tb_produk.id_user', 'left');
        $this->db->join('tb_kategori','tb_kategori.id_kategori = tb_produk.id_kategori', 'left');

        ///END JOIN
        $this->db->where('tb_produk.status_produk', 'Publish');
        $this->db->group_by('tb_produk.id_produk');
        $this->db->order_by('id_produk', 'desc');
        $this->db->limit($limit,$start);
        $query = $this->db->get();
        return $query->result();
    }

    ///Total produk
    public function total_produk(){
        $this->db->select('COUNT(*) AS total');
        $this->db->from('tb_produk');
        $this->db->where('status_produk', 'Publish');
        $query = $this->db->get();
        return $query->row();
    }

    ///Read Produk 
    public function read($slug_produk){
        $this->db->select(' tb_produk.*,
                            tb_user.nama_user,
                            tb_kategori.nama_kategori,
                            tb_kategori.slug_kategori');
        $this->db->from('tb_produk');
        ///JOIN
        $this->db->join('tb_user','tb_user.id_user = tb_produk.id_user', 'left');
        $this->db->join('tb_kategori','tb_kategori.id_kategori = tb_produk.id_kategori', 'left');

        ///END JOIN
        $this->db->where('tb_produk.status_produk', 'Publish');
        $this->db->where('tb_produk.slug_produk', $slug_produk);
        $this->db->group_by('tb_produk.id_produk');
        $this->db->order_by('id_produk', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    ///Kategori Produk
    public function kategori($id_kategori,$limit,$start){
        $this->db->select(' tb_produk.*,
                            tb_user.nama_user,
                            tb_kategori.nama_kategori,
                            tb_kategori.slug_kategori');
        $this->db->from('tb_produk');
        ///JOIN
        $this->db->join('tb_user','tb_user.id_user = tb_produk.id_user', 'left');
        $this->db->join('tb_kategori','tb_kategori.id_kategori = tb_produk.id_kategori', 'left');

        ///END JOIN
        $this->db->where('tb_produk.status_produk', 'Publish');
        $this->db->where('tb_produk.id_kategori', $id_kategori);
        $this->db->group_by('tb_produk.id_produk');
        $this->db->order_by('id_produk', 'desc');
        $this->db->limit($limit,$start);
        $query = $this->db->get();
        return $query->result();
    }

    ///Total kategori produk
    public function total_kategori($id_kategori){
        $this->db->select('COUNT(*) AS total');
        $this->db->from('tb_produk');
        $this->db->where('status_produk', 'Publish');
        $this->db->where('id_kategori', $id_kategori);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_keyword($keyword){
        $this->db->select(  'tb_produk.*,
                            tb_kategori.nama_kategori,');
        $this->db->from('tb_produk');
        ///JOIN
        $this->db->join('tb_kategori','tb_kategori.id_kategori = tb_produk.id_kategori', 'left');
        ///END JOIN
        $this->db->like('nama_produk', $keyword);
        $this->db->or_like('nama_kategori', $keyword);
        $this->db->or_like('harga', $keyword);
        return $this->db->get()->result();
    }

}