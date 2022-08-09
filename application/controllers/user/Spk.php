<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spk extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        chekAksesModule();
        $this->load->model('M_spk');
        $this->load->library('Pdf');
        if($this->session->userdata('id_karyawan') == ''){
            redirect('');
        }
    }

    public function index()
    {   
        $this->template->load('template','spk/data_spk');
    }

    public function add_lokasi()
    {
        $lokasi     = $this->input->post('lokasi_rapat');
        $sess_lok['lokasi'] = $this->input->post('lokasi_rapat');
        $this->session->set_userdata($sess_lok);
        if($lokasi == 'null'){
            $this->session->set_flashdata('sukses','Mohon Pilih Lokasi perbaikan terlebih dahulu<br> Sebelum membuat SPK IT<br> Terimakasih');
            redirect('user/spk');
        }else{
            header('location:'.base_url().'user/spk/create/'.$lokasi);
        }
    }

    public function add_divisi()
    {
        $divisi         = $this->input->post('divisi');
        $karyawan       = $this->input->post('karyawan');
        $sess_lok['divisi']     = $this->input->post('divisi');
        $sess_lok['karyawan']   = $this->input->post('karyawan');
        $this->session->set_userdata($sess_lok);
        header('location:'.base_url().'user/spk/create/'.$divisi);
    }

    public function create_IT()
    {   
        $data['no_spk'] = $this->M_spk->get_kode_spk();
        $this->template->load('template','spk/form_create_spk',$data);        
    }
 
    public function create()
    {   
        $data['no_spk'] = $this->M_spk->get_kode_spk();
        $this->template->load('template','spk/form_create_spk_all',$data);        
    }

    public function proses()
    {
        $id = $this->session->userdata('id_karyawan');
        $sql_detail = $this->db->query("SELECT * FROM abe_spk_detail WHERE id_user = '$id' and id_spk = '0'")->num_rows();
        if($sql_detail == '0'){
            $this->session->set_flashdata('gagal','pastikan Detail SPK di isi terlebih dahulu');
            redirect('user/spk/create/'.$this->session->userdata('divisi'));
        }else{
            date_default_timezone_set("Asia/Jakarta");
            $no_spk     = $this->M_spk->get_kode_spk();
            $divisi     = $this->session->userdata('divisi');
            $lokasi     = $this->session->userdata('posisi');
            $tgl        = date('Y-m-d H:i:s');
            $deadline   = date('Y-m-d', strtotime($this->input->post('deadline')));
            $id_user    = $this->session->userdata('id_karyawan');
            $nama_user  = $this->session->userdata('nama_lengkap');
            $nama_karyawan = $this->input->post('nama_user');
            $id_karyawan   = $this->session->userdata('karyawan');
            $notulen    = $this->input->post('notulen');
            $data = array(
                    'no_spk'        => $no_spk,
                    'divisi'        => $divisi,
                    'tgl_input'     => $tgl,
                    'tgl_target'    => $deadline,
                    'id_user_input' => $id_user,
                    'nama_user'     => $nama_user,
                    'id_karyawan'   => $id_karyawan,
                    'lokasi'        => $lokasi,
                    'nama_karyawan' => $nama_karyawan,
                    'notulen_rapat' => $notulen,
                    'status_spk'    => 'NEW',
                );
            $this->M_spk->save_spk($data);
            $sql_spk    = $this->db->query("SELECT id_spk from abe_spk_all ORDER BY id_spk DESC LIMIT 1")->row_array();
            $id_spk     = $sql_spk['id_spk'];
            $data2 = array(
                'id_spk'      => $id_spk,
                'no_spk'      => $no_spk,
                'status_spk'  => 'NEW',
                'tgl_status'  => $tgl,
            );
            $this->M_spk->save_history_spk($data2);
            $data3 = array('id_spk'=> $id_spk);
            $this->M_spk->update_detail($data3);
            $this->session->set_flashdata('sukses','Data SPK Berhasil Di buat dan segera di proses pihak terkait<br> Terimakasih');
            redirect('user/spk');
        }
    }

    public function hapus()
    {
        $id   = $this->uri->segment(4);
        $this->M_spk->hapus_spk($id);
        $this->session->set_flashdata('sukses','Data SPK Berhasil Di hapus<br> Terimakasih');
        redirect('user/spk');
    }

    public function spk()
    {   
        $this->template->load('template','spk/data_spk_user');
    }

    public function spk_it()
    {   
        $this->template->load('template','spk/data_spk_it');
    }

    public function spk_hrd()
    {   
        $this->template->load('template','spk/data_spk_hrd');
    }

    public function spk_all()
    {   
        $this->template->load('template','spk/data_spk_all');
    }

    public function add_kategori()
    {
        date_default_timezone_set("Asia/Jakarta");
        $id_spk     = $this->input->post('id_spk');
        $no_spk     = $this->input->post('no_spk');
        $kategori   = $this->input->post('kategori');
        $tgl        = date('Y-m-d H:i:s');
        $data = array(
                'kategori_spk' => $kategori,
                'status_spk'=> 'READ',
            );
        $this->M_spk->update_spk($data,$id_spk);
        $data2 = array(
            'id_spk'      => $id_spk,
            'no_spk'      => $no_spk,
            'status_spk'  => 'READ',
            'tgl_status'  => $tgl,
            'id_user'     => $this->session->userdata('id_karyawan'),
            'nama_user'   => $this->session->userdata('nama_lengkap'),
            'divisi'      => $this->session->userdata('department'),
        );
        $this->M_spk->save_history_spk($data2);
        $data3 = array('status'=> 'READ');
        $this->M_spk->read_detail_spk($data3, $id_spk);
        $this->session->set_flashdata('sukses','Data SPK Berhasil Di ubah kategori permasalahan<br> Terimakasih');
        redirect('user/spk/spk');
    }

    public function read_spk()
    {
        date_default_timezone_set("Asia/Jakarta");
        $id_spk     = $this->uri->segment(4);
        $sql        = $this->db->query("SELECT id_spk, no_spk FROM abe_spk_all WHERE id_spk = '$id_spk'")->row_array();
        $no_spk     = $sql['no_spk'];
        //$kategori   = $this->input->post('kategori');
        $tgl        = date('Y-m-d H:i:s');
        $data = array(
                'status_spk'=> 'READ',
            );
        $this->M_spk->update_spk($data,$id_spk);
        $data2 = array(
            'id_spk'      => $id_spk,
            'no_spk'      => $no_spk,
            'status_spk'  => 'READ',
            'tgl_status'  => $tgl,
            'id_user'     => $this->session->userdata('id_karyawan'),
            'nama_user'   => $this->session->userdata('nama_lengkap'),
            'divisi'      => $this->session->userdata('department'),
        );
        $this->M_spk->save_history_spk($data2);
        $data3 = array('status'=> 'READ');
        $this->M_spk->read_detail_spk($data3, $id_spk);
        $this->session->set_flashdata('sukses','Data SPK sudah di baca<br> Terimakasih');
        redirect('user/spk/spk');
    }

    public function proses_spk()
    {
        date_default_timezone_set("Asia/Jakarta");
        $id         = $this->uri->segment(4);
        $sql_detail = $this->db->query("SELECT * FROM abe_spk_detail WHERE id_spk_detail = '$id'")->row_array();
        $keterangan = $sql_detail['detail'];
        $id_spk     = $sql_detail['id_spk'];
        $sql_spk    = $this->db->query("SELECT no_spk, id_spk from abe_spk_all WHERE id_spk = '$id_spk'")->row_array();
        $no_spk     = $sql_spk['no_spk'];
        $tgl    = date('Y-m-d H:i:s');

        $data   = array('status_spk'=> 'PROSES');
        $data2  = array(
            'id_spk'      => $id_spk,
            'no_spk'      => $no_spk,
            'status_spk'  => 'PROSES',
            'keterangan'  => $keterangan,
            'tgl_status'  => $tgl,
            'id_user'     => $this->session->userdata('id_karyawan'),
            'nama_user'   => $this->session->userdata('nama_lengkap'),
            'divisi'      => $this->session->userdata('department'),
        );
        $data3  = array('status'=> 'PROSES');
        
        $this->M_spk->update_spk($data,$id_spk);
        $this->M_spk->save_history_spk($data2);
        $this->M_spk->proses_detail_spk($data3, $id);
        $this->session->set_flashdata('sukses','Status SPK Berhasil Di ubah<br> Terimakasih');
        redirect('user/spk/spk');
    }

    public function pending_spk()
    {
        date_default_timezone_set("Asia/Jakarta");
        $id_spk     = $this->input->post('id_spk');
        $no_spk     = $this->input->post('no_spk');
        $alasan     = $this->input->post('alasan');
        $id_detail  = $this->input->post('id_detail');
        $tgl        = date('Y-m-d H:i:s');
        $data3 = array(
                'status'    => 'PENDING',
                'pending'   => $alasan,
            );
        //$this->M_spk->update_spk($data,$id_spk);
        $data2 = array(
            'id_spk'      => $id_spk,
            'no_spk'      => $no_spk,
            'status_spk'  => 'PENDING',
            'keterangan'  => $alasan,
            'tgl_status'  => $tgl,
            'id_user'     => $this->session->userdata('id_karyawan'),
            'nama_user'   => $this->session->userdata('nama_lengkap'),
            'divisi'      => $this->session->userdata('department'),
        );
        $this->M_spk->save_history_spk($data2);
        $this->M_spk->proses_detail_spk($data3,$id_detail);
        $this->session->set_flashdata('sukses','Status SPK Berhasil Di ubah<br> Terimakasih');
        redirect('user/spk/spk');
    }

    public function selesai_spk()
    {
        date_default_timezone_set("Asia/Jakarta");
        $id_spk         = $this->input->post('id_spk');
        $no_spk         = $this->input->post('no_spk');
        $penyelesaian   = $this->input->post('penyelesaian');
        $id_detail      = $this->input->post('id_detail');
        $tgl            = date('Y-m-d H:i:s');
        $data3 = array(
                'status'    => 'SELESAI',
                'selesai'   => $penyelesaian,
            );
        $data2 = array(
            'id_spk'      => $id_spk,
            'no_spk'      => $no_spk,
            'status_spk'  => 'SELESAI',
            'keterangan'  => $penyelesaian,
            'tgl_status'  => $tgl,
            'id_user'     => $this->session->userdata('id_karyawan'),
            'nama_user'   => $this->session->userdata('nama_lengkap'),
            'divisi'      => $this->session->userdata('department'),
        );
        $this->M_spk->save_history_spk($data2);
        $this->M_spk->proses_detail_spk($data3,$id_detail);
        $this->session->set_flashdata('sukses','Status SPK Berhasil Di ubah & Sudah Selesai<br> Terimakasih');
        redirect('user/spk/spk');
    }

    public function selesai()
    {   
        $id     = $this->uri->segment(4);
        $sql_detail = $this->db->query("SELECT * FROM abe_spk_detail WHERE id_spk = '$id' AND status != 'SELESAI' ")->num_rows();
        if($sql_detail > 0){
            $this->session->set_flashdata('gagal','Pastikan semua permasalahan sudah berstatus SELESAI');
            redirect('user/spk/spk');
        }else{
            $data['record'] = $this->M_spk->ambil_spk()->row_array();
            $this->template->load('template','spk/form_spk_selesai',$data);
        }
         
    }

    public function selesai_spk_all()
    {
        date_default_timezone_set("Asia/Jakarta");
        $id_spk         = $this->input->post('id_spk');
        $no_spk         = $this->input->post('no_spk');
        $penyelesaian   = $this->input->post('penyelesaian');
        //$id_detail      = $this->input->post('id_detail');
        $tgl            = date('Y-m-d H:i:s');
        $data = array(
                'status_spk'    => 'SELESAI',
                'penyelesaian'  => $penyelesaian,
                'tgl_selesai'   => $tgl,
            );
        $data2 = array(
            'id_spk'      => $id_spk,
            'no_spk'      => $no_spk,
            'status_spk'  => 'SELESAI',
            'keterangan'  => $penyelesaian,
            'tgl_status'  => $tgl,
            'id_user'     => $this->session->userdata('id_karyawan'),
            'nama_user'   => $this->session->userdata('nama_lengkap'),
            'divisi'      => $this->session->userdata('department'),
        );
        $this->M_spk->update_spk($data,$id_spk);
        $this->M_spk->save_history_spk($data2);
        //$this->M_spk->proses_detail_spk($data3,$id_detail);
        $this->session->set_flashdata('sukses','Status SPK Berhasil Di ubah & Sudah Selesai<br> Terimakasih');
        redirect('user/spk/spk');
    }

    public function detail()
    {   
        $data['record'] = $this->M_spk->ambil_spk()->row_array();
        $this->template->load('template','spk/detail_spk',$data);        
    }

    public function edit()
    {   
        $data['record'] = $this->M_spk->ambil_spk()->row_array();
        $this->template->load('template','spk/edit_spk',$data);        
    }

    public function mengetahui_spk()
    {
        date_default_timezone_set("Asia/Jakarta");
        $id_spk     = $this->uri->segment(4);
        $id_user    = $this->session->userdata('id_karyawan');
        $nama_user  = $this->session->userdata('nama_lengkap');
        $tgl        = date('Y-m-d H:i:s');
        $data = array(
                'tgl_hrd' => $tgl,
                'hrd_app' => $id_user,
                'nama_hrd'=> $nama_user,
            );
        $this->M_spk->update_spk($data,$id_spk);
        $this->session->set_flashdata('sukses','Status SPK Berhasil Di ubah<br> Terimakasih');
        redirect('user/spk/spk_hrd');
    }

    public function menyetujui_spk()
    {
        date_default_timezone_set("Asia/Jakarta");
        $id_spk     = $this->uri->segment(4);
        $id_user    = $this->session->userdata('id_karyawan');
        $nama_user  = $this->session->userdata('nama_lengkap');
        $tgl        = date('Y-m-d H:i:s');
        $data = array(
                'tgl_bos' => $tgl,
                'bos_app' => $id_user,
                'nama_bos'=> $nama_user,
            );
        $this->M_spk->update_spk($data,$id_spk);
        $this->session->set_flashdata('sukses','Status SPK Berhasil Di ubah<br> Terimakasih');
        redirect('user/spk/spk_all');
    }

    public function dataDetail(){
        //$no_rapat = $this->M_rapat->get_kode_rapat();
        $id_karyawan    = $_GET['id_karyawan'];
        $id_spk         = $_GET['id_spk'];
        echo "<table class='table table-bordered table-striped' >
                <thead>
                  <tr>
                    <th width='30px'>No</th>
                    <th>Detail</th>
                    <th>Status</th>
                    <th width='220px'>Aksi</th>
                  </tr>
                </thead>";
            $sql_jobdesk    = "SELECT * FROM abe_spk_detail WHERE id_user = '$id_karyawan' AND id_spk = '$id_spk'";
            $jobdesk        = $this->db->query($sql_jobdesk)->result();
            if(empty($jobdesk)){
                echo "<tr><td colspan='4'><center>Belum ada Detail SPK</center></td></tr>";
            }else{
                $no = 1;
                foreach ($jobdesk as $row) {
                    echo "<tr><td>$no</td>";
                    echo "<td>$row->detail</td>";
                    echo "<td>$row->status</td>";
                    echo "<td><a href='#' onclick='delete_detail($row->id_spk_detail)' class='btn btn-xs btn-danger' title='hapus jobdesk'><i class='fa fa-trash'></i> Hapus</a>";
                    echo "<a href='#' onclick='edit_detail($row->id_spk_detail)' class='btn btn-xs btn-warning' title='edit jobdesk'><i class='fa fa-edit'></i> Edit</a>
                          </td></tr>";
                    $no++;
                }
            }
        echo "</table>";
    }

    public function dataButton(){
        echo "<button type='submit' class='btn btn-sm btn-success'><i class='fa fa-save'></i> Proses</button>";
    }

    public function add_detail()
    {
        $data = array(
                'detail'    => $this->input->post('detail'),
                'id_spk'    => $this->input->post('id_spk'),
                'id_user'   => $this->input->post('id_input'),
                'status'    => $this->input->post('status'),
            );
        $insert = $this->M_spk->save_detail($data);
        echo json_encode(array("status" => TRUE));
    }

    public function edit_detail($id)
    {
        $data = $this->M_spk->get_id_detail($id);
        echo json_encode($data);
    }

    public function update_detail()
    {
        $id_spk = $this->input->post('id');
        $data   = array('detail' => $this->input->post('detail'));
        $this->M_spk->proses_detail_spk($data,$id_spk);
        echo json_encode(array("status" => TRUE));
    }

    public function hapus_detail($id)
    {       
        $this->M_spk->hapus_detail($id);
        echo json_encode(array("status" => TRUE));
    }
}
