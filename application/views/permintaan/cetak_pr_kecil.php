<?php

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Agus Bahrudin');
$pdf->SetTitle('Form Permintaan Pembelian - '.$record['no_pr']);
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
$pdf->SetMargins(5, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setPrintHeader(false);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
$pdf->SetFont('helvetica', '', 9);
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
$pdf->AddPage('P','A4');

$singkat  = $record['nama_pt'];
$sql_pt   = $this->db->query("SELECT * FROM abe_pt WHERE singkat = '$singkat'")->row_array(); 
$nama_pt  = strtoupper($sql_pt['nama_pt']);
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
<h2>'.$nama_pt.'</h2>
<h3><strong style="text-decoration: underline">FORM PERMINTAAN PEMBELIAN / JASA</strong><br>NO : '.$record["no_pr"].'</h3>
<br><br>
<h4>TANGGAL : '.date('d M Y',strtotime($record['tgl_pr'])).'</h4>
<br>
<h5>Mohon dibelikan barang-barang tersebut dibawah ini :</h5>
';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
//$spasi = '
//';
//$pdf->MultiCell(40, 5, ''.$spasi, 0, 'L', 0, 1, '', '', true);

$pdf->SetFont('helvetica', '', 9.5);
// -----------------------------------------------------------------------------

$tbl = <<<EOF
<table cellspacing="1" cellpadding="5" border="1" rules="none">
    <tr>
      <th width="30" align="center">No</th>
      <th width="257" align="center">Nama Barang</th>
      <th width="120" align="center">No. Seri <br>Part No.</th>
      <th width="90" align="center">Jumlah</th>
      <th width="210" align="center">Keterangan</th>
    </tr>
EOF;

$id         = $record['no_pr'];
$sql_detail = $this->db->query("SELECT * FROM abe_permintaan_detail WHERE no_pr = '$id'"); 
$no = 1;
foreach ($sql_detail->result() as $r)
{

$tbl.= <<<EOF
    <tr>
      <td align="center">$no</td>
      <td> $r->nama_barang</td>
      <td> $r->no_seri</td>
      <td align="center">$r->jumlah_barang $r->satuan</td>
      <td> $r->keterangan</td>
    </tr>
EOF;

  $no++;
}

$tbl.= <<<EOF
</table>
EOF;
$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->SetFont('helvetica', '', 9);

$txt = 'Dibuat Oleh,


( '.strtolower($record['nama_input']).' )';
$pdf->MultiCell(45, 5, ''.$txt, 0, 'C', 0, 0, '', '', true);
$pdf->MultiCell(5, 5, '', 0, '', 0, 0, '', '', true);

$txt = 'Diajukan Oleh,


( '.strtolower($record['pr_diajukan']).' )';
$pdf->MultiCell(45, 5, ''.$txt, 0, 'C', 0, 0, '', '', true);
$pdf->MultiCell(5, 5, '', 0, '', 0, 0, '', '', true);

$txt = 'Diketahui Oleh,


( '.strtolower('                   ').' )';
$pdf->MultiCell(45, 5, ''.$txt, 0, 'C', 0, 0, '', '', true);
$pdf->MultiCell(5, 5, '', 0, '', 0, 0, '', '', true);

$txt = 'Disetujui Oleh,


( '.strtolower('                  ').' )';
$pdf->MultiCell(45, 5, ''.$txt, 0, 'C', 0, 1, '', '', true);
$pdf->MultiCell(10, 5, '', 0, '', 0, 1, '', '', true);


// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Form Permintaan Pembelian - '.$record["no_pr"].'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+