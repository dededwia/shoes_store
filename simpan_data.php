<?php
error_reporting(0);
include "koneksi.php";
include "function.php";
date_default_timezone_set('Asia/Jakarta');
$id=$_POST['id'];
$id00=str_replace(" ", "+", "$id");
$de_id=decrypt($id00);
$cari=mysql_query("select* from tb_login where id='$de_id'");
$baris=mysql_fetch_array($cari);
$kd_plgn=$baris['kd_plgn'];
$username=$baris['username'];
$cari00=mysql_query("select* from tb_user where username='$username'");
$baris00=mysql_fetch_array($cari00);
$email=$baris00['email'];
$no_transaksi=$_POST['no_transaksi'];
$no_transaksi00=encrypt($no_transaksi);
$kd_jns_pembayaran=$_POST['kd_jns_pembayaran'];
$nm_pemegang_kartu=$_POST['nm_pemegang_kartu'];
$bank=$_POST['bank'];
$no_rekening=$_POST['no_rekening'];
$kota=$_POST['kota'];
$nm_plgn=$_POST['nm_plgn'];
$alamat00=$_POST['alamat'];
$no_telp=$_POST['no_telp'];
$kurir=$_POST['kurir'];
$tgl_transaksi=$_POST['tgl_transaksi'];
$ongkir=$_POST['ongkir00'];
$total_beli=$_POST['total_beli'];
$total_harga=$_POST['total_harga'];
$total_berat=$_POST['total_berat'];
$total_bayar=$_POST['total_bayar'];
$d=date(d)."-".date(m)."-".date(Y);
$cari01=mysql_query("select* from tb_detail");
while ($baris01=mysql_fetch_array($cari01))
{
	$kd_produk=$baris01['kd_produk'];
	$cari02=mysql_query("select sum(jumlah) from tb_detail where kd_produk='$kd_produk'");
	$baris02=mysql_fetch_array($cari02);
	$jumlah=$baris02['sum(jumlah)'];
}
$cari03=mysql_query("select* from tb_produk where kd_produk='$kd_produk'");
while ($baris03=mysql_fetch_array($cari03))
{
	$stok=$baris03['stok'];
	$stok_akhir=$stok-$jumlah;
	mysql_query("update tb_produk set stok='$stok_akhir' where kd_produk='$kd_produk'");
}

if ($kd_jns_pembayaran=="BT")
{
	mysql_query("insert into tb_pembayaran values('$no_transaksi','$kd_jns_pembayaran','','','Menunggu Pembayaran')");
	mysql_query("update tb_pelanggan set nm_plgn='$nm_plgn',alamat='$alamat00',no_telp='$no_telp',email='$email' where kd_plgn='$kd_plgn'");
	mysql_query("update tb_transaksi set tgl_transaksi='$d',kd_plgn='$kd_plgn',nm_pemegang_kartu='$nm_pemegang_kartu',kd_bank='$bank',no_rek_bank='$no_rekening',total_beli='$total_beli',total_berat='$total_berat',ongkir='$ongkir',total_bayar='$total_bayar' where no_transaksi='$no_transaksi'");	
	mysql_query("insert into tb_pengiriman values('','$no_transaksi','','$kurir','','')");?>
	<script>alert('Data berhasil disimpan')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=invoice&id=<?php echo $id;?>&no_transaksi=<?php echo $no_transaksi00;?>'">
<?php }
else
{
	mysql_query("insert into tb_pembayaran values('$no_transaksi','$kd_jns_pembayaran','','','Menunggu Pembayaran')");
	mysql_query("update tb_pelanggan set nm_plgn='$nm_plgn',alamat='$alamat00',no_telp='$no_telp',email='$email' where kd_plgn='$kd_plgn'");
	mysql_query("update tb_transaksi set tgl_transaksi='$d',kd_plgn='$kd_plgn',total_beli='$total_beli',total_berat='$total_berat',total_bayar='$total_bayar' where no_transaksi='$no_transaksi'");
	mysql_query("insert into tb_pengiriman values('','$no_transaksi','','-','','')");?>
	<script>alert('Data berhasil disimpan')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=invoice&id=<?php echo $id;?>&no_transaksi=<?php echo $no_transaksi00;?>'">
<?php }
?>