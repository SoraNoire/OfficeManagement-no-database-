 <!-- Datatables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css">

<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css">
<!-- Custom Theme Style -->
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css">

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Data Reminder Cek Finance</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#AddReminder"><i class="fa fa-plus"></i> Reminder</a>
              <button  type="button" class="btn btn-sm btn-primary"><?= date('d M Y'); ?></button>
            </ul>
            <div class="clearfix"></div>
          </div>
          <?php if($this->session->flashdata('sukses')){ ?>
            <div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <p><center><?php echo $this->session->flashdata('sukses'); ?></center></p>
            </div>
          <?php }?>
          <div class="x_content">
              <table class="table table-bordered table-striped" id="lookup">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th width="100px">Bank</th>
                    <th>Nama PT</th>
                    <th>Nilai</th>
                    <th width="90px">Tanggal Aktif</th>
                    <th width="90px">Tanggal Exp.</th>
                    <th width="50px">Status</th>
                    <th width="80px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    date_default_timezone_set("Asia/Jakarta");
                    //$today    = date("Y-m-d");
                    $sql      = "SELECT * FROM abe_reminder_cek ORDER BY tgl_cek_terbit ASC";
                    $reminder = $this->db->query($sql)->result();
                    $no = 1;
                    foreach ($reminder as $row) {
                        $tgl_aktif  = new DateTime("$row->tgl_cek_terbit");
                        $tgl_akhir  = new DateTime("$row->tgl_expired");
                        $today      = new DateTime();      
                        $selisih    = $tgl_akhir->diff($today);
                        //$selisih  = $tgl_akhir->diff($tgl_aktif);
                        $a = $row->bank;
                        $b = $row->no_cek;
                        $c = $row->nama_pt;
                        $d = $row->nilai;
                        $e = date('d-m-Y', strtotime($row->tgl_cek_terbit));
                        $f = date('d-m-Y', strtotime($row->tgl_expired));
                        $g = $row->lama_waktu;
                        $h = $row->id_cek;
                        $i = $row->tujuan_pt;
                        $j = $row->status;
                        $k = $row->catatan;
                        echo "<tr>
                            <td>$no</td>
                            <td>$a</td>
                            <td>$c</td>
                            <td>$d</td>
                            <td>$e</td>
                            <td>$f</td>";
                            if($selisih->days <= $g){
                              echo "<td><button class='btn btn-xs btn-danger'><i class='fa fa-bell'></i> $selisih->days hari </button> </td>";
                              echo "<td><button title=\"Update Data\" class=\"btn btn-xs btn-danger\" onclick=\"update_reminder('$a','$b','$c','$d','$e','$f','$g','$h')\"><i class=\"fa fa-upload\"></i></button> <button title=\"Detail Reminder\" class=\"btn btn-xs btn-primary\" onclick=\"detail_reminder('$a','$b','$c','$d','$e','$f','$g','$i','$j','$k','$h')\"><i class=\"fa fa-list\"></i> Detail</button></td></tr>";
                            }else{
                              echo "<td><button class='btn btn-xs btn-info'><i class='fa fa-check'></i> $selisih->days hari </button></td>";
                              echo "<td><button title=\"Edit Data\" class=\"btn btn-xs btn-warning\" onclick=\"update_reminder('$a','$b','$c','$d','$e','$f','$g','$h')\"><i class=\"fa fa-edit\"></i></button><button title=\"Detail Reminder\" class=\"btn btn-xs btn-primary\" onclick=\"detail_reminder('$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k')\"><i class=\"fa fa-list\"></i> Detail</button></td></tr>";
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

    $(function () {
        $("#lookup").dataTable();
        $("#lookup2").dataTable(); 
        $("#lookup3").dataTable();
    });

  function detail_reminder(a, b, c, d, e, f, g, h, i, j, k)
  {
      $('[name="bank"]').val(a);
      $('[name="no_cek"]').val(b);
      $('[name="nama_pt"]').val(c);
      $('[name="nilai"]').val(d);
      $('[name="tgl_terbit"]').val(e);
      $('[name="tgl_expired"]').val(f);
      $('[name="lama_waktu"]').val(g);
      $('[name="id_cek"]').val(h);
      $('[name="tujuan_pt"]').val(i);
      $('[name="status"]').val(j);
      $('[name="catatan"]').val(k);
      $('#DetailReminder').modal('show');
  }

  function update_reminder(a, b, c, d, e, f, g, h, i, j, k)
  {
      $('[name="bank"]').val(a);
      $('[name="no_cek"]').val(b);
      $('[name="nama_pt"]').val(c);
      $('[name="nilai"]').val(d);
      $('[name="tgl_terbit"]').val(e);
      $('[name="tgl_expired"]').val(f);
      $('[name="lama_waktu"]').val(g);
      $('[name="id_cek"]').val(h);
      $('[name="tujuan_pt"]').val(i);
      $('[name="status"]').val(j);
      $('[name="catatan"]').val(k);
      $('#UpdateReminder').modal('show');
  }

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
<div class="modal fade" id="DetailReminder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Form Detail Reminder</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Bank</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" required="true" name="bank" readonly="true" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Nomor Cek</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" readonly="true" name="no_cek" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Nama PT</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" readonly="true" name="nama_pt" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Nilai</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" readonly="true" name="nilai" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Tanggal Cek Terbit</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" required="true" name="tgl_terbit" readonly="true" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Tanggal Expired</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" required="true" name="tgl_expired" readonly="true" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Waktu Pengingat (hari)</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" readonly="true" name="lama_waktu" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Tujuan PT</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" readonly="true" name="tujuan_pt" class="form-control">  
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Status</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" readonly="true" name="status" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Catatan</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <textarea name="catatan" class="form-control" readonly="true"></textarea> 
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              </div>
              </form>  
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="AddReminder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Form Create Reminder</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/reminder_cek/add_reminder">
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Bank</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" name="bank" placeholder="nama bank penerbit" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">No CEK</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" name="no_cek" placeholder="nomor cek" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Nama PT</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" name="nama_pt" placeholder="nama perusahaan" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Nilai Cek</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" name="nilai" placeholder="nilai cek" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Tanggal Terbit</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input name="tgl_terbit" required="true"  type="text" data-inputmask="'mask': '99-99-9999'" id="datepicker-example1" placeholder="tanggal terbit Cek" class="form-control tanggal" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Tanggal Akhir</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input name="tgl_expired" required="true"  type="text" data-inputmask="'mask': '99-99-9999'" id="datepicker-example1" placeholder="tanggal expired cek" class="form-control tanggal" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Waktu Pengingat</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <select required="true" name="lama_waktu" class="form-control">
                        <option value="">-- pilih waktu pengingat--</option>
                        <option value="7">1 Minggu</option>
                        <option value="14">2 Minggu</option>
                        <option value="21">3 Minggu</option>
                        <option value="30">1 Bulan</option>
                        <option value="60">2 Bulan</option>
                        <option value="90">3 Bulan</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12 col-xs-12">Tujuan PT</label>
                  <div class="col-md-8 col-sm-12 col-xs-12">
                    <input type="text" name="tujuan_pt" placeholder="nilai cek" class="form-control"> 
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Catatan</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <textarea name="catatan" class="form-control" placeholder="catatan tambahan"></textarea>
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






<div class="modal fade" id="UpdateReminder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Detail Reminder</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/reminder_cek/update_reminder">
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Kategori</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" required="true" name="kategori" readonly="true" class="form-control"> 
                      <input type="hidden" name="id_reminder"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Nomor Dokumen</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" required="true" name="nomor_dokumen" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Detail</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <textarea name="detail" class="form-control" required="true"></textarea> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Catatan</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <textarea name="catatan" class="form-control" required="true"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Tanggal Aktif</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" required="true" name="tgl_aktif" required="true" data-inputmask="'mask': '99-99-9999'" id="datepicker-example1" class="form-control tanggal"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Tanggal Akhir</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" required="true" name="tgl_akhir" required="true" data-inputmask="'mask': '99-99-9999'" id="datepicker-example1" class="form-control tanggal"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Waktu Pengingat (hari)</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <select required="true" name="lama_waktu" class="form-control">
                        <option value="">-- pilih waktu pengingat--</option>
                        <option value="7">1 Minggu</option>
                        <option value="14">2 Minggu</option>
                        <option value="21">3 Minggu</option>
                        <option value="30">1 Bulan</option>
                        <option value="60">2 Bulan</option>
                        <option value="90">3 Bulan</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Update</button>
                  <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                </div>
              </form>  
            </div>
        </div>
    </div>
</div>