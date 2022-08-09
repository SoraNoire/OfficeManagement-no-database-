<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct(){
		parent::__construct();
        //chekAksesModule();
		$this->load->model(array('M_pengguna'));
		if($this->session->userdata('id_karyawan') == ''){
            redirect('');
        }
	}

	public function index()
	{
		$id = $this->session->userdata('id_karyawan');
        $data['record'] = $this->M_pengguna->profile_karyawan($id)->row_array();
        $this->template->load('template','user/profile',$data);
	}

	public function ubah_password()
	{
		//$id = $this->session->userdata('id_karyawan');
        //$data['record'] = $this->M_pengguna->profile_karyawan($id)->row_array();
        $this->template->load('template','user/ubah_password');
	}

    public function proses_password(){

        $user = $this->session->userdata('id_karyawan');
        //$username2 = $this->input->post('username');
        $sql = "SELECT password FROM abe_login WHERE id_karyawan = '$user'";
        $password = $this->db->query($sql)->row_array();
        //mendapatkan nilai hash dari database
        $hash = $password['password'] ;
        //$karyawan = $password['id_karyawan'];
        //$result = $this->M_pengguna->ubahPassword($user, $hash, $karyawan);
        if (password_verify($_POST['password_old'], $hash)) {
           $password_new = $this->input->post('password');
           $data = array('password' => password_hash($password_new, PASSWORD_DEFAULT));
           $this->M_pengguna->ubahPassword(array('id_karyawan' => $user), $data);
           $this->session->set_flashdata('sukses','password anda berhasil di ubah');
           redirect('user/profile/ubah_password'); 
        }else {
            $this->session->set_flashdata('gagal','password lama yang anda input salah');
            redirect('user/profile/ubah_password');
        }
        
    }
}
