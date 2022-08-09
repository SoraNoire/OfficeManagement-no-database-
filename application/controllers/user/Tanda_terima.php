<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tanda_terima extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        chekAksesModule();
        $this->load->model('M_tanda_terima');
        //$this->load->library('Pdf');
        if ($this->session->userdata('id_karyawan') == '') {
            redirect('');
        }
    }

    public function index()
    {
        $this->template->load('template', 'surat/data_tanda_terima');
    } 

    public function proses()
    {
        date_default_timezone_set("Asia/Jakarta");
        $nomor_surat = $this->M_tanda_terima->get_kode_tt();
        $divisi     = $this->input->post('divisi');
        $tgl        = date('Y-m-d H:i:s');
        $nama_user  = $this->session->userdata('nama_lengkap');
        $id_user    = $this->session->userdata('id_karyawan');
        $perusahaan = $this->input->post('perusahaan');
        $dokumen     = $this->input->post('dokumen');
        $id_penerima = $this->input->post('karyawan');
        $nama_penerima = $this->input->post('karyawan');
        $data = array(
            'nomor_tanda_terima'    => $nomor_surat,
            'divisi'                => $divisi,
            'perusahaan'            => $perusahaan,
            'nama_dokumen'          => $dokumen,
            'tgl_input'             => $tgl,
            'id_pemberi'            => $id_user,
            'nama_pemberi'          => $nama_user,
            'status'                => 'input',
            'id_penerima'           => $id_penerima,
            'nama_penerima'         => $nama_penerima,
        ); 
        // $this->M_tanda_terima->save_tt($data);
        // $this->session->set_flashdata('sukses', 'Tanda Terima Anda berhasil dibuat');
        // redirect();
        $tgl_sekarang   = new DateTime(date('Y-m-d H:i:s'));
        $cek_tgl        = $this->db->query("SELECT id_tanda_terima, tgl_input, nama_pemberi FROM abe_tanda_terima WHERE nama_pemberi = '$nama_user' ORDER BY id_tanda_terima DESC LIMIT 1")->row_array();
        $awal           = new DateTime($cek_tgl["tgl_input"]);
        $selisih        = $awal->diff($tgl_sekarang); 
        $selisih_jam    = $selisih->h;
        $selisih_mnt    = $selisih->i;
        $selisih_dtk    = $selisih->s;
        if($selisih_jam == 0 AND $selisih_mnt == 0 AND $selisih_dtk < 10){
            $this->session->set_flashdata('sukses', 'Tanda Terima Anda berhasil dibuat');
            redirect();
        }else{
            $this->M_tanda_terima->save_tt($data);
            $this->session->set_flashdata('sukses', 'Tanda Terima Anda berhasil dibuat');
            redirect();
        }
    }

    public function update()
    {
        date_default_timezone_set("Asia/Jakarta");
        $id_tt                 = $this->input->post('nomor_tanda_terima');
        $tgl                = date('Y-m-d H:i:s');
        $status             = $this->input->post('status');
        $keterangan_status  = $this->input->post('keterangan');
        $data = array(
            'tgl_proses'        => $tgl,
            'status'            => $status,
            'keterangan_status' => $keterangan_status,
        ); 
        $this->M_tanda_terima->update_tt($id_tt, $data);
        $this->session->set_flashdata('sukses', 'Tanda Terima Anda berhasil diupdate');
        redirect('user/tanda_terima');
    }

    public function hapus_nomor()
    {
        $id   = $this->uri->segment(4);
        $this->M_tanda_terima->hapus_nomor($id);
        $this->session->set_flashdata('sukses','Tanda Terima Berhasil Di hapus<br> Terimakasih');
        redirect('user/tanda_terima');
    }
}
