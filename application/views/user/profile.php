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
        <h3><i class="fa fa-user"></i> Profile</h3>
      </div>
    </div>
    <?php
      $id = $this->session->userdata('id_karyawan');
      $sql = "SELECT * FROM abe_karyawan WHERE id_karyawan = $id";
      $record = $this->db->query($sql)->row_array();
    ?>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>User Profile<small></small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
              <div class="profile_img">
                <div id="crop-avatar">
                  <!-- Current avatar -->
                  <img class="img-responsive img-thumbnail avatar-view" style="width: 80%" src="<?= base_url() ?>assets/foto_karyawan/<?= $record['foto']?>" alt="Avatar" title="foto user">
                </div>
              </div>
              <h3><?= $record['nama_lengkap']?></h3>

              <ul class="list-unstyled user_data">
                <li><i class="fa fa-briefcase user-profile-icon"></i> <?= $record['department'] ?> - <?= $record['jabatan'] ?></li>
                <li><i class="fa fa-phone user-profile-icon"></i> <?= $record['mobile'] ?></li>
              </ul>

              <a class="btn btn-success" href="<?= base_url('user/profile/ubah_password') ?>"><i class="fa fa-edit m-right-xs"></i> Ubah Password</a>

            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
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
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-body">
                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-12">Nama Lengkap</label>
                              <div class="col-md-9 col-sm-12">
                                  <input readonly="true" value="<?= $record['nama_lengkap']?>" class="form-control" type="text">
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-12">NIK Karyawan</label>
                              <div class="col-md-9 col-sm-12">
                                  <input readonly="true" value="<?= $record['kode_karyawan']?>" class="form-control" type="text" >
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-12">Department</label>
                              <div class="col-md-5 col-sm-12">
                                  <input readonly="true" value="<?= $record['department']?>" class="form-control" type="text" >
                                  <span class="help-block"></span>
                              </div>
                              <div class="col-md-4 col-sm-12">
                                  <input readonly="true" value="<?= $record['jabatan']?>" class="form-control" type="text" >
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-12">Tempat / Tgl Lahir</label>
                              <div class="col-md-4 col-sm-12">
                                  <input readonly="true" value="<?= $record['tempat_lahir']?>" class="form-control" type="text">
                                  <span class="help-block"></span>
                              </div>
                              <div class="col-md-5 col-sm-12">
                                  <?php
                                    $tgl_lahir = date('d-m-Y', strtotime($record['tgl_lahir']));
                                  ?>
                                  <input readonly="true" value="<?= $tgl_lahir ?>" type="text" class="form-control" >
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-12">NIK KTP</label>
                              <div class="col-md-9 col-sm-12">
                                  <input readonly="true" value="<?= $record['nik_ktp']?>" class="form-control" type="text">
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-12">Nomor Telp.</label>
                              <div class="col-md-5 col-sm-12">
                                  <input readonly="true" value="<?= $record['phone']?>" class="form-control" type="text">
                                  <span class="help-block"></span>
                              </div>
                              <div class="col-md-4 col-sm-12">
                                  <input readonly="true" value="<?= $record['mobile']?>" class="form-control" type="text">
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-12">Status Pernikahan</label>
                              <div class="col-md-9 col-sm-12">
                                  <input readonly="true" value="<?= $record['status_pernikahan']?>" class="form-control" type="text">
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
                        <label class="control-label col-md-3 col-sm-12 col-xs-12">Propinsi</label>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                          <?php
                            $id = $record['propinsi_ktp'];
                            $sql = $this->db->get_where('provinces',array('id'=>$id))->row_array();
                          ?>
                            <input name="propinsi_ktp" readonly="" value="<?= $sql['name']?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-12 col-xs-12">Kabupaten</label>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                          <?php
                            $id = $record['kabupaten_ktp'];
                            $sql = $this->db->get_where('regencies',array('id'=>$id))->row_array();
                          ?>
                            <input name="kabupaten_ktp" readonly="" value="<?= $sql['name']?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-12 col-xs-12">Kecamatan</label>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                          <?php
                            $id = $record['kecamatan_ktp'];
                            $sql = $this->db->get_where('districts',array('id'=>$id))->row_array();
                          ?>
                            <input name="kecamatan_ktp" readonly="" value="<?= $sql['name']?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-12 col-xs-12">Desa</label>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                          <?php
                            $id = $record['desa_ktp'];
                            $sql = $this->db->get_where('villages',array('id'=>$id))->row_array();
                          ?>
                            <input name="desa_ktp" readonly="" value="<?= $sql['name']?>" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-12 col-xs-12">Nama Jalan</label>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                          <textarea class="form-control" readonly="true" name="alamat_ktp"><?= $record['alamat_ktp']?></textarea>
                          <span class="help-block"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <h2>Data Tinggal Sekarang</h2><hr>
                      <div class="form-body">
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Propinsi</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                            <?php
                              $id = $record['propinsi'];
                              $sql = $this->db->get_where('provinces',array('id'=>$id))->row_array();
                            ?>
                              <input name="propinsi" readonly="" value="<?= $sql['name']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Kabupaten</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                            <?php
                              $id = $record['kabupaten'];
                              $sql = $this->db->get_where('regencies',array('id'=>$id))->row_array();
                            ?>
                              <input name="kabupaten" readonly="" value="<?= $sql['name']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Kecamatan</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                            <?php
                              $id = $record['kecamatan'];
                              $sql = $this->db->get_where('districts',array('id'=>$id))->row_array();
                            ?>
                              <input name="kecamatan" readonly="" value="<?= $sql['name']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Desa</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                            <?php
                              $id = $record['desa'];
                              $sql = $this->db->get_where('villages',array('id'=>$id))->row_array();
                            ?>
                              <input name="desa" readonly="" value="<?= $sql['name']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-12 col-xs-12">Nama Jalan</label>
                            <div class="col-md-8 col-sm-12 col-xs-12">
                              <textarea class="form-control" readonly="true" name="alamat"><?= $record['alamat']?></textarea>
                              <span class="help-block"></span>
                            </div>
                        </div>
                       
                      </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Hubungan Kerabat</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <input readonly="true" value="<?= $record['hubungan_kerabat']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Nama Kerabat Dekat</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <input readonly="true" value="<?= $record['nama_kerabat']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Nomor Telp. Kerabat</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <input readonly="true" value="<?= $record['tlpn_kerabat']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div> 
                  </div>
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
                              <input readonly="true" type="text" value="<?= $tgl_masuk ?>" class="form-control">
                              <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-12 col-xs-12">Nama Perusahaan</label>
                            <div class="col-md-8 col-sm-12 col-xs-12">
                              <?php
                                $id = $record['id_pt'];
                                $sql = "SELECT id_pt, nama_pt FROM abe_pt WHERE id_pt = $id";
                                $pt = $this->db->query($sql)->row_array();
                              ?>
                                <input readonly="true" type="text" value="<?= $pt['nama_pt'] ?>" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-12 col-xs-12">Lokasi Karyawan</label>
                            <div class="col-md-8 col-sm-12 col-xs-12">
                              <input readonly="true" type="text" value="<?= $record['posisi'] ?>" class="form-control">
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
                              <input readonly="true" value="<?= $record['gapok']?>" id="harga" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">A/C Rekening</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <input readonly="true" value="<?= $record['ac_rekening']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">A/N Rekening</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <input readonly="true" value="<?= $record['an_rekening']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-12 col-xs-12">Catatan</label>
                            <div class="col-md-10 col-sm-12 col-xs-12">
                              <textarea class="form-control" style='resize:none; width:100%; ' readonly="true" name="catatan"><?= $record['catatan']?></textarea>
                              <span class="help-block"></span>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <h2>Data BPJS</h2><hr>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">BPJS Jamsostek</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                                <input readonly="true" value="<?= $record['jmst']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">BPJS Kesehatan</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                                <input readonly="true" value="<?= $record['ksht']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">BPJS JKK</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                                <input readonly="true" value="<?= $record['jkk']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Nomor JPK</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <input readonly="true" value="<?= $record['nomor_jpk']?>" class="form-control" type="text">
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
                              <input readonly="true" value="<?= $record['tanggungan']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">NPWP</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <input readonly="true" value="<?= $record['npwp']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">Nomor NPWP</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <input readonly="true" value="<?= $record['nomor_npwp']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-12 col-xs-12">GJ DR GP</label>
                          <div class="col-md-8 col-sm-12 col-xs-12">
                              <input readonly="true" value="<?= $record['gjdrgp']?>" class="form-control" type="text">
                              <span class="help-block"></span>
                            </div>
                        </div> 
                      </div>
                    </div>
                  <p>&nbsp</p>
                  </div>


                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data History Karyawan <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <button class="btn btn-sm btn-primary"><?= date('d M Y'); ?></button>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="lookup">
                <thead>
                  <tr>
                    <th width="30px">No</th>
                    <th width="120px">Tanggal Aktif</th>
                    <th width="150px">Kategori</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $id = $this->session->userdata('id_karyawan');
                    //$tgl = date('d-m-Y');
                    $sql = "SELECT * FROM abe_history_karyawan WHERE id_karyawan = $id ORDER BY tgl_input DESC";
                    $history = $this->db->query($sql)->result();
                    $no = 1;
                    foreach ($history as $row) {
                      echo "<tr>
                            <td>$no</td>
                            <td>".date('d-m-Y', strtotime($row->tgl_aktif))."</td>
                            <td>$row->kategori</td>
                            <td>$row->keterangan</td>";                
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
</div>

<!-- jQuery -->
<script src="<?= base_url() ?>assets/gentelella/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url() ?>assets/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

-->
<!-- jquery.inputmask -->
<script src="<?= base_url() ?>assets/gentelella/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="<?= base_url() ?>assets/gentelella/build/js/custom.min.js"></script>


<!--
<script src="<?= base_url() ?>assets/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?= base_url() ?>assets/gentelella/vendors/jszip/dist/jszip.min.js"></script>
-->
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
 
 