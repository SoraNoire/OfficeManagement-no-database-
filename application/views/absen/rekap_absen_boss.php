<!-- bootstrap-daterangepicker -->
<link href="<?= base_url() ?>assets/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

<!-- Datatables -->
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css" rel="stylesheet">


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
            <h2>Rekap Data Kehadiran Karyawan</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Data Kehadiran Karyawan</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                  <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>hrd/boss_pintar/proses_rekap" >
                    <div class="control-group">
                      <div class="controls">
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Atur Tanggal Absensi</label>
                          <div class="col-md-4 col-xs-12">
                            <div class="controls">    
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" style="width: 200px" name="reservation" id="reservation" class="form-control" value="08/21/2019 - 09/20/2019" />
                                </div>
                            </div>
                          </div>
                        </div>        
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12"></label>
                          <div class="col-md-5 col-sm-9 col-xs-9">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-search"></i> Search</button>
                            <a href="<?= base_url('hrd/boss_pintar') ?>" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i> Kembali</a>
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
                <?php
                    $periode    = $this->session->userdata('periode');
                    //echo $periode;
                    if($periode == ''){
                    ?>
                    <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>Tanggal Absensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan=3>Belum ada data</td>
                        </tr>
                    </tbody>
                    <?php
                    }else{
                        //$periode    = $_GET['periode'];
                        $awal       = substr($periode, 0,10);
                        $tgl_awal   = date("Y-m-d",strtotime($awal));
                        $akhir      = substr($periode, 13);
                        $tgl_akhir  = date("Y-m-d",strtotime($akhir));
                        
                        $bulan      = substr($periode, 0,2); //mengambil bulan pada tanggal awal
                        $tahun	    = date("Y");
                        $jumlahhari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                        $tgl        = substr($periode, 3,2);
                        $tgl2       = substr($periode, 16,2);
                        $bulan_awal = substr($tgl_awal, 0,8);
                        $bulan_akhir= substr($tgl_akhir, 0,8);
                ?>
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <?php
                                for ($i=$tgl; $i < $jumlahhari+1; $i++) { 
                                    echo "<th>". $i ."</th>";
                                }
                                for ($j=1; $j < $tgl2+1; $j++){
                                    echo "<th>". $j ."</th>";
                                }
                            ?>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                        $sql    = "SELECT * FROM abe_absensi_boss_pintar WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' GROUP BY nik";
                        $absen  = $this->db->query($sql)->result();
                        $no = 1;
            foreach ($absen as $row) {
               echo "<tr>
                    <td>$no</td>
                    <td>$row->nama</td>";
                    $nik        = $row->nik;
                    for ($i=$tgl; $i < $jumlahhari+1; $i++) {
                        $tgl_absen  = $bulan_awal.$i;
                        $hari = date("D", strtotime($tgl_absen));
                        //echo $hari;
                        //echo $tgl_absen." - ";
                        $jam_awal   = $this->db->query("SELECT nik, tanggal, tgl_awal, tgl_akhir FROM abe_absensi_boss_pintar WHERE nik = $nik AND tanggal = '$tgl_absen' AND kategori = 'working' GROUP BY nik")->row_array();
                        $jam_masuk  = date('H:i', strtotime($jam_awal['tgl_awal']));
                        $jam_pulang = date('H:i', strtotime($jam_awal['tgl_akhir']));
                        if($jam_awal['tgl_awal'] == ''){
                            if($hari == 'Sat' OR $hari == 'Sun'){
                                echo "<td style='color:#FF0000'>Non</td>";
                            }else{
                                echo "<td>Non</td>";
                            }
                        }else{
                            echo "<td>".$jam_masuk."<br>".$jam_pulang."</td>";
                        }
                    }
                    for ($j=1; $j < $tgl2+1; $j++){
                        $tgl_absen  = $bulan_akhir.$j;
                        $hari = date("D", strtotime($tgl_absen));
                        //echo $tgl_absen." - ";
                        $jam_awal   = $this->db->query("SELECT nik, tanggal, tgl_awal, tgl_akhir FROM abe_absensi_boss_pintar WHERE nik = $nik AND tanggal = '$tgl_absen' AND kategori = 'working'")->row_array();
                        $jam_masuk  = date('H:i', strtotime($jam_awal['tgl_awal']));
                        $jam_pulang = date('H:i', strtotime($jam_awal['tgl_akhir']));
                        if($jam_awal['tgl_awal'] == ''){
                            if($hari == 'Sat' OR $hari == 'Sun'){
                                echo "<td style='color:#FF0000'>Non</td>";
                            }else{
                                echo "<td>Non</td>";
                            }
                        }else{
                            echo "<td>".$jam_masuk."<br>".$jam_pulang."</td>";
                        }
                    }
                    $no = $no + 1;
                echo "<td></td></tr><tr><td>".$no."</td><td>Keterlambatan</td>";
                $total_telat = 0;
                for ($i=$tgl; $i < $jumlahhari+1; $i++) {
                    $tgl_absen  = $bulan_awal.$i;
                    $hari = date("D", strtotime($tgl_absen));
                    //echo $hari;
                    //echo $tgl_absen." - ";
                    $jam_awal   = $this->db->query("SELECT nik, tanggal, tgl_awal, tgl_akhir FROM abe_absensi_boss_pintar WHERE nik = $nik AND tanggal = '$tgl_absen' AND kategori = 'working' GROUP BY nik")->row_array();
                    $jam_masuk  = date('H:i', strtotime($jam_awal['tgl_awal']));
                    $jam_pulang = date('H:i', strtotime($jam_awal['tgl_akhir']));
                    
                    if($jam_awal['tgl_awal'] == ''){
                        if($hari == 'Sat' OR $hari == 'Sun'){
                            echo "<td style='color:#FF0000'>Non</td>";
                        }else{
                            echo "<td>Non</td>";
                        }
                    }else{
                        if($jam_masuk >= '08:16'){
                            $telat = round((strtotime($jam_masuk) - strtotime('08:15'))/60, 1);
                            echo "<td style='color:#FF0000'>".$telat."</td>";
                            $total_telat = $total_telat + $telat;
                        }else{
                            echo "<td> - </td>";
                        }
                    }
                    
                }
                for ($j=1; $j < $tgl2+1; $j++){
                    $tgl_absen  = $bulan_akhir.$j;
                    $hari = date("D", strtotime($tgl_absen));
                    //echo $tgl_absen." - ";
                    $jam_awal   = $this->db->query("SELECT nik, tanggal, tgl_awal, tgl_akhir FROM abe_absensi_boss_pintar WHERE nik = $nik AND tanggal = '$tgl_absen' AND kategori = 'working'")->row_array();
                    $jam_masuk  = date('H:i', strtotime($jam_awal['tgl_awal']));
                    $jam_pulang = date('H:i', strtotime($jam_awal['tgl_akhir']));
                    if($jam_awal['tgl_awal'] == ''){
                        if($hari == 'Sat' OR $hari == 'Sun'){
                            echo "<td style='color:#FF0000'>Non</td>";
                        }else{
                            echo "<td>Non</td>";
                        }
                    }else{
                        if($jam_masuk >= '08:16'){
                            $telat = round((strtotime($jam_masuk) - strtotime('08:15'))/60, 1);
                            echo "<td style='color:#FF0000'>".$telat."</td>";
                            $total_telat = $total_telat + $telat;
                        }else{
                            echo "<td> - </td>";
                        }
                    }
                    
                }
                
                echo "<td>".$total_telat."</td></tr>";
                        
                        $no++;
            }
                        ?>
                    </tbody>
                </table>
                <?php
                    }
                ?>
            </div>
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

<!-- Datatables -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
              //  'copy', 'csv', 'excel', 'pdf', 'print'
              'excel'
            ]
        } );
    } );
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