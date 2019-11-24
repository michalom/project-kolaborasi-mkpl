<?php

include_once("../Database/koneksi.php");

//insert
if(isset($_POST['submit'])) {
  $no_anggota = $_POST['no_anggota'];
  $nama_anggota = $_POST['nama_anggota'];
  $jabatan = $_POST['jabatan'];
  $no_telp = $_POST['no_telp'];

  $result = mysqli_query($koneksi, "INSERT INTO tb_anggota(no_anggota,nama_anggota,jabatan,no_telp) VALUES('$no_anggota','$nama_anggota','$jabatan','$no_telp')");
    
  if($result){
    echo "<script type='text/javascript'>
            alert ('Data Berhasil Disimpan !');
          </script>";
    header("location:../anggota.php");
  } else {
    echo "<script type='text/javascript'>
            alert ('Data Gagal Disimpan !');
          </script>";
    header("location:../anggota.php");
  }
}

//update
if(isset($_POST['update'])) {
  $no_anggota = $_POST['no_anggota'];
  $nama_anggota = $_POST['nama_anggota'];
  $jabatan = $_POST['jabatan'];
  $no_telp = $_POST['no_telp'];

  $result = mysqli_query($koneksi, "UPDATE tb_anggota SET nama_anggota = '$nama_anggota',jabatan = '$jabatan', no_telp = '$no_telp' WHERE no_anggota = $no_anggota");
    
  if($result){
  // echo "<script type='text/javascript'>
  //           alert ('Data Berhasil Disimpan !');
  //           window.location.replace('http://localhost/SistemPerpustakaan/anggota.php');
  //         </script>"; 
    header("location:../anggota.php");
  } else {
    // echo "<script type='text/javascript'>
    //         alert ('Data Gagal Disimpan !');
    //         window.location.replace('http://localhost/SistemPerpustakaan/anggota.php');
    //       </script>";
    header("location:../anggota.php");
  }
}

//delete
if(isset($_POST['delete'])) {
  $no_anggota = $_POST['no_anggota'];
  $result = mysqli_query($koneksi, "DELETE FROM tb_anggota WHERE no_anggota = $no_anggota");
    
  if($result){
  // echo "<script type='text/javascript'>
  //           window.location.replace('http://localhost/SistemPerpustakaan/anggota.php');
  //         </script>"; 
    header("location:../anggota.php");
  } else {
    // echo "<script type='text/javascript'>
    //         window.location.replace('http://localhost/SistemPerpustakaan/anggota.php');
    //       </script>";
    header("location:../anggota.php");
  }
}

?>