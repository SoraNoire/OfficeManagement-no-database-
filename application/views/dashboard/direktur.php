<?php if ($department == 'ALL') { ?>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <?php
      $id = $this->session->userdata('id_karyawan');
      $sql = "SELECT * FROM abe_history_login WHERE id_karyawan = $id ORDER BY waktu DESC LIMIT 1,2";
      $last_login = $this->db->query($sql)->row_array();
      $waktu = date('d-m-Y H:i:s', strtotime($last_login['waktu']));
      ?>
      <ul class="nav navbar-right panel_toolbox">
        <button class="btn btn-sm btn-warning" id="clock">Info Jam</button>
        <button class="btn btn-sm btn-info">Terakhir Login : <?= $waktu ?></button>
      </ul>
    </div>
  </div>
  <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="x_panel tile ">
      <div class="x_title">
        <h2>Shortcut</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <a class="btn btn-app" data-toggle="modal" data-target="#CreateSPK">
          <span class="badge bg-red">new</span>
          <i class="fa fa-book"></i> SPK
        </a>

        <a class="btn btn-app" data-toggle="modal" data-target="#CreatePermintaan">
          <span class="badge bg-red">new</span>
          <i class="fa fa-cube"></i> Permintaan
        </a>
      </div>
    </div>
  </div>
  <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="x_panel tile ">
      <div class="x_title">
        <h2>Data Laporan</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <a class="btn btn-app" href="<?= base_url('user/absen/shorting_all') ?>">
          <span class="badge bg-orange"></span>
          <i class="fa fa-list"></i> Data Kehadiran
        </a>
        <a class="btn btn-app" href="<?= base_url('tugas/data_harian') ?>">
          <span class="badge bg-orange"></span>
          <i class="fa fa-edit"></i> Tugas Harian
        </a>
        <a class="btn btn-app" href="<?= base_url('user/spk/spk_all') ?>">
          <span class="badge bg-red"></span>
          <i class="fa fa-book"></i> Data SPK
        </a>
        <a class="btn btn-app" href="<?= base_url('hrd/karyawan/all') ?>">
          <span class="badge bg-red"></span>
          <i class="fa fa-user"></i> Data Karyawan
        </a>
        <a class="btn btn-app" href="<?= base_url('user/rapat/') ?>">
          <span class="badge bg-red"></span>
          <i class="fa fa-book"></i> Notulen Rapat
        </a>
        <a class="btn btn-app" href="<?= base_url('user/nomor_surat/') ?>">
          <span class="badge bg-red">new</span>
          <i class="fa fa-book"></i> Nomor Surat
        </a>
      </div>
    </div>
  </div>
  <div class="col-md-4 col-sm-4 col-xs-12">
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
        <a class="btn btn-app" href="<?= base_url() ?>permintaan/pr/menyetujui">
          <?php
          if ($permintaan_menyetujui == 0) {
            echo "";
          } else {
            echo "<span class='badge bg-red'>" . $permintaan_menyetujui . "</span>";
          }
          ?>
          <i class="fa fa-check-circle-o"></i> Menyetujui
        </a>
      </div>
    </div>
  </div>
<?php }
