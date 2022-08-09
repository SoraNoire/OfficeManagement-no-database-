<link href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" rel="stylesheet">

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Form Permintaan Pembelian</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>permintaan/pr/proses_menyetujui">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <button type="button" class="btn btn-sm btn-warning" onclick="javascript:history.back()"><i class="fa fa-reply"></i> Kembali</button>
              <button type="button" class="btn btn-sm btn-primary"><?= date('d M Y',strtotime($record['tgl_pr'])); ?></button>
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
                    <input type="hidden" name="id_permintaan" value="<?= $record['id_permintaan']; ?>">
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
                  <label class="control-label col-md-3 col-sm-12 col-xs-12">Status Keputusan</label>
                  <div class="col-md-9 col-sm-12 col-xs-12">
                    <select class="form-control" name="status" required="true">
                      <option value="">-- pilih keputusan --</option>
                      <option value="disetujui">Disetujui</option>
                      <option value="ditolak">Ditolak</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-12 col-xs-12">Catatan</label>
                  <div class="col-md-9 col-sm-12 col-xs-12">
                    <textarea style='resize:none; height:100px;' class="form-control" name="catatan"> <?= $record['catatan'] ?></textarea> 
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pull-right" >
                <button type="submit" name="submit" class="btn btn-sm btn-success pull-right"><i class="fa fa-save"></i> Proses Permintaan</button>
            </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
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
                  <th style="text-align: center" width="100">Jumlah</th>
                  <th style="text-align: center" width="100">Unit</th>
                  <th style="text-align: center">Keterangan</th>
                  <th style="text-align: center" width="100">Aksi</th>
                </tr>
              </thead>
              <tbody id="table-details">
                <?php
                  //$this->load->database();
                  $id = $record['no_pr'];
                  $sql = "SELECT * FROM abe_permintaan_detail WHERE no_pr = '$id' AND status != 'tolak'"; 
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
                        <td><button type='button' onclick='ubah_permintaan_detail($r->id_pr_detail)' class='btn btn-xs btn-danger' title='tolak'><i class='fa fa-ban'> Tolak</i></button></td>
                    </tr>
                    ";
                    $no++;
                  }
                ?>
              </tbody>
            </table>
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

<script type="text/javascript">
   
  function ubah_permintaan_detail(id)
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
              $('.modal-title').text('Ubah Status'); // Set title to Bootstrap modal title
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }

</script>

<script src="<?= base_url() ?>assets/gentelella/js/notify.js"></script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Kantor Form</h3>
            </div>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>permintaan/pr/tolak_detail">
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
                      <div class="col-md-9">
                          <input name="jumlah" id="jumlah" readonly="true" class="form-control" type="text">
                          <span class="help-block"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Unit Barang</label>
                      <div class="col-md-9">
                          <input name="unit" id="unit" readonly="true" class="form-control" type="text">
                          <span class="help-block"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Keterangan</label>
                      <div class="col-md-9">
                        <textarea class="form-control" name="keterangan" id="keterangan" readonly="true"></textarea>
                        <span class="help-block"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Status Barang</label>
                      <div class="col-md-9">
                          <input name="status" id="status" readonly="true" value="tolak" class="form-control" type="text">
                          <span class="help-block"></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3">Keterangan Status</label>
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