<?php 
include 'template/Header.php'; 
include 'template/Sidebar.php';
include_once("Database/koneksi.php"); 
error_reporting(0);
?>

<?php

$id = $_GET['id'];

//autonumber
$cariindex = mysqli_query($koneksi,"select max(no_pengembalian) from tb_pengembalian") or die(mysqli_error());
$dataindex = mysqli_fetch_array($cariindex);
if($dataindex){
    $nilaiindex = substr($dataindex[0],3);
    $index = (int) $nilaiindex;
    $index = $index + 1;
    $hasilindex = "301".str_pad($index,4,"0",STR_PAD_LEFT);

} else {
    $hasilindex = "3010001";}


?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <small><b>Halaman Data Pengembalian</b></small>
    </h1>
  </section>
<section class="content">

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <label>Daftar Pengembalian</label>
      </div>
      <div class="panel-body">
        <form method="POST" action="proses_transaksi/proses_detil_kembali.php?id=<?php echo $id ?>">
        <table style="table-layout:fixed" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th align="center" width="20px">No. </th>
              <th align="center"><center>Nomor Copy</center></th>
              <th align="center"><center>Judul Buku </center></th>
              <th align="center"><center>Pengarang</center> </th>
              <th align="center"><center>Tanggal Pinjam</center> </th>
              <th align="center"><center>Jumlah Kembali</center> </th>
              <th align="center" width="100px"><center>Keterangan</center> </th>
            </tr>
          </thead>
          <tbody>
            <?php $keter=1; ?>
            <?php $pinjem=1; ?>
            <?php $nocop=1; ?>
            <?php $no=1; ?>
            <?php $result = mysqli_query($koneksi, "SELECT * FROM tb_copybuku a,tb_buku b,detil_pinjam c,tb_peminjaman d WHERE a.no_buku = b.no_buku and a.no_copy = c.no_copy and c.no_peminjaman = d.no_peminjaman and d.no_peminjaman = '$id'"); ?>
            <?php while($data2 = mysqli_fetch_array($result)) { ?>
            <tr>
              <td><center><?php echo $no++ ?></center></td>
              <td><center><?php echo $data2['no_copy'] ?></center></td>
              <td><center><?php echo $data2['judul_buku'] ?></center></td>
              <td><center><?php echo $data2['pengarang'] ?></center></td>
              <td><center><?php echo $data2['tgl_pinjam'] ?></center></td>
              <input type="hidden" name="no_copy<?php echo $nocop++ ?>" value="<?php echo $data2['no_copy'] ?>">
              <td><center><input class="form-control" type="text" value="<?php echo $data2['jml_pinjam'] ?>" name="jml_pinjam<?php echo $pinjem++; ?>"></center></td>

              <td><center><input type="checkbox" name="ket<?php echo $keter++; ?>" value="hilang"></center></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="panel-footer">
        <div class="row">
          <div class="col-md-6">
            <a href="pengembalian.php" class="btn pull-right col-md-5 btn-danger"><i class="fa fa-close"></i> Kembali</a></div>
        <div class="col-md-6">
          <button type="button" data-target="#ModalEntryPengembalian" data-toggle="modal" class="btn btn-primary btn-md btn-block" ><span class="fa fa-sign-out"></span> Proses Pengembalian</button>
        </div>
        </div>
      </div>
     </div>
    </div>
  </div>
</section>
</div>

<div class="modal fade" id="ModalEntryPengembalian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Input Data Pengembalian</h4>
      </div>
      <div class="modal-body">

        <div class="form-group"><label>Nomor Pengembalian</label>
            <input required class="form-control required text-capitalize" placeholder="Input Nama Anggota" value="<?php echo $hasilindex ?>" data-placement="top" readonly data-trigger="manual" type="text" name="no_pengembalian">
          </div>

        <div class="form-group"><label>Nomor Peminjaman</label>
            <input required class="form-control required text-capitalize" placeholder="Input Nama Anggota" value="<?php echo $id ?>" readonly data-placement="top" data-trigger="manual" type="text" name="no_peminjaman">
          </div>

        <div class="form-group"><label>Tanggal Kembali</label>
            <input required class="form-control required text-capitalize" data-placement="top" data-trigger="manual" type="date" name="tgl_kembali">
          </div>

      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>


<?php include "template/Footer.php"; ?>