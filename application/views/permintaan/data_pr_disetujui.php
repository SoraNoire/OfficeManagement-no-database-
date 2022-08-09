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
            <ul class="nav navbar-right panel_toolbox">
              <a target="blank" class="btn btn-sm btn-success" href="<?= base_url() ?>permintaan/pr/cetak_pr_pending"><i class='fa fa-print'></i> Print PR Outstanding</a>
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
                    <th width="30px">No</th>
                    <th width="60px">Tanggal</th>
                    <th>Nomor Permintaan</th>
                    <th>Perusahaan</th>
                    <th>Dibuat</th>
                    <th>Diajukan</th>
                    <th>Status</th>
                    <th width="140px">Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $id = $this->session->userdata('id_karyawan');
                    //$tgl = date('d-m-Y');
                    $lokasi = $this->session->userdata('posisi');
                    if($lokasi == 'JAKARTA'){
                      $pt = '';
                    }
                    $sql = "SELECT ap.*, ak.id_karyawan, ak.nama_lengkap
                            FROM abe_permintaan as ap, abe_karyawan as ak
                            WHERE ap.id_pt = '$pt' AND ap.pr_input = ak.id_karyawan ORDER BY ap.tgl_pr DESC";
                    //$sql = "SELECT ap.*, ak.id_karyawan, ak.nama_lengkap
                    //        FROM abe_permintaan as ap, abe_karyawan as ak
                    //        WHERE ap.id_pt = '$pt' AND ap.pr_input = ak.id_karyawan AND ap.status_proses != '' ORDER BY ap.status_pr ASC";
                    $tugas = $this->db->query($sql)->result();
                    $no = 1;
                    foreach ($tugas as $row) {
                      echo "<tr>
                            <td>$no</td>
                            <td>".date('d-m-Y', strtotime($row->tgl_pr))."</td>
                            <td>$row->no_pr</td>
                            <td>$row->nama_pt</td>
                            <td>$row->nama_lengkap</td>
                            <td>$row->pr_diajukan</td>
                            <td>$row->status</td>";
                            
                            $status = $row->status;
                            //$user1 = $this->session->userdata('id_karyawan');
                            //$user2 = $row->pr_input ;
                            if($status == 'closed'){
                      
                      echo  "<td>
                              <a class='btn btn-xs btn-success'><i class='fa fa-flag'></i> Selesai</a>
                              <a class='btn btn-xs btn-info' href='".base_url()."permintaan/pr/detail/$row->id_permintaan'><i class='fa fa-eye'></i> Detail</a>
                            </td></tr>";
                      
                            }else if ($status == 'on proces'){
                      echo "<td>".anchor('permintaan/pr/proses_selesai/'.$row->id_permintaan,'<i class="fa fa-check"></i> Closed', array('class'=>'btn btn-warning btn-xs', 'title'=>'closed', 'onclick'=>'javasciprt: return confirm(\'Anda yakin ingin Menyelesaikan data '.$row->no_pr.' !! \')'))."<a class='btn btn-xs btn-info' href='".base_url()."permintaan/pr/detail/$row->id_permintaan'><i class='fa fa-eye'></i> Detail</a></td></tr>";
                            }else{
                      echo "<td><a class='btn btn-xs btn-info' href='".base_url()."permintaan/pr/detail/$row->id_permintaan'><i class='fa fa-eye'></i> Detail</a></td></tr>";     
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
