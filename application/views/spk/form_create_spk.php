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
  selector:'textarea',
  plugins : 'advlist lists' 
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
        <h3>Surat Perintah Kerja - IT</h3>
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
              <a href="<?= base_url('user/spk') ?>" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> Back</a>
              <button  type="button" class="btn btn-sm btn-primary"><?= date('d M Y'); ?></button>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/spk/proses">
            <div class="col-md-8 col-sm-12 col-xs-12">
              <div class="form-body">
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Nomor Rapat</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="no_spk" value="<?php echo $no_spk; ?>" class="form-control" readonly="true" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Dibuat Oleh</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="nama_user" value="<?= $this->session->userdata('nama_lengkap') ?>" class="form-control" readonly="true" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Divisi</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="divisi" value="<?= $this->session->userdata('department') ?>" class="form-control" readonly="true" >
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
              </div>
            </div>
            <!--
            <div class="col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <h2>Upload Lampiran (optional)</h2>
                  <div class="col-md-8">
                    <div class="thumbnail">
                      <div class="view view-first">
                        <img id="preview" style="width: 100%; display: block;" src="<?= base_url() ?>assets/lampiran_spk/lampiran.png" alt="lampiran spk" />
                      </div>
                    </div>
                  </div>
                <div class="col-md-12">
                    <input type="file" id="exampleInputFile" name="foto" accept="image/*" onchange="tampilkanPreview(this,'preview')" class="form-control">
                    <span class="help-block"></span>
                </div>
              </div>
            </div>
            -->
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
              <textarea name="detail_spk" rows="10"></textarea>
            </div>
            <div class="col-sm-12 pull-right" >
              <br>
              <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Proses</button>
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