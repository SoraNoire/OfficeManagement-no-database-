<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="abe_developer" />
	<title>Notulen Rapat - <?= $record['no_rapat']; ?></title>
    <!-- Bootstrap -->
    <link href="<?= base_url() ?>assets/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <link href="<?= base_url() ?>assets/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<style type="text/css">

   	h2 {
		color: black;
		background-color: transparent;
		font-size: 18px;
		font-weight: normal;
	}
    
    h1 {
        color: black;
        background-color: transparent;
        font-size: 20px;
        font-weight: normal;
    }

	table {
		color: black;
		background-color: transparent;
		font-size: 20px;
		font-weight: normal;
        border-width: 1px;
	}
	</style>
</head>
<body onload="window.print()">

    <?php
        $hari_indonesia = array('Monday'  => 'Senin',
                        'Tuesday'  => 'Selasa',
                        'Wednesday' => 'Rabu',
                        'Thursday' => 'Kamis',
                        'Friday' => 'Jumat',
                        'Saturday' => 'Sabtu',
                        'Sunday' => 'Minggu');
        $hari   = date('l', strtotime($record['tgl_rapat']));
        $hari2  = $hari_indonesia[$hari];
    ?>

    <div class="container">
        <div class="col-sm-12">
            <table style="width: 100%; border-collapse:collapse" >
                <tr>
                    <td style="text-align: center;">
                        <strong><u> NOTULEN RAPAT </u></strong><br>
                        No. <?= $record['no_rapat']; ?>
                    </td>
                </tr>
                <tr><td style="text-align: center;"></td></tr>
            </table>
            <br>
            <table style="width: 100%;" border="0" >
                <tr>
                    <td style="width: 50%">
                        <table style="width: 100%;" border="0">
                            <tr>
                                <td style="width: 125px">Lokasi</td>
                                <td style="width: 20px">:</td>
                                <td><?= $record['lokasi']; ?></td>
                            </tr>
                            <tr>
                                <td>Hari / Tanggal</td>
                                <td>:</td>
                                <td><?= $hari2 ?>, <?= date('d M Y', strtotime($record['tgl_rapat'])) ?></td>
                            </tr>
                            <tr>
                                <td>Jam</td>
                                <td>:</td>
                                <td><?= $record['jam_rapat']; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: left; vertical-align: top">Pembahasan</td>
                                <td style="text-align: left; vertical-align: top">:</td>
                                <td style="width: 200px"><?= $record['pembahasan']; ?></td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 5%">
                        &nbsp
                    </td>
                    <td style="width: 15%; vertical-align: top;">
                        <p>Peserta Rapat : </p>
                    </td>
                    <td style="width: 30%; vertical-align: top">
                        <table style="width: 100%" border="0">
                            <tr>
                                <td style="width: 100%; ">
                                <?php
                                    $no_rapat  = $record['no_rapat'];
                                    $sql_peserta = "SELECT * FROM abe_rapat_peserta WHERE id_rapat = '$no_rapat'";
                                    $peserta = $this->db->query($sql_peserta)->result();
                                    $no = 1;
                                    //$urutan = 1;
                                    foreach($peserta as $row){
                                        echo $no.". ".ucfirst(strtolower($row->nama_peserta))."<br>"; 
                                    $no++;
                                }
                                ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            
            <br><br>
            <table style="width: 100%; border-collapse:collapse;" border="0">
                <tr>
                    <td style="text-align: left; width: 100%"> <strong>Hasil & Pembahasan :</strong> </td>
                </tr>
            </table>
            <div style="font-size: 19px">
                <?= $record['hasil_rapat']; ?>
            </div>
            
            <br><br>
            <table  style="border-collapse:collapse; width: 100%" border="0">
                <tr>
                    <td style="width: 420px; height: 200px; text-align: left; vertical-align: text-top;">
                        &nbsp;Keterangan : <br>
                        <div class="alert alert-info alert-dismissible" role="alert">
                            <?= $record['keterangan']; ?>
                        </div>
                    </td>
                </tr>
            </table>
            <br>

            <table style="border-collapse:collapse; width: 100%" border="0">
                <tr>
                <?php
                    //$no_rapat  = $record['no_rapat'];
                    //$sql_peserta = "SELECT * FROM abe_rapat_peserta WHERE id_rapat = '$no_rapat'";
                    //$peserta = $this->db->query($sql_peserta)->result();
                    $no = 1;
                    $urutan = 1;
                    foreach($peserta as $row){
                    if($no == '4'){
                ?>
                    <td style="width: 25%">
                        <table width="100%">
                            <tr><td style="text-align: center">&nbsp;Peserta - <?= $urutan ?> </td></tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr><td style="text-align: center" >( <?= $row->nama_peserta ?> )</td></tr>
                        </table>
                    </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                <?php
                    $no = 1;
                }else{
                ?>
                    <td style="width: 25%">
                        <table width="100%">
                            <tr><td style="text-align: center">&nbsp;Peserta - <?= $urutan ?> </td></tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr><td>&nbsp;</td></tr>
                            <tr><td style="text-align: center" >( <?= $row->nama_peserta ?> )</td></tr>
                        </table>
                    </td>
                <?php
                    $no++;
                    }
                    $urutan++;
                    }
                ?>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>