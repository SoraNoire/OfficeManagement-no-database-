<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_harian extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        //chekAksesModule();
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

    function dataTugas(){
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
                    <th width='90px'>Tanggal</th>
                    <th>Tugas Kerja</th>
                    <th>Action</th>
                  </tr>
                </thead>";
            //$id = $this->session->userdata('id_karyawan');
            //$tgl = date('d-m-Y');
            $sql = "SELECT * FROM abe_tugas_harian WHERE id_karyawan = $karyawan AND tgl_input BETWEEN '$tgl_start' AND '$tgl_end' GROUP BY tgl_input  ORDER BY tgl_input DESC";
            $tugas = $this->db->query($sql)->result();
            $no = 1;
            foreach ($tugas as $row) {
                echo "<tr>
                        <td>$no</td>
                        <td>".date('d-m-Y', strtotime($row->tgl_input))."</td>
                        <td>";
                            $tgl = $row->tgl_input;
                            $sql2 = "SELECT * FROM abe_tugas_harian WHERE id_karyawan = $karyawan AND tgl_input = '$tgl'";
                            $tugas2 = $this->db->query($sql2)->result();
                            foreach ($tugas2 as $row2) {
                              echo "<b>$row2->tugas_kerja</b>, ";
                            }
                echo "</td>
                        <td><a class='btn btn-xs btn-info' href='".base_url()."tugas/Data_harian/detail/$row->tgl_input/$karyawan'><i class='fa fa-eye'></i> Detail</a></td>
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
