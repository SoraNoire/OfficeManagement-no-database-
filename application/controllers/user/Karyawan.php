<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

	function __construct(){
		parent::__construct();
        chekAksesModule();
		$this->load->model(array('M_karyawan'));
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
            array('db' => 'kode_karyawan', 'dt' => 'kode_karyawan'),
			array('db' => 'nama_lengkap', 'dt' => 'nama_lengkap'),
            array(
                'db' => 'department',
                'dt' => 'department'),
            array(
                'db' => 'jabatan',
                'dt' => 'jabatan'),
            array('db' => 'status', 'dt' => 'status')
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
        $this->template->load('template','user/karyawan');
	}

}
