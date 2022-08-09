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
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <p><center><?php echo $this->session->flashdata('sukses'); ?></center></p>
            </div>
          <?php }?>
          <div class="x_content">
              <table class="table table-bordered table-striped" id="lookup">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th width="90px">Tanggal</th>
                    <th width="120px">No. SPK</th>
                    <th width="80px">Lokasi</th>
                    <th width="100px">Nama</th>
                    <th width="80px">Kategori</th>
                    <th width="60px">Status</th>
                    <th>Permasalahan</th>
                    <th width="50px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $user     = $this->session->userdata('nama_lengkap');
                    $id_user  = $this->session->userdata('id_karyawan');
                    $jabatan  = $this->session->userdata('jabatan');
                    $sql      = "SELECT * FROM abe_spk ORDER BY tgl_input DESC";
                    $spk    = $this->db->query($sql)->result();
                    $no = 1;
                    foreach ($spk as $row) {
                        echo "<tr>
                            <td>$no</td>
                            <td>".date('d-m-Y H:i:s', strtotime($row->tgl_input))."</td>
                            <td>$row->no_spk</td>
                            <td>$row->kota</td>
                            <td>$row->nama_user</td>
                            <td>$row->kategori_spk</td>
                            <td>$row->status_spk</td>
                            <td>$row->detail_spk</td>
                            <td>";
                        $hrd = $row->hrd_app;
                        if($hrd == '0'){  
                          echo "<a class='btn btn-xs btn-success' href='".base_url()."user/spk/mengetahui_spk/$row->id_spk'><i class='fa fa-check'></i> mengetahui</a>";
                          echo "<a href='".base_url('user/spk/detail/')."$row->id_spk' class='btn btn-xs btn-info'><i class='fa fa-list'></i> Status</a>";
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