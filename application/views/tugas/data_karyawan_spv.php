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
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Filter Data Tugas Harian</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal">
                <div class="control-group">
                  <div class="controls">
                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-12 col-xs-12">Pilih Karyawan</label>
                      <div class="col-md-4 col-xs-12">
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
                    <div class="input-daterange input-group" id="datepicker">
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-12 col-xs-12">Tanggal Awal</label>
                        <div class="col-md-2 col-sm-9 col-xs-9">
                          <input type="text" class="form-control" data-inputmask="'mask': '99-99-9999'" id="start" name="start" />
                        </div>
                        <div class="col-md-2 col-sm-9 col-xs-9">
                          <input type="text" class="form-control" data-inputmask="'mask': '99-99-9999'" id="end" name="end" />
                        </div>
                      </div>
                    </div>
                    <!--
                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-12 col-xs-12">Pilih Tanggal</label>
                      <div class="col-md-5 col-xs-12">
                        <div class="input-prepend input-group">
                            <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                            <input readonly="" type="text" id="daterange2" data-inputmask="'mask': '99-99-9999 - 99-99-9999'" style="width: 200px" name="reservation" id="" class="form-control" value="10-11-2017 - 10-11-2017" />
                          </div>
                      </div>
                    </div>
                    -->                     
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-12 col-xs-12"></label>
                        <div class="col-md-5 col-sm-9 col-xs-9">
                          <button type="button" onclick="loadDataKaryawan()" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
                        </div>
                      </div>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Tugas Harian</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="data_tugas"></div>
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

  function loadDataKaryawan(){
    var start =$("#start").val();
    var end =$("#end").val();
    var karyawan =$("#id_karyawan").val();
    $.ajax({
      type :'GET',
      url  :'<?= base_url('tugas/data_harian/dataTugas') ?>',
      data :'start='+start+'&end='+end+'&karyawan='+karyawan,
      //data :'department='+department+'&jabatan='+jabatan,
      success:function(html){
        $("#data_tugas").html(html);
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
                            $department = $this->session->userdata('department');
                            $jabatan = $this->session->userdata('jabatan');
                            if($department == 'ACCOUNTING'){
                              $sql = "SELECT * FROM abe_karyawan WHERE department != 'TAX' AND jabatan != 'manager'";
                            }else{
                              $sql = "SELECT * FROM abe_karyawan WHERE department = '$department' AND jabatan != 'manager'";
                            }
                            
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