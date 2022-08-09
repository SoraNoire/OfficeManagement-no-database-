<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_karyawan extends CI_Model {

	var $table = 'abe_karyawan';
    var $table2 = 'abe_history_karyawan';

    public function data_karyawan()
    {
        $sql = "SELECT * FROM abe_karyawan";
        return $this->db->query($sql);
    }

	public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function save_history($data)
    {
        $this->db->insert($this->table2, $data);
        return $this->db->insert_id();
    }

    public function detail_karyawan($id)
    {
        $param = array('id_karyawan' => $id);
        return $this->db->get_where('abe_karyawan',$param);
    }

    function update_karyawan($data, $id) 
    {
        $this->db->where('id_karyawan', $id);
        $this->db->update('abe_karyawan', $data);
    }

	public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_karyawan',$id);
		$query = $this->db->get();
		return $query->row();
	}

    public function delete_by_id($id)
    {
        $this->db->where('id_karyawan', $id);
        $this->db->delete($this->table);
    }

    public function aktifkan_user()
    {
        $id = $this->uri->segment(4);
        $status = "aktif";
        $data = array('status'=>$status);
        $this->db->where('id_karyawan',$id);
        $this->db->update($this->table,$data);
    }

    public function nonaktifkan_user()
    {
        $id = $this->uri->segment(4);
        $status = "non aktif";
        $data = array('status'=>$status);
        $this->db->where('id_karyawan',$id);
        $this->db->update($this->table,$data);
    }

}