<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_tanda_terima extends CI_Model
{

    var $tt = 'abe_tanda_terima';

    function get_kode_tt()
    {
        $divisi     = $this->input->post('divisi');
        $pt         = $this->input->post('perusahaan');
        $tahun = date("Y");
        $array_bulan = array('01' => "I", '02' => "II", '03' => "III", '04' => "IV", '05' => "V", '06' => "VI", '07' => "VII", '08' => "VIII", '09' => "IX", '10' => "X", '11' => "XI", '12' => "XII");
        $bulan = $array_bulan[date('m')];
        $tahun2 = substr($tahun, -2);
        $query = $this->db->query("SELECT MAX(nomor_tanda_terima) as max_id_tt FROM abe_tanda_terima WHERE nomor_tanda_terima LIKE '%$tahun' AND perusahaan = '$pt'");
        $row = $query->row_array();
        $max_id = $row['max_id_tt'];
        $max_id1 = substr($max_id, 2, 3);
        //$max_id2 = $max_id1 - 100;
        
        if($max_id1 < 101){
            $no_tt = $max_id1 + 101;    
        }else{
            $no_tt = $max_id1 + 1;
        }
        //if ($divisi == 'HRD') {
        //    $maxkode_ns = $tahun2 . sprintf("%03s", $no_ns) . '/HRD-' . $pt . '/' . $bulan . '/' . $tahun;
        //} else {
            $maxkode_tt = $tahun2 . sprintf("%03s", $no_tt) . '/' . $pt . '/' . $bulan . '/' . $tahun;
        //}
        return $maxkode_tt;
    }

    public function save_tt($data)
    {
        $this->db->insert($this->tt, $data);
        return $this->db->insert_id();
    }

    public function update_tt($id_tt, $data)
    {
        $this->db->where('nomor_tanda_terima',$id_tt);
        $this->db->update($this->tt,$data);
    }

    public function hapus_nomor($id)
    {
        $this->db->where('id_tanda_terima', $id);
        $this->db->delete('abe_tanda_terima');
    }
}
