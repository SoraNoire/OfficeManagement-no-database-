<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absen extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        //chekAksesModule();
        $this->load->model('M_absen');
        
        if($this->session->userdata('id_karyawan') == ''){
            redirect('');
        }
    }

    public function index()
    {   
        $this->template->load('template','absen/data_absen_user');
    }

    public function masuk(){
        //$id = $this->uri->segment(4);
        $this->M_absen->absen_masuk();
        $this->session->set_flashdata('sukses','Terimakasih sudah mengisi absen hari ini<br>selamat bekerja (^_^),,,,');
        header('location:'.base_url().''); 
    }

    public function pulang(){
        date_default_timezone_set("Asia/Jakarta");
        $hari_ini       = date("Y-m-d");
        $id_karyawan    = $this->session->userdata('id_karyawan');
        $sql_terakhir   = "SELECT * FROM abe_absen WHERE tanggal = '$hari_ini' AND id_karyawan = '$id_karyawan'";
        $absen          = $this->db->query($sql_terakhir)->row_array();
        $id_absen       = $absen['id_absen'];
        $jam_pulang     = date("Y-m-d H:i:s");
        $data           = array('tgl_pulang'=>$jam_pulang);
        //echo "<script>alert('Data berhasil di tambahkan!".$id_absen."');history.go(-1);</script>";
        $this->M_absen->absen_pulang($data,$id_absen);
        $this->session->set_flashdata('sukses','Terimakasih sudah mengisi absen hari ini<br>hati-hati ya,,, (^_^),,,,');
        header('location:'.base_url().''); 
    }

    public function masuk_telat(){
        date_default_timezone_set("Asia/Jakarta");
        if ($this->agent->is_browser()){
              $agent = $this->agent->browser().' '.$this->agent->version();
          }elseif ($this->agent->is_mobile()){
              $agent = $this->agent->mobile();
          }else{
              $agent = 'Data user gagal di dapatkan';
          }
        $host_name      = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $os             = $this->agent->platform();
        $hari_ini       = date("Y-m-d");
        $id_karyawan    = $this->session->userdata('id_karyawan');
        $sql_terakhir   = "SELECT * FROM abe_absen WHERE tanggal = '$hari_ini' AND id_karyawan = '$id_karyawan'";
        $absen          = $this->db->query($sql_terakhir)->row_array();
        $id_absen       = $absen['id_absen'];
        $jam_absen      = date("Y-m-d H:i:s");
        $ip             = $this->input->ip_address() ;
        $browser        = $agent.'|'.$this->agent->platform();
        $host_name      = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $data           = array('tgl_absen'=>$jam_absen,'ip_pc'=>$ip,'browser_platform'=>$browser, 'mac_add'=>$os);
        $windows        = "ts";
        if($os == $windows){
            //$this->M_absen->absen_pulang($data,$id_absen);
            $this->session->set_flashdata('sukses','Terimakasih sudah mengisi absen hari ini<br>(^_^),,,,');
            header('location:'.base_url().''); 
        }else{
            $this->session->set_flashdata('gagal','Mohon pastikan anda menggunakan PC/Komputer kantor<br>untuk mengakses Fitur Absen ini<br>Terimakasih (^_^),,,,');
            header('location:'.base_url().''); 
        }

        /**
        //echo "<script>alert('Data berhasil di tambahkan!".$id_absen."');history.go(-1);</script>";
        $this->session->set_flashdata('sukses','Terimakasih sudah mengisi absen hari ini<br>(^_^),,,,');
        header('location:'.base_url().''); 
        **/
    }

    public function ijin(){
        $this->M_absen->absen_ijin();
        $this->session->set_flashdata('sukses','Terimakasih sudah update absen hari ini<br>(^_^),,,,');
        header('location:'.base_url('user/absen/data_absen').''); 
    }

    public function sakit(){
        $this->M_absen->absen_sakit();
        $this->session->set_flashdata('sukses','Terimakasih sudah mengisi absen hari ini<br>Semoga Cepat sembuh dan Selamat beristirahat<br>Obatnya di minum ya (^_^),,,,');
        header('location:'.base_url().''); 
    }

    public function upload_surat()
    {
        $id     = $this->input->post('id_absen');
        $data = array('lampiran'  => $this->input->post('file_lampiran'));
        if(!empty($_FILES['file_lampiran']['name']))
            {
                $upload = $this->_do_upload();
                $data['lampiran'] = $upload;
            }
        $insert = $this->M_absen->simpan_lampiran($data,$id);
        echo json_encode(array("status" => TRUE));
    }

    public function _do_upload()
    {
        $config['upload_path']          = 'assets/lampiran_sakit';
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

    public function data_absen()
    {   
        $this->template->load('template','absen/data_absen_all_user');
    }

    public function hari_ini()
    {   
        $this->template->load('template','absen/data_absen_all_user_hari_ini');
    }

    public function shorting()
    {
        $this->template->load('template','absen/absen_shorting');
    }

    public function shorting_all()
    {
        $this->template->load('template','absen/absen_shorting_all');
    }

    public function dataKehadiranKaryawan(){
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $periode = $bulan.' '.$tahun ;
        $karyawan = $_GET['karyawan'];
        $hari_indonesia = array('Monday'  => 'Senin',
                        'Tuesday'  => 'Selasa',
                        'Wednesday' => 'Rabu',
                        'Thursday' => 'Kamis',
                        'Friday' => 'Jumat',
                        'Saturday' => 'Sabtu',
                        'Sunday' => 'Minggu');

        echo "
        <table id='mytable' class='table table-striped table-bordered'>
                <thead>
                  <tr>
                    <th width='40px'>No</th>
                    <th width='150px'>Hari / Tanggal</th>
                    <th width='100px'>Jam Masuk</th>
                    <th width='100px'>Jam Pulang</th>
                    <th width='160px'>Status Kehadiran</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>";
            //$id = $this->session->userdata('id_karyawan');
            //$tgl = date('d-m-Y');
            $sql = "SELECT * FROM abe_absen WHERE id_karyawan = $karyawan AND periode = '$periode' ORDER BY tgl_absen ASC";
            $absen = $this->db->query($sql)->result();
            $no = 1;
            foreach ($absen as $row) {
                $hari   = date('l', strtotime($row->tanggal));
                $jam_masuk = date('H:i:s', strtotime($row->tgl_absen));
                $jam_pulang = date('H:i:s', strtotime($row->tgl_pulang));

                echo "<tr>
                        <td>$no</td>
                        <td>$hari_indonesia[$hari] / ".date('d-m-Y', strtotime($row->tanggal))."</td>
                        <td>";
                    if($jam_masuk == '01:00:00'){
                        echo " - ";
                    }else{
                        echo $jam_masuk;
                    }
                echo "</td><td>";
                    if($jam_pulang == '01:00:00'){
                        echo " - ";
                    }else{
                        echo $jam_pulang;
                    }
                echo "</td>
                        <td>$row->status</td>
                        <td>$row->keterangan</td>
                     </tr>";
                $no++;
            }
        echo "</table>";
    }

    public function dataKehadiranAll(){
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $periode = $bulan.' '.$tahun ;
        $posisi = $_GET['posisi'];
        $department = $_GET['department'];
        $hari_indonesia = array('Monday'  => 'Senin',
                        'Tuesday'  => 'Selasa',
                        'Wednesday' => 'Rabu',
                        'Thursday' => 'Kamis',
                        'Friday' => 'Jumat',
                        'Saturday' => 'Sabtu',
                        'Sunday' => 'Minggu');
        echo "
        <table id='mytable' class='table table-striped table-bordered'>
                <thead>
                  <tr>
                    <th width='40px'>No</th>
                    <th width='260px'>Nama Karyawan</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>";
            if($department == 'all'){
                $department1 = "";
            }else{
                $department1 =  "AND ak.department = '$department'";
            }
            $sql = "SELECT aa.*, ak.id_karyawan, ak.nama_lengkap
                    FROM abe_absen as aa, abe_karyawan as ak
                    WHERE ak.id_karyawan = aa.id_karyawan AND ak.posisi = '$posisi' $department1 AND aa.periode = '$periode' GROUP BY aa.id_karyawan";
            $absen = $this->db->query($sql)->result();
            $no = 1;
            foreach ($absen as $row) {
               echo "<tr>
                        <td>$no</td>
                        <td>$row->nama_lengkap</td>
                        <td><table class='table table-striped table-bordered'>";
                        $karyawan2 = $row->id_karyawan;
                        $sql2 = "SELECT * FROM abe_absen WHERE id_karyawan = $karyawan2 AND periode = '$periode' ORDER BY tanggal ASC";
                        $absen2 = $this->db->query($sql2)->result();
                        foreach ($absen2 as $row2) {
                            $hari   = date('l', strtotime($row2->tanggal));
                            $jam_masuk = date('H:i:s', strtotime($row2->tgl_absen));
                            $jam_pulang = date('H:i:s', strtotime($row2->tgl_pulang));
                            echo "<tr>
                                <td width='180px'>$hari_indonesia[$hari] / ".date('d-m-Y', strtotime($row2->tanggal))."</td>
                                <td width='100px'>";
                            if ($jam_masuk == '01:00:00'){
                                echo " - ";
                            }else{
                                echo $jam_masuk;
                            }
                            echo "</td><td width='100px'>";
                            if ($jam_pulang == '01:00:00'){
                                echo " - ";
                            }else{
                                echo $jam_pulang;
                            }
                            echo "</td>
                                <td width='130px'>$row2->status</td>
                                <td>$row2->keterangan</td></tr>";
                            }
                        echo "
                        </table></td>                        
                     </tr>";
                $no++;
            }
        echo "</table>";
    }

    public function hapus_status()
    {
        $id   = $this->uri->segment(4);
        $this->M_absen->hapus_status($id);
        $this->session->set_flashdata('sukses','Data Absen Berhasil Di hapus<br> Terimakasih');
        redirect('user/absen/data_absen');
    }
}
