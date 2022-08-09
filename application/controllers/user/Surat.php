<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        chekAksesModule();
        $this->load->model('M_surat');
        $this->load->library('Pdf');
        if($this->session->userdata('id_karyawan') == ''){
            redirect('');
        }
    }

    public function index()
    {   
        $this->template->load('template','surat/data_surat_masuk');
    }

    function data(){
        $table      = 'abe_surat_masuk';
        $primaryKey = 'id_surat_masuk';
        $columns    = array(
            array('db' => 'id_surat_masuk', 'dt' => 'id'),
            array('db' => 'tgl_surat', 'dt' => 'tgl_surat',
                'formatter'=> function($d){
                    $date = TanggalIndo($d);
                    return $date;
                }),
            array('db' => 'asal_surat', 'dt' => 'asal_surat'),
            array('db' => 'tujuan_surat', 'dt' => 'tujuan_surat'),
            array('db' => 'perihal', 'dt' => 'perihal'),
            array('db' => 'pengantar_surat', 'dt' => 'pengantar_surat'),
            array(
                'db' => 'id_surat_masuk',
                'dt' => 'aksi',
                'formatter' => function($k){                 
                       return "<button title=\"detail surat masuk\" class=\"btn btn-xs btn-info\" onclick=\"detail($k)\"><i class=\"fa fa-list\"></i> Detail</button>";  
                })
            ); 

        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
            );

        echo json_encode(
            SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
            );
    }

    public function add_surat_masuk()
    {
        //$lokasi     = $this->session->userdata('lokasi');
        date_default_timezone_set("Asia/Jakarta");
        $tgl        = date('Y-m-d H:i:s');
        $id_input   = $this->session->userdata('id_karyawan');
        $nama_input = $this->session->userdata('nama_lengkap');
        $nomor      = $this->input->post('nomor_surat');
        $asal       = $this->input->post('asal_surat');
        $tgl_surat  = date('Y-m-d', strtotime($this->input->post('tgl_surat')));
        $sifat      = $this->input->post('sifat');
        $perihal    = $this->input->post('perihal');
        $pengantar  = $this->input->post('pengantar');
        $keterangan = $this->input->post('keterangan');
        $tujuan     = $this->input->post('tujuan_surat');
        $data = array(
                'no_surat'          => $nomor,
                'asal_surat'        => $asal,
                'tgl_surat'         => $tgl_surat,
                'tgl_input'         => $tgl,
                'id_input'          => $id_input,
                'nama_input'        => $nama_input,
                'sifat_surat'       => $sifat,
                'perihal'           => $perihal,
                'pengantar_surat'   => $pengantar,
                'keterangan'        => $keterangan,
                'tujuan_surat'      => $tujuan,
            );
        $this->M_surat->save_surat_masuk($data);
        $this->session->set_flashdata('sukses','Data Surat Masuk Berhasil Di buat<br> Terimakasih');
        redirect('user/surat');
    }

    public function detail($id)
    {
        $data = $this->M_surat->get_by_id($id);
        echo json_encode($data);
    }
} 
