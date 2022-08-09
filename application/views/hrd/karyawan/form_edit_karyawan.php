<!-- Datatables 
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
-->

<!-- Datatables 
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/datatables/dataTables.bootstrap.css"/>
-->
<link href="<?= base_url() ?>assets/gentelella/datepicker/bootstrap-datepicker3.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" rel="stylesheet">

  <script>
      function tampilkanPreview(gambar,idpreview){
//                membuat objek gambar
          var gb = gambar.files;
          
//                loop untuk merender gambar
          for (var i = 0; i < gb.length; i++){
//                    bikin variabel
              var gbPreview = gb[i];
              var imageType = /image.*/;
              var preview=document.getElementById(idpreview);            
              var reader = new FileReader();
              
              if (gbPreview.type.match(imageType)) {
//                        jika tipe data sesuai
                  preview.file = gbPreview;
                  reader.onload = (function(element) { 
                      return function(e) { 
                          element.src = e.target.result; 
                      }; 
                  })(preview);

//                    membaca data URL gambar
                  reader.readAsDataURL(gbPreview);
              }else{
//                        jika tipe data tidak sesuai
                  alert("Type file tidak sesuai. Khusus image.");
              }
             
          }    
      }
  </script>

  <script type="text/javascript">
      function loadKabupaten()
      {
          var propinsi = $("#propinsi").val();
          $.ajax({
              type:'GET',
              url:"<?= base_url(); ?>hrd/karyawan/kabupaten",
              data:"id=" + propinsi,
              success: function(html)
              { 
                 $("#kabupatenArea").html(html);
              }
          }); 
      }

      function loadKabupaten2()
      {
          var propinsi = $("#propinsi2").val();
          $.ajax({
              type:'GET',
              url:"<?= base_url(); ?>hrd/karyawan/kabupaten2",
              data:"id=" + propinsi,
              success: function(html)
              { 
                 $("#kabupatenArea2").html(html);
              }
          }); 
      }

      function loadKecamatan()
      {
          var kabupaten = $("#kabupaten").val();
          $.ajax({
              type:'GET',
              url:"<?php echo base_url(); ?>hrd/karyawan/kecamatan",
              data:"id=" + kabupaten,
              success: function(html)
              { 
                  $("#kecamatanArea").html(html);
              }
          }); 
      }

      function loadKecamatan2()
      {
          var kabupaten = $("#kabupaten2").val();
          $.ajax({
              type:'GET',
              url:"<?php echo base_url(); ?>hrd/karyawan/kecamatan2",
              data:"id=" + kabupaten,
              success: function(html)
              { 
                  $("#kecamatanArea2").html(html);
              }
          }); 
      }

      function loadDesa()
      {
          var kecamatan = $("#kecamatan").val();
          $.ajax({
              type:'GET',
              url:"<?php echo base_url(); ?>hrd/karyawan/desa",
              data:"id=" + kecamatan,
              success: function(html)
              { 
                  $("#desaArea").html(html);
              }
          }); 
      }

      function loadDesa2()
      {
          var kecamatan = $("#kecamatan2").val();
          $.ajax({
              type:'GET',
              url:"<?php echo base_url(); ?>hrd/karyawan/desa2",
              data:"id=" + kecamatan,
              success: function(html)
              { 
                  $("#desaArea2").html(html);
              }
          }); 
      }
  </script>

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
            <h2>Form Edit Karyawan<small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <a class="btn btn-sm btn-warning" href="<?= base_url('hrd/karyawan') ?>"><i class="fa fa-reply"></i> Kembali</a>
            </ul>
            <div class="clearfix"></div>
            <?php if($this->session->flashdata('sukses')){ ?>
              <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p><center><?php echo $this->session->flashdata('sukses'); ?></center></p>
              </div>
            <?php } ?>
          </div>
          <div class="x_content">
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>hrd/karyawan/update_karyawan">
              <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Data Karyawan</a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Data Alamat</a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Data Gaji</a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Data Akun</a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Data Jobdesk</a>
                  </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group">
                          <h2>Upload Photo Karyawan</h2>
                            <div class="col-md-8">
                              <div class="thumbnail">
                                <div class="view view-first">
                                  <img id="preview" style="width: 100%; height: 200px ; display: block;" src="<?= base_url() ?>assets/foto_karyawan/<?= $record['foto'] ?>" alt="foto karyawan" />
                                </div>
                              </div>
                            </div>
                          <div class="col-md-12">
                              <input type="file" id="exampleInputFile" name="foto" accept="image/*" onchange="tampilkanPreview(this,'preview')" class="form-control">
                              <span class="help-block"></span>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <div class="form-body">
                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-12">Nama Lengkap</label>
                              <div class="col-md-9 col-sm-12">
                                  <input name="id_karyawan" value="<?= $record['id_karyawan']?>" type="hidden">
                                  <input name="nama_lengkap" value="<?= $record['nama_lengkap']?>" required="true" class="form-control" type="text">
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-12">NIK Karyawan</label>
                              <div class="col-md-9 col-sm-12">
                                  <input name="kode_karyawan" value="<?= $record['kode_karyawan']?>" required="true" class="form-control" type="text" data-inputmask="'mask': '9999999999999999999'">
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-12">Department</label>
                              <div class="col-md-5 col-sm-12">
                                  <?php
                                    echo cmb_dinamis('department','abe_department','nama_department','nama_department',$record['department']);
                                  ?>
                                  <span class="help-block"></span>
                              </div>
                              <div class="col-md-4 col-sm-12">
                                  <?php
                                    echo cmb_dinamis('jabatan','abe_jabatan','nama_jabatan','nama_jabatan',$record['jabatan']);
                                  ?>
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-12">Tempat / Tgl Lahir</label>
                              <div class="col-md-4 col-sm-12">
                                  <input name="tempat_lahir" required="true" value="<?= $record['tempat_lahir']?>" class="form-control" type="text">
                                  <span class="help-block"></span>
                              </div>
                              <div class="col-md-5 col-sm-12">
                                  <?php
                                    $tgl_lahir = date('d-m-Y', strtotime($record['tgl_lahir']));
                                  ?>
                                  <input name="tgl_lahir" required="true" value="<?= $tgl_lahir ?>" type="text" data-inputmask="'mask': '99-99-9999'" id="datepicker-example1" placeholder="pilih tanggal" class="form-control tanggal" >
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-12">NIK KTP</label>
                              <div class="col-md-9 col-sm-12">
                                  <input name="nik_ktp" value="<?= $record['nik_ktp']?>" required="true" class="form-control" type="text" data-inputmask="'mask': '9999999999999999'">
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-12">Nomor Telp.</label>
                              <div class="col-md-5 col-sm-12">
                                  <input name="phone" value="<?= $record['phone']?>" data-inputmask="'mask': '999999999999'"  class="form-control" type="text">
                                  <span class="help-block"></span>
                              </div>
                              <div class="col-md-4 col-sm-12">
                                  <input name="mobile" value="<?= $record['mobile']?>" data-inputmask="'mask': '999999999999'"  class="form-control" type="text">
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-12">Status Pernikahan</label>
                              <div class="col-md-9 col-sm-12">
                                  <select class="form-control" name="status_pernikahan">
                                    <option value="">-- pilih status --</option>
                                    <option value="single" <?php if($record['status_pernikahan'] == 'single') echo 'Selected="single"'; ?>> Single </option>
                                    <option value="nikah" <?php if($record['status_pernikahan'] == 'nikah') echo 'Selected="nikah"'; ?>> Menikah </option>
                                    <option value="janda" <?php if($record['status_pernikahan'] == 'janda') echo 'Selected="janda"'; ?>> Janda </option>
                                    <option value="duda" <?php if($record['status_pernikahan'] == 'duda') echo 'Selected="duda"'; ?>> Duda </option>
                                  </select>
                                  <span class="help-block"></span>
                              </div>
                          </div>
                      </div>
                    </div>
                    <p>&nbsp</p> 
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <h2>Data Sesuai KTP</h2><hr>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-12 col-xs-12">Propinsi</label>
                        <div class="col-md-5 col-sm-12 col-xs-12">
                          <?php
                            $id = $record['propinsi_ktp'];
                            $sql = $this->db->get_where('provinces',array('id'=>$id))->row_array();
                          ?>
                            <input name="propinsi_ktp" readonly="" value="<?= $sql['name']?>" class="form-control" type="text">
                        </div>
                        <div class="col-md-5 col-sm-12 col-xs-12">
                          <select  id="propinsi" name="propinsi_ktp" onchange="loadKabupaten()" class="form-control">
                            <?php
                              foreach ($propinsi->result() as $p) {
                                  echo "<option value='$p->id'>$p->name</option>";
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-12 col-xs-12">Kabupaten</label>
                        <div class="col-md-5 col-sm-12 col-xs-12">
                          <?php
                            $id = $record['kabupaten_ktp'];
                            $sql = $this->db->get_where('regencies',array('id'=>$id))->row_array();
                          ?>
                            <input name="kabupaten_ktp" readonly="" value="<?= $sql['name']?>" class="form-control" type="text">
                        </div>
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div id="kabupatenArea"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-12 col-xs-12">Kecamatan</label>
                        <div class="col-md-5 col-sm-12 col-xs-12">
                          <?php
                            $id = $record['kecamatan_ktp'];
                            $sql = $this->db->get_where('districts',array('id'=>$id))->row_array();
                          ?>
                            <input name="kecamatan_ktp" readonly="" value="<?= $sql['name']?>" class="form-control" type="text">
                        </div>
                        <div class="col-md-5 col-sm-12 col-xs-12">
                          <div id="kecamatanArea"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-12 col-xs-12">Desa</label>
                        <div class="col-md-5 col-sm-12 col-xs-12">
                          <?php
                            $id = $record['desa_ktp'];
                            $sql = $this->db->get_where('villages',array('id'=>$id))->row_array();
                          ?>
                            <input name="desa_ktp" readonly="" value="<?= $sql['name']?>" class="form-control" type="text">
                        </div>
                        <div class="col-md-5 col-sm-12 col-xs-12">
                          <div id="desaArea"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-12 col-xs-12">Nama Jalan</label>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                          <textarea class="form-control" required="true" name="alamat_ktp"><?= $record['alamat_ktp']?></textarea>
                          <span class="help-block"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <h2>Data Tinggal Sekarang</h2><hr>
                      <div class="form-body">
                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-12 col-xs-12">Propinsi</label>
                          <div class="col-md-5 col-sm-12 col-xs-12">
                            <?php
                              $id = $record['propinsi'];
                              $sql = $this->db->get_where('provinces',array('id'=>$id))->row_array();
                            ?>
                              <input name="propinsi" readonly="" value="<?= $sql['name']?>" class="form-control" type="text">
                          </div>
                          <div class="col-md-5 col-sm-12 col-xs-12">
                            <select id="propinsi2" name="propinsi" onchange="loadKabupaten2()" class="form-control">
                              <?php
                                foreach ($propinsi2->result() as $p2) {
                                    echo "<option value='$p2->id'>$p2->name</option>";
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-12 col-xs-12">Kabupaten</label>
                          <div class="col-md-5 col-sm-12 col-xs-12">
                            <?php
                              $id = $record['kabupaten'];
                              $sql = $this->db->get_where('regencies',array('id'=>$id))->row_array();
                            ?>
                              <input name="kabupaten" readonly="" value="<?= $sql['name']?>" class="form-control" type="text">
                          </div>
                          <div class="col-md-5 col-sm-12 col-xs-12">
                            <div id="kabupatenArea2"></div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-12 col-xs-12">Kecamatan</label>
                          <div class="col-md-5 col-sm-12 col-xs-12">
                            <?php
                              $id = $record['kecamatan'];
                              $sql = $this->db->get_where('districts',array('id'=>$id))->row_array();
                            ?>
                              <input name="kecamatan" readonly="" value="<?= $sql['name']?>" class="form-control" type="text">
                          </div>
                          <div class="col-md-5 col-sm-12 col-xs-12">
                            <div id="kecamatanArea2"></div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-12 col-xs-12">Desa</label>
                          <div class="col-md-5 col-sm-12 col-xs-12">
                            <?php
                              $id = $record['desa'];
                              $sql = $this->db->get_where('villages',array('id'=>$id))->row_array();
                            ?>
                              <input name="desa" readonly="" value="<?= $sql['name']?>" class="form-control" type="text">
                          </div>
                          <div class="col-md-5 col-sm-12 col-xs-12">
                            <div id="desaArea2"></div>
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-12 col-xs-12">Nama Jalan</label>
                            <div class="col-md-9 col-sm-12 col-xs-12">
                              <textarea class="form-control" required="true" name="alamat"><?= $record['alamat']?></textarea>
                              <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Hubungan Kerabat</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <input name="hubungan_kerabat" value="<?= $record['hubungan_kerabat']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Nama Kerabat Dekat</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <input name="nama_kerabat" value="<?= $record['nama_kerabat']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Nomor Telp. Kerabat</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <input name="tlpn_kerabat" value="<?= $record['tlpn_kerabat']?>" data-inputmask="'mask': '999999999999'"  class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div> 
                      </div>
                  </div>
                  <p>&nbsp</p>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <h2>Data Perusahaan</h2><hr>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Tanggal Masuk</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <?php
                                $tgl_masuk = date('d-m-Y', strtotime($record['tgl_gabung']));
                              ?>
                              <input name="tgl_gabung"  type="text" value="<?= $tgl_masuk ?>" data-inputmask="'mask': '99-99-9999'" id="datepicker-example1" class="form-control tanggal" id="datepicker-example1" >
                              <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-12 col-xs-12">Nama Perusahaan</label>
                            <div class="col-md-8 col-sm-12 col-xs-12">
                                <?php
                                  echo cmb_dinamis('id_pt','abe_pt','nama_pt','id_pt',$record['id_pt']);
                                ?>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-12 col-xs-12">Lokasi Karyawan</label>
                            <div class="col-md-8 col-sm-12 col-xs-12">
                                <?php
                                  echo cmb_dinamis('posisi','abe_kota','nama_kota','nama_kota',$record['posisi']);
                                ?>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <h2>Data Gaji</h2><hr>
                      <div class="form-body">
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Gaji Pokok</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <input name="gapok" value="<?= $record['gapok']?>" id="harga" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">A/C Rekening</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <input name="ac_rekening" value="<?= $record['ac_rekening']?>" data-inputmask="'mask': '9999999999'"  class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">A/N Rekening</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <input name="an_rekening" value="<?= $record['an_rekening']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-12 col-xs-12">Catatan</label>
                            <div class="col-md-8 col-sm-12 col-xs-12">
                              <textarea class="form-control" name="catatan"><?= $record['catatan']?></textarea>
                              <span class="help-block"></span>
                            </div>
                        </div>
                        
                        
                      </div>
                    </div>
                  <p>&nbsp</p>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <h2>Data BPJS</h2><hr>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">BPJS Jamsostek</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                                <select class="form-control" name="jmst">
                                  <option value="no" <?php if($record['jmst'] == 'no') echo 'Selected="no"'; ?>>NO</option>
                                  <option value="yes" <?php if($record['jmst'] == 'yes') echo 'Selected="yes"'; ?>>YES</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">BPJS Kesehatan</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                                <select class="form-control" name="ksht">
                                  <option value="no" <?php if($record['ksht'] == 'no') echo 'Selected="no"'; ?>>NO</option>
                                  <option value="yes" <?php if($record['ksht'] == 'yes') echo 'Selected="yes"'; ?>>YES</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">BPJS JKK</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                                <select class="form-control" name="jkk">
                                  <option value="PRDG" <?php if($record['jkk'] == 'prdg') echo 'Selected="prdg"'; ?>>PRDG</option>
                                  <option value="EXPD" <?php if($record['jkk'] == 'expd') echo 'Selected="expd"'; ?>>EXPD</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Nomor JPK</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <input name="nomor_jpk" value="<?= $record['nomor_jpk']?>" data-inputmask="'mask': '9999999999999999'"  class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div> 
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <h2>Data Pajak</h2><hr>
                      <div class="form-body">
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Status Tanggungan</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <?php
                                $kalimat = $record['tanggungan'];
                                $tanggungan = substr($kalimat,-1);
                              ?>
                                <select class="form-control" name="tanggungan">
                                  <option value="0" <?php if($tanggungan == '0') echo 'Selected="0"'; ?>>0 (tidak ada)</option>
                                  <option value="1" <?php if($tanggungan == '1') echo 'Selected="1"'; ?>>1 (satu)</option>
                                  <option value="2" <?php if($tanggungan == '2') echo 'Selected="2"'; ?>>2 (dua)</option>
                                  <option value="3" <?php if($tanggungan == '3') echo 'Selected="3"'; ?>>3 (tiga)</option>
                                  <option value="4" <?php if($tanggungan == '4') echo 'Selected="4"'; ?>>4 (empat)</option>
                                  <option value="5" <?php if($tanggungan == '5') echo 'Selected="5"'; ?>>5 (lima)</option>
                                  <option value="6" <?php if($tanggungan == '6') echo 'Selected="6"'; ?>>6 (enam)</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">NPWP</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                                <select class="form-control" name="npwp">
                                  <option value="no" <?php if($record['npwp'] == 'no') echo 'Selected="no"'; ?>>NO</option>
                                  <option value="yes" <?php if($record['npwp'] == 'yes') echo 'Selected="yes"'; ?>>YES</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Nomor NPWP</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <input name="nomor_npwp" value="<?= $record['nomor_npwp']?>" data-inputmask="'mask': '999999999999999'"  class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">GJ DR GP</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                                <select class="form-control" name="gjdrgp">
                                  <option value="no" <?php if($record['gjdrgp'] == 'no') echo 'Selected="no"'; ?>>NO</option>
                                  <option value="yes" <?php if($record['gjdrgp'] == 'yes') echo 'Selected="yes"'; ?>>YES</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div> 
                      </div>
                    </div>
                  <p>&nbsp</p>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                        <a href="#" class="btn btn-sm btn-success" onclick="add_jobdesk()"><i class="glyphicon glyphicon-plus"></i> Jobdesk</a>
                        <div class="x_content">
                          <div class="table-responsive">
                          <div id="table_jobdesk"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <p>&nbsp</p>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" id="btnSave" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Update</button>
                  <a target="blank" href="<?= base_url('hrd/karyawan/print_pdf/').$record['id_karyawan'] ?>" class="btn btn-sm btn-primary" ><i class="fa fa-print"></i> Print</a>
              </div>
            </form>
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


<!--
<script src="<?= base_url() ?>assets/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?= base_url() ?>assets/gentelella/vendors/jszip/dist/jszip.min.js"></script>
-->

<script type="text/javascript">
  var save_method; //for save method string
  var table;
  var base_url = '<?= base_url();?>';
  //loadDataPeserta();
  //loadDataMengetahui();
  var id_karyawan = '<?= $this->uri->segment(4); ?>';
  loadDataJobdesk(id_karyawan);
  
  function add_jobdesk()
  {
      save_method = 'add_jobdesk';
      $('#form2')[0].reset(); // reset form on modals
      //$('[name="nama"]').val();
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#lampiran_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Jobdesk'); // Set Title to Bootstrap modal title
      //$('#btnSave2').text('Save');
  }

  function save()
  {
      //$('#btnSave').text('saving...'); //change button text
      //$('#btnSave').attr('disabled',true); //set button disable 
      var url;
      url = "<?php echo site_url('hrd/karyawan/add_jobdesk/')?>";
      var formData = new FormData($('#form2')[0]);
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
              $('#lampiran_form').modal('hide');
              loadDataJobdesk(id_karyawan);
              sukses_tambah_jobdesk();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            //$('#btnSave').text('save'); //change button text
            //$('#btnSave').attr('disabled',false); //set button enable 
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error adding / update data');
              //$('#btnSave').text('save'); //change button text
              //$('#btnSave').attr('disabled',false); //set button enable 
          }
      });
  }

 function loadDataJobdesk($no){
    var id_karyawan = $no;
    $.ajax({
      type :'GET',
      url  :'<?= base_url('hrd/karyawan/dataJobdesk') ?>',
      data :'id_karyawan='+id_karyawan,
      success:function(html){
        $("#table_jobdesk").html(html);
      }
    })
  }

  function delete_jobdesk(id)
  {
      if(confirm('Anda yakin ingin menghapus Jobdesk ini?'))
      {
          // ajax delete data to database
          $.ajax({
              url : "<?php echo site_url('hrd/karyawan/hapus_jobdesk')?>/"+id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                  loadDataJobdesk(id_karyawan);
                  sukses_hapus_jobdesk();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error deleting data');
              }
          });
      }
  }

  function sukses_tambah_jobdesk()
  {
     $(document).ready(function (){
        $.notify("Data Jobdesk telah ditambahkan","success");
          });
  }

  function sukses_hapus_jobdesk()
  {
     $(document).ready(function (){
        $.notify("Data Jobdesk telah dihapus","warning");
          });
  }

</script>

<script src="<?= base_url() ?>assets/gentelella/js/jquery.priceformat.min.js"></script>
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

        $('#harga').priceFormat({
          prefix: 'Rp ',
          centsLimit: 0,
          centsSeparator: ',',
          thousandsSeparator: '.'
        });
  </script> 
<script src="<?= base_url() ?>assets/gentelella/js/notify.js"></script>
 <div class="modal fade" id="lampiran_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Jobdesk Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form2"  class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                      <input type="hidden" name="id_karyawan" value="<?= $this->uri->segment(4) ?>" class="form-control" readonly="true" >
                      <input type="hidden" name="id_input" value="<?= $this->session->userdata('id_karyawan') ?>" class="form-control" readonly="true" >
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-12">Detail Jobdesk</label>
                        <div class="col-md-9 col-sm-12">
                          <textarea class="form-control" placeholder="detail jobdesk" name="detail"></textarea>
                        </div>
                      </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave2" onclick="save()" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> save</button>
                <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal"><i class="fa fa-close"></i> cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->