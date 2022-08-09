<!-- Datatables
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css">
 -->
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css">
<!-- Custom Theme Style -->
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css">

<script src="<?= base_url();?>assets/tinymce/tinymce.min.js"></script>
<script>tinymce.init({ 
  selector:'textarea2',
  plugins : 'advlist lists table'
});</script>
 
  <script>
      function validasiFile(){
        var inputFile = document.getElementById('file');
        var pathFile = inputFile.value;
        var file_size = $('#file')[0].files[0].size;
        var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif|\.pdf)$/i;
        if(!ekstensiOk.exec(pathFile)){
            alert('Mohon maaf, file yang diperbolehkan untuk upload ( .jpg / .png / .jpeg / .pdf )');
            inputFile.value = '';
            return false;
        }else if(file_size > 4000000){
            alert('Mohon maaf, file yang diperbolehkan untuk upload maksimal 4 Mb');
            inputFile.value = '';
            return false;
        }
      }

      function tampilkanPreview(gambar,idpreview){
//                membuat objek gambar
          var gb = gambar.files; 
//                loop untuk merender gambar
          for (var i = 0; i < gb.length; i++){
//                    bikin variabel
              var gbPreview = gb[i];
              var imageType = /image.*/;
              var preview=document.getElementById(idpreview);            
              var reader = new FileReader();
              if (gbPreview.type.match(imageType)) {
//                        jika tipe data sesuai
                  preview.file = gbPreview;
                  reader.onload = (function(element) { 
                      return function(e) { 
                          element.src = e.target.result; 
                      }; 
                  })(preview);
//                    membaca data URL gambar
                  reader.readAsDataURL(gbPreview);
              }else{
//                        jika tipe data tidak sesuai
                  alert("Type file tidak sesuai. Khusus image.");
              }
          }    
      }
  </script>

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Surat Perintah Kerja - <?= $this->session->userdata('divisi') ?></h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="form-horizontal">
        <?php if($this->session->flashdata('sukses')){ ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p><center><?php echo $this->session->flashdata('sukses'); ?></center></p>
          </div>
        <?php }elseif($this->session->flashdata('gagal')){ ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><center>
                  <p>GAGAL<br><?php echo $this->session->flashdata('gagal'); ?><br>Terimakasih</p></center>
            </div>
        <?php } ?>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="javascript:history.back()" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> Back</a>
              <button  type="button" class="btn btn-sm btn-primary"><?= date('d M Y'); ?></button>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/spk/proses">
            <div class="col-md-8 col-sm-12 col-xs-12">
              <div class="form-body">
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Nomor SPK</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="no_spk" value="<?php echo $no_spk; ?>" class="form-control" readonly="true" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Divisi</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="divisi" value="<?= $this->session->userdata('divisi') ?>" class="form-control" readonly="true" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Nama Karyawan</label>
                  <div class="col-md-8 col-sm-12">
                    <?php
                      $id_karyawan = $this->session->userdata('karyawan');
                      $sql = "SELECT nama_lengkap, id_karyawan FROM abe_karyawan WHERE id_karyawan = '$id_karyawan' ";
                      $karyawan = $this->db->query($sql)->row_array();
                    ?>
                    <input type="text" name="nama_user" value="<?= $karyawan['nama_lengkap'] ?>" class="form-control" readonly="true" >
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Tanggal</label>
                  <div class="col-md-8 col-sm-12">
                    <?php
                      $date = date("Y-m-d")
                    ?>
                    <input type="text" name="rapat_input" value="<?= TanggalIndo($date); ?> / <?= date("H:i:s") ?>" class="form-control" readonly="true" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">No Notulen Rapat</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="notulen" placeholder="kosongkan jika tidak berhubungan dengan notulen rapat" class="form-control" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Deadline</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="deadline" id="datepicker-example1" data-inputmask="'mask': '99-99-9999'" placeholder="kosongkan jika tidak ada deadline" class="form-control tanggal">
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
              <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Proses</button>
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
    </form>
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
  //loadDataPeserta();
  //loadDataMengetahui();
  var id_spk  = '0';
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
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            //$('#btnSave').text('save'); //change button text
            //$('#btnSave').attr('disabled',false); //set button enable 
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error adding / update data');
              //$('#btnSave').text('save'); //change button text
              //$('#btnSave').attr('disabled',false); //set button enable 
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
                      <input type="hidden" name="id_spk" value="0">
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