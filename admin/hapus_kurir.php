<?php
include "../koneksi.php";
$id=$_GET['id'];
$kd_kurir=$_GET['kd_kurir'];
$hapus=mysql_query("delete from tb_kurir where kd_kurir='$kd_kurir'");
if ($hapus)
{ ?>
	<script>alert('Data <?php echo $kd_kurir;?> berhasil dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=kurir&id=<?php echo $id;?>'">
<?php } 
else
{ ?>
	<script>alert('Data <?php echo $kd_kurir;?> gagal dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=kurir&id=<?php echo $id;?>'">
<?php } ?>