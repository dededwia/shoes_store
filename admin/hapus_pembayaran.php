<?php
include "../koneksi.php";
$id=$_GET['id'];
$no_transaksi=$_GET['no_transaksi'];
$hapus=mysql_query("delete from tb_pembayaran where no_transaksi='$no_transaksi'");
if ($hapus)
{ ?>
	<script>alert('Data <?php echo $no_transaksi;?> berhasil dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=pembayaran&id=<?php echo $id;?>'">
<?php } 
else
{ ?>
	<script>alert('Data <?php echo $no_transaksi;?> gagal dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=pembayaran&id=<?php echo $id;?>'">
<?php } ?>