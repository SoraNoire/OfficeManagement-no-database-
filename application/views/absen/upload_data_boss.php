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
            <h2>Data Absensi Boss Pintar <small></small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
          <a href="<?= base_url('hrd/boss_pintar/form_upload') ?>" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i> Import Data Excel</a>
          <a href="<?= base_url('hrd/boss_pintar/rekap_absen') ?>" class="btn btn-sm btn-primary"><i class="fa fa-book"></i> Rekap Absensi</a>
          <a href="<?= base_url('hrd/boss_pintar/form_upload_detail') ?>" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i> Import Data Detail Excel</a>
          <a href="<?= base_url('hrd/boss_pintar/rekap_absen_detail') ?>" class="btn btn-sm btn-primary"><i class="fa fa-book"></i> Rekap Absensi Detail</a>
          <!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
            <table class="table table-bordered table-striped" id="lookup">
              <thead>
                <tr>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Cabang</th>
                  <th>Kategori</th>
                  <th>Tanggal</th>
                  <th>Jam Awal</th>
                  <th>Jam Akhir</th>
                </tr>
              </thead>
              <tbody>
              <?php
              if( ! empty($absen)){ // Jika data pada database tidak sama dengan empty (alias ada datanya)
                foreach($absen as $data){ // Lakukan looping pada variabel siswa dari controller
                  echo "<tr>";
                  echo "<td>".$data->nik."</td>";
                  echo "<td>".$data->nama."</td>";
                  echo "<td>".$data->cabang."</td>";
                  echo "<td>".$data->kategori."</td>";
                  echo "<td>".$data->tanggal."</td>";
                  echo "<td>".$data->tgl_awal."</td>";
                  echo "<td>".$data->tgl_akhir."</td>";
                  echo "</tr>";
                }
              }else{ // Jika data tidak ada
                echo "<tr><td colspan='7'>Data tidak ada</td></tr>";
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

<script src="<?= base_url() ?>assets/gentelella/js/notify.js"></script>

<div class="modal fade" id="Absen_sakit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:800px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Upload File Excel Boss Pintar</h4>
            </div>
            <div class="modal-body">
              <form action="#" id="form_surat"  class="form-horizontal">
                <div class="form-body">
                  <input type="hidden" name="id_import" >
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-12">Pilih File Excel</label>
                    <div class="col-md-9 col-sm-12">
                      <input type="file" id="file" name="file_lampiran" onchange="return validasiFile()" class="form-control" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-12"></label>
                    <div class="col-md-9 col-sm-12">
                      <p><i><strong>note : </strong><br>file yang di perbolehkan upload hanya file hasil download Aplikasi Boss Pintar</i></p>
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