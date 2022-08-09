<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_permintaan extends CI_Model {

	var $table = 'abe_pt';
    var $table_tugas = 'abe_tugas_harian';


    function get_kode_pr()
    {
        $lokasi         = $this->session->userdata('lokasi');
        $query_lokasi   = $this->db->query("SELECT * FROM abe_kota WHERE kode_kota = '$lokasi'")->row_array();
        $kota           = $query_lokasi['nama_kota'];
        $tahun = date("Y");
        //$bulan = date ("m");
        $array_bulan = array('01'=>"I",'02'=>"II",'03'=>"III",'04'=>"IV",'05'=>"V",'06'=>"VI",'07'=>"VII",'08'=>"VIII",'09'=>"IX",'10'=>"X",'11'=> "XI",'12'=>"XII");
        $bulan = $array_bulan[date('m')];
        $kode = 'PR';
        //$new_moon = $tahun.'/'.$kode.'/'.$lokasi.'/'.$bulan ;
        $query = $this->db->query("SELECT MAX(no_pr) as max_id_pr FROM abe_permintaan WHERE no_pr LIKE '$tahun%' AND kota_pr = '$kota'"); 
        $row = $query->row_array();
        $max_id = $row['max_id_pr']; 
        $max_id1 = substr($max_id, -4);
        $no_pr = is_numeric($max_id1) + 1 ;
        $maxkode_pr = $tahun.'/'.$kode.'/'.$lokasi.'/'.$bulan.'/'.sprintf("%04s",$no_pr);
        return $maxkode_pr;
        //return $max_id;
    }

    public function save_permintaan_detail($data)
    {
        $this->db->insert('abe_permintaan_detail', $data);
        return $this->db->insert_id();
    }

    public function hapus_detail_permintaan($id)
    {
        $this->db->where('id_pr_detail', $id);
        $this->db->delete('abe_permintaan_detail');
    }

    public function _do_upload()
    {
        $config['upload_path']          = 'assets/lampiran_pr';
        $config['allowed_types']        = 'jpg|png|jpeg|pdf';
        $config['max_size']             = 40000; //set max size allowed in Kilobyte
       // $config['max_width']            = 1000; // set max width image allowed
       // $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        //$this->load->library('upload', $config);
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('file')) //upload and validate
        {
            $data['inputerror'][] = 'file';
            $data['error_string'][] = 'Upload error : '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    function tambah_pr($data)
    {    
        $lokasi         = $this->session->userdata('lokasi');
        $query_lokasi   = $this->db->query("SELECT * FROM abe_kota WHERE kode_kota = '$lokasi'")->row_array();
        $kota           = $query_lokasi['nama_kota'];
        $no_pr          = $this->M_permintaan->get_kode_pr();        
        $status_pr      = "baru";
        $status         = "waiting";
        $dibuat         = $this->session->userdata('id_karyawan');
        $nama           = $this->session->userdata('nama_lengkap');
        $ajukan         = $this->input->post('pr_diajukan');
        $nama_pt        = $this->input->post('nama_pt');

        if($ajukan == ''){
            $diajukan = $nama;
        }else{
            $diajukan = $ajukan;
        }
        date_default_timezone_set("Asia/Jakarta");
        $date       = date("Y-m-d");
        $tgl_input  = date("Y-m-d H:i:s");
        $input = array(
            'no_pr'     => $no_pr,
            'pr_input'  => $dibuat,
            'nama_input'=> $nama,
            'tgl_pr'    => $date,
            'status_pr' => $status_pr,
            'status'    => $status,
            'pr_diajukan'=> $diajukan,
            'kota_pr'   => $kota,
            'nama_pt'   => $nama_pt,
        );
        if(!empty($_FILES['file']['name']))
            {
                $upload = $this->M_permintaan->_do_upload();
                $input['file'] = $upload;
            }
        $this->db->insert('abe_permintaan',$input);
        $query_id = $this->db->query("SELECT id_permintaan FROM abe_permintaan ORDER BY id_permintaan DESC LIMIT 1")->row_array();
        $update = array('id_pr'=>$query_id['id_permintaan']);
        $nilai = 0;
        $this->db->where('id_pr', $nilai AND 'kota',$kota);
        $this->db->update('abe_permintaan_detail',$update);
        
    }

    function edit_pr($data)
    {    
        $no_pr      = $this->input->post('no_pr');
        $nama       = $this->session->userdata('nama_lengkap');
        $ajukan     = $this->input->post('pr_diajukan');
        $nama_pt    = $this->input->post('nama_pt');
        if($ajukan == ''){
            $diajukan = $nama;
        }else{
            $diajukan = $this->input->post('pr_diajukan');
        }
        $id_permintaan = $this->input->post('id_permintaan');
        $input = array(
            'pr_diajukan'   =>$diajukan,
            'id_permintaan' =>$id_permintaan,
            'nama_pt'       => $nama_pt
        );
        if(!empty($_FILES['file']['name']))
            {
                $this->db->where('id_permintaan',$id_permintaan); 
                $query = $this->db->get('abe_permintaan');
                $row = $query->row();
                unlink("./assets/lampiran_pr/$row->file");

                $upload = $this->M_permintaan->_do_upload();
                $input['file'] = $upload;
            }
        $this->db->where('id_permintaan',$id_permintaan);
        $this->db->update('abe_permintaan',$input);        
    }

    function ambil_pr()
    {
        $id = $this->uri->segment(4);
        $sql = "SELECT * FROM abe_permintaan WHERE id_permintaan = '$id'";  
        return $this->db->query($sql);
    }

    public function hapus_pr()
    {
        $id = $this->uri->segment(4);
        $this->db->where('id_permintaan', $id);
        $this->db->delete('abe_permintaan');
        $this->db->where('id_pr', $id);
        $this->db->delete('abe_permintaan_detail');
    }

    public function proses_mengetahui()
    {
        $id         = $this->uri->segment(4);
        $status_pr  = 'diketahui';
        $status     = 'on proces';
        $nama_ketahui = $this->session->userdata('nama_lengkap');
        $id_user    = $this->session->userdata('id_karyawan');
        $data       = array('status_pr'=>$status_pr,'status'=>$status,'pr_diketahui'=>$id_user,'nama_diketahui'=>$nama_ketahui);
        $data2      = array('status'=>$status);
        $this->db->where('id_permintaan',$id);
        $this->db->update('abe_permintaan',$data);
        $this->db->where('id_pr',$id);
        $this->db->update('abe_permintaan_detail',$data2);
    }

    public function proses_menyetujui()
    {
        //$id = $this->uri->segment(4);
        $id = $this->input->post('id_permintaan');
        $status = $this->input->post('status');
        $catatan = $this->input->post('catatan');
        $tgl_proses = date('Y-m-d');
        $nama_setuju = $this->session->userdata('nama_lengkap');
        $id_user = $this->session->userdata('id_karyawan');
        //$status1 = 'disetujui';
        $data = array('status_pr'=>$status,'nama_setuju'=>$nama_setuju,'pr_disetujui'=>$id_user,'status_proses'=>$status,'catatan'=>$catatan,'tgl_proses'=>$tgl_proses);
        $this->db->where('id_permintaan',$id);
        $this->db->update('abe_permintaan',$data);
        $data2 = array('status'=>$status);
        $this->db->where('id_pr',$id);
        $this->db->update('abe_permintaan_detail',$data2);
    }

    public function proses_selesai()
    {
        $id = $this->uri->segment(4);
        $status = 'selesai';
        $data = array('status_pr'=>$status);
        $this->db->where('id_permintaan',$id);
        $this->db->update('abe_permintaan',$data);
    }

    public function ambil_id_detail($id)
    {
        $this->db->from('abe_permintaan_detail');
        $this->db->where('id_pr_detail',$id);
        $query = $this->db->get();
        return $query->row();
    }

    function ubah_status_detail($data)
    {    
        $keterangan = $this->input->post('keterangan_status');
        $status     = $this->input->post('status');
        $id = $this->input->post('id');
        $input = array(
            'status'            =>$status,
            'keterangan_status' =>$keterangan
        );
        $this->db->where('id_pr_detail',$id);
        $this->db->update('abe_permintaan_detail',$input);        
    }

    public function save_lampiran($data)
    {
        $this->db->insert('abe_permintaan_lampiran', $data);
        return $this->db->insert_id();
    }

    public function save_po($data)
    {
        $this->db->insert('abe_permintaan_po', $data);
        return $this->db->insert_id();
    }

    public function id_lampiran($id)
    {
        $this->db->from('abe_permintaan_lampiran');
        $this->db->where('id_permintaan_lampiran',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function hapus_lampiran($id)
    {
        $this->db->where('id_permintaan_lampiran', $id);
        $this->db->delete('abe_permintaan_lampiran');
    }

    public function hapus_po($id)
    {
        $this->db->where('id_pr_po', $id);
        $this->db->delete('abe_permintaan_po');
    }

}