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
            <h2>Data Karyawan Non Aktif<small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <a class="btn btn-sm btn-warning" href="<?= base_url('hrd/karyawan') ?>"><i class="fa fa-reply"></i> Kembali</a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <table class="table table-bordered table-striped" id="lookup">
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
                <tbody>
                  <?php
                    $sql        = "SELECT * FROM view_karyawan_non_aktif";
                    $non_aktif  = $this->db->query($sql)->result();
                    $no = 1;
                    foreach ($non_aktif as $row) {
                      $cek_foto = $row->foto;
                      if($cek_foto == ''){
                        $foto = "<img src='../../assets/foto_karyawan/user.png' width='40px'>";
                      }else{
                        $foto = "<img src='../../assets/foto_karyawan/$cek_foto' width='40px'>";
                      }
                      echo "<tr>
                            <td>$no</td>
                            <td>$row->kode_karyawan</td>
                            <td>$row->nama_lengkap</td>
                            <td>$foto</td>
                            <td>$row->department</td>
                            <td>$row->jabatan</td>
                            <td>$row->status</td>
                            <td><a class='btn btn-xs btn-info' title='profile history' href=".base_url()."hrd/karyawan/profile_history/$row->id_karyawan><i class='fa fa-list'></i> Profile History</a>".anchor("hrd/karyawan/aktifkan/$row->id_karyawan" ,'<i class="fa fa-check"></i> aktifkan', array('class'=>'btn btn-warning btn-xs', 'title'=>'aktifkan kembali', 'onclick'=>'javasciprt: return confirm(\'Anda yakin ingin mengaktifkan kembali user ini !! \')'))."</td></tr>";                
                      $no++;
                    }
                  ?>
                </tbody>
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

    $(function () {
        $("#lookup").dataTable();
        $("#lookup2").dataTable(); 
        $("#lookup3").dataTable();
    });

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