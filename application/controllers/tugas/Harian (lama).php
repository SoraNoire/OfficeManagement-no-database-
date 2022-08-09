<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harian extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        //chekAksesModule();
        $this->load->model('M_tugas');
        if($this->session->userdata('id_karyawan') == ''){
            redirect('');
        }
    }

    function dataTugasHarian(){
        echo "<table class='table table-striped jambo_table bulk_action'>
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Pekerjaan</th>
                    <th>Uraian Kerja</th>
                    <th>Target</th>
                    <th>Progress</th>
                  </tr>
                </thead>";
            $id = $this->session->userdata('id_karyawan');
            $tgl = date('Y-m-d');
            $sql = "SELECT * FROM abe_tugas_harian WHERE id_karyawan = $id AND tgl_input = '$tgl'";
            $tugas = $this->db->query($sql)->result();
            $no = 1;
            //date('Y-m-d', strtotime($this->input->post('tgl_lahir')))
            foreach ($tugas as $row) {
                echo "<tr>
                        <td>$no</td>
                        <td>$row->tugas_kerja</td>
                        <td><textarea style='resize:none; width:100%; ' readonly='true'>$row->detail</textarea></td>
                        <td>".date('d-m-Y', strtotime($row->tgl_target))."</td>
                        <td><textarea style='resize:none; width:100%; ' readonly='true'>$row->progres</textarea></td>
                     </tr>";
                $no++;
            }
        echo "</table>";
    }

    public function index()
    {   
        $id = $this->session->userdata('id_karyawan');
        $data['record'] = $this->M_tugas->tampil_jobdesk($id)->result();
        $this->template->load('template','tugas/data_harian',$data);
    }
  
    public function create()
    {   
        $this->template->load('template','tugas/form_tambah_tugas');
    }

    public function simpan_tugas()
    {
        //$this->validate_kota();
        $karyawan = $this->session->userdata('id_karyawan');
        $tgl_target = date('Y-m-d', strtotime($this->input->post('tgl_target')));
        $tgl = date('Y-m-d');
        $data = array(
                'id_karyawan'  => $karyawan,
                'tugas_kerja'  => $this->input->post('tugas_kerja'),
                'detail'       => $this->input->post('detail'),
                'tgl_target'   => $tgl_target,
                'progres'      => $this->input->post('progres'),
                'tgl_input'    => $tgl,
            );
        $insert = $this->M_tugas->save_tugas($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->M_tugas->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function edit()
    {   
        $this->template->load('template','tugas/form_edit_tugas');
    }

    public function detail()
    {   
        $this->template->load('template','tugas/form_detail_tugas');
    }

    public function form_edit_tugas(){
        $id_tugas = $_GET['id_tugas'];
        $sql = "SELECT * FROM abe_tugas_harian WHERE id_tugas = $id_tugas";
        $data = $this->db->query($sql)->row_array();
        //echo $data['detail'];
        echo "<form method='post' data-parsley-validate class='form-tugas form-horizontal form-label-left'>
              <div class='form-group'>
                <label class='control-label col-md-3 col-sm-3 col-xs-12'>Pekerjaan / Tugas</label>
                <div class='col-md-6 col-sm-6 col-xs-12'>
                    <input type='hidden' name='id' value='".$data['id_tugas']."'>
                  <input type='text' name='tugas_kerja' class='form-control col-md-7 col-xs-12' value='".$data['tugas_kerja']."'>
                </div>
              </div>
              <div class='form-group'>
                <label class='control-label col-md-3 col-sm-3 col-xs-12'>Uraian Kerja</label>
                <div class='col-md-6 col-sm-6 col-xs-12'>
                  <textarea name='detail' style='resize:none; width:100%; height:150px;' class='form-control col-md-12 col-xs-12'>".$data['detail']."</textarea>
                </div>
              </div>
              <div class='form-group'>
                <label class='control-label col-md-3 col-sm-3 col-xs-12'>Target Penyelesaian</label>
                <div class='col-md-2 col-sm-6 col-xs-12'>
                  <input type='text' name='tgl_target' value='".date('d-m-Y', strtotime($data['tgl_target']))."' class='form-control col-md-7 col-xs-12'>
                </div>
                <p class='control-label col-md-4 col-sm-6 col-xs-12'><i>*format tgl : tanggal-bulan-tahun / ex : <b>02-12-2017</b></i></p>
              </div>
              <div class='form-group'>
                <label class='control-label col-md-3 col-sm-3 col-xs-12'>Progress</label>
                <div class='col-md-6 col-sm-6 col-xs-12'>
                  <textarea name='progres' style='resize:none; width:100%; height:100px;' class='form-control col-md-12 col-xs-12'>".$data['progres']."</textarea>
                </div>
              </div>
              <div class='ln_solid'></div>
              <div class='form-group'>
                <div class='col-md-6 col-sm-6 col-xs-12 col-md-offset-3'>
                  <button type='button' onclick='update()' class='btn btn-success'>Update</button>
                </div>
              </div>
            </form>";
    }

    public function form_view_tugas(){
        $id_tugas = $_GET['id_tugas'];
        $sql = "SELECT * FROM abe_tugas_harian WHERE id_tugas = $id_tugas";
        $data = $this->db->query($sql)->row_array();
        //echo $data['detail'];
        echo "<form class='form-tugas form-horizontal form-label-left'>
              <div class='form-group'>
                <label class='control-label col-md-3 col-sm-3 col-xs-12'>Pekerjaan / Tugas</label>
                <div class='col-md-6 col-sm-6 col-xs-12'>
                  <input type='text' readonly='true' name='tugas_kerja' class='form-control col-md-7 col-xs-12' value='".$data['tugas_kerja']."'>
                </div>
              </div>
              <div class='form-group'>
                <label class='control-label col-md-3 col-sm-3 col-xs-12'>Uraian Kerja</label>
                <div class='col-md-6 col-sm-6 col-xs-12'>
                  <textarea name='detail' readonly='true' style='resize:none; width:100%; height:150px;' class='form-control col-md-12 col-xs-12'>".$data['detail']."</textarea>
                </div>
              </div>
              <div class='form-group'>
                <label class='control-label col-md-3 col-sm-3 col-xs-12'>Target Penyelesaian</label>
                <div class='col-md-2 col-sm-6 col-xs-12'>
                  <input type='text' readonly='true' name='tgl_target' value='".date('d-m-Y', strtotime($data['tgl_target']))."' class='form-control col-md-7 col-xs-12'>
                </div>
              </div>
              <div class='form-group'>
                <label class='control-label col-md-3 col-sm-3 col-xs-12'>Progress</label>
                <div class='col-md-6 col-sm-6 col-xs-12'>
                  <textarea name='progres' readonly='true' style='resize:none; width:100%; height:100px;' class='form-control col-md-12 col-xs-12'>".$data['progres']."</textarea>
                </div>
              </div>
              <div class='ln_solid'></div>
            </form>";
    }

    public function update_tugas()
    {
        $tgl_target = date('Y-m-d', strtotime($this->input->post('tgl_target')));
        $data = array(
                'tugas_kerja'  => $this->input->post('tugas_kerja'),
                'detail'       => $this->input->post('detail'),
                'tgl_target'   => $tgl_target,
                'progres'      => $this->input->post('progres'),
            );
        $this->M_tugas->update_tugas(array('id_tugas' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }







}
