<?php
error_reporting(0);
include "koneksi.php";
include "function.php";
date_default_timezone_set('Asia/Jakarta');
$d=date(d)."-".date(m)."-".date(Y);
$id=$_POST['id'];
$kd_plgn=$_POST['kd_plgn'];
$no_transaksi=$_POST['no_transaksi'];
$kd_produk=$_POST['kd_produk'];
$ulasan=$_POST['ulasan'];
$nilai=$_POST['nilai'];
$simpan=mysql_query("insert into tb_ulasan values('','$kd_plgn','$kd_produk','$d','$ulasan','$nilai')");
if ($simpan)
{ 
	mysql_query("update tb_pembayaran set keterangan='Selesai' where no_transaksi='$no_transaksi'");?>
	<script>alert('Ulasan berhasil disimpan')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=home&id=<?php echo $id;?>'">
<?php }
else
{ ?>
	<script>alert('Data gagal disimpan')</script>
<?php }
?>