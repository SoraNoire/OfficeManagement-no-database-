<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_menu extends CI_Model {

	var $table = 'abe_menu';

	
    public function select_parent($table,$data){
        $this->db->where($data);
        return $this->db->get($table);
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
		$this->db->where('id_menu',$id);
		$query = $this->db->get();
		return $query->row();
	}

    public function delete_by_id($id)
    {
        $this->db->where('id_menu', $id);
        $this->db->delete($this->table);
    }
}