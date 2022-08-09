<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jobdesk extends CI_Model {

    var $table_jobdesk = 'abe_jobdesk';

    public function save_jobdesk($data)
    {
        $this->db->insert($this->table_jobdesk, $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table_jobdesk);
        $this->db->where('id_jobdesk',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update_jobdesk($where, $data)
    {
        $this->db->update($this->table_jobdesk, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_jobdesk($id)
    {
        $this->db->where('id_jobdesk', $id);
        $this->db->delete($this->table_jobdesk);
    }

}