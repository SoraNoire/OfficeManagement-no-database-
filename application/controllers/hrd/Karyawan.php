<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

	function __construct(){
		parent::__construct();
        chekAksesModule();
        $this->load->library('Pdf');
		$this->load->model(array('M_karyawan','M_pengguna'));
        if($this->session->userdata('id_karyawan') == ''){
            redirect('');
        }
	}

    public function all(){
        $this->template->load('template','hrd/karyawan/list_karyawan');
    }

    public function detail(){
        $this->template->load('template','hrd/karyawan/detail_karyawan');
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
            //array('db' => 'status', 'dt' => 'status'),
            array(
                'db' => 'id_karyawan',
                'dt' => 'status',
                'formatter' => function($k){
                    $ci =& get_instance();
                    $ci->db->select('*');
                    $ci->db->from('abe_karyawan_status');
                    $ci->db->where("id_karyawan", $k);
                    $ci->db->order_by('id_k_status','desc');
                    $status = $ci->db->get()->row_array();
                    return isset($status["status"]) ? $status["status"] : '';
                }
            ),
			array(
				'db' => 'id_karyawan',
				'dt' => 'aksi',
				'formatter' => function($d){
                    return "<a class=\"btn btn-xs btn-warning\" title=\"ubah data karyawan\" href=".base_url()."hrd/karyawan/edit/$d><i class=\"glyphicon glyphicon-pencil\"></i></a>
                    <a class=\"btn btn-xs btn-warning\" title=\"create history\" href=".base_url()."hrd/karyawan/history/$d><i class=\"fa fa-list\"></i></a>
                    <a class=\"btn btn-xs btn-warning\" title=\"status karyawan\" href=".base_url()."hrd/karyawan/status/$d><i class=\"fa fa-book\"></i></a>
                    <a class=\"btn btn-xs btn-primary\" title=\"cetak data karyawan\" href=".base_url()."><i class=\"fa fa-print\"></i></a>
                    ".anchor("hrd/karyawan/nonaktifkan/$d" ,'<i class="glyphicon glyphicon-remove"></i>', array('class'=>'btn btn-danger btn-xs', 'title'=>'non aktifkan', 'onclick'=>'javasciprt: return confirm(\'Anda yakin ingin menonaktifkan user ini !! \')'))."";
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

    public function non_aktif()
    {
        $this->template->load('template','hrd/karyawan/non_aktif');
    }

    public function add()
    {
        $data['propinsi'] = $this->db->get('provinces');
        $data['propinsi2'] = $this->db->get('provinces');
        $this->template->load('template','hrd/karyawan/form_add_karyawan',$data);
    }
    
    public function history()
    {
        $this->template->load('template','hrd/karyawan/history_karyawan');
    }

    public function status()
    {
        $this->template->load('template','hrd/karyawan/status_karyawan');
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
        $karyawan_baru = $this->db->query("SELECT id_karyawan FROM abe_karyawan ORDER BY id_karyawan DESC LIMIT 1")->row_array();
        $id_karyawan_baru = $karyawan_baru['id_karyawan'];
        $data2 = array('id_karyawan'=> $id_karyawan_baru);
        $this->M_karyawan->id_jobdesk_new($data2);


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
        $tgl_lahir = date('Y-m-d', strtotime($this->input->post('tgl_lahir')));
        $tgl_gabung = date('Y-m-d', strtotime($this->input->post('tgl_gabung')));
        if($status_pernikahan == "menikah")
        {
            $status = "k";
        }else{
            $status = "tk";
        }
        $tanggungan = "$status/$anak";

        $propinsi = $this->input->post('propinsi');
        $propinsi_ktp = $this->input->post('propinsi_ktp');
        if($propinsi_ktp == '0' AND $propinsi == '0'){
            $data = array(
                'nama_lengkap'  => $this->input->post('nama_lengkap'),
                'kode_karyawan' => $kode,
                'jabatan'       => $this->input->post('jabatan'),
                'department'    => $this->input->post('department'),
                'tempat_lahir'  => $this->input->post('tempat_lahir'),
                'tgl_lahir'     => $tgl_lahir,
                'nik_ktp'       => $nik,
                'alamat_ktp'    => $this->input->post('alamat_ktp'),
                'alamat'        => $this->input->post('alamat'),
                'phone'         => $phone,
                'mobile'        => $mobile,
                'status_pernikahan'     => $status_pernikahan,
                'tgl_gabung'    => $tgl_gabung,
                'id_pt'         => $this->input->post('id_pt'),
                'posisi'        => $this->input->post('posisi'),
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
        }else if($propinsi_ktp != '0' AND $propinsi == '0'){
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
                'phone'         => $phone,
                'mobile'        => $mobile,
                'status_pernikahan'     => $status_pernikahan,
                'tgl_gabung'    => $tgl_gabung,
                'id_pt'         => $this->input->post('id_pt'),
                'posisi'        => $this->input->post('posisi'),
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
        }else if($propinsi_ktp =='0' AND $propinsi !='0'){
            $data = array(
                'nama_lengkap'  => $this->input->post('nama_lengkap'),
                'kode_karyawan' => $kode,
                'jabatan'       => $this->input->post('jabatan'),
                'department'    => $this->input->post('department'),
                'tempat_lahir'  => $this->input->post('tempat_lahir'),
                'tgl_lahir'     => $tgl_lahir,
                'nik_ktp'       => $nik,
                'alamat_ktp'    => $this->input->post('alamat_ktp'),
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
        }else{
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
        }

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

    public function proses_history()
    {  
        //$this->_validate();
        $user       = $this->session->userdata('id_karyawan');
        $tgl_aktif = date('Y-m-d', strtotime($this->input->post('tgl_aktif')));
        date_default_timezone_set('Asia/Jakarta');
        $tgl_input = date('Y-m-d H:i:s');
        $id = $this->input->post('karyawan');

        $data = array(
            'id_karyawan'   => $id,
            'kategori'      => $this->input->post('kategori'),
            'keterangan'    => $this->input->post('keterangan'),
            'tgl_aktif'     => $tgl_aktif,
            'tgl_input'     => $tgl_input,
            'id_input'      => $user,
        );
        $insert = $this->M_karyawan->save_history($data);
        $this->session->set_flashdata('sukses','Data History Karyawan Berhasil Di tambahkan<br>Mohon untuk update data karyawan sesuai dengan penambahan history<br> Terima Kasih');
        //redirect('hrd/karyawan/history');
        header('location:'.base_url().'hrd/karyawan/history/'.$id);
    }

    public function proses_status()
    {  
        //$this->_validate();
        $user       = $this->session->userdata('id_karyawan');
        $tgl_awal   = date('Y-m-d', strtotime($this->input->post('tgl_awal')));
        $tgl_akhir  = date('Y-m-d', strtotime($this->input->post('tgl_akhir')));
        date_default_timezone_set('Asia/Jakarta');
        $tgl_input  = date('Y-m-d H:i:s');
        $id         = $this->input->post('karyawan');

        $data = array(
            'id_karyawan'   => $id,
            'status'        => $this->input->post('status'),
            'keterangan'    => $this->input->post('keterangan'),
            'tgl_awal'      => $tgl_awal,
            'tgl_akhir'     => $tgl_akhir,
            'tgl_input'     => $tgl_input,
            'id_input'      => $user,
        );
        $insert = $this->M_karyawan->save_status($data);
        $this->session->set_flashdata('sukses','Data Status Karyawan Berhasil Di tambahkan<br>Mohon untuk update data karyawan sesuai dengan perubahan status karyawan<br> Terima Kasih');
        //redirect('hrd/karyawan/status');
        header('location:'.base_url().'hrd/karyawan/status/'.$id);
    }

    public function profile_history()
    {
        //$id = $this->session->userdata('id_karyawan');
        $id = $this->uri->segment(4);
        $data['record'] = $this->M_pengguna->profile_karyawan($id)->row_array();
        $this->template->load('template','hrd/karyawan/profile_history',$data);
    }

    public function aktifkan(){
        $this->M_karyawan->aktifkan_user();
        $this->session->set_flashdata('non','Status user sudah di aktifkan kembali');
        redirect ('hrd/karyawan');
    }

    public function nonaktifkan(){
        $this->M_karyawan->nonaktifkan_user();
        $this->session->set_flashdata('non','Status user sudah di nonaktifkan');
        redirect ('hrd/karyawan/non_aktif');
    }

    public function dataJobdesk(){
        //$no_rapat = $this->M_rapat->get_kode_rapat();
        $id_karyawan = $_GET['id_karyawan'];
        echo "<table class='table table-bordered table-striped' >
                <thead>
                  <tr>
                    <th width='30px'>No</th>
                    <th>Jobdesk</th>
                    <th width='220px'>Aksi</th>
                  </tr>
                </thead>";
            $sql_jobdesk    = "SELECT * FROM abe_jobdesk WHERE id_karyawan = '$id_karyawan'";
            $jobdesk        = $this->db->query($sql_jobdesk)->result();
            if(empty($jobdesk)){
                echo "<tr><td colspan='3'><center>Belum ada Jobdesk</center></td></tr>";
            }else{
                $no = 1;
                foreach ($jobdesk as $row) {
                    echo "<tr><td>$no</td>";
                    echo "<td>$row->detail</td>";
                    echo "<td><a href='#' onclick='delete_jobdesk($row->id_jobdesk)' class='btn btn-xs btn-danger' title='hapus jobdesk'><i class='fa fa-trash'></i> Hapus</a>";
                    echo "<a href='#' onclick='edit_jobdesk($row->id_jobdesk)' class='btn btn-xs btn-warning' title='edit jobdesk'><i class='fa fa-edit'></i> Edit</a>
                          </td></tr>";
                    $no++;
                }
            }
        echo "</table>";
    }
    public function add_jobdesk()
    {
        $data = array(
                'detail'        => $this->input->post('detail'),
                'id_karyawan'   => $this->input->post('id_karyawan'),
                'id_input'      => $this->input->post('id_input'),
            );
        $insert = $this->M_karyawan->save_jobdesk($data);
        echo json_encode(array("status" => TRUE));
    }

    public function hapus_jobdesk($id)
    {
        //$jobdesk = $this->M_karyawan->id_jobdesk($id);        
        $this->M_karyawan->hapus_jobdesk($id);
        echo json_encode(array("status" => TRUE));
    }

    public function print_pdf(){
        $id = $this->uri->segment(4);
        $data['record'] = $this->M_karyawan->detail_karyawan($id)->row_array();
        $this->load->view('hrd/karyawan/print_pdf',$data);
    }

    public function cetak_excel(){
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';
        
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('masabe')
                ->setLastModifiedBy('masabe')
                ->setTitle("Data Karyawan")
                ->setSubject("Karyawan")
                ->setDescription("Laporan Semua Data Karyawan")
                ->setKeywords("Data Karyawan");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
                'font'      => array('bold' => true), // Set font nya jadi bold
                'alignment' => array(
                'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders'   => array(
                'top'       => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right'     => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom'    => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left'      => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
                'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
                'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA KARYAWAN"); // Set kolom A1 dengan tulisan "DATA KARYAWAN"
        $excel->getActiveSheet()->mergeCells('A1:R1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NIK Karyawan"); // Set kolom B3 dengan tulisan "NIK Karyawan"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "Nama Lengkap");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "Jenis Kelamin");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "Divisi"); 
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "Jabatan");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "Perusahaan");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "Tgl Masuk");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "Status Karyawan");
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "Tempat Lahir");
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "Tgl Lahir");
        $excel->setActiveSheetIndex(0)->setCellValue('L3', "Agama");
        $excel->setActiveSheetIndex(0)->setCellValue('M3', "No Telpon");
        $excel->setActiveSheetIndex(0)->setCellValue('N3', "ID KTP");
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "Alamat Tinggal");
        $excel->setActiveSheetIndex(0)->setCellValue('P3', "Desa");
        $excel->setActiveSheetIndex(0)->setCellValue('Q3', "Kecamatan");
        $excel->setActiveSheetIndex(0)->setCellValue('R3', "Kabupaten");
        $excel->setActiveSheetIndex(0)->setCellValue('S3', "Propinsi");
        $excel->setActiveSheetIndex(0)->setCellValue('T3', "Status Pernikahan");
        
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('T3')->applyFromArray($style_col);
    
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $karyawan = $this->M_karyawan->export_excel();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        //$propinsi   = $data->propinsi;
        
        foreach($karyawan as $data){ // Lakukan looping pada variabel karyawan
            $propinsi   = $this->db->get_where('provinces',array('id'=>$data->propinsi))->row_array();
            $kabupaten  = $this->db->get_where('regencies',array('id'=>$data->kabupaten))->row_array();
            $kecamatan  = $this->db->get_where('districts',array('id'=>$data->kecamatan))->row_array();
            $desa       = $this->db->get_where('villages',array('id'=>$data->desa))->row_array();
            $perusahaan = $this->db->get_where('abe_pt',array('id_pt'=>$data->id_pt))->row_array();
            $status     = $this->db->query("SELECT * FROM abe_karyawan_status WHERE id_karyawan = '$data->id_karyawan' ORDER BY id_k_status DESC")->row_array();
            $tgl_gabung = date('d-m-Y', strtotime($data->tgl_gabung));
            $tgl_lahir  = date('d-m-Y', strtotime($data->tgl_lahir));
            
            
            //$alamat     = $data->alamat.' '.$desa.' '.$kecamatan;       

            $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->kode_karyawan);
            $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->nama_lengkap);
            $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->kelamin);
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->department);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->jabatan);
            $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $perusahaan['nama_pt']);
            //$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->tgl_gabung);
            $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $tgl_gabung);
            $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $status['status']);
            $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->tempat_lahir);
            $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $tgl_lahir);
            $excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->agama);
            $excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data->mobile);
            $excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data->nik_ktp);
            $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $data->alamat);
            //$excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $alamat);
            $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $desa['name']);
            $excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $kecamatan['name']);
            $excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $kabupaten['name']);
            $excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $propinsi['name']);
            $excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $data->status_pernikahan);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('T'.$numrow)->applyFromArray($style_row);
            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(26);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(13);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(17);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(13);
        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(13);
        $excel->getActiveSheet()->getColumnDimension('M')->setWidth(14);
        $excel->getActiveSheet()->getColumnDimension('N')->setWidth(18);
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(50);
        $excel->getActiveSheet()->getColumnDimension('P')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('Q')->setWidth(23);
        $excel->getActiveSheet()->getColumnDimension('R')->setWidth(24);
        $excel->getActiveSheet()->getColumnDimension('S')->setWidth(17);
        $excel->getActiveSheet()->getColumnDimension('T')->setWidth(17);
        
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Data Karyawan");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Karyawan.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
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
