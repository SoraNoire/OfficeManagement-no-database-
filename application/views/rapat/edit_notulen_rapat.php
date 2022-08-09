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
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/rapat/update_draft">
            <div class="col-md-8 col-sm-12 col-xs-12">
              <div class="form-body">
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Nomor Rapat</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="hidden" name="id_rapat" value="<?= $record['id_rapat'] ?>">
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
                  <label class="control-label col-md-4 col-sm-12">Tanggal Rapat</label>
                  <div class="col-md-8 col-sm-12">
                    <input name="tgl_rapat" type="text" value="<?= date('d-m-Y', strtotime($record['tgl_rapat']))?>" data-inputmask="'mask': '99-99-9999'" id="datepicker-example1" placeholder="pilih tanggal" class="form-control tanggal" required="true">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Waktu Rapat</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="jam_rapat" data-inputmask="'mask': '99.99-99.99'" value="<?= $record['jam_rapat'] ?>" required="true" class="form-control" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Divisi</label>
                  <div class="col-md-8 col-sm-12">
                    <?php
                      echo cmb_dinamis('divisi','abe_department','nama_department','nama_department',$record['department']);
                    ?>  
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Pembahasan</label>
                  <div class="col-md-8 col-sm-12">
                    <input type="text" name="pembahasan" value="<?= $record['pembahasan'] ?>" class="form-control" required="true" >
                  </div>
                </div>
                <!--
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-12">Keterangan</label>
                  <div class="col-md-8 col-sm-12">
                    <textarea name="keterangan" class="form-control"><?= $record['keterangan'] ?></textarea>
                  </div>
                </div>
              -->
              </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
              <div class="form-group" style="text-align: left">
                <!--
                <button class="btn btn-sm btn-success" onclick="add_peserta()"><i class="glyphicon glyphicon-plus"></i> Peserta</button>
                -->
                <button type='button' class="btn btn-sm btn-success" data-toggle="modal" data-target="#myKaryawan"><i class="fa fa-plus"></i> Peserta</button>
                <button type="button" class="btn btn-sm btn-success" onclick="add_peserta_luar()"><i class="glyphicon glyphicon-plus"></i> Non Staff</button>
              </div>
              <div id="table_peserta"></div>
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
              <textarea name="hasil_rapat" rows="10"><?= $record['hasil_rapat'] ?></textarea>
            </div>
          </div>
          <div class="x_title">
            <h2>Ketarangan Rapat</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-sm-12" >
              <textarea name="keterangan"><?= $record['keterangan'] ?></textarea>
            </div>
            
            <div class="col-sm-12 pull-right" >
              <br>
              <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-refresh"></i> Update</button>
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
//            jika dipilih, kode obat akan masuk ke input dan modal di tutup
    $(document).on('click', '.pilih1', function (e) {
        add_peserta();
        document.getElementById("id_karyawan").value = $(this).attr('data-karyawan');
        document.getElementById("nama_karyawan").value = $(this).attr('data-karyawan2');
        $('#myKaryawan').modal('hide');
        save();
    });

    $(document).on('click', '.pilih2', function (e) {
        document.getElementById("id_karyawan2").value = $(this).attr('data-karyawan3');
        document.getElementById("nama_karyawan2").value = $(this).attr('data-karyawan4');
        $('#myKaryawan2').modal('hide');
    });

    $(function () {
        $("#lookup").dataTable();
        $("#lookup2").dataTable(); 
        $("#lookup3").dataTable();
    });
</script>

<script type="text/javascript">
  var save_method; //for save method string
  var table;
  var base_url = '<?= base_url();?>';
  var nomor_rapat = '<?= $record['no_rapat'] ?>';
  //loadDataPeserta('<?= $record['no_rapat'] ?>');
  loadDataPeserta(nomor_rapat);
  //loadDataMengetahui();
  //loadDataLampiran();
  
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

  function add_peserta()
  {
      save_method = 'add_peserta';
      $('#form1')[0].reset(); // reset form on modals
  }

  function add_peserta_luar()
  {
      save_method = 'add_peserta_luar';
      $('#form4')[0].reset(); // reset form on modals
      //$('[name="nama"]').val();
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#peserta_form2').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Peserta Non Karyawan'); // Set Title to Bootstrap modal title
      $('#btnSave1').text('Save');
  }

  function save()
  {
      $('#btnSave').text('saving...'); //change button text
      $('#btnSave').attr('disabled',true); //set button disable 
      var url;
      url = "<?php echo site_url('user/rapat/add_peserta')?>";
      if(save_method == 'add_peserta') {
        var formData = new FormData($('#form1')[0]);
      }else{
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
              if(save_method == 'add_peserta'){
                $('#peserta_form').modal('hide');
              }else{
                $('#peserta_form2').modal('hide');
              }
              loadDataPeserta(nomor_rapat);
              sukses_tambah_peserta();
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
 
  function loadDataPeserta($no){
    var no_rapat = $no;
    $.ajax({
      type :'GET',
      url  :'<?= base_url('user/rapat/dataPesertaEdit') ?>',
      data :'no_rapat='+no_rapat,
      success:function(html){
        $("#table_peserta").html(html);
      }
    })
  }

  function delete_peserta(id)
  {
      if(confirm('Anda yakin ingin menghapus peserta ini?'))
      {
          $.ajax({
              url : "<?php echo site_url('user/rapat/hapus_peserta')?>/"+id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                  loadDataPeserta('<?= $record['no_rapat'] ?>');
                  sukses_hapus_peserta();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error deleting data');
              }
          });
      }
  }

  function sukses_tambah_peserta()
  {
     $(document).ready(function (){
        $.notify("Data Peserta telah ditambahkan","success");
          });
  }

  function sukses_hapus_peserta()
  {
     $(document).ready(function (){
        $.notify("Data Peserta telah dihapus","warning");
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
<!-- Bootstrap modal -->
<div class="modal fade" id="peserta_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Peserta Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form1"  class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-12">Nomor Rapat</label>
                          <div class="col-md-9 col-sm-12">
                            <input type="text" name="no_rapat" value="<?= $record['no_rapat'] ?>" class="form-control" readonly="true" >
                          </div>
                        </div>
                        <div class="form-group" id="karyawan">
                          <label class="control-label col-md-3">Nama Peserta</label>
                          <div class="col-md-9">
                            <input type="text" name="id_karyawan" id="id_karyawan" value="" hidden="">
                            <input type="text" name="nama_karyawan" id="nama_karyawan" value="" readonly="" class="form-control"> 
                            <span class="help-block"></span>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#myKaryawan"><i class="fa fa-check"></i> Pilih Karyawan</button>
                            </span>
                          </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="myKaryawan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:800px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Daftar Karyawan</h4>
            </div>
            <div class="modal-body">
                <table id="lookup2" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            //$record_karyawan = $this->db->get('abe_karyawan');
                            $sql = "SELECT id_karyawan, nama_lengkap, jabatan FROM abe_karyawan WHERE status = 'aktif'";
                            $record_karyawan = $this->db->query($sql);
                            foreach ($record_karyawan->result() as $p)
                            { 
                              echo "<tr class='pilih1' data-karyawan='$p->id_karyawan' data-karyawan2='$p->nama_lengkap'>
                                      <td>$no</td>
                                      <td>$p->nama_lengkap</td></tr>";
                              $no++ ;
                            }
                        ?>
                    </tbody>
                </table>  
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="peserta_form2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Peserta Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form4"  class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-12">Nomor Rapat</label>
                          <div class="col-md-9 col-sm-12">
                            <input type="text" name="no_rapat" value="<?= $record['no_rapat'] ?>" class="form-control" readonly="true" >
                            <input type="hidden" name="id_karyawan" value="0">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-12">Peserta Rapat</label>
                          <div class="col-md-9 col-sm-12">
                            <input type="text" name="nama_karyawan" class="form-control" >
                          </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave1" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->