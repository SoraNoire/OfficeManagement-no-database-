
<link href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" rel="stylesheet">
<script src="<?= base_url();?>assets/tinymce/tinymce.min.js"></script>
<script>tinymce.init({ 
  selector:'textarea',
  plugins : 'advlist lists' 
});</script>

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
              <a href="<?= base_url('tugas/harian') ?>" class="btn btn-sm btn-success"><i class="fa fa-reply"></i> Back</a>
              <button class="btn btn-sm btn-primary"><?= date('d M Y'); ?></button>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="table-responsive">
            <table class='table table-striped jambo_table bulk_action'>
              <thead>
                <tr>
                  <th width="30px">No</th>
                  <th width="120px">Pekerjaan</th>
                  <th>Uraian Kerja</th>
                  <th width="90px">Target</th>
                  <th>Progress</th>
                  <th width='80px'>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $id = $this->session->userdata('id_karyawan');
                  $tgl = date('Y-m-d');
                  $sql = "SELECT * FROM abe_tugas_harian WHERE id_karyawan = $id AND tgl_input = '$tgl'";
                  $kota = $this->db->query($sql)->result();
                  $no = 1;
                  foreach ($kota as $row) {
                    echo "<tr>
                            <td>$no</td>
                            <td>$row->tugas_kerja</td>
                            <td>$row->detail</td>
                            <td>".date('d-m-Y', strtotime($row->tgl_target))."</td>
                            <td>$row->progres</td>
                          <td>
                            <button onclick='delete_tugas($row->id_tugas)' class='btn btn-xs btn-danger' title='hapus'><i class='fa fa-trash'></i></button>
                            <button onclick='edit_tugas($row->id_tugas)' class='btn btn-xs btn-warning' title='edit'><i class='fa fa-edit'></i></button>
                          </td></tr>";
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
            <h2>Form Edit Tugas Harian <small></small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
          <div id="form_edit"></div>
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
//            jika dipilih, kode obat akan masuk ke input dan modal di tutup
    $(document).on('click', '.pilih1', function (e) {
        document.getElementById("id_karyawan").value = $(this).attr('data-karyawan');
        document.getElementById("nama_karyawan").value = $(this).attr('data-karyawan2');
        $('#myKaryawan').modal('hide');
    });

    $(function () {
        $("#lookup").dataTable();
        $("#lookup2").dataTable(); 
        $("#lookup3").dataTable();
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
      loadDataTugas();
    });
</script>

<script type="text/javascript">
  var save_method; //for save method string
  var table;
  var base_url = '<?php echo base_url();?>';
  
  $(document).ready(function() {
        //set input/textarea/select event when change value, remove class error and remove text help block 
      $("input").change(function(){
          $(this).parent().parent().removeClass('has-error');
          $(this).next().empty();
      });
      $("textarea").change(function(){
          $(this).parent().parent().removeClass('has-error');
          $(this).next().empty();
      });
      $("select").change(function(){
          $(this).parent().parent().removeClass('has-error');
          $(this).next().empty();
      });
  });

  function edit_tugas($k){
    var id_tugas = $k;
    $.ajax({
      type :'GET',
      url  :'<?= base_url('tugas/harian/form_edit_tugas') ?>',
      data :'id_tugas='+id_tugas,
      success:function(html){
        $("#form_edit").html(html);
      }
    })
  }

  function update() 
  {
      var data = $('.form-tugas').serialize();
      $.ajax({
        type: 'POST',
        url  :'<?= base_url('tugas/harian/update_tugas') ?>',
        data: data,
        success: function(data)
          {
            location.reload();
            sukses_tambah_tugas();
          }
      });
  }

  function delete_tugas(id)
  {
      if(confirm('Anda yakin ingin menghapus data ini?'))
      {
          // ajax delete data to database
          $.ajax({
              url : "<?php echo site_url('tugas/harian/ajax_delete')?>/"+id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                location.reload();
                sukses_hapus_tugas();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error deleting data');
              }
          });
      }
  }

  function sukses_tambah_tugas()
  {
     $(document).ready(function (){
        $.notify("Data Tugas telah dibuat","success");
          });
  }

  function sukses_hapus_tugas()
  {
     $(document).ready(function (){
        $.notify("Data Tugas telah dihapus","warning");
          });
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