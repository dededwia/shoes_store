<html>
<head>
</head>
<body>
<?php 
error_reporting(0);
include "koneksi.php";
include "function.php";
date_default_timezone_set('Asia/Jakarta');
$d=date("Y-m-d h:i:sa");
$id=$_GET['id'];
$id00=str_replace(" ", "+", "$id");
$de_id=decrypt($id00);
$cari=mysql_query("select* from tb_login where id='$de_id'");
$baris=mysql_fetch_array($cari);
$username=$baris['username'];
$kd_plgn=$baris['kd_plgn'];
$pass00=$_GET['pass00'];
$pass01=$_GET['pass01'];
$email=$_GET['email'];
$cari00=mysql_query("select* from tb_transaksi where kd_plgn='$kd_plgn'");
$baris00=mysql_fetch_array($cari00);
$no_transaksi=$baris00['no_transaksi'];
$cari01=mysql_query("select sum(jumlah),sum(total_harga) from tb_detail where no_transaksi='$no_transaksi'");
$baris01=mysql_fetch_array($cari01);
$total_beli01=$baris01['sum(jumlah)'];
$total_bayar=$baris01['sum(total_harga)'];
$total_bayar00=number_format($total_bayar);
$total_bayar01=str_replace(",", ".","$total_bayar00");
?>
<table border=0 align=center bgcolor=transparent width=100% cellpadding=0 class="c">
<?php 
if ($id=="")
{ ?>
<tr>
	<td align=right><input type="image" onclick="window.location.href='index.php?p=home'" src="images/home.png" width=50 height=50></td>
</tr>
<?php }
else
{ ?>
<tr>
	<td align=right><input type="image" onclick="window.location.href='index.php?p=home&id=<?php echo $id;?>'" src="images/home.png" width=50 height=50></td>
</tr>
<?php } ?>
</table>
<br><br><br><br><br><br>
<table border=0 align=center width=100% cellpadding=70>
<tr>
	<td>
	<table border=0 bgcolor=white align=center style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" width=100%>
	<tr>
		<td valign=top bgcolor=white>
				<table border=0 align=center width=100% cellpadding=5>
				<tr>
					<td style="color:white">
					<form method="post">
					<table border=1 style="border-collapse:collapse;border-color:black" width=100% align=center cellpadding=10>
					<?php 
					$tampil=mysql_query("select* from tb_login where username='$username'");
					while ($baris=mysql_fetch_array($tampil))	
					{
						$kd_plgn=$baris['kd_plgn'];
						$tampil00=mysql_query("select* from tb_transaksi where kd_plgn='$kd_plgn'");
						while ($baris00=mysql_fetch_array($tampil00))
						{
							$no_transaksi=$baris00['no_transaksi'];
							$tampil01=mysql_query("select* from tb_pembayaran where no_transaksi='$no_transaksi' and keterangan='Menunggu Pembayaran'");
							while ($baris01=mysql_fetch_array($tampil01))
							{
								$no_transaksi00=$baris01['no_transaksi'];
								$no_transaksi01=encrypt($no_transaksi00);
								$kd_jns_pembayaran=$baris01['kd_jns_pembayaran'];
								$tampil02=mysql_query("select* from tb_jns_pembayaran where kd_jns_pembayaran='$kd_jns_pembayaran'");
								$baris02=mysql_fetch_array($tampil02);
								$nm_jns_pembayaran=$baris02['nm_jns_pembayaran'];
								$bukti_pembayaran=$baris02['bukti_pembayaran'];
								$keterangan=$baris01['keterangan'];
							}
							
						}
					}
					
					if ($keterangan!="")
					{
					 ?>
						<tr>
							<td colspan=2 align=center style="font-size:18px;font-family:arial;font-weight:bold;height:100px" valign=middle>Pembatalan Transaksi</td>
						</tr>
						<tr>
							<td style="font-family:arial;font-size:12px">No. Transaksi</td><td style="font-family:arial;font-size:12px"><?php echo $no_transaksi00;?></td>
						</tr>
						<tr>
							<td colspan=2 style="font-family:arial;font-size:12px" align=right><input type="submit" onclick="return confirm('Apakah anda ingin membatalkan transaksi ini?')" name="batal" class="tombol00" value="Batalkan"></td>
						</tr>
					<?php }
					else
					{ ?>
						<tr>
							<td style="font-family:arial;font-size:12px" align=center>Tidak ada data</td>
						</tr>
		 			<?php }

				 ?>
					</table>
					</form>
					<table>
					<tr>
					<?php
					if (isset($_POST['batal']))
					{
						$tampil_pelanggan=mysql_query("select* from tb_transaksi where no_transaksi='$no_transaksi00'");
						$baris03=mysql_fetch_array($tampil_pelanggan);
						$kd_plgn03=$baris03['kd_plgn'];
						$tampil_detail=mysql_query("select* from tb_detail where no_transaksi='$no_transaksi00'");
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
						mysql_query("delete from tb_login where kd_plgn='$kd_plgn03'");
						mysql_query("delete from tb_detail where no_transaksi='$no_transaksi00'");
						mysql_query("delete from tb_pembayaran where no_transaksi='$no_transaksi00'");
						mysql_query("delete from tb_transaksi where no_transaksi='$no_transaksi00'");
						mysql_query("delete from tb_pelanggan where kd_plgn='$kd_plgn03'");
						?>
						<script>alert('Pembatalan transaksi berhasil')</script>
						<meta http-equiv="refresh" content="0;url='index.php?p=home&id=<?php echo $id;?>">

					<?php }
					?>
					</tr>
					</td>
					</table>
					</td>
				</tr>
				</table>		
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>
</body>