<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pertamina extends CI_Controller
{
    //private $filename = "import_data_boss_pintar"; // Kita tentukan nama filenya

    function __construct()
    {
        parent::__construct();
        //chekAksesModule();
        $this->load->model('M_pertamina');
        if ($this->session->userdata('id_karyawan') == '') {
            redirect('');
        }
    }

    public function index()
    {
        $this->template->load('template', 'pertamina/data_sounding_aspal');
    }

    public function form_upload()
    {
        $data = array(); // Buat variabel $data sebagai array

        if (isset($_POST['preview'])) { // Jika user menekan tombol Preview pada form
            // lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
            $upload = $this->M_boss_pintar->upload_file($this->filename);

            if ($upload['result'] == "success") { // Jika proses upload sukses
                // Load plugin PHPExcel nya
                include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

                $excelreader = new PHPExcel_Reader_Excel2007();
                $loadexcel = $excelreader->load('excel/' . $this->filename . '.xlsx'); // Load file yang tadi diupload ke folder excel
                $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

                // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
                // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
                $data['sheet'] = $sheet;
            } else { // Jika proses upload gagal
                $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
            }
        }
        //$this->load->view('form_absen', $data);
        $this->template->load('template', 'absen/upload_form_tabel_temperatur', $data);
    }

    public function import_data_temperatur()
    {
        // Load plugin PHPExcel nya
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('excel/' . $this->filename . '.xlsx'); // Load file yang telah diupload ke folder excel
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

        // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
        $data = array();
        $user_import = $this->session->userdata('id_karyawan');
        $numrow = 1;
        foreach ($sheet as $row) {
            // Cek $numrow apakah lebih dari 1
            // Artinya karena baris pertama adalah nama-nama kolom
            // Jadi dilewat saja, tidak usah diimport
            if ($numrow > 1) {
                // Kita push (add) array data ke variabel data
                $ubah_format_tgl = date("Y-m-d", strtotime($row['A']));
                array_push($data, array(
                    'temperatur'       => $row['A'], // Insert data nik dari kolom F di excel
                    'correction_a'      => $row['B'], // Insert data nama dari kolom G di excel
                    'correction_b'   => $row['C'], // Insert data tanggal dari kolom A di excel
                    'user_input'  => $row['D'], // Insert data tgl_awal dari kolom H di excel
                ));
            }
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
        $this->M_boss_pintar->insert_multiple($data);
        redirect("hrd/boss_pintar"); // Redirect ke halaman awal (ke controller siswa fungsi index)
    }

    public function add_sounding()
    {
        $id = $this->session->userdata('id_karyawan');
        //date_default_timezone_set("Asia/Jakarta");
        $tanggal        = date('Y-m-d', strtotime($this->input->post('tanggal')));
        $jam            = date('H:i:s', strtotime($this->input->post('jam')));
        $tangki1        = $this->input->post('tangki1');
        $temp_atas_1    = $this->input->post('temp_atas_1');
        $temp_bawah_1   = $this->input->post('temp_bawah_1');
        $temperatur1    = ($temp_atas_1 + $temp_bawah_1) / 2;
        $density1       = $this->input->post('density1');
        $tangki2        = $this->input->post('tangki2');
        $temp_atas_2    = $this->input->post('temp_atas_2');
        $temp_bawah_2   = $this->input->post('temp_bawah_2');
        $temperatur2    = ($temp_atas_2 + $temp_bawah_2) / 2;
        $density2       = $this->input->post('density2');
        $spl            = $this->input->post('spl');
        $spb            = $this->input->post('spb');

        $selisih1       = 12650 - $tangki1;
        $selisih2       = 12670 - $tangki2;
        $total_obs_vol1 = $this->db->query("SELECT tinggi, volume, tangki FROM abe_tangki_aspal WHERE tangki = 'tangki1' AND tinggi = '$selisih1' ")->row_array();
        $total_obs_vol2 = $this->db->query("SELECT tinggi, volume, tangki FROM abe_tangki_aspal WHERE tangki = 'tangki2' AND tinggi = '$selisih2'")->row_array();

        if ($total_obs_vol1['volume'] == "") {
            $total_obs_vol1['volume'] = 0;
        }

        if ($total_obs_vol2['volume'] == "") {
            $total_obs_vol2['volume'] = 0;
        }

        $shrinkage1     = (($temperatur1 - 140) * 0.0000348 + 1);
        $shrinkage2     = (($temperatur2 - 140) * 0.0000348 + 1);

        $corr_gross_obs_vol1    = round($shrinkage1 * $total_obs_vol1['volume']);
        $corr_gross_obs_vol2    = round($shrinkage2 * $total_obs_vol2['volume']);

        $vcf_1          = $this->db->query("SELECT temperatur, correction_a FROM abe_tangki_temperatur WHERE temperatur = '$temperatur1'")->row_array();
        $vcf_2          = $this->db->query("SELECT temperatur, correction_a FROM abe_tangki_temperatur WHERE temperatur = '$temperatur2'")->row_array();

        $gross_std_vol1     = round($corr_gross_obs_vol1 * $vcf_1['correction_a']);
        $gross_std_vol2     = round($corr_gross_obs_vol2 * $vcf_2['correction_a']);

        $wcf1           = $density1 - 0.0011;
        $wcf2           = $density2 - 0.0011;

        $gross_weight1  = round($gross_std_vol1 * $wcf1);
        $gross_weight2  = round($gross_std_vol2 * $wcf2);

        $data = array(
            'tanggal'       => $tanggal,
            'jam'           => $jam,
            'tangki1'       => $tangki1,
            'temperatur1'   => $temperatur1,
            'density1'      => $density1,
            'total_obs_vol1' => $total_obs_vol1['volume'],
            'shrinkage1'     => $shrinkage1,
            'corr_gross_obs_vol1' => $corr_gross_obs_vol1,
            'vcf1'          => $vcf_1['correction_a'],
            'gross_std_vol1' => $gross_std_vol1,
            'wcf1'          => $wcf1,
            'gross_weigh1'  => $gross_weight1,
            'tangki2'       => $tangki2,
            'temperatur2'   => $temperatur2,
            'density2'      => $density2,
            'total_obs_vol2' => $total_obs_vol2['volume'],
            'shrinkage2'     => $shrinkage2,
            'corr_gross_obs_vol2' => $corr_gross_obs_vol2,
            'vcf2'          => $vcf_2['correction_a'],
            'gross_std_vol2' => $gross_std_vol2,
            'wcf2'          => $wcf2,
            'gross_weigh2'  => $gross_weight2,
            'spl'           => $spl,
            'spb'           => $spb,
            'status'        => 'initial',
            'id_user'       => $id,
        );
        $this->M_pertamina->save_sounding($data);
        $this->session->set_flashdata('sukses', 'Data Sounding Berhasil Di buat<br> Terimakasih');
        redirect('user/pertamina');
    }

    public function update_sounding()
    {
        $id = $this->input->post('id_sounding');
        //date_default_timezone_set("Asia/Jakarta");
        $tanggal        = date('Y-m-d', strtotime($this->input->post('tanggal')));
        $jam            = date('H:i:s', strtotime($this->input->post('jam')));
        $tangki1        = $this->input->post('tangki1');
        $temp_atas_1    = $this->input->post('temp_atas_1');
        $temp_bawah_1   = $this->input->post('temp_bawah_1');
        $temperatur1    = ($temp_atas_1 + $temp_bawah_1) / 2;
        $density1       = $this->input->post('density1');
        $tangki2        = $this->input->post('tangki2');
        $temp_atas_2    = $this->input->post('temp_atas_2');
        $temp_bawah_2   = $this->input->post('temp_bawah_2');
        $temperatur2    = ($temp_atas_2 + $temp_bawah_2) / 2;
        $density2       = $this->input->post('density2');
        $spl            = $this->input->post('spl');
        $spb            = $this->input->post('spb');

        $selisih1       = 12650 - $tangki1;
        $selisih2       = 12670 - $tangki2;
        $total_obs_vol1 = $this->db->query("SELECT tinggi, volume, tangki FROM abe_tangki_aspal WHERE tangki = 'tangki1' AND tinggi = '$selisih1' ")->row_array();
        $total_obs_vol2 = $this->db->query("SELECT tinggi, volume, tangki FROM abe_tangki_aspal WHERE tangki = 'tangki2' AND tinggi = '$selisih2'")->row_array();

        if ($total_obs_vol1['volume'] == "") {
            $total_obs_vol1['volume'] = 0;
        }

        if ($total_obs_vol2['volume'] == "") {
            $total_obs_vol2['volume'] = 0;
        }

        $shrinkage1     = (($temperatur1 - 140) * 0.0000348 + 1);
        $shrinkage2     = (($temperatur2 - 140) * 0.0000348 + 1);

        $corr_gross_obs_vol1    = round($shrinkage1 * $total_obs_vol1['volume']);
        $corr_gross_obs_vol2    = round($shrinkage2 * $total_obs_vol2['volume']);

        $vcf_1          = $this->db->query("SELECT temperatur, correction_a FROM abe_tangki_temperatur WHERE temperatur = '$temperatur1'")->row_array();
        $vcf_2          = $this->db->query("SELECT temperatur, correction_a FROM abe_tangki_temperatur WHERE temperatur = '$temperatur2'")->row_array();

        $gross_std_vol1     = round($corr_gross_obs_vol1 * $vcf_1['correction_a']);
        $gross_std_vol2     = round($corr_gross_obs_vol2 * $vcf_2['correction_a']);

        $wcf1           = $density1 - 0.0011;
        $wcf2           = $density2 - 0.0011;

        $gross_weight1  = round($gross_std_vol1 * $wcf1);
        $gross_weight2  = round($gross_std_vol2 * $wcf2);

        $data = array(
            'tanggalf'       => $tanggal,
            'jamf'           => $jam,
            'tangki1f'       => $tangki1,
            'temperatur1f'   => $temperatur1,
            'density1f'      => $density1,
            'total_obs_vol1f' => $total_obs_vol1['volume'],
            'shrinkage1f'     => $shrinkage1,
            'corr_gross_obs_vol1f' => $corr_gross_obs_vol1,
            'vcf1f'          => $vcf_1['correction_a'],
            'gross_std_vol1f' => $gross_std_vol1,
            'wcf1f'          => $wcf1,
            'gross_weigh1f'  => $gross_weight1,
            'tangki2f'       => $tangki2,
            'temperatur2f'   => $temperatur2,
            'density2f'      => $density2,
            'total_obs_vol2f' => $total_obs_vol2['volume'],
            'shrinkage2f'     => $shrinkage2,
            'corr_gross_obs_vol2f' => $corr_gross_obs_vol2,
            'vcf2f'          => $vcf_2['correction_a'],
            'gross_std_vol2f' => $gross_std_vol2,
            'wcf2f'          => $wcf2,
            'gross_weigh2f'  => $gross_weight2,
            'status'        => 'final',
        );
        $this->M_pertamina->update_sounding($data, $id);
        $this->session->set_flashdata('sukses', 'Data Sounding Berhasil Di Update<br> Terimakasih');
        redirect('user/pertamina');
    }
}
