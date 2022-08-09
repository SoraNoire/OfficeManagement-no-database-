<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reminder extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        chekAksesModule();
        $this->load->model('M_reminder');
        $this->load->library('Pdf');
        if($this->session->userdata('id_karyawan') == ''){
            redirect('');
        }
    }

    public function index()
    {   
        $this->template->load('template','reminder/data_reminder');
    }

    public function add_reminder()
    {
        date_default_timezone_set("Asia/Jakarta");
        $today          = date('Y-m-d H:i:s');
        $input          = $this->session->userdata('id_karyawan');
        $kategori       = $this->input->post('kategori');
        $nomor_dokumen  = $this->input->post('nomor_dokumen');
        $detail         = $this->input->post('detail');
        $catatan        = $this->input->post('catatan');
        $lama_waktu     = $this->input->post('lama_waktu');
        $tgl_akhir      = date('Y-m-d', strtotime($this->input->post('tgl_akhir')));
        $tgl_aktif      = date('Y-m-d', strtotime($this->input->post('tgl_aktif')));
        $data = array(
                'kategori'      => $kategori,
                'nomor_dokumen' => $nomor_dokumen,
                'detail'        => $detail,
                'catatan'       => $catatan,
                'tgl_aktif'     => $tgl_aktif,
                'tgl_akhir'     => $tgl_akhir,
                'lama_waktu'    => $lama_waktu,
                'tgl_buat'      => $today,
                'id_input'      => $input
            );
        $this->M_reminder->save_reminder($data);
        $this->session->set_flashdata('sukses','Data Reminder Berhasil Di buat<br> Terimakasih');
        redirect('user/reminder');
    }

    public function update_reminder()
    {
        date_default_timezone_set("Asia/Jakarta");
        $today          = date('Y-m-d H:i:s');
        $input          = $this->session->userdata('id_karyawan');
        $kategori       = $this->input->post('kategori');
        $nomor_dokumen  = $this->input->post('nomor_dokumen');
        $detail         = $this->input->post('detail');
        $catatan        = $this->input->post('catatan');
        $lama_waktu     = $this->input->post('lama_waktu');
        $tgl_akhir      = date('Y-m-d', strtotime($this->input->post('tgl_akhir')));
        $tgl_aktif      = date('Y-m-d', strtotime($this->input->post('tgl_aktif')));
        $id_reminder    = $this->input->post('id_reminder');
        $data = array(
                'nomor_dokumen' => $nomor_dokumen,
                'detail'        => $detail,
                'catatan'       => $catatan,
                'tgl_aktif'     => $tgl_aktif,
                'tgl_akhir'     => $tgl_akhir,
                'lama_waktu'    => $lama_waktu,
                'tgl_update'    => $today,
                'id_input'      => $input
            );
        $this->M_reminder->update_reminder($data, $id_reminder);
        $this->session->set_flashdata('sukses','Data Reminder Berhasil Di Update / Di perbaharui<br> Terimakasih');
        redirect('user/reminder');
    }

}
