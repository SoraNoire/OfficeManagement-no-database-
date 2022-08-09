<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_Jalan extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        //chekAksesModule();
        $this->load->model('M_pengiriman');
        if($this->session->userdata('id_karyawan') == ''){
            redirect('');
        }
    }

    public function index()
    {   
        $this->template->load('template','pengiriman/surat_jalan/data_surat_jalan');
    }

    public function data()
    {   
        $this->template->load('template','pengiriman/surat_jalan/data_surat_jalan_2');
    }

    public function create()
    {   
        if (isset($_POST['submit'])){
            $this->M_pengiriman->tambah_sj($_POST);
            $this->session->set_flashdata('sukses','Data Surat Jalan berhasil di buat<br>Terimakasih');
            redirect ('pengiriman/surat_jalan');
        }else{
            $data['no_sj'] = $this->M_pengiriman->get_kode_sj();
            $this->template->load('template','pengiriman/surat_jalan/form_tambah_sj',$data);
        }
        
    }

    public function hapus()
    {   
        $id     = $this->uri->segment(4);
        $sql    = "SELECT id_sj, no_sj FROM abe_surat_jalan WHERE id_sj = '$id'";
        $nomor  = $this->db->query($sql)->row_array();
        $no_sj  = $nomor['no_sj'];
        $this->M_pengiriman->hapus_detail_sj($no_sj);
        $this->M_pengiriman->hapus_history_sj($no_sj);
        $this->M_pengiriman->hapus_sj($id);
        $this->session->set_flashdata('sukses','Surat Jalan sudah berhasil di Hapus<br>Terimakasih');
        $this->template->load('template','pengiriman/surat_jalan/data_surat_jalan');
    }

    public function kirim()
    {
        $id         = $this->input->post('id');
        $status     = 'proses kirim operasional';
        $id_input   = $this->session->userdata('id_karyawan');
        $input      = $this->session->userdata('nama_lengkap');
        date_default_timezone_set("Asia/Jakarta");
        $date       = date("Y-m-d H:i:s");      
        $data = array(
                'nama_petugas'  => $this->input->post('pengirim'),
                'nama_input'    => $input,
                'id_input'      => $id_input,
                'catatan'       => $this->input->post('catatan'),
                'tgl_input'     => $date,
                'status'        => $status,
                'no_sj'         => $id,
            );
        $data_update = array(
                'nama_pengirim' => $this->input->post('pengirim'),
                'status_sj'     => $status,
            );
        $this->M_pengiriman->simpan_history($data);
        $this->M_pengiriman->update_sj(array('no_sj' => $id), $data_update);
        echo json_encode(array("status" => TRUE));
    }

    public function sampai()
    {
        $id         = $this->input->post('id');
        $status     = 'dalam proses ekspedisi';
        $id_input   = $this->session->userdata('id_karyawan');
        $input      = $this->session->userdata('nama_lengkap');
        date_default_timezone_set("Asia/Jakarta");
        $date       = date("Y-m-d H:i:s");      
        $data = array(
                'no_dokumen'    => $this->input->post('no_resi'),
                'nama_input'    => $input,
                'id_input'      => $id_input,
                'catatan'       => $this->input->post('catatan'),
                'tgl_input'     => $date,
                'status'        => $status,
                'no_sj'         => $id,

            );
        $data_update = array(
                'no_resi'   => $this->input->post('no_resi'),
                'status_sj' => $status,
            );
        $this->M_pengiriman->simpan_history($data);
        $this->M_pengiriman->update_sj(array('no_sj' => $id), $data_update);
        echo json_encode(array("status" => TRUE));
    }

    public function selesai()
    {
        $id         = $this->input->post('id');
        $status     = 'sudah sampai';
        $id_input   = $this->session->userdata('id_karyawan');
        $input      = $this->session->userdata('nama_lengkap');
        date_default_timezone_set("Asia/Jakarta");
        $date       = date("Y-m-d H:i:s");      
        $data = array(
                'nama_petugas'  => $this->input->post('pengirim'),
                'nama_input'    => $input,
                'id_input'      => $id_input,
                'catatan'       => $this->input->post('catatan'),
                'tgl_input'     => $date,
                'status'        => $status,
                'no_sj'         => $id,

            );
        $data_update = array(
                'status_sj' => $status,
            );
        $this->M_pengiriman->simpan_history($data);
        $this->M_pengiriman->update_sj(array('no_sj' => $id), $data_update);
        echo json_encode(array("status" => TRUE));
    }

    public function detail()
    {   
        //$data['no_pr'] = $this->M_permintaan->get_kode_pr();
        $data['record'] = $this->M_pengiriman->ambil_surat_jalan()->row_array();
        $this->template->load('template','pengiriman/surat_jalan/form_detail_sj',$data);
        
    }

    public function detail_2()
    {   
        //$data['no_pr'] = $this->M_permintaan->get_kode_pr();
        $data['record'] = $this->M_pengiriman->ambil_surat_jalan()->row_array();
        $this->template->load('template','pengiriman/surat_jalan/form_detail_sj_2',$data);
        
    }















    public function mengetahui()
    {   
        $this->template->load('template','permintaan/data_pr_mengetahui');
    }

    public function proses_mengetahui(){
        //$id = $this->uri->segment(4);
        $this->M_permintaan->proses_mengetahui();
        $this->session->set_flashdata('sukses','Permintaan pembelian sudah berhasil di Approve<br>Terimakasih');
        //redirect ('sapi/data_sapi');
        header('location:'.base_url().'permintaan/pr/mengetahui/'); 
    }

    public function menyetujui()
    {   
        $this->template->load('template','permintaan/data_pr_menyetujui');
    }

    public function proses_menyetujui()
    {   
        if (isset($_POST['submit'])){
            $this->M_permintaan->proses_menyetujui($_POST);
            $this->session->set_flashdata('sukses','Permintaan Berhasil sudah di setujui<br> Pihak Purchasing akan segera memprosesnya<br>Terimakasih');
            redirect ('permintaan/pr/menyetujui');
        }else{
            $data['record'] = $this->M_permintaan->ambil_pr()->row_array();
            $this->template->load('template','permintaan/form_menyetujui_permintaan',$data);
        }
    }
}
