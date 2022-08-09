<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ekspedisi extends CI_Controller {
    
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
        $this->template->load('template','pengiriman/ekspedisi/data_ekspedisi');
    }

    public function create()
    {   
        if (isset($_POST['submit'])){
            $karyawan   = $this->session->userdata('id_karyawan');
            $status     = 'aktif';
            $ekspedisi  = $this->input->post('nama_ekspedisi');
            $data = array(
                    'id_input'  => $karyawan,
                    'status'    => $status,
                    'nama_ekspedisi' => $ekspedisi,
                );
            $this->M_pengiriman->save_ekspedisi($data);
            $this->M_pengiriman->tambah_ekspedisi($_POST);
            $this->session->set_flashdata('sukses','Data Ekspedisi baru berhasil di buat<br>Terimakasih');
            redirect ('pengiriman/ekspedisi');
        }else{
            $this->template->load('template','pengiriman/ekspedisi/form_tambah_ekspedisi');
        }
        
    }

    public function edit()
    {   
        if (isset($_POST['submit'])){
            $id_ekspedisi = $this->input->post('id_ekspedisi');
            $ekspedisi  = $this->input->post('nama_ekspedisi');
            $data = array( 'nama_ekspedisi' => $ekspedisi );
            $this->db->where('id_ekspedisi',$id_ekspedisi);
            $this->db->update('abe_ekspedisi',$data);


            $this->M_pengiriman->edit_ekspedisi($_POST);
            $this->session->set_flashdata('sukses','Permintaan Anda Berhasil Di ubah<br> menunggu validasi dari bagian terkait<br>Terimakasih');
            redirect ('pengiriman/ekspedisi');
        }else{
            $data['record'] = $this->M_pengiriman->ambil_ekspedisi()->row_array();
            $this->template->load('template','pengiriman/ekspedisi/form_edit_ekspedisi',$data);
        }
    }

    public function detail()
    {   
        $data['record'] = $this->M_pengiriman->ambil_ekspedisi()->row_array();
        $this->template->load('template','pengiriman/ekspedisi/form_detail_ekspedisi',$data);
        
    }

}
