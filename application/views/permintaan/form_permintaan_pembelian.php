<link href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" rel="stylesheet">
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
        <h3>Form Permintaan Pembelian Barang / Jasa</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>permintaan/pr/create">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="<?= base_url('permintaan/pr') ?>" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> Back</a>
              <button  type="button" class="btn btn-sm btn-primary"><i class='fa fa-calendar'></i> <?= date('d M Y'); ?></button>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-8 col-sm-12 col-xs-12">
              <div class="form-body">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor Permintaan</label>
                  <div class="col-md-9 col-sm-6 col-xs-12">
                    <input type="text" name="no_pr" value="<?= $no_pr; ?>" class="form-control col-md-7 col-xs-12" readonly="true" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Perusahaan</label>
                  <div class="col-md-9 col-sm-6 col-xs-12">
                    <?php
                        echo cmb_dinamis('nama_pt','abe_pt','nama_pt','singkat');
                      ?>  
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Dibuat Oleh</label>
                  <div class="col-md-9 col-sm-6 col-xs-12">
                    <input type="text" name="pr_input" value="<?= $this->session->userdata('nama_lengkap') ?>" class="form-control col-md-7 col-xs-12" readonly="true" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Diajukan Oleh</label>
                  <div class="col-md-9 col-sm-6 col-xs-12">
                    <input type="text" name="pr_diajukan" placeholder="kosongkan saja jika yang mengajukan diri sendiri" class="form-control col-md-7 col-xs-12" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Lampirkan File</label>
                  <div class="col-md-9 col-sm-6 col-xs-12">
                    <input type="file" id="file" name="file" onchange="return validasiFile()" class="form-control col-md-7 col-xs-12" >
                    <p><i><strong>note : </strong><br>file yang di perbolehkan untuk di upload ( jpg / png / jpeg / pdf )<br>Size maks 4 Mb</i></p>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <button type="button" class="btn btn-xs btn-success" onclick="add_permintaan_detail()"><i class="glyphicon glyphicon-plus"></i> Barang / Jasa</button>
          <?php
            $no_pr = $this->M_permintaan->get_kode_pr();
            $cek_item = $this->db->query("SELECT no_pr FROM abe_permintaan_detail WHERE no_pr = '$no_pr'")->num_rows();
            if($cek_item == '0'){
              echo "<button type='submit' name='submit' disabled='true' class='btn btn-xs btn-primary'><i class='fa fa-save'></i> Proses Permintaan</button>";
            }else{
              echo "<button type='submit' name='submit' class='btn btn-xs btn-primary'><i class='fa fa-save'></i> Proses Permintaan</button>";
            }
          ?>          
          <div id="table_permintaan_detail"></div>
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
<!--
<script src="<?= base_url(); ?>assets/gentelella/js/jquery-2.1.4.min.js"></script>-->


<script type="text/javascript">
  var save_method; //for save method string
  var table;
  var base_url = '<?php echo base_url();?>';
  loadDataPermintaanDetail();
  
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

  function add_permintaan_detail()
  {
      save_method = 'add_permintaan_detail';
      $('#form1')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#permintaan_form').modal('show'); // show bootstrap modal
      //$('.modal-title').text('Tambah Lampiran'); // Set Title to Bootstrap modal title
      //$('#btnSave2').text('Save');
  }

  function save()
  {
      $('#btnSave').text('saving...'); //change button text
      $('#btnSave').attr('disabled',true); //set button disable 
      var url;
      if(save_method == 'add_permintaan_detail') {
          url = "<?php echo site_url('permintaan/pr/add_permintaan_detail')?>";
          var formData = new FormData($('#form1')[0]);
      }else{
          url = "<?php echo site_url('permintaan/pr/edit_permintaan_detail')?>";
          var formData = new FormData($('#form1')[0]);
      }
      
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
              $('#permintaan_form').modal('hide');
              //loadDataPermintaanDetail();
              //sukses_tambah_permintaan();
              location.reload();
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
 
  function loadDataPermintaanDetail(){
    $.ajax({
      type :'GET',
      url  :'<?= base_url('permintaan/pr/dataPermintaanDetail') ?>',
      data :'',
      success:function(html){
        $("#table_permintaan_detail").html(html);
      }
    })
  }

  function hapus_permintaan_detail(id)
  {
      if(confirm('Anda yakin ingin menghapus permintaan ini?'))
      {
          $.ajax({
              url : "<?php echo site_url('permintaan/pr/hapus_detail_permintaan')?>/"+id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                  loadDataPermintaanDetail();
                  sukses_hapus_permintaan();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error deleting data');
              }
          });
      }
  }

  function sukses_tambah_permintaan()
  {
     $(document).ready(function (){
        $.notify("Data Permintaan telah ditambahkan","success");
          });
  }

  function sukses_hapus_permintaan()
  {
     $(document).ready(function (){
        $.notify("Data Permintaan telah dihapus","warning");
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
<div class="modal fade" id="permintaan_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Permintaan Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form1"  class="form-horizontal">
                    <input type="hidden" value="0" name="id_pr"/> 
                    <input type="hidden" value="<?= $no_pr ?>" name="no_pr"/> 
                    <div class="form-body">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-12">Nama Barang</label>
                          <div class="col-md-9 col-xs-12 col-sm-12">
                            <input type="text" name="nama_barang" class="form-control">
                            <input type="hidden" name="id_karyawan" value="0">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-12">No. Seri / Type</label>
                          <div class="col-md-9 col-sm-12 col-xs-12">
                            <input type="text" name="no_seri" class="form-control" >
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-12">Jumlah Barang</label>
                          <div class="col-md-9 col-sm-12 col-xs-12">
                            <input type="text" name="jumlah_barang" class="form-control" >
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-12">Satuan</label>
                          <div class="col-md-9 col-sm-12 col-xs-12">
                            <select name="satuan" class="form-control">
                              <option value="">-- pilih satuan --</option>
                              <option value="pcs">PCS</option>
                              <option value="unit">Unit</option>
                              <option value="tabung">Tabung</option>
                              <option value="set">Set</option>
                              <option value="drum">Drum</option>
                              <option value="jasa">Jasa</option>
                              <option value="lain-lain">Lain-lain</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-12">Keterangan Barang</label>
                          <div class="col-md-9 col-sm-12 col-xs-12">
                            <textarea class="form-control" name="keterangan"></textarea>
                          </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->