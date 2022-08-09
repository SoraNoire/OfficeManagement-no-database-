<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pr extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        //chekAksesModule();
        $this->load->model('M_permintaan');
        if($this->session->userdata('id_karyawan') == ''){
            redirect('');
        }
    }
 
    public function index()
    {   
        $this->template->load('template','permintaan/data_pr');
    }

    public function add_lokasi()
    {
        $lokasi             = $this->input->post('lokasi_pr');
        $sess_lok['lokasi'] = $this->input->post('lokasi_pr');
        $this->session->set_userdata($sess_lok);
        if($lokasi == 'null'){
            $this->session->set_flashdata('sukses','Mohon Pilih Lokasi permintaan barang / jasa terlebih dahulu<br> Sebelum membuat SPB<br> Terimakasih');
            redirect('permintaan/pr');
        }else{
            header('location:'.base_url().'permintaan/pr/create/'.$lokasi);
        }
    }

    function dataPermintaanDetail(){
        $lokasi         = $this->session->userdata('lokasi');
        $query_lokasi   = $this->db->query("SELECT * FROM abe_kota WHERE kode_kota = '$lokasi'")->row_array();
        $kota           = $query_lokasi['nama_kota'];
        $user           = $this->session->userdata('id_karyawan');
        //$id_pr          = $this->uri->segment('3');
        echo "<div class='table-responsive'>
        <table class='table table-bordered' >
                <thead>
                  <tr>
                    <th width='30px'>No</th>
                    <th>Nama Barang</th>
                    <th>No. Seri / Type</th>
                    <th width='60px'>Jumlah</th>
                    <th width='60px'>Satuan</th>
                    <th>Keterangan</th>
                    <th width='60px'>Hapus</th>
                  </tr>
                </thead>";
            $sql    = "SELECT * FROM abe_permintaan_detail WHERE id_pr = '0' AND id_user = '$user' AND kota = '$kota'";
            $detail = $this->db->query($sql)->result();
            if(empty($detail)){
                echo "<tr><td colspan='7'><center>Belum ada Barang / Jasa yang di buat</center></td></tr>";
            }else{
                $no = 1;
                foreach ($detail as $row) {
                    echo "<tr><td>$no</td>
                            <td>$row->nama_barang</td>
                            <td>$row->no_seri</td>
                            <td>$row->jumlah_barang</td>
                            <td>$row->satuan</td>
                            <td>$row->keterangan</td>
                          <td>
                            <button type='button' onclick='hapus_permintaan_detail($row->id_pr_detail)' class='btn btn-xs btn-danger' title='hapus'><i class='fa fa-trash'></i></button>
                          </td></tr>";
                    $no++;
                }
            }
        echo "</table></div>";
    }

    public function add_permintaan_detail()
    {
        $lokasi         = $this->session->userdata('lokasi');
        $query_lokasi   = $this->db->query("SELECT * FROM abe_kota WHERE kode_kota = '$lokasi'")->row_array();
        $kota           = $query_lokasi['nama_kota'];
        $id_karyawan    = $this->session->userdata('id_karyawan');
        //$kota           = $this->input->post('nama_kota');
        $nama_barang    = $this->input->post('nama_barang');
        $no_seri        = $this->input->post('no_seri');
        $jumlah_barang  = $this->input->post('jumlah_barang');
        $satuan         = $this->input->post('satuan');
        $keterangan     = $this->input->post('keterangan');
        $no_pr          = $this->input->post('no_pr');
        $id_pr          = $this->input->post('id_pr');
        $data = array(
                'id_pr'         => $id_pr,
                'no_pr'         => $no_pr,
                'nama_barang'   => $nama_barang,
                'no_seri'       => $no_seri,
                'jumlah_barang' => $jumlah_barang,
                'satuan'        => $satuan,
                'keterangan'    => $keterangan,
                'status'        => 'baru',
                'kota'          => $kota,
                'id_user'       => $id_karyawan,
            );
        $this->M_permintaan->save_permintaan_detail($data);
        echo json_encode(array("status" => TRUE));
    }

    public function hapus_detail_permintaan($id)
    {
        $this->M_permintaan->hapus_detail_permintaan($id);
        echo json_encode(array("status" => TRUE));
    }



    public function data()
    {   
        $this->template->load('template','permintaan/data_pr_disetujui');
    }

    public function create()
    {   
        if (isset($_POST['submit'])){
            $this->M_permintaan->tambah_pr($_POST);
            $this->session->set_flashdata('sukses','Permintaan Anda Berhasil Dibuat<br> menunggu validasi dari bagian terkait<br>Terimakasih');
            redirect ('permintaan/pr');
        }else{
            $data['no_pr'] = $this->M_permintaan->get_kode_pr();
            $this->template->load('template','permintaan/form_permintaan_pembelian',$data);
        }
    }


    public function edit()
    {   
        if (isset($_POST['submit'])){
            $this->M_permintaan->edit_pr($_POST);
            $this->session->set_flashdata('sukses','Permintaan Anda Berhasil Di ubah<br> menunggu validasi dari bagian terkait<br>Terimakasih');
            redirect ('permintaan/pr');
        }else{
            $data['no_pr']  = $this->M_permintaan->get_kode_pr();
            $data['record'] = $this->M_permintaan->ambil_pr()->row_array();
            $this->template->load('template','permintaan/form_edit_permintaan',$data);
        }
    }

    public function detail()
    {   
        //$data['no_pr'] = $this->M_permintaan->get_kode_pr();
        $data['record'] = $this->M_permintaan->ambil_pr()->row_array();
        $this->template->load('template','permintaan/form_detail_permintaan',$data);
        
    }

    public function hapus($id)
    {
        $this->M_permintaan->hapus_pr($id);
        //echo json_encode(array("status" => TRUE));
        $this->session->set_flashdata('sukses','Permintaan Anda Berhasil Di Hapus<br> Terimakasih');
        redirect ('permintaan/pr');
    }


    public function mengetahui()
    {   
        $this->template->load('template','permintaan/data_pr_mengetahui');
    }

    public function proses_mengetahui(){
        $this->M_permintaan->proses_mengetahui();
        $this->session->set_flashdata('sukses','Permintaan pembelian sudah berhasil di Approve<br>Terimakasih');
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

    public function proses_selesai(){
        //$id = $this->uri->segment(4);
        $this->M_permintaan->proses_selesai();
        $this->session->set_flashdata('sukses','Permintaan pembelian sudah berhasil di selesaikan<br>Terimakasih');
        //redirect ('sapi/data_sapi');
        header('location:'.base_url().'permintaan/pr/data/'); 
    }

    public function ubah_detail($id)
    {
        $data = $this->M_permintaan->ambil_id_detail($id);
        echo json_encode($data);
    }

    public function tolak_detail()
    {   
        $id_pr = $this->input->post('id_pr');
        $this->M_permintaan->ubah_status_detail($_POST);
        $this->session->set_flashdata('sukses','Permintaan detail pembelian sudah berhasil di hapus<br>Terimakasih');
        header('location:'.base_url().'permintaan/pr/proses_menyetujui/'.$id_pr); 
    }

    public function dataLampiran(){
        //$no_rapat = $this->M_rapat->get_kode_rapat();
        $no_permintaan = $_GET['no_permintaan'];
        echo "<table class='table table-bordered table-striped' >
                <thead>
                  <tr>
                    <th width='30px'>No</th>
                    <th width='100px'>Lampiran</th>
                    <th>Nama Lampiran</th>
                    <th width='220px'>Aksi</th>
                  </tr>
                </thead>";
            $sql_lampiran   = "SELECT * FROM abe_permintaan_lampiran WHERE id_permintaan = '$no_permintaan'";
            //$sql_rapat      = "SELECT status, no_rapat FROM abe_rapat_new WHERE no_rapat = '$no_rapat'";
            $lampiran = $this->db->query($sql_lampiran)->result();
            //$rapat = $this->db->query($sql_rapat)->row_array();
            if(empty($lampiran)){
                echo "<tr><td colspan='4'><center>Tidak ada Lampiran</center></td></tr>";
            }else{
                $no = 1;
                foreach ($lampiran as $row) {
                    echo "<tr><td>$no</td>";
                    echo "<td><img src='".base_url()."/assets/lampiran_pr/$row->file_lampiran' height='40px'></td><td>$row->keterangan_lampiran</td>
                          <td>";
                    echo "<button onclick='delete_lampiran($row->id_permintaan_lampiran)' class='btn btn-xs btn-danger' title='hapus lampiran'><i class='fa fa-trash'></i> Hapus</button>";
                            
                    echo "<a class='btn btn-xs btn-info' href='".base_url()."assets/lampiran_pr/$row->file_lampiran' target='blank'><i class='fa fa-eye' title='lihat lampiran'></i> Lihat Lampiran</a>
                          </td></tr>";
                    $no++;
                }
            }
        echo "</table>";
    }

    public function add_lampiran()
    {
        $no_permintaan = $this->input->post('no_permintaan');
        $data = array(
                'keterangan_lampiran'  => $this->input->post('keterangan_lampiran'),
                'id_permintaan'       => $no_permintaan,
            );
        if(!empty($_FILES['file_lampiran']['name']))
            {
                $upload = $this->_do_upload();
                $data['file_lampiran'] = $upload;
            }
        $insert = $this->M_permintaan->save_lampiran($data);
        echo json_encode(array("status" => TRUE));
    }

    public function _do_upload()
    {
        $config['upload_path']          = 'assets/lampiran_pr';
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
        $lampiran = $this->M_permintaan->id_lampiran($id);
        if(file_exists('assets/lampiran_pr/'.$lampiran->file_lampiran) && $lampiran->file_lampiran)
            unlink('assets/lampiran_pr/'.$lampiran->file_lampiran);
         
        $this->M_permintaan->hapus_lampiran($id);
        echo json_encode(array("status" => TRUE));
    }
}
