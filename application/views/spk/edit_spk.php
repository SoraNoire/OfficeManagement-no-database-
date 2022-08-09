<link href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" rel="stylesheet">

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Form Edit SPK</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="form-horizontal">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><small></small></h2>
            <button  type="button" class="btn btn-sm btn-success"><i class="fa fa-flag"></i> <?= $record['status_spk'] ?></button>
            <ul class="nav navbar-right panel_toolbox">
              <a href="javascript:history.back()" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> Back</a>
              <button  type="button" class="btn btn-sm btn-primary"><i class="fa fa-calendar"></i> <?= date('d M Y'); ?></button>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-body">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-12">Nomor SPK</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="no_rapat" value="<?= $record['no_spk'] ?>" class="form-control" readonly="true" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-12">Divisi</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="jam_rapat" value="<?= $record['divisi'] ?>" required="true" class="form-control" readonly="true"> 
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-12">Nama Karyawan</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="jam_rapat" value="<?= $record['nama_karyawan'] ?>" required="true" class="form-control" readonly="true"> 
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-12">Dibuat Oleh</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="rapat_input" value="<?= $record['nama_user'] ?>" class="form-control" readonly="true" >
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-6">Tanggal Input</label>
                  <div class="col-md-4 col-sm-6">
                    <input name="tgl_rapat" type="text" value="<?= date('d-m-Y H:i:s', strtotime($record['tgl_input']))?>" class="form-control" readonly="true">
                  </div>
                  <label class="control-label col-md-1 col-sm-6">Deadline</label>
                  <div class="col-md-3 col-sm-6">
                    <?php
                      $dateline = $record['tgl_target'];
                      if($dateline == '1970-01-01'){
                        echo "<input type='text' value='tidak ada' class='form-control' readonly='true'>";
                      }else{
                        echo "<input type='text' value='".date('d-m-Y', strtotime($record['tgl_target']))."' class='form-control' readonly='true'>";
                      }
                    ?>
                  </div>
                </div>           
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Detail Permasalahan</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-sm-12" >
              <a href="javascript:history.back()" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Update</a>
              <a href="#" class="btn btn-sm btn-info" onclick="add_detail()"><i class="glyphicon glyphicon-plus"></i> Detail SPK</a>
              <div class="x_content">
                <div class="table-responsive">
                <div id="table_detail"></div>
                </div>
              </div>
            </div>
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
  var save_method; //for save method string
  var table;
  var base_url = '<?= base_url();?>';
  var id_spk  = '<?= $record['id_spk'];?>';
  var id_user = '<?= $this->session->userdata('id_karyawan') ?>';
  loadDataDetail(id_spk, id_user);
  
  function add_detail()
  {
      save_method = 'add_detail';
      $('#form2')[0].reset(); // reset form on modals
      //$('[name="nama"]').val();
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#lampiran_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Detail'); // Set Title to Bootstrap modal title
      //$('#btnSave2').text('Save');
  }

  function edit_detail(id)
  {
      save_method = 'update';
      $('#form2')[0].reset(); // reset form on modals
      //$('#btnSave').text('Update'); //change button text
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
   
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('user/spk/edit_detail')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
              $('[name="id"]').val(data.id_spk_detail);
              $('[name="detail"]').val(data.detail);
              $('#lampiran_form').modal('show'); // show bootstrap modal when complete loaded
              $('.modal-title').text('Edit Detail'); // Set title to Bootstrap modal title
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }

  function save()
  {
      var url;
      if(save_method == 'add_detail') {
          url = "<?php echo site_url('user/spk/add_detail/')?>";
      } else {
          url = "<?php echo site_url('user/spk/update_detail')?>";
      }      
      var formData = new FormData($('#form2')[0]);
      // ajax adding data to database
      $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
         
          success: function(data)
          {
            if(data.status) //if success close modal and reload ajax table
            {
              $('#lampiran_form').modal('hide');
              loadDataDetail(id_spk, id_user);
              sukses_tambah_detail();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                }
            }
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error adding / update data');
          }
      });
  }

 function loadDataDetail($no, $id){
    var id_karyawan = $id;
    var id_spk      = $no;
    $.ajax({
      type :'GET',
      url  :'<?= base_url('user/spk/dataDetail') ?>',
      data :'id_karyawan='+id_karyawan+'&id_spk='+id_spk,
      success:function(html){
        $("#table_detail").html(html);
      }
    })
  }

  function delete_detail(id)
  {
      if(confirm('Anda yakin ingin menghapus Detail ini?'))
      {
          // ajax delete data to database
          $.ajax({
              url : "<?php echo site_url('user/spk/hapus_detail')?>/"+id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                  loadDataDetail(id_spk, id_user);
                  sukses_hapus_detail();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error deleting data');
              }
          });
      }
  }

  function sukses_tambah_detail()
  {
     $(document).ready(function (){
        $.notify("Data Detail telah ditambahkan","success");
          });
  }

  function sukses_hapus_detail()
  {
     $(document).ready(function (){
        $.notify("Data Detail telah dihapus","warning");
          });
  }

</script>

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
<div class="modal fade" id="lampiran_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Detail Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form2"  class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                      <input type="hidden" name="id_spk" value="<?= $record['id_spk'] ?>">
                      <input type="hidden" name="status" value="NEW">
                      <input type="hidden" name="id_input" value="<?= $this->session->userdata('id_karyawan') ?>" class="form-control" readonly="true" >
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-12">Detail SPK</label>
                        <div class="col-md-9 col-sm-12">
                          <textarea class="form-control" placeholder="detail SPK" name="detail"></textarea>
                        </div>
                      </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave2" onclick="save()" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> save</button>
                <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal"><i class="fa fa-close"></i> cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->