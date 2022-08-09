<?php

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Agus Bahrudin');
$pdf->SetTitle('Notulen Rapat - '.$record['no_rapat']);
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setPrintHeader(false);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);
/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// add a page 
$pdf->AddPage();

$html = '
<style>
    h3 {
        color: black;
        font-family: arial;
        font-size: 10pt;
        text-align: center;
    }
</style>
<h3><strong style="text-decoration: underline">NOTULEN RAPAT</strong><br>'.$record["no_rapat"].'</h3>
';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
$spasi = '
';
$pdf->MultiCell(40, 5, ''.$spasi, 0, 'L', 0, 1, '', '', true);

$no_rapat  = $record['no_rapat'];
$sql_peserta = "SELECT * FROM abe_rapat_peserta WHERE id_rapat = '$no_rapat'";
$peserta = $this->db->query($sql_peserta)->result();
$no = 1;
$hari_indonesia = array('Monday'  => 'Senin',
                        'Tuesday'  => 'Selasa',
                        'Wednesday' => 'Rabu',
                        'Thursday' => 'Kamis',
                        'Friday' => 'Jumat',
                        'Saturday' => 'Sabtu',
                        'Sunday' => 'Minggu');

// output the HTML content
$lokasi = $record['lokasi'];
$tgl    = date('d M Y', strtotime($record['tgl_rapat']));
$hari   = date('l', strtotime($tgl));
$hari2  = $hari_indonesia[$hari];
$jam    = $record['jam_rapat'];
$pembahasan = $record['pembahasan'];
$html2 = <<<EOF
<table border="0">
    <tr>
        <td width="80mm">
            <table border="0">
                <tr>
                    <td width="25mm">Lokasi</td>
                    <td width="3mm">:</td>
                    <td width="52mm">$lokasi</td>
                </tr>
                <tr>
                    <td>Hari / Tanggal</td>
                    <td>:</td>
                    <td>$hari2 / $tgl</td>
                </tr>
                <tr>
                    <td>Jam</td>
                    <td>:</td>
                    <td>$jam</td>
                </tr>
                <tr>
                    <td >Pembahasan</td>
                    <td >:</td>
                    <td >$pembahasan</td>
                </tr>
            </table>
        </td>
        <td width="15mm"></td>
        <td width="28mm" align="right">
            Peserta Rapat :
        </td>
        <td width="65mm">
            <table style="font-size:10pt;">
                <tr>
                    <td >
EOF;
foreach($peserta as $row){
    $peserta = $no.". ".ucfirst(strtolower($row->nama_peserta))."<br>"; 

$html2.=<<<EOF
    $peserta 
EOF;

    $no++;
    }
$html2.=<<<EOF
</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
EOF;

$pdf->writeHTML($html2, true, false, true, false, '');
$html = '
<style>
    h1 {
        color: black;
        font-family: arial;
        font-size: 18pt;
        text-decoration: underline;
        text-align: center;
    }
    h3 {
        color: black;
        font-family: arial;
        font-size: 10pt;
        text-align: center;
    }

    h4 {
        color: black;
        font-family: arial;
        font-size: 10pt;
    }

    .lowercase {
        text-transform: lowercase;
    }
    .uppercase {
        text-transform: uppercase;
    }
    .capitalize {
        text-transform: capitalize;
    }
</style>

<h4>Hasil & Pembahasan :</h4>
<p>'.$record["hasil_rapat"].'</p>

<br><br><br>
<h4>Keterangan Notulen Rapat :</h4>
<p>'.$record["keterangan"].'</p>
';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->MultiCell(60, 5, 'Paraf Peserta Rapat :', 0, 'L', 0, 1, '', '', true);
//$pdf->AddPage();
$no_rapat  = $record['no_rapat'];
$sql_peserta = "SELECT * FROM abe_rapat_peserta WHERE id_rapat = '$no_rapat'";
$peserta = $this->db->query($sql_peserta)->result();
$no = 1;
$urutan = 1;
foreach($peserta as $row){
  if($no == '4'){
$txt = 'Peserta '.$urutan.' :


( '.strtolower($row->nama_peserta).' )';
$pdf->MultiCell(40, 5, ''.$txt, 0, 'C', 0, 1, '', '', true);
$pdf->MultiCell(10, 5, '', 0, '', 0, 1, '', '', true);
$no = 1;
  }else{
$txt = 'Peserta '.$urutan.' :


( '.strtolower($row->nama_peserta).' )';
$pdf->MultiCell(40, 5, ''.$txt, 0, 'C', 0, 0, '', '', true);
$pdf->MultiCell(5, 5, '', 0, '', 0, 0, '', '', true);
    $no++;
  }
  $urutan++;
}

$spasi = '



';
$pdf->MultiCell(40, 5, ''.$spasi, 0, 'C', 0, 1, '', '', true);

$pdf->Ln(4);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Notulen Rapat - '.$record["no_rapat"].'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+