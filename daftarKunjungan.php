<?php 
include 'template/Header.php'; 
include 'template/Sidebar.php';
include_once("Database/koneksi.php");
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <small><b>Halaman Data Kunjungan</b></small>
      <!--
        Coba Coba 
        Project MKPL 
      -->
    </h1>
  </section>
<section class="content">

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <label>Daftar Kunjungan</label>
      </div>
      <div class="panel-body">
        <table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="anggota">
          <thead>
            <tr>
              <th align="center" width="20px">No. </th>
              <th align="center"><center>Nomor Kunjungan</center></th>
              <th align="center"><center>Nomor anggota</center></th>
              <th align="center"><center>Nama Anggota</center> </th>
              <th align="center"><center>Tanggal</center> </th>
              <th align="center"><center>Keterangan</center></th>
              <th align="center"><center>Hapus</center></th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; ?>
            <?php $result = mysqli_query($koneksi, "SELECT * FROM tb_anggota a,tb_kunjungan b WHERE a.no_anggota = b.no_anggota order by no_kunjungan desc"); ?>
            <?php while($data2 = mysqli_fetch_array($result)) { ?>
            <tr>
              <td><center><?php echo $no++ ?></center></td>
              <td><center><?php echo $data2['no_kunjungan'] ?></center></td>
              <td><center><?php echo $data2['no_anggota'] ?></center></td>
              <td><center><?php echo $data2['nama_anggota'] ?></center></td>
              <td><center><?php echo $data2['tanggal'] ?></center></td>
              <td><center><?php echo $data2['ket'] ?></center></td>
              <td><center><a data-toggle="modal" href="#Hapus<?php echo $data2['no_kunjungan'] ?>" class="btn btn btn-danger"><i class="fa fa-trash"></i></a></center></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
     </div>
    </div>
  </div>
</section>
</div>

<?php $result = mysqli_query($koneksi, "SELECT no_kunjungan FROM tb_kunjungan"); ?>
<?php while($data = mysqli_fetch_array($result)) { ?>
<div class="modal fade" id="Hapus<?php echo $data['no_kunjungan']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus</h4>
      </div>
      <div class='modal-body'>Anda yakin ingin menghapus ?
      </div>
      <div class='modal-footer'>
        <form class="" action="proses_transaksi/proses_daftarKunjungan.php" method="post">
          <input type="hidden" value="<?php echo $data['no_kunjungan'] ?>" name="no_kunjungan">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button class="btn btn-danger" aria-label="Delete" type="submit" name="delete"><i class="fa fa-trash fa-fw"></i> Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<?php include "template/Footer.php"; ?>