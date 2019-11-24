<?php 
include 'template/Header.php'; 
include 'template/Sidebar.php';
include_once("Database/koneksi.php");
error_reporting(0);
?>

<?php

$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM tb_copybuku a,tb_buku b,detil_pinjam c,tb_peminjaman d WHERE a.no_buku = b.no_buku and a.no_copy = c.no_copy and c.no_peminjaman = d.no_peminjaman and d.no_peminjaman = '$id'");
  $baris = mysqli_num_rows($result);

if(isset($_POST['hilang'])) {

  $no_peminjaman = $_POST['no_peminjaman'];

  $ktr = "pilih";
  $pilih = array();
  for($i=1; $i<=$baris; $i++){
    $pilih[] = $_POST[$ktr.$i];
  }

  $pilih1 = array_filter($pilih);
  $pilih2 = array_values($pilih1);

  $lemparBaris = count($pilih2);
  $konten= array();
  $q=0;
  for($i=1; $i<=$lemparBaris; $i++){
    $d = $pilih2[$q++];
    $result2 = mysqli_query($koneksi, "SELECT * FROM tb_peminjaman,detil_pinjam,tb_copybuku,tb_buku WHERE tb_peminjaman.no_peminjaman = detil_pinjam.no_peminjaman AND tb_copybuku.no_copy = detil_pinjam.no_copy AND tb_buku.no_buku = tb_copybuku.no_buku AND tb_copybuku.no_copy = '$d' and detil_pinjam.no_peminjaman = '$no_peminjaman'");
    $konten[] = mysqli_fetch_assoc($result2);
  }
}

//autonumber
$cariindex = mysqli_query($koneksi,"select max(no_hilang) from tb_hilang") or die(mysqli_error());
$dataindex = mysqli_fetch_array($cariindex);
if($dataindex){
    $nilaiindex = substr($dataindex[0],3);
    $index = (int) $nilaiindex;
    $index = $index + 1;
    $hasilindex = "501".str_pad($index,4,"0",STR_PAD_LEFT);

} else {
    $hasilindex = "5010001";}


?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <small><b>Halaman Data Buku Hilang</b></small>
    </h1>
  </section>
<section class="content">

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <label>Daftar Hilang</label>
      </div>
      <div class="panel-body">
        <form method="POST" action="proses_transaksi/proses_detil_hilang.php">
        <table style="table-layout:fixed" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th align="center" width="20px">No. </th>
              <th align="center"><center>Nomor Copy</center></th>
              <th align="center"><center>Judul Buku </center></th>
              <th align="center"><center>Pengarang</center> </th>
              <th align="center"><center>Tanggal Pinjam</center> </th>
              <th align="center"><center>Jumlah Hilang</center> </th>
            </tr>
          </thead>
          <tbody>
            <?php $ganti=1; ?>
            <?php $nocop=1; ?>
            <?php $no=1; ?>
            <?php $baris2 = count($konten); ?>
            <?php foreach($konten as $data2) { ?>
            <tr>
              <td><center><?php echo $no++ ?></center></td>
              <td><center><?php echo $data2['no_copy'] ?></center></td>
              <td><center><?php echo $data2['judul_buku'] ?></center></td>
              <td><center><?php echo $data2['pengarang'] ?></center></td>
              <td><center><?php echo $data2['tgl_pinjam'] ?></center></td>
              <input type="hidden" name="no_copy<?php echo $nocop++ ?>" value="<?php echo $data2['no_copy'] ?>">
              <td><center><input class="form-control" type="number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="0" value="<?php echo $data2['jml_pinjam'] ?>" name="jml_ganti<?php echo $ganti++; ?>"></center></td>
                <input type="hidden" name="baris2" value="<?php echo $baris2 ?>">
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="panel-footer">
        <div class="row">
          <div class="col-md-6">
            <a href="pengembalian.php" class="btn pull-right col-md-5 btn-danger"><i class="fa fa-close"></i> Kembali</a>
          </div>
        <div class="col-md-6">
          <button type="button" data-target="#ModalEntryPenggantian" data-toggle="modal" class="btn btn-primary btn-md btn-block" ><span class="fa fa-sign-out"></span> Proses Pengembalian</button>
        </div>
        </div>
      </div>
     </div>
    </div>
  </div>
</section>
</div>

<div class="modal fade" id="ModalEntryPenggantian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Input Data Hilang</h4>
      </div>
      <div class="modal-body">

        <div class="form-group"><label>Nomor Hilang</label>
            <input required class="form-control required text-capitalize" placeholder="Input Nama Anggota" value="<?php echo $hasilindex ?>" data-placement="top" readonly data-trigger="manual" type="text" name="no_hilang">
          </div>

        <div class="form-group"><label>Nomor Peminjaman</label>
            <input required class="form-control required text-capitalize" placeholder="Input Nama Anggota" value="<?php echo $id ?>" readonly data-placement="top" data-trigger="manual" type="text" name="no_peminjaman">
          </div>

        <div class="form-group"><label>Tanggal Hilang</label>
            <input required class="form-control required text-capitalize" data-placement="top" data-trigger="manual" type="date" name="tgl_hilang">
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