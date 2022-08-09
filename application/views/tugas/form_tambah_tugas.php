<link href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" rel="stylesheet">
<script src="<?= base_url();?>assets/tinymce/tinymce.min.js"></script>
<script>tinymce.init({ 
  selector:'textarea',
  plugins : 'advlist lists' 
});</script>
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
            <h2>Form Create Tugas Harian <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="<?= base_url('tugas/harian') ?>" class="btn btn-sm btn-success"><i class="fa fa-reply"></i> Back</a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>tugas/harian/simpan_tugas">
            <!--
              <form method="post" data-parsley-validate class="form-tugas form-horizontal form-label-left">
            -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Pekerjaan / Tugas</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" required="required" name="tugas_kerja" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Uraian Kerja</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea name="detail"  style="resize:none; width:100%; height:150px;" class="form-control col-md-12 col-xs-12"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Target Penyelesaian</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="tgl_target" data-inputmask="'mask': '99-99-9999'" id="datepicker-example1" placeholder="pilih tanggal" class="form-control col-md-7 col-xs-12 tanggal" required="true">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Progress</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea name="progres"  style="resize:none; width:100%; height:100px;" class="form-control col-md-12 col-xs-12"></textarea>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" id="btnSave" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Simpan</button>
                  <!--
                    <button type="button" onclick="save()" class="btn btn-success">Submit</button>
                  -->
                  <button class="btn btn-sm btn-warning" type="reset">Reset</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Tugas Harian <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <button class="btn btn-sm btn-primary"><?= date('d M Y'); ?></button>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="table-responsive">
          <div id="tugas_harian"></div>
          </div>
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

 function loadDataTugas(){
    //alert("tes");
    $.ajax({
      type :'GET',
      url  :'<?= base_url('tugas/harian/dataTugasHarian') ?>',
      data :'',
      success:function(html){
        $("#tugas_harian").html(html);
      }
    })
  }

  function save() 
  {
      var data = $('.form-tugas').serialize();
      $.ajax({
        type: 'POST',
        url  :'<?= base_url('tugas/harian/simpan_tugas') ?>',
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
                loadDataTugas();
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