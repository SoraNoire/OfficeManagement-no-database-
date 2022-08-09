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
        <h3>Data SPK IT Anda</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <button type='button' class="btn btn-sm btn-success" data-toggle="modal" data-target="#CreateSPK"><i class="fa fa-plus"></i> SPK IT</button>
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
                    <th width="60px">Tanggal</th>
                    <th width="40px">Divisi</th>
                    <th width="60px">Nama</th>
                    <th width="40px">Status</th>
                    <th>Permasalahan</th>
                    <th width="50px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $user     = $this->session->userdata('nama_lengkap');
                    $id_user  = $this->session->userdata('id_karyawan');
                    $jabatan  = $this->session->userdata('jabatan');
                    $sql      = "SELECT * FROM abe_spk_all WHERE id_user_input = '$id_user' ORDER BY tgl_input DESC";
                    $spk    = $this->db->query($sql)->result();
                    $no = 1;
                    foreach ($spk as $row) {
                      $id_spk   = $row->id_spk;
                      $user     = $row->id_user_input ;
                      $sql_detail = $this->db->query("SELECT * FROM abe_spk_detail where id_user = '$user' AND id_spk = '$id_spk' ")->result();
                            $x = 1;
                        echo "<tr>
                            <td>$no</td>
                            <td>".date('d-m-Y H:i:s', strtotime($row->tgl_input))."</td>
                            <td>$row->divisi</td>
                            <td>$row->nama_karyawan</td>
                            <td>$row->status_spk</td>
                            <td><table class='table table-bordered table-striped'>";
                          foreach ($sql_detail as $key) {
                              echo "<tr><td width='10px'>$x</td><td>$key->detail </td><td width='30px'>$key->status</td></tr>";
                              $x++;
                            }
                        echo "</table></td>
                            <td>";
                        if($row->status_spk == 'NEW'){
                        echo anchor('user/spk/hapus/'.$row->id_spk,'<i class="fa fa-trash"></i> Hapus', array('class'=>'btn btn-danger btn-xs', 'title'=>'hapus SPK', 'onclick'=>'javasciprt: return confirm(\'Anda yakin ingin menghapus SPK ini !! \')'));
                        echo "<a href='".base_url('user/spk/edit/')."$row->id_spk' class='btn btn-xs btn-warning'><i class='fa fa-edit'></i> Edit</a>";
                        }else{
                          echo "<a href='".base_url('user/spk/detail/')."$row->id_spk' class='btn btn-xs btn-info'><i class='fa fa-list'></i> Status</a>";
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
<!--
<div class="modal fade" id="CreateSPK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Pilih Lokasi Perbaikan</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" enctype="multipart/form-data" action="user/spk/add_lokasi">
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12">Lokasi Perbaikan</label>
                    <div class="col-md-8 col-sm-12">
                      <?php
                        //echo cmb_dinamis('lokasi_rapat','abe_kota','nama_kota','kode_kota');
                      ?>  
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
-->
<div class="modal fade" id="CreateSPK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Pilih Department Terkait SPK</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/spk/add_divisi">
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Pilih Divisi</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <select class="form-control select2" id="divisi" name="divisi" style="width: 100%;">
                        <?php
                            $this->load->database();
                            //$id = $r->id_paket;
                            $sql = "SELECT * FROM abe_department ORDER BY nama_department";
                            $query = $this->db->query($sql);
                            foreach ($query->result() as $r2){
                        ?>
                        <option value="<?php echo $r2->nama_department; ?>">
                            <?php echo $r2->nama_department; ?>
                        </option>
                        <?php
                        }
                        ?>
                      </select>  
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Pilih Karyawan</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <select class="form-control select2" id="karyawan" name="karyawan" style="width: 100%;" required="true">
                        <option>Pilih Karyawan</option>
                          <?php
                              $this->load->database();
                              $sql = "SELECT * FROM abe_karyawan INNER JOIN abe_department ON abe_karyawan.department = abe_department.nama_department WHERE abe_karyawan.status = 'aktif' ORDER BY nama_lengkap";
                              $query = $this->db->query($sql);
                              foreach ($query->result() as $r3){
                          ?>
                          <option id="karyawan" class="<?php echo $r3->nama_department; ?>" value="<?php echo $r3->id_karyawan; ?>">
                              <?php echo $r3->nama_lengkap; ?>
                          </option>
                          <?php
                          }
                          ?>
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
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/chain/jquery.chained.min.js"></script>
<script>
    $("#kota").chained("#provinsi");
    $("#kecamatan").chained("#kota");
    $("#karyawan").chained("#divisi");
</script>