<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	function __construct(){
		parent::__construct();
        chekAksesModule();
		$this->load->model(array('M_pengguna'));
        if($this->session->userdata('id_karyawan') == ''){
            redirect('');
        }
	}

	function data(){
		$table 		= 'abe_login';
		$primaryKey = 'id_login';
		$columns 	= array(
            array(
                'db' => 'id_karyawan',
                'dt' => 'foto',
                'formatter' => function($p){
                    $ci =& get_instance();
                    $karyawan = $ci->db->get_where("abe_karyawan",array("id_karyawan"=>$p))->row_array();
                    $f = $karyawan["foto"];
                    if ($f == ""){
                        return "<img src='../assets/foto_karyawan/user.png' width='40px'>";
                    }else{
                        return "<img src='../assets/foto_karyawan/$f' width='40px'>";
                    }
                }),
            array(
                'db' => 'id_karyawan',
                'dt' => 'nama',
                'formatter' => function($p){
                    $ci =& get_instance();
                    $karyawan = $ci->db->get_where("abe_karyawan",array("id_karyawan"=>$p))->row_array();
                    return $karyawan["nama_lengkap"];
                }),
            array(
                'db' => 'level',
                'dt' => 'level',
                'formatter' => function($p){
                    $ci =& get_instance();
                    $hak_akses = $ci->db->get_where("abe_level_user",array("id_level_user"=>$p))->row_array();
                    return $hak_akses["nama_level"];
                }),
			array('db' => 'username', 'dt' => 'username'),
			array(
                'db' => 'status',
                'dt' => 'status',
                ),
			array(
				'db' => 'id_login',
				'dt' => 'aksi',
				'formatter' => function($d){
                    $ci =& get_instance();
                    $status = $ci->db->get_where("abe_login",array("id_login"=>$d))->row_array();
                    if($status["status"] == 'aktif'){
                        return "<button title=\"edit user\" class=\"btn btn-xs btn-warning\" onclick=\"edit_user('$d')\"><i class=\"fa fa-edit\"></i> edit</button> <a class=\"btn btn-xs btn-danger\" title=\"non aktifkan user\" href=".base_url()."admin/pengguna/validasi/$d><i class=\"glyphicon glyphicon-pencil\"></i> disabled</a>  <button title=\"delete user\" class=\"btn btn-xs btn-danger\" onclick=\"delete_user('$d')\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
                    }else{
                        return "<button title=\"edit user\" disabled=\"true\" class=\"btn btn-xs btn-warning\" onclick=\"edit_user('$d')\"><i class=\"fa fa-edit\"></i> edit</button> <a class=\"btn btn-xs btn-success\" title=\"aktifkan user\" href=".base_url()."admin/pengguna/validasi2/$d><i class=\"glyphicon glyphicon-pencil\"></i> enabled</a>  <button title=\"delete user\" class=\"btn btn-xs btn-danger\" disabled=\"true\" onclick=\"delete_user('$d')\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
                    }
				}
				)
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
		$this->template->load('template','admin/pengguna');
	}

    public function ajax_add()
    {
        //$this->_validate();
        $karyawan = $this->input->post('id_karyawan');
        $password = $this->input->post('password');
        $data = array(
                'id_karyawan'   => $karyawan,
                'username'      => $this->input->post('username'),
                'password'      => password_hash($password, PASSWORD_DEFAULT),
                'status'        => 'aktif',
                'level'         => $this->input->post('level'),
            );
        $data2 = array(
                'login'   => 'oke',
                'status'  => 'aktif',
            );
        $this->M_pengguna->save($data);
        $this->M_pengguna->update_karyawan(array('id_karyawan' => $karyawan), $data2);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($id)
    {
        $data = $this->M_pengguna->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        $password = $this->input->post('password');
        if($password == ""){
            $data = array(
                'username'      => $this->input->post('username'),
                'level'         => $this->input->post('level'),
            );
        }else{
            $data = array(
                'username'      => $this->input->post('username'),
                'password'      => password_hash($password, PASSWORD_DEFAULT),
                'level'         => $this->input->post('level'),
            );
        }
    
        $this->M_pengguna->update(array('id_login' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function validasi(){
        $this->M_pengguna->validasi();
        $this->session->set_flashdata('non','Status user sudah di non aktifkan');
        redirect ('admin/pengguna');
    }

    public function validasi2(){
        $this->M_pengguna->validasi2();
        $this->session->set_flashdata('aktif','Status user sudah di aktifkan');
        redirect ('admin/pengguna');
    }












    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('nama_lengkap') == '')
        {
            $data['inputerror'][] = 'nama_lengkap';
            $data['error_string'][] = 'Mohon isi nama lengkap';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('username') == '')
        {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Mohon isi username';
            $data['status'] = FALSE;
        }

        if($this->input->post('password') == '')
        {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Mohon isi password';
            $data['status'] = FALSE;
        }
  
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
