<?php

if(isset($_POST['cetak'])) {
ob_start();

include_once("../Database/koneksi.php");

require('../fpdf181/fpdf.php');
$pdf = new FPDF('P','cm','A4');
$pdf->AddPage(); 
$pdf->AddFont('Tahoma','','tahoma.php');
$pdf->SetFont('Tahoma','',10); 
$pdf->Image('../assets/img/logo.png',1,1,2,2);
$pdf->SetX(3); 
$pdf->MultiCell(19.5,0.5,' SMAN 108 ',0,'L'); 
$pdf->SetX(3); $pdf->MultiCell(19.5,0.5,' Pemerintah Kota Jakarta Selatan',0,'L'); 
$pdf->SetFont('Tahoma','',10);
$pdf->SetX(3); $pdf->MultiCell(19.5,0.5,' JL. Kesadaran Ulujami Raya, Jakarta Selatan Telpon: 021-7376876',0,'L'); 
$pdf->SetX(3); $pdf->MultiCell(19.5,0.5,' Website: www.sman108jkt.sch.id Email: sman108jkt@gmail.com',0,'L'); 
$pdf->Line(1,3.1,20.5,3.1); $pdf->SetLineWidth(0.1);
$pdf->Line(1,3.2,20.5,3.2); $pdf->SetLineWidth(0);
$pdf->Ln(); 

$Dari = $_POST['dari'];
$Sampai = $_POST['sampai'];

$pdf->Cell(19,1,'Laporan Pengembalian Buku Perpustakaan SMAN 108',0,0.1,'C');
$pdf->Cell(1.5,1,'Periode:',0,0);
$pdf->Cell(2,1,$Dari,0,0);
$pdf->Cell(0.70,1,'S/D',0,0);
$pdf->Cell(1,1,$Sampai,0,1);

$pdf->AddFont('Tahoma','','tahoma.php');
$pdf->SetFont('Tahoma','',11);
$pdf->Cell(4,0.5,'Nomor Kunjungan',1,0,'C');
$pdf->Cell(4,0.5,'Nomor Anggota',1,0,'C');
$pdf->Cell(4,0.5,'Nama Anggota',1,0,'C');
$pdf->Cell(3.5,0.5,'Tanggal',1,0,'C');
$pdf->Cell(4,0.5,'Keterangan',1,1,'C');

$pdf->SetFont('Tahoma','',9);
$query = mysqli_query($koneksi,"SELECT * FROM tb_kunjungan,tb_anggota WHERE tb_anggota.no_anggota = tb_kunjungan.no_anggota AND tb_kunjungan.tanggal BETWEEN '$Dari' AND '$Sampai' ORDER BY tb_kunjungan.tanggal asc");

while ($row = mysqli_fetch_array($query)){
  $pdf->Cell(4,0.5,$row['no_kunjungan'],1,0,'C');
  $pdf->Cell(4,0.5,$row['no_anggota'],1,0,'C');
  $pdf->Cell(4,0.5,$row['nama_anggota'],1,0,'C');
  $pdf->Cell(3.5,0.5,$row['tanggal'],1,0,'C'); 
  $pdf->Cell(4,0.5,$row['ket'],1,1,'C'); 
}

$pdf->Cell(10,2,'',0,1);
    

$pdf->Cell(10,2,'',0,1);
$pdf->SetFont('Tahoma','',10);


$pdf->Cell(16.4,1,'Mengetahui,',0,1,'R');                                          
$pdf->Cell(18,0.1,'Kepala Perpustakaan SMAN 108',0,1,'R');
$pdf->Cell(17,7.5,'Tiurma Sirait, S.Pd',0,1,'R');

$pdf->Output('I','Laporan_Kunjungan.pdf');

}
?>
