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
$pdf->Line(1,3.1,20,3.1); $pdf->SetLineWidth(0.1);
$pdf->Line(1,3.2,20,3.2); $pdf->SetLineWidth(0);
$pdf->Ln(); 

$Dari = $_POST['dari'];
$Sampai = $_POST['sampai'];

$pdf->Cell(19,1,'Laporan Peminjaman Buku Perpustakaan SMAN 108',0,0.1,'C');
$pdf->Cell(1.5,1,'Periode:',0,0);
$pdf->Cell(2,1,$Dari,0,0);
$pdf->Cell(0.70,1,'S/D',0,0);
$pdf->Cell(1,1,$Sampai,0,1);

$pdf->AddFont('Tahoma','','tahoma.php');
$pdf->SetFont('Tahoma','',11);
$pdf->Cell(3.1,0.5,'No Peminjaman',1,0,'C');
$pdf->Cell(3.6,0.5,'Nama',1,0,'C');
$pdf->Cell(3,0.5,'Tanggal Pinjam',1,0,'C');
$pdf->Cell(2.8,0.5,'Nomor Copy',1,0,'C');
$pdf->Cell(5,0.5,'Judul Buku',1,0,'C');
$pdf->Cell(1.5,0.5,'Jumlah',1,1,'C');


$pdf->SetFont('Tahoma','',9);
$query = mysqli_query($koneksi,"SELECT tb_copybuku.no_copy,tb_peminjaman.no_peminjaman,nama_anggota,tgl_pinjam,judul_buku,jml_pinjam FROM tb_peminjaman,tb_anggota,tb_copybuku,tb_buku,detil_pinjam WHERE tb_peminjaman.no_peminjaman = detil_pinjam.no_peminjaman AND tb_peminjaman.no_anggota = tb_anggota.no_anggota and tb_copybuku.no_buku = tb_buku.no_buku AND detil_pinjam.no_copy = tb_copybuku.no_copy AND status = '0' AND detil_pinjam.no_peminjaman is not null AND tb_peminjaman.tgl_pinjam BETWEEN '$Dari' AND '$Sampai' ORDER BY tb_peminjaman.tgl_pinjam asc");
while ($row = mysqli_fetch_array($query)){
  $pdf->Cell(3.1,0.5,$row['no_peminjaman'],1,0,'C');
  $pdf->Cell(3.6,0.5,$row['nama_anggota'],1,0,'C');
  $pdf->Cell(3,0.5,$row['tgl_pinjam'],1,0,'C');
  $pdf->Cell(2.8,0.5,$row['no_copy'],1,0,'C'); 
  $pdf->Cell(5,0.5,$row['judul_buku'],1,0,'C'); 
  $pdf->Cell(1.5,0.5,$row['jml_pinjam'],1,1,'C'); 
}


   $query = mysqli_query($koneksi,"SELECT sum(jml_pinjam) as total FROM detil_pinjam,tb_peminjaman WHERE tb_peminjaman.no_peminjaman = detil_pinjam.no_peminjaman AND status = '0' AND  detil_pinjam.no_peminjaman is not null AND tb_peminjaman.tgl_pinjam BETWEEN '$Dari' AND '$Sampai' ORDER BY tb_peminjaman.tgl_pinjam asc");
   $total = mysqli_fetch_assoc($query);
   $pdf->SetFont('Tahoma','',9);
   $pdf->Cell(17.5,0.6,'Total Buku Yang Sedang Dipinjam :',1,0,'C');
   $pdf->Cell(1.5,0.6,$total['total'],1,1,'C');


$pdf->Cell(10,2,'',0,1);
    

$pdf->Cell(10,2,'',0,1);
$pdf->SetFont('Tahoma','',10);


$pdf->Cell(16.4,1,'Mengetahui,',0,1,'R');                                          
$pdf->Cell(18,0.1,'Kepala Perpustakaan SMAN 108',0,1,'R');
$pdf->Cell(17,7.5,'Tiurma Sirait, S.Pd',0,1,'R');

$pdf->Output('I','Laporan_Peminjaman.pdf');

}
?>
