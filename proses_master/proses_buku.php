<?php
include_once("../Database/koneksi.php");
//insert
if(isset($_POST['submit'])) {
  $no_buku = $_POST['no_buku'];
  $judul_buku = $_POST['judul_buku'];
  $pengarang = $_POST['pengarang'];
  $penerbit = $_POST['penerbit'];
  $thn_terbit = $_POST['thn_terbit'];
  $thn_beli = $_POST['thn_beli'];
  $asal_buku = $_POST['asal_buku'];
  $eks = $_POST['eks'];

  $result = mysqli_query($koneksi, "INSERT INTO tb_buku(no_buku,judul_buku,pengarang,penerbit,thn_terbit,thn_beli,asal_buku,eks) VALUES('$no_buku','$judul_buku','$pengarang','$penerbit','$thn_terbit','$thn_beli','$asal_buku','$eks')");
    
  if($result){
  // echo "<script type='text/javascript'>
  //           alert ('Data Berhasil Disimpan !');
  //           window.location.replace('http://localhost/SistemPerpustakaan/buku.php');
  //         </script>"; 
    header("location:../buku.php");
  } else {
    // echo "<script type='text/javascript'>
    //         alert ('Data Gagal Disimpan !');
    //         window.location.replace('http://localhost/SistemPerpustakaan/buku.php');
    //       </script>";
    header("location:../buku.php");
  }
}

//update
if(isset($_POST['update'])) {
  $no_buku = $_POST['no_buku'];
  $judul_buku = $_POST['judul_buku'];
  $pengarang = $_POST['pengarang'];
  $penerbit = $_POST['penerbit'];
  $thn_terbit = $_POST['thn_terbit'];
  $thn_beli = $_POST['thn_beli'];
  $asal_buku = $_POST['asal_buku'];
  $eks = $_POST['eks'];

  $result = mysqli_query($koneksi, "UPDATE tb_buku SET judul_buku = '$judul_buku',pengarang = '$pengarang', penerbit = '$penerbit',thn_terbit = '$thn_terbit',thn_beli = '$thn_beli',asal_buku = '$asal_buku',eks = '$eks' WHERE no_buku = $no_buku");
    
  if($result){
  // echo "<script type='text/javascript'>
  //           alert ('Data Berhasil Disimpan !');
  //           window.location.replace('http://localhost/SistemPerpustakaan/buku.php');
  //         </script>"; 
    header("location:../buku.php");
  } else {
    // echo "<script type='text/javascript'>
    //         alert ('Data Gagal Disimpan !');
    //         window.location.replace('http://localhost/SistemPerpustakaan/buku.php');
    //       </script>";
    header("location:../buku.php");
  }
}

//delete
if(isset($_POST['delete'])) {
  $no_buku = $_POST['no_buku'];
  $result = mysqli_query($koneksi, "DELETE FROM tb_buku WHERE no_buku = $no_buku");
    
  if($result){
  // echo "<script type='text/javascript'>
  //           window.location.replace('http://localhost/SistemPerpustakaan/buku.php');
  //         </script>"; 
    header("location:../buku.php");
  } else {
    // echo "<script type='text/javascript'>
    //         window.location.replace('http://localhost/SistemPerpustakaan/buku.php');
    //       </script>";
    header("location:../buku.php");
  }
}