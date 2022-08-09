<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_nomor_surat extends CI_Model
{

    var $ns = 'abe_nomor_surat';

    function get_kode_ns()
    {
        $divisi     = $this->input->post('divisi');
        $pt         = $this->input->post('perusahaan');
        $tahun = date("Y");
        $array_bulan = array('01' => "I", '02' => "II", '03' => "III", '04' => "IV", '05' => "V", '06' => "VI", '07' => "VII", '08' => "VIII", '09' => "IX", '10' => "X", '11' => "XI", '12' => "XII");
        $bulan = $array_bulan[date('m')];
        $tahun2 = substr($tahun, -2);
        $query = $this->db->query("SELECT MAX(nomor_surat) as max_id_ns FROM abe_nomor_surat WHERE nomor_surat LIKE '%$tahun' AND perusahaan = '$pt'");
        $row = $query->row_array();
        $max_id = $row['max_id_ns'];
        $max_id1 = substr($max_id, 2, 3);
        //$max_id2 = $max_id1 - 100;
        
        if($max_id1 < 101){
            $no_ns = $max_id1 + 101;    
        }else{
            $no_ns = $max_id1 + 1;
        }
        //if ($divisi == 'HRD') {
        //    $maxkode_ns = $tahun2 . sprintf("%03s", $no_ns) . '/HRD-' . $pt . '/' . $bulan . '/' . $tahun;
        //} else {
            $maxkode_ns = $tahun2 . sprintf("%03s", $no_ns) . '/' . $pt . '/' . $bulan . '/' . $tahun;
        //}
        return $maxkode_ns;
    }

    public function save_ns($data)
    {
        $this->db->insert($this->ns, $data);
        return $this->db->insert_id();
    }

    public function hapus_nomor($id)
    {
        $this->db->where('id_ns', $id);
        $this->db->delete('abe_nomor_surat');
    }
}
