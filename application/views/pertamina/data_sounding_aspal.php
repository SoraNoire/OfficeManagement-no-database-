 <!-- Datatables -->
 <link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css">
 <link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css">
 <link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css">
 <link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css">
 <link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css">

 <link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css">
 <!-- Custom Theme Style -->
 <link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css">

 <div class="right_col" role="main">
     <div class="">
         <div class="page-title">
             <div class="title_left">
                 <h3>Data Sounding Kapal</h3>
             </div>
         </div>
         <div class="clearfix"></div>
         <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="x_panel">
                     <div class="x_title">
                         <h2><small></small></h2>
                         <ul class="nav navbar-right panel_toolbox">
                             <button type='button' class="btn btn-sm btn-success" data-toggle="modal" data-target="#CreateSPK"><i class="fa fa-plus"></i> Sounding Tangki Aspal</button>
                         </ul>
                         <div class="clearfix"></div>
                     </div>
                     <?php if ($this->session->flashdata('sukses')) { ?>
                         <div class="alert alert-info alert-dismissible" role="alert">
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                             <p>
                                 <center><?php echo $this->session->flashdata('sukses'); ?></center>
                             </p>
                         </div>
                     <?php } ?>
                     <div class="x_content">
                         <table class="table table-bordered table-striped" id="lookup">
                             <thead>
                                 <tr>
                                     <th width="10px">No</th>
                                     <th width="50px">Tanggal</th>
                                     <th width="50px">Jam</th>
                                     <th width="100px">GW T-1 (Initial)</th>
                                     <th width="100px">GW T-2 (Initial)</th>
                                     <th width="100px">GW T-1 (Final)</th>
                                     <th width="100px">GW T-2 (Final)</th>
                                     <th>Total Received 1</th>
                                     <th>Total Received 2</th>
                                     <th width="50px">Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                    $hasil = $this->db->query("SELECT * FROM abe_tangki_hasil_sounding")->result();
                                    $no = 1;
                                    foreach ($hasil as $row) {
                                        $tr1    = $row->gross_weigh1 - $row->gross_weigh1f;
                                        $tr2    = $row->gross_weigh2 - $row->gross_weigh2f;
                                        $id     = $row->id;
                                        echo "
                                    <tr>
                                       <td>$no</td>
                                       <td>" . date('d F Y', strtotime($row->tanggal)) . "</td>
                                       <td>$row->jam</td>
                                       <td>" . number_format($row->gross_weigh1, 0, ',', '.') . "</td>
                                       <td>" . number_format($row->gross_weigh2, 0, ',', '.') . "</td>
                                       <td>" . number_format($row->gross_weigh1f, 0, ',', '.') . "</td>
                                       <td>" . number_format($row->gross_weigh2f, 0, ',', '.') . "</td>
                                       <td>" . number_format($tr1, 0, ',', '.') . "</td>
                                       <td>" . number_format($tr2, 0, ',', '.') . "</td>
                                       <td>";
                                    ?>
                                     <a href="" class="btn btn-info btn-xs" data-toggle="modal" data-target="#detail<?= $row->id; ?>"><i class="fa fa-eye"></i> Detail</a>
                                     <?php
                                        if ($row->status == 'initial') {
                                        ?>
                                         <a href="" class="btn btn-success btn-xs" data-toggle="modal" data-target="#tambahFinal<?= $row->id; ?>"><i class="fa fa-plus"></i> Final</a>
                                     <?php
                                        }
                                        ?>

                                 <?php
                                        echo "
                                       </td>
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
     $(function() {
         $("#lookup").dataTable();
         $("#lookup2").dataTable();
         $("#lookup3").dataTable();
     });
 </script>

 <!-- datepicker -->
 <script src="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker.min.js"></script>
 <script type="text/javascript">
     $(document).ready(function() {
         $('.tanggal').datepicker({
             format: "dd-mm-yyyy",
             //format: "yyyy-mm-dd",
             autoclose: true
         }).on('changeDate', function(ev) {
             var idnya = this.id; // baca ID masing2 tgl
             $("#berubah").html('<font color="red"><b>' + $('#' + idnya).val() + '</b></font>');
         });
     });
 </script>

 <script src="<?= base_url() ?>assets/gentelella/js/notify.js"></script>

 <div class="modal fade" id="CreateSPK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title" id="myModalLabel">Form Input Data Sounding Initial</h4>
             </div>
             <div class="modal-body">
                 <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/pertamina/add_sounding">
                     <div class="form-body">
                         <div class="form-group">
                             <label class="control-label col-md-2 col-sm-12 col-xs-12">Tanggal</label>
                             <div class="col-md-10 col-sm-12 col-xs-12">
                                 <input type="text" class="form-control" id="datepicker-example1" data-inputmask="'mask': '99-99-9999'" name="tanggal" placeholder="15-09-2020">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="control-label col-md-2 col-sm-12 col-xs-12">Jam</label>
                             <div class="col-md-10 col-sm-12 col-xs-12">
                                 <input type="text" class="form-control" data-inputmask="'mask': '99:99'" name="jam" placeholder="08:19">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="control-label col-md-2 col-sm-12 col-xs-12">Tangki 1</label>
                             <div class="col-md-4 col-sm-12 col-xs-12">
                                 <input type="text" class="form-control" name="tangki1" placeholder="satuan mm ex. 1420">
                             </div>
                             <label class="control-label col-md-3 col-sm-12 col-xs-12">Temperatur Atas</label>
                             <div class="col-md-3 col-sm-12 col-xs-12">
                                 <input type="text" class="form-control" name="temp_atas_1" placeholder="ex. 145.5">
                             </div>
                         </div>
                         <div class="form-group">

                             <label class="control-label col-md-9 col-sm-12 col-xs-12">Temperatur Bawah</label>
                             <div class="col-md-3 col-sm-12 col-xs-12">
                                 <input type="text" class="form-control" name="temp_bawah_1" placeholder="ex. 175.5">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="control-label col-md-2 col-sm-12 col-xs-12">Density 1</label>
                             <div class="col-md-10 col-sm-12 col-xs-12">
                                 <input type="text" class="form-control" name="density1" placeholder="ex. 1.0454">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="control-label col-md-2 col-sm-12 col-xs-12">Tangki 2</label>
                             <div class="col-md-4 col-sm-12 col-xs-12">
                                 <input type="text" class="form-control" name="tangki2" placeholder="satuan mm ex. 1540">
                             </div>
                             <label class="control-label col-md-3 col-sm-12 col-xs-12">Temperatur Atas</label>
                             <div class="col-md-3 col-sm-12 col-xs-12">
                                 <input type="text" class="form-control" name="temp_atas_2" placeholder="ex. 125.5">
                             </div>
                         </div>
                         <div class="form-group">

                             <label class="control-label col-md-9 col-sm-12 col-xs-12">Temperatur Bawah</label>
                             <div class="col-md-3 col-sm-12 col-xs-12">
                                 <input type="text" class="form-control" name="temp_bawah_2" placeholder="ex. 145.5">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="control-label col-md-2 col-sm-12 col-xs-12">Density 2</label>
                             <div class="col-md-10 col-sm-12 col-xs-12">
                                 <input type="text" class="form-control" name="density2" placeholder="1.4050">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="control-label col-md-3 col-sm-12 col-xs-12">SPL Terakhir</label>
                             <div class="col-md-9 col-sm-12 col-xs-12">
                                 <input type="text" class="form-control" name="spl">
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="control-label col-md-3 col-sm-12 col-xs-12">SPB Terakhir</label>
                             <div class="col-md-9 col-sm-12 col-xs-12">
                                 <input type="text" class="form-control" name="spb">
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Proses</button>
                         <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>

 <?php
    $detail = $this->db->query("SELECT * FROM abe_tangki_hasil_sounding")->result();
    foreach ($detail as $row) : ?>

     <div class="modal fade bs-example-modal-lg" id="detail<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog  modal-lg">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <h4 class="modal-title" id="myModalLabel">Detail Data Sounding</h4>
                 </div>
                 <div class="modal-body">
                     <form class="form-horizontal" method="" enctype="multipart/form-data">
                         <div class="form-body">
                             <table class="table table-bordered table-striped">
                                 <thead style="text-align: center;">
                                     <tr>
                                         <th rowspan="2" style="text-align: center;">No</th>
                                         <th rowspan="2" style="text-align: center;">ITEM</th>
                                         <th colspan="2" style="text-align: center;">Tangki 1</th>
                                         <th colspan="2" style="text-align: center;">Tangki 2</th>
                                     </tr>
                                     <tr>
                                         <th style="text-align: center;">Initial</th>
                                         <th style="text-align: center;">Final</th>
                                         <th style="text-align: center;">Initial</th>
                                         <th style="text-align: center;">Final</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <td>1</td>
                                         <td>Tanggal</td>
                                         <td><?= date('d F Y', strtotime($row->tanggal)) ?></td>
                                         <td><?= date('d F Y', strtotime($row->tanggalf)) ?></td>
                                         <td><?= date('d F Y', strtotime($row->tanggal)) ?></td>
                                         <td><?= date('d F Y', strtotime($row->tanggalf)) ?></td>
                                     </tr>
                                     <tr>
                                         <td>2</td>
                                         <td>Jam</td>
                                         <td><?= $row->jam ?></td>
                                         <td><?= $row->jamf ?></td>
                                         <td><?= $row->jam ?></td>
                                         <td><?= $row->jamf ?></td>
                                     </tr>
                                     <tr>
                                         <td>3</td>
                                         <td>Reference Height</td>
                                         <td>12650 mm</td>
                                         <td>12650 mm</td>
                                         <td>12670 mm</td>
                                         <td>12670 mm</td>
                                     </tr>
                                     <tr>
                                         <td>4</td>
                                         <td>Sounding / Ullage</td>
                                         <td><?= $row->tangki1 ?> mm</td>
                                         <td><?= $row->tangki1f ?> mm</td>
                                         <td><?= $row->tangki2 ?> mm</td>
                                         <td><?= $row->tangki2f ?> mm</td>
                                     </tr>
                                     <tr>
                                         <td>5</td>
                                         <td>Total Observed Volume</td>
                                         <td><?= number_format($row->total_obs_vol1, 1, ',', '.') ?> m<sup>3</sup></td>
                                         <td><?= number_format($row->total_obs_vol1f, 1, ',', '.') ?> m<sup>3</sup></td>
                                         <td><?= number_format($row->total_obs_vol2, 1, ',', '.') ?> m<sup>3</sup></td>
                                         <td><?= number_format($row->total_obs_vol2f, 1, ',', '.') ?> m<sup>3</sup></td>
                                     </tr>
                                     <tr>
                                         <td>6</td>
                                         <td>Shrinkage Factor</td>
                                         <td><?= $row->shrinkage1 ?> </td>
                                         <td><?= $row->shrinkage1f ?></td>
                                         <td><?= $row->shrinkage2 ?></td>
                                         <td><?= $row->shrinkage2f ?></td>
                                     </tr>
                                     <tr>
                                         <td>7</td>
                                         <td>Corr. Gross Observed Volume</td>
                                         <td><?= number_format($row->corr_gross_obs_vol1, 0, ',', '.') ?> m<sup>3</sup></td>
                                         <td><?= number_format($row->corr_gross_obs_vol1f, 0, ',', '.') ?> m<sup>3</sup></td>
                                         <td><?= number_format($row->corr_gross_obs_vol2, 0, ',', '.') ?> m<sup>3</sup></td>
                                         <td><?= number_format($row->corr_gross_obs_vol2f, 0, ',', '.') ?> m<sup>3</sup></td>
                                     </tr>
                                     <?php
                                        $cgov1 = $row->corr_gross_obs_vol1 - $row->corr_gross_obs_vol1f;
                                        $cgov2 = $row->corr_gross_obs_vol2 - $row->corr_gross_obs_vol2f;
                                        ?>
                                     <tr>
                                         <td><b>8</b></td>
                                         <td><b>Corr. Gross Observed Volume Received</b></td>
                                         <td colspan="2" style="text-align: center;"><b><?= number_format($cgov1, 0, ',', '.') ?> m<sup>3</sup></b></td>
                                         <td colspan="2" style="text-align: center;"><b><?= number_format($cgov2, 0, ',', '.') ?> m<sup>3</sup></b></td>
                                     </tr>
                                     <tr>
                                         <td>9</td>
                                         <td>Temperatur</td>
                                         <td><?= $row->temperatur1 ?> <sup>0</sup>C</td>
                                         <td><?= $row->temperatur1f ?> <sup>0</sup>C</td>
                                         <td><?= $row->temperatur2 ?> <sup>0</sup>C</td>
                                         <td><?= $row->temperatur2f ?> <sup>0</sup>C</td>
                                     </tr>
                                     <tr>
                                         <td>10</td>
                                         <td>Density at 15<sup>0</sup>C</td>
                                         <td><?= $row->density1 ?></td>
                                         <td><?= $row->density1f ?></td>
                                         <td><?= $row->density2 ?></td>
                                         <td><?= $row->density2f ?></td>
                                     </tr>
                                     <tr>
                                         <td>11</td>
                                         <td>VCF (T-54)</td>
                                         <td><?= $row->vcf1 ?></td>
                                         <td><?= $row->vcf1f ?></td>
                                         <td><?= $row->vcf2 ?></td>
                                         <td><?= $row->vcf2f ?></td>
                                     </tr>
                                     <tr>
                                         <td>12</td>
                                         <td>Gross Standard Volume</td>
                                         <td><?= number_format($row->gross_std_vol1, 0, ',', '.') ?> m<sup>3</sup></td>
                                         <td><?= number_format($row->gross_std_vol1f, 0, ',', '.') ?> m<sup>3</sup></td>
                                         <td><?= number_format($row->gross_std_vol2, 0, ',', '.') ?> m<sup>3</sup></td>
                                         <td><?= number_format($row->gross_std_vol2f, 0, ',', '.') ?> m<sup>3</sup></td>
                                     </tr>
                                     <?php
                                        $tgsv1 = $row->gross_std_vol1 - $row->gross_std_vol1f;
                                        $tgsv2 = $row->gross_std_vol2 - $row->gross_std_vol2f;
                                        ?>
                                     <tr>
                                         <td><b>13</b></td>
                                         <td><b>Total Gross Std Vol. Received</b></td>
                                         <td colspan="2" style="text-align: center;"><b><?= number_format($tgsv1, 0, ',', '.') ?> m<sup>3</sup></b></td>
                                         <td colspan="2" style="text-align: center;"><b><?= number_format($tgsv2, 0, ',', '.') ?> m<sup>3</sup></b></td>
                                     </tr>
                                     <tr>
                                         <td>14</td>
                                         <td>WCF (T-56)</td>
                                         <td><?= $row->wcf1 ?></td>
                                         <td><?= $row->wcf1f ?></td>
                                         <td><?= $row->wcf2 ?></td>
                                         <td><?= $row->wcf2f ?></td>
                                     </tr>
                                     <tr>
                                         <td>15</td>
                                         <td>Gross Weight</td>
                                         <td><?= number_format($row->gross_weigh1, 0, ',', '.') ?> m/t</td>
                                         <td><?= number_format($row->gross_weigh1f, 0, ',', '.') ?> m/t</td>
                                         <td><?= number_format($row->gross_weigh2, 0, ',', '.') ?> m/t</td>
                                         <td><?= number_format($row->gross_weigh2f, 0, ',', '.') ?> m/t</td>
                                     </tr>
                                     <?php
                                        $tgwr1 =  $row->gross_weigh1 - $row->gross_weigh1f;
                                        $tgwr2 =  $row->gross_weigh2 - $row->gross_weigh2f;
                                        ?>
                                     <tr>
                                         <td><b>16</b></td>
                                         <td><b>Gross Weight Received</b></td>
                                         <td colspan="2" style="text-align: center;"><b><?= number_format($tgwr1, 0, ',', '.') ?> m/t</b></td>
                                         <td colspan="2" style="text-align: center;"><b><?= number_format($tgwr2, 0, ',', '.') ?> m/t</b></td>
                                     </tr>
                                 </tbody>
                             </table>

                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 <?php endforeach; ?>

 <?php
    $detail = $this->db->query("SELECT * FROM abe_tangki_hasil_sounding")->result();
    foreach ($detail as $row) : ?>

     <div class="modal fade" id="tambahFinal<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <h4 class="modal-title" id="myModalLabel">Form Input Data Sounding Final</h4>
                 </div>
                 <div class="modal-body">
                     <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/pertamina/update_sounding">
                         <div class="form-body">
                             <div class="form-group">
                                 <input type="hidden" name="id_sounding" value="<?= $row->id ?>">
                                 <label class="control-label col-md-2 col-sm-12 col-xs-12">Tanggal</label>
                                 <div class="col-md-10 col-sm-12 col-xs-12">
                                     <input type="text" class="form-control" id="datepicker-example1" data-inputmask="'mask': '99-99-9999'" name="tanggal" placeholder="15-09-2020">
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label class="control-label col-md-2 col-sm-12 col-xs-12">Jam</label>
                                 <div class="col-md-10 col-sm-12 col-xs-12">
                                     <input type="text" class="form-control" data-inputmask="'mask': '99:99'" name="jam" placeholder="08:19">
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label class="control-label col-md-2 col-sm-12 col-xs-12">Tangki 1</label>
                                 <div class="col-md-4 col-sm-12 col-xs-12">
                                     <input type="text" class="form-control" name="tangki1" placeholder="satuan mm ex. 1420">
                                 </div>
                                 <label class="control-label col-md-3 col-sm-12 col-xs-12">Temperatur Atas</label>
                                 <div class="col-md-3 col-sm-12 col-xs-12">
                                     <input type="text" class="form-control" name="temp_atas_1" placeholder="ex. 145.5">
                                 </div>
                             </div>
                             <div class="form-group">

                                 <label class="control-label col-md-9 col-sm-12 col-xs-12">Temperatur Bawah</label>
                                 <div class="col-md-3 col-sm-12 col-xs-12">
                                     <input type="text" class="form-control" name="temp_bawah_1" placeholder="ex. 175.5">
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label class="control-label col-md-2 col-sm-12 col-xs-12">Density 1</label>
                                 <div class="col-md-10 col-sm-12 col-xs-12">
                                     <input type="text" class="form-control" name="density1" placeholder="ex. 1.0454">
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label class="control-label col-md-2 col-sm-12 col-xs-12">Tangki 2</label>
                                 <div class="col-md-4 col-sm-12 col-xs-12">
                                     <input type="text" class="form-control" name="tangki2" placeholder="satuan mm ex. 1540">
                                 </div>
                                 <label class="control-label col-md-3 col-sm-12 col-xs-12">Temperatur Atas</label>
                                 <div class="col-md-3 col-sm-12 col-xs-12">
                                     <input type="text" class="form-control" name="temp_atas_2" placeholder="ex. 125.5">
                                 </div>
                             </div>
                             <div class="form-group">

                                 <label class="control-label col-md-9 col-sm-12 col-xs-12">Temperatur Bawah</label>
                                 <div class="col-md-3 col-sm-12 col-xs-12">
                                     <input type="text" class="form-control" name="temp_bawah_2" placeholder="ex. 145.5">
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label class="control-label col-md-2 col-sm-12 col-xs-12">Density 2</label>
                                 <div class="col-md-10 col-sm-12 col-xs-12">
                                     <input type="text" class="form-control" name="density2" placeholder="1.4050">
                                 </div>
                             </div>
                         </div>
                         <div class="modal-footer">
                             <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Update</button>
                             <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>

 <?php endforeach; ?>