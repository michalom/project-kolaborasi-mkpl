<?php
include_once("../Database/koneksi.php");

if(isset($_POST['delete'])) {
  $no_kunjungan = $_POST['no_kunjungan'];
  $result = mysqli_query($koneksi, "DELETE FROM tb_kunjungan WHERE no_kunjungan = $no_kunjungan");
    
  if($result){
  // echo "<script type='text/javascript'>
  //           window.location.replace('http://localhost/SistemPerpustakaan/daftarKunjungan.php');
  //         </script>"; 
  header("location:../daftarKunjungan.php");
  } else {
    // echo "<script type='text/javascript'>
    //         window.location.replace('http://localhost/SistemPerpustakaan/daftarKunjungan.php');
    //       </script>";
  header("location:../daftarKunjungan.php");
  }
}

?>
