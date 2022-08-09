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
         <h3>Data Tanda Terima Dokumen</h3>
       </div>
     </div>
     <div class="clearfix"></div>
     <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
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
                   <th width="120px">Penerima</th>
                   <th>Data Dokumen</th>
                   <th width="130px">Action</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                  $id_user  = $this->session->userdata('id_karyawan');
                  $sql      = "SELECT * FROM abe_tanda_terima WHERE id_pemberi = $id_user OR id_penerima = $id_user ORDER BY id_tanda_terima DESC";
                  $surat    = $this->db->query($sql)->result();
                  $no = 1;
                  foreach ($surat as $row) {
                    $id = $row->id_tanda_terima ;
                    $a = $row->nomor_tanda_terima;
                    $b = $row->nama_pemberi;
                    $c = $row->perusahaan;
                    $penerima     = $row->nama_penerima;
                    $sql_penerima = $this->db->query("SELECT id_karyawan, nama_lengkap FROM abe_karyawan WHERE id_karyawan = '$penerima'")->row_array();
                    $d = $sql_penerima['nama_lengkap'];
                    $e = $row->nama_dokumen;
                    $f = date('d-m-Y H:i:s', strtotime($row->tgl_input));
                    $g = $row->status;

                    if($row->tgl_proses == "0000-00-00 00:00:00"){
                        $h = "-";
                    }else{
                        $h = date('d-m-Y H:i:s', strtotime($row->tgl_proses));
                    }
                    $i = $row->keterangan_status;
                    echo "<tr>
                            <td>$no</td>
                            <td>$row->nomor_tanda_terima</td>
                            <td>$row->divisi</td>
                            <td>$d</td>";
                    $divisi = $row->divisi;
                    $season_divisi = $this->session->userdata('department');
                    if ($season_divisi == 'ALL') {
                      echo     "<td>$row->nama_dokumen</td>
                              <td>";
                      echo "<button title=\"Detail\" class=\"btn btn-xs btn-info\" onclick=\"detail_surat('$a','$b','$c','$d','$e','$f','$g','$h','$i')\"><i class=\"fa fa-list\"></i> Detail</button>";
                      echo "</td></tr>";
                    } else {
                      if ($row->id_penerima == $this->session->userdata('id_karyawan') OR $row->id_pemberi == $this->session->userdata('id_karyawan')) {
                        echo  "<td>$row->nama_dokumen</td>
                               <td>";
                        echo "<button title=\"Detail\" class=\"btn btn-xs btn-info\" onclick=\"detail_surat('$a','$b','$c','$d','$e','$f','$g','$h','$i')\"><i class=\"fa fa-list\"></i> Detail</button>"; 
                        if($this->session->userdata('department') == 'IT'){
                        echo anchor('user/tanda_terima/hapus_nomor/'.$row->id_tanda_terima,'<i class="fa fa-trash"></i> Hapus', array('class'=>'btn btn-danger btn-xs', 'title'=>'hapus nomor surat', 'onclick'=>'javasciprt: return confirm(\'Anda yakin ingin menghapus Nomor Surat ini !! \')'));
                        }
                        if($g == 'input' AND $row->id_penerima == $id_user){
                          echo "<button title=\"Detail\" class=\"btn btn-xs btn-warning\" onclick=\"proses_surat('$a','$b','$c','$d','$e','$f','$g','$h')\"><i class=\"fa fa-cogs\"></i> Proses</button>"; 
                        }
                        echo "</td></tr>";
                      } else {
                        echo  "<td> - </td>
                               <td>";
                        
                        echo "<button title=\"Detail\" class=\"btn btn-xs btn-info\" onclick=\"detail_surat('$a','$b','$c','$d','$e','$f','$g','$h','$i')\"><i class=\"fa fa-list\"></i> Detail</button>";
                        if($this->session->userdata('department') == 'IT'){
                        echo anchor('user/tanda_terima/hapus_nomor/'.$row->id_tanda_terima,'<i class="fa fa-trash"></i> Hapus', array('class'=>'btn btn-danger btn-xs', 'title'=>'hapus nomor surat', 'onclick'=>'javasciprt: return confirm(\'Anda yakin ingin menghapus Nomor Surat ini !! \')'));
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

   function detail_surat(a, b, c, d, e, f, g,h,i) {
     $('[name="nomor_tanda_terima"]').val(a);
     $('[name="nama_pemberi"]').val(b);
     $('[name="perusahaan"]').val(c);
     $('[name="nama_penerima"]').val(d);
     $('[name="nama_dokumen"]').val(e);
     $('[name="tgl_input"]').val(f);
     $('[name="status"]').val(g);
     $('[name="tgl_proses"]').val(h);
     $('[name="keterangan"]').val(i);
     $('#DetailSurat').modal('show');
   }

   function proses_surat(a, b, c, d, e, f, g,h) {
     $('[name="nomor_tanda_terima"]').val(a);
     $('[name="nama_pemberi"]').val(b);
     $('[name="perusahaan"]').val(c);
     $('[name="nama_penerima"]').val(d);
     $('[name="nama_dokumen"]').val(e);
     $('[name="tgl_input"]').val(f);
     $('[name="status"]').val(g);
     $('[name="tgl_proses"]').val(h);
     $('#ProsesSurat').modal('show');
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
         <h3 class="modal-title">Form Detail Tanda Terima Dokumen</h3>
       </div>
       <div class="modal-body form">
         <form class="form-horizontal" method="post" enctype="multipart/form-data">
           <div class="form-body">
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Nomor Tanda Terima</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" name="nomor_tanda_terima" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Pemberi Dokumen</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="nama_pemberi" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Perusahaan</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input name="perusahaan" type="text" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Penerima Dokumen</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="nama_penerima" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Data Dokumen</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <textarea name="nama_dokumen" class="form-control" readonly="true"></textarea>
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Tanggal Kirim</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="tgl_input" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Tanggal Terima</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="tgl_proses" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Status</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input name="status" type="text" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Keterangan Status</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <textarea name="keterangan" readonly="" class="form-control"></textarea>
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

 <div class="modal fade" id="ProsesSurat" role="dialog">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h3 class="modal-title">Form Proses Tanda Terima Dokumen</h3>
       </div>
       <div class="modal-body form">
         <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/tanda_terima/update">
           <div class="form-body">
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Nomor Tanda Terima</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" name="nomor_tanda_terima" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Pemberi Dokumen</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="nama_pemberi" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Perusahaan</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input name="perusahaan" type="text" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Penerima Dokumen</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="nama_penerima" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Data Dokumen</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <textarea name="nama_dokumen" class="form-control" readonly="true"></textarea>
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Tanggal Kirim</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <input type="text" required="true" name="tgl_input" readonly="true" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Status</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <select required="true" name="status" class="form-control">
                   <option value="diterima">Diterima</option>
                   <option value="ditolak">Ditolak</option>
                 </select>
               </div>
             </div>
             <div class="form-group">
               <label class="control-label col-md-4 col-sm-12 col-xs-12">Keterangan Status</label>
               <div class="col-md-8 col-sm-12 col-xs-12">
                 <textarea name="keterangan" class="form-control"></textarea>
               </div>
             </div>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
             <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Proses</button>
           </div>
         </form>
       </div>
     </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->