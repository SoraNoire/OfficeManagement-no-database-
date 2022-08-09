<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_absen extends CI_Model {

    var $absen      = 'abe_absen';

    public function absen_masuk()
    {
        if ($this->agent->is_browser()){
              $agent = $this->agent->browser().' '.$this->agent->version();
          }elseif ($this->agent->is_mobile()){
              $agent = $this->agent->mobile();
          }else{
              $agent = 'Data user gagal di dapatkan';
          }
        date_default_timezone_set("Asia/Jakarta");
        $array_bulan = array('1'=>"januari",'2'=>"februari",'3'=>"maret",
                     '4'=>"april",'5'=>"mei",'6'=>"juni",'7'=>"juli",
                     '8'=>"agustus",'9'=>"september",'10'=>"oktober",
                     '11'=> "november",'12'=>"desember",'13'=>"akhir_desember");
        $tanggal    = date("d");
        if ($tanggal > 20 ){
            $bulan = $array_bulan[date('m')+1];
            if($bulan == 'akhir_desember'){
                $bulan = 'januari';
                $tahun = date("Y")+1 ;
            }else{
                $tahun = date("Y");
            }
            $periode = $bulan." ".$tahun;
        }else{
            $bulan = $array_bulan[date('m')-0];
            $tahun = date("Y");
            $periode = $bulan." ".$tahun;
        }
        $date       = date("Y-m-d H:i:s");
        $date2      = date("Y-m-d");
        $karyawan   = $this->session->userdata('id_karyawan');
        $status     = 'masuk';
        $ip         = $this->input->ip_address() ;
        $browser    = $agent.'|'.$this->agent->platform();
        $data  = array('tgl_absen'=>$date,'tanggal'=>$date2,'periode'=>$periode,'id_karyawan'=>$karyawan,'status'=>$status,'ip_pc'=>$ip,'browser_platform'=>$browser);
        $this->db->insert($this->absen, $data);
        return $this->db->insert_id();
    }

    public function absen_pulang($data,$id_absen)
    {
        $this->db->where('id_absen',$id_absen);
        $this->db->update($this->absen,$data);
    }

    public function absen_ijin()
    {
        if ($this->agent->is_browser()){
              $agent = $this->agent->browser().' '.$this->agent->version();
          }elseif ($this->agent->is_mobile()){
              $agent = $this->agent->mobile();
          }else{
              $agent = 'Data user gagal di dapatkan';
          }
        date_default_timezone_set("Asia/Jakarta");
        $array_bulan = array('1'=>"januari",'2'=>"februari",'3'=>"maret",
                     '4'=>"april",'5'=>"mei",'6'=>"juni",'7'=>"juli",
                     '8'=>"agustus",'9'=>"september",'10'=>"oktober",
                     '11'=> "november",'12'=>"desember",'13'=>"akhir_desember");
        $tanggal    = date("d");
        if ($tanggal > 20 ){
            $bulan = $array_bulan[date('m')+1];
            if($bulan == 'akhir_desember'){
                $bulan = 'januari';
                $tahun = date("Y")+1 ;
            }else{
                $tahun = date("Y");
            }
            $periode = $bulan." ".$tahun;
        }else{
            $bulan = $array_bulan[date('m')-0];
            $tahun = date("Y");
            $periode = $bulan." ".$tahun;
        }
        $date       = date("Y-m-d H:i:s");
        $date2      = date("Y-m-d");
        $input      = $this->session->userdata('id_karyawan');
        $karyawan   = $this->input->post('id_karyawan');
        $status     = $this->input->post('status');
        $keterangan = $this->input->post('keterangan');
        $ip         = $this->input->ip_address() ;
        $browser    = $agent.'|'.$this->agent->platform();
        $data  = array('tgl_input'=>$date,'tanggal'=>$date2,'periode'=>$periode,'id_karyawan'=>$karyawan,'status'=>$status,'id_input'=>$input,'keterangan'=>$keterangan,'ip_pc'=>$ip,'browser_platform'=>$browser);
        $this->db->insert($this->absen, $data);
        return $this->db->insert_id();
    }

    public function absen_sakit()
    {
        if ($this->agent->is_browser()){
              $agent = $this->agent->browser().' '.$this->agent->version();
          }elseif ($this->agent->is_mobile()){
              $agent = $this->agent->mobile();
          }else{
              $agent = 'Data user gagal di dapatkan';
          }
        date_default_timezone_set("Asia/Jakarta");
        $array_bulan = array('1'=>"januari",'2'=>"februari",'3'=>"maret",
                     '4'=>"april",'5'=>"mei",'6'=>"juni",'7'=>"juli",
                     '8'=>"agustus",'9'=>"september",'10'=>"oktober",
                     '11'=> "november",'12'=>"desember",'13'=>"akhir_desember");
        $tanggal    = date("d");
        if ($tanggal > 20 ){
            $bulan = $array_bulan[date('m')+1];
            if($bulan == 'akhir_desember'){
                $bulan = 'januari';
                $tahun = date("Y")+1 ;
            }else{
                $tahun = date("Y");
            }
            $periode = $bulan." ".$tahun;
        }else{
            $bulan = $array_bulan[date('m')-0];
            $tahun = date("Y");
            $periode = $bulan." ".$tahun;
        }
        $date       = date("Y-m-d H:i:s");
        $date2      = date("Y-m-d");
        $karyawan   = $this->session->userdata('id_karyawan');
        $status     = 'sakit';
        //$status     = $this->input->post('status');
        $keterangan = $this->input->post('keterangan');
        $ip         = $this->input->ip_address() ;
        $browser    = $agent.'|'.$this->agent->platform();
        $data  = array('tgl_absen'=>$date,'tanggal'=>$date2,'periode'=>$periode,'id_karyawan'=>$karyawan,'status'=>$status,'ip_pc'=>$ip,'browser_platform'=>$browser,'keterangan'=>$keterangan);
        $this->db->insert($this->absen, $data);
        return $this->db->insert_id();
    }

    public function simpan_lampiran($data, $id)
    {
        $this->db->where('id_absen',$id);
        $this->db->update($this->absen,$data);
    } 

    public function hapus_status($id)
    {
        $this->db->where('id_absen', $id);
        $this->db->delete($this->absen);        
    }

















}