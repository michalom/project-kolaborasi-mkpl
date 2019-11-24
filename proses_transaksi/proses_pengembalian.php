<?php
include_once("../Database/koneksi.php");

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

  $result = mysqli_query($koneksi, "INSERT INTO tb_pengembalian(no_pengembalian,no_peminjaman,tgl_kembali) VALUES('$no_pengembalian','$no_peminjaman','$tgl_kembali')");

  if($result){
    // echo "<script type='text/javascript'>
    //         alert ('Data Berhasil Disimpan !');
    //         window.location.replace('http://localhost/SistemPerpustakaan/pengembalian.php');
    //       </script>"; 
    header("location:../pengembalian.php.");
  } else {
    // echo "<script type='text/javascript'>
    //         alert ('Data Gagal Disimpan !');
    //         window.location.replace('http://localhost/SistemPerpustakaan/pengembalian.php');
    //       </script>";
    header("location:../pengembalian.php.");
  }
}

//insert
if(isset($_POST['hilang'])) {
  $no_hilang = $_POST['no_hilang'];
  $no_peminjaman = $_POST['no_peminjaman'];
  $tgl_hilang = $_POST['tgl_hilang'];
    
  $date = date('Y-m-d');
  if($tgl_hilang < $date){
    echo "<script type='text/javascript'>
            alert ('Tanggal Tidak Valid !');
            window.location.replace('http://localhost/SistemPerpustakaan/peminjaman.php');
          </script>";
    return $s;
  }

  $result = mysqli_query($koneksi, "INSERT INTO tb_hilang(no_hilang,no_peminjaman,tgl_hilang) VALUES('$no_hilang','$no_peminjaman','$tgl_hilang')");

  if($result){
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