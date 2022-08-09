<!-- Datatables 
<link rel="stylesheet" href="<?= base_url() ?>assets/gentelella/datatables/dataTables.bootstrap.css"/>
-->
<!-- Custom Theme Style -->
<link href="<?= base_url() ?>assets/gentelella/build/css/custom.min.css" rel="stylesheet">

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Data Rule Pengguna</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-5 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Pilih Data Pengguna<small></small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table class="table table-bordered table-striped">
                <tbody>
                  <tr>
                    <td align="center">Nama</td>
                    <td>
                      <select id="user" class="form-control" onchange="loadDataUser()">
                        <?php
                          $sql = "SELECT * FROM view_karyawan_aktif";
                          $user = $this->db->query($sql)->result();
                          foreach ($user as $row) {
                              echo "<option value='$row->id_karyawan'>$row->nama_lengkap</option>";
                          }
                        ?>
                      </select>
                    </td>
                  </tr>
                </tbody>
              </table>
          </div>
        </div>
      </div>
      <div class="col-md-7 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Hak Akses Modul <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <a class="btn btn-sm btn-success" href="<?= base_url('admin/menu') ?>"><i class="glyphicon glyphicon-plus"></i> Modul</a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="table_modul"></div>
            
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

<!-- Custom Theme Scripts -->
<script src="<?= base_url() ?>assets/gentelella/build/js/custom.min.js"></script>

<!-- Datatables Scripts 
<script src="<?= base_url() ?>assets/gentelella/datatables/jquery.dataTables.js" ></script>
<script src="<?= base_url() ?>assets/gentelella/datatables/dataTables.bootstrap.js"></script>
-->
<script type="text/javascript">
    $(document).ready(function() {
      //loadDataShipping();
      loadDataUser(); 
    });
</script>

<script type="text/javascript">e;
  var base_url = '<?php echo base_url();?>';

  function loadDataUser(){
    var user =$("#user").val();
    //alert (level);
    $.ajax({
      type :'GET',
      url  :'<?= base_url('admin/menu/modul') ?>',
      data :'user='+user,
      success:function(html){
        $("#table_modul").html(html);
      }
    })
  }

  function addRule(id_modul){
    var user =$("#user").val();
    $.ajax({
      type :'GET',
      url  :'<?= base_url('admin/menu/addrule') ?>',
      data :'user='+user+'&id_modul='+id_modul,
      success:function(html){
        //$("#table_modul").html(html);
        //alert('sukses memberikan akses');
        hak_akses();
      }
    })
  }

  function hak_akses()
  {
     $(document).ready(function (){
        $.notify("Sukses memberikan hak akses","success");
          });
  }

</script>
<script src="<?= base_url() ?>assets/gentelella/js/notify.js"></script>