<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengguna extends CI_Model {

	var $table = 'abe_login';
	var $table2 = 'abe_karyawan';
    var $table3 = 'abe_history_login';

	public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id_login',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function save_login($data)
    {
        $this->db->insert($this->table3, $data);
        return $this->db->insert_id();
    }

    public function update_karyawan($where, $data)
    {
        $this->db->update($this->table2, $data, $where);
        return $this->db->affected_rows();
    }
	
	public function cekLogin($username, $hash, $karyawan){
		$sql = "SELECT al.*, ak.*
				FROM abe_login as al, abe_karyawan as ak
				WHERE al.username = '$username' and al.password = '$hash' and al.id_karyawan = ak.id_karyawan and al.status = 'aktif'";
		$user = $this->db->query($sql)->row_array();
		return $user;
	}

    public function ubahPassword($where, $data){
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

	public function profile_karyawan($id)
    {
        //$param = array('id_karyawan' => $id);
        $id = $this->session->userdata('id_karyawan');
        return $this->db->get_where('abe_karyawan',$id);
    }

    public function validasi()
    {
        $id = $this->uri->segment(4);
        $status = "tidak aktif";
        $data = array('status'=>$status);
        $this->db->where('id_login',$id);
        $this->db->update('abe_login',$data);
    }

    public function validasi2()
    {
        $id = $this->uri->segment(4);
        $status = "aktif";
        $data = array('status'=>$status);
        $this->db->where('id_login',$id);
        $this->db->update('abe_login',$data);
    }
}