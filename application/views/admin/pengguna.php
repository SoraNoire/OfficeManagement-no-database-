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
            <h2>Data Pengguna<small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <button class="btn btn-sm btn-success" onclick="add_user()"><i class="glyphicon glyphicon-plus"></i> User Login</button>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <?php if($this->session->flashdata('aktif')){ ?>
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p><center><?php echo $this->session->flashdata('aktif'); ?></center></p>
                  </div>
                <?php }elseif($this->session->flashdata('non')){ ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <p><center><?php echo $this->session->flashdata('non'); ?></center></p>
                    </div>
                <?php } ?>
          <div class="x_content">
              <table id="mytable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Level</th>
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
//            jika dipilih, kode obat akan masuk ke input dan modal di tutup
    $(document).on('click', '.pilih1', function (e) {
        document.getElementById("id_karyawan").value = $(this).attr('data-karyawan');
        document.getElementById("nama_karyawan").value = $(this).attr('data-karyawan2');
        $('#myKaryawan').modal('hide');
    });

    $(function () {
        $("#lookup").dataTable();
        $("#lookup2").dataTable(); 
        $("#lookup3").dataTable();
    });
</script>

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
        "ajax"    : '<?= base_url('admin/pengguna/data'); ?>',
        "columns" : [
            {
              "data"      : null,
              "width"     : "50px",
              "sClass"    : "text-center",
              "orderable" : false,
            },
            { "data" : "foto"},
            { "data" : "nama"},
            { "data" : "username"},
            { "data" : "level"},
            { "data" : "status", "sClass"  : "text-center"},
            { "data"    : "aksi",
              "width"   : "180px",
              "sClass"  : "text-center",
            }, 
        ],
        order: [[3, 'asc']],
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
   
  function add_user()
  {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#btnSave').text('Save'); //change button text
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah User'); // Set Title to Bootstrap modal title
      $('#note').hide();
      $('#karyawan').show();
  }

  function reload_table()
  {
    // mytable.ajax.reload(); //reload datatable ajax
    $('#mytable').DataTable().ajax.reload();
  }

  function edit_user(id)
  {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
      $('#btnSave').text('Update'); //change button text
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
   
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('admin/pengguna/ajax_edit')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
              $('[name="id"]').val(data.id_login);
              $('[name="username"]').val(data.username);
              $('[name="id_karyawan"]').val(data.id_karyawan);
              $('[name="level"]').val(data.level);
              $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
              $('.modal-title').text('Edit Pengguna'); // Set title to Bootstrap modal title
              $('#karyawan').hide();
              $('#note').show();
              //$('#nama_karyawan').hide();
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }

  function save() 
  {
      $('#btnSave').text('saving...'); //change button text
      $('#btnSave').attr('disabled',true); //set button disable 
      var url;
      if(save_method == 'add') {
          url = "<?php echo site_url('admin/pengguna/ajax_add')?>";
      } else {
          url = "<?php echo site_url('admin/pengguna/ajax_update')?>";
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
                location.reload();
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

  // Kumpulan Notifikasi //
  function sukses_tambah_karyawan()
  {
     $(document).ready(function (){
        $.notify("Data User Login Berhasil di ubah","success");
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
                            <label class="control-label col-md-3">Username</label>
                            <div class="col-md-9">
                                <input name="username" placeholder="username" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Password</label>
                            <div class="col-md-9">
                                <input name="password" placeholder="password" class="form-control" type="password">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Level User</label>
                            <div class="col-md-9">
                                <?php
                                  echo cmb_dinamis('level','abe_level_user','nama_level','id_level_user');
                                ?>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" id="note">
                          <label class="control-label col-md-12"><i>** Kosongkan password apabila tidak ada perubahan</i></label>
                        </div>
                        <div class="form-group" id="karyawan">
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
                            <th>Nama Pengirim</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
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