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
        <h3>Data Status Karyawan</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <?php if($this->session->flashdata('sukses')){ ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <p><center><?php echo $this->session->flashdata('sukses'); ?></center></p>
        </div>
    <?php } ?>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Form Status<small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="<?= base_url('hrd/karyawan') ?>" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> Back</a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>hrd/karyawan/proses_status">
              <div class="form-group">
                <input type="hidden" name="karyawan" value="<?= $this->uri->segment(4); ?>">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Status Karyawan</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="status" class="form-control" required="true">
                    <option value="">-- pilih status --</option>
                    <option value="kontrak ke 1">Kontrak ke 1</option>
                    <option value="kontrak ke 2">Kontrak ke 2</option>
                    <option value="karyawan tetap">Karyawan Tetap</option>
                    <option value="magang">Magang</option>
                    <option value="lainnya">lainnya...</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Aktif</label>
                <div class="col-md-2 col-sm-2 col-xs-6">
                  <input type="text" required="true" name="tgl_awal" data-inputmask="'mask': '99-99-9999'" id="datepicker-example1" placeholder="tanggal awal" class="form-control col-md-7 col-xs-12 tanggal">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                  <input type="text" name="tgl_akhir" data-inputmask="'mask': '99-99-9999'" id="datepicker-example1" placeholder="tanggal akhir (kosongkan apabila sudah tetap)" class="form-control col-md-7 col-xs-12 tanggal">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan Status</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea name="keterangan" required="true" placeholder="keterangan status karyawan" style="resize:none; width:100%; height:150px;" class="form-control"></textarea>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                  <button class="btn btn-warning" type="reset">Reset</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data History Status Karyawan <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <button class="btn btn-sm btn-primary"><?= date('d M Y'); ?></button>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="lookup">
                <thead>
                  <tr>
                    <th width="30px">No</th>
                    <th width="150px">Status Karyawan</th>
                    <th width="100px">Tanggal Awal</th>
                    <th width="100px">Tanggal Akhir</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $id = $this->uri->segment(4);
                    //$tgl = date('d-m-Y');
                    $sql     = "SELECT * FROM abe_karyawan_status WHERE id_karyawan = $id ORDER BY tgl_input DESC";
                    $history = $this->db->query($sql)->result();
                    $no      = 1;
                    foreach ($history as $row) {
                      echo "<tr>
                            <td>$no</td>
                            <td>$row->status</td>
                            <td>".date('d-m-Y', strtotime($row->tgl_awal))."</td>";
                        if($row->tgl_akhir == '1970-01-01'){
                            echo "<td>kosong</td>";
                        }else{
                            echo "<td>".date('d-m-Y', strtotime($row->tgl_akhir))."</td>";
                        }
                        echo "<td>$row->keterangan</td>";                
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