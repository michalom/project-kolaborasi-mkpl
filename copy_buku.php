<?php 
include 'template/Header.php'; 
include 'template/Sidebar.php';
include_once("Database/koneksi.php");
?>

<?php

//autonumber
$cariindex = mysqli_query($koneksi,"select max(no_copy) from tb_copybuku;") or die(mysqli_error());
$dataindex = mysqli_fetch_array($cariindex);
if($dataindex){
    $nilaiindex = substr($dataindex[0],3);
    $index = (int) $nilaiindex;
    $index = $index + 1;
    $hasilindex = "101".str_pad($index,4,"0",STR_PAD_LEFT);

} else {
    $hasilindex = "1010001";}



?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <small><b>Halaman Data Copy Buku</b></small>
    </h1>
  </section>
<section class="content">


<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <button class="btn btn-success" data-toggle="modal" href="#" data-target="#ModalEntryBuku"><i class="fa fa-plus"></i> Tambah Data Copy Buku</button>
      </div>
      <div class="panel-body">
        <table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="anggota">
          <thead>
            <tr>
              <th align="center" width="20px">No. </th>
              <th align="center"><center>Nomor Copy</center></th>
              <th align="center"><center>Nomor Buku</center></th>
              <th align="center"><center>Judul Buku</center> </th>
              <th align="center"><center>Edit</center></th>
              <th align="center"><center>Hapus</center></th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; ?>
            <?php $result = mysqli_query($koneksi, "SELECT no_copy,tb_buku.no_buku,judul_buku FROM tb_buku JOIN tb_copybuku ON tb_buku.no_buku = tb_copybuku.no_buku ORDER BY no_copy asc"); ?>
            <?php while($data = mysqli_fetch_array($result)) { ?>
            <tr>
              <td><center><?php echo $no++; ?></center></td>
              <td><center><?php echo $data['no_copy'] ?></center></td>
              <td><center><?php echo $data['no_buku'] ?></center></td>
              <td><center><?php echo $data['judul_buku'] ?></center></td>
              <td><center>
                <a href="#Update<?php echo $data['no_copy'] ?>" class="btn btn-warning btn-circle" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> </a></center>
              </td>
              <td><center>
                <a href="#Hapus<?php echo $data['no_copy'] ?>" class="btn btn-danger btn-circle" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> </a></center>
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
</div>


<div class="modal fade" id="ModalEntryBuku" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Input Data Copy Buku</h4>
      </div>
      <form method="POST" action="proses_master/proses_copy_buku.php" enctype="multipart/form-data">
        <div class="modal-body">
          
          <div class="form-group"><label>Nomor Copy</label>
            <input required class="form-control required text-capitalize" value="<?php echo $hasilindex ?>" readonly data-placement="top" placeholder="Input Nomor Buku" data-trigger="manual" type="text" name="no_copy">
          </div>

          <div class="form-group"><label>Nomor Buku</label>
            <div class="custom-select my-1 mr-sm-2 ">
              <select class="form-control" name="no_buku">
                <?php $result = mysqli_query($koneksi, "SELECT no_buku,judul_buku FROM tb_buku ORDER BY no_buku DESC"); ?>
                <?php while($data2 = mysqli_fetch_array($result)) { ?>
                <option value="<?php echo $data2['no_buku'] ?>"><?php echo $data2['judul_buku'] ?></option>
                <?php } ?>
              </select>
            </div>
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

<?php $result = mysqli_query($koneksi, "SELECT no_copy,tb_buku.no_buku,judul_buku FROM tb_buku JOIN tb_copybuku ON tb_buku.no_buku = tb_copybuku.no_buku ORDER BY no_copy asc"); ?>
<?php while($row = mysqli_fetch_array($result)) { ?>
<div class="modal fade" id="Update<?php echo $row['no_copy'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Update Data Copy Buku</h4>
      </div>
      <form method="POST" action="proses_master/proses_copy_buku.php" enctype="multipart/form-data">
        <div class="modal-body">
          
          <div class="form-group"><label>Nomor Copy</label>
            <input required class="form-control required text-capitalize" value="<?php echo $row['no_copy'] ?>" readonly data-placement="top" placeholder="Input Nomor Buku" data-trigger="manual" type="text" name="no_copy">
          </div>

          <div class="form-group"><label>Nomor Buku</label>
            <div class="custom-select">
              <select class="form-control" name="no_buku">
                <?php $result2 = mysqli_query($koneksi, "SELECT no_buku,judul_buku FROM tb_buku"); ?>
                <?php while($data2 = mysqli_fetch_array($result2)) { ?>
                <option <?php if( $data2['no_buku'] === $row['no_buku']){echo "selected"; } ?> value="<?php echo $data2['no_buku'] ?>"><?php echo $data2['judul_buku'] ?></option>
                <?php } ?>
              </select>
            </div>
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


<?php $result = mysqli_query($koneksi, "SELECT no_copy FROM tb_copybuku"); ?>
<?php while($data = mysqli_fetch_array($result)) { ?>
<div class="modal fade" id="Hapus<?php echo $data['no_copy']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus</h4>
      </div>
      <div class='modal-body'>Anda yakin ingin menghapus ?
      </div>
      <div class='modal-footer'>
        <form class="" action="proses_master/proses_copy_buku.php" method="post">
          <input type="hidden" value="<?php echo $data['no_copy'] ?>" name="no_copy">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button class="btn btn-danger" aria-label="Delete" type="submit" name="delete"><i class="fa fa-trash fa-fw"></i> Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<?php include "template/Footer.php"; ?>