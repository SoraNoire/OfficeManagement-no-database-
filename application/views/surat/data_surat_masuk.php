 <!-- Datatables -->
 <link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/datatables/dataTables.bootstrap.css"/>

<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css"> -->

<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css"> -->
<!-- Custom Theme Style -->
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css">

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Data Surat Masuk</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <a href="<?= base_url() ?>" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> Back</a>
              <button  type="button" class="btn btn-sm btn-primary"><?= date('d M Y'); ?></button>
            </ul>
            <div class="clearfix"></div>
          </div>
          <?php if($this->session->flashdata('sukses')){ ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <p><center><?php echo $this->session->flashdata('sukses'); ?></center></p>
            </div>
          <?php }?> 
          <div class="x_content">
              <table class="table table-bordered table-striped" id="mytable">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th width="70px">Tanggal</th>
                    <th width="120px">Asal Surat</th>
                    <th width="120px">Di tujukan ke</th>
                    <th>Perihal</th>
                    <th width="110px">Pengantar</th>
                    <th width="50px">Action</th>
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
<!-- <script src="<?= base_url() ?>assets/gentelella/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script> -->
<!-- Custom Theme Scripts -->
<script src="<?= base_url() ?>assets/gentelella/build/js/custom.min.js"></script>

<!-- Datatables Scripts  -->
<script src="<?= base_url() ?>assets/gentelella/datatables/jquery.dataTables.js" ></script>
<script src="<?= base_url() ?>assets/gentelella/datatables/dataTables.bootstrap.js"></script>

<script type="text/javascript">
    var base_url = '<?php echo base_url();?>';
    function detail(id){
      //var no_do =$("#no_do").val();
      $.ajax({
        // type :'GET',
        // url  :'<?= base_url('transaksi/invoice/data_invoice_detail/') ?>' + id,
        // data : '',
        // success:function(html){
        //   $('#invoice').modal('show');
        //   $("#data_invoice2").html(html);
        // }
        url : "<?php echo site_url('user/surat/detail')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id_surat_masuk);
            $('[name="no_surat"]').val(data.no_surat);
            $('[name="tgl_surat"]').val(data.tgl_surat);
            $('[name="asal_surat"]').val(data.asal_surat);
            $('[name="sifat_surat"]').val(data.sifat_surat);
            $('[name="tujuan_surat"]').val(data.tujuan_surat);
            $('[name="perihal"]').val(data.perihal);
            $('[name="pengantar_surat"]').val(data.pengantar_surat);
            $('[name="nama_input"]').val(data.nama_input);
            $('[name="tgl_input"]').val(data.tgl_input);
            $('[name="keterangan"]').val(data.keterangan);
            $('#DetailSurat').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Detail Surat Masuk'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
      })
    }



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
        processing: true,
        serverSide: true,
        "ajax"    : '<?= base_url('user/surat/data'); ?>',
        "columns" : [
            {
              "data"      : null,
              "width"     : "20px",
              "sClass"    : "text-center",
              "orderable" : false,
            },
            { "data" : "tgl_surat"},
            { "data" : "asal_surat"},
            { "data" : "tujuan_surat",
              "width"   : "90px",
            },
            { "data" : "perihal",
              "width"   : "190px",
            },
            { "data" : "pengantar_surat",
              "width"   : "50px",
              "sClass"  : "text-center",
            },
            { "data"    : "aksi",
              "width"   : "30px",
              "sClass"  : "text-center",
            },
        ],
        order: [[1, 'desc']],
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


<script src="<?= base_url() ?>assets/gentelella/js/notify.js"></script>
<div class="modal fade" id="DetailSurat" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title">Form Detail Surat Masuk</h3>
            </div>
            <div class="modal-body form">
              <form class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Nomor Surat</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" name="no_surat" readonly="true" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Asal Surat</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" required="true" name="asal_surat" readonly="true" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Tanggal Surat</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input name="tgl_surat"  type="text" readonly="true" class="form-control" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Perihal Surat</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" required="true" name="perihal" readonly="true" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Sifat Surat</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" required="true" name="sifat_surat" readonly="true" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Ditujuan kepada</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" required="true" name="tujuan_surat" readonly="true" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Keterangan</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <textarea name="keterangan" class="form-control" readonly="true"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Pengantar Surat</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input type="text" required="true" name="pengantar_surat" readonly="true" class="form-control"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">Tanggal Input</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input name="tgl_input"  type="text" readonly="true" class="form-control" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12 col-xs-12">User Input</label>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <input name="nama_input"  type="text" readonly="true" class="form-control" >
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              </div>
              </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->