<!-- Datatables -->
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" rel="stylesheet">

  <script>
      function validasiFile(){
        var inputFile = document.getElementById('file');
        var pathFile = inputFile.value;
        var file_size = $('#file')[0].files[0].size;
        var ekstensiOk = /(\.xlsx)$/i;
        if(!ekstensiOk.exec(pathFile)){
            alert('Mohon maaf, hanya file Excel yang diperbolehkan untuk upload ( .xlsx ) file hasil import dari boss pintar');
            inputFile.value = '';
            return false;
        }else if(file_size > 4000000){
            alert('Mohon maaf, file yang diperbolehkan untuk upload maksimal 4 Mb');
            inputFile.value = '';
            return false;
        }
      }
  </script>

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3></h3>
      </div>
    </div>
 
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Preview File Detail Absensi Boss Pintar <small></small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form method="post" action="<?= base_url("hrd/boss_pintar/form_upload_detail"); ?>" enctype="multipart/form-data">
              <!--
              -- Buat sebuah input type file
              -- class pull-left berfungsi agar file input berada di sebelah kiri
              -->
              <h4>Pilih File Detail yang ingin di upload</h4>
              <!--
              <input type="file" name="file">
              -->
              <input type="file" id="file" name="file" onchange="return validasiFile()" class="form-control" required="true">
              <br>

              <!--
              -- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
              -->
              <input type="submit" class="btn btn-sm btn-primary" name="preview" value="Preview Data">
              <a href="<?= base_url('hrd/boss_pintar') ?>" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> Kembali</a>
            </form>
            

            <?php
            if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
              if(isset($upload_error)){ // Jika proses upload gagal
                echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
                die; // stop skrip
              }

              // Buat sebuah tag form untuk proses import data ke database
              echo "<form method='post' action='".base_url("hrd/boss_pintar/import_data_detail")."'>";

              // Buat sebuah div untuk alert validasi kosong
              //echo "<div style='color: red;' id='kosong'>
              //Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
              //</div>";
              echo "<table class='table table-bordered table-striped' id='lookup'>
              <thead>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Cabang</th>
                <th>Kategori</th>
                <th>Log Date</th>
              </tr>";
              echo "</thead>";
              echo "<tbody>";
              $numrow = 1;
              $kosong = 0;

              // Lakukan perulangan dari data yang ada di excel
              // $sheet adalah variabel yang dikirim dari controller
              foreach($sheet as $row){
                // Ambil data pada excel sesuai Kolom
                $nik        = $row['B']; // Ambil data NIK
                $nama       = $row['C']; // Ambil data nama
                $cabang     = $row['D']; // Ambil data cabang
                $kategori   = $row['E'];
                $log_date   = $row['G']; 
                 

                // Cek jika semua data tidak diisi
                if($nik == "" && $nama == "" && $cabang == "" && $kategori == "" && $log_date == "")
                  continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

                // Cek $numrow apakah lebih dari 1
                // Artinya karena baris pertama adalah nama-nama kolom
                // Jadi dilewat saja, tidak usah diimport
                if($numrow > 1){
                  // Validasi apakah semua data telah diisi
                  $nik_td         = ( ! empty($nik))? "" : " style='background: #E07171;'"; // Jika NIK kosong, beri warna merah
                  $nama_td        = ( ! empty($nama))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                  $cabang_td      = ( ! empty($cabang))? "" : " style='background: #E07171;'"; // Jika Cabang kosong, beri warna merah
                  $kategori_td    = ( ! empty($kategori))? "" : " style='background: #E07171;'"; // Jika Kategori kosong, beri warna merah
                  $log_date_td    = ( ! empty($log_date))? "" : " style='background: #E07171;'"; // Jika Tanggal Akhir kosong, beri warna merah
                  // Jika salah satu data ada yang kosong
                  if($nik == "" or $nama == "" or $cabang == "" or $kategori == "" or $log_date == ""){
                    $kosong++; // Tambah 1 variabel $kosong
                  }
                  
                  echo "<tr>";
                  echo "<td".$nik_td.">".$nik."</td>";
                  echo "<td".$nama_td.">".$nama."</td>";
                  echo "<td".$cabang_td.">".$cabang."</td>";
                  echo "<td".$kategori_td.">".$kategori."</td>";
                  echo "<td".$log_date_td.">".$log_date."</td>";
                  echo "</tr>";
                }

                $numrow++; // Tambah 1 setiap kali looping
              }
              echo "</tbody>";
              echo "</table>";

              // Cek apakah variabel kosong lebih dari 0
              // Jika lebih dari 0, berarti ada data yang masih kosong
              if($kosong > 0){
              ?>
                <script>
                $(document).ready(function(){
                  // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                  $("#jumlah_kosong").html('<?php echo $kosong; ?>');

                  $("#kosong").show(); // Munculkan alert validasi kosong
                });
                </script>
              <?php
              }else{ // Jika semua data sudah diisi
                echo "<hr>";
                // Buat sebuah tombol untuk mengimport data ke database
                echo "<button type='submit' class='btn btn-success' name='import'><i class='fa fa-file-excel-o'></i> Proses Import</button>";
                echo "<a class='btn btn-warning' href='".base_url("hrd/boss_pintar")."'>Cancel</a>";
              }

              echo "</form>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
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
    $(function () {
        $("#lookup").dataTable();
    });
</script>
