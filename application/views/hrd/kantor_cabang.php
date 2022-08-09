<!-- Datatables -->
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<link href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" rel="stylesheet">

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Data Kota</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Kota<small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <button class="btn btn-sm btn-success" onclick="add_kota()"><i class="glyphicon glyphicon-plus"></i> Kota</button>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="table_kota"></div>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Kantor <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <button class="btn btn-sm btn-success" onclick="add_kantor()"><i class="glyphicon glyphicon-plus"></i> Kantor</button>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <table class="table table-bordered table-striped" id="mytable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Initial</th>
                    <th>No. Tlpn</th>
                    <th>Status</th>
                    <th>Action</th>
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


<script type="text/javascript">
    $(document).ready(function() {
      loadDataKota();
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
        "ajax"    : '<?= base_url('hrd/kantor_cabang/data'); ?>',
        "columns" : [
            {
              "data"      : null,
              "width"     : "50px",
              "sClass"    : "text-center",
              "orderable" : false,
            },
            { "data" : "nama"},
            { "data" : "singkat"},
            { "data" : "no_tlpn", "sClass"  : "text-center"},
            { "data" : "status", "sClass"  : "text-center"},
            { "data"    : "aksi",
              "width"   : "80px",
              "sClass"  : "text-center",
            }, 
        ],
        order: [[2, 'asc']],
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

 function loadDataKota(){
    //alert("tes");
    $.ajax({
      type :'GET',
      url  :'<?= base_url('hrd/kantor_cabang/dataKota') ?>',
      data :'',
      success:function(html){
        $("#table_kota").html(html);
      }
    })
  }

  function add_kota()
  {
      save_method = 'add';
      $('#form2')[0].reset(); // reset form on modals
      //$('[name="nama"]').val();
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#kota_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Kota'); // Set Title to Bootstrap modal title
      $('#btnSave').text('Save');
  }

  function save_kota()
  {
      $('#btnSave').text('saving...'); //change button text
      $('#btnSave').attr('disabled',true); //set button disable 
      var url;
      url = "<?php echo site_url('hrd/kantor_cabang/ajax_add_kota')?>";
      
      // ajax adding data to database
      var formData = new FormData($('#form2')[0]);
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
              $('#kota_form').modal('hide');
              loadDataKota();
              sukses_tambah_kota();
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

  function delete_kota(id)
  {
      if(confirm('Anda yakin ingin menghapus kota ini?'))
      {
          // ajax delete data to database
          $.ajax({
              url : "<?php echo site_url('hrd/kantor_cabang/ajax_delete_kota')?>/"+id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                  //if success reload ajax table
                  $('#modal_form').modal('hide');
                  loadDataKota();
                  sukses_hapus_kota();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error deleting data');
              }
          });
      }
  }

    function add_kantor()
  {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#btnSave').text('Save'); //change button text
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Kantor'); // Set Title to Bootstrap modal title
  }
   
  function edit_kantor(id)
  {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
      $('#btnSave').text('Update'); //change button text
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
   
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('hrd/kantor_cabang/ajax_edit')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
              $('[name="id"]').val(data.id_pt);
              $('[name="nama_kantor"]').val(data.nama_pt);
              $('[name="singkat"]').val(data.singkat);
              $('[name="alamat"]').val(data.alamat);
              $('[name="no_tlpn"]').val(data.no_tlpn);
              $('[name="akta_pendirian"]').val(data.akta_pendirian);
              $('[name="akta_perubahan"]').val(data.akta_perubahan);
              $('[name="domisili"]').val(data.domisili);
              $('[name="npwp"]').val(data.npwp);
              $('[name="siup"]').val(data.siup);
              $('[name="tdp"]').val(data.tdp);
              $('[name="situ_ho"]').val(data.situ_ho);
              $('[name="api_u"]').val(data.api_u);
              $('[name="api_p"]').val(data.api_p);
              $('[name="nik"]').val(data.nik);
              $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
              $('.modal-title').text('Edit Kantor'); // Set title to Bootstrap modal title
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
          url = "<?php echo site_url('hrd/kantor_cabang/ajax_add')?>";
      } else {
          url = "<?php echo site_url('hrd/kantor_cabang/ajax_update')?>";
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
                sukses_tambah_kantor(); 
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
   
  function delete_kantor(id)
  {
      if(confirm('Anda yakin ingin menghapus data ini?'))
      {
          // ajax delete data to database
          $.ajax({
              url : "<?php echo site_url('hrd/kantor_cabang/ajax_delete')?>/"+id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                  //if success reload ajax table
                  $('#modal_form').modal('hide');
                  //location.reload();
                  reload_table();
                  sukses_hapus_kantor();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error deleting data');
              }
          });
      }
  }

  function tambah_karyawan()
  {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#btnSave').text('Save'); //change button text
      $('#modal_karyawan').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Karyawan'); // Set Title to Bootstrap modal title
  }

  function sukses_tambah_kota()
  {
     $(document).ready(function (){
        $.notify("Data Kota telah ditambahkan","success");
          });
  }

  function sukses_hapus_kota()
  {
     $(document).ready(function (){
        $.notify("Data Kota telah dihapus","warning");
          });
  }

  function sukses_tambah_kantor()
  {
     $(document).ready(function (){
        $.notify("Data Kantor telah ditambahkan","success");
          });
  }

  function sukses_hapus_kantor()
  {
     $(document).ready(function (){
        $.notify("Data Kantor telah dihapus","warning");
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
<div class="modal fade" id="kota_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Kota Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form2"  class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3" id="">Nama Kota</label>
                            <div class="col-md-9">
                                <input name="nama" placeholder="nama kota" required="required" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save_kota()" class="btn btn-primary">Save</button>
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
                <h3 class="modal-title">Kantor Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form"  class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Kantor</label>
                            <div class="col-md-9">
                                <input name="nama_kantor" placeholder="nama kantor" required="true" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Singkatan Perusahaan</label>
                            <div class="col-md-9">
                                <input name="singkat" placeholder="singkatan perusahaan" required="true" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Alamat</label>
                            <div class="col-md-9">
                              <textarea class="form-control" name="alamat"></textarea>
                              <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nomor Telp.</label>
                            <div class="col-md-9">
                                <input name="no_tlpn" placeholder="" data-inputmask="'mask': '999999999999'"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label col-md-3">Akta</label>
                            <div class="col-md-5">
                                <input name="akta_pendirian" placeholder="akta pendirian" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-4">
                                <input name="akta_perubahan" placeholder="akta perubahan" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Domisili</label>
                            <div class="col-md-9">
                                <input name="domisili" placeholder="domisili" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">NPWP</label>
                            <div class="col-md-9">
                                <input name="npwp" placeholder="npwp" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">SIUP</label>
                            <div class="col-md-9">
                                <input name="siup" placeholder="siup" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">TDP</label>
                            <div class="col-md-9">
                                <input name="tdp" placeholder="tdp" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">SITU HO</label>
                            <div class="col-md-9">
                                <input name="situ_ho" placeholder="situ ho" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">API U / API P</label>
                            <div class="col-md-5">
                                <input name="api_u" placeholder="api - u" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-4">
                                <input name="api_p" placeholder="api - p" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">NIK Kepabeanan</label>
                            <div class="col-md-9">
                                <input name="nik" placeholder="nomor identitas kepabeanan" class="form-control" type="text">
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

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_karyawan" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Tambah Karyawan</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form"  class="form-horizontal">
                    <input type="text" value="" name="id_pt"/> 
                    <div class="form-body">
                        <div class="form-group">
                          <label class="control-label col-md-3">Karyawan</label>
                          <div class="col-md-9">
                            <input type="text" name="id_karyawan" id="id_karyawan" value="" hidden="">
                            <input type="text" name="nama_karyawan" id="nama_karyawan" value="" readonly="" class="form-control"> 
                            <span class="help-block"></span>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myKaryawan"><i class="fa fa-check"></i> Pilih Karyawan</button>
                            </span>
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
                            <th>Fotos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $sql = "SELECT * FROM abe_karyawan_pt WHERE id_pt";
                            $record_karyawan = $this->db->get_where('abe_karyawan',array('login'=>''));
                            foreach ($record_karyawan->result() as $p)
                            { 
                              echo "<tr class='pilih1' data-karyawan='$p->id_karyawan' data-karyawan2='$p->nama_lengkap'>
                                      <td>$no</td>
                                      <td>$p->nama_lengkap</td>";
                                      if($p->foto == ''){
                                        echo "<td><img src='../assets/foto_karyawan/user.png' width='40px'></td></tr>";
                                      }else{
                                        echo "<td><img src='../assets/foto_karyawan/$p->foto' width='40px'></td></tr>";
                                      }
                              $no++ ;
                            }
                        ?>
                    </tbody>
                </table>  
            </div>
        </div>
    </div>
</div>