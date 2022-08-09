
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
            <?php if($this->session->flashdata('sukses')){ ?>
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p><center><?php echo $this->session->flashdata('sukses'); ?></center></p>
                  </div>
                <?php }elseif($this->session->flashdata('gagal')){ ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><center>
                          <p>Maaf : <?php echo $this->session->flashdata('gagal'); ?></p></center>
                    </div>
                <?php } ?>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>user/profile/proses_password">
              <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="form-body">
                  <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-12">Password Lama</label>
                      <div class="col-md-6 col-sm-12">
                          <input name="password_old" class="form-control" placeholder="masukkan password aktif anda" type="password" required="required">
                      </div>
                  </div>
                  <div class="item form-group">
                    <label for="password" class="control-label col-md-3">Password Baru</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="password" type="password" name="password" placeholder="masukkan password baru anda" class="form-control col-md-7 col-xs-12" required="required">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password Baru</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="password2" type="password" name="password2" placeholder="ulangi password baru anda" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" id="btnSave" id="send" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="reset" class="btn btn-danger">Cancel</button>
                  </div>
                            
                </div>
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

<!-- validator -->
<script src="<?= base_url() ?>assets/gentelella/vendors/validator/validator.js"></script>

<!-- Custom Theme Scripts -->
<script src="<?= base_url() ?>assets/gentelella/build/js/custom.min.js"></script>
 