<?php 

session_start();
session_destroy();

?>

<?php

include_once("Database/koneksi.php");

//autonumber
$cariindex = mysqli_query($koneksi,"select max(no_kunjungan) from tb_kunjungan") or die(mysqli_error());
$dataindex = mysqli_fetch_array($cariindex);
if($dataindex){
    $nilaiindex = substr($dataindex[0],3);
    $index = (int) $nilaiindex;
    $index = $index + 1;
    $hasilindex = "201".str_pad($index,4,"0",STR_PAD_LEFT);

} else {
    $hasilindex = "2010001";}


//insert
if(isset($_POST['simpan'])) {
  $no_anggota = $_POST['no_anggota'];
  $no_kunjungan = $_POST['no_kunjungan'];
  $date = date('Y-m-d');
  $ket = $_POST['ket'];

  $result = mysqli_query($koneksi, "SELECT no_anggota FROM tb_anggota WHERE no_anggota = '$no_anggota'");
  $cari = mysqli_fetch_assoc($result);

  if($cari == null){
    echo "<script type='text/javascript'>
            alert ('Nomor Anggota Tidak Ditemukan !');
            window.location.replace('http://localhost/ppl%20baru/SistemPerpustakaan-master/kunjungan.php');
          </script>";
  }
  
  $result = mysqli_query($koneksi, "INSERT INTO tb_kunjungan(no_kunjungan,no_anggota,ket,tanggal) VALUES('$no_kunjungan','$no_anggota','$ket','$date')");
    
  if($result){
    echo "<script type='text/javascript'>
            alert ('Data Berhasil Disimpan !');
            window.location.replace('http://localhost/ppl%20baru/SistemPerpustakaan-master/');
          </script>"; 
  } else {
    echo "<script type='text/javascript'>
            alert ('Data Gagal Disimpan !');
            window.location.replace('http://localhost/ppl%20baru/SistemPerpustakaan-master/kunjungan.php');
          </script>";
  }
}



?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Perpustakaan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/AdminLTE/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/AdminLTE/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="assets/AdminLTE/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="assets/AdminLTE/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="assets/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="assets/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link rel="stylesheet" href="assets/AdminLTE/bower_components/select2/dist/css/select2.min.css">

  <!-- Datatables -->
  <link rel="stylesheet" href="assets/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="SHORTCUT ICON" href="assets/img/logo.png">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="index.php" class="navbar-brand"><b>Perpustakaan</b> SMAN 108</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>


      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="box box-default">
              <div class="box-body">
                <center><h4>Kunjungan Perpustakaan</h4></center>
                <hr>
                 <form method="POST" action="kunjungan.php" enctype="multipart/form-data">
                  <div class="form-group"><label>Nomor Kunjungan</label>
                    <input required class="form-control required text-capitalize" value="<?php echo $hasilindex ?>" data-placement="top" readonly placeholder="Input Nomor Anggota" data-trigger="manual" type="text" name="no_kunjungan">
                  </div>
                    
                  <div class="form-group"><label>Nomor Anggota</label>
                    <input required class="form-control required text-capitalize" placeholder="Input Nomor Anggota" data-placement="top" data-trigger="manual" type="text" name="no_anggota">
                  </div>

                  <div class="form-group"><label>Keterangan</label>
                    <textarea name="ket" class="form-control"></textarea>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <a href="index.php" class="btn btn-block btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</a>
                    </div>
                    <div class="col-md-6">
                      <button type="submit" name="simpan" class="btn btn-block btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->



<?php include "template/Footer.php"; ?>