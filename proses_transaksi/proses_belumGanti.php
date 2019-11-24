<?php

include_once("../Database/koneksi.php");
//insert
if(isset($_POST['ganti'])) {
  $no_ganti = $_POST['no_ganti'];
  $no_hilang = $_POST['no_hilang'];
  $tgl_ganti = $_POST['tgl_ganti'];
  $no_hilang = $_POST['no_hilang'];
  $no_pengembalian = $_POST['no_pengembalian'];
  $no_peminjaman = $_POST['no_peminjaman'];

  $date = date('Y-m-d');
  if($tgl_ganti < $date){
    echo $s = "<script type='text/javascript'>
            alert ('Tanggal Tidak Valid !');
            window.location.replace('http://localhost/SistemPerpustakaan/belumGanti.php');
          </script>";
    return $s;
  }

  
  $result3 = mysqli_query($koneksi, "SELECT * FROM detil_kembali,tb_pengembalian,tb_peminjaman,tb_hilang WHERE detil_kembali.no_pengembalian = tb_pengembalian.no_pengembalian AND tb_peminjaman.no_peminjaman = tb_pengembalian.no_peminjaman AND tb_hilang.no_peminjaman = tb_peminjaman.no_peminjaman AND tb_hilang.no_hilang = '$no_hilang' and ket != '' ");

  $result4 = mysqli_query($koneksi, "SELECT jml_hilang FROM detil_hilang WHERE no_hilang = '$no_hilang'");
  $baris = mysqli_num_rows($result4);

  $result7 = mysqli_query($koneksi, "SELECT * FROM tb_pengembalian,tb_peminjaman,tb_hilang,detil_kembali WHERE tb_peminjaman.no_peminjaman = tb_pengembalian.no_peminjaman AND tb_hilang.no_peminjaman = tb_peminjaman.no_peminjaman AND detil_kembali.no_pengembalian = tb_pengembalian.no_pengembalian AND tb_hilang.no_hilang = '$no_hilang' and ket != '' ");

  $tampung = array();
  while ($jml = mysqli_fetch_assoc($result3)) {
    $tampung[] = $jml['jml_kembali'];
  }

  $tampung2 = array();
  while ($jml_hlg = mysqli_fetch_assoc($result4)) {
    $tampung2[] = $jml_hlg['jml_hilang'];
  }

  $array = array();
    while ($data6 = mysqli_fetch_array($result7)){
      $array[] = $data6['no_copy'];
  }


  $m=0;
  $q=0;
  $a=0;
  for($i=0; $i<$baris; $i++){
    $nocop = $array[$a++];
    $data = $tampung2[$m++]+$tampung[$q++];
    $update = mysqli_query($koneksi, "UPDATE detil_kembali SET jml_kembali = '$data' WHERE no_pengembalian = '$no_pengembalian' AND no_copy = '$nocop'");
  }  

  $result = mysqli_query($koneksi, "INSERT INTO tb_gantibuku(no_ganti,no_hilang,tgl_ganti) VALUES('$no_ganti','$no_hilang','$tgl_ganti')");

  $status = '1';
  $result4 = mysqli_query($koneksi, "UPDATE tb_hilang SET status = '$status' WHERE no_hilang = '$no_hilang'");
  $result4 = mysqli_query($koneksi, "UPDATE tb_peminjaman SET status = '$status' WHERE no_peminjaman = '$no_peminjaman'");

  if($result){
    // echo "<script type='text/javascript'>
    //         alert ('Data Berhasil Disimpan !');
    //         window.location.replace('http://localhost/SistemPerpustakaan/belumGanti.php');
    //       </script>";
    header("location:../belumGanti.php"); 
  } else {
    // echo "<script type='text/javascript'>
    //         alert ('Data Gagal Disimpan !');
    //         window.location.replace('http://localhost/SistemPerpustakaan/belumGanti.php');
    //       </script>";
    header("location:../belumGanti.php");
  }
}