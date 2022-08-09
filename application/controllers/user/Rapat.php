<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rapat extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        chekAksesModule();
        $this->load->model('M_rapat');
        $this->load->library('Pdf');
        if($this->session->userdata('id_karyawan') == ''){
            redirect('');
        }
    }

    public function index()
    {   
        $this->template->load('template','rapat/data_rapat');
    }

    public function add_lokasi()
    {
        $lokasi     = $this->input->post('lokasi_rapat');
        $sess_lok['lokasi'] = $this->input->post('lokasi_rapat');
        $this->session->set_userdata($sess_lok);
        if($lokasi == 'null'){
            $this->session->set_flashdata('sukses','Mohon Pilih Lokasi rapat terlebih dahulu<br> Sebelum membuat Notulen Rapat<br> Terimakasih');
            redirect('user/rapat');
        }else{
            header('location:'.base_url().'user/rapat/create/'.$lokasi);
        }
         
    }

    public function create()
    {   
        //$lokasi = $this->uri->segment(4);
        $data['no_rapat'] = $this->M_rapat->get_kode_rapat();
        $this->template->load('template','rapat/form_notulen_rapat',$data);        
    }
 
    public function add_peserta()
    {
        $id_karyawan = $this->input->post('id_karyawan');
        $karyawan = $this->input->post('nama_karyawan');
        $no_rapat = $this->input->post('no_rapat');
        $data = array(
                'id_peserta'   => $id_karyawan,
                'nama_peserta' => $karyawan,
                'id_rapat'     => $no_rapat,
            );
        $this->M_rapat->save_peserta($data);
        echo json_encode(array("status" => TRUE));
    }

    function dataPeserta(){
        //$lokasi = $this->uri->segment(4);
        $no_rapat = $this->M_rapat->get_kode_rapat();
        echo "<table class='table table-bordered table-striped' >
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Peserta Rapat</th>
                    <th width='80px'>Aksi</th>
                  </tr>
                </thead>";
            $sql = "SELECT * FROM abe_rapat_peserta WHERE id_rapat = '$no_rapat'";
            $peserta = $this->db->query($sql)->result();
            if(empty($peserta)){
                echo "<tr><td colspan='3'>Belum ada Peserta Rapat</td></tr>";
            }else{
                $no = 1;
                foreach ($peserta as $row) {
                    echo "<tr><td>$no</td><td>$row->nama_peserta</td>
                          <td>
                            <button type='button' onclick='delete_peserta($row->id_rapat_peserta)' class='btn btn-xs btn-danger' title='hapus'><i class='fa fa-trash'></i></button>
                          </td></tr>";
                    $no++;
                }
            }
        echo "</table>";
    }

    function dataPesertaEdit(){
        $no_rapat = $_GET['no_rapat'];
        echo "<table class='table table-bordered table-striped' >
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Peserta Rapat</th>
                    <th width='80px'>Aksi</th>
                  </tr>
                </thead>";
            $sql = "SELECT * FROM abe_rapat_peserta WHERE id_rapat = '$no_rapat'";
            $peserta = $this->db->query($sql)->result();
            if(empty($peserta)){
                echo "<tr><td colspan='3'>Belum ada Peserta Rapat</td></tr>";
            }else{
                $no = 1;
                foreach ($peserta as $row) {
                    echo "<tr><td>$no</td><td>$row->nama_peserta</td>
                          <td>
                            <button type='button' onclick='delete_peserta($row->id_rapat_peserta)' class='btn btn-xs btn-danger' title='hapus'><i class='fa fa-trash'></i></button>
                          </td></tr>";
                    $no++;
                }
            }
        echo "</table>";
    }

    public function hapus_peserta($id)
    {
        $this->M_rapat->hapus_peserta($id);
        echo json_encode(array("status" => TRUE));
    }

    public function add_mengetahui()
    {
        $id_karyawan = $this->input->post('id_karyawan');
        $karyawan = $this->input->post('nama_karyawan');
        $no_rapat = $this->input->post('no_rapat');
        $data = array(
                'id_mengetahui'     => $id_karyawan,
                'nama_mengetahui'   => $karyawan,
                'id_rapat'          => $no_rapat,
            );
        $this->M_rapat->save_mengetahui($data);
        echo json_encode(array("status" => TRUE));
    }

    function dataMengetahui(){
        $no_rapat = $this->M_rapat->get_kode_rapat();
        echo "<table class='table table-bordered table-striped' >
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Mengetahui</th>
                    <th width='80px'>Aksi</th>
                  </tr>
                </thead>";
            $sql = "SELECT * FROM abe_rapat_mengetahui WHERE id_rapat = '$no_rapat'";
            $mengetahui = $this->db->query($sql)->result();
            if(empty($mengetahui)){
                echo "<tr><td colspan='3'>Belum ada yang mengetahui</td></tr>";
            }else{
                $no = 1;
                foreach ($mengetahui as $row) {
                    echo "<tr><td>$no</td><td>$row->nama_mengetahui</td>
                          <td>
                            <button onclick='delete_mengetahui($row->id_rapat_mengetahui)' class='btn btn-xs btn-danger' title='hapus'><i class='fa fa-trash'></i></button>
                          </td></tr>";
                    $no++;
                }
            }
        echo "</table>";
    }

    public function hapus_mengetahui($id)
    {
        $this->M_rapat->hapus_mengetahui($id);
        echo json_encode(array("status" => TRUE));
    }

    public function dataLampiran(){
        //$no_rapat = $this->M_rapat->get_kode_rapat();
        $no_rapat = $_GET['no_rapat'];
        echo "<table class='table table-bordered table-striped' >
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Lampiran</th>
                    <th width='80px'>Aksi</th>
                  </tr>
                </thead>";
            $sql_lampiran   = "SELECT * FROM abe_rapat_lampiran WHERE id_rapat = '$no_rapat'";
            $sql_rapat      = "SELECT status, no_rapat FROM abe_rapat_new WHERE no_rapat = '$no_rapat'";
            $lampiran = $this->db->query($sql_lampiran)->result();
            $rapat = $this->db->query($sql_rapat)->row_array();
            if(empty($lampiran)){
                echo "<tr><td colspan='3'>Tidak ada Lampiran</td></tr>";
            }else{
                $no = 1;
                foreach ($lampiran as $row) {
                    echo "<tr><td>$no</td><td>$row->nama_lampiran</td>
                          <td>";
                          if($rapat['status'] == 'DRAFT'){
                            echo "<button onclick='delete_lampiran($row->id_rapat_lampiran)' class='btn btn-xs btn-danger' title='hapus lampiran'><i class='fa fa-trash'></i></button>";
                            }
                    echo "<a class='btn btn-xs btn-info' href='".base_url()."assets/lampiran_rapat/$row->file_lampiran' target='blank'><i class='fa fa-eye' title='lihat lampiran'></i></a>
                          </td></tr>";
                    $no++;
                }
            }
        echo "</table>";
    }

    public function add_lampiran()
    {
        $no_rapat = $this->input->post('no_rapat');
        $data = array(
                'nama_lampiran'  => $this->input->post('nama_lampiran'),
                'id_rapat'       => $no_rapat,
            );
        if(!empty($_FILES['file_lampiran']['name']))
            {
                $upload = $this->_do_upload();
                $data['file_lampiran'] = $upload;
            }
        $insert = $this->M_rapat->save_lampiran($data);
        echo json_encode(array("status" => TRUE));
    }

    public function _do_upload()
    {
        $config['upload_path']          = 'assets/lampiran_rapat';
        $config['allowed_types']        = 'jpg|png|jpeg|pdf';
        $config['max_size']             = 40000; //set max size allowed in Kilobyte
       // $config['max_width']            = 1000; // set max width image allowed
       // $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        //$this->load->library('upload', $config);
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('file_lampiran')) //upload and validate
        {
            $data['inputerror'][] = 'file_lampiran';
            $data['error_string'][] = 'Upload error : '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    public function hapus_lampiran($id)
    {
        $lampiran = $this->M_rapat->id_lampiran($id);
        if(file_exists('assets/lampiran_rapat/'.$lampiran->file_lampiran) && $lampiran->file_lampiran)
            unlink('assets/lampiran_rapat/'.$lampiran->file_lampiran);
         
        $this->M_rapat->hapus_lampiran($id);
        echo json_encode(array("status" => TRUE));
    }

    public function add_draft()
    {
        //$no_rapat   = $this->input->post('no_rapat');
        $no_rapat   = $this->M_rapat->get_kode_rapat();
        $tgl        = date('Y-m-d', strtotime($this->input->post('tgl_rapat')));
        $jam        = $this->input->post('jam_rapat');
        $pembahasan = $this->input->post('pembahasan');
        $hasil      = $this->input->post('hasil_rapat');
        $keterangan = $this->input->post('keterangan');
        
        $kode_lokasi = $this->session->userdata('lokasi');
        $sql_lokasi = "SELECT * FROM abe_kota WHERE kode_kota = '$kode_lokasi'";
        $lokasi1    = $this->db->query($sql_lokasi)->row_array();
        $divisi     = $this->input->post('divisi');
        $lokasi     = $lokasi1['nama_kota'];
        $input      = $this->input->post('rapat_input');
        $id_input   = $this->session->userdata('id_karyawan');
        date_default_timezone_set("Asia/Jakarta");
        $tgl_input  = date("Y-m-d H:i:s"); 
        $data = array(
                'no_rapat'      => $no_rapat,
                'tgl_rapat'     => $tgl,
                'jam_rapat'     => $jam,
                'pembahasan'    => $pembahasan,
                'hasil_rapat'   => $hasil,
                'keterangan'    => $keterangan,
                'lokasi'        => $lokasi,
                'department'    => $divisi,
                'status'        => 'DRAFT',
                'id_input'      => $id_input,
                'rapat_input'   => $input,
                'tgl_input'     => $tgl_input,
            );
        $this->M_rapat->save_draft($data);
        $rapat_terakhir = $this->db->query("SELECT id_rapat, no_rapat FROM abe_rapat_new ORDER BY id_rapat DESC LIMIT 1")->row_array();        
        $no_rapat2 = $rapat_terakhir['no_rapat'];
        $sql = "SELECT * FROM abe_rapat_peserta WHERE id_rapat = '$no_rapat2' AND id_peserta = '$id_input'";
        $cek_peserta = $this->db->query($sql)->num_rows();
        if($cek_peserta == 0){
            $data = array(
                'id_rapat'      => $no_rapat2,
                'nama_peserta'  => $input,
                'id_peserta'    => $id_input,
            );
            $this->M_rapat->save_peserta($data);
        }
        $this->session->set_flashdata('sukses','Data Rapat Berhasil Di simpan<br> Terimakasih');
        redirect('user/rapat');
    }

    public function update_draft()
    {
        $id         = $this->input->post('id_rapat');
        $no_rapat   = $this->input->post('no_rapat');
        $tgl        = date('Y-m-d', strtotime($this->input->post('tgl_rapat')));
        $jam        = $this->input->post('jam_rapat');
        $pembahasan = $this->input->post('pembahasan');
        $hasil      = $this->input->post('hasil_rapat');
        $keterangan = $this->input->post('keterangan');
        //$lokasi     = $this->input->post('lokasi_rapat');
        $divisi     = $this->input->post('divisi');
        $input      = $this->input->post('rapat_input');
        date_default_timezone_set("Asia/Jakarta");
        $tgl_input  = date("Y-m-d H:i:s");
        $data = array(
                'no_rapat'      => $no_rapat,
                'tgl_rapat'     => $tgl,
                'jam_rapat'     => $jam,
                'pembahasan'    => $pembahasan,
                'hasil_rapat'   => $hasil,
                'keterangan'    => $keterangan,
                'rapat_input'   => $input,
                'department'    => $divisi,
            );
        $this->M_rapat->update_draft($data,$id);
        $this->session->set_flashdata('sukses','Data Rapat Berhasil Di ubah<br> Terimakasih');
        redirect('user/rapat');
    }

    public function edit()
    {   
        $data['record'] = $this->M_rapat->ambil_notulen_rapat()->row_array();
        $this->template->load('template','rapat/edit_notulen_rapat',$data);        
    }

    public function detail() 
    {   
        $data['record'] = $this->M_rapat->ambil_notulen_rapat()->row_array();
        $this->template->load('template','rapat/detail_notulen_rapat',$data);        
    }

    public function cetak_notulen(){
        $id = $this->uri->segment(4);
        $data['record'] = $this->M_rapat->ambil_notulen_rapat()->row_array();
        $this->load->view('rapat/notulen_cetak_pdf',$data);
    }

    public function cetak_notulen_pdf(){
        $id = $this->uri->segment(4);
        $data['record'] = $this->M_rapat->ambil_notulen_rapat()->row_array();
        $this->load->view('rapat/notulen_pdf',$data);
    }

    public function selesai()
    {
        $id   = $this->uri->segment(4);
        $data = array('status' => 'DONE');
        $this->M_rapat->update_done($data,$id);
        $this->session->set_flashdata('sukses','Data Rapat Berhasil Di selesaikan<br> Terimakasih');
        redirect('user/rapat');
    }

    public function hapus()
    {
        $id   = $this->uri->segment(4);
        $this->M_rapat->hapus_rapat($id);
        $this->session->set_flashdata('sukses','Data Rapat Berhasil Di hapus<br> Terimakasih');
        redirect('user/rapat');
    }

    function cetak_notulen2()
    {   
        ob_start();
        $id = $this->uri->segment(4);
        $data['record'] = $this->M_rapat->ambil_notulen_rapat()->row_array();
        $this->load->view('rapat/notulen_pdf2',$data);
    }


}
