<!-- Datatables
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/datatables/dataTables.bootstrap.css"/>
-->
<!-- Datatables -->
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


<style>
    .dataTables_wrapper {
        min-height: 500px
    }
    
    .dataTables_processing {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        margin-left: -50%;
        margin-top: -25px;
        padding-top: 20px;
        text-align: center;
        font-size: 1.2em;
        color:grey;
    }
</style> 

<!-- Custom Theme Style -->
<link href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" rel="stylesheet">

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Tabel Modul</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <ul class="nav navbar-right panel_toolbox">
              <li>
                <button class="btn btn-sm btn-success" onclick="add_menu()"><i class="glyphicon glyphicon-plus"></i> Menu</button>
              </li>
              <a class="btn btn-sm btn-warning" href="<?= base_url('admin/menu/add_rule') ?>"><i class="fa fa-reply"></i> Back Rule</a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <table class="table table-bordered table-striped" id="lookup">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NAMA MENU</th>
                    <th>PARENT MENU</th>
                    <th>ACTION</th>
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


<!-- Custom Theme Scripts -->
<script src="<?= base_url() ?>assets/gentelella/build/js/custom.min.js"></script>

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
<script src="<?= base_url() ?>assets/gentelella/datatables/jquery.dataTables.js" ></script>
<script src="<?= base_url() ?>assets/gentelella/datatables/dataTables.bootstrap.js"></script>
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

      var t = $("#lookup").dataTable({
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
    //  "processing" : true,
    //  "serverSide" : true,
        "ajax"    : '<?= base_url('admin/menu/data'); ?>',
        "columns" : [
            {
              "data"      : null,
              "width"     : "50px",
              "sClass"    : "text-center",
              "orderable" : false,
            },
            { "data" : "nama"},
            { "data" : "jenis"},
            { "data"    : "aksi",
              "width"   : "120px",
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
    $(function () {
        $("#lookup").dataTable();
        $("#mytable").dataTable(); 
        $("#lookup3").dataTable();
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

  function add_menu()
  {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Menu'); // Set Title to Bootstrap modal title
  }
   
  function edit_menu(id)
  {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
      $('#btnSave').text('Update'); //change button text
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
   
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('admin/menu/ajax_edit')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
              $('[name="id"]').val(data.id_menu);
              $('[name="judul_menu"]').val(data.menu);
              $('[name="link"]').val(data.link);
              $('[name="icon"]').val(data.icon);
              $('[name="parent"]').val(data.sub_menu);
              $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
              $('.modal-title').text('Edit Menu'); // Set title to Bootstrap modal title
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }

  function reload_table()
  {
      $('#lookup').DataTable().ajax.reload();
     // mytable.ajax.reload(); //reload datatable ajax 
  }

  function save()
  {
      $('#btnSave').text('saving...'); //change button text
      $('#btnSave').attr('disabled',true); //set button disable 
      var url;
      //echo "save_method";
      if(save_method == 'add') {
          url = "<?php echo site_url('admin/menu/ajax_add')?>";
      } else {
          url = "<?php echo site_url('admin/menu/ajax_update')?>";
      }
   
      // ajax adding data to database
      var formData = new FormData($('#form')[0]);
      $.ajax({
            url : url,
            type: "POST",
            //data: $('#form').serialize(),
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
         
          success: function(data)
          {
              if(data.status) //if success close modal and reload ajax table
              {
                  $('#modal_form').modal('hide');
                  /**
                  $('div.widget-content').prepend(
                    '<div class="control-group"><div class="alert alert-info">'+
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                    '<strong>Berhasil!</strong> Artikel telah diperbaharui ... </div></div>'
                  );
                  **/
                  location.reload();
                  //reload_table();
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
   
  function delete_menu(id)
  {
      if(confirm('Anda yakin ingin menghapus data ini?'))
      {
          // ajax delete data to database
          $.ajax({
              url : "<?php echo site_url('admin/menu/ajax_delete')?>/"+id,
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
</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Menu Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form"  class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Menu Title</label>
                            <div class="col-md-9">
                                <input name="judul_menu" placeholder="menu title" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Link</label>
                            <div class="col-md-9">
                                <input name="link" placeholder="link menu / #" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Icon</label>
                            <div class="col-md-9">
                                <input name="icon" placeholder="fa fa-example" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Parent</label>
                            <div class="col-md-9">
                               <?php
                                  $parent = $this->M_menu->select_parent('abe_menu',array('sub_menu'=>0));
                               ?>
                                <select name="parent"  class="form-control">
                                  <?php
                                    foreach ($parent->result() as $p) {
                                      echo "<option value='$p->id_menu'>$p->menu</option>";
                                    }
                                  ?>
                                  <option value="0">Menu Utama</option>
                                </select>
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