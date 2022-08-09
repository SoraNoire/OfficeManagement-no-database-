<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_rapat extends CI_Model {

	var $rapat = 'abe_rapat_new';
    var $rapat_peserta = 'abe_rapat_peserta';
    var $rapat_lampiran = 'abe_rapat_lampiran';
    var $rapat_mengetahui = 'abe_rapat_mengetahui';

    function get_kode_rapat()
    {
        //$lokasi = $this->uri->segment(4);
        $lokasi   = $this->session->userdata('lokasi');
        $tahun = date("Y");
        //$bulan = date ("m");
        $array_bulan = array('01'=>"I",'02'=>"II",'03'=>"III",'04'=>"IV",'05'=>"V",'06'=>"VI",'07'=>"VII",'08'=>"VIII",'09'=>"IX",'10'=>"X",'11'=> "XI",'12'=>"XII");
        $bulan = $array_bulan[date('m')];
        
        $kode = 'NR';
        $tahun2 = substr($tahun,-2);     
        $query = $this->db->query("SELECT MAX(no_rapat) as max_id_rapat FROM abe_rapat_new WHERE no_rapat LIKE '%$tahun'"); 
        $row = $query->row_array();
        $max_id = $row['max_id_rapat']; 
        $max_id1 = substr($max_id,2,4);
        $no_rapat = $max_id1 + 1;
        $maxkode_rapat = $tahun2.sprintf("%04s",$no_rapat).'/'.$kode.'-'.$lokasi.'/'.$bulan.'/'.$tahun ;
        return $maxkode_rapat;
    }

    public function save_peserta($data)
    {
        $this->db->insert($this->rapat_peserta, $data);
        return $this->db->insert_id();
    }

    public function hapus_peserta($id)
    {
        $this->db->where('id_rapat_peserta', $id);
        $this->db->delete($this->rapat_peserta);
    }

    public function save_mengetahui($data)
    {
        $this->db->insert($this->rapat_mengetahui, $data);
        return $this->db->insert_id();
    }

    public function hapus_mengetahui($id)
    {
        $this->db->where('id_rapat_mengetahui', $id);
        $this->db->delete($this->rapat_mengetahui);
    }

    public function save_lampiran($data)
    {
        $this->db->insert($this->rapat_lampiran, $data);
        return $this->db->insert_id();
    }

    public function id_lampiran($id)
    {
        $this->db->from($this->rapat_lampiran);
        $this->db->where('id_rapat_lampiran',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function hapus_lampiran($id)
    {
        $this->db->where('id_rapat_lampiran', $id);
        $this->db->delete($this->rapat_lampiran);
    }

    public function save_draft($data)
    {
        $this->db->insert($this->rapat, $data);
        return $this->db->insert_id();
    }

    public function update_draft($data, $id)
    {
        //$id_rapat = $this->uri->segment(4);
        $this->db->where('id_rapat',$id);
        $this->db->update($this->rapat,$data);
    }

    public function update_done($data, $id)
    {
        //$id_rapat = $this->uri->segment(4);
        $this->db->where('id_rapat',$id);
        $this->db->update($this->rapat,$data);
    }

    function ambil_notulen_rapat()
    {
        $id = $this->uri->segment(4);
        $sql = "SELECT * FROM abe_rapat_new WHERE id_rapat = '$id'";  
        return $this->db->query($sql);
    }

    public function hapus_rapat($id)
    {
        $sql = "SELECT no_rapat, id_rapat FROM abe_rapat_new WHERE id_rapat = '$id'";
        $rapat = $this->db->query($sql)->row_array();
        $no_rapat = $rapat['no_rapat'];
        $this->db->where('id_rapat', $no_rapat);
        $this->db->delete($this->rapat_peserta);
        $this->db->where('id_rapat', $id);
        $this->db->delete($this->rapat);
        
    }

}