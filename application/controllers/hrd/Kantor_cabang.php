<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kantor_cabang extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        chekAksesModule();
        $this->load->model('M_kantor');
        if($this->session->userdata('id_karyawan') == ''){
            redirect('');
        }
    }

    function data(){
        $table      = 'abe_pt';
        $primaryKey = 'id_pt';
        $columns    = array(
            array('db' => 'id_pt', 'dt' => 'id'),
            array('db' => 'nama_pt', 'dt' => 'nama'),
            array('db' => 'singkat', 'dt' => 'singkat'),
            array('db' => 'no_tlpn', 'dt' => 'no_tlpn'),
            array('db' => 'status', 'dt' => 'status'),
            array(
                'db' => 'id_pt',
                'dt' => 'aksi',
                'formatter' => function($d){
                    $ci =& get_instance();
                    $status = $ci->db->get_where("abe_pt",array("id_pt"=>$d))->row_array();
                    if($status["status"] == 'aktif'){
                        return "<button title=\"edit kantor\" class=\"btn btn-xs btn-warning\" onclick=\"edit_kantor('$d')\"><i class=\"glyphicon glyphicon-pencil\"></i></button> <a class=\"btn btn-xs btn-danger\" title=\"non aktifkan perusahaan\" href=".base_url()."hrd/kantor_cabang/validasi/$d><i class=\"glyphicon glyphicon-remove\"></i></a>";
                    }else{
                        return "<button title=\"edit kantor\" disabled=\"true\" class=\"btn btn-xs btn-warning\" onclick=\"edit_kantor('$d')\"><i class=\"glyphicon glyphicon-pencil\"></i></button> <a class=\"btn btn-xs btn-success\" title=\"aktifkan perusahaan\" href=".base_url()."hrd/kantor_cabang/validasi2/$d><i class=\"fa fa-check\"></i></a>";
                    }
                    //return "<button title=\"edit kantor\" class=\"btn btn-xs btn-warning\" onclick=\"edit_kantor('$k')\"><i class=\"glyphicon glyphicon-pencil\"></i></button> <button title=\"delete kantor\" class=\"btn btn-xs btn-danger\" onclick=\"delete_kantor('$k')\"><i class=\"glyphicon glyphicon-remove\"></i></button> <button title=\"tambah karyawan\" class=\"btn btn-xs btn-info\" onclick=\"tambah_karyawan('$k')\"><i class=\"fa fa-child\"></i></button>";
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

    function dataKota(){
        echo "<table class='table table-bordered table-striped' >
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kota</th>
                    <th width='80px'>Aksi</th>
                  </tr>
                </thead>";
            $sql = "SELECT * FROM abe_kota";
            $kota = $this->db->query($sql)->result();
            $no = 1;
            foreach ($kota as $row) {
                echo "<tr><td>$no</td><td>$row->nama_kota</td>
                      <td>
                        <button onclick='delete_kota($row->id_kota)' class='btn btn-xs btn-danger' title='hapus'><i class='fa fa-trash'></i> Hapus</button>
                      </td></tr>";
                $no++;
            }
        echo "</table>";
    }

    public function index()
    {
        
        $this->template->load('template','hrd/kantor_cabang');
    }

    public function ajax_add_kota()
    {
        $this->validate_kota();
        $data = array(
                'nama_kota'    => $this->input->post('nama'),
            );
        $insert = $this->M_kantor->save_kota($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete_kota($id)
    {
        $this->M_kantor->delete_by_id_kota($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_add()
    {
        $this->validate_kantor();
        $tlpn = $this->input->post('no_tlpn');
        $tlpn2 = preg_replace('/[^A-Za-z0-9\-]/', '', $tlpn);
        $data = array(
                'nama_pt'   => $this->input->post('nama_kantor'),
                'singkat'   => $this->input->post('singkat'),
                'alamat'    => $this->input->post('alamat'),
                'no_tlpn'   => $tlpn2,
                'akta_pendirian'  => $this->input->post('akta_pendirian'),
                'akta_perubahan'  => $this->input->post('akta_perubahan'),
                'domisili'  => $this->input->post('domisili'),
                'npwp'      => $this->input->post('npwp'),
                'siup'      => $this->input->post('siup'),
                'tdp'       => $this->input->post('tdp'),
                'situ_ho'   => $this->input->post('situ_ho'),
                'api_u'     => $this->input->post('api_u'),
                'api_p'     => $this->input->post('api_p'),
                'nik'       => $this->input->post('nik'),
                'status'    => 'aktif',
            );
        $insert = $this->M_kantor->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_edit($id)
    {
        $data = $this->M_kantor->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        $this->validate_kantor();
        $tlpn = $this->input->post('no_tlpn');
        $tlpn2 = preg_replace('/[^A-Za-z0-9\-]/', '', $tlpn);
        $data = array(
                'nama_pt'   => $this->input->post('nama_kantor'),
                'singkat'   => $this->input->post('singkat'),
                'alamat'    => $this->input->post('alamat'),
                'no_tlpn'   => $tlpn2,
                'akta_pendirian'  => $this->input->post('akta_pendirian'),
                'akta_perubahan'  => $this->input->post('akta_perubahan'),
                'domisili'  => $this->input->post('domisili'),
                'npwp'      => $this->input->post('npwp'),
                'siup'      => $this->input->post('siup'),
                'tdp'       => $this->input->post('tdp'),
                'situ_ho'   => $this->input->post('situ_ho'),
                'api_u'     => $this->input->post('api_u'),
                'api_p'     => $this->input->post('api_p'),
                'nik'       => $this->input->post('nik'),
            );
        $update = $this->M_kantor->update(array('id_pt' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->M_kantor->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function validate_kota()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('nama') == '')
        {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Mohon isi nama kota';
            $data['status'] = FALSE;
        }
  
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    private function validate_kantor()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('nama_kantor') == '0')
        {
            $data['inputerror'][] = 'nama_kantor';
            $data['error_string'][] = 'Mohon isi Nama perusahaan';
            $data['status'] = FALSE;
        }
  
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function validasi(){
        $this->M_kantor->validasi();
        $this->session->set_flashdata('non','Status perusahaan sudah di non aktifkan');
        redirect ('hrd/kantor_cabang');
    }

    public function validasi2(){
        $this->M_kantor->validasi2();
        $this->session->set_flashdata('aktif','Status perusahaan sudah di aktifkan');
        redirect ('hrd/kantor_cabang');
    }
}
