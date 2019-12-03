<?php 
include 'template/Header.php'; 
include 'template/Sidebar.php';
include_once("Database/koneksi.php");
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <small><b>Halaman Pelaporan Buku Hilang</b></small>
    </h1>
  </section>
<section class="content">

<div class="row">
    <div class="col-lg-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-file-text fa-fw"></i> <b>Laporan Buku Hilang</b></h3>
        </div>

        <div class="box-body">
          <div class="form-group">
            <form action="laporan/proses_lapHilangBuku.php" method="POST">

              <div class="row" style="margin-bottom: 20px">
                <div class="col-md-6 col-md-offset-2">
                  <label class="col-sm-2 control-label" style="margin-top: 5px">Dari : </label>
                  <div class="col-sm-10">
                    <input type="date" name="dari" class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="row" style="margin-bottom: 20px">
                <div class="col-md-6 col-md-offset-2">
                  <label class="col-sm-2 control-label" style="margin-top: 5px">Sampai : </label>
                  <div class="col-sm-10">
                    <input type="date" name="sampai" class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-md-offset-2">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-5">
                    <button type="submit" name="cetak" class="btn btn-block btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</button>
                  </div>
                  <div class="col-sm-5">
                   <a href="dashboard.php"  class="btn btn-block btn-default"><i class="fa fa-close"></i> Batal</a>
                  </div>
                </div>
              </div>

              </form>
          </div>
        </div>
        <div class="box-footer">
          <center>

          </center>    
        </div>
      </div>
    </div>
  </div>
</section>

<?php include "template/Footer.php"; ?>