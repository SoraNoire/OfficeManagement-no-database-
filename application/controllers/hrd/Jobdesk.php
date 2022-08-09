<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobdesk extends CI_Controller {

	function __construct(){
		parent::__construct();
        //chekAksesModule();
		$this->load->model(array('M_jobdesk'));
        if($this->session->userdata('id_karyawan') == ''){
            redirect('');
        }
	}

	function data(){
		$table 		= 'view_karyawan_aktif';
		$primaryKey = 'id_karyawan';
		$columns 	= array(
			array( 
				'db' => 'foto',
				'dt' => 'foto',
				'formatter' => function($d){
					if ($d == ""){
						return "<img src='../assets/foto_karyawan/user.png' width='40px'>";
					}else{
						return "<img src='../assets/foto_karyawan/$d' width='40px'>";
					}
				}),
			array('db' => 'id_karyawan', 'dt' => 'id_karyawan'),
			array('db' => 'nama_lengkap', 'dt' => 'nama_lengkap'),
            array(
                'db' => 'department',
                'dt' => 'department'),
            array(
                'db' => 'jabatan',
                'dt' => 'jabatan'),
            array('db' => 'status', 'dt' => 'status'),
			array(
				'db' => 'id_karyawan',
				'dt' => 'aksi',
				'formatter' => function($d){
					return "<a href=\"".base_url()."hrd/jobdesk/detail/$d\" class=\"btn btn-xs btn-info\"><i class=\"fa fa-list\"></i> Jobdesk</a>";
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

	public function index()
	{
		$this->template->load('template','hrd/jobdesk');
	}

    public function detail()
    {   
        $this->template->load('template','hrd/detail_jobdesk');
    }

    function dataJobdesk(){
        echo "<table class='table table-striped jambo_table bulk_action'>
                <thead>
                  <tr>
                    <th width='40'>No</th>
                    <th>Jobdesk</th>
                    <th width='90'>Aksi</th>
                  </tr>
                </thead>";
            $karyawan = $_GET['karyawan'];
            $sql = "SELECT * FROM abe_jobdesk WHERE id_karyawan = $karyawan";
            $tugas = $this->db->query($sql)->result();
            $no = 1;
            foreach ($tugas as $row) {
                echo "<tr>
                        <td>$no</td>
                        <td>$row->detail</td>
                        <td><button title=\"edit user\" class=\"btn btn-xs btn-warning\" onclick=\"edit_jobdesk('$row->id_jobdesk')\"><i class=\"glyphicon glyphicon-pencil\"></i> Edit</button></td>
                     </tr>";
                $no++;
            }
        echo "</table>";
    }

    public function simpan_jobdesk()
    {
        //$this->validate_kota();
        //$karyawan = $this->uri->segment(3);
        $user = $this->session->userdata('id_karyawan');
        $jobdesk = $this->input->post('id');
        $sql = "SELECT id_jobdesk FROM abe_jobdesk WHERE id_jobdesk = '$jobdesk'";
        $user2 = $this->db->query($sql)->row_array();

        if($user2['id_jobdesk'] != ''){
            $data = array(
                'detail'        => $this->input->post('jobdesk'),
                'id_input'      => $user,
            );
            $this->M_jobdesk->update_jobdesk(array('id_jobdesk' => $this->input->post('id')), $data);
            echo json_encode(array("status" => TRUE));
        }else{
            $data = array(
                'id_karyawan'   => $this->input->post('karyawan'),
                'detail'        => $this->input->post('jobdesk'),
                'id_input'      => $user,
            );
            $insert = $this->M_jobdesk->save_jobdesk($data);
            echo json_encode(array("status" => TRUE));
        }        
    }

    public function ajax_edit($id)
    {
        $data = $this->M_jobdesk->get_by_id($id);
        echo json_encode($data);
    }





}
