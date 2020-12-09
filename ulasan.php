<html>
<head>
</head>
<body style="background:linear-gradient(to top,orange,white,pink)">
<?php 
error_reporting(0);
include "koneksi.php";
include "function.php";
date_default_timezone_set('Asia/Jakarta');
$d=date("d-m-Y h:i:sa");
$id=$_GET['id'];
$id00=str_replace(" ", "+", "$id");
$de_id=decrypt($id00);
$no_transaksi=$_GET['no_transaksi'];
$no_transaksi00=str_replace(" ", "+", "$no_transaksi");
$de_no_transaksi=decrypt($no_transaksi00);

$cari04=mysql_query("select* from tb_transaksi where no_transaksi='$de_no_transaksi'");
$baris04=mysql_fetch_array($cari04);
$kd_plgn04=$baris04['kd_plgn'];

$cari=mysql_query("select* from tb_login where id='$de_id'");
$baris=mysql_fetch_array($cari);
$username=$baris['username'];

$cari00=mysql_query("select* from tb_login where username='$username'");
while ($baris00=mysql_fetch_array($cari00))
{
	$kd_plgn00=$baris00['kd_plgn'];
	$cari01=mysql_query("select* from tb_transaksi where kd_plgn='$kd_plgn00'");
	$baris01=mysql_fetch_array($cari01);
	$no_transaksi01=$baris01['no_transaksi'];
	$cari02=mysql_query("select max(no_transaksi) from tb_transaksi");
	$baris02=mysql_fetch_array($cari02);
	$no_transaksi02=$baris02['max(no_transaksi)'];
}
$pass00=$_GET['pass00'];
$pass01=$_GET['pass01'];
$email=$_GET['email'];?>
<script>
function nonaktifkan()
{
 document.onkeydown = function (e)
 {
  return false;
 }
}
</script>
<table border=0 align=center width=100% cellpadding=70>
<tr>
	<td>
	<table border=0 bgcolor=white style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" align=center width=100%>
	<tr>
		<td colspan=2 style="font-size:18px;font-family:arial;font-weight:bold" valign=top><img src="images/logo.png" width=150 height=70></td>
	</tr>
	<tr>
		<td valign=top bgcolor=white>
		<table border=0 align=center width=100% cellpadding=5>
		<tr>
			<td style="color:white" colspan=2>
			<form method="post">
			<table border=1 style="border-collapse:collapse;border-color:black" width=100% align=center cellpadding=10>
			<tr>
				<td colspan=3 align=center style="font-size:18px;font-family:arial;font-weight:bold;height:100px" valign=middle>Ulasan Produk</td>
			</tr>
			<tr>
				<td width=100% align=center colspan=3>
				<table border=0 width=100% align=center>
				<tr>
					<td style="font-family:arial:font-size:14px;font-weight:bold">Invoice: #<?php echo $de_no_transaksi;?></td>
				</tr>
				</table>
				</td>
			</tr>
			<tr>
				<th>Nama Produk</th>
				<th>Ulasan</th>
				<th>Nilai</th>
			</tr>
			<?php 
			$tampil=mysql_query("select* from tb_detail where no_transaksi='$de_no_transaksi'");
			while ($baris03=mysql_fetch_array($tampil))
			{ 
				$kd_produk=$baris03['kd_produk'];
				$tampil00=mysql_query("select* from tb_produk where kd_produk='$kd_produk'");
				$baris04=mysql_fetch_array($tampil00);
				$nm_produk=$baris04['nm_produk'];
				$gambar=$baris04['gambar'];?>
				<input type="hidden" name="id" value="<?php echo $id;?>">
				<input type="hidden" name="kd_produk[]" value="<?php echo $kd_produk;?>">
				<input type="hidden" name="no_transaksi" value="<?php echo $de_no_transaksi;?>">
				<input type="hidden" name="kd_plgn" value="<?php echo $kd_plgn04;?>">
				<tr>
					<td style="font-family:arial;font-size:12px;width:100px" valign=top><img src="images/<?php echo $gambar;?>" width=100 height=100><?php echo $nm_produk;?></td>
					<td style="font-family:arial;font-size:12px" valign=top><textarea name="ulasan[]" rows=5 style="resize:none;width:100%;font-family:arial" placeholder="Masukkan ulasan anda" autofocus required></textarea></td>
					<td style="font-family:arial;font-size:12px;width:50px" align=center valign=top><input type="number" onclick="nonaktifkan();" min="1" max="5" name="nilai[]" value="1">&nbsp<img src="images/bintang.png" width=20 height=20></td>
				</tr>
				<?php } ?>
				</table>
				</td>
			</tr>
			<tr>
				<td align=right><input type="submit" name="a" class="tombol00" value="Kirim"></td>
			</tr>
			</form>
			<?php
			$a=$_POST['a'];
			$kembali=$_POST['kembali'];
			$kd_plgn=$_POST['kd_plgn'];
			$kd_produk=$_POST['kd_produk'];
			$kd_produk00=count($kd_produk);
			$ulasan=$_POST['ulasan'];
			$nilai=$_POST['nilai'];
			if ($a)
			{
				for ($i=0;$i<=$kd_produk00-1;$i++)
				{
					$simpan=mysql_query("insert into tb_ulasan values('','$kd_plgn','$kd_produk[$i]','$d','$ulasan[$i]','$nilai[$i]')");
				}
				if ($simpan)
				{ 
					mysql_query("update tb_pengiriman set keterangan='Selesai' where no_transaksi='$de_no_transaksi'");?>
					<script>
					alert('Data berhasil disimpan');
					alert('Terima kasih telah memberikan ulasan anda')
					</script>
					<meta http-equiv="refresh" content="0;url='index.php?home&id=<?php echo $id;?>'">
				<?php }
			} 
			else
			{}
?>
		</table>		
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>
</body>