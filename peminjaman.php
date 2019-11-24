<?php 
include 'template/Header.php'; 
include 'template/Sidebar.php';
include_once("Database/koneksi.php");
?>

<?php

//autonumber
$cariindex = mysqli_query($koneksi,"select max(no_peminjaman) from tb_peminjaman") or die(mysqli_error());
$dataindex = mysqli_fetch_array($cariindex);
if($dataindex){
    $nilaiindex = substr($dataindex[0],3);
    $index = (int) $nilaiindex;
    $index = $index + 1;
    $hasilindex = "201".str_pad($index,4,"0",STR_PAD_LEFT);

} else {
    $hasilindex = "2010001";}

?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <small><b>Halaman Data Peminjaman</b></small>
    </h1>
  </section>
<section class="content">

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <i class="fa fa-tag"></i>
          <span> Tambah Pinjaman</span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="POST" action="proses_transaksi/proses_peminjaman.php">
          <div class="form-group">
            <div class="row">
              <div class="col-md-1">
                <label class="control-label">Buku</label>
              </div>
              <div class="col-md-4">
                <select class="form-control" name="no_copy">
                  <?php $result = mysqli_query($koneksi, "SELECT * FROM tb_copybuku ORDER BY no_copy asc"); ?>
                  <?php while($buku = mysqli_fetch_array($result)) { ?>
                  <option value="<?php echo $buku['no_copy'] ?>"><?php echo $buku['no_copy'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-1">
                <label class="control-label">Jumlah</label>
              </div>
              <div class="col-md-3">
                <input type="number" name="jml_pinjam" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="1" required class="form-control">
              </div>
              <div class="col-md-3">
                <button type="submit" name="detil" class="btn btn-success btn-md btn-block" ><span class="fa fa-plus"></span> Tambah Buku</button>
              </div>
            </div>
          </div>
          <hr>
        </form>
      </div>
    </div>
  </div>
</div>

<?php $result = mysqli_query($koneksi, "SELECT * FROM detil_pinjam,tb_buku,tb_copybuku WHERE tb_copybuku.no_copy = detil_pinjam.no_copy AND tb_buku.no_buku = tb_copybuku.no_buku AND no_peminjaman is null"); ?>
<?php $data = mysqli_fetch_array($result); ?> 
<?php if(isset($data)){ ?>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <label>Detail Peminjaman</label>
      </div>
      <div class="panel-body">
        <table style="table-layout:fixed" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th align="center" width="50px">No. </th>
              <th align="center"><center>Nomor Copy</center></th>
              <th align="center"><center>Nomor Buku</center></th>
              <th align="center"><center>Judul Buku</center></th>
              <th align="center"><center>Jumlah</center></th>
              <th align="center"><center>Hapus</center></th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; ?>
            <?php $result = mysqli_query($koneksi, "SELECT * FROM detil_pinjam,tb_buku,tb_copybuku WHERE tb_copybuku.no_copy = detil_pinjam.no_copy AND tb_buku.no_buku = tb_copybuku.no_buku AND no_peminjaman is null"); ?>
            <?php while($data = mysqli_fetch_array($result)) { ?>
            <tr>
              <td><center><?php echo $no++; ?></center></td>
              <td><center><?php echo $data['no_copy'] ?></center></td>
              <td><center><?php echo $data['no_buku'] ?></center></td>
              <td><center><?php echo $data['judul_buku'] ?></center></td>
              <td><center><?php echo $data['jml_pinjam'] ?></center></td>
              <form method="POST" action="proses_transaksi/proses_peminjaman.php">
              <input type="hidden" name="no_copy" value="<?php echo $data['no_copy'] ?>">
              <td><center><button type="submit" name="hapusDetil" class="btn btn-danger"><i class="fa fa-trash"></i></button></center></td>
              </form>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="panel-footer">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-4"></div>
          <div class="col-md-3">
            <form method="post" action="proses_transaksi/proses_peminjaman.php">
            <button type="submit" name="hapusSemua" class="btn btn-danger btn-md btn-block" ><span class="fa fa-close"></span> Batal</button>
            </form>
          </div>
          <div class="col-md-3">
            <button type="button" data-target="#ModalEntryPeminjaman" data-toggle="modal" class="btn btn-primary btn-md btn-block" ><span class="fa fa-sign-out"></span> Proses Peminjaman</button>
          </div>
        </div>
      </div>
     </div>
    </div>
  </div>
<?php } ?>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <label>Daftar Peminjaman</label>
      </div>
      <div class="panel-body">
        <table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="anggota">
          <thead>
            <tr>
              <th align="center" width="20px">No. </th>
              <th align="center"><center>Nomor Peminjaman</center></th>
              <th align="center"><center>Nomor anggota</center></th>
              <th align="center"><center>Nama Pinjam</center> </th>
              <th align="center"><center>Tanggal Pinjam</center> </th>
              <th align="center"><center>Detail</center></th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; ?>
            <?php $result = mysqli_query($koneksi, "SELECT * FROM tb_peminjaman,tb_anggota WHERE tb_anggota.no_anggota = tb_peminjaman.no_anggota and status = '0' order by no_peminjaman desc"); ?>
            <?php while($data2 = mysqli_fetch_array($result)) { ?>
            <tr>
              <td><center><?php echo $no++ ?></center></td>
              <td><center><?php echo $data2['no_peminjaman'] ?></center></td>
              <td><center><?php echo $data2['no_anggota'] ?></center></td>
              <td><center><?php echo $data2['nama_anggota'] ?></center></td>
              <td><center><?php echo $data2['tgl_pinjam'] ?></center></td>
              <td><center><a data-toggle="modal" href="#detail<?php echo $data2['no_peminjaman'] ?>" class="btn btn btn-primary"><i class="fa fa-folder-open"></i></a></center></td>
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

<?php $result2 = mysqli_query($koneksi, "SELECT * FROM tb_peminjaman order by no_peminjaman desc"); ?>
<?php while($data3 = mysqli_fetch_array($result2)) { ?>
<div class="modal fade" id="detail<?php echo $data3['no_peminjaman'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Nomor Peminjaman <b><?php echo $data3['no_peminjaman'] ?></b></h4>
      </div>
      <div class="modal-body">
         <table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="anggota">
          <thead>
            <tr>
              <th align="center" width="20px">No. </th>
              <th align="center"><center>Nomor Copy Buku</center></th>
              <th align="center"><center>Judul Buku</center></th>
              <th align="center"><center>Tanggal Pinjam</center> </th>
              <th align="center"><center>Jumlah Pinjam</center></th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; ?>
            <?php $z = $data3['no_peminjaman']; ?>
            <?php $result4 = mysqli_query($koneksi, "SELECT * FROM detil_pinjam,tb_anggota,tb_peminjaman,tb_copybuku,tb_buku WHERE detil_pinjam.no_copy = tb_copybuku.no_copy and tb_buku.no_buku = tb_copybuku.no_buku and tb_peminjaman.no_peminjaman = detil_pinjam.no_peminjaman and tb_peminjaman.no_anggota = tb_anggota.no_anggota and tb_peminjaman.no_peminjaman = '$z' order by detil_pinjam.no_peminjaman asc"); ?>
            <?php while($data2 = mysqli_fetch_array($result4)) { ?>
            <tr>
              <td><center><?php echo $no++ ?></center></td>
              <td><center><?php echo $data2['no_copy'] ?></center></td>
              <td><center><?php echo $data2['judul_buku'] ?></center></td>
              <td><center><?php echo $data2['tgl_pinjam'] ?></center></td>
              <td><center><?php echo $data2['jml_pinjam'] ?></center></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<?php } ?>




<div class="modal fade" id="ModalEntryPeminjaman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Input Data Peminjaman</h4>
      </div>
      <form method="POST" action="proses_transaksi/proses_peminjaman.php" enctype="multipart/form-data">
        <div class="modal-body">
          
          <div class="form-group"><label>Nomor Peminjaman</label>
            <input required class="form-control required text-capitalize" value="<?php echo $hasilindex ?>" readonly data-placement="top" placeholder="Input Nomor Buku" data-trigger="manual" type="text" name="no_peminjaman">
          </div>

          <div class="form-group"><label>Nomor Anggota</label>
            <input required class="form-control required text-capitalize" data-placement="top" placeholder="Input Nomor Buku" data-trigger="manual" type="number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="no_anggota">
          </div>

          <div class="form-group"><label>Tanggal Pinjam</label>
            <input required class="form-control required text-capitalize" data-placement="top" placeholder="Input Nomor Buku" data-trigger="manual" type="date" name="tgl_pinjam">
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