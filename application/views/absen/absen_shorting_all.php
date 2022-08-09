<!-- bootstrap-daterangepicker -->
<link href="<?= base_url() ?>assets/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

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
      <div class="col-md-5 col-sm-5 col-xs-12">
        <div class="x_panel tile">
          <div class="x_title">
            <h2>Data Karyawan Tidak Hadir Hari Ini</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <table class="table table-bordered table-striped" id="lookup5">
                <thead>
                  <tr>
                    <th width="30px">No</th>
                    <th width="120px">Karyawan</th>
                    <th width="120px">Status</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $hari   = date("Y-m-d"); 
                    $sql    = "SELECT aa.*, ak.id_karyawan, ak.nama_lengkap  
                                FROM abe_absen as aa, abe_karyawan as ak 
                                WHERE aa.status != 'masuk' AND aa.id_karyawan = ak.id_karyawan AND aa.tanggal = '$hari' ORDER BY aa.tanggal DESC";
                    $absen  = $this->db->query($sql)->result();
                    $no = 1;
                    foreach ($absen as $row) {
                        echo "<tr>
                            <td>$no</td>
                            <td>".ucfirst(strtolower($row->nama_lengkap))."</td>
                            <td>$row->status</td>
                            <td>$row->keterangan</td>
                            </tr>";                      
                          $no++;
                      }
                  ?>
                </tbody>
              </table>
          </div>
        </div>
      </div>
      <div class="col-md-7 col-sm-7 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Filter Data Kehadiran Karyawan</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Data Kehadiran per Lokasi & Department Karyawan</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Data Kehadiran per Karyawan</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                  <form class="form-horizontal">
                    <div class="control-group">
                      <div class="controls">
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Pilih Lokasi Kerja</label>
                          <div class="col-md-4 col-xs-12">
                            <select class="form-control" name="posisi" id="posisi">
                              <option value="">-- pilih lokasi --</option>
                              <option value="JAKARTA"> JAKARTA </option>
                              <option value="SURABAYA"> SURABAYA </option>
                              <option value="SAMARINDA"> SAMARINDA </option>
                              <option value="SAMPIT"> SAMPIT </option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Pilih Department</label>
                          <div class="col-md-4 col-xs-12">
                            <select class="form-control" name="department" id="department">
                              <option value="all">-- All Department --</option>
                              <option value="ACCOUNTING"> ACCOUNTING </option>
                              <option value="PAJAK"> PAJAK </option>
                              <option value="FINANCE"> FINANCE </option>
                              <option value="TAX"> TAX </option>
                              <option value="HRD"> HRD </option>
                              <option value="IT"> IT </option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Pilih Periode Kehadiran</label>
                          <div class="col-md-4 col-xs-12">
                            <select class="form-control" name="bulan1" id="bulan1">
                              <option value="all">-- pilih periode bulan --</option>
                              <option value="januari"> Januari </option>
                              <option value="februari"> Februari </option>
                              <option value="maret"> Maret </option>
                              <option value="april"> April </option>
                              <option value="mei"> Mei </option>
                              <option value="juni"> Juni </option>
                              <option value="juli"> Juli </option>
                              <option value="agustus"> Agustus </option>
                              <option value="september"> September </option>
                              <option value="oktober"> Oktober </option>
                              <option value="november"> November </option>
                              <option value="desember"> Desember </option>
                            </select>
                          </div>
                          <div class="col-md-2 col-xs-12">
                            <input type="text" class="form-control" value="2018" data-inputmask="'mask': '9999'" id="tahun1" name="tahun1" />
                          </div>
                        </div>                  
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12"></label>
                          <div class="col-md-5 col-sm-9 col-xs-9">
                            <button type="button" onclick="loadDataKehadiran()" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <p>&nbsp</p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                  <form class="form-horizontal">
                    <div class="control-group">
                      <div class="controls">
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Pilih Karyawan</label>
                          <div class="col-md-8 col-xs-12">
                            <div class="input-group">
                              <input type="text" name="id_karyawan" id="id_karyawan" value="" hidden="">
                              <input type="text" name="nama_karyawan" id="nama_karyawan" value="" readonly="" class="form-control" > 
                              <span class="help-block"></span>
                              <span class="input-group-btn">
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myKaryawan"><i class="fa fa-check"></i> Pilih Karyawan</button>
                              </span>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Pilih Periode Kehadiran</label>
                          <div class="col-md-5 col-xs-12">
                            <select class="form-control" name="bulan2" id="bulan2">
                              <option value="all">-- pilih periode bulan --</option>
                              <option value="januari"> Januari </option>
                              <option value="februari"> Februari </option>
                              <option value="maret"> Maret </option>
                              <option value="april"> April </option>
                              <option value="mei"> Mei </option>
                              <option value="juni"> Juni </option>
                              <option value="juli"> Juli </option>
                              <option value="agustus"> Agustus </option>
                              <option value="september"> September </option>
                              <option value="oktober"> Oktober </option>
                              <option value="november"> November </option>
                              <option value="desember"> Desember </option>
                            </select>
                          </div>
                          <div class="col-md-2 col-xs-12">
                            <input type="text" class="form-control" value="2018" data-inputmask="'mask': '9999'" id="tahun2" name="tahun2" />
                          </div>
                        </div>                   
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12"></label>
                          <div class="col-md-5 col-sm-9 col-xs-9">
                            <button type="button" onclick="loadDataKehadiranKaryawan()" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                <p>&nbsp</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Kehadiran Karyawan</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="data_kehadiran"></div>
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

  function loadDataKehadiranKaryawan(){
    var bulan =$("#bulan2").val();
    var tahun =$("#tahun2").val();
    var karyawan =$("#id_karyawan").val();
    $.ajax({
      type :'GET',
      url  :'<?= base_url('user/absen/dataKehadiranKaryawan') ?>',
      data :'bulan='+bulan+'&tahun='+tahun+'&karyawan='+karyawan,
      //data :'department='+department+'&jabatan='+jabatan,
      success:function(html){
        $("#data_kehadiran").html(html);
      }
    })
  }

  function loadDataKehadiran(){
    var bulan =$("#bulan1").val();
    var tahun =$("#tahun1").val();
    var posisi =$("#posisi").val();
    var department =$("#department").val();
    $.ajax({
      type :'GET',
      url  :'<?= base_url('user/absen/dataKehadiranAll') ?>',
      data :'bulan='+bulan+'&tahun='+tahun+'&posisi='+posisi+'&department='+department,
      //data :'department='+department+'&jabatan='+jabatan,
      success:function(html){
        $("#data_kehadiran").html(html);
      }
    })
  }
</script>


<!-- bootstrap-daterangepicker -->
<script src="<?= base_url() ?>assets/gentelella/vendors/moment/min/moment.min.js"></script>
<script src="<?= base_url() ?>assets/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

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

            $('.input-daterange').datepicker({
                format: "dd-mm-yyyy"
            });

            $('#daterange2').daterangepicker({
              format: 'DD-MM-YYYY'
          });
          });
  </script> 
<script src="<?= base_url() ?>assets/gentelella/js/notify.js"></script>
 
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
                            <th>Nama</th>
                            <th>Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            //$record_karyawan = $this->db->get('abe_karyawan');
                            $sql = "SELECT id_karyawan, nama_lengkap, jabatan, foto FROM abe_karyawan WHERE status = 'aktif'";
                            $record_karyawan = $this->db->query($sql);
                            foreach ($record_karyawan->result() as $p)
                            { 
                              echo "<tr class='pilih1' data-karyawan='$p->id_karyawan' data-karyawan2='$p->nama_lengkap'>
                                      <td>$no</td>
                                      <td>$p->nama_lengkap</td>";
                                      if($p->foto == ''){
                                        echo "<td><img src='../../assets/foto_karyawan/user.png' width='40px'></td></tr>";
                                      }else{
                                        echo "<td><img src='../../assets/foto_karyawan/$p->foto' width='40px'></td></tr>";
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