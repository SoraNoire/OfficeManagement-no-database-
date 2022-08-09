<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/favicon.jpg">
    <title> BAHTERA </title>

    <!-- Bootstrap -->
    <link href="<?= base_url() ?>assets/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url() ?>assets/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress 
    <link href="<?= base_url() ?>assets/gentelella/vendors/nprogress/nprogress.css" rel="stylesheet">
    -->
    <!-- iCheck 
    <link href="<?= base_url() ?>assets/gentelella/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    -->
    <!-- bootstrap-progressbar 
    <link href="<?= base_url() ?>assets/gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    -->
    <!-- JQVMap 
    <link href="<?= base_url() ?>assets/gentelella/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    -->
    <!-- Custom Theme Style -->
    <link href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?= base_url() ?>assets/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <script src="<?= base_url() ?>assets/gentelella/vendors/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
          $(".preloader").fadeOut();
        })
    </script>
    <style type="text/css">
    .preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: #fff;
    }
    .preloader .loading {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%,-50%);
      font: 14px arial;
    }
    </style>
  </head>
<!--
  <script type="text/javascript">
  <?php
   // date_default_timezone_set("Asia/Jakarta");
  ?>
    var detik = <?php //echo date('s'); ?>;
    var menit = <?php //echo date('i'); ?>;
    var jam   = <?php //echo date('H'); ?>;
     
    function clock()
    {
        if (detik!=0 && detik%60==0) {
            menit++;
            detik=0;
        }
        second = detik;
         
        if (menit!=0 && menit%60==0) {
            jam++;
            menit=0;
        }
        minute = menit;
         
        if (jam!=0 && jam%24==0) {
            jam=0;
        }
        hour = jam;
         
        if (detik<10){
            second='0'+detik;
        }
        if (menit<10){
            minute='0'+menit;
        }
         
        if (jam<10){
            hour='0'+jam;
        }
        waktu = hour+':'+minute+':'+second;
         
        document.getElementById("clock").innerHTML = waktu;
        detik++;
    }
 
    setInterval(clock,1000);
</script>
-->
  <body class="nav-md">
    <div class="preloader">
      <div class="loading">
        <center>
          <img src="<?= base_url('assets/') ?>loading.gif" width="250">
          <p>Harap Menunggu...!!</p>  
        </center>
      </div>
    </div>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-ship"></i> <span>BAHTERA</span></a>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <?php
                  if($this->session->userdata('foto') == ""){
                ?>
                    <img src="<?= base_url() ?>assets/foto_karyawan/user.png" class="img-circle profile_img">
                <?php
                  }else{
                ?>
                    <img src="<?= base_url() ?>assets/foto_karyawan/<?= $this->session->userdata('foto'); ?>" class="img-circle profile_img">
                <?php
                  }
                ?>
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?= $this->session->userdata('nama_lengkap'); ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                  <ul class="nav side-menu">
                  <?php
                    $user = $this->session->userdata('id_karyawan');
                    $sql_menu = "SELECT * FROM abe_menu WHERE id_menu in(SELECT id_menu FROM abe_user_rule WHERE id_level_user = $user) AND sub_menu = 0";
                    $main_menu = $this->db->query($sql_menu)->result();
                      foreach($main_menu as $main){
                        $sub_menu2 = $this->db->get_where('abe_menu',array('sub_menu'=> $main->id_menu));
                        $sql_menu2 = "SELECT * FROM abe_menu WHERE id_menu in(SELECT id_menu FROM abe_user_rule WHERE id_level_user = $user) AND sub_menu != 0 AND sub_menu = $main->id_menu";
                        $sub_menu = $this->db->query($sql_menu2);
                        if($sub_menu->num_rows() > 0){
                          echo "<li><a><i class='".$main->icon."'></i> $main->menu <span class='fa fa-chevron-down'></span></a>";
                          echo "<ul class='nav child_menu'>";
                          foreach($sub_menu->result() as $sub){
                            echo "<li><a href='".base_url($sub->link)."'><i class='".$sub->icon."'></i> $sub->menu</a></li>";
                          }
                          echo "</ul></li>";
                        }else{
                          echo "<li><a href='".base_url($main->link)."'><i class='".$main->icon."'></i> $main->menu</a></li>";
                        }
                      }
                  ?>
                </ul>
                  <!--
                  <?php
                     // include "admin/data_menu.php";
                  ?>-->
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <?php
                    if($this->session->userdata('foto') == ""){
                  ?>
                      <img src="<?= base_url() ?>assets/foto_karyawan/user.png" >
                  <?php
                    }else{
                  ?>
                      <img src="<?= base_url() ?>assets/foto_karyawan/<?= $this->session->userdata('foto'); ?>" >
                  <?php
                    }
                  ?>
                    <?= $this->session->userdata('nama_lengkap'); ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">

                  <?php
                    $posisi = $this->session->userdata('posisi');
                    $kota = $this->session->userdata('kota_user');
                    $level = $this->session->userdata('level');
                    //$p = $this->db->get_where("tabel_posisi",array("id_posisi"=>$posisi))->row_array();
                    //$k = $this->db->get_where("tabel_kota",array("id_kota"=>$kota))->row_array();
                    $l = $this->db->get_where("abe_level_user",array("id_level_user"=>$level))->row_array();
                  ?>

                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-blue pull-right"><?= $posisi; ?></span>
                        <span>Posisi</span>
                      </a>
                    </li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-blue pull-right"><?= $l['nama_level']; ?></span>
                        <span>Hak Akses</span>
                      </a>
                    </li>
                    <li>
                      <a href="<?= base_url('user/profile') ?>">
                        <span>Profile</span>
                      </a>
                    </li>
                    
                    <li><a href="<?= base_url('auth/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
                <li>
                  
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <?php echo $contents ?>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <i class="fa fa-ship"></i> BAHTERA ©2017 All Rights Reserved - v.2.0
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
  </body>
</html>
