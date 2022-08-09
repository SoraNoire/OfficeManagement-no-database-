<link href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" rel="stylesheet">
<script  type="text/javascript"  src="<?= base_url() ?>assets/tinymce/tinymce.min.js"></script>
<script  type="text/javascript">
            tinymce.init({
            selector: "textarea12"
            });
</script>
<script type="text/javascript" src="<?= base_url() ?>assets/ckeditor/ckeditor.js"></script>
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
            <h2>Data Tugas Harian <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <button type="button" class="btn btn-sm btn-success" onclick="javascript:history.back()"><i class="fa fa-reply"></i> Back</button>
              <?php
                $tgl = $this->uri->segment('4');
                $tgl2 = date('d-m-Y', strtotime($tgl));
                $karyawan = $this->uri->segment('5');
                $sql = "SELECT nama_lengkap, id_karyawan FROM abe_karyawan WHERE id_karyawan = $karyawan";
                $user = $this->db->query($sql)->row_array();
              ?>
              <button class="btn btn-sm btn-primary"><?= $tgl2; ?></button>
              <button class="btn btn-sm btn-info"><?= $user['nama_lengkap']; ?></button>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="table-responsive">
            <table class='table table-striped jambo_table bulk_action'>
              <thead>
                <tr>
                  <th width="30px">No</th>
                  <th width="110px">Pekerjaan</th>
                  <th>Uraian Kerja</th>
                  <th width="90px">Target</th>
                  <th>Progress</th>
                  <th width="30px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  //$id = $this->session->userdata('id_karyawan');          
                  $sql = "SELECT * FROM abe_tugas_harian WHERE id_karyawan = $karyawan AND tgl_input = '$tgl'";
                  $kota = $this->db->query($sql)->result();
                  $no = 1;
                  /**
                  foreach ($kota as $row) {
                    echo "<tr>
                            <td>$no</td>
                            <td>$row->tugas_kerja</td>
                            <td><textarea disabled='true' style='resize:none; width:100%;' readonly='true'>$row->detail</textarea>
                            </td>
                            <td>".date('d-m-Y', strtotime($row->tgl_target))."</td>
                            <td><textarea disabled='true' style='resize:none; width:100%;' readonly='true'>$row->progres</textarea></td>
                            <td>
                              <button onclick='view_tugas($row->id_tugas)' class='btn btn-xs btn-info' title='view detail'><i class='fa fa-eye'></i></button>
                            </td>
                          </tr>";
                    $no++;
                  }
                  **/
                  foreach ($kota as $row) {
                    echo "<tr>
                            <td>$no</td>
                            <td>$row->tugas_kerja</td>
                            <td><p>$row->detail</p>
                            </td>
                            <td>".date('d-m-Y', strtotime($row->tgl_target))."</td>
                            <td>$row->progres</td>
                            <td>
                              <button onclick='view_tugas($row->id_tugas)' class='btn btn-xs btn-info' title='view detail'><i class='fa fa-eye'></i></button>
                            </td>
                          </tr>";
                    $no++;
                  }
                ?>
              </tbody>
            </table>
          </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Form Detail Tugas Harian <small></small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
          <div id="form_view"></div>
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

<script type="text/javascript">
  function view_tugas($k){
    var id_tugas = $k;
    $.ajax({
      type :'GET',
      url  :'<?= base_url('tugas/harian/form_view_tugas') ?>',
      data :'id_tugas='+id_tugas,
      success:function(html){
        $("#form_view").html(html);
      }
    })
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