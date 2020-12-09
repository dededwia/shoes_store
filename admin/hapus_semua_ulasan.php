<?php
include "../koneksi.php";
$id=$_GET['id'];
$hapus_semua=mysql_query("delete from tb_ulasan");
if ($hapus_semua)
{ ?>
	<script>alert('Semua data berhasil dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=ulasan&id=<?php echo $id;?>'">
<?php } 
else
{ ?>
	<script>alert('Data gagal dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=ulasan&id=<?php echo $id;?>'">
<?php } ?>