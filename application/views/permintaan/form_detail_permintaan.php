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
        <h3>Form Permintaan Pembelian</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>permintaan/pr/create">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><small></small></h2>
            <?php
              $status = $record['status'];
              if($status != 'close'){
                echo "<button type='button' class='btn btn-sm btn-success'><i class='fa fa-flag'></i> ".strtoupper($status)."</button>";
              }else{
                echo "<button type='button' class='btn btn-sm btn-danger'><i class='fa fa-flag'></i> ".strtoupper($status)."</button>";
              }
            ?>
            <button type="button" class="btn btn-sm btn-primary"><i class='fa fa-calendar'></i> <?= date('d M Y',strtotime($record['tgl_pr'])); ?></button>
            
            <ul class="nav navbar-right panel_toolbox">
              <button type="button" class="btn btn-sm btn-warning" onclick="javascript:history.back()"><i class="fa fa-reply"></i> Back</button>
              <a target="blank" class="btn btn-sm btn-info" href="<?= base_url() ?>permintaan/pr/cetak_pr_kecil/<?= $record['id_permintaan'] ?>"><i class='fa fa-print'></i> Print</a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-8 col-sm-12 col-xs-12">
              <div class="form-body">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-12 col-xs-12">Nomor Permintaan</label>
                  <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="text" name="no_pr" value="<?= $record['no_pr']; ?>" class="form-control" readonly="true" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-12 col-xs-12">Dibuat Oleh</label>
                  <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="text" name="pr_input" readonly="" value="<?= $record['nama_input'] ?>" class="form-control" readonly="true" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-12 col-xs-12">Diajukan Oleh</label>
                  <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="text" name="pr_diajukan" readonly="" value="<?= $record['pr_diajukan'] ?>" class="form-control" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-12 col-xs-12">Diketahui Oleh</label>
                  <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="text" name="pr_diajukan" readonly="" value="<?= $record['nama_diketahui'] ?>" placeholder="belum di approve" class="form-control" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-12 col-xs-12">Disetujui Oleh</label>
                  <div class="col-md-9 col-sm-12 col-xs-12">
                    <input type="text" name="pr_diajukan" readonly="" value="<?= $record['nama_setuju'] ?>" placeholder="belum di setujui" class="form-control" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-12 col-xs-12">Catatan</label>
                  <div class="col-md-9 col-sm-12 col-xs-12">
                    <textarea class="form-control" style='resize:none; height:100px;' readonly=""> <?= $record['catatan'] ?></textarea> 
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12 col-xs-12">
              <div class="form-group">
                <button disabled="true" class="btn btn-sm btn-info"><i class="fa fa-list"></i> Lampiran</button><br><br>
                <?php
                  $lampiran = $record['file'];
                  $file = substr($lampiran,-3);
                  if($file == 'pdf'){
                    echo "<embed width='100%' height='300' src='".base_url()."assets/lampiran_pr/".$record['file']."#toolbar=0&navpanes=0&scrollbar=0' type='application/pdf'></embed>";
                  }else if($lampiran == ''){
                    echo "<img src='".base_url()."assets/lampiran_pr/lampiran.png' class='img-thumbnail'>";
                  }else{
                    echo "<img src='".base_url()."assets/lampiran_pr/".$record['file']."' class='img-thumbnail'>";
                  }
                ?>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      </form>
      
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr >
                  <th style="text-align: center" width="30px">No</th>
                  <th style="text-align: center" width="250px">Nama Barang</th>
                  <th style="text-align: center" width="160px">No. Seri / Type / Part</th>
                  <th style="text-align: center" width="60">Jumlah</th>
                  <th style="text-align: center" width="60">Unit</th>
                  <th style="text-align: center">Keperluan</th>
                  <th style="text-align: center">Keterangan Status</th>
                  <th style="text-align: center" width="80">Aksi</th>
                </tr>
              </thead>
              <tbody id="table-details">
                <?php
                  $id = $record['no_pr'];
                  $sql = "SELECT * FROM abe_permintaan_detail WHERE no_pr = '$id'"; 
                  $query = $this->db->query($sql);
                  $no = 1;
                  foreach ($query->result() as $r)
                  {
                    echo "
                      <tr>
                        <td>$no</td>
                        <td>$r->nama_barang</td>
                        <td>$r->no_seri</td>
                        <td>$r->jumlah_barang</td>
                        <td>$r->satuan</td>
                        <td>$r->keterangan</td>
                        <td>$r->keterangan_status</td>";
                    if($r->status == 'ditolak'){
                      echo "<td><button type='button' class='btn btn-xs btn-danger' title='ditolak'><i class='fa fa-ban'></i> ditolak</button></td></tr>";
                    }else{
                      echo "<td><button type='button' onclick='update_progress($r->id_pr_detail)' class='btn btn-xs btn-info' title='update progress'><i class='fa fa-check'></i> progress</button></td></tr>";
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
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="x_panel">
          <?php
            $status = $record['status'];
            if($status == 'closed'){
          ?>
            <button class="btn btn-sm btn-success disabled"><i class="glyphicon glyphicon-plus"></i> Lampiran</button>
          <?php
            }else{
          ?>
            <button class="btn btn-sm btn-success" onclick="add_lampiran()"><i class="glyphicon glyphicon-plus"></i> Lampiran Penawaran</button>
          <?php
            }
          ?>
          <div class="x_content">
            <div class="table-responsive">
            <div id="table_lampiran"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="x_panel">
          <?php
            $status = $record['status'];
            if($status == 'closed'){
          ?>
            <button class="btn btn-sm btn-success disabled"><i class="glyphicon glyphicon-plus"></i> Nomor PO / Memo</button>
          <?php
            }else{
          ?>
            <button class="btn btn-sm btn-success" onclick="add_po()"><i class="glyphicon glyphicon-plus"></i> No PO / Memo</button>
          <?php
            }
          ?>
          <div class="x_content">
            <div class="table-responsive">
            <div id="table_po"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="x_panel">
          <?php
            $status = $record['status'];
            if($status == 'closed'){
          ?>
            <button class="btn btn-sm btn-success disabled"><i class="glyphicon glyphicon-plus"></i> Progress</button>
          <?php
            }else{
          ?>
            <button class="btn btn-sm btn-success" onclick="add_progress()"><i class="glyphicon glyphicon-plus"></i> Progress</button>
          <?php
            }
          ?>
          <div class="x_content">
            <div class="table-responsive">
            <div id="table_progress"></div>
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


<script type="text/javascript">
  var save_method; //for save method string
  var table;
  var base_url = '<?php echo base_url();?>';
  var nomor_permintaan = '<?= $record['no_pr'] ?>';
  //loadDataPeserta();
  //loadDataMengetahui();
  loadDataLampiran(nomor_permintaan);
  loadDataPo(nomor_permintaan);
  loadDataProgress(nomor_permintaan);

  function update_progress(id)
  {
      //save_method = 'update';
      //$('#form')[0].reset(); // reset form on modals
      $('#btnSave').text('Update'); //change button text
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
   
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('permintaan/pr/ubah_detail')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
              $('[name="id"]').val(data.id_pr_detail);
              $('[name="nama_barang"]').val(data.nama_barang);
              $('[name="seri"]').val(data.no_seri);
              $('[name="jumlah"]').val(data.jumlah_barang);
              $('[name="unit"]').val(data.satuan);
              $('[name="keterangan"]').val(data.keterangan);
              $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
              $('.modal-title').text('Update Progress'); // Set title to Bootstrap modal title
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }

  function add_lampiran()
  {
      save_method = 'add_lampiran';
      $('#form2')[0].reset(); // reset form on modals
      $('#form3')[0].reset(); 
      $('#form4')[0].reset(); 
      //$('[name="nama"]').val();
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#lampiran_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Lampiran'); // Set Title to Bootstrap modal title
      $('#btnSave2').text('Save');
  }

  function add_po()
  {
      save_method = 'add_po';
      $('#form3')[0].reset(); // reset form on modals
      $('#form2')[0].reset();
      $('#form4')[0].reset();  
      //$('[name="nama"]').val();
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#po_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Nomor PO / Memo'); // Set Title to Bootstrap modal title
      $('#btnSave3').text('Save');
  }

  function add_progress()
  {
      save_method = 'add_progress';
      $('#form2')[0].reset(); // reset form on modals
      $('#form3')[0].reset();
      $('#form4')[0].reset(); 
      //$('[name="nama"]').val();
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#progress_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Progress Terbaru'); // Set Title to Bootstrap modal title
      $('#btnSave4').text('Save');
  }

  function save()
  {
      $('#btnSave').text('saving...'); //change button text
      $('#btnSave').attr('disabled',true); //set button disable 
      var url;
      if(save_method == 'add_lampiran'){
        url = "<?php echo site_url('permintaan/pr/add_lampiran/')?>";
        var formData = new FormData($('#form2')[0]);
      }else if(save_method == 'add_po'){
        url = "<?php echo site_url('permintaan/pr/add_po/')?>";
        var formData = new FormData($('#form3')[0]);
      }else{
        url = "<?php echo site_url('permintaan/pr/add_progress/')?>";
        var formData = new FormData($('#form4')[0]);
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
              if(save_method == 'add_lampiran'){
                $('#lampiran_form').modal('hide');
                loadDataLampiran(nomor_permintaan);
                sukses_tambah_lampiran();
              }else if(save_method == 'add_po'){
                $('#po_form').modal('hide');
                loadDataPo(nomor_permintaan);
                sukses_tambah_po();
              }else{
                $('#progress_form').modal('hide');
                loadDataProgress(nomor_permintaan);
                sukses_tambah_progress();
              }
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
    var no_permintaan = $no;
    $.ajax({
      type :'GET',
      url  :'<?= base_url('permintaan/pr/dataLampiran') ?>',
      data :'no_permintaan='+no_permintaan,
      success:function(html){
        $("#table_lampiran").html(html);
      }
    })
  }

 function loadDataPo($no){
    var no_permintaan = $no;
    $.ajax({
      type :'GET',
      url  :'<?= base_url('permintaan/pr/dataPo') ?>',
      data :'no_permintaan='+no_permintaan,
      success:function(html){
        $("#table_po").html(html);
      }
    })
  }

 function loadDataProgress($no){
    var no_permintaan = $no;
    $.ajax({
      type :'GET',
      url  :'<?= base_url('permintaan/pr/dataProgress') ?>',
      data :'no_permintaan='+no_permintaan,
      success:function(html){
        $("#table_progress").html(html);
      }
    })
  }

  function delete_lampiran(id)
  {
      if(confirm('Anda yakin ingin menghapus Lampiran ini?'))
      {
          // ajax delete data to database
          $.ajax({
              url : "<?php echo site_url('permintaan/pr/hapus_lampiran')?>/"+id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                  loadDataLampiran(nomor_permintaan);
                  sukses_hapus_lampiran();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error deleting data');
              }
          });
      }
  }

  function delete_po(id)
  {
      if(confirm('Anda yakin ingin menghapus PO / Memo ini?'))
      {
          // ajax delete data to database
          $.ajax({
              url : "<?php echo site_url('permintaan/pr/hapus_po')?>/"+id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                  loadDataPo(nomor_permintaan);
                  sukses_hapus_po();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error deleting data');
              }
          });
      }
  }

  function delete_progress(id)
  {
      if(confirm('Anda yakin ingin menghapus Progress ini?'))
      {
          // ajax delete data to database
          $.ajax({
              url : "<?php echo site_url('permintaan/pr/hapus_progress')?>/"+id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                  loadDataProgress(nomor_permintaan);
                  sukses_hapus_progress();
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

  function sukses_tambah_po()
  {
     $(document).ready(function (){
        $.notify("Data nomor PO / Memo telah ditambahkan","success");
          });
  }

  function sukses_hapus_po()
  {
     $(document).ready(function (){
        $.notify("Data nomor PO / Memo telah dihapus","warning");
          });
  }

  function sukses_tambah_progress()
  {
     $(document).ready(function (){
        $.notify("Data Progress telah ditambahkan","success");
          });
  }

  function sukses_hapus_progress()
  {
     $(document).ready(function (){
        $.notify("Data Progress telah dihapus","warning");
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
                        <label class="control-label col-md-3 col-sm-12">Nomor Permintaan Pembelian</label>
                        <div class="col-md-9 col-sm-12">
                          <input type="text" name="no_permintaan" value="<?= $record['no_pr'] ?>" class="form-control" readonly="true" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-12">Keterangan Lampiran</label>
                        <div class="col-md-9 col-sm-12">
                          <input type="text" name="keterangan_lampiran" placeholder="nama lampiran / keterangan" class="form-control" >
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
<div class="modal fade" id="po_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Nomor PO / Memo Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form3"  class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-12">Nomor Permintaan Pembelian</label>
                        <div class="col-md-9 col-sm-12">
                          <input type="text" name="no_permintaan" value="<?= $record['no_pr'] ?>" class="form-control" readonly="true" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-12">Nomor PO / Memo</label>
                        <div class="col-md-9 col-sm-12">
                          <input type="text" name="po_memo" placeholder="nomor PO / Memo" class="form-control" >
                        </div>
                      </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave3" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="progress_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Progress Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form4"  class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-12">Nomor Permintaan Pembelian</label>
                        <div class="col-md-9 col-sm-12">
                          <input type="text" name="no_permintaan" value="<?= $record['no_pr'] ?>" class="form-control" readonly="true" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-12">Progress</label>
                        <div class="col-md-9 col-sm-12">
                          <input type="text" name="progress" placeholder="progress PR" class="form-control" >
                        </div>
                      </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave4" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Update Progress</h3>
            </div>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>permintaan/pr/update_progress">
            <div class="modal-body form">
              <input type="hidden" value="" name="id" id="id" />
              <input type="hidden" value="<?= $record['id_permintaan']; ?>" name="id_pr"> 
              <div class="form-body">
                  <div class="form-group">
                      <label class="control-label col-md-3">Nama Barang</label>
                      <div class="col-md-9">
                          <input name="nama_barang" id="nama_barang" readonly="true" class="form-control" type="text">
                          <span class="help-block"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">No Seri</label>
                      <div class="col-md-9">
                          <input name="seri" id="seri" readonly="true" class="form-control" type="text">
                          <span class="help-block"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Jumlah Barang</label>
                      <div class="col-md-4">
                          <input name="jumlah" id="jumlah" readonly="true" class="form-control" type="text">
                          <span class="help-block"></span>
                      </div>
                      <div class="col-md-5">
                          <input name="unit" id="unit" readonly="true" class="form-control" type="text">
                          <span class="help-block"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Keperluan</label>
                      <div class="col-md-9">
                        <textarea class="form-control" name="keterangan" id="keterangan" readonly="true"></textarea>
                        <span class="help-block"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Status Item</label>
                      <div class="col-md-9">
                          <select class="form-control" name="status" required="true">
                            <option value="disetujui"> disetujui</option>
                            <option value="ditolak"> ditolak</option>
                          </select>
                          <span class="help-block"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Keterangan Progress</label>
                      <div class="col-md-9">
                        <textarea class="form-control" name="keterangan_status" id="keterangan_status"></textarea>
                        <span class="help-block"></span>
                      </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-xs btn-primary"><i class="fa fa-reply"></i> Proses</button>
                <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->