<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    ///Listing all USER
    public function listing(){
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->order_by('id_user', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    ///Detail user
    public function detail($id_user){
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('id_user', $id_user);
        $this->db->order_by('id_user', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    ///Tambah
    public function tambah($data){
        $this->db->insert('tb_user', $data);
    }

    ///Edit
    public function edit($data){
        $this->db->where('id_user', $data['id_user']);
        $this->db->update('tb_user', $data);
    }

    ///Delete
    public function delete($data){
        $this->db->where('id_user', $data['id_user']);
        $this->db->delete('tb_user', $data);
    }

    ///Login user
    public function login($username,$password){
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where(array( 'username'  => $username,
                                'password'  => SHA1($password)));
        $this->db->order_by('id_user', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
}