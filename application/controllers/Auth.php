<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        //chekAksesModule();
        $this->load->model('M_pengguna');
    }

	public function index(){
		if($this->session->userdata('username') != ''){
            
			$this->template->load('template','dashboard');
		}else{
			$this->load->view('auth');	
		}
	} 

    public function masuk_kam(){
        if($this->session->userdata('posisi') == 'JAKARTA'){
            $this->template->load('template','kam/dashboard');
        }else{
            $this->session->set_flashdata('gagal','mohon maaf, anda tidak mempunyai akses ke perusahaan ini');
            redirect('');  
        }
    } 

    public function masuk_san(){
        if($this->session->userdata('posisi') == 'JAKARTA'){
            $this->template->load('template','san/dashboard');
        }else{
            $this->session->set_flashdata('gagal','mohon maaf, anda tidak mempunyai akses ke perusahaan ini');
            redirect(''); 
        }
    } 

    public function cek_login(){
        //$this->_validate();
        if (isset($_POST['submit'])){
            $username = $this->input->post('username');
            $sql = "SELECT password FROM abe_login WHERE username = '$username'";
            $password = $this->db->query($sql)->row_array();
            //mendapatkan nilai hash dari database
            $hash = $password['password'] ;
            $karyawan = $password['id_karyawan'];
            $result = $this->M_pengguna->cekLogin($username, $hash, $karyawan);
            if (password_verify($_POST['password'], $hash)) {
                $this->session->set_userdata($result);
                //echo ('tes');
                if($this->session->userdata('nama_lengkap') == ''){
                   $this->session->set_flashdata('disabled','username / password anda tidak aktif');
                   redirect(''); 
                }else{
                    $karyawan = $this->session->userdata('id_karyawan');
                    date_default_timezone_set('Asia/Jakarta');
                    $waktu = date('Y-m-d H:i:s');
                    $data = array(
                            'id_karyawan'   => $karyawan,
                            'waktu'         => $waktu,
                        );
                    $this->M_pengguna->save_login($data);
                    redirect('');
                }
                
            } else {
                $this->session->set_flashdata('gagal','username / password anda salah');
                redirect('');
            }
            //print_r($result);
        }else{
           redirect('auths');
       }
    }

	public function cek_login_abe(){
		//$this->_validate();
		if (isset($_POST['submit'])){
            $username = $this->input->post('username');
            $sql = "SELECT password FROM tabel_user WHERE username = '$username'";
            $password = $this->db->query($sql)->row_array();
            //mendapatkan nilai hash dari database
            $hash = $password['password'] ;
            $result = $this->Model_pengguna->cekLogin($username, $hash);
            if (password_verify($_POST['password'], $hash)) {
                $this->session->set_userdata($result);
                //$this->session->set_flashdata('berhasil','Terimakasih');
                redirect('');
            } else {
                $this->session->set_flashdata('gagal','username / password anda salah');
                redirect('');
            }
            //print_r($result);
        }else{
            redirect('auth');
        }
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('');
	}

	private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('username') == '')
        {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Mohon isi username anda';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('password') == '')
        {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Mohon isi password anda';
            $data['status'] = FALSE;
        }
  
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }

    }

    public function error()
    {
    	$this->load->view('404');
    }

    public function akses()
    {
    	$this->load->view('akses');
    }
}