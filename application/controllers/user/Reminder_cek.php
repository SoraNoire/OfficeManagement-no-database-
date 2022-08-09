<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reminder_cek extends CI_Controller {
    
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
        $this->template->load('template','reminder/data_reminder_cek');
    }

    public function add_reminder()
    {
        date_default_timezone_set("Asia/Jakarta");
        $today          = date('Y-m-d H:i:s');
        $input          = $this->session->userdata('id_karyawan');
        $bank           = $this->input->post('bank');
        $no_cek         = $this->input->post('no_cek');
        $nama_pt        = $this->input->post('nama_pt');
        $nilai          = $this->input->post('nilai');
        $lama_waktu     = $this->input->post('lama_waktu');
        $tgl_terbit     = date('Y-m-d', strtotime($this->input->post('tgl_terbit')));
        $tgl_expired    = date('Y-m-d', strtotime($this->input->post('tgl_expired')));
        $tujuan_pt      = $this->input->post('tujuan_pt');
        $status         = "baru";
        $catatan        = $this->input->post('catatan');
        $data = array(
                'bank'              => $bank,
                'no_cek'            => $no_cek,
                'nama_pt'           => $nama_pt,
                'nilai'             => $nilai,
                'tgl_cek_terbit'    => $tgl_terbit,
                'tgl_expired'       => $tgl_expired,
                'lama_waktu'        => $lama_waktu,
                'tgl_input'         => $today,
                'id_input'          => $input,
                'tujuan_pt'         => $tujuan_pt,
                'status'            => $status,
                'catatan'           => $catatan,
            );
        $this->M_reminder->save_reminder_cek($data);
        $this->session->set_flashdata('sukses','Data Reminder Cek Berhasil Di buat<br> Terimakasih');
        redirect('user/reminder_cek');
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
        $id_cek    = $this->input->post('id_cek');
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
        $this->M_reminder->update_reminder_cek($data, $id_cek);
        $this->session->set_flashdata('sukses','Data Reminder Cek Berhasil Di Update / Di perbaharui<br> Terimakasih');
        redirect('user/reminder_cek');
    }

}
