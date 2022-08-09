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
        <h3>Data SPK IT</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><small></small></h2>
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
                    <th width="50px">Tanggal</th>
                    <th width="50px">No. SPK</th>
                    <th width="100px">Nama</th>
                    <th width="50px">Status</th>
                    <th>Permasalahan</th>
                    <th width="50px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $user     = $this->session->userdata('nama_lengkap');
                    $id_user  = $this->session->userdata('id_karyawan');
                    $jabatan  = $this->session->userdata('jabatan');
                    $sql      = "SELECT * FROM abe_spk_all ORDER BY tgl_input DESC";
                    $spk    = $this->db->query($sql)->result();
                    $no = 1;
                    foreach ($spk as $row) {
                      $id_spk   = $row->id_spk;
                      $user     = $row->id_user_input ;
                      $d        = $row->id_spk;
                      $c        = $row->no_spk;
                      $sql_detail = $this->db->query("SELECT * FROM abe_spk_detail where id_user = '$user' AND id_spk = '$id_spk' ")->result();
                      $x = 1;
                        echo "<tr>
                            <td>$no</td>
                            <td>".date('d-m-Y H:i:s', strtotime($row->tgl_input))."</td>
                            <td>$row->no_spk</td>
                            <td>$row->nama_user</td>
                            <td>$row->status_spk</td>
                            <td><table class='table table-bordered table-striped'>";
                        foreach ($sql_detail as $key) {
                          $b = $key->id_spk_detail;
                              echo "<tr><td width='10px'>$x</td><td>$key->detail </td><td width='30px'>$key->status</td><td width='60px'>";
                              if($key->status == 'NEW'){
                                echo "";
                              }else if($key->status == 'READ'){
                                echo "<a class='btn btn-xs btn-warning' href='".base_url()."user/spk/proses_spk/$key->id_spk_detail' title='proses'><i class='fa fa-cog'></i> </a>";
                              }else if($key->status == 'PROSES'){
                                echo "<button title=\"SPK Pending\" class=\"btn btn-xs btn-warning\" onclick=\"pending_spk('$d','$c','$b')\"><i class=\"fa fa-refresh\"></i> </button>";
                                echo "<button title=\"SPK Selesai\" class=\"btn btn-xs btn-success\" onclick=\"selesai_spk('$d','$c','$b')\"><i class=\"fa fa-check\"></i> </button>";
                              }else if($key->status == 'PENDING'){
                                echo "<a class='btn btn-xs btn-warning' href='".base_url()."user/spk/proses_spk/$key->id_spk_detail' title='proses'><i class='fa fa-cog'></i> </a>";
                              }else{
                                echo "<a class='btn btn-xs btn-info' href='#' title='selesai'><i class='fa fa-flag'></i> done</a>";
                              }
                              echo "</td></tr>";
                              $x++;
                            }

                        echo "</table></td>
                              <td>";
                        
                        if($row->status_spk == 'NEW'){  
                          if($row->divisi == 'IT'){
                            echo "<button title=\"baca SPK\" class=\"btn btn-xs btn-success\" onclick=\"read_spk('$d','$c')\"><i class=\"fa fa-eye\"></i> read</button></td></tr>";
                            /**
                            $sql_detail = $this->db->query("SELECT * FROM abe_spk_detail where id_user = '$user' AND id_spk = '$id_spk' ")->result();
                            $x = 1;
                            foreach ($sql_detail as $key) {
                              echo "<tr><td colspan='2' style='text-align: right'>$x )</td><td colspan='4'>$key->detail</td><td>$key->status</td><td></td></tr>";
                                $x++;
                            }
                            **/
                          }else{
                            echo "<a class='btn btn-xs btn-success' href='".base_url()."user/spk/read_spk/$row->id_spk'><i class='fa fa-eye'></i> read</a></td></tr>";
                            /**
                            $sql_detail = $this->db->query("SELECT * FROM abe_spk_detail where id_user = '$user' AND id_spk = '$id_spk' ")->result();
                            $x = 1;
                            foreach ($sql_detail as $key) {
                              echo "<tr><td colspan='2' style='text-align: right'>$x )</td><td colspan='4'>$key->detail</td><td>$key->status</td><td></td></tr>";
                                $x++;
                            }
                            **/
                          }
                        }else if($row->status_spk == 'READ'){
                          echo "<a href='".base_url('user/spk/selesai/')."$row->id_spk' class='btn btn-xs btn-success'><i class='fa fa-check'></i> Selesai</a>";
                          echo "<a href='".base_url('user/spk/detail/')."$row->id_spk' class='btn btn-xs btn-info'><i class='fa fa-list'></i> Detail</a></td></tr>";
                        }else if($row->status_spk == 'PROSES'){
                          echo "<a href='".base_url('user/spk/selesai/')."$row->id_spk' class='btn btn-xs btn-success'><i class='fa fa-check'></i> Selesai</a>";
                          echo "<a href='".base_url('user/spk/detail/')."$row->id_spk' class='btn btn-xs btn-info'><i class='fa fa-list'></i> Status</a></td></tr>";
                        }else{
                          echo "<a class='btn btn-xs btn-success' href='#' title='selesai'><i class='fa fa-flag'></i> done</a><a href='".base_url('user/spk/detail/')."$row->id_spk' class='btn btn-xs btn-info'><i class='fa fa-list'></i> Status</a></td></tr>";
                        }      
                          
                        ?>

                          
                        <?php    
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

  function read_spk(id, spk)
  {
      $('[name="id_spk"]').val(id);
      $('[name="no_spk"]').val(spk);
      $('#ReadSPK').modal('show');
  }

  function pending_spk(id, spk)
  {
      $('[name="id_spk"]').val(id);
      $('[name="no_spk"]').val(spk);
      $('#PendingSPK').modal('show');
  }

  function selesai_spk(id, spk)
  {
      $('[name="id_spk"]').val(id);
      $('[name="no_spk"]').val(spk);
      $('#SelesaiSPK').modal('show');
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

<!-- Bootstrap modal -->
<div class="modal fade" id="ReadSPK" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title">Pilih Kategori Permasalahan</h3>
            </div>
            <div class="modal-body form">
              <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/spk/add_kategori">
                <div class="form-body">
                  <div class="form-group">
                    <input type="hidden" name="id_spk">
                    <input type="hidden" name="no_spk">
                    <label class="control-label col-md-4 col-sm-12">Kategori Permasalahan</label>
                    <div class="col-md-8 col-sm-12">
                      <select class="form-control" name="kategori" required="true">
                        <option value="">-- pilih kategori --</option>
                        <option value="hardware">Hardware</option>
                        <option value="software">Software</option>
                        <option value="network">Network</option>
                        <option value="others">Others</option>
                      </select>
                    </div>
                  </div> 
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Proses</button>
                  <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                </div>
              </form>  
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="PendingSPK" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title">Form Pending</h3>
            </div>
            <div class="modal-body form">
              <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/spk/pending_spk">
                <div class="form-body">
                  <div class="form-group">
                    <input type="hidden" name="id_spk">
                    <input type="hidden" name="no_spk">
                    <label class="control-label col-md-4 col-sm-12">Alasan Pending</label>
                    <div class="col-md-8 col-sm-12">
                      <textarea class="form-control" name="alasan" required="true"></textarea>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Proses</button>
                  <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                </div>
              </form>  
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="SelesaiSPK" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title">Form Penyelesaian</h3>
            </div>
            <div class="modal-body form">
              <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/spk/selesai_spk">
                <div class="form-body">
                  <div class="form-group">
                    <input type="hidden" name="id_spk">
                    <input type="hidden" name="no_spk">
                    <label class="control-label col-md-4 col-sm-12">Penyelesaian</label>
                    <div class="col-md-8 col-sm-12">
                      <textarea class="form-control" name="penyelesaian" required="true"></textarea>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Proses</button>
                  <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                </div>
              </form>  
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->