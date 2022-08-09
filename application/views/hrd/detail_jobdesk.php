<link href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" rel="stylesheet">

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Data Jobdesk</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Form Create Jobdesk <small></small></h2>
              <?php
                $karyawan = $this->uri->segment('4');
                $sql = "SELECT nama_lengkap, id_karyawan FROM abe_karyawan WHERE id_karyawan = $karyawan";
                $user = $this->db->query($sql)->row_array();
              ?>
            <ul class="nav navbar-right panel_toolbox">
              <a href="<?= base_url('hrd/jobdesk') ?>" class="btn btn-sm btn-success"><i class="fa fa-reply"></i> Back</a>
              <button class="btn btn-sm btn-info"><?= $user['nama_lengkap']; ?></button>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form method="post" data-parsley-validate class="form-tugas form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Jobdesk Karyawan</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="hidden" name="karyawan" id="karyawan" value="<?= $this->uri->segment(4) ?>">
                  <input type="hidden" name="id" id="id" value="">
                  <textarea class="form-control col-md-7 col-xs-12" name="jobdesk" required="required" placeholder="jobdesk karyawan" ></textarea>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="button" onclick="save_jobdesk()" id="btnSave" class="btn btn-success">Simpan</button>
                  <button class="btn btn-warning" type="reset">Reset</button>
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
<!-- validator -->
<script src="<?= base_url() ?>assets/gentelella/vendors/validator/validator.js"></script>
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
    var karyawan =$("#karyawan").val();
    $.ajax({
      type :'GET',
      url  :'<?= base_url('hrd/jobdesk/dataJobdesk') ?>',
      data :'karyawan='+karyawan,
      success:function(html){
        $("#tugas_harian").html(html);
      }
    })
  }

  function save_jobdesk() 
  {
      var data = $('.form-tugas').serialize();
      $.ajax({
        type: 'POST',
        url  :'<?= base_url('hrd/jobdesk/simpan_jobdesk') ?>',
        data: data,
        success: function(data)
          {
            location.reload();
          }
      });
  }

  function edit_jobdesk(id)
  {
      $.ajax({
          url : "<?php echo site_url('hrd/jobdesk/ajax_edit')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
              $('[name="id"]').val(data.id_jobdesk);
              $('[name="jobdesk"]').val(data.detail);
              $('#btnSave').text('Update');
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
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