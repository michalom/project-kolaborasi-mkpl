<?php

include_once("../Database/koneksi.php");

//insert
if(isset($_POST['submit'])) {
  $copy_buku = $_POST['no_copy'];
  $no_buku = $_POST['no_buku'];

  $result = mysqli_query($koneksi, "INSERT INTO tb_copybuku(no_copy,no_buku) VALUES('$copy_buku','$no_buku')");
    
  if($result){
    // echo "<script type='text/javascript'>
    //         alert ('Data Berhasil Disimpan !');
    //         window.location.replace('http://localhost/SistemPerpustakaan/copy_buku.php');
    //       </script>"; 
    header("location:../copy_buku.php");
  } else {
    // echo "<script type='text/javascript'>
    //         alert ('Data Gagal Disimpan !');
    //         window.location.replace('http://localhost/SistemPerpustakaan/copy_buku.php');
    //       </script>";
    header("location:../copy_buku.php");
  }
}

//update
if(isset($_POST['update'])) {
  $no_buku = $_POST['no_buku'];
  $copy_buku = $_POST['no_copy'];
  
  $result = mysqli_query($koneksi, "UPDATE tb_copybuku SET no_buku = '$no_buku' WHERE no_copy = $copy_buku");
    
  if($result){
  // echo "<script type='text/javascript'>
  //           alert ('Data Berhasil Disimpan !');
  //           window.location.replace('http://localhost/SistemPerpustakaan/copy_buku.php');
  //         </script>"; 
  	header("location:../copy_buku.php");
  } else {
    // echo "<script type='text/javascript'>
    //         alert ('Data Gagal Disimpan !');
    //         window.location.replace('http://localhost/SistemPerpustakaan/copy_buku.php');
    //       </script>";
    header("location:../copy_buku.php");
  }
}

//hapus
if(isset($_POST['delete'])) {
  $no_copy = $_POST['no_copy'];
  $result = mysqli_query($koneksi, "DELETE FROM tb_copybuku WHERE no_copy = $no_copy");

    if($result){
    // echo "<script type='text/javascript'>
    //         window.location.replace('http://localhost/SistemPerpustakaan/copy_buku.php');
    //       </script>"; 
    	header("location:../copy_buku.php");
  }  else {
    // echo "<script type='text/javascript'>
    //         window.location.replace('http://localhost/SistemPerpustakaan/copy_buku.php');
    //       </script>";
    header("location:../copy_buku.php");
  }

}