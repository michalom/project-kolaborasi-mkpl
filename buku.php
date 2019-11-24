<?php 
include 'template/Header.php'; 
include 'template/Sidebar.php';
include_once("Database/koneksi.php");
?>

<?php

//autonumber
$cariindex = mysqli_query($koneksi,"select max(no_buku) from tb_buku;") or die(mysqli_error());
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
      <small><b>Halaman Data Buku</b></small>
    </h1>
  </section>
<section class="content">

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <button class="btn btn-success" data-toggle="modal" href="#" data-target="#ModalEntryBuku"><i class="fa fa-plus"></i> Tambah Data Buku</button>
      </div>
      <div class="panel-body">
        <table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="anggota">
          <thead>
            <tr>
              <th align="center" width="20px">No. </th>
              <th align="center"><center>Nomor Buku</center></th>
              <th align="center"><center>Judul Buku</center></th>
              <th align="center"><center>Pengarang</center> </th>
              <th align="center"><center>Penerbit</center> </th>
              <th align="center"><center>Tahun Terbit</center></th>
              <th align="center"><center>Tahun Beli</center></th>
              <th align="center"><center>Asal Buku</center></th>
              <th align="center"><center>Eksamplar</center></th>
              <th align="center"><center>Edit</center></th>
              <th align="center"><center>Hapus</center></th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; ?>
            <?php $result = mysqli_query($koneksi, "SELECT * FROM tb_buku ORDER BY no_buku asc"); ?>
            <?php while($data = mysqli_fetch_array($result)) { ?>
            <tr>
              <td><center><?php echo $no++; ?></center></td>
              <td><center><?php echo $data['no_buku'] ?></center></td>
              <td><center><?php echo $data['judul_buku'] ?></center></td>
              <td><center><?php echo $data['pengarang'] ?></center></td>
              <td><center><?php echo $data['penerbit'] ?></center></td>
              <td><center><?php echo $data['thn_terbit'] ?></center></td>
              <td><center><?php echo $data['thn_beli'] ?></center></td>
              <td><center><?php echo $data['asal_buku'] ?></center></td>
              <td><center><?php echo $data['eks'] ?></center></td> 
              <td><center>
                <a href="#Update<?php echo $data['no_buku'] ?>" class="btn btn-warning btn-circle" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> </a></center>
              </td>
              <td><center>
                <a href="#Hapus<?php echo $data['no_buku'] ?>" class="btn btn-danger btn-circle" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> </a></center>
             </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
     </div>
    </div>
  </div>
</section>


<div class="modal fade" id="ModalEntryBuku" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Input Data Buku</h4>
      </div>
      <form method="POST" action="proses_master/proses_buku.php" enctype="multipart/form-data">
        <div class="modal-body">
          
          <div class="form-group"><label>Nomor Buku</label>
            <input required class="form-control required text-capitalize" value="<?php echo $hasilindex ?>" readonly data-placement="top" placeholder="Input Nomor Buku" data-trigger="manual" type="text" name="no_buku">
          </div>
                
          <div class="form-group"><label>Judul Buku</label>
            <input required class="form-control required text-capitalize" placeholder="Input Judul Buku" data-placement="top" data-trigger="manual" type="text" name="judul_buku">
          </div>

          <div class="form-group"><label>Pengarang</label>
            <input required class="form-control required text-capitalize" placeholder="Input Pengarang" data-placement="top" data-trigger="manual" type="text" name="pengarang">
          </div>

          <div class="form-group"><label>Penerbit</label>
            <input required class="form-control required text-capitalize" placeholder="Input Penerbit" data-placement="top" data-trigger="manual" type="text" name="penerbit">
          </div>

          <div class="form-group"><label>Tahun Terbit</label>
            <input required class="form-control required text-capitalize" placeholder="Input Terbit" data-placement="top" data-trigger="manual" type="text" name="thn_terbit">
          </div>

          <div class="form-group"><label>Tahun Beli</label>
            <input required class="form-control required text-capitalize" placeholder="Input Tahun Beli" data-placement="top" data-trigger="manual" type="text" name="thn_beli">
          </div>

          <div class="form-group"><label>Asal Buku</label>
            <input required class="form-control required text-capitalize" placeholder="Input Asal Buku" data-placement="top" data-trigger="manual" type="text" name="asal_buku">
          </div>

          <div class="form-group"><label>Eksamplar</label>
            <input required class="form-control required text-capitalize" placeholder="Input Eksamplar" data-placement="top" data-trigger="manual" type="text" name="eks">
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

<?php $result = mysqli_query($koneksi, "SELECT * FROM tb_buku ORDER BY no_buku asc"); ?>
<?php while($data = mysqli_fetch_array($result)) { ?>
<div class="modal fade" id="Update<?php echo $data['no_buku'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Update Data Buku</h4>
      </div>
      <form method="POST" action="proses_master/proses_buku.php" enctype="multipart/form-data">
        <div class="modal-body">
          
          <div class="form-group"><label>Nomor Buku</label>
            <input required class="form-control required text-capitalize" value="<?php echo $data['no_buku'] ?>" readonly data-placement="top" placeholder="Input Nomor Buku" data-trigger="manual" type="text" name="no_buku">
          </div>
                
          <div class="form-group"><label>Judul Buku</label>
            <input required class="form-control required text-capitalize" value="<?php echo $data['judul_buku'] ?>" placeholder="Input Judul Buku" data-placement="top" data-trigger="manual" type="text" name="judul_buku">
          </div>

          <div class="form-group"><label>Pengarang</label>
            <input required class="form-control required text-capitalize" value="<?php echo $data['pengarang'] ?>" placeholder="Input Pengarang" data-placement="top" data-trigger="manual" type="text" name="pengarang">
          </div>

          <div class="form-group"><label>Penerbit</label>
            <input required class="form-control required text-capitalize" value="<?php echo $data['penerbit'] ?>" placeholder="Input Penerbit" data-placement="top" data-trigger="manual" type="text" name="penerbit">
          </div>

          <div class="form-group"><label>Tahun Terbit</label>
            <input required class="form-control required text-capitalize" value="<?php echo $data['thn_terbit'] ?>" placeholder="Input Terbit" data-placement="top" data-trigger="manual" type="text" name="thn_terbit">
          </div>

          <div class="form-group"><label>Tahun Beli</label>
            <input required class="form-control required text-capitalize" value="<?php echo $data['thn_beli'] ?>" placeholder="Input Tahun Beli" data-placement="top" data-trigger="manual" type="text" name="thn_beli">
          </div>

          <div class="form-group"><label>Asal Buku</label>
            <input required class="form-control required text-capitalize" value="<?php echo $data['asal_buku'] ?>" placeholder="Input Asal Buku" data-placement="top" data-trigger="manual" type="text" name="asal_buku">
          </div>

          <div class="form-group"><label>Eksamplar</label>
            <input required class="form-control required text-capitalize" value="<?php echo $data['eks'] ?>" placeholder="Input Eksamplar" data-placement="top" data-trigger="manual" type="text" name="eks">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button type="submit" name="update" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>


<?php $result = mysqli_query($koneksi, "SELECT * FROM tb_buku ORDER BY no_buku asc"); ?>
<?php while($data = mysqli_fetch_array($result)) { ?>
<div class="modal fade" id="Hapus<?php echo $data['no_buku']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus</h4>
      </div>
      <div class='modal-body'>Anda yakin ingin menghapus ?
      </div>
      <div class='modal-footer'>
        <form class="" action="proses_master/proses_buku.php" method="post">
          <input type="hidden" value="<?php echo $data['no_buku'] ?>" name="no_buku">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button class="btn btn-danger" aria-label="Delete" type="submit" name="delete"><i class="fa fa-trash fa-fw"></i> Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<?php include "template/Footer.php"; ?>