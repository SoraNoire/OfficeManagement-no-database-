
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
    <!-- Animate.css -->
    <link href="<?= base_url() ?>assets/gentelella/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
          <form action="<?= base_url('auth/cek_login') ?>" method="post">
            
              <h1>BAHTERA</h1>
                <?php if($this->session->flashdata('disabled')){ ?>
                  <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p><center><?php echo $this->session->flashdata('disabled'); ?></center></p>
                  </div>
                <?php }elseif($this->session->flashdata('gagal')){ ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <p>Maaf : <?php echo $this->session->flashdata('gagal'); ?></p>
                    </div>
                <?php } ?>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="username" required=""  />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password"  required="" />
              </div>
              <div>
                <button name="submit" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Log in</button>
              </div>

              <div class="clearfix"></div>
              <div class="separator">

                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><i class="fa fa-ship"></i> BAHTERA GROUP</h1>
                  <p>©2017 All Rights Reserved - v.2.0</p>
                </div>
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
 
    
  <!-- jQuery -->
  <script src="<?= base_url() ?>assets/gentelella/vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?= base_url() ?>assets/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="<?= base_url() ?>assets/gentelella/build/js/custom.min.js"></script>
  </body>
</html>
