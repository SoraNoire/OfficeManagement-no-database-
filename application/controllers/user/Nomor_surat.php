<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nomor_surat extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        chekAksesModule();
        $this->load->model('M_nomor_surat');
        //$this->load->library('Pdf');
        if ($this->session->userdata('id_karyawan') == '') {
            redirect('');
        }
    }

    public function index()
    {
        $this->template->load('template', 'surat/data_nomor_surat');
    } 

    public function proses()
    {
        date_default_timezone_set("Asia/Jakarta");
        $nomor_surat = $this->M_nomor_surat->get_kode_ns();
        $divisi     = $this->input->post('divisi');
        $tgl        = date('Y-m-d H:i:s');
        $nama_user  = $this->session->userdata('nama_lengkap');
        $perusahaan = $this->input->post('perusahaan');
        $tujuan     = $this->input->post('tujuan_surat');
        $perihal    = $this->input->post('perihal');
        $data = array(
            'nomor_surat'   => $nomor_surat,
            'divisi'        => $divisi,
            'perusahaan'    => $perusahaan,
            'tujuan'        => $tujuan,
            'perihal'       => $perihal,
            'tgl_surat'     => $tgl,
            'user_input'    => $nama_user,
        ); 
        $tgl_sekarang   = new DateTime(date('Y-m-d H:i:s'));
        $cek_tgl        = $this->db->query("SELECT id_ns, tgl_surat, user_input FROM abe_nomor_surat WHERE user_input = '$nama_user' ORDER BY id_ns DESC LIMIT 1")->row_array();
        $awal           = new DateTime($cek_tgl["tgl_surat"]);
        $selisih        = $awal->diff($tgl_sekarang); 
        $selisih_jam    = $selisih->h;
        $selisih_mnt    = $selisih->i;
        $selisih_dtk    = $selisih->s;
        if($selisih_jam == 0 AND $selisih_mnt == 0 AND $selisih_dtk < 10){
            // $this->session->set_flashdata('gagal', 'Nomor Surat yang Anda Masukkan <strong>Double</strong><br>Silahkan cek pada Menu Modul Surat - Nomor Surat Internal<br> untuk Melihat Nomor Surat');
            $this->session->set_flashdata('sukses', 'Nomor Surat Anda<br><strong>' . $nomor_surat . '</strong>');
            redirect();
        }else{
            $this->M_nomor_surat->save_ns($data);
            $this->session->set_flashdata('sukses', 'Nomor Surat Anda<br><strong>' . $nomor_surat . '</strong>');
             redirect();
        }
    }

    // public function proses()
    // {
    //     date_default_timezone_set("Asia/Jakarta");
    //     $nomor_surat = $this->M_nomor_surat->get_kode_ns();
    //     $divisi     = $this->input->post('divisi');
    //     $tgl        = date('Y-m-d H:i:s');
    //     $nama_user  = $this->session->userdata('nama_lengkap');
    //     $perusahaan = $this->input->post('perusahaan');
    //     $tujuan     = $this->input->post('tujuan_surat');
    //     $perihal    = $this->input->post('perihal');
    //     $data = array(
    //         'nomor_surat'   => $nomor_surat,
    //         'divisi'        => $divisi,
    //         'perusahaan'    => $perusahaan,
    //         'tujuan'        => $tujuan,
    //         'perihal'       => $perihal,
    //         'tgl_surat'     => $tgl,
    //         'user_input'    => $nama_user,
    //     ); 
    //     $this->M_nomor_surat->save_ns($data);
    //     $this->session->set_flashdata('sukses', 'Nomor Surat Anda<br><strong>' . $nomor_surat . '</strong>');
    //     redirect();
    // }

    public function hapus_nomor()
    {
        $id   = $this->uri->segment(4);
        $this->M_nomor_surat->hapus_nomor($id);
        $this->session->set_flashdata('sukses','Nomor Surat Berhasil Di hapus<br> Terimakasih');
        redirect('user/nomor_surat');
    }
}
