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
         <h3>Data Nomor Surat Internal</h3>
       </div>
     </div>
     <div class="clearfix"></div>
     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
           <div class="x_title">
             <h2><small></small></h2>
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
                   <th width="160px">Nomor Surat</th>
                   <th width="100px">Divisi</th>
                   <th width="120px">Tujuan</th>
                   <th>Perihal</th>
                   <th width="110px">Action</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                  $sql      = "SELECT * FROM abe_nomor_surat ORDER BY id_ns DESC";
                  $surat    = $this->db->query($sql)->result();
                  $no = 1;
                  foreach ($surat as $row) {
                    $id = $row->id_ns ;
                    $a = $row->nomor_surat;
                    $b = $row->divisi;
                    $c = $row->perusahaan;
                    $d = $row->tujuan;
                    $e = "-";
                    $f = date('d-m-Y', strtotime($row->tgl_surat));
                    $g = $row->user_input;
                    echo "<tr>
                            <td>$no</td>
                            <td>$row->nomor_surat</td>
                            <td>$row->divisi</td>
                            <td>$row->tujuan</td>";
                    $divisi = $row->divisi;
                    $season_divisi = $this->session->userdata('department');
                    if ($season_divisi == 'ALL') {
                      echo     "<td>$row->perihal</td>
                              <td>";
                      echo "<button title=\"Detail\" class=\"btn btn-xs btn-info\" onclick=\"detail_surat('$a','$b','$c','$d','$e','$f','$g')\"><i class=\"fa fa-list\"></i> Detail</button>";
                      echo "</td></tr>";
                    } else {
                      if ($divisi == $season_divisi) {
                        echo     "<td>$row->perihal</td>
                              <td>";
                        echo "<button title=\"Detail\" class=\"btn btn-xs btn-info\" onclick=\"detail_surat('$a','$b','$c','$d','$e','$f','$g')\"><i class=\"fa fa-list\"></i> Detail</button>"; 
                        if($this->session->userdata('department') == 'IT'){
                        echo anchor('user/nomor_surat/hapus_nomor/'.$row->id_ns,'<i class="fa fa-trash"></i> Hapus', array('class'=>'btn btn-danger btn-xs', 'title'=>'hapus nomor surat', 'onclick'=>'javasciprt: return confirm(\'Anda yakin ingin menghapus Nomor Surat ini !! \')'));
                        }
                        echo "</td></tr>";
                      } else {
                        echo     "<td> - </td>
                              <td>";
                        
                        echo "<button title=\"Detail\" class=\"btn btn-xs btn-info\" onclick=\"detail_surat('$a','$b','$c','$d','$e','$f','$g')\"><i class=\"fa fa-list\"></i> Detail</button>";
                        if($this->session->userdata('department') == 'IT'){
                        echo anchor('user/nomor_surat/hapus_nomor/'.$row->id_ns,'<i class="fa fa-trash"></i> Hapus', array('class'=>'btn btn-danger btn-xs', 'title'=>'hapus nomor surat', 'onclick'=>'javasciprt: return confirm(\'Anda yakin ingin menghapus Nomor Surat ini !! \')'));
                        }
                        echo "</td></tr>";
                      }
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

   function detail_surat(a, b, c, d, e, f, g) {
     $('[name="nomor_surat"]').val(a);
     $('[name="divisi"]').val(b);
     $('[name="perusahaan"]').val(c);
     $('[name="tujuan"]').val(d);
     $('[name="perihal"]').val(e);
     $('[name="tgl_surat"]').val(f);
     $('[name="user_input"]').val(g);
     $('#DetailSurat').modal('show');
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
 <div class="modal fade" id="DetailSurat" role="dialog">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h3 class="modal-title">Form Detail Nomor Surat Internal</h3>
       </div>
       <div class="modal-body form">
         <form class="form-horizontal" method="post" enctype="multipart/form-data">
           <div class="form-body">
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Nomor Surat</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" name="nomor_surat" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Divisi</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="divisi" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Perusahaan</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input name="perusahaan" type="text" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Tujuan</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="tujuan" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Perihal</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <textarea name="perihal" class="form-control" readonly="true"></textarea>
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Tanggal Surat</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="tgl_surat" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Nama Pengguna</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input name="user_input" type="text" readonly="true" class="form-control">
               </div>
             </div>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
           </div>
         </form>
       </div>
     </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->