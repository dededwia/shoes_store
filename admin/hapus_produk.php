<?php
include "../koneksi.php";
$id=$_GET['id'];
$kd_produk=$_GET['kd_produk'];
$hapus=mysql_query("delete from tb_produk where kd_produk='$kd_produk'");
if ($hapus)
{ ?>
	<script>alert('Data <?php echo $kd_produk;?> berhasil dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=produk&id=<?php echo $id;?>'">
<?php } 
else
{ ?>
	<script>alert('Data <?php echo $kd_produk;?> gagal dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=produk&id=<?php echo $id;?>'">
<?php } ?>