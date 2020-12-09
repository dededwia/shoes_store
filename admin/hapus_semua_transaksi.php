<?php
include "../koneksi.php";
$id=$_GET['id'];
$hapus_semua0=mysql_query("delete from tb_pembayaran");
$hapus_semua1=mysql_query("delete from tb_pengiriman");
$hapus_semua2=mysql_query("delete from tb_pengembalian_produk");
$hapus_semua3=mysql_query("delete from tb_detail");
$hapus_semua4=mysql_query("delete from tb_login");
$hapus_semua5=mysql_query("delete from tb_transaksi");
$hapus_semua6=mysql_query("delete from tb_pelanggan");
if ($hapus_semua0 and $hapus_semua1 and $hapus_semua2 and $hapus_semua3 and $hapus_semua4 and $hapus_semua5 and $hapus_semua6)
{ ?>
	<script>alert('Semua data berhasil dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=transaksi&id=<?php echo $id;?>'">
<?php } 
else
{ ?>
	<script>alert('Data gagal dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=transaksi&id=<?php echo $id;?>'">
<?php } ?>