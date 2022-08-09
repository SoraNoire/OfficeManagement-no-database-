<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pertamina extends CI_Model
{

    //var $absen      = 'abe_absen';

    public function view()
    {
        return $this->db->get('abe_absensi_boss_pintar')->result(); // Tampilkan semua data yang ada di tabel absensi
    }

    public function upload_file($filename)
    {
        $this->load->library('upload'); // Load librari upload

        $config['upload_path'] = './excel/';
        //$config['upload_path'] = './excel2/';
        $config['allowed_types'] = 'xlsx';
        $config['max_size']    = '4048';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;

        $this->upload->initialize($config); // Load konfigurasi uploadnya
        if ($this->upload->do_upload('file')) { // Lakukan upload dan Cek jika proses upload berhasil
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            // Jika gagal :
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }

    public function insert_multiple($data)
    {
        $this->db->insert_batch('abe_tangki_aspal', $data);
    }

    public function save_sounding($data)
    {
        $this->db->insert('abe_tangki_hasil_sounding', $data);
        return $this->db->insert_id();
    }

    public function update_sounding($data, $id)
    {
        //$id_rapat = $this->uri->segment(4);
        $this->db->where('id', $id);
        $this->db->update('abe_tangki_hasil_sounding', $data);
    }
}
