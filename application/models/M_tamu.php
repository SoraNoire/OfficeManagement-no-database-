<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tamu extends CI_Model {

	var $tamu = 'abe_buku_tamu';

    public function save_tamu($data)
    {
        $this->db->insert($this->tamu, $data);
        return $this->db->insert_id();
    }

    public function update_tamu($data, $id_tamu)
    {
        $this->db->where('id_tamu',$id_tamu);
        $this->db->update($this->tamu,$data);
    }

    function ambil_tamu()
    {
        $id = $this->uri->segment(4);
        $sql = "SELECT * FROM abe_tamu WHERE id_tamu = '$id'";  
        return $this->db->query($sql);
    }

}