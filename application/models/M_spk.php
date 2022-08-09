<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_spk extends CI_Model {

	var $spk = 'abe_spk_all';
    var $spk_history = 'abe_spk_history';

    function get_kode_spk2()
    {
        //$lokasi = $this->uri->segment(4);
        $lokasi         = $this->session->userdata('lokasi');
        $query_lokasi   = $this->db->query("SELECT * FROM abe_kota WHERE kode_kota = '$lokasi'")->row_array();
        $kota = $query_lokasi['nama_kota'];
        $tahun = date("Y");
        //$bulan = date ("m");
        $array_bulan = array('01'=>"I",'02'=>"II",'03'=>"III",'04'=>"IV",'05'=>"V",'06'=>"VI",'07'=>"VII",'08'=>"VIII",'09'=>"IX",'10'=>"X",'11'=> "XI",'12'=>"XII");
        $bulan = $array_bulan[date('m')];
        $kode = 'IT';
        $tahun2 = substr($tahun,-2);
        $query = $this->db->query("SELECT MAX(no_spk) as max_id_spk FROM abe_spk WHERE no_spk LIKE '%$tahun' AND kota = '$kota'"); 
        $row = $query->row_array();
        $max_id = $row['max_id_spk']; 
        $max_id1 = substr($max_id,2,4);
        $no_spk = $max_id1 + 1;
        $maxkode_spk = $tahun2.sprintf("%04s",$no_spk).'/'.$kode.'-'.$lokasi.'/'.$bulan.'/'.$tahun ;
        return $maxkode_spk;
    }

    function get_kode_spk()
    {
        $divisi     = $this->session->userdata('divisi');
        $sql        = $this->db->query("SELECT * FROM abe_department WHERE nama_department = '$divisi'")->row_array();
        $kode_divisi    = $sql['kode_department'];
        $tahun = date("Y");
        $array_bulan = array('01'=>"I",'02'=>"II",'03'=>"III",'04'=>"IV",'05'=>"V",'06'=>"VI",'07'=>"VII",'08'=>"VIII",'09'=>"IX",'10'=>"X",'11'=> "XI",'12'=>"XII");
        $bulan = $array_bulan[date('m')];
        $kode = 'SPK';
        $tahun2 = substr($tahun,-2);
        $query = $this->db->query("SELECT MAX(no_spk) as max_id_spk FROM abe_spk_all WHERE no_spk LIKE '%$tahun' AND divisi = '$divisi'"); 
        $row = $query->row_array();
        $max_id = $row['max_id_spk']; 
        $max_id1 = substr($max_id,2,4);
        $no_spk = $max_id1 + 1;
        $maxkode_spk = $tahun2.sprintf("%04s",$no_spk).'/'.$kode.'-'.$kode_divisi.'/'.$bulan.'/'.$tahun ;
        return $maxkode_spk;
    }

    public function save_spk($data)
    {
        $this->db->insert($this->spk, $data);
        return $this->db->insert_id();
    }

    public function save_history_spk($data)
    {
        $this->db->insert($this->spk_history, $data);
        return $this->db->insert_id();
    }

    public function hapus_spk($id)
    {
        $this->db->where('id_spk', $id);
        $this->db->delete($this->spk_history);
        $this->db->where('id_spk', $id);
        $this->db->delete($this->spk);
        $this->db->where('id_spk', $id);
        $this->db->delete('abe_spk_detail');
    }

    public function update_spk($data, $id_spk)
    {
        $this->db->where('id_spk',$id_spk);
        $this->db->update($this->spk,$data);
    }

    function ambil_spk()
    {
        $id = $this->uri->segment(4);
        $sql = "SELECT * FROM abe_spk_all WHERE id_spk = '$id'";  
        return $this->db->query($sql);
    }

    public function save_detail($data)
    {
        $this->db->insert('abe_spk_detail', $data);
        return $this->db->insert_id();
    }

    public function get_id_detail($id)
    {
        $this->db->from('abe_spk_detail');
        $this->db->where('id_spk_detail',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function hapus_detail($id)
    {
        $this->db->where('id_spk_detail', $id);
        $this->db->delete('abe_spk_detail');
    }

    public function update_detail($data3) 
    {
        $id = 0;
        $user = $this->session->userdata('id_karyawan');
        $this->db->update('abe_spk_detail', $data3, array('id_spk' => $id, 'id_user'=> $user));
    }

    public function read_detail_spk($data3, $id_spk) 
    {
        //$user = $this->session->userdata('id_karyawan');
        //$this->db->update('abe_spk_detail', $data3, array('id_spk' => $id_spk, 'id_user'=> $user));
        $this->db->where('id_spk',$id_spk);
        $this->db->update('abe_spk_detail',$data3);
    }

    public function proses_detail_spk($data3, $id) 
    {
        $this->db->where('id_spk_detail',$id);
        $this->db->update('abe_spk_detail',$data3);
    }
}