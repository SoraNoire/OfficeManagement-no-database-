<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_surat extends CI_Model {

	var $surat = 'abe_surat_masuk';

    public function save_surat_masuk($data)
    {
        $this->db->insert($this->surat, $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id)
	{
		$this->db->from($this->surat);
		$this->db->where('id_surat_masuk',$id);
		$query = $this->db->get();
		return $query->row();
	}
}