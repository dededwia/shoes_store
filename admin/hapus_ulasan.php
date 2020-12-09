<?php
include "../koneksi.php";
$id=$_GET['id'];
$id0=$_GET['id0'];
$hapus=mysql_query("delete from tb_ulasan where id='$id0'");
if ($hapus)
{ ?>
	<script>alert('Data <?php echo $id0;?> berhasil dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=ulasan&id=<?php echo $id;?>'">
<?php } 
else
{ ?>
	<script>alert('Data <?php echo $id0;?> gagal dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=ulasan&id=<?php echo $id;?>'">
<?php } ?>