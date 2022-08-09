<!-- Datatables -->
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


<!-- Datatables 
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/datatables/dataTables.bootstrap.css"/>
-->
<link href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" rel="stylesheet">

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><i class="fa fa-ship"></i> Dashboard</h3>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Karyawan<small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
            <a class="btn btn-sm btn-primary" href="<?= base_url('hrd/karyawan/cetak_excel') ?>"><i class="fa fa-print"></i> Export Excel Karyawan</a>
                <a class="btn btn-sm btn-info" href="<?= base_url('hrd/karyawan/non_aktif') ?>"><i class="fa fa-user"></i> Karyawan Non Aktif</a>
                <a class="btn btn-sm btn-success" href="<?= base_url('hrd/karyawan/add') ?>"><i class="glyphicon glyphicon-plus"></i> Karyawan</a>
                <!--
                <button class="btn btn-sm btn-success" onclick="add_karyawan()"><i class="glyphicon glyphicon-plus"></i> Karyawan</button>
                -->
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <table id="mytable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Foto</th>
                    <th>Department</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
              </table>
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

    $(document).ready(function() {
      $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

      var t = $("#mytable").dataTable({
        initComplete: function() {
          var api = this.api();
          $('#mytable_filter input')
                  .off('.DT')
                  .on('keyup.DT', function(e){
                      if (e.keyCode == 13) {
                          api.search(this.value).draw();
                      }
                  });
            },
        oLanguage: {
            sProcessing: "Tunggu ya..."
        },
        processing: true,
        serverSide: true,
        "ajax"    : '<?= base_url('hrd/karyawan/data'); ?>',
        "columns" : [
            {
              "data"      : null,
              "width"     : "50px",
              "sClass"    : "text-center",
              "orderable" : false,
            }, 
            { "data" : "kode_karyawan"},
            { "data" : "nama_lengkap"},
            { "data" : "foto"},
            { "data" : "department"},
            { "data" : "jabatan", "sClass"  : "text-center"},
            { "data" : "status", "sClass"  : "text-center"},
            { "data"    : "aksi",
              "width"   : "80px",
              "sClass"  : "text-right",
            }, 
        ],
        order: [[1, 'asc']],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }
      }); 
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

  function add_karyawan()
  {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#btnSave').text('Save'); //change button text
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Karyawan'); // Set Title to Bootstrap modal title

      $('#photo-preview').hide(); // hide photo preview modal
      $('#label-photo').text('Upload Photo'); // label photo upload
  }
   
  function edit_karyawan(id)
  {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
      $('#btnSave').text('Update'); //change button text
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
   
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('hrd/karyawan/ajax_edit')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
              $('[name="id"]').val(data.id_karyawan);
              $('[name="nama_lengkap"]').val(data.nama_lengkap);
              $('[name="department"]').val(data.department);
              $('[name="jabatan"]').val(data.jabatan);
              $('[name="tempat"]').val(data.tempat_lahir);
              $('[name="tgl_lahir"]').val(data.tgl_lahir);
              $('[name="nik"]').val(data.nik_ktp);
              $('[name="alamat_ktp"]').val(data.alamat_ktp);
              $('[name="alamat"]').val(data.alamat);
              $('[name="phone"]').val(data.phone);
              $('[name="mobile"]').val(data.mobile);
              $('[name="status_pernikahan"]').val(data.status_pernikahan);
              $('[name="id_pt"]').val(data.id_pt);
              $('[name="tgl_gabung"]').val(data.tgl_gabung);
              $('[name="kota"]').val(data.posisi);
              $('[name="nama_kerabat"]').val(data.nama_kerabat);
              $('[name="tlpn_kerabat"]').val(data.tlpn_kerabat);
              $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
              $('.modal-title').text('Edit Karyawan'); // Set title to Bootstrap modal title

              $('#photo-preview').show(); // show photo preview modal
              
              if(data.foto != 'user.png')
              {
                  $('#label-photo').text('Change Photo'); // label photo upload
                  $('#photo-preview div').html('<img width="100px" src="'+base_url+'assets/foto_karyawan/'+data.foto+'" class="img-responsive">'); // show photo
                  $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="'+data.foto+'"/> Remove photo when saving'); // remove photo
              }
              else
              {
                  $('#label-photo').text('Upload Photo'); // label photo upload
                  $('#photo-preview div').text('(No photo)');
              }
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }

  function reload_table()
  {
    // mytable.ajax.reload(); //reload datatable ajax
    $('#mytable').DataTable().ajax.reload();
  }

  function save() 
  {
      $('#btnSave').text('saving...'); //change button text
      $('#btnSave').attr('disabled',true); //set button disable 
      var url;
      if(save_method == 'add') {
          url = "<?php echo site_url('hrd/karyawan/ajax_add')?>";
      } else {
          url = "<?php echo site_url('hrd/karyawan/ajax_update')?>";
      }
      // ajax adding data to database
      var formData = new FormData($('#form')[0]);
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
                  $('#modal_form').modal('hide');
                  reload_table(); 
                  sukses_tambah_karyawan();
                  //location.reload();
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
   
  function delete_pengguna(id)
  {
      if(confirm('Anda yakin ingin menghapus data ini?'))
      {
          // ajax delete data to database
          $.ajax({
              url : "<?php echo site_url('master/pengguna/ajax_delete')?>/"+id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                  //if success reload ajax table
                  $('#modal_form').modal('hide');
                  //location.reload();
                  reload_table();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error deleting data');
              }
          });
      }
  }

  // Kumpulan Notifikasi //
  function sukses_tambah_karyawan()
  {
     $(document).ready(function (){
        $.notify("Data Karyawan Berhasil di buat","success");
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
 
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Pengguna Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form"  class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Lengkap</label>
                            <div class="col-md-9">
                                <input name="nama_lengkap" placeholder="nama lengkap" required="true" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Department</label>
                            <div class="col-md-5">
                                <?php
                                  echo cmb_dinamis('department','abe_department','nama_department','id_department');
                                ?>
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-4">
                                <?php
                                  echo cmb_dinamis('jabatan','abe_jabatan','nama_jabatan','id_jabatan');
                                ?>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tempat / Tgl Lahir</label>
                            <div class="col-md-4">
                                <input name="tempat" placeholder="tempat lahir" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-5">
                                <input name="tgl_lahir"  type="text" data-inputmask="'mask': '99-99-9999'" id="datepicker-example1" placeholder="pilih tanggal" class="form-control tanggal" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">NIK KTP</label>
                            <div class="col-md-9">
                                <input name="nik" placeholder="nik - ktp" class="form-control" type="text" data-inputmask="'mask': '9999999999999999'">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Alamat KTP</label>
                            <div class="col-md-9">
                              <textarea class="form-control" name="alamat_ktp"></textarea>
                              <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Alamat Tinggal</label>
                            <div class="col-md-9">
                              <textarea class="form-control" name="alamat"></textarea>
                              <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nomor Telp.</label>
                            <div class="col-md-5">
                                <input name="phone" placeholder="phone" data-inputmask="'mask': '999999999999'"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-4">
                                <input name="mobile" placeholder="mobile" data-inputmask="'mask': '999999999999'"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Status Pernikahan</label>
                            <div class="col-md-9">
                                <select class="form-control" name="status_pernikahan">
                                  <option value="">-- pilih status --</option>
                                  <option value="single"> Single </option>
                                  <option value="nikah"> Menikah </option>
                                  <option value="janda"> Janda </option>
                                  <option value="duda"> Duda </option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Masuk</label>
                            <div class="col-md-9">
                                <input name="tgl_gabung"  type="text" placeholder="pilih tanggal" data-inputmask="'mask': '99-99-9999'" id="datepicker-example1" class="form-control tanggal" id="datepicker-example1" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Perusahaan</label>
                            <div class="col-md-9">
                                <?php
                                  echo cmb_dinamis('id_pt','abe_pt','nama_pt','id_pt');
                                ?>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Lokasi Karyawan</label>
                            <div class="col-md-9">
                                <?php
                                  echo cmb_dinamis('kota','abe_kota','nama_kota','nama_kota');
                                ?>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" id="photo-preview">
                            <label class="control-label col-md-3">Foto</label>
                            <div class="col-md-9">
                                (No photo)
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" id="label-photo">Upload Photo Pengguna</label>
                            <div class="col-md-9">
                                <input type="file" id="exampleInputFile" name="foto" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Kerabat Dekat</label>
                            <div class="col-md-9">
                                <input name="nama_kerabat" placeholder="nama lengkap" required="" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nomor Telp. Kerabat</label>
                            <div class="col-md-9">
                                <input name="tlpn_kerabat" placeholder="phone" data-inputmask="'mask': '999999999999'"  class="form-control" type="text">
                                <span class="help-block"></span>
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