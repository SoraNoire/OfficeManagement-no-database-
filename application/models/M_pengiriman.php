<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengiriman extends CI_Model {

    var $ekspedisi  = 'abe_ekspedisi';
    var $history    = 'abe_history_sj';
    var $sj         = 'abe_surat_jalan';
    var $detail     = 'abe_detail_sj';

    function get_kode_sj()
    {
        $tahun = date("Y");
        //$bulan = date ("m");
        $array_bulan = array('01'=>"I",'02'=>"II",'03'=>"III",'04'=>"IV",'05'=>"V",'06'=>"VI",'07'=>"VII",'08'=>"VIII",'09'=>"IX",'10'=>"X",'11'=> "XI",'12'=>"XII");
        $bulan = $array_bulan[date('m')];
        $kode = 'SJ';
        $kode1 = 'SJ';
        $posisi = $this->session->userdata('posisi');
            if($posisi == 'JAKARTA'){
                $kode2 = 'JKT';
            }else if($posisi == 'SAMPIT'){
                $kode2 = 'SMT';
            }else if($posisi == 'SAMARINDA'){
                $kode2 = 'SMD';
            }else{
                $kode2 = 'SBY';
            }
        //$kode2 = 'JKT';
        $new_moon = $tahun.'/'.$kode1.'-'.$kode2.'/'.$bulan ;
        //$today = $bulan.'/'.$tahun ;
        //$query = $this->db->query("SELECT MAX(no_pr) as max_id_pr FROM tbl_pr LIKE '$today%'");
        $query = $this->db->query("SELECT MAX(no_sj) as max_id_sj FROM abe_surat_jalan WHERE no_sj LIKE '$new_moon%'"); 
        $row = $query->row_array();
        $max_id = $row['max_id_sj']; 
        $max_id1 = substr($max_id,-5);
        $no_sj = $max_id1 +1;
        $maxkode_sj = $tahun.'/'.$kode1.'-'.$kode2.'/'.$bulan.'/'.sprintf("%05s",$no_sj);
        return $maxkode_sj;
    }

    public function save_ekspedisi($data)
    {
        $this->db->insert($this->ekspedisi, $data);
        return $this->db->insert_id();
    }

    public function tambah_ekspedisi($data)
    {    
        $query = $this->db->query("SELECT id_ekspedisi FROM abe_ekspedisi ORDER BY id_ekspedisi DESC LIMIT 1"); 
        $row = $query->row_array();
        $ekspedisi = $row['id_ekspedisi']; 

        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");

        $count1 = count($data['count1']);
        for($i = 0; $i<$count1; $i++){
            $entries1[] = array(
                'id_ekspedisi'=>$ekspedisi,
                'nama_kota'=>$data['nama_kota'][$i],
                );
        }

        $count2 = count($data['count2']);
        for($a = 0; $a<$count2; $a++){
            $entries2[] = array(
                'id_ekspedisi'=>$ekspedisi,
                'nama_paket'=>$data['nama_paket'][$a],
                'harga'=>$data['harga'][$a],
                'satuan'=>$data['satuan'][$a],
                'kota_asal'=>$data['kota_asal'][$a],
                'kota_tujuan'=>$data['kota_tujuan'][$a],
                'estimasi'=>$data['estimasi'][$a],
                'catatan'=>$data['catatan'][$a],
                );
        }
        $this->db->insert_batch('abe_kota_ekspedisi', $entries1);
        $this->db->insert_batch('abe_paket_ekspedisi', $entries2);
        
    }

    function ambil_ekspedisi()
    {
        $id = $this->uri->segment(4);
        $sql = "SELECT * FROM abe_ekspedisi WHERE id_ekspedisi = '$id'";  
        return $this->db->query($sql);
    }

    function edit_ekspedisi($data)
    {    
        $ekspedisi = $this->input->post('id_ekspedisi');

        $count1 = count($data['count1']);
        $count2 = count($data['count2']);
        $count1a = count($data['count1a']);
        $count2a = count($data['count2a']);

        if($count1a != '0' AND $count2a !='0'){
            for($a = 0; $a<$count1a; $a++){
                $entries1[] = array(
                    'id_ekspedisi'=>$ekspedisi,
                    'nama_kota'=>$data['nama_kota1'][$a],
                    );
            }
            $this->db->insert_batch('abe_kota_ekspedisi', $entries1);
            
            for($i = 0; $i<$count1; $i++){
                $entries1a[] = array(
                    'id_k_ekspedisi'=>$data['id_kota'][$i],
                    'nama_kota'=>$data['nama_kota'][$i],
                    );
            }
            $this->db->update_batch('abe_kota_ekspedisi',$entries1a,'id_k_ekspedisi');

            for($a = 0; $a<$count2a; $a++){
                $entries2[] = array(
                    'id_ekspedisi'=>$ekspedisi,
                    'nama_paket'=>$data['nama_paket1'][$a],
                    'harga'=>$data['harga1'][$a],
                    'satuan'=>$data['satuan1'][$a],
                    'kota_asal'=>$data['kota_asal1'][$a],
                    'kota_tujuan'=>$data['kota_tujuan1'][$a],
                    'estimasi'=>$data['estimasi1'][$a],
                    'catatan'=>$data['catatan1'][$a],
                    );
            }
            $this->db->insert_batch('abe_paket_ekspedisi', $entries2);
            
            for($a = 0; $a<$count2; $a++){
                $entries2a[] = array(
                    'id_p_ekspedisi'=>$data['id_paket'][$a],
                    'nama_paket'=>$data['nama_paket'][$a],
                    'harga'=>$data['harga'][$a],
                    'satuan'=>$data['satuan'][$a],
                    'kota_asal'=>$data['kota_asal'][$a],
                    'kota_tujuan'=>$data['kota_tujuan'][$a],
                    'estimasi'=>$data['estimasi'][$a],
                    'catatan'=>$data['catatan'][$a],
                    );
            }
            $this->db->update_batch('abe_paket_ekspedisi',$entries2a,'id_p_ekspedisi');

        }else if($count1a != '0'){
            for($a = 0; $a<$count1a; $a++){
                $entries1[] = array(
                    'id_ekspedisi'=>$ekspedisi,
                    'nama_kota'=>$data['nama_kota1'][$a],
                    );
            }
            $this->db->insert_batch('abe_kota_ekspedisi', $entries1);

            for($i = 0; $i<$count1; $i++){
                $entries1a[] = array(
                    'id_k_ekspedisi'=>$data['id_kota'][$i],
                    'nama_kota'=>$data['nama_kota'][$i],
                    );
            }
            $this->db->update_batch('abe_kota_ekspedisi',$entries1a,'id_k_ekspedisi');
            
            for($a = 0; $a<$count2; $a++){
                $entries2a[] = array(
                    'id_p_ekspedisi'=>$data['id_paket'][$a],
                    'nama_paket'=>$data['nama_paket'][$a],
                    'harga'=>$data['harga'][$a],
                    'satuan'=>$data['satuan'][$a],
                    'kota_asal'=>$data['kota_asal'][$a],
                    'kota_tujuan'=>$data['kota_tujuan'][$a],
                    'estimasi'=>$data['estimasi'][$a],
                    'catatan'=>$data['catatan'][$a],
                    );
            }
            $this->db->update_batch('abe_paket_ekspedisi',$entries2a,'id_p_ekspedisi');
        }else if($count2a !='0'){
            for($a = 0; $a<$count2a; $a++){
                $entries2[] = array(
                    'id_ekspedisi'=>$ekspedisi,
                    'nama_paket'=>$data['nama_paket1'][$a],
                    'harga'=>$data['harga1'][$a],
                    'satuan'=>$data['satuan1'][$a],
                    'kota_asal'=>$data['kota_asal1'][$a],
                    'kota_tujuan'=>$data['kota_tujuan1'][$a],
                    'estimasi'=>$data['estimasi1'][$a],
                    'catatan'=>$data['catatan1'][$a],
                    );
            }
            $this->db->insert_batch('abe_paket_ekspedisi', $entries2);

            for($i = 0; $i<$count1; $i++){
                $entries1a[] = array(
                    'id_k_ekspedisi'=>$data['id_kota'][$i],
                    'nama_kota'=>$data['nama_kota'][$i],
                    );
            }
            $this->db->update_batch('abe_kota_ekspedisi',$entries1a,'id_k_ekspedisi');
            
            for($a = 0; $a<$count2; $a++){
                $entries2a[] = array(
                    'id_p_ekspedisi'=>$data['id_paket'][$a],
                    'nama_paket'=>$data['nama_paket'][$a],
                    'harga'=>$data['harga'][$a],
                    'satuan'=>$data['satuan'][$a],
                    'kota_asal'=>$data['kota_asal'][$a],
                    'kota_tujuan'=>$data['kota_tujuan'][$a],
                    'estimasi'=>$data['estimasi'][$a],
                    'catatan'=>$data['catatan'][$a],
                    );
            }
            $this->db->update_batch('abe_paket_ekspedisi',$entries2a,'id_p_ekspedisi');
        }else{
            for($i = 0; $i<$count1; $i++){
                $entries1a[] = array(
                    'id_k_ekspedisi'=>$data['id_kota'][$i],
                    'nama_kota'=>$data['nama_kota'][$i],
                    );
            }
            $this->db->update_batch('abe_kota_ekspedisi',$entries1a,'id_k_ekspedisi');
            
            for($a = 0; $a<$count2; $a++){
                $entries2a[] = array(
                    'id_p_ekspedisi'=>$data['id_paket'][$a],
                    'nama_paket'=>$data['nama_paket'][$a],
                    'harga'=>$data['harga'][$a],
                    'satuan'=>$data['satuan'][$a],
                    'kota_asal'=>$data['kota_asal'][$a],
                    'kota_tujuan'=>$data['kota_tujuan'][$a],
                    'estimasi'=>$data['estimasi'][$a],
                    'catatan'=>$data['catatan'][$a],
                    );
            }
            $this->db->update_batch('abe_paket_ekspedisi',$entries2a,'id_p_ekspedisi');
        }
    }

    function tambah_sj($data)
    {    
        $no_sj      = $this->M_pengiriman->get_kode_sj();
        $status     = "baru";

        $pembuat    = $this->session->userdata('id_karyawan');
        $mengetahui = $this->session->userdata('nama_lengkap');
        //$pengirim   = $this->input->post('pengirim');
        $ekspedisi  = $this->input->post('ekspedisi');
        $paket      = $this->input->post('paket');
        $pt_tujuan  = $this->input->post('pt_tujuan');
        $tujuan     = $this->input->post('tujuan');
        $transit    = $this->input->post('transit');
        $no_pr      = $this->input->post('no_pr');
        $asal       = $this->session->userdata('posisi');

        date_default_timezone_set("Asia/Jakarta");
        $date       = date("Y-m-d H:i:s");
        
        $input          = array('no_sj'=>$no_sj,'no_pr'=>$no_pr,'nama_ekspedisi'=>$ekspedisi,'id_paket'=>$paket,'nama_pt'=>$pt_tujuan,
                            'kota_asal'=>$asal,'kota_tujuan'=>$tujuan,'kota_via'=>$transit,'tgl_buat'=>$date,
                            'id_pembuat'=>$pembuat,'mengetahui'=>$mengetahui,'status_sj'=>$status);
        $input_history  = array('no_sj'=>$no_sj,'status'=>$status,'tgl_input'=>$date,'id_input'=>$pembuat,
                            'nama_input'=>$mengetahui);

        $count = count($data['count']);
        for($i = 0; $i<$count; $i++){
            $entries[] = array(
                'no_sj'=>$no_sj,
                'nama_barang'=>$data['barang'][$i],
                'jumlah'=>$data['jumlah'][$i],
                'satuan'=>$data['satuan'][$i],
                );
        }
        $this->db->insert('abe_surat_jalan',$input);
        $this->db->insert('abe_history_sj',$input_history);
        $this->db->insert_batch('abe_detail_sj', $entries);
    }

    public function simpan_history($data)
    {
        $this->db->insert($this->history, $data);
        return $this->db->insert_id();
    }

    public function update_sj($where, $data)
    {
        $this->db->update($this->sj, $data, $where);
        return $this->db->affected_rows();
    }

    function ambil_surat_jalan()
    {
        $id = $this->uri->segment(4);
        $sql = "SELECT asj.*, ae.*, ape.*
                FROM abe_surat_jalan as asj, abe_ekspedisi as ae, abe_paket_ekspedisi as ape
                WHERE asj.id_sj = '$id' AND asj.nama_ekspedisi = ae.id_ekspedisi AND asj.id_paket = ape.id_p_ekspedisi";  
        return $this->db->query($sql);
    }

    function hapus()
    {
        $id = $this->uri->segment(4);
        $sql = "SELECT id_sj, no_sj FROM abe_surat_jalan WHERE id_sj = '$id'";  
        
        //return $this->db->query($sql);
    }

    public function hapus_sj($id)
    {
        $this->db->where('id_sj', $id);
        $this->db->delete($this->sj);
    }

    public function hapus_history_sj($no_sj)
    {
        $this->db->where('no_sj', $no_sj);
        $this->db->delete($this->history);
    }

    public function hapus_detail_sj($no_sj)
    {
        $this->db->where('no_sj', $no_sj);
        $this->db->delete($this->detail);
    }










}