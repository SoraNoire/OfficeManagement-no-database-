<?php

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Agus Bahrudin');
$pdf->SetTitle('Data Karyawan - '.$record['nama_lengkap']);
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

// set JPEG quality
$pdf->setJPEGQuality(75);
// Example of Image from data stream ('PHP rules')
//$imgdata = base64_decode('iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==');

// The '@' character is used to indicate that follows an image data stream and not an image file name
//$pdf->Image('@'.$imgdata);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Image example with resizing
$foto   = $record['foto'];
$ext    = substr($foto,-3);
if( $ext == 'png'){
    $pdf->Image('assets/foto_karyawan/'.$foto, 150, 30, 33, 45, 'PNG');
}else{
    $pdf->Image('assets/foto_karyawan/'.$foto, 150, 30, 33, 45, 'JPG');
}




$pt             = $record['id_pt'];
$sql_pt         = "SELECT id_pt, nama_pt FROM abe_pt WHERE id_pt = '$pt'";
$perusahaan     = $this->db->query($sql_pt)->row_array();
$html   = '
<style>
    h3 {
        color: black;
        font-family: arial;
        font-size: 10pt;
        text-align: center;
    }
</style>
<h3><strong style="text-decoration: underline">Data Karyawan '.$perusahaan['nama_pt'].'</strong><br>'.$record["nama_lengkap"].'</h3>
';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
$spasi = '
';
$pdf->MultiCell(40, 5, ''.$spasi, 0, 'L', 0, 1, '', '', true);

// output the HTML content
$id         = $record['id_karyawan'];
$sql_jobdesk = "SELECT * FROM abe_jobdesk WHERE id_karyawan = '$id'";
$jobdesk    = $this->db->query($sql_jobdesk)->result();

$nama       = $record['nama_lengkap'];
$nik        = $record['kode_karyawan'];
$jabatan    = $record['jabatan'];
$department = $record['department'];
$tempat_lahir = $record['tempat_lahir'];
$tgl_lahir  = date('d M Y', strtotime($record['tgl_lahir']));
$tgl_masuk  = date('d M Y', strtotime($record['tgl_gabung']));
$ktp        = $record['nik_ktp'];
$alamat_ktp = $record['alamat_ktp'];
$alamat     = $record['alamat'];

$id_1       = $record['propinsi_ktp'];
$sql_1      = $this->db->get_where('provinces',array('id'=>$id_1))->row_array();
$propinsi_ktp = $sql_1['name'];

$id_2       = $record['kabupaten_ktp'];
$sql_2      = $this->db->get_where('regencies',array('id'=>$id_2))->row_array();
$kabupaten_ktp = $sql_2['name'];

$id_3       = $record['kecamatan_ktp'];
$sql_3      = $this->db->get_where('districts',array('id'=>$id_3))->row_array();
$kecamatan_ktp = $sql_3['name'];

$id_4       = $record['desa_ktp'];
$sql_4      = $this->db->get_where('villages',array('id'=>$id_4))->row_array();
$desa_ktp   = $sql_4['name'];

$id_5       = $record['propinsi'];
$sql_5      = $this->db->get_where('provinces',array('id'=>$id_5))->row_array();
$propinsi   = $sql_5['name'];

$id_6       = $record['kabupaten'];
$sql_6      = $this->db->get_where('regencies',array('id'=>$id_6))->row_array();
$kabupaten = $sql_6['name'];

$id_7       = $record['kecamatan'];
$sql_7      = $this->db->get_where('districts',array('id'=>$id_7))->row_array();
$kecamatan = $sql_7['name'];

$id_8       = $record['desa'];
$sql_8      = $this->db->get_where('villages',array('id'=>$id_8))->row_array();
$desa       = $sql_8['name'];

//$foto       = $record['foto'];
//$foto_id    = 'assets/foto_karyawan/'.$foto;
$posisi     = $record['posisi'];
$status     = $record['status_pernikahan'];
$phone      = $record['phone'];
$mobile     = $record['mobile'];
$kerabat    = $record['hubungan_kerabat'];
$nama_kerabat = $record['nama_kerabat'];
$tlpn_kerabat = $record['tlpn_kerabat'];
$penempatan_pt= $perusahaan['nama_pt'];

$html2 = <<<EOF
<table border="0">
    <tr>
        <td width="80mm">
            <table border="0">
                <tr>
                    <td width="45mm">Nama Lengkap</td>
                    <td width="3mm">:</td>
                    <td width="52mm">$nama</td>
                </tr>
                <tr>
                    <td>No Induk Karyawan</td>
                    <td>:</td>
                    <td>$nik</td>
                </tr>
                <tr>
                    <td>Divisi</td>
                    <td>:</td>
                    <td>$department</td>
                </tr>
                <tr>
                    <td >Jabatan</td>
                    <td >:</td>
                    <td >$jabatan</td>
                </tr>
                <tr>
                    <td >Tempat / Tgl Lahir</td>
                    <td >:</td>
                    <td >$tempat_lahir / $tgl_lahir</td>
                </tr>
                <tr>
                    <td >NIK KTP</td>
                    <td >:</td>
                    <td >$ktp</td>
                </tr>
                <tr>
                    <td >Nomor Tlpn</td>
                    <td >:</td>
                    <td >$mobile / $phone</td>
                </tr>
                <tr>
                    <td >Status Pernikahan</td>
                    <td >:</td>
                    <td >$status</td>
                </tr>
                <tr>
                    <td >Perusahaan</td>
                    <td >:</td>
                    <td >$penempatan_pt</td>
                </tr>
                <tr>
                    <td >Tanggal Masuk</td>
                    <td >:</td>
                    <td >$tgl_masuk</td>
                </tr>
                <tr>
                    <td >Penempatan</td>
                    <td >:</td>
                    <td >$posisi</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="50%">
            <h3>Alamat Sesuai KTP</h3>
            <table border="0">
                <tr>
                    <td width="30mm">Propinsi</td>
                    <td width="3mm">:</td>
                    <td width="56mm">$propinsi_ktp</td>
                </tr>
                <tr>
                    <td>Kabupaten</td>
                    <td>:</td>
                    <td>$kabupaten_ktp</td>
                </tr>
                <tr>
                    <td>Kecamatan</td>
                    <td>:</td>
                    <td>$kecamatan_ktp</td>
                </tr>
                <tr>
                    <td >Kelurahan / Desa</td>
                    <td >:</td>
                    <td >$desa_ktp</td>
                </tr>
                <tr>
                    <td >Detail</td>
                    <td >:</td>
                    <td >$alamat_ktp</td>
                </tr>
            </table>
        </td>
        <td>
            <h3>Alamat Tinggal</h3>
            <table border="0">
                <tr>
                    <td width="30mm">Propinsi</td>
                    <td width="3mm">:</td>
                    <td width="56mm">$propinsi</td>
                </tr>
                <tr>
                    <td>Kabupaten</td>
                    <td>:</td>
                    <td>$kabupaten</td>
                </tr>
                <tr>
                    <td>Kecamatan</td>
                    <td>:</td>
                    <td>$kecamatan</td>
                </tr>
                <tr>
                    <td >Kelurahan / Desa</td>
                    <td >:</td>
                    <td >$desa</td>
                </tr>
                <tr>
                    <td >Detail</td>
                    <td >:</td>
                    <td >$alamat</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="100%">
            <h3>Jobdesk Karyawan</h3>
            <table style="font-size:10pt;">
                <tr>
                    <td >
EOF;
$no = 1;
foreach($jobdesk as $row){
    $jobdesk = $no.". ".ucfirst(strtolower($row->detail))."<br>"; 

$html2.=<<<EOF
    $jobdesk 
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

$pdf->Ln(4);
$cetak = $this->session->userdata('nama_lengkap');

$html = <<<EOF
<table border="0">
    <tr>
        <td width="50%" align="center"><b>Karyawan</b></td>
        <td width="50%" align="center"><b>HRD</b></td>
    </tr>
    <tr>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td align="center">( $nama )</td>
        <td align="center">( $cetak )</td>
    </tr>
</table>
EOF;
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Data Karyawan - '.$record["nama_lengkap"].'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+