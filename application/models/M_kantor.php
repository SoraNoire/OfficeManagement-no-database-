<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kantor extends CI_Model {

	var $table = 'abe_pt';
    var $table_kota = 'abe_kota';

    public function save_kota($data)
    {
        $this->db->insert($this->table_kota, $data);
        return $this->db->insert_id();
    }

    public function get_by_id_kota($id)
    {
        $this->db->from($this->table_kota);
        $this->db->where('id_kota',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update_kota($where, $data)
    {
        $this->db->update($this->table_kota, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id_kota($id)
    {
        $this->db->where('id_kota', $id);
        $this->db->delete($this->table_kota);
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

	public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_pt',$id);
		$query = $this->db->get();
		return $query->row();
	}

    public function delete_by_id($id)
    {
        $this->db->where('id_pt', $id);
        $this->db->delete($this->table);
    }

    public function validasi()
    {
        $id = $this->uri->segment(4);
        $status = "tidak aktif";
        $data = array('status'=>$status);
        $this->db->where('id_pt',$id);
        $this->db->update('abe_pt',$data);
    }

    public function validasi2()
    {
        $id = $this->uri->segment(4);
        $status = "aktif";
        $data = array('status'=>$status);
        $this->db->where('id_pt',$id);
        $this->db->update('abe_pt',$data);
    }
}