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
        <h3>Form Detail Status SPK</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="form-horizontal">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><small></small></h2>
            <button  type="button" class="btn btn-sm btn-success"><i class="fa fa-flag"></i> <?= $record['status_spk'] ?></button>
            <ul class="nav navbar-right panel_toolbox">
              <a href="javascript:history.back()" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> Back</a>
              <button  type="button" class="btn btn-sm btn-primary"><i class="fa fa-calendar"></i> <?= date('d M Y'); ?></button>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-body">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-12">Nomor SPK</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="no_rapat" value="<?= $record['no_spk'] ?>" class="form-control" readonly="true" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-12">Divisi</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="jam_rapat" value="<?= $record['divisi'] ?>" required="true" class="form-control" readonly="true"> 
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-12">Nama Karyawan</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="jam_rapat" value="<?= $record['nama_karyawan'] ?>" required="true" class="form-control" readonly="true"> 
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-12">Dibuat Oleh</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="rapat_input" value="<?= $record['nama_user'] ?>" class="form-control" readonly="true" >
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-6">Tanggal Input</label>
                  <div class="col-md-4 col-sm-6">
                    <input name="tgl_rapat" type="text" value="<?= date('d-m-Y H:i:s', strtotime($record['tgl_input']))?>" class="form-control" readonly="true">
                  </div>
                  <label class="control-label col-md-1 col-sm-6">Deadline</label>
                  <div class="col-md-3 col-sm-6">
                    <?php
                      $dateline = $record['tgl_target'];
                      if($dateline == '1970-01-01'){
                        echo "<input type='text' value='tidak ada' class='form-control' readonly='true'>";
                      }else{
                        echo "<input type='text' value='".date('d-m-Y', strtotime($record['tgl_target']))."' class='form-control' readonly='true'>";
                      }
                    ?>
                  </div>
                </div>
                <?php if($record['status_spk'] == 'SELESAI' ){ ?>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-12">Detail Permasalahan</label>
                    <div class="col-md-8 col-sm-12">
                      <table class='table table-bordered table-striped'>
                        <?php
                          $user   = $record['id_user_input'];
                          $id_spk = $record['id_spk'];
                          $sql_detail = $this->db->query("SELECT * FROM abe_spk_detail where id_user = '$user' AND id_spk = '$id_spk' ")->result();
                          $x = 1;
                          foreach ($sql_detail as $key) {
                            echo "<tr><td width='10px'>$x</td><td>$key->detail </td><td width='30px'>$key->status</td></tr>";
                            echo "<tr><td colspan='3'>$key->selesai</td>";
                            $x++ ;
                          }
                        ?>
                      </table>
                    </div>
                  </div>
                <?php }else{ ?>               
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-12">Detail Permasalahan</label>
                    <div class="col-md-8 col-sm-12">
                      <table class='table table-bordered table-striped'>
                        <?php
                          $user   = $record['id_user_input'];
                          $id_spk = $record['id_spk'];
                          $sql_detail = $this->db->query("SELECT * FROM abe_spk_detail where id_user = '$user' AND id_spk = '$id_spk' ")->result();
                          $x = 1;
                          foreach ($sql_detail as $key) {
                            echo "<tr><td width='10px'>$x</td><td>$key->detail </td><td width='30px'>$key->status</td></tr>";
                            $x++ ;
                          }
                        ?>
                      </table>
                    </div>
                  </div>
                <?php } ?>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-12">Tanggal Selesai</label>
                  <div class="col-md-8 col-sm-12">
                    <?php
                      $tgl_selesai = $record['tgl_selesai'];
                      if($tgl_selesai == '0000-00-00 00:00:00'){
                    ?>
                      <input name="tgl_rapat" type="text" value="belum selesai" class="form-control" readonly="true">
                    <?php
                      }else{
                    ?>
                      <input name="tgl_rapat" type="text" value="<?= date('d-m-Y H:i:s', strtotime($record['tgl_selesai']))?>" class="form-control" readonly="true">
                    <?php
                      }
                    ?>
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-12">Detail Penyelesaian</label>
                  <div class="col-md-8 col-sm-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <?= $record['penyelesaian'] ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>History SPK</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table class="table table-bordered table-striped" id="lookup4">
                <thead>
                  <tr>
                    <th width="20px">No</th>
                    <th width="130px">Tanggal</th>
                    <th width="100px">Status</th>
                    <th>Keterangan</th>
                    <th width="120px">Nama Pelaksana</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $id       = $record['id_spk'];
                    $sql      = "SELECT * FROM abe_spk_history WHERE id_spk = '$id'";
                    $history_spk    = $this->db->query($sql)->result();
                    $no = 1;
                    foreach ($history_spk as $row) {
                        echo "<tr>
                            <td>$no</td>
                            <td>".date('d-m-Y H:i:s', strtotime($row->tgl_status))."</td>
                            <td>$row->status_spk</td>
                            <td>$row->keterangan</td>
                            <td>$row->nama_user</td></tr>";    
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
</div>

<!-- jQuery -->
<script src="<?= base_url() ?>assets/gentelella/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url() ?>assets/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>


<!-- jquery.inputmask -->
<script src="<?= base_url() ?>assets/gentelella/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="<?= base_url() ?>assets/gentelella/build/js/custom.min.js"></script>
<!--
<script src="<?= base_url(); ?>assets/gentelella/js/jquery-2.1.4.min.js"></script>-->

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
<!--
<script src="<?= base_url() ?>assets/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?= base_url() ?>assets/gentelella/vendors/jszip/dist/jszip.min.js"></script>
-->
<script type="text/javascript">

    $(function () {
        $("#lookup").dataTable();
        $("#lookup2").dataTable(); 
        $("#lookup3").dataTable();
    });
</script>