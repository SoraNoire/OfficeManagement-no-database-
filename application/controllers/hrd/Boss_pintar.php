<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Boss_pintar extends CI_Controller {
    private $filename = "import_data_boss_pintar"; // Kita tentukan nama filenya
    
    function __construct(){
        parent::__construct();
        //chekAksesModule();
        $this->load->model('M_boss_pintar');
        if($this->session->userdata('id_karyawan') == ''){
            redirect('');
        }
    }

    public function index()
    {   
        $data['absen'] = $this->M_boss_pintar->view();
        $this->template->load('template','absen/upload_data_boss', $data);
    }

    public function form_upload(){
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
			$upload = $this->M_boss_pintar->upload_file($this->filename);
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
        //$this->load->view('form_absen', $data);
        $this->template->load('template','absen/upload_form_boss', $data);
	}

    public function import_data(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
        $user_import = $this->session->userdata('id_karyawan');
		$numrow = 1;
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
                // Kita push (add) array data ke variabel data
                $ubah_format_tgl = date("Y-m-d",strtotime($row['A']));
				array_push($data, array(
					'nik'       =>$row['F'], // Insert data nik dari kolom F di excel
					'nama'      =>$row['G'], // Insert data nama dari kolom G di excel
					'tanggal'   =>$ubah_format_tgl, // Insert data tanggal dari kolom A di excel
					'tgl_awal'  =>$row['H'], // Insert data tgl_awal dari kolom H di excel
                    'tgl_akhir' =>$row['I'],
                    'cabang'    =>$row['E'],
                    'kategori'  =>$row['B'],
                    'user_import'=> $user_import,
				));
			}
			$numrow++; // Tambah 1 setiap kali looping
		}
		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->M_boss_pintar->insert_multiple($data);
		redirect("hrd/boss_pintar"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}

    public function rekap_absen(){
        $this->template->load('template','absen/rekap_absen_boss');
    }

    public function proses_rekap(){
        $sess_periode['periode'] = $this->input->post('reservation');
        $this->session->set_userdata($sess_periode);
        redirect("hrd/boss_pintar/rekap_absen");
    }

    public function rekap_absen_detail(){
        $this->template->load('template','absen/rekap_detail_absen_boss');
    }

    public function proses_rekap_detail(){
        $sess_periode['periode'] = $this->input->post('reservation');
        $this->session->set_userdata($sess_periode);
        redirect("hrd/boss_pintar/rekap_absen_detail");
    }

    public function form_upload_detail(){
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
			$upload = $this->M_boss_pintar->upload_file_detail($this->filename);
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
        //$this->load->view('form_absen', $data);
        $this->template->load('template','absen/upload_detail_form_boss', $data);
	}

    public function import_data_detail(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
        $user_import = $this->session->userdata('id_karyawan');
		$numrow = 1;
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
                // Kita push (add) array data ke variabel data
                $ubah_format_tgl = date("Y-m-d",strtotime($row['G']));
                $ubah_format_log = date("Y-m-d H:i:s",strtotime($row['G']));
				array_push($data, array(
					'nik'       =>$row['B'], // Insert data nik dari kolom F di excel
					'nama'      =>$row['C'], // Insert data nama dari kolom G di excel
					'tanggal'   =>$ubah_format_tgl, // Insert data tanggal dari kolom A di excel
                    'log_date'  =>$ubah_format_log,
                    'cabang'    =>$row['D'],
                    'kategori'  =>$row['E'],
                    'id_user'   => $user_import,
				));
			}
			$numrow++; // Tambah 1 setiap kali looping
		}
		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->M_boss_pintar->insert_multiple_detail($data);
		redirect("hrd/boss_pintar"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}

































    public function dataKehadiran(){
        $periode    = $_GET['periode'];
        $awal       = substr($periode, 0,10);
        $tgl_awal   = date("Y-m-d",strtotime($awal));
        $akhir      = substr($periode, 13);
        $tgl_akhir  = date("Y-m-d",strtotime($akhir));
        
        $bulan      = substr($periode, 0,2); //mengambil bulan pada tanggal awal
        $tahun	    = date("Y");
        //$jumlahhari = date("t",mktime(0,0,0,$bulan,$hari,$tahun));
        //echo $jumlahhari;
        $jumlahhari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $tgl        = substr($periode, 3,2);
        $tgl2       = substr($periode, 16,2);
        $bulan_awal = substr($tgl_awal, 0,8);
        $bulan_akhir= substr($tgl_akhir, 0,8);

        echo "
        <table id='mytable' class='table table-striped table-bordered'>
            <thead>
                <tr>
                <th width='40px'>No</th>
                <th width='260px'>Nama Karyawan</th>";
                for ($i=$tgl; $i < $jumlahhari+1; $i++) { 
                    echo "<th>". $i ."</th>";
                }
                for ($j=1; $j < $tgl2+1; $j++){
                    echo "<th>". $j ."</th>";
                }
                echo "</tr>
            </thead>";

            $sql    = "SELECT * FROM abe_absensi_boss_pintar WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' GROUP BY nik";
            $absen  = $this->db->query($sql)->result();
            $no = 1;
            foreach ($absen as $row) {
               echo "<tr>
                    <td>$no</td>
                    <td>$row->nama</td>";
                    $nik        = $row->nik;
                    for ($i=$tgl; $i < $jumlahhari+1; $i++) {
                        $tgl_absen  = $bulan_awal.$i;
                        $hari = date("D", strtotime($tgl_absen));
                        //echo $hari;
                        //echo $tgl_absen." - ";
                        $jam_awal   = $this->db->query("SELECT nik, tanggal, tgl_awal, tgl_akhir FROM abe_absensi_boss_pintar WHERE nik = $nik AND tanggal = '$tgl_absen' AND kategori = 'working' GROUP BY nik")->row_array();
                        $jam_masuk  = date('H:i', strtotime($jam_awal['tgl_awal']));
                        $jam_pulang = date('H:i', strtotime($jam_awal['tgl_akhir']));
                        if($jam_awal['tgl_awal'] == ''){
                            if($hari == 'Sat' OR $hari == 'Sun'){
                                echo "<td style='color:#FF0000'>Non</td>";
                            }else{
                                echo "<td>Non</td>";
                            }
                        }else{
                            echo "<td>".$jam_masuk."<br>".$jam_pulang."</td>";
                        }
                    }
                    for ($j=1; $j < $tgl2+1; $j++){
                        $tgl_absen  = $bulan_akhir.$j;
                        $hari = date("D", strtotime($tgl_absen));
                        //echo $tgl_absen." - ";
                        $jam_awal   = $this->db->query("SELECT nik, tanggal, tgl_awal, tgl_akhir FROM abe_absensi_boss_pintar WHERE nik = $nik AND tanggal = '$tgl_absen' AND kategori = 'working'")->row_array();
                        $jam_masuk  = date('H:i', strtotime($jam_awal['tgl_awal']));
                        $jam_pulang = date('H:i', strtotime($jam_awal['tgl_akhir']));
                        if($jam_awal['tgl_awal'] == ''){
                            if($hari == 'Sat' OR $hari == 'Sun'){
                                echo "<td style='color:#FF0000'>Non</td>";
                            }else{
                                echo "<td>Non</td>";
                            }
                        }else{
                            echo "<td>".$jam_masuk."<br>".$jam_pulang."</td>";
                        }
                    }
                echo "</tr><tr><td colspan='2'>Keterlambatan</td>";
                $total_telat = 0;
                for ($i=$tgl; $i < $jumlahhari+1; $i++) {
                    $tgl_absen  = $bulan_awal.$i;
                    $hari = date("D", strtotime($tgl_absen));
                    //echo $hari;
                    //echo $tgl_absen." - ";
                    $jam_awal   = $this->db->query("SELECT nik, tanggal, tgl_awal, tgl_akhir FROM abe_absensi_boss_pintar WHERE nik = $nik AND tanggal = '$tgl_absen' AND kategori = 'working' GROUP BY nik")->row_array();
                    $jam_masuk  = date('H:i', strtotime($jam_awal['tgl_awal']));
                    $jam_pulang = date('H:i', strtotime($jam_awal['tgl_akhir']));
                    
                    if($jam_awal['tgl_awal'] == ''){
                        if($hari == 'Sat' OR $hari == 'Sun'){
                            echo "<td style='color:#FF0000'>Non</td>";
                        }else{
                            echo "<td>Non</td>";
                        }
                    }else{
                        if($jam_masuk >= '08:16'){
                            $telat = round((strtotime($jam_masuk) - strtotime('08:15'))/60, 1);
                            echo "<td style='color:#FF0000'>".$telat."</td>";
                            $total_telat = $total_telat + $telat;
                        }else{
                            echo "<td> - </td>";
                        }
                    }
                    
                }
                for ($j=1; $j < $tgl2+1; $j++){
                    $tgl_absen  = $bulan_akhir.$j;
                    $hari = date("D", strtotime($tgl_absen));
                    //echo $tgl_absen." - ";
                    $jam_awal   = $this->db->query("SELECT nik, tanggal, tgl_awal, tgl_akhir FROM abe_absensi_boss_pintar WHERE nik = $nik AND tanggal = '$tgl_absen' AND kategori = 'working'")->row_array();
                    $jam_masuk  = date('H:i', strtotime($jam_awal['tgl_awal']));
                    $jam_pulang = date('H:i', strtotime($jam_awal['tgl_akhir']));
                    if($jam_awal['tgl_awal'] == ''){
                        if($hari == 'Sat' OR $hari == 'Sun'){
                            echo "<td style='color:#FF0000'>Non</td>";
                        }else{
                            echo "<td>Non</td>";
                        }
                    }else{
                        if($jam_masuk >= '08:16'){
                            $telat = round((strtotime($jam_masuk) - strtotime('08:15'))/60, 1);
                            echo "<td style='color:#FF0000'>".$telat."</td>";
                            $total_telat = $total_telat + $telat;
                        }else{
                            echo "<td> - </td>";
                        }
                    }
                    
                }
                
                echo "<td>".$total_telat."</td></tr>";
            $no++;
        }
        echo "</table>";
    }






    public function data_absen()
    {   
        $this->template->load('template','absen/data_absen_all_user');
    }

    public function hari_ini()
    {   
        $this->template->load('template','absen/data_absen_all_user_hari_ini');
    }

    public function shorting()
    {
        $this->template->load('template','absen/absen_shorting');
    }

    public function shorting_all()
    {
        $this->template->load('template','absen/absen_shorting_all');
    }

    public function dataKehadiranKaryawan(){
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $periode = $bulan.' '.$tahun ;
        $karyawan = $_GET['karyawan'];
        $hari_indonesia = array('Monday'  => 'Senin',
                        'Tuesday'  => 'Selasa',
                        'Wednesday' => 'Rabu',
                        'Thursday' => 'Kamis',
                        'Friday' => 'Jumat',
                        'Saturday' => 'Sabtu',
                        'Sunday' => 'Minggu');

        echo "
        <table id='mytable' class='table table-striped table-bordered'>
                <thead>
                  <tr>
                    <th width='40px'>No</th>
                    <th width='150px'>Hari / Tanggal</th>
                    <th width='100px'>Jam Masuk</th>
                    <th width='100px'>Jam Pulang</th>
                    <th width='160px'>Status Kehadiran</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>";
            //$id = $this->session->userdata('id_karyawan');
            //$tgl = date('d-m-Y');
            $sql = "SELECT * FROM abe_absen WHERE id_karyawan = $karyawan AND periode = '$periode' ORDER BY tgl_absen ASC";
            $absen = $this->db->query($sql)->result();
            $no = 1;
            foreach ($absen as $row) {
                $hari   = date('l', strtotime($row->tanggal));
                $jam_masuk = date('H:i:s', strtotime($row->tgl_absen));
                $jam_pulang = date('H:i:s', strtotime($row->tgl_pulang));

                echo "<tr>
                        <td>$no</td>
                        <td>$hari_indonesia[$hari] / ".date('d-m-Y', strtotime($row->tanggal))."</td>
                        <td>";
                    if($jam_masuk == '01:00:00'){
                        echo " - ";
                    }else{
                        echo $jam_masuk;
                    }
                echo "</td><td>";
                    if($jam_pulang == '01:00:00'){
                        echo " - ";
                    }else{
                        echo $jam_pulang;
                    }
                echo "</td>
                        <td>$row->status</td>
                        <td>$row->keterangan</td>
                     </tr>";
                $no++;
            }
        echo "</table>";
    }

    public function dataKehadiranAll(){
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $periode = $bulan.' '.$tahun ;
        $posisi = $_GET['posisi'];
        $department = $_GET['department'];
        $hari_indonesia = array('Monday'  => 'Senin',
                        'Tuesday'  => 'Selasa',
                        'Wednesday' => 'Rabu',
                        'Thursday' => 'Kamis',
                        'Friday' => 'Jumat',
                        'Saturday' => 'Sabtu',
                        'Sunday' => 'Minggu');
        echo "
        <table id='mytable' class='table table-striped table-bordered'>
                <thead>
                  <tr>
                    <th width='40px'>No</th>
                    <th width='260px'>Nama Karyawan</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>";
            if($department == 'all'){
                $department1 = "";
            }else{
                $department1 =  "AND ak.department = '$department'";
            }
            $sql = "SELECT aa.*, ak.id_karyawan, ak.nama_lengkap
                    FROM abe_absen as aa, abe_karyawan as ak
                    WHERE ak.id_karyawan = aa.id_karyawan AND ak.posisi = '$posisi' $department1 AND aa.periode = '$periode' GROUP BY aa.id_karyawan";
            $absen = $this->db->query($sql)->result();
            $no = 1;
            foreach ($absen as $row) {
               echo "<tr>
                        <td>$no</td>
                        <td>$row->nama_lengkap</td>
                        <td><table class='table table-striped table-bordered'>";
                        $karyawan2 = $row->id_karyawan;
                        $sql2 = "SELECT * FROM abe_absen WHERE id_karyawan = $karyawan2 AND periode = '$periode' ORDER BY tanggal ASC";
                        $absen2 = $this->db->query($sql2)->result();
                        foreach ($absen2 as $row2) {
                            $hari   = date('l', strtotime($row2->tanggal));
                            $jam_masuk = date('H:i:s', strtotime($row2->tgl_absen));
                            $jam_pulang = date('H:i:s', strtotime($row2->tgl_pulang));
                            echo "<tr>
                                <td width='180px'>$hari_indonesia[$hari] / ".date('d-m-Y', strtotime($row2->tanggal))."</td>
                                <td width='100px'>";
                            if ($jam_masuk == '01:00:00'){
                                echo " - ";
                            }else{
                                echo $jam_masuk;
                            }
                            echo "</td><td width='100px'>";
                            if ($jam_pulang == '01:00:00'){
                                echo " - ";
                            }else{
                                echo $jam_pulang;
                            }
                            echo "</td>
                                <td width='130px'>$row2->status</td>
                                <td>$row2->keterangan</td></tr>";
                            }
                        echo "
                        </table></td>                        
                     </tr>";
                $no++;
            }
        echo "</table>";
    }
}
