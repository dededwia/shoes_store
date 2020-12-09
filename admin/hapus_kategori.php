<?php
include "../koneksi.php";
$id=$_GET['id'];
$kd_kategori=$_GET['kd_kategori'];
$hapus=mysql_query("delete from tb_kategori where kd_kategori='$kd_kategori'");
if ($hapus)
{ ?>
	<script>alert('Data <?php echo $kd_kategori;?> berhasil dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=kategori&id=<?php echo $id;?>'">
<?php } 
else
{ ?>
	<script>alert('Data <?php echo $kd_kategori;?> gagal dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=kategori&id=<?php echo $id;?>'">
<?php } ?>