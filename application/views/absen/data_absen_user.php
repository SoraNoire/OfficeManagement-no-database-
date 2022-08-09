<!-- Datatables -->
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<link href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" rel="stylesheet">

  <script>
      function validasiFile(){
        var inputFile = document.getElementById('file');
        var pathFile = inputFile.value;
        var file_size = $('#file')[0].files[0].size;
        var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif|\.pdf)$/i;
        if(!ekstensiOk.exec(pathFile)){
            alert('Mohon maaf, file yang diperbolehkan untuk upload ( .jpg / .png / .jpeg / .pdf )');
            inputFile.value = '';
            return false;
        }else if(file_size > 4000000){
            alert('Mohon maaf, file yang diperbolehkan untuk upload maksimal 4 Mb');
            inputFile.value = '';
            return false;
        }
      }
  </script>

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3></h3>
      </div>
    </div>
 
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Kehadiran Anda <small></small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <table class="table table-bordered table-striped" id="lookup">
                <thead>
                  <tr>
                    <th width="20px">No</th>
                    <th width="70px">IP PC</th>
                    <th width="70px">Periode</th>
                    <th width="100px">Tanggal</th>
                    <th width="70px">Jam In</th>
                    <th width="70px">Jam Out</th>
                    <th width="90px">Status</th>
                    <th>Keterangan</th>
                    <th width="90px">Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $hari_indonesia = array('Monday'  => 'Senin',
                          'Tuesday'  => 'Selasa',
                          'Wednesday' => 'Rabu',
                          'Thursday' => 'Kamis',
                          'Friday' => 'Jumat',
                          'Saturday' => 'Sabtu',
                          'Sunday' => 'Minggu');
                    $id = $this->session->userdata('id_karyawan');
                    $sql = "SELECT * FROM abe_absen WHERE id_karyawan = $id ORDER BY tanggal DESC";
                    $tugas = $this->db->query($sql)->result();
                    $no = 1;
                    foreach ($tugas as $row) {
                      $hari   = date('l', strtotime($row->tanggal));
                      $jam_masuk   = date('H:i:s', strtotime($row->tgl_absen));
                      $jam_keluar  = date('H:i:s', strtotime($row->tgl_pulang));
                      if($jam_masuk == '01:00:00'){
                        $jam_in = "-";
                      }else{
                        $jam_in   = date('H:i:s', strtotime($row->tgl_absen));
                      } 
                      if($jam_keluar == '01:00:00'){
                        $jam_out = "-";
                      }else{
                        $jam_out   = date('H:i:s', strtotime($row->tgl_pulang));
                      }
                      echo "<tr>
                            <td>$no</td>
                            <td>$row->ip_pc</td>
                            <td>$row->periode</td>
                            <td>$hari_indonesia[$hari], ".date('d-m-Y', strtotime($row->tanggal))."</td>
                            <td>$jam_in</td>
                            <td>$jam_out</td>
                            <td>$row->status</td>
                            <td>$row->keterangan</td><td>";
                            $status = $row->status;
                            $surat = $row->lampiran;
                            if($status == 'sakit'){
                              if($surat == ''){
                                echo "<button class='btn btn-xs btn-success' onclick='add_lampiran(".$row->id_absen.")'><i class='fa fa-envelope'></i> Upload</button></td></tr> ";
                              }else{
                                echo "<a href='".base_url('assets/lampiran_sakit/')."".$row->lampiran."' target='blank' class='btn btn-xs btn-info' ><i class='fa fa-eye'></i> Surat</a></td></tr> ";
                              }                  
                            }else{
                              echo "<button class='btn btn-xs btn-warning' ><i class='fa fa-check'></i> Done</button></td></tr>";
                            }
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

<script type="text/javascript">

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

  function add_lampiran(id)
  {
      $('#form_surat')[0].reset(); // reset form on modals
      $('[name="id_absen"]').val(id);
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#Absen_sakit').modal('show'); // show bootstrap modal
  }

  function save()
  {
      $('#btnSave').text('saving...'); //change button text
      $('#btnSave').attr('disabled',true); //set button disable 
      var url = "<?php echo site_url('user/absen/upload_surat')?>";
      var formData = new FormData($('#form_surat')[0]);
      
      // ajax adding data to database
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
                $('#Absen_sakit').modal('hide');
                location.reload();
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

<div class="modal fade" id="Absen_sakit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:800px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Upload Surat Keterangan Sakit</h4>
            </div>
            <div class="modal-body">
              <form action="#" id="form_surat"  class="form-horizontal">
                <div class="form-body">
                  <input type="hidden" name="id_absen" >
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-12">Upload Surat Dokter</label>
                    <div class="col-md-9 col-sm-12">
                      <input type="file" id="file" name="file_lampiran" onchange="return validasiFile()" class="form-control" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-12"></label>
                    <div class="col-md-9 col-sm-12">
                      <p><i><strong>note : </strong><br>file yang di perbolehkan upload ( jpg / png / jpeg / pdf ) Size maks 4 Mb</i></p>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Upload</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              </div>
              </form>  
            </div>
        </div>
    </div>
</div>