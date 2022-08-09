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
 
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Permintaan Pembelian <small></small></h2>
            
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
                    <th width="30px">No</th>
                    <th width="60px">Tanggal</th>
                    <th>Nomor Permintaan</th>
                    <th>Perusahaan</th>
                    <th>Status PR</th>
                    <th>Status Approve</th>
                    <th width="20%">Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $id = $this->session->userdata('id_karyawan');
                    //$tgl = date('d-m-Y');
                    $sql = "SELECT * FROM abe_permintaan WHERE pr_input = $id ORDER BY tgl_pr DESC";
                    $tugas = $this->db->query($sql)->result();
                    $no = 1;
                    foreach ($tugas as $row) {
                      echo "<tr>
                            <td>$no</td>
                            <td>".date('d-m-Y', strtotime($row->tgl_pr))."</td>
                            <td>$row->no_pr</td>
                            <td>$row->nama_pt</td>
                            <td>$row->status</td>
                            <td>$row->status_pr</td><td>";
                            
                            $status = $row->status_pr;
                            if($status == 'baru'){
                      echo "<a class='btn btn-xs btn-warning' href='".base_url()."permintaan/pr/edit/$row->id_permintaan'><i class='fa fa-edit'></i> Edit</a><a class='btn btn-xs btn-danger' href='".base_url()."permintaan/pr/hapus/$row->id_permintaan'><i class='fa fa-trash'></i> Hapus</a> <a class='btn btn-xs btn-info' href='".base_url()."permintaan/pr/detail/$row->id_permintaan'><i class='fa fa-eye'></i> Detail</a>
                          </td></tr>";
                            }else{
                      echo "<a class='btn btn-xs btn-info' href='".base_url()."permintaan/pr/detail/$row->id_permintaan'><i class='fa fa-eye'></i> Detail</a></td></tr>";
                            }
                          $no++;
                    }
                  ?>
                </tbody>
              </table>
              <p><i><strong>Note Status:</strong><br>
                - <strong>baru</strong> : Permintaan baru di buat oleh user<br>
                - <strong>diketahui</strong> : Permintaan sudah di Approve oleh atasan user<br>
                - <strong>disetujui</strong> : Permintaan sudah di setujui oleh Direktur<br>
                - <strong>ditolak</strong> : Permintaan sudah di tolak oleh Direktur<br>
                - <strong>selesai</strong> : Permintaan sudah selesai di proses
              </i></p>
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
