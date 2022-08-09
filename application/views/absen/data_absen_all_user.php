<!-- Datatables -->
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<link href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" rel="stylesheet">
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3></h3>
      </div>
    </div>
    <?php if($this->session->flashdata('sukses')){ ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p><center><?php echo $this->session->flashdata('sukses'); ?></center></p>
      </div>
    <?php }?>
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <?php
              $hari_indonesia = array('Monday'  => 'Senin',
                        'Tuesday'  => 'Selasa',
                        'Wednesday' => 'Rabu',
                        'Thursday' => 'Kamis',
                        'Friday' => 'Jumat',
                        'Saturday' => 'Sabtu',
                        'Sunday' => 'Minggu');
              $hari   = date('l');
            ?>
            <h2>Data Kehadiran Seluruh Karyawan Hari <?= $hari_indonesia[$hari] ?> <small></small></h2>
            <button class="btn btn-sm btn-warning"><?= TanggalIndo(date('Y-m-d'));?></button>
            <ul class="nav navbar-right panel_toolbox">
              <a class="btn btn-sm btn-success" href="#" data-toggle="modal" data-target="#Absen_ijin"><i class="fa fa-plus"></i> Ijin Karyawan</a>
              <a class="btn btn-sm btn-info" href="<?= base_url() ?>user/absen/shorting"><i class="fa fa-search"></i> Shorting</a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <table class="table table-bordered table-striped" id="lookup">
                <thead>
                  <tr>
                    <th width="20px">No</th>
                    <th>Nama Karyawan</th>
                    <th width="70px">IP PC</th>
                    <th width="60px">Jam In</th>
                    <th width="60px">Jam Out</th>
                    <th th width="90px">Status</th>
                    <th>Keterangan</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    //$id = $this->session->userdata('id_karyawan');
                    $date = date("Y-m-d");
                    $sql  = "SELECT aa.*, ak.nama_lengkap, ak.id_karyawan
                            FROM abe_absen as aa, abe_karyawan as ak WHERE aa.id_karyawan = ak.id_karyawan AND aa.tanggal = '$date' ORDER BY id_absen DESC";
                    $sql2  = "SELECT aa.*, ak.nama_lengkap, ak.id_karyawan
                            FROM abe_absen as aa, abe_karyawan as ak WHERE aa.id_karyawan = ak.id_karyawan ORDER BY id_absen DESC";
                    $absen = $this->db->query($sql)->result();
                    $no = 1;
                    foreach ($absen as $row) {
                      $jam_masuk   = date('H:i:s', strtotime($row->tgl_absen));
                      $jam_keluar  = date('H:i:s', strtotime($row->tgl_pulang));
                      if($jam_masuk == '01:00:00'){
                        $jam_in = "-";
                      }else{
                        $jam_in   = date('H:i:s', strtotime($row->tgl_absen));
                      } 
                      if($jam_keluar == '01:00:00'){
                        $jam_out = "-";
                      }else{
                        $jam_out   = date('H:i:s', strtotime($row->tgl_absen));
                      } 

                      echo "<tr>
                            <td>$no</td>
                            <td>".ucfirst(strtolower($row->nama_lengkap))."</td>
                            <td>$row->ip_pc</td>
                            <td>$jam_in</td>
                            <td>$jam_out</td>
                            <td>$row->status</td>
                            <td>$row->keterangan</td>";
                      if($row->status != 'masuk'){
                        echo "<td>".anchor('user/absen/hapus_status/'.$row->id_absen,'<i class="fa fa-trash"></i> Cancel', array('class'=>'btn btn-danger btn-xs', 'title'=>'batal', 'onclick'=>'javasciprt: return confirm(\'Yakin ingin menghapus/mengubah absen '.$row->nama_lengkap.' !! \')')). "</td></tr>";
                      }else{
                        echo "<td><button class='btn btn-xs btn-success' title='selesai' ><i class='fa fa-check'></i> Done</button></td></tr>";
                      }
                      
                      $no++;
                      }
                  ?>
                </tbody>
              </table>
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

<!-- Datatables Scripts 
<script src="<?= base_url() ?>assets/gentelella/datatables/jquery.dataTables.js" ></script>
<script src="<?= base_url() ?>assets/gentelella/datatables/dataTables.bootstrap.js"></script>
-->
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
//            jika dipilih, kode obat akan masuk ke input dan modal di tutup
    $(document).on('click', '.pilih1', function (e) {
        document.getElementById("id_karyawan").value = $(this).attr('data-karyawan');
        document.getElementById("nama_karyawan").value = $(this).attr('data-karyawan2');
        $('#myKaryawan').modal('hide');
    });

    $(function () {
        $("#lookup").dataTable();
        $("#lookup2").dataTable(); 
        $("#lookup3").dataTable();
    });
</script>
<!-- datepicker -->
<script src="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript">
      $(document).ready(function (){
          $('.tanggal').datepicker({
              format: "dd-mm-yyyy",
              //format: "yyyy-mm-dd",
              autoclose:true
              }).on('changeDate',function (ev) {
         var idnya = this.id; // baca ID masing2 tgl
         $("#berubah").html('<font color="red"><b>'+$('#'+idnya).val()+'</b></font>');
                });
          });
  </script> 

<script src="<?= base_url() ?>assets/gentelella/js/notify.js"></script>

<div class="modal fade" id="Absen_ijin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:800px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Form Ijin Kehadiran</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/absen/ijin">
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12">Pilih Karyawan</label>
                    <div class="col-md-8">
                      <input type="text" name="id_karyawan" id="id_karyawan" value="" hidden="">
                      <input type="text" name="nama_karyawan" id="nama_karyawan" value="" readonly="" class="form-control"> 
                      <span class="help-block"></span>
                      <span class="input-group-btn">
                          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myKaryawan"><i class="fa fa-check"></i> Nama Karyawan</button>
                      </span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12">Alasan Ijin</label>
                    <div class="col-md-8 col-sm-12">
                      <select class="form-control" name="status" required="true">
                        <option value="">-- pilih status ijin --</option>
                        <option value="tugas luar">Tugas Luar</option>
                        <option value="sakit">Sakit</option>
                        <option value="datang terlambat">Datang Terlambat</option>
                        <option value="datang siang">Datang Siang</option>
                        <option value="cuti">Cuti</option>
                        <option value="ijin">Ijin</option>
                        <option value="mangkir">Mangkir</option>
                      </select>  
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12">Keterangan Ijin</label>
                    <div class="col-md-8 col-sm-12">
                      <textarea name="keterangan" name="keterangan" class="form-control"></textarea> 
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Proses</button>
                  <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
              </div>
              </form>  
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myKaryawan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:800px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Daftar Karyawan</h4>
            </div>
            <div class="modal-body">
                <table id="lookup2" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            //$record_karyawan = $this->db->get_where('abe_karyawan',array('login'=>'oke'));
                            $sql = "SELECT id_karyawan, nama_lengkap, jabatan FROM abe_karyawan WHERE status = 'aktif'";
                            $record_karyawan = $this->db->query($sql);
                            foreach ($record_karyawan->result() as $p)
                            { 
                              echo "<tr class='pilih1' data-karyawan='$p->id_karyawan' data-karyawan2='$p->nama_lengkap'>
                                      <td>$no</td>
                                      <td>$p->nama_lengkap</td></tr>";
                              $no++ ;
                            }
                        ?>
                    </tbody>
                </table>  
            </div>
        </div>
    </div>
</div>