<?php
include "../koneksi.php";
$id=$_GET['id'];
$no_transaksi=$_GET['no_transaksi'];
$hapus0=mysql_query("delete from tb_pembayaran where no_transaksi='$no_transaksi'");
$hapus1=mysql_query("delete from tb_pengiriman where no_transaksi='$no_transaksi'");
$hapus2=mysql_query("delete from tb_pengembalian_produk where no_transaksi='$no_transaksi'");
$hapus3=mysql_query("delete from tb_detail where no_transaksi='$no_transaksi'");
$hapus4=mysql_query("delete from tb_login where no_transaksi='$no_transaksi'");
$hapus5=mysql_query("delete from tb_transaksi where no_transaksi='$no_transaksi'");
$hapus6=mysql_query("delete from tb_pelanggan where no_transaksi='$no_transaksi'");
if ($hapus0 and $hapus1 and $hapus2 and $hapus3 and $hapus4 and $hapus5 and $hapus6)
{ ?>
	<script>alert('Data <?php echo $no_transaksi;?> berhasil dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=transaksi&id=<?php echo $id;?>'">
<?php } 
else
{ ?>
	<script>alert('Data <?php echo $no_transaksi;?> gagal dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=transaksi&id=<?php echo $id;?>'">
<?php } ?>