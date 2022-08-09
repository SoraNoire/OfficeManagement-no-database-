<!-- Modal Notulen Rapat -->

<div class="modal fade" id="Create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pilih Lokasi Rapat</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/rapat/add_lokasi">
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Lokasi Rapat</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <?php
                echo cmb_dinamis('lokasi_rapat', 'abe_kota', 'nama_kota', 'kode_kota');
                ?>
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

<!-- Modal SPK -->

<div class="modal fade" id="CreateSPK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pilih Department Terkait SPK</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/spk/add_divisi">
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Pilih Divisi</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <select class="form-control select2" id="divisi" name="divisi" style="width: 100%;">
                  <?php
                  $this->load->database();
                  //$id = $r->id_paket;
                  $sql = "SELECT * FROM abe_department ORDER BY nama_department";
                  $query = $this->db->query($sql);
                  foreach ($query->result() as $r2) {
                  ?>
                    <option value="<?php echo $r2->nama_department; ?>">
                      <?php echo $r2->nama_department; ?>
                    </option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Pilih Karyawan</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <select class="form-control select2" id="karyawan" name="karyawan" style="width: 100%;" required="true">
                  <option>Pilih Karyawan</option>
                  <?php
                  $this->load->database();
                  $sql = "SELECT * FROM abe_karyawan INNER JOIN abe_department ON abe_karyawan.department = abe_department.nama_department WHERE abe_karyawan.status = 'aktif' ORDER BY nama_lengkap";
                  $query = $this->db->query($sql);
                  foreach ($query->result() as $r3) {
                  ?>
                    <option id="karyawan" class="<?php echo $r3->nama_department; ?>" value="<?php echo $r3->id_karyawan; ?>">
                      <?php echo $r3->nama_lengkap; ?>
                    </option>
                  <?php
                  }
                  ?>
                </select>
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

<!-- <script src="<?php echo base_url(); ?>assets/chain/jquery.chained.min.js"></script>
<script>
  $("#kota").chained("#provinsi");
  $("#kecamatan").chained("#kota");
  $("#karyawan").chained("#divisi");
</script> -->

<!-- Modal PR - Permintaan -->
<div class="modal fade" id="CreatePermintaan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pilih Lokasi Permintaan Barang / Jasa</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>permintaan/pr/add_lokasi">
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-12 col-xs-12">Lokasi Permintaan Barang / Jasa</label>
              <div class="col-md-7 col-sm-12 col-xs-12">
                <?php
                echo cmb_dinamis('lokasi_pr', 'abe_kota', 'nama_kota', 'kode_kota');
                ?>
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

<!-- Modal Daftar Tamu -->

<div class="modal fade" id="CreateTamu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Form Buku Tamu</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/tamu/add_tamu">
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Tanggal</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <input name="tgl_tamu" required="true" type="text" data-inputmask="'mask': '99-99-9999'" id="datepicker-example1" placeholder="masukkan tanggal" class="form-control tanggal">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Jam</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <input name="jam_tamu" required="true" type="text" data-inputmask="'mask': '99:99'" id="datepicker-example1" placeholder="masukkan Jam" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Nama Tamu</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <input type="text" required="true" name="nama_tamu" placeholder="nama lengkap" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Jumlah Tamu</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <input type="text" data-inputmask="'mask': '99'" required="true" name="jumlah_tamu" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Nama Perusahaan</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <input type="text" required="true" name="nama_perusahaan" placeholder="perorangan / nama perusahaan" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Keperluan</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <input type="text" required="true" name="keperluan" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Bertemu dengan</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <input type="text" required="true" name="user_tujuan" placeholder="nama divisi / nama karyawan" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Keterangan</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <textarea name="keterangan" class="form-control"></textarea>
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

<!-- Modal Surat Masuk -->

<div class="modal fade" id="SuratMasuk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Form Surat Masuk</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/surat/add_surat_masuk">
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Nomor Surat</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <input type="text" name="nomor_surat" placeholder="kosongkan kalau tidak ada" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Asal Surat</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <input type="text" required="true" name="asal_surat" placeholder="nama pengirim" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Tanggal Surat</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <input name="tgl_surat" required="true" type="text" data-inputmask="'mask': '99-99-9999'" id="datepicker-example1" placeholder="isi tanggal sekarang, kalau tidak ada" class="form-control tanggal">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Perihal Surat</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <input type="text" required="true" name="perihal" placeholder="" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Sifat Surat</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <select required="true" name="sifat" class="form-control">
                  <option value="">-- pilih --</option>
                  <option value="biasa">Biasa</option>
                  <option value="penting">Penting</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Ditujuan kepada</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <input type="text" required="true" name="tujuan_surat" placeholder="nama divisi / nama karyawan" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Keterangan</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <textarea name="keterangan" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Pengantar Surat</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <input type="text" required="true" name="pengantar" placeholder="JNE, TIKI, GOJEK, dll" class="form-control">
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

<!-- Modal Nomor Surat -->

<div class="modal fade" id="createNS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Bukti Pengambilan Nomor Surat</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/nomor_surat/proses">
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Pilih Perusahaan</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <select class="form-control select2" id="perusahaan" name="perusahaan" style="width: 100%;">
                  <option value="KAM">PT Karya Aspal Mandiri</option>
                  <option value="SAN">PT Sarana Aspal Nusantara</option>
                  <option value="AI">PT Aspal Indonesia</option>
                  <option value="BSL">PT Bahtera Samudera Lines</option>
                  <option value="AR">PT Andi Raya</option>
                  <option value="AMP">PT Anugerah Maju Persada</option>
                  <option value="KAMAN">PT Karya Mandiri Nusantara</option>
                  <option value="GATRA">PT Gatra Cempaka Sakti</option>
                  <option value="KCR">PT Karya Cipta Reswara</option>
                  <option value="BG">PT Bahtera Group</option>
                  <option value="BMT">PT Bahtera Multi Terminal</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Pilih Divisi</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <select class="form-control select2" id="divisi" name="divisi" style="width: 100%;">
                  <?php
                  $this->load->database();
                  //$id = $r->id_paket;
                  $sql = "SELECT * FROM abe_department ORDER BY nama_department";
                  $query = $this->db->query($sql);
                  foreach ($query->result() as $r2) {
                  ?>
                    <option value="<?php echo $r2->nama_department; ?>">
                      <?php echo $r2->nama_department; ?>
                    </option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Ditujukan kepada</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <input type="text" required="true" name="tujuan_surat" placeholder="nama divisi / karyawan / perusahaan" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Keterangan / Perihal</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <textarea name="perihal" class="form-control"></textarea>
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

<!-- Modal Tanda Terima -->

<div class="modal fade" id="createTT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Form Tanda Terima Dokumen</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= base_url(); ?>user/tanda_terima/proses">
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Pilih Perusahaan</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <select class="form-control select2" id="perusahaan" name="perusahaan" style="width: 100%;">
                  <option value="KAM">PT Karya Aspal Mandiri</option>
                  <option value="SAN">PT Sarana Aspal Nusantara</option>
                  <option value="AI">PT Aspal Indonesia</option>
                  <option value="BSL">PT Bahtera Samudera Lines</option>
                  <option value="AR">PT Andi Raya</option>
                  <option value="AMP">PT Anugerah Maju Persada</option>
                  <option value="KAMAN">PT Karya Mandiri Nusantara</option>
                  <option value="GATRA">PT Gatra Cempaka Sakti</option>
                  <option value="KCR">PT Karya Cipta Reswara</option>
                  <option value="BG">PT Bahtera Group</option>
                  <option value="BMT">PT Bahtera Multi Terminal</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Pilih Divisi</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <select class="form-control select2" id="divisi2" name="divisi" style="width: 100%;">
                  <?php
                  $this->load->database();
                  //$id = $r->id_paket;
                  $sql = "SELECT * FROM abe_department ORDER BY nama_department";
                  $query = $this->db->query($sql);
                  foreach ($query->result() as $r2) {
                  ?>
                    <option value="<?php echo $r2->nama_department; ?>">
                      <?php echo $r2->nama_department; ?>
                    </option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Pilih Karyawan</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <select class="form-control select2" id="karyawan2" name="karyawan" style="width: 100%;" required="true">
                  <option>Pilih Karyawan</option>
                  <?php
                  $this->load->database();
                  $sql = "SELECT * FROM abe_karyawan INNER JOIN abe_department ON abe_karyawan.department = abe_department.nama_department WHERE abe_karyawan.status = 'aktif' ORDER BY nama_lengkap";
                  $query = $this->db->query($sql);
                  foreach ($query->result() as $r3) {
                  ?>
                    <option id="karyawan" class="<?php echo $r3->nama_department; ?>" value="<?php echo $r3->id_karyawan; ?>">
                      <?php echo $r3->nama_lengkap; ?>
                    </option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-12 col-xs-12">Keterangan Dokumen</label>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <textarea name="dokumen" class="form-control"></textarea>
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

<script src="<?php echo base_url(); ?>assets/chain/jquery.chained.min.js"></script>
<script>
  $("#kota").chained("#provinsi");
  $("#kecamatan").chained("#kota");
  $("#karyawan").chained("#divisi");
  $("#karyawan2").chained("#divisi2");
</script>