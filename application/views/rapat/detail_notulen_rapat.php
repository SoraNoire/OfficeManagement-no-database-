<!-- Datatables -->
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<link href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" rel="stylesheet">

<script src="<?= base_url();?>assets/tinymce/tinymce.min.js"></script>
<script>tinymce.init({ 
  selector:'textarea',
  plugins : 'advlist lists' 
});</script>

  <script>
      function validasiFile(){
        var inputFile = document.getElementById('file');
        var pathFile = inputFile.value;
        var file_size = $('#file')[0].files[0].size;
        var ekstensiOk = /(\.pdf)$/i;
        if(!ekstensiOk.exec(pathFile)){
            alert('Mohon maaf, file yang diperbolehkan untuk upload berformat .PDF');
            inputFile.value = '';
            return false;
        }else if(file_size > 4000000){
            alert('Mohon maaf, file yang diperbolehkan untuk upload maksimal 4 Mb');
            inputFile.value = '';
            return false;
        }
      }
  </script>


<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Form Notulen Rapat</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="form-horizontal">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="<?= base_url('user/rapat') ?>" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> Back</a>
              <button  type="button" class="btn btn-sm btn-primary"><?= date('d M Y'); ?></button>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-6 col-sm-12 col-xs-12">
              <div class="form-body">
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Nomor Rapat</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="no_rapat" value="<?= $record['no_rapat'] ?>" class="form-control" readonly="true" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Dibuat Oleh</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="rapat_input" value="<?= $record['rapat_input'] ?>" class="form-control" readonly="true" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Lokasi Rapat</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="jam_rapat" value="<?= $record['lokasi'] ?>" required="true" class="form-control" readonly="true"> 
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Tanggal Rapat</label>
                  <div class="col-md-8 col-sm-12">
                    <input name="tgl_rapat" type="text" value="<?= date('d-m-Y', strtotime($record['tgl_rapat']))?>" class="form-control" readonly="true">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Waktu Rapat</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="jam_rapat" value="<?= $record['jam_rapat'] ?>" required="true" class="form-control" readonly="true">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Pembahasan</label>
                  <div class="col-md-8 col-sm-12">
                    <div class="alert alert-info alert-dismissible" role="alert">
                      <?= $record['pembahasan'] ?>
                    </div>
                  </div>
                </div>
                <!--
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Keterangan</label>
                  <div class="col-md-8 col-sm-12">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                     
                    </div>
                  </div>
                </div>
                -->
              </div>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12">
              <div class="form-group" style="text-align: left">
                <a href="<?= base_url() ?>user/rapat/cetak_notulen/<?= $this->uri->segment(4); ?>" target="blank" class="btn btn-sm btn-success"><i class="fa fa-print"></i> Print Notulen</a>
                <a href="<?= base_url() ?>user/rapat/cetak_notulen_pdf/<?= $this->uri->segment(4); ?>" target="blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> PDF Notulen</a>
              </div>
              <div id="table_peserta">
                <table class='table table-bordered table-striped' >
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Peserta Rapat</th>
                    </tr>
                  </thead>
                  <?php
                    $no_rapat = $record['no_rapat'];
                    $sql = "SELECT * FROM abe_rapat_peserta WHERE id_rapat = '$no_rapat'";
                    $peserta = $this->db->query($sql)->result();
                    if(empty($peserta)){
                        echo "<tr><td colspan='2'>Tidak ada Peserta</td></tr>";
                    }else{
                        $no = 1;
                        foreach ($peserta as $row) {
                            echo "<tr><td>$no</td><td>$row->nama_peserta</td></tr>";
                            $no++;
                        }
                    }
                  ?>
                </table>
              </div>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12">
              <?php
                if($record['status'] == 'DRAFT'){
              ?>
                <div class="form-group" style="text-align: left">
                  <button class="btn btn-sm btn-success" onclick="add_lampiran()"><i class="glyphicon glyphicon-plus"></i> Lampiran</button>
                  <?php
                    echo anchor('user/rapat/selesai/'.$record['id_rapat'],'<i class="fa fa-flag"></i> Notulen Selesai', array('class'=>'btn btn-success btn-sm', 'title'=>'done', 'onclick'=>'javasciprt: return confirm(\'Anda yakin ingin menyelesaikan Notulen Rapat '.$record['no_rapat'].' !! \')'));
                  ?>
                </div>
              <?php
                }
              ?>
              <div id="table_lampiran"></div>
              <p><i><strong>note : </strong><br>file yang di perbolehkan upload ( jpg / png / jpeg / pdf )<br>Size maks 4 Mb</i></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Hasil & Pembahasan</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-sm-12" >
              <div class="alert alert-info alert-dismissible" role="alert">
                <?= $record['hasil_rapat'] ?>
              </div>
            </div>
          </div>
          <div class="x_title">
            <h2>Keterangan Hasil Rapat</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-sm-12" >
              <div class="alert alert-warning alert-dismissible" role="alert">
                <?= $record['keterangan'] ?>
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
<!--
<script src="<?= base_url(); ?>assets/gentelella/js/jquery-2.1.4.min.js"></script>-->

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
<!--
<script src="<?= base_url() ?>assets/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?= base_url() ?>assets/gentelella/vendors/jszip/dist/jszip.min.js"></script>
-->

<script type="text/javascript">
  var save_method; //for save method string
  var table;
  var base_url = '<?php echo base_url();?>';
  var nomor_rapat = '<?= $record['no_rapat'] ?>';
  //loadDataPeserta();
  //loadDataMengetahui();
  loadDataLampiran(nomor_rapat);
  
  function add_lampiran()
  {
      save_method = 'add_lampiran';
      $('#form2')[0].reset(); // reset form on modals
      //$('[name="nama"]').val();
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#lampiran_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Lampiran'); // Set Title to Bootstrap modal title
      $('#btnSave2').text('Save');
  }

  function save()
  {
      $('#btnSave').text('saving...'); //change button text
      $('#btnSave').attr('disabled',true); //set button disable 
      var url;
      url = "<?php echo site_url('user/rapat/add_lampiran')?>";
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
              loadDataLampiran(nomor_rapat);
              sukses_tambah_lampiran();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error adding / update data');
              $('#btnSave').text('save'); //change button text
              $('#btnSave').attr('disabled',false); //set button enable 
          }
      });
  }

 function loadDataLampiran($no){
    var no_rapat = $no;
    $.ajax({
      type :'GET',
      url  :'<?= base_url('user/rapat/dataLampiran') ?>',
      data :'no_rapat='+no_rapat,
      success:function(html){
        $("#table_lampiran").html(html);
      }
    })
  }

  function delete_lampiran(id)
  {
      if(confirm('Anda yakin ingin menghapus Lampiran ini?'))
      {
          // ajax delete data to database
          $.ajax({
              url : "<?php echo site_url('user/rapat/hapus_lampiran')?>/"+id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                  loadDataLampiran(nomor_rapat);
                  sukses_hapus_lampiran();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error deleting data');
              }
          });
      }
  }

  function sukses_tambah_lampiran()
  {
     $(document).ready(function (){
        $.notify("Data Lampiran telah ditambahkan","success");
          });
  }

  function sukses_hapus_lampiran()
  {
     $(document).ready(function (){
        $.notify("Data Lampiran telah dihapus","warning");
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
<div class="modal fade" id="lampiran_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Lampiran Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form2"  class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-12">Nomor Rapat</label>
                        <div class="col-md-9 col-sm-12">
                          <input type="text" name="no_rapat" value="<?= $record['no_rapat'] ?>" class="form-control" readonly="true" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-12">Nama Lampiran</label>
                        <div class="col-md-9 col-sm-12">
                          <input type="text" name="nama_lampiran" placeholder="nama lampiran / keterangan" class="form-control" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-12">Pilih File</label>
                        <div class="col-md-9 col-sm-12">
                          <input type="file" id="file" name="file_lampiran" onchange="return validasiFile()" class="form-control" >
                        </div>
                      </div>
                      <p><i><strong>note : </strong><br>file yang di perbolehkan upload berformat .PDF<br>Size maks 4 Mb</i></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave2" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->