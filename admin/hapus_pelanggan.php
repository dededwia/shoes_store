<?php
include "../koneksi.php";
$id=$_GET['id'];
$kd_plgn=$_GET['kd_plgn'];
$hapus=mysql_query("delete from tb_pelanggan where kd_plgn='$kd_plgn'");
if ($hapus)
{ ?>
	<script>alert('Data berhasil dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=pelanggan&id=<?php echo $id;?>'">
<?php } 
else
{ ?>
	<script>alert('Data gagal dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=pelanggan&id=<?php echo $id;?>'">
<?php } ?>