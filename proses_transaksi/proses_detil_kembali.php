<?php
include_once("../Database/koneksi.php");
error_reporting(0);

$id = $_GET['id'];
//insert
if(isset($_POST['submit'])) {
  $no_pengembalian = $_POST['no_pengembalian'];
  $no_peminjaman = $_POST['no_peminjaman'];
  $tgl_kembali = $_POST['tgl_kembali'];
  
  $date = date('Y-m-d');
  if($tgl_kembali < $date){
    echo $s = "<script type='text/javascript'>
            alert ('Tanggal Tidak Valid !');
            window.location.replace('http://localhost/SistemPerpustakaan/pengembalian.php');
          </script>";
    return $s;
  }

  $result = mysqli_query($koneksi, "SELECT * FROM tb_copybuku a,tb_buku b,detil_pinjam c,tb_peminjaman d WHERE a.no_buku = b.no_buku and a.no_copy = c.no_copy and c.no_peminjaman = d.no_peminjaman and d.no_peminjaman = '$id'");
  $baris = mysqli_num_rows($result);

  $ktr = "ket";
  $keterangan = array();
  for($i=1; $i<=$baris; $i++){
      $keterangan[] = $_POST[$ktr.$i];
  }

  $jml = "jml_pinjam";
  $jml_pinjam = array();
  for($i=1; $i<=$baris; $i++){
    $jml_pinjam[] = $_POST[$jml.$i];
  }

  $nc = "no_copy";
  $no_copy = array();
  for($i=1; $i<=$baris; $i++){
    $no_copy[] = $_POST[$nc.$i];
  }

  $result2 = mysqli_query($koneksi, "INSERT INTO tb_pengembalian(no_pengembalian,no_peminjaman,tgl_kembali) VALUES('$no_pengembalian','$no_peminjaman','$tgl_kembali')");

  $status = '1';
  $result3 = mysqli_query($koneksi, "UPDATE tb_peminjaman SET status = '$status' WHERE no_peminjaman = '$no_peminjaman'");

  $m=0;
  $n=0;
  $q=0;
  for($i=0; $i<$baris; $i++){
    $keterangans = $keterangan[$m++];
    $jml_pinjams = $jml_pinjam[$n++];
    $no_copies = $no_copy[$q++];
    $result2 = mysqli_query($koneksi, "INSERT INTO detil_kembali (no_pengembalian,no_copy,ket,jml_kembali) VALUES 
      ('$no_pengembalian','$no_copies','$keterangans','$jml_pinjams')");
  }  

  if($result && $result2){
    // echo "<script type='text/javascript'>
    //         alert ('Data Berhasil Disimpan !');
    //         window.location.replace('http://localhost/SistemPerpustakaan/pengembalian.php');
    //       </script>"; 
    header("location:../pengembalian.php");
  } else {
    // echo "<script type='text/javascript'>
    //         alert ('Data Gagal Disimpan !');
    //         window.location.replace('http://localhost/SistemPerpustakaan/pengembalian.php');
    //       </script>";
    header("location:../pengembalian.php");
  }
}