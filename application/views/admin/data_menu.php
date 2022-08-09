<?php
  $department = $this->session->userdata('department');
  $jabatan = $this->session->userdata('jabatan');
  $level = $this->session->userdata('level');
  $akses = $this->db->get_where("abe_level_user",array("id_level_user"=>$level))->row_array();
?>

<ul class="nav side-menu">
  <li><a href="<?php echo base_url(); ?>"><i class='fa fa-dashboard'></i>Dashboard</a></li>
  <li><a><i class="fa fa-list"></i> Modul SPK <span class='fa fa-chevron-down'></span></a>
    <ul class='nav child_menu'>
      <?php
        if($department == 'IT'){
          echo "<li><a href='".base_url('user/spk/spk_it')."'><i class='fa fa-book'></i> Laporan SPK</a></li>";
          echo "<li><a href='".base_url('user/spk/spk')."'><i class='fa fa-book'></i> Tugas SPK Anda</a></li>";
        }else if($department == 'ALL'){
          echo "<li><a href='".base_url('user/spk/spk_all')."'><i class='fa fa-book'></i> Laporan SPK</a></li>";
        }else{
          echo "<li><a href='".base_url('user/spk/spk')."'><i class='fa fa-book'></i> Tugas SPK Anda</a></li>";
        }
      ?>
      <li><a href="<?= base_url('user/spk/'); ?>"><i class="fa fa-book"></i> Data SPK Anda</a></li>
    </ul>
  </li>
  <li><a><i class="fa fa-list"></i> Modul Surat <span class='fa fa-chevron-down'></span></a>
    <ul class='nav child_menu'>
      <li><a href="<?= base_url('user/surat'); ?>"><i class="fa fa-envelope-o"></i> Data Surat Masuk</a></li>
      <li><a href="<?= base_url('user/surat/keluar'); ?>"><i class="fa fa-envelope-o"></i> Data Surat Keluar</a></li>
    </ul>
  </li>
  <li><a href="<?php echo base_url('user/rapat'); ?>"><i class='fa fa-edit'></i>Notulen Rapat</a></li>

  <?php
    if($department == 'ALL' OR $department == 'HRD'){
      echo "";
    }else{
      echo "<li><a href='".base_url('user/karyawan')."'><i class='fa fa-user'></i> Data Karyawan</a></li>"; 
    }
  ?>
  <?php
    if($department == 'HRD'){ ?> 
      <li><a><i class="fa fa-list"></i> Modul HRD <span class='fa fa-chevron-down'></span></a>
        <ul class='nav child_menu'>
          <li><a href="<?= base_url('hrd/karyawan'); ?>"><i class="fa fa-user"></i> Data Karyawan</a></li>
          <li><a href="<?= base_url('user/absen/data_absen'); ?>"><i class="fa fa-user"></i> Data Kehadiran / Absen</a></li>
          <li><a href="<?= base_url('hrd/kantor_cabang'); ?>"><i class="fa fa-building"></i> Data Perusahaan</a></li>
          <!--
          <li><a href="<?= base_url('hrd/jobdesk'); ?>"><i class="fa fa-edit"></i> Data Jobdesk</a></li>
          -->
        </ul>
      </li>
  <?php }
    else if($department == 'IT')
      { ?>
      <li><a href="<?= base_url('hrd/karyawan'); ?>"><i class="fa fa-user"></i> Data Karyawan</a></li>
      <li><a><i class="fa fa-list"></i> Modul Administrator <span class='fa fa-chevron-down'></span></a>
        <ul class='nav child_menu'>
          <li><a href="<?= base_url('admin/pengguna'); ?>"><i class="fa fa-child"></i> Modul Pengguna</a></li>
          <li><a href="<?= base_url('admin/menu'); ?>"><i class="fa fa-list"></i> Data Modul</a></li>
        </ul>
      </li>

      <li><a><i class="fa fa-list"></i> Modul HRD <span class='fa fa-chevron-down'></span></a>
        <ul class='nav child_menu'>
          <li><a href="<?= base_url('hrd/karyawan'); ?>"><i class="fa fa-user"></i> Data Karyawan</a></li>
          <li><a href="<?= base_url('user/absen/data_absen'); ?>"><i class="fa fa-user"></i> Data Kehadiran / Absen</a></li>
          <li><a href="<?= base_url('hrd/kantor_cabang'); ?>"><i class="fa fa-building"></i> Data Perusahaan</a></li>
          <!--
          <li><a href="<?= base_url('hrd/jobdesk'); ?>"><i class="fa fa-edit"></i> Data Jobdesk</a></li>
          -->
        </ul>
      </li>
  <?php 
    }  else if($department == 'ALL'){
  ?>
      <li><a href="<?= base_url('hrd/karyawan/all'); ?>"><i class="fa fa-user"></i> Data Karyawan</a></li>
      <li><a href="<?= base_url('admin/pengguna'); ?>"><i class="fa fa-child"></i> Modul Pengguna</a></li>
  <?php
    }     
  ?>
    
    
  <li><a href="<?php echo base_url('user/reminder'); ?>"><i class='fa fa-bell'></i>Modul Reminder</a></li>
  <li><a><i class="fa fa-list"></i> Modul Tugas <span class='fa fa-chevron-down'></span></a>
    <ul class='nav child_menu'>
      <?php
        if($jabatan == 'MANAGER'){
          echo "<li><a href='".base_url('tugas/data_harian/manager')."'><i class='fa fa-book'></i> Laporan Tugas Harian</a></li>";
        }else if($jabatan == 'KOORDINATOR' OR $jabatan == 'SUPERVISOR'){
          echo "<li><a href='".base_url('tugas/data_harian/spv')."'><i class='fa fa-book'></i> Laporan Tugas Harian</a></li>";
        }else if($department == 'ALL'){
          echo "<li><a href='".base_url('tugas/data_harian')."'><i class='fa fa-book'></i> Laporan Tugas Harian</a></li>";
        }
      ?>
      <li><a href="<?= base_url('tugas/harian'); ?>"><i class="fa fa-book"></i> Tugas Harian</a></li>
    </ul>
  </li>

  <li><a><i class="fa fa-list"></i> Modul Permintaan <span class='fa fa-chevron-down'></span></a>
    <ul class='nav child_menu'>
      <?php
        if($jabatan == 'DIREKTUR')
        {
          echo "
              <li><a href='".base_url('permintaan/pr/data')."'><i class='fa fa-list'></i> Data Permintaan</a></li>
              <li><a href='".base_url('permintaan/pr/menyetujui')."'><i class='fa fa-check-circle-o'></i> Approve Menyetujui</a></li>
              <li><a href='".base_url('permintaan/pr/mengetahui')."'><i class='fa fa-check-square-o'></i> Approve Mengetahui</a></li>
              ";
        }
        else if($jabatan != 'STAFF')
        {
          echo "
              <li><a href='".base_url('permintaan/pr/data')."'><i class='fa fa-list'></i> Data Permintaan</a></li>
              <li><a href='".base_url('permintaan/pr/mengetahui')."'><i class='fa fa-check-square-o'></i> Approve Mengetahui</a></li>
              ";
        }
        else if($akses['nama_level'] == 'operasional'){
        //  }else if($department == 'OPR'){
          echo "<li><a href='".base_url('permintaan/pr/data')."'><i class='fa fa-list'></i> Data Permintaan</a></li>";
        }
      ?>
      <li><a href="<?= base_url('permintaan/pr'); ?>"><i class="fa fa-edit"></i> Permintaan Pembeliaan</a></li>
    </ul>
  </li>
  <!--
  <li><a><i class="fa fa-list"></i> Modul Pembelian <span class='fa fa-chevron-down'></span></a>
    <ul class='nav child_menu'>
      <?php
        if($jabatan == 'DIREKTUR')
        {
          echo "
              <li><a href='".base_url('permintaan/pr/data')."'><i class='fa fa-list'></i> Data Permintaan</a></li>
              <li><a href='".base_url('permintaan/pr/mengetahui')."'><i class='fa fa-check-square-o'></i> Approve Mengetahui</a></li>
              <li><a href='".base_url('permintaan/pr/menyetujui')."'><i class='fa fa-check-circle-o'></i> Approve Menyetujui</a></li>
              
              ";
        }
        else if($jabatan != 'STAFF')
        {
          echo "
              <li><a href='".base_url('pembelian/barang')."'><i class='fa fa-list'></i> Data Barang</a></li>
              <li><a href='".base_url('permintaan/pr/mengetahui')."'><i class='fa fa-check-square-o'></i> Approve Mengetahui</a></li>
              ";
        }else if($akses['nama_level'] == 'operasional'){
          echo "<li><a href='".base_url('permintaan/pr/data')."'><i class='fa fa-list'></i> Data Permintaan</a></li>";
        }
      ?>
      <li><a href="<?= base_url('permintaan/pr'); ?>"><i class="fa fa-edit"></i> Permintaan Pembeliaan</a></li>
    </ul>
  </li>
-->
  <!--
  <li><a><i class="fa fa-list"></i> Modul Pengiriman <span class='fa fa-chevron-down'></span></a>
    <ul class='nav child_menu'>
      <li><a href="<?= base_url('pengiriman/surat_jalan/tracking'); ?>"><i class="fa fa-map-marker"></i> Lacak Pengiriman</a></li>
      <?php
        if($akses['nama_level'] == 'operasional')
        {
          echo "
            <li><a href='".base_url('pengiriman/ekspedisi')."'><i class='fa fa-cubes'></i> Data Ekspedisi</a></li>
            <li><a href='".base_url('pengiriman/surat_jalan')."'><i class='fa fa-edit'></i> Surat Jalan</a></li>";
        }
      ?>
      
    </ul>
  </li>
  -->
</ul>