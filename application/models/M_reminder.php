<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_reminder extends CI_Model {

	var $reminder      = 'abe_reminder';
    var $reminder_cek  = 'abe_reminder_cek';

    public function save_reminder($data)
    {
        $this->db->insert($this->reminder, $data);
        return $this->db->insert_id();
    }

    public function update_reminder($data, $id_reminder)
    {
        $this->db->where('id_reminder',$id_reminder);
        $this->db->update($this->reminder,$data);
    }

    public function save_reminder_cek($data)
    {
        $this->db->insert($this->reminder_cek, $data);
        return $this->db->insert_id();
    }

    public function update_reminder_cek($data, $id_cek)
    {
        $this->db->where('id_cek',$id_cek);
        $this->db->update($this->reminder_cek,$data);
    }

}