<?php
$department = $this->session->userdata('department');
$jabatan = $this->session->userdata('jabatan');
$level = $this->session->userdata('level');
$akses = $this->db->get_where("abe_level_user", array("id_level_user" => $level))->row_array();
//menentukan jumlah kehadiran per periode bulan
$id = $this->session->userdata('id_karyawan');
$array_bulan = array(
  '1' => "januari", '2' => "februari", '3' => "maret",
  '4' => "april", '5' => "mei", '6' => "juni", '7' => "juli",
  '8' => "agustus", '9' => "september", '10' => "oktober",
  '11' => "november", '12' => "desember", '13' => "akhir_desember"
);
$tanggal    = date("d");
if ($tanggal > 20) {
  $bulan = $array_bulan[date('m') + 1];
  if ($bulan == 'akhir_desember') {
    $bulan = 'januari';
    $tahun = date("Y") + 1;
  } else {
    $tahun = date("Y");
  }
  $periode = $bulan . " " . $tahun;
} else {
  $bulan = $array_bulan[date('m') - 0];
  $tahun = date("Y");
  $periode = $bulan . " " . $tahun;
}
?>

<!-- Datatables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/datatables/dataTables.bootstrap.css" />
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css" />
<!-- Custom Theme Style -->
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" />

<script>
  function validasiFile() {
    var inputFile = document.getElementById('file');
    var pathFile = inputFile.value;
    var file_size = $('#file')[0].files[0].size;
    var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif|\.pdf)$/i;
    if (!ekstensiOk.exec(pathFile)) {
      alert('Mohon maaf, file yang diperbolehkan untuk upload ( .jpg / .png / .jpeg / .pdf )');
      inputFile.value = '';
      return false;
    } else if (file_size > 4000000) {
      alert('Mohon maaf, file yang diperbolehkan untuk upload maksimal 4 Mb');
      inputFile.value = '';
      return false;
    }
  }
</script>
<div class="right_col" role="main">
  <div class="row">
    <?php
    include "dashboard/direktur.php";
    if ($department != 'ALL') {
    ?>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <?php
          $date = date('Y-m-d');
          $user = $this->session->userdata('id_karyawan');
          $sql = "SELECT tgl_absen,tgl_pulang, id_karyawan, status FROM abe_absen WHERE id_karyawan = '$user' AND tanggal = '$date'";
          $absen = $this->db->query($sql)->row_array();

          ?>
          <?php if ($this->session->flashdata('sukses')) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <p>
                <center><?php echo $this->session->flashdata('sukses'); ?></center>
              </p>
            </div>
          <?php } ?>
          <?php if ($this->session->flashdata('gagal')) { ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <p>
                <center><?php echo $this->session->flashdata('gagal'); ?></center>
              </p>
            </div>
          <?php } ?>

          <a class="btn btn-sm btn-info" href="<?= base_url('user/absen') ?>"><i class="fa fa-list"></i> Data Kehadiran</a>
          <?php
          $id = $this->session->userdata('id_karyawan');
          $sql = "SELECT * FROM abe_history_login WHERE id_karyawan = $id ORDER BY waktu DESC LIMIT 1,2";
          $last_login = $this->db->query($sql)->row_array();
          $waktu = date('d-m-Y H:i:s', strtotime($last_login['waktu']));
          ?>
          <ul class="nav navbar-right panel_toolbox">
            <!--
              <button class="btn btn-sm btn-warning">Your IP : <?= $this->input->ip_address() ?></button>
            -->
            <button class="btn btn-sm btn-info">Terakhir Login : <?= $waktu ?></button>
          </ul>
          <div class="row top_tiles">
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><a href="#"><i class="fa fa-smile-o"></i></a></div>
                <?php
                $sql_masuk = "SELECT * FROM abe_absen WHERE id_karyawan = '$id' AND status = 'masuk' AND periode = '$periode'";
                $absen_masuk = $this->db->query($sql_masuk)->num_rows();
                ?>
                <div class="count"><?= $absen_masuk ?></div>
                <h3><a>Absen</a></h3>
                <p>Absen Masuk</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><a href="#"><i class="fa fa-meh-o"></i></a></div>
                <?php
                $sql_ijin = "SELECT * FROM abe_absen WHERE id_karyawan = '$id' AND status != 'masuk' AND status != 'sakit' AND periode = '$periode'";
                $absen_ijin = $this->db->query($sql_ijin)->num_rows();
                ?>
                <div class="count"><?= $absen_ijin ?></div>
                <h3><a>Ijin</a></h3>
                <p>Ijin keterlambatan hadir</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><a href="#"><i class="fa fa-frown-o"></i></a></div>
                <?php
                $sql_sakit = "SELECT * FROM abe_absen WHERE id_karyawan = '$id' AND status = 'sakit' AND periode = '$periode'";
                $absen_sakit = $this->db->query($sql_sakit)->num_rows();
                ?>
                <div class="count"><?= $absen_sakit ?></div>
                <h3><a>Sakit</a></h3>
                <p>Sakit tidak masuk kerja</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel tile ">
          <div class="x_title">
            <h2>Shortcut</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <a class="btn btn-app" data-toggle="modal" data-target="#CreateSPK">
              <span class="badge bg-orange"></span>
              <i class="fa fa-book"></i> SPK
            </a>
            <a class="btn btn-app" data-toggle="modal" data-target="#createTT">
              <span class="badge bg-red">new</span>
              <i class="fa fa-file-excel-o"></i> Tanda Terima
            </a>
            <a class="btn btn-app" data-toggle="modal" data-target="#createNS">
              <span class="badge bg-red">new</span>
              <i class="fa fa-envelope-o"></i> Nomor Surat
            </a>
            <a class="btn btn-app" href="<?= base_url('tugas/harian/create') ?>">
              <span class="badge bg-orange"></span>
              <i class="fa fa-edit"></i> Tugas Harian
            </a>
            <a class="btn btn-app" data-toggle="modal" data-target="#CreateTamu">
              <span class="badge bg-orange"></span>
              <i class="fa fa-user"></i> Buku Tamu
            </a>
            <a class="btn btn-app" data-toggle="modal" data-target="#SuratMasuk">
              <span class="badge bg-orange"></span>
              <i class="fa fa-envelope-o"></i> Surat Masuk
            </a>
            <a class="btn btn-app" data-toggle="modal" data-target="#Create">
              <span class="badge bg-orange"></span>
              <i class="fa fa-edit"></i> Notulen Rapat
            </a>
            <a class="btn btn-app" data-toggle="modal" data-target="#CreatePermintaan">
              <span class="badge bg-red">new</span>
              <i class="fa fa-cube"></i> Permintaan
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel tile fixed_height_320">
          <div class="x_title">
            <h2>Notifikasi</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <a class="btn btn-app" href="<?= base_url('user/absen/hari_ini') ?>">
              <?php
              $date = date("Y-m-d");
              $sql2  = "SELECT aa.*, ak.nama_lengkap, ak.id_karyawan
                        FROM abe_absen as aa, abe_karyawan as ak WHERE aa.id_karyawan = ak.id_karyawan AND aa.tanggal = '$date' ORDER BY id_absen DESC";
              $sql  = "SELECT * FROM abe_absen WHERE tanggal = '$date' AND status != 'masuk' ";
              $absen = $this->db->query($sql)->num_rows();
              ?>
              <span class="badge bg-orange"><?= $absen ?></span>
              <i class="fa fa-users"></i> Kehadiran
            </a>
            <a class="btn btn-app" href="<?= base_url('user/tamu') ?>">
              <?php
              $sql  = "SELECT * FROM abe_buku_tamu WHERE status_tamu = 'OPEN'";
              $tamu = $this->db->query($sql)->num_rows();
              ?>
              <span class="badge bg-orange"><?= $tamu ?></span>
              <i class="fa fa-book"></i> Data Tamu
            </a>
            <a class="btn btn-app" href="<?= base_url('user/reminder') ?>">
              <span class="badge bg-red">new</span>
              <i class="fa fa-bell"></i> Reminder
            </a>
            <?php
            $sql_permintaan = "SELECT * FROM abe_permintaan WHERE status_pr != 'ditolak' AND status_pr != 'selesai'";
            $permintaan = $this->db->query($sql_permintaan)->num_rows();
            $user = $this->session->userdata('id_karyawan');
            $sql_permintaan_mengetahui = "SELECT * FROM abe_permintaan WHERE status_pr = 'baru' AND pr_input != '$user'";
            $permintaan_mengetahui = $this->db->query($sql_permintaan_mengetahui)->num_rows();
            $sql_permintaan_menyetujui = "SELECT * FROM abe_permintaan WHERE status_pr = 'diketahui'";
            $permintaan_menyetujui = $this->db->query($sql_permintaan_menyetujui)->num_rows();

            if ($department == 'IT') {
            ?>
              <a class="btn btn-app" href="<?= base_url('user/spk/spk_it') ?>">
                <?php
                $sql  = "SELECT * FROM abe_spk WHERE status_spk != 'SELESAI'";
                $spk = $this->db->query($sql)->num_rows();
                ?>
                <span class="badge bg-red"><?= $spk ?></span>
                <i class="fa fa-book"></i> Data SPK
              </a>
            <?php
            } else if ($jabatan != 'STAFF') {
            ?>
              <a class="btn btn-app" href="<?= base_url() ?>permintaan/pr/data">
                <?php
                if ($permintaan == 0) {
                  echo "";
                } else {
                  echo "<span class='badge bg-red'>" . $permintaan . "</span>";
                }
                ?>
                <i class="fa fa-edit"></i> Permintaan
              </a>
              <a class="btn btn-app" href="<?= base_url() ?>permintaan/pr/mengetahui">
                <?php
                if ($permintaan_mengetahui == 0) {
                  echo "";
                } else {
                  echo "<span class='badge bg-red'>" . $permintaan_mengetahui . "</span>";
                }
                ?>
                <i class="fa fa-check-square-o"></i> Mengetahui
              </a>
            <?php
            } else if ($akses['nama_level'] == 'operasional') {
            ?>
              <a class="btn btn-app" href="<?= base_url() ?>permintaan/pr/data">
                <?php
                if ($permintaan == 0) {
                  echo "";
                } else {
                  echo "<span class='badge bg-red'>" . $permintaan . "</span>";
                }
                ?>
                <i class="fa fa-edit"></i> Permintaan
              </a>
            <?php
            }
            ?>
            <?php
            if ($akses['nama_level'] == 'operasional') {
            ?>
              <a class="btn btn-app" href="<?= base_url() ?>pengiriman/surat_jalan">
                <span class="badge bg-orange">2</span>
                <i class="fa fa-cubes"></i> Surat Jalan
              </a>
            <?php
            } else {
            ?>
              <a class="btn btn-app" href="<?= base_url() ?>pengiriman/surat_jalan/data">
                <span class="badge bg-orange">2</span>
                <i class="fa fa-cubes"></i> Surat Jalan
              </a>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
      <!-- <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="x_panel tile">
          <div class="x_title">
            <h2>Data Kehadiran Karyawan</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table class="table table-bordered table-striped" id="lookup">
              <thead>
                <tr>
                  <th width="30px">No</th>
                  <th width="80">Periode</th>
                  <th width="100px">Tanggal</th>
                  <th width="120px">Karyawan</th>
                  <th width="120px">Status</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql      = "SELECT aa.*, ak.id_karyawan, ak.nama_lengkap  
                                FROM abe_absen as aa, abe_karyawan as ak 
                                WHERE aa.status != 'masuk' AND aa.id_karyawan = ak.id_karyawan ORDER BY aa.tanggal DESC";
                $absen    = $this->db->query($sql)->result();
                $no = 1;
                foreach ($absen as $row) {
                  echo "<tr>
                            <td>$no</td>
                            <td>$row->periode</td>
                            <td>" . TanggalIndo(date($row->tanggal)) . "</td>
                            <td>" . ucfirst(strtolower($row->nama_lengkap)) . "</td>
                            <td>$row->status</td>
                            <td>$row->keterangan</td>
                            </tr>";
                  $no++;
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div> -->

    <?php } ?>

    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">
          <div class="clearfix"></div>
          <?php if ($this->session->flashdata('gagal')) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <center>
                <p><?php echo $this->session->flashdata('gagal'); ?></p>
              </center>
            </div>
          <?php } ?>
        </div>
        <div class="x_content">
          <?php
          $host_name = gethostbyaddr($_SERVER['REMOTE_ADDR']);
          echo $host_name;
          ?>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12" align="center">
          <img class="img-thumbnail" src="<?php echo base_url(); ?>assets/logo.png" style="height: 140px" />
          <p>
            <h2><strong>BAHTERA GROUP</strong></h2>
            <i>
              Sistem Informasi Bahtera Group
            </i>
          </p>
        </div>
        <div class="clearfix"><br></div>
        <br>
        <div class="row top_tiles">
          <div class="animated flipInY col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><a href="#"><i class="fa fa-area-chart"></i></a></div>
              <div class="count">01.</div>
              <h3><a href="<?= base_url('#') ?>">KAM</a></h3>
              <p>Karya Aspal Mandiri</p>
            </div>
          </div>
          <div class="animated flipInY col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><a href="#"><i class="fa fa-area-chart"></i></a></div>
              <div class="count">02.</div>
              <h3><a href="<?= base_url('#') ?>">SAN</a></h3>
              <p>Sarana Aspal Nusantara</p>
            </div>
          </div>
          <div class="animated flipInY col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><a href="#"><i class="fa fa-ship"></i></a></div>
              <div class="count">03.</div>
              <h3>BSL</h3>
              <p>Bahtera Samudra Line</p>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </div>
</div>

<!-- jQuery -->
<script src="<?= base_url() ?>assets/gentelella/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url() ?>assets/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- jquery.inputmask -->
<script src="<?= base_url() ?>assets/gentelella/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="<?= base_url() ?>assets/gentelella/build/js/custom.min.js"></script>

<!-- Datatables -->
<script src="<?= base_url() ?>assets/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url() ?>assets/gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>assets/gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>assets/gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?= base_url() ?>assets/gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?= base_url() ?>assets/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>

<script type="text/javascript">
  $(function() {
    $("#lookup").dataTable();
    $("#lookup2").dataTable();
    $("#lookup3").dataTable();
  });
</script>

<script src="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.tanggal').datepicker({
      format: "dd-mm-yyyy",
      //format: "yyyy-mm-dd",
      autoclose: true
    }).on('changeDate', function(ev) {
      var idnya = this.id; // baca ID masing2 tgl
      $("#berubah").html('<font color="red"><b>' + $('#' + idnya).val() + '</b></font>');
    });
  });
</script>
<?php
include "dashboard/modal.php";
?>