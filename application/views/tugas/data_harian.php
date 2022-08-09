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
        <h3>Data Tugas Harian</h3>
      </div>
    </div>
 
    <div class="clearfix"></div>

    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Jobdesk <small></small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <ul>
              <?php
                foreach ($record as $r)
                {
                  echo "<li>$r->detail</li>";
                }
              ?>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Tugas Harian <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="<?= base_url('tugas/harian/create') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Buat Tugas Harian</a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <table class="table table-bordered table-striped" id="lookup">
                <thead>
                  <tr>
                    <th width="30px">No</th>
                    <th width="60px">Tanggal</th>
                    <th>Tugas Kerja</th>
                    <th width="50px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $id = $this->session->userdata('id_karyawan');
                    //$tgl = date('d-m-Y');
                    $sql = "SELECT * FROM abe_tugas_harian WHERE id_karyawan = $id GROUP BY tgl_input  ORDER BY tgl_input DESC";
                    $tugas = $this->db->query($sql)->result();
                    $no = 1;
                    foreach ($tugas as $row) {
                      echo "<tr>
                            <td>$no</td>
                            <td>".date('d-m-Y', strtotime($row->tgl_input))."</td>
                            <td>";
                            $tgl = $row->tgl_input;
                            //$tgl = date('d-m-Y', strtotime($row->tgl_input));
                            $sql2 = "SELECT * FROM abe_tugas_harian WHERE id_karyawan = $id AND tgl_input = '$tgl'";
                            $tugas2 = $this->db->query($sql2)->result();
                            foreach ($tugas2 as $row2) {
                              echo "- <b>$row2->tugas_kerja</b><br>";
                            }
                      echo "</td><td>";
                            $tgl2 = date('d-m-Y');
                            $tgl_input = date('d-m-Y', strtotime($row->tgl_input));
                            if($tgl_input == $tgl2){
                      echo "<a class='btn btn-xs btn-warning' href='".base_url()."tugas/harian/edit/$row->tgl_input'><i class='fa fa-edit'></i> Edit</a>
                          </td></tr>";
                            }else{
                      echo "<a class='btn btn-xs btn-info' href='".base_url()."tugas/harian/detail/$row->tgl_input'><i class='fa fa-eye'></i> Detail</a></td></tr>";
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
