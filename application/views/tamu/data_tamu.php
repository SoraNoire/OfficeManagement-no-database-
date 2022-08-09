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
         <h3>Data Buku Tamu</h3>
       </div>
     </div>
     <div class="clearfix"></div>
     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
           <div class="x_title">
             <h2><small></small></h2>
             <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#CreateTamu">
               <i class="fa fa-user"></i> Input Data Tamu
             </a>
             <ul class="nav navbar-right panel_toolbox">
               <a href="<?= base_url() ?>" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> Back</a>
               <button type="button" class="btn btn-sm btn-primary"><?= date('d M Y'); ?></button>
             </ul>
             <div class="clearfix"></div>
           </div>
           <?php if ($this->session->flashdata('sukses')) { ?>
             <div class="alert alert-warning alert-dismissible" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <p>
                 <center><?php echo $this->session->flashdata('sukses'); ?></center>
               </p>
             </div>
           <?php } ?>
           <div class="x_content">
             <table class="table table-bordered table-striped" id="lookup">
               <thead>
                 <tr>
                   <th width="10px">No</th>
                   <th width="70px">Tanggal</th>
                   <th width="120px">Nama Tamu</th>
                   <th width="120px">Perusahaan</th>
                   <th width="110px">Bertemu dengan</th>
                   <th>Keperluan</th>
                   <th width="50px">Status</th>
                   <th width="50px">Action</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                  $user     = $this->session->userdata('nama_lengkap');
                  $id_user  = $this->session->userdata('id_karyawan');
                  $jabatan  = $this->session->userdata('jabatan');
                  $sql      = "SELECT * FROM abe_buku_tamu ORDER BY id_tamu DESC";
                  $tamu    = $this->db->query($sql)->result();
                  $no = 1;
                  foreach ($tamu as $row) {
                    echo "<tr>
                            <td>$no</td>
                            <td>" . date('d-m-Y', strtotime($row->tgl_tamu)) . "</td>
                            <td>$row->nama_tamu</td>
                            <td>$row->perusahaan</td>
                            <td>$row->user_tujuan</td>
                            <td>$row->keperluan</td>
                            <td>$row->status_tamu</td>
                            <td>";
                    $a = $row->nama_tamu;
                    $b = $row->jumlah_tamu;
                    $c = $row->perusahaan;
                    $d = $row->keperluan;
                    $e = $row->user_tujuan;
                    //$f = $row->tgl_tamu;
                    $f = date('d-m-Y', strtotime($row->tgl_tamu));
                    $g = $row->jam_masuk;
                    $h = $row->jam_keluar;
                    $i = $row->keterangan;
                    $j = $row->status_tamu;
                    $k = $row->nama_input;
                    $id = $row->id_tamu;
                    if ($h == '00:00:00') {
                      $h = 'belum selesai';
                      //echo "<a class='btn btn-xs btn-success' href='" . base_url() . "user/tamu/selesai/$row->id_tamu'><i class='fa fa-check'></i> selesai</a>";
                      echo "<button title=\"Selesai\" class=\"btn btn-xs btn-success\" onclick=\"selesai_tamu('$id')\"><i class=\"fa fa-check\"></i> selesai</button>";
                      echo "<button title=\"Detail Tamu\" class=\"btn btn-xs btn-info\" onclick=\"detail_tamu('$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k')\"><i class=\"fa fa-list\"></i> Detail</button>";
                    } else {
                      echo "<button title=\"Detail Tamu\" class=\"btn btn-xs btn-info\" onclick=\"detail_tamu('$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k')\"><i class=\"fa fa-list\"></i> Detail</button>";
                    }
                    echo "</td></tr>";
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
   $(function() {
     $("#lookup").dataTable();
     $("#lookup2").dataTable();
     $("#lookup3").dataTable();
   });

   function detail_tamu(a, b, c, d, e, f, g, h, i, j, k) {
     $('[name="nama_tamu"]').val(a);
     $('[name="jumlah_tamu"]').val(b);
     $('[name="perusahaan"]').val(c);
     $('[name="keperluan"]').val(d);
     $('[name="user_tujuan"]').val(e);
     $('[name="tgl_tamu"]').val(f);
     $('[name="jam_masuk"]').val(g);
     $('[name="jam_keluar"]').val(h);
     $('[name="keterangan"]').val(i);
     $('[name="status_tamu"]').val(j);
     $('[name="nama_input"]').val(k);
     $('#DetailTamu').modal('show');
   }

   function selesai_tamu(id) {
     $('[name="id_tamu"]').val(id);
     $('#SelesaiTamu').modal('show');
   }
 </script>

 <!-- datepicker -->
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

 <script src="<?= base_url() ?>assets/gentelella/js/notify.js"></script>
 <div class="modal fade" id="DetailTamu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title" id="myModalLabel">Form Buku Tamu</h4>
       </div>
       <div class="modal-body">
         <form class="form-horizontal" method="post" enctype="multipart/form-data">
           <div class="form-body">
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Nama Tamu</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="nama_tamu" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Jumlah Tamu</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" readonly="true" name="jumlah_tamu" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Nama Perusahaan</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="perusahaan" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Keperluan</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" readonly="true" name="keperluan" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Bertemu dengan</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="user_tujuan" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Keterangan</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <textarea name="keterangan" class="form-control" readonly="true"></textarea>
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Tanggal Masuk</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="tgl_tamu" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Jam Masuk</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" readonly="true" name="jam_masuk" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Jam Keluar</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="jam_keluar" readonly="true" class="form-control">
               </div>
             </div>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
           </div>
         </form>
       </div>
     </div>
   </div>
 </div>

 <!-- Modal Daftar Tamu -->

 <div class="modal fade" id="CreateTamu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title" id="myModalLabel">Form Buku Tamu</h4>
       </div>
       <div class="modal-body">
         <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/tamu/add_tamu">
           <div class="form-body">
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Tanggal</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input name="tgl_tamu" required="true" type="text" data-inputmask="'mask': '99-99-9999'" id="datepicker-example1" placeholder="masukkan tanggal" class="form-control tanggal">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Jam</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input name="jam_tamu" required="true" type="text" data-inputmask="'mask': '99:99'" id="datepicker-example1" placeholder="masukkan jam" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Nama Tamu</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="nama_tamu" placeholder="nama lengkap" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Jumlah Tamu</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" data-inputmask="'mask': '99'" required="true" name="jumlah_tamu" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Nama Perusahaan</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="nama_perusahaan" placeholder="perorangan / nama perusahaan" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Keperluan</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="keperluan" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Bertemu dengan</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="user_tujuan" placeholder="nama divisi / nama karyawan" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Keterangan</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <textarea name="keterangan" class="form-control"></textarea>
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

 <div class="modal fade" id="SelesaiTamu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title" id="myModalLabel">Proses Selesai Tamu</h4>
       </div>
       <div class="modal-body">
         <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/tamu/selesai_tamu">
           <div class="form-body">
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Jam</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="hidden" name="id_tamu" id="id_tamu">
                 <input name="jam_tamu" required="true" type="text" data-inputmask="'mask': '99:99'" id="datepicker-example1" placeholder="wajib di isi" class="form-control">
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