<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_harian extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        chekAksesModule();
        $this->load->model('M_tugas');
        if($this->session->userdata('id_karyawan') == ''){
            redirect('');
        }
    } 
 
    public function index()
    {
        $this->template->load('template','tugas/data_karyawan');
    }

    public function spv()
    {
        $this->template->load('template','tugas/data_karyawan_staff');
    }

    public function manager()
    {
        $this->template->load('template','tugas/data_karyawan_spv');
    }

    public function dataTugas(){
        $start = $_GET['start'];
        $end = $_GET['end'];
        $karyawan = $_GET['karyawan'];
        $tgl_end = date('Y-m-d', strtotime($end));
        $tgl_start = date('Y-m-d', strtotime($start));

        echo "
        <table id='mytable' class='table table-striped table-bordered'>
                <thead>
                  <tr>
                    <th width='40px'>No</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>";
            //$id = $this->session->userdata('id_karyawan');
            //$tgl = date('d-m-Y');
            $sql = "SELECT * FROM abe_tugas_harian WHERE id_karyawan = $karyawan AND tgl_input BETWEEN '$tgl_start' AND '$tgl_end' GROUP BY tgl_input  ORDER BY tgl_input DESC";
            $tugas = $this->db->query($sql)->result();
            $no = 1;
            foreach ($tugas as $row) {
                $hari_indonesia = array('Monday'  => 'Senin',
                                    'Tuesday'  => 'Selasa',
                                    'Wednesday' => 'Rabu',
                                    'Thursday' => 'Kamis',
                                    'Friday' => 'Jumat',
                                    'Saturday' => 'Sabtu',
                                    'Sunday' => 'Minggu');
                $tgl = $row->tgl_input;
                $hari   = date('l',strtotime($tgl));
                echo "<tr>
                        <td>$no</td>
                        <td><table class='table table-striped table-bordered'><thead><tr><th width='30%'>Tugas Harian - ( ".$hari_indonesia[$hari].", ".TanggalIndo(date('Y-m-d', strtotime($tgl)))." )</th><th><a class='btn btn-xs btn-info' href='".base_url()."tugas/Data_harian/detail/$row->tgl_input/$karyawan'><i class='fa fa-eye'></i> View Detail Progres Tugas</a></th></tr></thead>";
                            $tgl = $row->tgl_input;
                            $sql2 = "SELECT * FROM abe_tugas_harian WHERE id_karyawan = $karyawan AND tgl_input = '$tgl'";
                            $tugas2 = $this->db->query($sql2)->result();
                            foreach ($tugas2 as $row2) {
                              echo "<tr><td><b>$row2->tugas_kerja</b></td><td>$row2->detail</td> </tr>";
                            }
                echo "</table></td>
                     </tr>";
                $no++;
            }
        echo "</table>";
    }

    public function dataTugasAll(){
        $start = $_GET['start'];
        $end = $_GET['end'];
        $posisi = $_GET['posisi'];
        $department = $_GET['department'];
        $tgl_end = date('Y-m-d', strtotime($end));
        $tgl_start = date('Y-m-d', strtotime($start));

        echo "
        <table id='mytable' class='table table-striped table-bordered'>
                <thead>
                  <tr>
                    <th width='40px'>No</th>
                    <th >Nama Karyawan</th>
                  </tr>
                </thead>";
            //$id = $this->session->userdata('id_karyawan');
            //$tgl = date('d-m-Y');
            if($department == 'all'){
                $department1 = "";
            }else{
                $department1 =  "AND ak.department = '$department'";
            }
            $sql = "SELECT ath.*, ak.id_karyawan, ak.nama_lengkap
                    FROM abe_tugas_harian as ath, abe_karyawan as ak
                    WHERE ak.id_karyawan = ath.id_karyawan AND ak.status = 'aktif' AND ak.posisi = '$posisi' $department1 AND ath.tgl_input BETWEEN '$tgl_start' AND '$tgl_end' GROUP BY ath.id_karyawan";
            $tugas = $this->db->query($sql)->result();
            $no = 1;
            foreach ($tugas as $row) {
                echo "<tr>
                        <td>$no</td>
                        <td>$row->nama_lengkap</td></tr>
                        <tr><td></td>
                        <td><table class='table table-striped table-bordered'>";
                        $karyawan2 = $row->id_karyawan;
                        $sql2 = "SELECT * FROM abe_tugas_harian WHERE id_karyawan = $karyawan2 AND tgl_input BETWEEN '$tgl_start' AND '$tgl_end' GROUP BY tgl_input  ORDER BY tgl_input DESC";
                        $tugas2 = $this->db->query($sql2)->result();
                        foreach ($tugas2 as $row2) {
                            $hari_indonesia = array('Monday'  => 'Senin',
                                    'Tuesday'  => 'Selasa',
                                    'Wednesday' => 'Rabu',
                                    'Thursday' => 'Kamis',
                                    'Friday' => 'Jumat',
                                    'Saturday' => 'Sabtu',
                                    'Sunday' => 'Minggu');
                            $tgl = $row2->tgl_input;
                            $hari   = date('l',strtotime($tgl));
                            echo "<tr><td><table class='table table-bordered'>";
                            echo "<thead><tr><th width='30%'>Tugas Harian - ( ".$hari_indonesia[$hari].", ".TanggalIndo(date('Y-m-d', strtotime($tgl)))." )</th><th><a class='btn btn-xs btn-info' href='".base_url()."tugas/Data_harian/detail/$row2->tgl_input/$karyawan2'><i class='fa fa-eye'></i> View Detail Progres Tugas</a></th></tr></thead>";
                                
                                //$karyawan2 = $row->id_karyawan;
                                $sql3 = "SELECT * FROM abe_tugas_harian WHERE id_karyawan = '$karyawan2' AND  tgl_input = '$tgl'";
                                $tugas3 = $this->db->query($sql3)->result();
                                foreach ($tugas3 as $row3) {
                                  echo "<tr><td><b>$row3->tugas_kerja</b></td><td>$row3->detail</td></tr> ";
                                }
                            echo "</table></td></tr>";
                        }
                        echo "
                        </table></td>                        
                     </tr>";
                $no++;
            }
        echo "</table>";
    }




    function dataTugas21(){
        $start = $_GET['start'];
        $end = $_GET['end'];
        $karyawan = $_GET['karyawan'];

        echo "
        <table id='mytable' class='table table-striped table-bordered'>
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pekerjaan</th>
                    <th>Uraian Kerja</th>
                    <th>Target</th>
                    <th>Progress</th>
                  </tr>
                </thead>";
            //$id = $this->session->userdata('id_karyawan');
            //$tgl = date('d-m-Y');
            $sql = "SELECT * FROM abe_tugas_harian WHERE id_karyawan = $karyawan AND tgl_input BETWEEN '$start' AND '$end'";
            $tugas = $this->db->query($sql)->result();
            $no = 1;
            foreach ($tugas as $row) {
                echo "<tr>
                        <td>$no</td>
                        <td>$row->tgl_input</td>
                        <td>$row->tugas_kerja</td>
                        <td><textarea style='resize:none; width:100%; height:70px;' readonly='true'>$row->detail</textarea></td>
                        <td>$row->tgl_target</td>
                        <td>$row->progres</td>
                     </tr>";
                $no++;
            }
        echo "</table>";
    }

    public function detail()
    {   
        $this->template->load('template','tugas/form2_detail_tugas');
    }

 
}
