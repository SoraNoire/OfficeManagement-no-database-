<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tugas extends CI_Model {

	var $table = 'abe_pt';
    var $table_tugas = 'abe_tugas_harian';

    public function save_tugas($data)
    {
        $this->db->insert($this->table_tugas, $data);
        return $this->db->insert_id();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_tugas', $id);
        $this->db->delete($this->table_tugas);
    }

    public function update_tugas($where, $data)
    {
        $this->db->update($this->table_tugas, $data, $where);
        return $this->db->affected_rows();
    }

    public function data_karyawan()
    {
        $sql = "SELECT * FROM abe_karyawan";
        return $this->db->query($sql);
    }

    public function tampil_jobdesk ($id)
    {
        $sql = "SELECT * FROM abe_jobdesk WHERE id_karyawan = $id";
        return $this->db->query($sql); 
    }   














}