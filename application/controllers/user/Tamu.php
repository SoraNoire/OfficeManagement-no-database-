<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tamu extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        //chekAksesModule();
        $this->load->model('M_tamu');
        $this->load->library('Pdf');
        if ($this->session->userdata('id_karyawan') == '') {
            redirect('');
        }
    }

    public function index()
    {
        $this->template->load('template', 'tamu/data_tamu');
    }

    public function add_tamu()
    {
        //$lokasi     = $this->session->userdata('lokasi');
        date_default_timezone_set("Asia/Jakarta");
        //$tgl        = date('Y-m-d');
        //$jam        = date('H:i:s');
        $tgl        = date('Y-m-d', strtotime($this->input->post('tgl_tamu')));
        $jam        = date('H:i:s', strtotime($this->input->post('jam_tamu')));
        $id_input   = $this->session->userdata('id_karyawan');
        $nama_input = $this->session->userdata('nama_lengkap');
        $nama       = $this->input->post('nama_tamu');
        $jumlah     = $this->input->post('jumlah_tamu');
        $perusahaan = $this->input->post('nama_perusahaan');
        $keperluan  = $this->input->post('keperluan');
        $user_tujuan = $this->input->post('user_tujuan');
        $keterangan = $this->input->post('keterangan');
        $data = array(
            'nama_tamu'   => $nama,
            'jumlah_tamu' => $jumlah,
            'perusahaan'  => $perusahaan,
            'keperluan'   => $keperluan,
            'user_tujuan' => $user_tujuan,
            'tgl_tamu'    => $tgl,
            'jam_masuk' => $jam,
            'keterangan' => $keterangan,
            'id_input'  => $id_input,
            'nama_input' => $nama_input,
            'status_tamu' => 'OPEN'
        );
        $this->M_tamu->save_tamu($data);
        $this->session->set_flashdata('sukses', 'Data Tamu Berhasil Di buat<br> Terimakasih');
        redirect('user/tamu');
    }

    public function selesai()
    {
        date_default_timezone_set("Asia/Jakarta");
        $id_tamu    = $this->uri->segment(4);
        $jam        = date('H:i:s');
        $data = array(
            'jam_keluar' => $jam,
            'status_tamu' => 'CLOSE',
        );
        $this->M_tamu->update_tamu($data, $id_tamu);
        $this->session->set_flashdata('sukses', 'Status Tamu Berhasil Di ubah<br> Terimakasih');
        redirect('user/tamu');
    }

    public function selesai_tamu()
    {
        date_default_timezone_set("Asia/Jakarta");
        $id_tamu    = $this->input->post('id_tamu');
        $jam        = date('H:i:s', strtotime($this->input->post('jam_tamu')));
        $data = array(
            'jam_keluar' => $jam,
            'status_tamu' => 'CLOSE',
        );
        $this->M_tamu->update_tamu($data, $id_tamu);
        $this->session->set_flashdata('sukses', 'Status Tamu Berhasil Di ubah<br> Terimakasih');
        redirect('user/tamu');
    }
}
