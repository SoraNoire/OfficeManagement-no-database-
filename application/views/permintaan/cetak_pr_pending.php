<?php

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Agus Bahrudin');
$pdf->SetTitle('Rekap Permintaan Pembelian Outstanding - '.date('d M Y'));
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// setting kanan & kiri
$pdf->SetMargins(5, 5);
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
$pdf->AddPage('L','A4');

//$pdf->Write(0, $nama_pt, '', 0, 'L', true, 0, false, false, 0);

$html = '
<style>
    h2 {
        color: black;
        font-family: tahoma;
        font-size: 10pt;
        text-align: left;
    }
    h3 {
        color: black;
        font-family: arial;
        font-size: 12pt;
        text-align: center;
    }
    h4 {
        color: black;
        font-family: arial;
        font-size: 10pt;
        text-align: right;
    }
    h5{
        color: black;
        font-family: arial;
        font-size: 10pt;
        text-align: left;
    }
</style>
<h3><strong>DATA PERMINTAAN YANG BELUM TERPENUHI</strong><br>'.date('d M Y').'</h3>
<br><br>
<br>
';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
//$spasi = '
//';
//$pdf->MultiCell(40, 5, ''.$spasi, 0, 'L', 0, 1, '', '', true);

$pdf->SetFont('helvetica', '', 9);
// -----------------------------------------------------------------------------

$tbl = <<<EOF
<table cellspacing="1" cellpadding="5" border="1" rules="none">
    <tr>
      <th width="30" align="center">No</th>
      <th width="135" align="center">No Form</th>
      <th width="90" align="center">Tanggal <br>Permintaan</th>
      <th width="260" align="center">Nama Barang</th>
      <th width="90" align="center">Qty</th>
      <th width="260" align="center">Keperluan</th>
      <th width="150" align="center">Progress</th>
    </tr>
EOF;

$sql_pending_detail = $this->db->query("SELECT ap.*, apd.* FROM abe_permintaan as ap, abe_permintaan_detail as apd WHERE ap.id_permintaan = apd.id_pr");

$no   = 1;
$x    = 0;
foreach ($sql_pending_detail->result() as $r)
{
  $tanggal = date('d M Y',strtotime($r->tgl_pr));
  $jumlah = $this->db->query("SELECT no_pr FROM abe_permintaan_detail WHERE no_pr = '$r->no_pr'")->num_rows();
  $a = $jumlah - $x;

if ($a == $jumlah){
$tbl.= <<<EOF
  <tr>
    <td align="center" rowspan="$jumlah">$no</td>
    <td rowspan="$jumlah"> $r->no_pr</td>
    <td rowspan="$jumlah"> $tanggal</td>
    <td> $r->nama_barang</td>
    <td align="center"> $r->jumlah_barang $r->satuan</td>
    <td> $r->keterangan</td>
    <td> $r->keterangan_status</td>
  </tr>
EOF;
$no++;
}else{
$tbl.= <<<EOF
  <tr>
    <td> $r->nama_barang</td>
    <td align="center"> $r->jumlah_barang $r->satuan</td>
    <td> $r->keterangan</td>
    <td> $r->keterangan_status</td>
 </tr>
EOF;
}

if($a == 1){
  $x = -1;
}

$x++;
}

$tbl.= <<<EOF
</table>
EOF;
$pdf->writeHTML($tbl, true, false, false, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Rekap Permintaan Pembeliaan Outstanding - '.date('d M Y').'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+