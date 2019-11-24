<?php
error_reporting(0);
include_once("../Database/koneksi.php");

//insert
if(isset($_POST['submit'])) {
  $no_hilang = $_POST['no_hilang'];
  $no_peminjaman = $_POST['no_peminjaman'];
  $tgl_hilang = $_POST['tgl_hilang'];
  $baris2 = $_POST['baris2'];
  
  $date = date('Y-m-d');
  if($tgl_hilang < $date){
    echo $s = "<script type='text/javascript'>
            alert ('Tanggal Tidak Valid !');
            window.location.replace('http://localhost/SistemPerpustakaan/pengembalian.php');
          </script>";
    return $s;
  }

  $nc = "no_copy";
  $no_copy = array();
  for($i=1; $i<=$baris2; $i++){
    $no_copy[] = $_POST[$nc.$i];
  }

  $jml = "jml_ganti";
  $jml_ganti = array();
  for($i=1; $i<=$baris2; $i++){
    $jml_ganti[] = $_POST[$jml.$i];
  }

  $status = '0';
  $result2 = mysqli_query($koneksi, "INSERT INTO tb_hilang(no_hilang,no_peminjaman,tgl_hilang,status) VALUES('$no_hilang','$no_peminjaman','$tgl_hilang','$status')");

  $m=0;
  $n=0;
  for($i=0; $i<$baris2; $i++){
    $no_copies = $no_copy[$m++];
    $jml_gantis = $jml_ganti[$n++];
    $result5 = mysqli_query($koneksi, "INSERT INTO detil_hilang (no_hilang,no_peminjaman,no_copy,jml_hilang) VALUES 
      ('$no_hilang','$no_peminjaman','$no_copies','$jml_gantis')");
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
