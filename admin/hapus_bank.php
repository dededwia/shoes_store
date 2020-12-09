<?php
include "../koneksi.php";
$id=$_GET['id'];
$kd_bank=$_GET['kd_bank'];
$hapus=mysql_query("delete from tb_bank where kd_bank='$kd_bank'");
if ($hapus)
{ ?>
	<script>alert('Data <?php echo $kd_bank;?> berhasil dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=bank&id=<?php echo $id;?>'">
<?php } 
else
{ ?>
	<script>alert('Data <?php echo $kd_bank;?> gagal dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=bank&id=<?php echo $id;?>'">
<?php } ?>