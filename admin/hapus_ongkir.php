<?php
include "../koneksi.php";
$id=$_GET['id'];
$kd_ongkir=$_GET['kd_ongkir'];
$hapus=mysql_query("delete from tb_ongkir where kd_ongkir='$kd_ongkir'");
if ($hapus)
{ ?>
	<script>alert('Data berhasil dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=ongkir&id=<?php echo $id;?>'">
<?php } 
else
{ ?>
	<script>alert('Data gagal dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=ongkir&id=<?php echo $id;?>'">
<?php } ?>