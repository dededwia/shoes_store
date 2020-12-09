<?php
include "koneksi.php";
include "function.php";
$id=$_GET['id'];
$id01=$_GET['id00'];
$id00=str_replace(" ", "+", "$id");
$de_id=decrypt($id00);
$cari=mysql_query("select* from tb_login where id='$de_id'");
$baris=mysql_fetch_array($cari);
$kd_plgn=$baris['kd_plgn'];
$cari00=mysql_query("select* from tb_transaksi where kd_plgn='$kd_plgn'");
$baris01=mysql_fetch_array($cari00);
$no_transaksi00=$baris01['no_transaksi'];
$tampil_detail=mysql_query("select* from tb_detail where id='$id01'");
while ($baris04=mysql_fetch_array($tampil_detail))
{
	$kd_produk=$baris04['kd_produk'];
	$tampil_detail00=mysql_query("select* from tb_detail where kd_produk='$kd_produk' and no_transaksi='$no_transaksi00'");
	while ($baris05=mysql_fetch_array($tampil_detail00))
	{
		$jumlah=$baris05['jumlah'];			
		$tampil=mysql_query("select* from tb_produk where kd_produk='$kd_produk'");
		$baris06=mysql_fetch_array($tampil);
		$stok=$baris06['stok'];
		$stok_akhir=$stok+$jumlah;
		mysql_query("update tb_produk set stok='$stok_akhir' where kd_produk='$kd_produk'"); 
	}	
}
$hapus_produk=mysql_query("delete from tb_detail where id='$id01'");
if ($hapus_produk)
{  ?>
	<script>alert('Produk berhasil dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=keranjang&id=<?php echo $id;?>'">
<?php }
else
{ ?>
	<script>alert('Produk gagal dihapus')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=keranjang&id=<?php echo $id;?>'">
<?php } ?>


	