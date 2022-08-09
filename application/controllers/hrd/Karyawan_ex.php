<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

	function __construct(){
		parent::__construct();
        //chekAksesModule();
		$this->load->model(array('M_karyawan'));
        if($this->session->userdata('id_karyawan') == ''){
            redirect('');
        }
	}

	function data(){
		$table 		= 'abe_karyawan';
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
            array('db' => 'status', 'dt' => 'status'),
			array(
				'db' => 'id_karyawan',
				'dt' => 'aksi',
				'formatter' => function($d){
					return "<a class=\"btn btn-xs btn-warning\" title=\"edit user\" href=".base_url()."hrd/karyawan/edit/$d><i class=\"glyphicon glyphicon-pencil\"></i> Edit</a> 
                        <button title=\"delete user\" disabled=\"true\" class=\"btn btn-xs btn-danger\" onclick=\"delete_pengguna('$d')\"><i class=\"glyphicon glyphicon-remove\"></i></button>";
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

    function kabupaten(){
        $propinsiID = $_GET['id'];
        $kabupaten   = $this->db->get_where('regencies',array('province_id'=>$propinsiID));
        echo "<select id='kabupaten' name='kabupaten_ktp' onChange='loadKecamatan()' class='form-control'>";
        foreach ($kabupaten->result() as $k)
        {
            echo "<option value='$k->id'>$k->name</option>";
        }
        echo "</select>";
    }
    
    function kabupaten2(){
        $propinsiID = $_GET['id'];
        $kabupaten   = $this->db->get_where('regencies',array('province_id'=>$propinsiID));
        echo "<select id='kabupaten2' name='kabupaten' onChange='loadKecamatan2()' class='form-control'>";
        foreach ($kabupaten->result() as $k)
        {
            echo "<option value='$k->id'>$k->name</option>";
        }
        echo "</select>";
    }

    function kecamatan(){
        $kabupatenID = $_GET['id'];
        $kecamatan   = $this->db->get_where('districts',array('regency_id'=>$kabupatenID));
        echo "<select id='kecamatan' name='kecamatan_ktp' onChange='loadDesa()' class='form-control'>";
        foreach ($kecamatan->result() as $k)
        {
            echo "<option value='$k->id'>$k->name</option>";
        }
    }

    function kecamatan2(){
        $kabupatenID = $_GET['id'];
        $kecamatan   = $this->db->get_where('districts',array('regency_id'=>$kabupatenID));
        echo "<select id='kecamatan2' name='kecamatan' onChange='loadDesa2()' class='form-control'>";
        foreach ($kecamatan->result() as $k)
        {
            echo "<option value='$k->id'>$k->name</option>";
        }
    }

    function desa(){
        $kecamatanID  = $_GET['id'];
        $desa         = $this->db->get_where('villages',array('district_id'=>$kecamatanID));
        echo "<select name='desa_ktp' class='form-control'>";
        foreach ($desa->result() as $d)
        {
            echo "<option value='$d->id'>$d->name</option>";
        }
    }

    function desa2(){
        $kecamatanID  = $_GET['id'];
        $desa         = $this->db->get_where('villages',array('district_id'=>$kecamatanID));
        echo "<select name='desa' class='form-control'>";
        foreach ($desa->result() as $d)
        {
            echo "<option value='$d->id'>$d->name</option>";
        }
    }
	public function index()
	{
        $this->template->load('template','hrd/karyawan');
	}

    public function add()
    {
        $data['propinsi'] = $this->db->get('provinces');
        $data['propinsi2'] = $this->db->get('provinces');
        $this->template->load('template','hrd/karyawan/form_add_karyawan',$data);
    }

    private function _do_upload()
    {
        $config['upload_path']          = 'assets/foto_karyawan';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 4000; //set max size allowed in Kilobyte
       // $config['max_width']            = 1000; // set max width image allowed
       // $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        //$this->load->library('upload', $config);
        $this->upload->initialize($config);

        if(!$this->upload->do_upload('foto')) //upload and validate
        {
            $data['inputerror'][] = 'foto';
            $data['error_string'][] = 'Upload error : '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    public function add_karyawan()
    {  
        //$this->_validate();
        $user       = $this->session->userdata('id_karyawan');
        $anak       = $this->input->post('tanggungan');
        $kode       = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('kode_karyawan'));
        $nik        = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('nik_ktp'));
        $phone      = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('phone'));
        $mobile     = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('mobile'));
        $tlpn_kerabat   = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('tlpn_kerabat'));
        $gapok      = preg_replace("/[^0-9]/", "", $this->input->post('gapok'));
        $ac_rekening    = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('ac_rekening'));
        $nomor_jpk  = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('nomor_jpk'));
        $nomor_npwp = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('nomor_npwp'));
        $status_pernikahan = $this->input->post('status_pernikahan');
        //$tgl_lahir = $this->input->post('tgl_lahir');
        $tgl_lahir = date('Y-m-d', strtotime($this->input->post('tgl_lahir')));
        $tgl_gabung = date('Y-m-d', strtotime($this->input->post('tgl_gabung')));
        if($status_pernikahan == "menikah")
        {
            $status = "k";
        }else{
            $status = "tk";
        }
        $tanggungan = "$status/$anak";

        $data = array(
            'nama_lengkap'  => $this->input->post('nama_lengkap'),
            'kode_karyawan' => $kode,
            'jabatan'       => $this->input->post('jabatan'),
            'department'    => $this->input->post('department'),
            'tempat_lahir'  => $this->input->post('tempat_lahir'),
            'tgl_lahir'     => $tgl_lahir,
            'nik_ktp'       => $nik,
            'alamat_ktp'    => $this->input->post('alamat_ktp'),
            'propinsi_ktp'  => $this->input->post('propinsi_ktp'),
            'kabupaten_ktp' => $this->input->post('kabupaten_ktp'),
            'kecamatan_ktp' => $this->input->post('kecamatan_ktp'),
            'desa_ktp'      => $this->input->post('desa_ktp'),
            'alamat'        => $this->input->post('alamat'),
            'propinsi'      => $this->input->post('propinsi'),
            'kabupaten'     => $this->input->post('kabupaten'),
            'kecamatan'     => $this->input->post('kecamatan'),
            'desa'          => $this->input->post('desa'),
            'phone'         => $phone,
            'mobile'        => $mobile,
            'status_pernikahan'     => $status_pernikahan,
            'tgl_gabung'    => $tgl_gabung,
            'id_pt'         => $this->input->post('id_pt'),
            'posisi'        => $this->input->post('posisi'),
            'status'        => 'aktif',
            'hubungan_kerabat'  => $this->input->post('hubungan_kerabat'),
            'nama_kerabat'  => $this->input->post('nama_kerabat'),
            'tlpn_kerabat'  => $tlpn_kerabat,
            'gapok'         => $gapok,
            'ac_rekening'   => $ac_rekening,
            'an_rekening'   => $this->input->post('an_rekening'),
            'catatan'       => $this->input->post('catatan'),
            'jmst'          => $this->input->post('jmst'),
            'ksht'          => $this->input->post('ksht'),
            'jkk'           => $this->input->post('jkk'),
            'nomor_jpk'     => $nomor_jpk,
            'tanggungan'    => $tanggungan,
            'npwp'          => $this->input->post('npwp'),
            'nomor_npwp'    => $nomor_npwp,
            'gjdrgp'        => $this->input->post('gjdrgp'),
            'user_input'    => $user,
        );
        if(!empty($_FILES['foto']['name']))
            {
                $upload = $this->_do_upload();
                $data['foto'] = $upload;
            }
        $insert = $this->M_karyawan->save($data);
        $this->session->set_flashdata('sukses','Data Karyawan Berhasil Di tambahkan');
        redirect('hrd/karyawan');
    }

    public function edit()
    {
        $id = $this->uri->segment(4);
        $data['record'] = $this->M_karyawan->detail_karyawan($id)->row_array();
        $data['propinsi'] = $this->db->get('provinces');
        $data['propinsi2'] = $this->db->get('provinces');
        //$data['record'] = $this->db->get_where('abe_karyawan', array('id_karyawan'=>'$id'));
        $this->template->load('template','hrd/karyawan/form_edit_karyawan',$data);
    }

    public function update_karyawan()
    {  
        //$this->_validate();
        $anak       = $this->input->post('tanggungan');
        $kode       = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('kode_karyawan'));
        $nik        = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('nik_ktp'));
        $phone      = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('phone'));
        $mobile     = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('mobile'));
        $tlpn_kerabat   = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('tlpn_kerabat'));
        $gapok      = preg_replace("/[^0-9]/", "", $this->input->post('gapok'));
        $ac_rekening    = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('ac_rekening'));
        $nomor_jpk  = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('nomor_jpk'));
        $nomor_npwp = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('nomor_npwp'));
        $status_pernikahan = $this->input->post('status_pernikahan');
        $tgl_lahir = date('Y-m-d', strtotime($this->input->post('tgl_lahir')));
        $tgl_gabung = date('Y-m-d', strtotime($this->input->post('tgl_gabung')));
        if($status_pernikahan == "menikah")
        {
            $status = "k";
        }else{
            $status = "tk";
        }
        $tanggungan = "$status/$anak";

        $data = array(
            'nama_lengkap'  => $this->input->post('nama_lengkap'),
            'kode_karyawan' => $kode,
            'jabatan'       => $this->input->post('jabatan'),
            'department'    => $this->input->post('department'),
            'tempat_lahir'  => $this->input->post('tempat_lahir'),
            'tgl_lahir'     => $tgl_lahir,
            'nik_ktp'       => $nik,
            'alamat_ktp'    => $this->input->post('alamat_ktp'),
            //'propinsi_ktp'  => $this->input->post('propinsi_ktp'),
            //'kabupaten_ktp' => $this->input->post('kabupaten_ktp'),
            //'kecamatan_ktp' => $this->input->post('kecamatan_ktp'),
            //'desa_ktp'      => $this->input->post('desa_ktp'),
            'alamat'        => $this->input->post('alamat'),
            //'propinsi'      => $this->input->post('propinsi'),
            //'kabupaten'     => $this->input->post('kabupaten'),
            //'kecamatan'     => $this->input->post('kecamatan'),
            //'desa'          => $this->input->post('desa'),
            'phone'         => $phone,
            'mobile'        => $mobile,
            'status_pernikahan'     => $status_pernikahan,
            'tgl_gabung'    => $tgl_gabung,
            'id_pt'         => $this->input->post('id_pt'),
            'posisi'        => $this->input->post('posisi'),
            //'status'        => 'aktif',
            'hubungan_kerabat'  => $this->input->post('hubungan_kerabat'),
            'nama_kerabat'  => $this->input->post('nama_kerabat'),
            'tlpn_kerabat'  => $tlpn_kerabat,
            'gapok'         => $gapok,
            'ac_rekening'   => $ac_rekening,
            'an_rekening'   => $this->input->post('an_rekening'),
            'catatan'       => $this->input->post('catatan'),
            'jmst'          => $this->input->post('jmst'),
            'ksht'          => $this->input->post('ksht'),
            'jkk'           => $this->input->post('jkk'),
            'nomor_jpk'     => $nomor_jpk,
            'tanggungan'    => $tanggungan,
            'npwp'          => $this->input->post('npwp'),
            'nomor_npwp'    => $nomor_npwp,
            'gjdrgp'        => $this->input->post('gjdrgp'),
        );
        if(!empty($_FILES['foto']['name']))
            {
                $upload = $this->_do_upload();
                $data['foto'] = $upload;
            }
        $id = $this->input->post('id_karyawan');
        //$where = array('id_karyawan' => $id);
        $update = $this->M_karyawan->update_karyawan($data, $id);
        $this->session->set_flashdata('sukses','Data Karyawan Berhasil Di ubah');
        redirect('hrd/karyawan');
    }









	public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'nama_lengkap' 	=> $this->input->post('nama_lengkap'),
                'jabatan' 		=> $this->input->post('jabatan'),
                'department'    => $this->input->post('department'),
                'tempat_lahir'  => $this->input->post('tempat'),
                'tgl_lahir'     => $this->input->post('tgl_lahir'),
                'nik_ktp'       => $this->input->post('nik'),
                'alamat_ktp'    => $this->input->post('alamat_ktp'),
                'alamat'        => $this->input->post('alamat'),
                'phone'         => $this->input->post('phone'),
                'mobile'        => $this->input->post('mobile'),
                'status_pernikahan'     => $this->input->post('status_pernikahan'),
                'tgl_gabung'    => $this->input->post('tgl_gabung'),
                'id_pt'         => $this->input->post('id_pt'),
                'posisi'        => $this->input->post('kota'),
                'status'        => 'aktif',
                'nama_kerabat'  => $this->input->post('nama_kerabat'),
                'tlpn_kerabat'  => $this->input->post('tlpn_kerabat'),
            );
        if(!empty($_FILES['foto']['name']))
            {
                $upload = $this->_do_upload();
                $data['foto'] = $upload;
            }
        $insert = $this->M_karyawan->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($id)
    {
        $data = $this->M_karyawan->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        //$this->_validate();
        $data = array(
                'nama_lengkap'  => $this->input->post('nama_lengkap'),
                'jabatan'       => $this->input->post('jabatan'),
                'department'    => $this->input->post('department'),
                'tempat_lahir'  => $this->input->post('tempat'),
                'tgl_lahir'     => $this->input->post('tgl_lahir'),
                'nik_ktp'       => $this->input->post('nik'),
                'alamat_ktp'    => $this->input->post('alamat_ktp'),
                'alamat'        => $this->input->post('alamat'),
                'phone'         => $this->input->post('phone'),
                'mobile'        => $this->input->post('mobile'),
                'status_pernikahan'     => $this->input->post('status_pernikahan'),
                'tgl_gabung'    => $this->input->post('tgl_gabung'),
                'id_pt'         => $this->input->post('id_pt'),
                'posisi'        => $this->input->post('kota'),
                'status'        => 'aktif',
                'nama_kerabat'  => $this->input->post('nama_kerabat'),
                'tlpn_kerabat'  => $this->input->post('tlpn_kerabat'),
            );
 
        if($this->input->post('remove_photo')) // if remove photo checked
        {
            if(file_exists('assets/foto_karyawan/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('assets/foto_karyawan/'.$this->input->post('remove_photo'));
            $data['foto'] = '';
        }
 
        if(!empty($_FILES['foto']['name']))
        {
            $upload = $this->_do_upload();
             
            //delete file
            $foto_pengguna = $this->M_karyawan->get_by_id($this->input->post('id'));
            if(file_exists('assets/foto_karyawan/'.$foto_pengguna->foto) && $foto_pengguna->foto)
                unlink('assets/foto_karyawan/'.$foto_pengguna->foto);
            $data['foto'] = $upload;
        }

        $this->M_karyawan->update(array('id_karyawan' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id)
    {

        $foto_pengguna = $this->Model_pengguna->get_by_id($id);
        if(file_exists('assets/foto_pengguna/'.$foto_pengguna->foto) && $foto_pengguna->foto)
            unlink('assets/foto_pengguna/'.$foto_pengguna->foto);
         
        $this->Model_pengguna->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('alamat_ktp') == '')
        {
            $data['inputerror'][] = 'alamat_ktp';
            $data['error_string'][] = 'Mohon isi Alamat sesuai KTP';
            $data['status'] = FALSE;
        }
        
        if($this->input->post('alamat') == '')
        {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Mohon isi Alamat Tinggal Sekarang';
            $data['status'] = FALSE;
        }

        if($this->input->post('tgl_gabung') == '')
        {
            $data['inputerror'][] = 'tgl_gabung';
            $data['error_string'][] = 'Mohon isi Tanggal Gabung';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
