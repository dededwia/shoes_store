<?php
session_start();
include "koneksi.php";
include "function.php";
$id=$_GET['id'];
$id00=str_replace(" ", "+", "$id");
$de_id=decrypt($id00);
$cari=mysql_query("select* from tb_login where id='$de_id'");
$baris=mysql_fetch_array($cari);
$kd_plgn=$baris['kd_plgn'];echo $kd_plgn;
$cari00=mysql_query("select* from tb_transaksi where kd_plgn='$kd_plgn'");
$baris00=mysql_fetch_array($cari00);
$no_transaksi=$baris00['no_transaksi'];
$tampil_pelanggan=mysql_query("select* from tb_transaksi where no_transaksi='$no_transaksi'");
$baris03=mysql_fetch_array($tampil_pelanggan);
$kd_plgn03=$baris03['kd_plgn'];
$tampil_detail=mysql_query("select* from tb_detail where no_transaksi='$no_transaksi'");
while ($baris04=mysql_fetch_array($tampil_detail))
{
	$kd_produk=$baris04['kd_produk'];
	$tampil_detail00=mysql_query("select* from tb_detail where kd_produk='$kd_produk' and no_transaksi='$no_transaksi'");
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
mysql_query("delete from tb_login where kd_plgn='$kd_plgn03'");
mysql_query("delete from tb_detail where no_transaksi='$no_transaksi'");
mysql_query("delete from tb_pembayaran where no_transaksi='$no_transaksi'");
mysql_query("delete from tb_transaksi where no_transaksi='$no_transaksi'");
mysql_query("delete from tb_pelanggan where kd_plgn='$kd_plgn03'");
unset($_SESSION['id']); 
session_unset();
session_destroy();
header("Location:index.php?p=home");
?>